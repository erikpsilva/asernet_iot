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

if (empty($_FILES['pdf']) || $_FILES['pdf']['error'] !== UPLOAD_ERR_OK) {
    json_response(['ok' => false, 'message' => 'Nenhum arquivo recebido ou erro no upload.'], 400);
}

$file     = $_FILES['pdf'];
$tmpPath  = $file['tmp_name'];
$origName = $file['name'];

$finfo = new finfo(FILEINFO_MIME_TYPE);
if ($finfo->file($tmpPath) !== 'application/pdf') {
    json_response(['ok' => false, 'message' => 'Somente arquivos PDF são aceitos.'], 400);
}

if ($file['size'] > 20 * 1024 * 1024) {
    json_response(['ok' => false, 'message' => 'O arquivo não pode ultrapassar 20 MB.'], 400);
}

$uploadDir = dirname(__FILE__, 5) . '/uploads/contratos/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$baseName = preg_replace('/[^A-Za-z0-9._-]/', '_', pathinfo($origName, PATHINFO_FILENAME));
$baseName = substr($baseName, 0, 80);
$filename = $baseName . '_' . time() . '.pdf';

if (!move_uploaded_file($tmpPath, $uploadDir . $filename)) {
    json_response(['ok' => false, 'message' => 'Erro ao salvar o arquivo no servidor.'], 500);
}

json_response([
    'ok'      => true,
    'arquivo' => 'uploads/contratos/' . $filename,
    'nome'    => $origName,
]);
