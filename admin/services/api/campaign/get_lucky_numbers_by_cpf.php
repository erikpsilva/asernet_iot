<?php
declare(strict_types=1);

require_once dirname(__FILE__, 3) . '/_session.php';

require_once dirname(__FILE__, 3) . '/response.php';

if (empty($_SESSION['usuario'])) {
    json_response(['ok' => false, 'message' => 'Não autorizado.'], 401);
}

require_once dirname(__FILE__, 5) . '/config/database.php';

$body = read_json();
$cpf  = preg_replace('/\D/', '', $body['cpf'] ?? $_GET['cpf'] ?? '');

if (strlen($cpf) !== 11) {
    json_response(['ok' => false, 'message' => 'CPF inválido.'], 400);
}

$pdo  = getDbConnection();
$stmt = $pdo->prepare("SELECT * FROM campaign_people WHERE cpf = ? LIMIT 1");
$stmt->execute([$cpf]);
$person = $stmt->fetch();

if (!$person) {
    json_response(['ok' => false, 'message' => 'Nenhum registro encontrado para este CPF.'], 404);
}

$numbersLucky = json_decode($person['numbersLucky'], true) ?? [];
usort($numbersLucky, fn($a, $b) => strcmp($b['date'], $a['date']));

$personData = $person;
unset($personData['numbersLucky']);

json_response([
    'ok'           => true,
    'person'       => $personData,
    'numbersLucky' => $numbersLucky,
    'total'        => count($numbersLucky),
]);
