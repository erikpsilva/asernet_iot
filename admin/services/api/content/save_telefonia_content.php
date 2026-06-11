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

function sanitize_str_arr_te(array $arr, int $max): array {
    return array_values(array_slice(
        array_map(function ($v) { return trim((string) $v); }, $arr),
        0, $max
    ));
}

function sanitize_titulotext_te(array $item): array {
    return [
        'titulo' => trim((string) ($item['titulo'] ?? '')),
        'texto'  => trim((string) ($item['texto']  ?? '')),
    ];
}

function sanitize_sol_card_te(array $item): array {
    return [
        'titulo' => trim((string) ($item['titulo'] ?? '')),
        'texto'  => trim((string) ($item['texto']  ?? '')),
        'imagem' => trim((string) ($item['imagem'] ?? '')),
    ];
}

$content = [
    'pain_titulo' => $s('pain_titulo'),
    'pain_texto'  => $s('pain_texto'),
    'pain_items'  => sanitize_str_arr_te($body['pain_items'] ?? [], 4),

    'sol_titulo' => $s('sol_titulo'),
    'sol_texto'  => $s('sol_texto'),
    'sol_cards'  => array_map('sanitize_sol_card_te', array_slice(array_filter($body['sol_cards'] ?? [], 'is_array'), 0, 3)),

    'feat_titulo' => $s('feat_titulo'),
    'feat_texto'  => $s('feat_texto'),
    'feat_items'  => array_map('sanitize_titulotext_te', array_slice(array_filter($body['feat_items'] ?? [], 'is_array'), 0, 4)),

    'res_aud_titulo' => $s('res_aud_titulo'),
    'res_aud_items'  => sanitize_str_arr_te($body['res_aud_items'] ?? [], 7),
    'res_imagem'     => $s('res_imagem'),
    'res_rec_titulo' => $s('res_rec_titulo'),
    'res_rec_items'  => sanitize_str_arr_te($body['res_rec_items'] ?? [], 6),

    'flow_titulo' => $s('flow_titulo'),
    'flow_texto'  => $s('flow_texto'),
    'flow_items'  => sanitize_str_arr_te($body['flow_items'] ?? [], 5),

    'ben_titulo' => $s('ben_titulo'),
    'ben_items'  => array_map('sanitize_titulotext_te', array_slice(array_filter($body['ben_items'] ?? [], 'is_array'), 0, 4)),

    'trust_google' => $s('trust_google'),
    'trust_items'  => sanitize_str_arr_te($body['trust_items'] ?? [], 3),
];

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('telefonia_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteúdo salvo com sucesso.']);
