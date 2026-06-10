<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) session_start();

require_once dirname(__FILE__, 3) . '/response.php';

if (empty($_SESSION['usuario'])) {
    json_response(['ok' => false, 'message' => 'Não autorizado.'], 401);
}

require_once dirname(__FILE__, 5) . '/config/database.php';
require_once dirname(__FILE__) . '/helpers.php';

$pdo  = getDbConnection();
$stmt = $pdo->query("SELECT name, numbersLucky FROM campaign_people ORDER BY created_at DESC");
$rows = $stmt->fetchAll();

$data = [];
foreach ($rows as $row) {
    $entries = json_decode($row['numbersLucky'], true) ?? [];
    foreach ($entries as $e) {
        $data[] = [
            'name'         => $row['name'],
            'number'       => $e['number'],
            'date'         => formatDateBR($e['date']),
            'type'         => $e['type'],
            'nomeIndicado' => $e['nomeIndicado'] ?? null,
        ];
    }
}

json_response(['ok' => true, 'data' => $data]);
