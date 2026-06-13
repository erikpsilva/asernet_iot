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
if (!in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor', 'cruzeiro'])) {
    json_response(['ok' => false, 'message' => 'Permissão negada.'], 403);
}

require_once dirname(__FILE__, 5) . '/config/database.php';

$body = read_json();

$allowed = ['contact_emails', 'sorteio_date', 'regulamento_titulo', 'regulamento_pdf'];
$pdo     = getDbConnection();

$stmt = $pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES (?, ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
);

foreach ($allowed as $key) {
    if (!array_key_exists($key, $body)) continue;
    $value = trim((string) $body[$key]);
    $stmt->execute([$key, $value]);
}

json_response(['ok' => true, 'message' => 'Configurações salvas.']);
