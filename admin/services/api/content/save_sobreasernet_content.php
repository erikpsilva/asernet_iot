<?php
declare(strict_types=1);

require_once dirname(__FILE__, 3) . '/_session.php';

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

function sanitize_str_arr_sa(array $arr, int $max): array {
    return array_values(array_slice(array_map(function ($v) {
        return trim((string) $v);
    }, $arr), 0, $max));
}

function sanitize_titulotext_sa(array $item): array {
    return [
        'titulo' => trim((string) ($item['titulo'] ?? '')),
        'texto'  => trim((string) ($item['texto'] ?? '')),
    ];
}

function sanitize_img_card_sa(array $item): array {
    return [
        'titulo' => trim((string) ($item['titulo'] ?? '')),
        'texto'  => trim((string) ($item['texto'] ?? '')),
        'imagem' => trim((string) ($item['imagem'] ?? '')),
    ];
}

$content = [
    'history_label' => $s('history_label'),
    'history_titulo' => $s('history_titulo'),
    'history_textos' => sanitize_str_arr_sa($body['history_textos'] ?? [], 2),
    'history_imagem' => $s('history_imagem'),

    'belief_label' => $s('belief_label'),
    'belief_titulo' => $s('belief_titulo'),
    'belief_texto' => $s('belief_texto'),
    'belief_cards' => array_map('sanitize_titulotext_sa', array_slice(array_filter($body['belief_cards'] ?? [], 'is_array'), 0, 4)),

    'solutions_label' => $s('solutions_label'),
    'solutions_titulo' => $s('solutions_titulo'),
    'solutions_cards' => array_map('sanitize_img_card_sa', array_slice(array_filter($body['solutions_cards'] ?? [], 'is_array'), 0, 4)),

    'trust_google' => $s('trust_google'),
    'trust_items' => sanitize_str_arr_sa($body['trust_items'] ?? [], 3),

    'diff_label' => $s('diff_label'),
    'diff_titulo' => $s('diff_titulo'),
    'diff_cards' => array_map('sanitize_titulotext_sa', array_slice(array_filter($body['diff_cards'] ?? [], 'is_array'), 0, 4)),

    'team_label' => $s('team_label'),
    'team_titulo' => $s('team_titulo'),
    'team_images' => sanitize_str_arr_sa($body['team_images'] ?? [], 5),

    'purpose_label' => $s('purpose_label'),
    'purpose_titulo' => $s('purpose_titulo'),
    'purpose_texto' => $s('purpose_texto'),
    'purpose_items' => sanitize_str_arr_sa($body['purpose_items'] ?? [], 4),
];

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('sobreasernet_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteudo salvo com sucesso.']);
