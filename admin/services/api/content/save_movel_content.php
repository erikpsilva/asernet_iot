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

function sanitize_arr_mv(array $arr, int $max = 5): array {
    return array_values(array_slice(
        array_map(function ($v) { return trim((string) $v); }, $arr),
        0, $max
    ));
}

function sanitize_plan_mv(array $p): array {
    return [
        'nome'      => trim((string) ($p['nome']      ?? '')),
        'subtitulo' => trim((string) ($p['subtitulo'] ?? '')),
        'preco'     => trim((string) ($p['preco']     ?? '')),
        'bullets'   => sanitize_arr_mv($p['bullets'] ?? []),
        'featured'  => (bool) ($p['featured'] ?? false),
    ];
}

function sanitize_beneficio_mv(array $b): array {
    return [
        'titulo' => trim((string) ($b['titulo'] ?? '')),
        'texto'  => trim((string) ($b['texto']  ?? '')),
    ];
}

function sanitize_step_mv(array $s): array {
    return [
        'titulo' => trim((string) ($s['titulo'] ?? '')),
        'texto'  => trim((string) ($s['texto']  ?? '')),
    ];
}

function sanitize_eco_mv(array $e): array {
    return [
        'texto'  => trim((string) ($e['texto']  ?? '')),
        'imagem' => trim((string) ($e['imagem'] ?? '')),
    ];
}

$content = [
    'rotina_titulo' => $s('rotina_titulo'),
    'rotina_items'  => sanitize_arr_mv($body['rotina_items'] ?? [], 5),

    'planos_titulo'        => $s('planos_titulo'),
    'planos_portabilidade' => $s('planos_portabilidade'),
    'planos' => array_map('sanitize_plan_mv', array_slice(array_filter($body['planos'] ?? [], 'is_array'), 0, 3)),

    'beneficios_titulo' => $s('beneficios_titulo'),
    'beneficios' => array_map('sanitize_beneficio_mv', array_slice(array_filter($body['beneficios'] ?? [], 'is_array'), 0, 4)),

    'como_titulo' => $s('como_titulo'),
    'como_steps'  => array_map('sanitize_step_mv', array_slice(array_filter($body['como_steps'] ?? [], 'is_array'), 0, 4)),

    'eco_titulo'   => $s('eco_titulo'),
    'eco_resultado'=> $s('eco_resultado'),
    'eco_items'    => array_map('sanitize_eco_mv', array_slice(array_filter($body['eco_items'] ?? [], 'is_array'), 0, 3)),

    'trust_google' => $s('trust_google'),
    'trust_item1'  => $s('trust_item1'),
    'trust_item2'  => $s('trust_item2'),
];

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('movel_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteúdo salvo com sucesso.']);
