<?php
declare(strict_types=1);

require_once dirname(__FILE__, 3) . '/_session.php';

require_once dirname(__FILE__, 3) . '/response.php';

if (empty($_SESSION['usuario'])) {
    json_response(['ok' => false, 'message' => 'Não autorizado.'], 401);
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['ok' => false, 'message' => 'Método não permitido.'], 405);
}

require_once dirname(__FILE__, 5) . '/config/database.php';
require_once dirname(__FILE__) . '/helpers.php';

$body     = read_json();
$referrer = $body['referrer'] ?? [];
$referred = $body['referred'] ?? [];

$validatePerson = function (array $p, string $label): ?string {
    if (!trim($p['name'] ?? ''))                               return "{$label}: nome é obrigatório.";
    if (strlen(preg_replace('/\D/', '', $p['cpf'] ?? '')) !== 11) return "{$label}: CPF inválido.";
    if (!filter_var($p['email'] ?? '', FILTER_VALIDATE_EMAIL)) return "{$label}: e-mail inválido.";
    return null;
};

if ($err = $validatePerson($referrer, 'Indicador'))     json_response(['ok' => false, 'message' => $err], 400);
if ($err = $validatePerson($referred, 'Novo assinante')) json_response(['ok' => false, 'message' => $err], 400);

$refCpf = preg_replace('/\D/', '', $referrer['cpf']);
$newCpf = preg_replace('/\D/', '', $referred['cpf']);

if ($refCpf === $newCpf) {
    json_response(['ok' => false, 'message' => 'O CPF do indicador e do novo assinante não podem ser iguais.'], 400);
}

$pdo = getDbConnection();

try {
    // Check referred does not already have a signup
    $stmt = $pdo->prepare("SELECT numbersLucky FROM campaign_people WHERE cpf = ? LIMIT 1");
    $stmt->execute([$newCpf]);
    $existingReferred = $stmt->fetch();

    if ($existingReferred) {
        $entries = json_decode($existingReferred['numbersLucky'], true) ?? [];
        foreach ($entries as $e) {
            if ($e['type'] === 'signup') {
                json_response(['ok' => false, 'message' => 'Este CPF já participa da campanha como assinante.'], 409);
            }
        }
    }

    // Load referrer
    $stmt = $pdo->prepare("SELECT * FROM campaign_people WHERE cpf = ? LIMIT 1");
    $stmt->execute([$refCpf]);
    $existingReferrer = $stmt->fetch();

    $refNumbers = $existingReferrer ? (json_decode($existingReferrer['numbersLucky'], true) ?? []) : [];
    $newNumbers = $existingReferred ? (json_decode($existingReferred['numbersLucky'], true) ?? []) : [];

    $pdo->beginTransaction();

    $dateNow = getCurrentDateTime();

    // Referrer number
    $refNumber = generateUniqueLuckyNumber($pdo);
    $refEntry  = [
        'number'       => (string) $refNumber,
        'type'         => 'referral',
        'date'         => $dateNow,
        'nomeIndicado' => trim($referred['name']),
    ];
    $refNumbers[] = $refEntry;

    // Referred number
    $newNumber = generateUniqueLuckyNumber($pdo);
    $newEntry  = [
        'number'       => (string) $newNumber,
        'type'         => 'signup',
        'date'         => $dateNow,
        'nomeIndicado' => null,
    ];
    $newNumbers[] = $newEntry;

    // Upsert referrer
    if ($existingReferrer) {
        $stmt = $pdo->prepare(
            "UPDATE campaign_people SET name = ?, email = ?, phone = ?, numbersLucky = ? WHERE cpf = ?"
        );
        $stmt->execute([
            trim($referrer['name']),
            trim($referrer['email']),
            preg_replace('/\D/', '', $referrer['phone'] ?? ''),
            json_encode($refNumbers, JSON_UNESCAPED_UNICODE),
            $refCpf,
        ]);
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO campaign_people (name, cpf, email, phone, numbersLucky) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            trim($referrer['name']),
            $refCpf,
            trim($referrer['email']),
            preg_replace('/\D/', '', $referrer['phone'] ?? ''),
            json_encode($refNumbers, JSON_UNESCAPED_UNICODE),
        ]);
    }

    // Upsert referred
    if ($existingReferred) {
        $stmt = $pdo->prepare(
            "UPDATE campaign_people SET name = ?, email = ?, phone = ?, numbersLucky = ? WHERE cpf = ?"
        );
        $stmt->execute([
            trim($referred['name']),
            trim($referred['email']),
            preg_replace('/\D/', '', $referred['phone'] ?? ''),
            json_encode($newNumbers, JSON_UNESCAPED_UNICODE),
            $newCpf,
        ]);
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO campaign_people (name, cpf, email, phone, numbersLucky) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            trim($referred['name']),
            $newCpf,
            trim($referred['email']),
            preg_replace('/\D/', '', $referred['phone'] ?? ''),
            json_encode($newNumbers, JSON_UNESCAPED_UNICODE),
        ]);
    }

    $pdo->commit();

    $stmt = $pdo->prepare("SELECT * FROM campaign_people WHERE cpf = ? LIMIT 1");
    $stmt->execute([$refCpf]);
    $updatedReferrer = $stmt->fetch();
    $stmt->execute([$newCpf]);
    $updatedReferred = $stmt->fetch();

    $sentEmail   = ['referrer' => false, 'referred' => false];
    $emailErrors = [];

    try {
        require_once dirname(__FILE__, 2) . '/email/email_service.php';

        $refEmail = trim($referrer['email']);
        $newEmail = trim($referred['email']);

        if ($refEmail) {
            $sentEmail['referrer'] = send_lucky_email(
                $refEmail,
                trim($referrer['name']),
                (string) $refNumber,
                'Gerado por indicação: ' . trim($referred['name']) . '.'
            );
        }
        if ($newEmail) {
            $sentEmail['referred'] = send_lucky_email(
                $newEmail,
                trim($referred['name']),
                (string) $newNumber,
                'Gerado por assinatura do plano AserNet.'
            );
        }
    } catch (Throwable $e) {
        $emailErrors[] = $e->getMessage();
    }

    json_response([
        'ok'          => true,
        'message'     => 'Indicação registrada e números gerados com sucesso.',
        'referrer'    => $updatedReferrer,
        'referred'    => $updatedReferred,
        'generated'   => ['referrer' => $refEntry, 'referred' => $newEntry],
        'sentEmail'   => $sentEmail,
        'emailErrors' => $emailErrors,
    ]);

} catch (Throwable $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    json_response(['ok' => false, 'message' => $e->getMessage()], 500);
}
