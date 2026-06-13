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

function sanitize_bullets_cam($arr, int $max = 5): array {
    if (!is_array($arr)) return [];
    return array_values(array_filter(
        array_map(function ($b) { return trim((string) $b); }, array_slice($arr, 0, $max)),
        'strlen'
    ));
}

function sanitize_plan_cam(array $p): array {
    return [
        'nome'     => trim((string) ($p['nome']     ?? '')),
        'descricao'=> trim((string) ($p['descricao'] ?? '')),
        'imagem'   => trim((string) ($p['imagem']   ?? '')),
        'bullets'  => sanitize_bullets_cam($p['bullets'] ?? []),
        'preco'    => trim((string) ($p['preco']    ?? '')),
    ];
}

function sanitize_dif_cam(array $d): array {
    return [
        'titulo' => trim((string) ($d['titulo'] ?? '')),
        'texto'  => trim((string) ($d['texto']  ?? '')),
    ];
}

$s = function (string $key) use ($body): string {
    return trim((string) ($body[$key] ?? ''));
};

$content = [
    'dor_titulo'   => $s('dor_titulo'),
    'dor_destaque' => $s('dor_destaque'),
    'dor_items'    => sanitize_bullets_cam($body['dor_items'] ?? [], 4),

    'monitor_titulo'         => $s('monitor_titulo'),
    'monitor_texto'          => $s('monitor_texto'),
    'monitor_bullets'        => sanitize_bullets_cam($body['monitor_bullets'] ?? []),
    'monitor_imagem'         => $s('monitor_imagem'),
    'monitor_casa_titulo'    => $s('monitor_casa_titulo'),
    'monitor_casa_texto'     => $s('monitor_casa_texto'),
    'monitor_casa_imagem'    => $s('monitor_casa_imagem'),
    'monitor_empresa_titulo' => $s('monitor_empresa_titulo'),
    'monitor_empresa_texto'  => $s('monitor_empresa_texto'),
    'monitor_empresa_imagem' => $s('monitor_empresa_imagem'),

    'planos_titulo' => $s('planos_titulo'),
    'planos'        => array_map('sanitize_plan_cam', array_slice(array_filter($body['planos'] ?? [], 'is_array'), 0, 3)),

    'como_titulo'      => $s('como_titulo'),
    'como_texto'       => $s('como_texto'),
    'como_steps'       => sanitize_bullets_cam($body['como_steps'] ?? [], 4),
    'como_app_titulo'  => $s('como_app_titulo'),
    'como_app_texto'   => $s('como_app_texto'),
    'como_app_bullets' => sanitize_bullets_cam($body['como_app_bullets'] ?? [], 3),
    'como_app_imagem'  => $s('como_app_imagem'),

    'diferenciais_titulo' => $s('diferenciais_titulo'),
    'diferenciais'        => array_map('sanitize_dif_cam', array_slice(array_filter($body['diferenciais'] ?? [], 'is_array'), 0, 4)),
];

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('cameras_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteúdo salvo com sucesso.']);
