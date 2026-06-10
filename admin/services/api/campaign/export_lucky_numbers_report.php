<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) session_start();

if (empty($_SESSION['usuario'])) {
    http_response_code(401);
    exit('Não autorizado.');
}

require_once dirname(__FILE__, 5) . '/config/database.php';
require_once dirname(__FILE__) . '/helpers.php';

$pdo      = getDbConnection();
$stmt     = $pdo->query("SELECT * FROM campaign_people ORDER BY created_at ASC");
$rows     = $stmt->fetchAll();
$filename = 'relatorio_cruzeiro_' . date('Ymd_His') . '.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen('php://output', 'w');
fwrite($output, "\xEF\xBB\xBF"); // BOM UTF-8

fputcsv($output, ['Nome', 'CPF', 'E-mail', 'Telefone', 'Número da sorte', 'Data de geração', 'Motivo', 'Indicado para quem'], ';');

foreach ($rows as $row) {
    $entries = json_decode($row['numbersLucky'], true) ?? [];
    if (empty($entries)) {
        fputcsv($output, [$row['name'], $row['cpf'], $row['email'], $row['phone'], '', '', '', ''], ';');
        continue;
    }
    foreach ($entries as $e) {
        fputcsv($output, [
            $row['name'],
            $row['cpf'],
            $row['email'],
            $row['phone'],
            $e['number'],
            formatDateBR($e['date']),
            $e['type'] === 'signup' ? 'Assinatura' : 'Indicação',
            $e['nomeIndicado'] ?? '',
        ], ';');
    }
}

fclose($output);
