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

function sanitize_str_arr_cb(array $arr, int $max): array {
    return array_values(array_slice(array_map(function ($v) {
        return trim((string) $v);
    }, $arr), 0, $max));
}

function sanitize_combo_card_cb(array $item, bool $withBadge = false): array {
    $out = [
        'titulo'  => trim((string) ($item['titulo'] ?? '')),
        'texto'   => trim((string) ($item['texto'] ?? '')),
        'imagem'  => trim((string) ($item['imagem'] ?? '')),
        'bullets' => sanitize_str_arr_cb(is_array($item['bullets'] ?? null) ? $item['bullets'] : [], 4),
    ];
    if ($withBadge) $out['badge'] = trim((string) ($item['badge'] ?? ''));
    return $out;
}

$resCards = [];
foreach (array_slice(array_filter($body['res_cards'] ?? [], 'is_array'), 0, 2) as $item) {
    $resCards[] = sanitize_combo_card_cb($item, true);
}

$bizCards = [];
foreach (array_slice(array_filter($body['biz_cards'] ?? [], 'is_array'), 0, 3) as $item) {
    $bizCards[] = sanitize_combo_card_cb($item, false);
}

$connCard = sanitize_combo_card_cb(is_array($body['conn_card'] ?? null) ? $body['conn_card'] : [], false);

$content = [
    'intro_titulo' => $s('intro_titulo'),
    'intro_texto'  => $s('intro_texto'),

    'res_titulo' => $s('res_titulo'),
    'res_texto'  => $s('res_texto'),
    'res_cards'  => $resCards,

    'biz_titulo' => $s('biz_titulo'),
    'biz_texto'  => $s('biz_texto'),
    'biz_cards'  => $bizCards,

    'conn_titulo' => $s('conn_titulo'),
    'conn_texto'  => $s('conn_texto'),
    'conn_card'   => $connCard,
    'custom_titulo' => $s('custom_titulo'),
    'custom_texto'  => $s('custom_texto'),

    'trust_google' => $s('trust_google'),
    'trust_items'  => sanitize_str_arr_cb($body['trust_items'] ?? [], 3),
];

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('combo_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteudo salvo com sucesso.']);
