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
if (!in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor'])) {
    json_response(['ok' => false, 'message' => 'Permissão negada.'], 403);
}

$body = read_json();

if (!isset($body['secoes']) || !is_array($body['secoes'])) {
    json_response(['ok' => false, 'message' => 'Dados inválidos.'], 400);
}

$secoes = [];
foreach ($body['secoes'] as $s) {
    if (!is_array($s)) continue;
    $titulo = trim((string)($s['titulo'] ?? ''));
    if ($titulo === '') continue;
    $docs = [];
    foreach ((array)($s['documentos'] ?? []) as $d) {
        if (!is_array($d)) continue;
        $arquivo = trim((string)($d['arquivo'] ?? ''));
        if ($arquivo === '') continue;
        $docs[] = [
            'titulo'    => trim((string)($d['titulo']    ?? '')),
            'subtitulo' => trim((string)($d['subtitulo'] ?? '')),
            'arquivo'   => $arquivo,
        ];
    }
    $secoes[] = ['titulo' => $titulo, 'documentos' => $docs];
}

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('contratos_regulamentos', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode(['secoes' => $secoes], JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Contratos e regulamentos salvos com sucesso.']);
