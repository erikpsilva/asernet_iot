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

function sanitize_str_arr_pe(array $arr, int $max): array {
    return array_values(array_slice(
        array_map(function ($v) { return trim((string) $v); }, $arr),
        0, $max
    ));
}

function sanitize_titulotext_pe(array $item): array {
    return [
        'titulo' => trim((string) ($item['titulo'] ?? '')),
        'texto'  => trim((string) ($item['texto']  ?? '')),
    ];
}

function sanitize_sol_card_pe(array $item): array {
    return [
        'titulo' => trim((string) ($item['titulo'] ?? '')),
        'texto'  => trim((string) ($item['texto']  ?? '')),
        'imagem' => trim((string) ($item['imagem'] ?? '')),
    ];
}

$content = [
    'prob_titulo' => $s('prob_titulo'),
    'prob_texto'  => $s('prob_texto'),
    'prob_items'  => sanitize_str_arr_pe($body['prob_items'] ?? [], 5),

    'int_titulo'  => $s('int_titulo'),
    'int_texto'   => $s('int_texto'),
    'int_bullets' => sanitize_str_arr_pe($body['int_bullets'] ?? [], 4),

    'sol_titulo' => $s('sol_titulo'),
    'sol_cards'  => array_map('sanitize_sol_card_pe', array_slice(array_filter($body['sol_cards'] ?? [], 'is_array'), 0, 5)),

    'why_titulo' => $s('why_titulo'),
    'why_items'  => array_map('sanitize_titulotext_pe', array_slice(array_filter($body['why_items'] ?? [], 'is_array'), 0, 4)),

    'aud_titulo' => $s('aud_titulo'),
    'aud_items'  => sanitize_str_arr_pe($body['aud_items'] ?? [], 7),

    'tech_titulo' => $s('tech_titulo'),
    'tech_texto'  => $s('tech_texto'),

    'ben_titulo' => $s('ben_titulo'),
    'ben_items'  => array_map('sanitize_titulotext_pe', array_slice(array_filter($body['ben_items'] ?? [], 'is_array'), 0, 4)),

    'trust_google' => $s('trust_google'),
    'trust_items'  => sanitize_str_arr_pe($body['trust_items'] ?? [], 4),
];

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('paraempresas_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteúdo salvo com sucesso.']);
