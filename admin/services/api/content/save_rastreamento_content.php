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

$body = read_json();

$s = function (string $key) use ($body): string {
    return trim((string) ($body[$key] ?? ''));
};

function sanitize_arr_rv(array $arr, int $max = 6): array {
    return array_values(array_slice(
        array_map(function ($v) { return trim((string) $v); }, $arr),
        0, $max
    ));
}

function sanitize_titulo_texto_rv(array $item): array {
    return [
        'titulo' => trim((string) ($item['titulo'] ?? '')),
        'texto'  => trim((string) ($item['texto']  ?? '')),
    ];
}

function sanitize_cat_card_rv(array $item): array {
    return [
        'titulo'   => trim((string) ($item['titulo']   ?? '')),
        'texto'    => trim((string) ($item['texto']    ?? '')),
        'imagem'   => trim((string) ($item['imagem']   ?? '')),
        'featured' => (bool) ($item['featured'] ?? false),
    ];
}

function sanitize_cat_more_rv(array $item): array {
    return [
        'texto'  => trim((string) ($item['texto']  ?? '')),
        'imagem' => trim((string) ($item['imagem'] ?? '')),
    ];
}

function sanitize_plano_rv(array $p): array {
    return [
        'nome'     => trim((string) ($p['nome']     ?? '')),
        'descricao'=> trim((string) ($p['descricao'] ?? '')),
        'preco'    => trim((string) ($p['preco']    ?? '')),
        'bullets'  => sanitize_arr_rv($p['bullets'] ?? []),
    ];
}

$content = [
    'quick_items' => array_map('sanitize_titulo_texto_rv', array_slice(array_filter($body['quick_items'] ?? [], 'is_array'), 0, 4)),

    'cat_titulo'    => $s('cat_titulo'),
    'cat_subtitulo' => $s('cat_subtitulo'),
    'cat_cards' => array_map('sanitize_cat_card_rv', array_slice(array_filter($body['cat_cards'] ?? [], 'is_array'), 0, 4)),
    'cat_more'  => array_map('sanitize_cat_more_rv', array_slice(array_filter($body['cat_more']  ?? [], 'is_array'), 0, 6)),

    'bike_titulo'  => $s('bike_titulo'),
    'bike_texto'   => $s('bike_texto'),
    'bike_imagem'  => $s('bike_imagem'),
    'bike_bullets' => sanitize_arr_rv($body['bike_bullets'] ?? [], 6),

    'planos_titulo'    => $s('planos_titulo'),
    'planos_subtitulo' => $s('planos_subtitulo'),
    'planos_nota'      => $s('planos_nota'),
    'planos' => array_map('sanitize_plano_rv', array_slice(array_filter($body['planos'] ?? [], 'is_array'), 0, 3)),

    'why_titulo' => $s('why_titulo'),
    'why_items'  => array_map('sanitize_titulo_texto_rv', array_slice(array_filter($body['why_items'] ?? [], 'is_array'), 0, 4)),

    'trust_google' => $s('trust_google'),
    'trust_items'  => sanitize_arr_rv($body['trust_items'] ?? [], 4),
];

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('rastreamento_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteúdo salvo com sucesso.']);
