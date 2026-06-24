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

function sanitize_bullets_res($arr): array {
    if (!is_array($arr)) return [];
    return array_values(array_filter(
        array_map(function ($b) { return trim((string) $b); }, array_slice($arr, 0, 5)),
        'strlen'
    ));
}

function sanitize_plan_res(array $plan): array {
    return [
        'nome'     => trim((string) ($plan['nome']     ?? '')),
        'descricao'=> trim((string) ($plan['descricao'] ?? '')),
        'bullets'  => sanitize_bullets_res($plan['bullets'] ?? []),
        'preco'    => trim((string) ($plan['preco']    ?? '')),
        'featured' => !empty($plan['featured']),
    ];
}

function sanitize_suporte_item(array $item): array {
    return [
        'titulo' => trim((string) ($item['titulo'] ?? '')),
        'texto'  => trim((string) ($item['texto']  ?? '')),
    ];
}

$rawPlanos  = is_array($body['planos']  ?? null) ? $body['planos']  : [];
$rawSuporte = is_array($body['suporte'] ?? null) ? $body['suporte'] : [];

$content = [
    'diagnostico_titulo'  => trim((string) ($body['diagnostico_titulo']  ?? '')),
    'diagnostico_texto'   => trim((string) ($body['diagnostico_texto']   ?? '')),
    'diagnostico_imagem'  => trim((string) ($body['diagnostico_imagem']  ?? '')),
    'solucao_titulo'      => trim((string) ($body['solucao_titulo']      ?? '')),
    'solucao_texto'       => trim((string) ($body['solucao_texto']       ?? '')),
    'solucao_bullets'     => sanitize_bullets_res($body['solucao_bullets'] ?? []),
    'planos_titulo'       => trim((string) ($body['planos_titulo']       ?? '')),
    'planos'              => array_map('sanitize_plan_res',    array_slice(array_filter($rawPlanos,  'is_array'), 0, 3)),
    'suporte'             => array_map('sanitize_suporte_item', array_slice(array_filter($rawSuporte, 'is_array'), 0, 4)),
];

// Garante no máximo 1 plano com destaque, mesmo que o payload chegue com mais de um marcado
$featuredFound = false;
foreach ($content['planos'] as $idx => $plano) {
    if (!$plano['featured']) continue;
    if ($featuredFound) {
        $content['planos'][$idx]['featured'] = false;
    } else {
        $featuredFound = true;
    }
}

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('residencial_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteúdo salvo com sucesso.']);
