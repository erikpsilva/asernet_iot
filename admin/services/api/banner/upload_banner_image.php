<?php
require_once dirname(__FILE__, 3) . '/_session.php';
header('Content-Type: application/json');

require_once dirname(__FILE__, 5) . '/config/api_security.php';
validateApiAccess($ALLOWED_ORIGINS);

if (empty($_SESSION['usuario']) || !in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor'])) {
    http_response_code(403);
    echo json_encode(['ok' => false, 'message' => 'Acesso não autorizado.']);
    exit;
}

$validPages = ['inicio','residencial','cameras','wifimesh','movel','rastreamento','skeelo',
               'paraempresas','wifiprofissional','telefonia','linkdedicado','combo','sobreasernet'];

$page = trim($_POST['page'] ?? '');
if (!in_array($page, $validPages)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'message' => 'Página inválida.']);
    exit;
}

if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'message' => 'Arquivo não enviado ou com erro.']);
    exit;
}

if ($_FILES['image']['size'] > 3 * 1024 * 1024) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'message' => 'Arquivo muito grande. Máximo 3 MB.']);
    exit;
}

$finfo    = new finfo(FILEINFO_MIME_TYPE);
$mimeType = $finfo->file($_FILES['image']['tmp_name']);
$allowed  = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
if (!isset($allowed[$mimeType])) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'message' => 'Tipo de arquivo não permitido. Use JPG, PNG ou WebP.']);
    exit;
}

$root    = dirname(__FILE__, 5);
$dir     = $root . '/images/banners/' . $page . '/';

if (!is_dir($dir)) {
    if (!mkdir($dir, 0755, true)) {
        http_response_code(500);
        echo json_encode(['ok' => false, 'message' => 'Não foi possível criar a pasta de imagens.']);
        exit;
    }
}

$ext      = $allowed[$mimeType];
$filename = 'banner_' . $page . '_' . time() . '.' . $ext;
$dest     = $dir . $filename;

if (!move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'message' => 'Erro ao mover o arquivo.']);
    exit;
}

echo json_encode(['ok' => true, 'filename' => $filename]);
