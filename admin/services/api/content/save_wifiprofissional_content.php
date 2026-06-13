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

$s = function (string $key) use ($body): string {
    return trim((string) ($body[$key] ?? ''));
};

function sanitize_str_arr_wp(array $arr, int $max): array {
    return array_values(array_slice(
        array_map(function ($v) { return trim((string) $v); }, $arr),
        0, $max
    ));
}

function sanitize_titulotext_wp(array $item): array {
    return [
        'titulo' => trim((string) ($item['titulo'] ?? '')),
        'texto'  => trim((string) ($item['texto']  ?? '')),
    ];
}

function sanitize_feat_card_wp(array $item): array {
    return [
        'titulo' => trim((string) ($item['titulo'] ?? '')),
        'texto'  => trim((string) ($item['texto']  ?? '')),
        'imagem' => trim((string) ($item['imagem'] ?? '')),
    ];
}

$content = [
    'cmp_prob_titulo' => $s('cmp_prob_titulo'),
    'cmp_prob_texto'  => $s('cmp_prob_texto'),
    'cmp_prob_items'  => sanitize_str_arr_wp($body['cmp_prob_items'] ?? [], 5),
    'cmp_imagem'      => $s('cmp_imagem'),
    'cmp_sol_titulo'  => $s('cmp_sol_titulo'),
    'cmp_sol_texto'   => $s('cmp_sol_texto'),
    'cmp_sol_items'   => sanitize_str_arr_wp($body['cmp_sol_items'] ?? [], 5),

    'steps_titulo' => $s('steps_titulo'),
    'steps_texto'  => $s('steps_texto'),
    'steps'        => array_map('sanitize_titulotext_wp', array_slice(array_filter($body['steps'] ?? [], 'is_array'), 0, 5)),

    'plan_titulo'    => $s('plan_titulo'),
    'plan_preco'     => $s('plan_preco'),
    'plan_items'     => sanitize_str_arr_wp($body['plan_items'] ?? [], 5),
    'plan_adicional' => $s('plan_adicional'),
    'plan_imagem'    => $s('plan_imagem'),

    'aud_titulo' => $s('aud_titulo'),
    'aud_texto'  => $s('aud_texto'),
    'aud_items'  => sanitize_str_arr_wp($body['aud_items'] ?? [], 8),

    'feat_titulo' => $s('feat_titulo'),
    'feat_cards'  => array_map('sanitize_feat_card_wp', array_slice(array_filter($body['feat_cards'] ?? [], 'is_array'), 0, 3)),
];

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('wifiprofissional_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteúdo salvo com sucesso.']);
