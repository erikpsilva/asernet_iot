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

function sanitize_arr_wm($arr, int $max): array {
    if (!is_array($arr)) return [];
    return array_values(array_slice(
        array_map(function ($v) { return trim((string) $v); }, $arr),
        0, $max
    ));
}

function sanitize_porque_item(array $item): array {
    return [
        'titulo' => trim((string) ($item['titulo'] ?? '')),
        'texto'  => trim((string) ($item['texto']  ?? '')),
    ];
}

$content = [
    'dor_titulo'  => $s('dor_titulo'),
    'dor_titulo2' => $s('dor_titulo2'),
    'dor_items'   => sanitize_arr_wm($body['dor_items']  ?? [], 5),

    'tech_titulo'  => $s('tech_titulo'),
    'tech_texto'   => $s('tech_texto'),
    'tech_bullets' => sanitize_arr_wm($body['tech_bullets'] ?? [], 5),
    'tech_imagem'  => $s('tech_imagem'),

    'como_titulo' => $s('como_titulo'),
    'como_texto'  => $s('como_texto'),
    'como_steps'  => sanitize_arr_wm($body['como_steps'] ?? [], 4),

    'porque_titulo' => $s('porque_titulo'),
    'porque_items'  => array_map('sanitize_porque_item', array_slice(array_filter($body['porque_items'] ?? [], 'is_array'), 0, 4)),

    'ideal_titulo' => $s('ideal_titulo'),
    'ideal_items'  => sanitize_arr_wm($body['ideal_items'] ?? [], 6),

    'perf_titulo'  => $s('perf_titulo'),
    'perf_texto'   => $s('perf_texto'),
    'perf_imagem'  => $s('perf_imagem'),
    'perf_bullets' => sanitize_arr_wm($body['perf_bullets'] ?? [], 4),
];

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('wifimesh_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteúdo salvo com sucesso.']);
