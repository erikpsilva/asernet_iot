<?php
declare(strict_types=1);

require_once dirname(__FILE__, 3) . '/_session.php';

require_once dirname(__FILE__, 3) . '/response.php';

if (empty($_SESSION['usuario'])) {
    json_response(['ok' => false, 'message' => 'Não autorizado.'], 401);
}
if (!in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor', 'cruzeiro'])) {
    json_response(['ok' => false, 'message' => 'Permissão negada.'], 403);
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['ok' => false, 'message' => 'Método não permitido.'], 405);
}

if (empty($_FILES['pdf']) || $_FILES['pdf']['error'] !== UPLOAD_ERR_OK) {
    json_response(['ok' => false, 'message' => 'Nenhum arquivo recebido.']);
}

$file = $_FILES['pdf'];

if ($file['size'] > 10 * 1024 * 1024) {
    json_response(['ok' => false, 'message' => 'Arquivo muito grande. Máximo: 10 MB.']);
}

$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime  = $finfo->file($file['tmp_name']);
if ($mime !== 'application/pdf') {
    json_response(['ok' => false, 'message' => 'Apenas arquivos PDF são aceitos.']);
}

$dir = dirname(__FILE__, 5) . '/uploads/regulamento/';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

$filename = 'regulamento.pdf';
$dest     = $dir . $filename;

if (!move_uploaded_file($file['tmp_name'], $dest)) {
    json_response(['ok' => false, 'message' => 'Erro ao salvar o arquivo.']);
}

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo  = getDbConnection();
$stmt = $pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('regulamento_pdf', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
);
$stmt->execute([$filename]);

json_response(['ok' => true, 'filename' => $filename]);
