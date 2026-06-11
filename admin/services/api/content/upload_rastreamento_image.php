<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) session_start();

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

if (empty($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    json_response(['ok' => false, 'message' => 'Nenhum arquivo enviado ou erro no upload.'], 400);
}

$file     = $_FILES['image'];
$maxBytes = 3 * 1024 * 1024;

if ($file['size'] > $maxBytes) {
    json_response(['ok' => false, 'message' => 'Arquivo muito grande. Máximo 3 MB.'], 400);
}

$allowed_mime = ['image/jpeg', 'image/png', 'image/webp'];
$finfo        = new finfo(FILEINFO_MIME_TYPE);
$mime         = $finfo->file($file['tmp_name']);

if (!in_array($mime, $allowed_mime, true)) {
    json_response(['ok' => false, 'message' => 'Tipo de arquivo não permitido. Use JPG, PNG ou WebP.'], 400);
}

$extMap   = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
$ext      = $extMap[$mime];
$baseName = preg_replace('/[^a-z0-9_-]/', '', strtolower(pathinfo($file['name'], PATHINFO_FILENAME)));
$baseName = $baseName ?: 'img';
$filename = 'rastreamento_' . substr($baseName, 0, 40) . '_' . time() . '.' . $ext;

$targetDir  = dirname(__FILE__, 5) . '/images/rastreamentoveicular/';
$targetPath = $targetDir . $filename;

if (!is_dir($targetDir)) {
    json_response(['ok' => false, 'message' => 'Diretório de imagens não encontrado.'], 500);
}

if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
    json_response(['ok' => false, 'message' => 'Falha ao salvar imagem.'], 500);
}

json_response(['ok' => true, 'filename' => $filename]);
