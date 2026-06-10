<?php
declare(strict_types=1);

require_once dirname(__FILE__, 4) . '/config/database.php';
require_once dirname(__FILE__, 3) . '/response.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['ok' => false, 'message' => 'Método não permitido.'], 405);
}

$body = read_json();
$cpf  = preg_replace('/\D/', '', $body['cpf'] ?? '');

if (strlen($cpf) !== 11) {
    json_response(['ok' => false, 'message' => 'CPF inválido.'], 400);
}

$pdo  = getDbConnection();
$stmt = $pdo->prepare("SELECT name, numbersLucky FROM campaign_people WHERE cpf = ? LIMIT 1");
$stmt->execute([$cpf]);
$person = $stmt->fetch();

if (!$person) {
    json_response(['ok' => false, 'message' => 'Nenhum registro encontrado para este CPF.'], 404);
}

$entries = json_decode($person['numbersLucky'], true) ?? [];
usort($entries, fn($a, $b) => strcmp($b['date'], $a['date']));

$numbers = array_map(function ($e) {
    $dt = new DateTime($e['date'], new DateTimeZone('America/Sao_Paulo'));
    return [
        'number'       => $e['number'],
        'type'         => $e['type'],
        'dateBR'       => $dt->format('d/m/Y H:i'),
        'nomeIndicado' => $e['nomeIndicado'] ?? null,
    ];
}, $entries);

json_response([
    'ok'      => true,
    'name'    => $person['name'],
    'numbers' => $numbers,
    'total'   => count($numbers),
]);
