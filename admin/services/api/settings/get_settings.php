<?php
declare(strict_types=1);

require_once dirname(__FILE__, 3) . '/_session.php';

require_once dirname(__FILE__, 3) . '/response.php';

if (empty($_SESSION['usuario'])) {
    json_response(['ok' => false, 'message' => 'Não autorizado.'], 401);
}

require_once dirname(__FILE__, 5) . '/config/database.php';

$pdo  = getDbConnection();
$stmt = $pdo->query("SELECT setting_key, setting_value FROM system_settings");
$rows = $stmt->fetchAll();

$settings = [];
foreach ($rows as $row) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

json_response(['ok' => true, 'settings' => $settings]);
