<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) session_start();

require_once dirname(__FILE__, 3) . '/response.php';

if (empty($_SESSION['usuario'])) {
    json_response(['ok' => false, 'message' => 'Nao autorizado.'], 401);
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['ok' => false, 'message' => 'Metodo nao permitido.'], 405);
}
if (!in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor'])) {
    json_response(['ok' => false, 'message' => 'Permissao negada.'], 403);
}

$body = read_json();

$s = function (string $key) use ($body): string {
    return trim((string) ($body[$key] ?? ''));
};

function sanitize_str_arr_ld(array $arr, int $max): array {
    return array_values(array_slice(
        array_map(function ($v) { return trim((string) $v); }, $arr),
        0,
        $max
    ));
}

function sanitize_titulotext_ld(array $item): array {
    return [
        'titulo' => trim((string) ($item['titulo'] ?? '')),
        'texto'  => trim((string) ($item['texto']  ?? '')),
    ];
}

function sanitize_img_card_ld(array $item): array {
    return [
        'titulo' => trim((string) ($item['titulo'] ?? '')),
        'texto'  => trim((string) ($item['texto']  ?? '')),
        'imagem' => trim((string) ($item['imagem'] ?? '')),
    ];
}

$content = [
    'problem_titulo' => $s('problem_titulo'),
    'problem_texto'  => $s('problem_texto'),
    'problem_items'  => sanitize_str_arr_ld($body['problem_items'] ?? [], 4),
    'problem_imagem' => $s('problem_imagem'),

    'exclusive_titulo' => $s('exclusive_titulo'),
    'exclusive_texto'  => $s('exclusive_texto'),
    'exclusive_cards'  => array_map('sanitize_titulotext_ld', array_slice(array_filter($body['exclusive_cards'] ?? [], 'is_array'), 0, 4)),

    'aud_titulo' => $s('aud_titulo'),
    'aud_texto'  => $s('aud_texto'),
    'aud_items'  => sanitize_str_arr_ld($body['aud_items'] ?? [], 7),

    'feat_titulo' => $s('feat_titulo'),
    'feat_cards'  => array_map('sanitize_titulotext_ld', array_slice(array_filter($body['feat_cards'] ?? [], 'is_array'), 0, 4)),

    'integration_titulo' => $s('integration_titulo'),
    'integration_texto'  => $s('integration_texto'),
    'integration_cards'  => array_map('sanitize_img_card_ld', array_slice(array_filter($body['integration_cards'] ?? [], 'is_array'), 0, 4)),

    'benefits_titulo' => $s('benefits_titulo'),
    'benefit_cards'   => array_map('sanitize_titulotext_ld', array_slice(array_filter($body['benefit_cards'] ?? [], 'is_array'), 0, 4)),

    'trust_google' => $s('trust_google'),
    'trust_items'  => sanitize_str_arr_ld($body['trust_items'] ?? [], 3),
];

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('linkdedicado_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteudo salvo com sucesso.']);
