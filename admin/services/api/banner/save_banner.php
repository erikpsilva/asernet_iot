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
               'paraempresas','wifiprofissional','telefonia','linkdedicado','combo','sobreasernet','nossaslojas','controlecorporativo','bairroseguro','controleconcominial','condominiointeligente'];

$raw  = file_get_contents('php://input');
$body = json_decode($raw, true);
if (!is_array($body)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'message' => 'JSON inválido.']);
    exit;
}

$page = trim((string) ($body['page'] ?? ''));
if (!in_array($page, $validPages)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'message' => 'Página inválida.']);
    exit;
}

$s = function (string $key) use ($body): string {
    return trim((string) ($body[$key] ?? ''));
};

function sanitize_bullets_bn(array $arr, int $max): array {
    $out = [];
    foreach ($arr as $v) {
        $v = trim((string) $v);
        if ($v !== '') $out[] = $v;
        if (count($out) >= $max) break;
    }
    return $out;
}

$content = [
    'titulo'             => $s('titulo'),
    'titulo_destaque'    => $s('titulo_destaque'),
    'titulo_complemento' => $s('titulo_complemento'),
    'texto'              => $s('texto'),
    'bullets'            => sanitize_bullets_bn(is_array($body['bullets'] ?? null) ? $body['bullets'] : [], 10),
    'preco'              => $s('preco'),
    'btn1_texto'         => $s('btn1_texto'),
    'btn2_texto'         => $s('btn2_texto'),
    'imagem'             => $s('imagem'),
];

require_once dirname(__FILE__, 5) . '/config/database.php';

try {
    $pdo = getDbConnection();
    $pdo->prepare("
        INSERT INTO system_settings (setting_key, setting_value)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)
    ")->execute([$page . '_banner', json_encode($content, JSON_UNESCAPED_UNICODE)]);

    echo json_encode(['ok' => true, 'message' => 'Banner salvo com sucesso.']);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'message' => 'Erro ao salvar.']);
}
