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

$body         = read_json();
$name         = trim($body['name'] ?? '');
$cpf          = preg_replace('/\D/', '', $body['cpf'] ?? '');
$email        = trim($body['email'] ?? '');
$phone        = preg_replace('/\D/', '', $body['phone'] ?? '');
$type         = trim($body['type'] ?? 'signup');
$nomeIndicado = trim($body['nomeIndicado'] ?? '');

if (strlen($name) < 2) {
    json_response(['ok' => false, 'message' => 'Nome é obrigatório.'], 400);
}
if (strlen($cpf) !== 11) {
    json_response(['ok' => false, 'message' => 'CPF inválido.'], 400);
}
if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    json_response(['ok' => false, 'message' => 'E-mail inválido.'], 400);
}
if (!in_array($type, ['signup', 'referral'], true)) {
    json_response(['ok' => false, 'message' => 'Tipo inválido.'], 400);
}
if ($type === 'referral' && !$nomeIndicado) {
    json_response(['ok' => false, 'message' => 'Nome do indicado é obrigatório para indicações.'], 400);
}

$pdo = getDbConnection();

try {
    // Check email not used by another CPF
    if ($email) {
        $stmt = $pdo->prepare("SELECT cpf FROM campaign_people WHERE email = ? AND cpf != ? LIMIT 1");
        $stmt->execute([$email, $cpf]);
        if ($stmt->fetch()) {
            json_response(['ok' => false, 'message' => 'Este e-mail já está cadastrado com outro CPF.'], 409);
        }
    }

    // Find existing record
    $stmt = $pdo->prepare("SELECT * FROM campaign_people WHERE cpf = ? LIMIT 1");
    $stmt->execute([$cpf]);
    $person = $stmt->fetch();

    $numbersLucky = [];

    if ($person) {
        if ($email && $person['email'] && $person['email'] !== $email) {
            json_response(['ok' => false, 'message' => 'E-mail não confere com o CPF cadastrado.'], 409);
        }
        $numbersLucky = json_decode($person['numbersLucky'], true) ?? [];

        if ($type === 'signup') {
            foreach ($numbersLucky as $entry) {
                if ($entry['type'] === 'signup') {
                    json_response(['ok' => false, 'message' => 'Este CPF já possui um número gerado por assinatura.'], 409);
                }
            }
        }
    }

    $pdo->beginTransaction();

    $number  = generateUniqueLuckyNumber($pdo);
    $dateNow = getCurrentDateTime();

    $newEntry = [
        'number'       => (string) $number,
        'type'         => $type,
        'date'         => $dateNow,
        'nomeIndicado' => $type === 'referral' ? $nomeIndicado : null,
    ];
    $numbersLucky[]    = $newEntry;
    $numbersLuckyJson  = json_encode($numbersLucky, JSON_UNESCAPED_UNICODE);

    if ($person) {
        $stmt = $pdo->prepare(
            "UPDATE campaign_people SET name = ?, email = ?, phone = ?, numbersLucky = ? WHERE cpf = ?"
        );
        $stmt->execute([
            $name,
            $email ?: $person['email'],
            $phone ?: $person['phone'],
            $numbersLuckyJson,
            $cpf,
        ]);
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO campaign_people (name, cpf, email, phone, numbersLucky) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([$name, $cpf, $email, $phone, $numbersLuckyJson]);
    }

    $pdo->commit();

    $stmt = $pdo->prepare("SELECT * FROM campaign_people WHERE cpf = ? LIMIT 1");
    $stmt->execute([$cpf]);
    $updated = $stmt->fetch();

    $sentEmail  = false;
    $emailError = null;
    if ($email) {
        try {
            require_once dirname(__FILE__, 2) . '/email/email_service.php';
            $reason    = $type === 'signup'
                ? 'Gerado por assinatura do plano AserNet.'
                : 'Gerado por indicação de assinante: ' . $nomeIndicado . '.';
            $sentEmail = send_lucky_email($email, $name, (string) $number, $reason);
        } catch (Throwable $e) {
            $emailError = $e->getMessage();
        }
    }

    json_response([
        'ok'         => true,
        'message'    => 'Número da sorte gerado com sucesso.',
        'person'     => $updated,
        'generated'  => $newEntry,
        'sentEmail'  => $sentEmail,
        'emailError' => $emailError,
    ]);

} catch (Throwable $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    json_response(['ok' => false, 'message' => $e->getMessage()], 500);
}
