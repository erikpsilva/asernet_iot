<?php
declare(strict_types=1);
require_once dirname(__FILE__, 3) . '/_session.php';
require_once dirname(__FILE__, 3) . '/response.php';
if (empty($_SESSION['usuario'])) json_response(['ok'=>false, 'message'=>'Não autorizado.'], 401);
if ($_SERVER['REQUEST_METHOD'] !== 'POST') json_response(['ok'=>false, 'message'=>'Método não permitido.'], 405);
if (!in_array($_SESSION['usuario']['nivel_acesso'] ?? '', ['admin','editor'], true)) json_response(['ok'=>false, 'message'=>'Permissão negada.'], 403);
if (empty($_SESSION['camera_v2_csrf']) || !hash_equals($_SESSION['camera_v2_csrf'], $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '')) json_response(['ok'=>false, 'message'=>'Sessão expirada. Atualize a página.'], 403);
if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) json_response(['ok'=>false, 'message'=>'Selecione uma imagem válida.'], 400);
$file = $_FILES['image'];
if ($file['size'] < 1 || $file['size'] > 5 * 1024 * 1024) json_response(['ok'=>false, 'message'=>'A imagem deve ter até 5 MB.'], 400);
$mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
$extensions = ['image/jpeg'=>'jpg', 'image/png'=>'png', 'image/webp'=>'webp'];
if (!isset($extensions[$mime]) || !getimagesize($file['tmp_name'])) json_response(['ok'=>false, 'message'=>'Use uma imagem JPG, PNG ou WebP.'], 400);
$name = 'camera-v2-' . bin2hex(random_bytes(8)) . '.' . $extensions[$mime];
$directory = dirname(__FILE__, 5) . '/images/camerasegurancav2';
if (!is_dir($directory) || !is_writable($directory) || !move_uploaded_file($file['tmp_name'], $directory . '/' . $name)) {
    json_response(['ok'=>false, 'message'=>'Não foi possível gravar a imagem.'], 500);
}
json_response(['ok'=>true, 'filename'=>$name]);
