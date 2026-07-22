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

function sanitize_label_items_cd(array $items, int $count): array {
    $out = [];
    for ($i = 0; $i < $count; $i++) {
        $item = is_array($items[$i] ?? null) ? $items[$i] : [];
        $out[] = ['label' => trim((string) ($item['label'] ?? ''))];
    }
    return $out;
}

function sanitize_audience_items_cd(array $items, int $count): array {
    $out = [];
    for ($i = 0; $i < $count; $i++) {
        $item = is_array($items[$i] ?? null) ? $items[$i] : [];
        $out[] = ['label' => trim((string) ($item['label'] ?? '')), 'imagem' => trim((string) ($item['imagem'] ?? ''))];
    }
    return $out;
}

function sanitize_text_items_cd(array $items, int $count): array {
    $out = [];
    for ($i = 0; $i < $count; $i++) {
        $item = is_array($items[$i] ?? null) ? $items[$i] : [];
        $out[] = ['titulo' => trim((string) ($item['titulo'] ?? '')), 'texto' => trim((string) ($item['texto'] ?? ''))];
    }
    return $out;
}

$content = [
    'intro_titulo' => $s('intro_titulo'),
    'intro_texto'  => $s('intro_texto'),

    'technologies_titulo' => $s('technologies_titulo'),
    'technologies_items'  => sanitize_label_items_cd(is_array($body['technologies_items'] ?? null) ? $body['technologies_items'] : [], 8),

    'audiences_titulo' => $s('audiences_titulo'),
    'audiences_items'  => sanitize_audience_items_cd(is_array($body['audiences_items'] ?? null) ? $body['audiences_items'] : [], 5),

    'benefits_titulo' => $s('benefits_titulo'),
    'benefits_items'  => sanitize_text_items_cd(is_array($body['benefits_items'] ?? null) ? $body['benefits_items'] : [], 4),

    'app_titulo'  => $s('app_titulo'),
    'app_imagem'  => $s('app_imagem'),
    'app_texto'   => $s('app_texto'),
    'app_features_items' => sanitize_text_items_cd(is_array($body['app_features_items'] ?? null) ? $body['app_features_items'] : [], 5),

    'flow_titulo' => $s('flow_titulo'),
    'flow_items'  => sanitize_text_items_cd(is_array($body['flow_items'] ?? null) ? $body['flow_items'] : [], 5),

    'integrations_titulo' => $s('integrations_titulo'),
    'integrations_items'  => sanitize_label_items_cd(is_array($body['integrations_items'] ?? null) ? $body['integrations_items'] : [], 6),

    'equipment_titulo'    => $s('equipment_titulo'),
    'equipment_texto'     => $s('equipment_texto'),
    'equipment_btn_texto' => $s('equipment_btn_texto'),
    'equipment_imagem'    => $s('equipment_imagem'),
    'equipment_logo'      => $s('equipment_logo'),

    'how_titulo' => $s('how_titulo'),
    'how_items'  => sanitize_text_items_cd(is_array($body['how_items'] ?? null) ? $body['how_items'] : [], 5),

    'cta_titulo'          => $s('cta_titulo'),
    'cta_titulo_destaque' => $s('cta_titulo_destaque'),
    'cta_texto'           => $s('cta_texto'),
    'cta_btn1_texto'      => $s('cta_btn1_texto'),
    'cta_btn2_texto'      => $s('cta_btn2_texto'),
];

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('controleconcominial_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteudo salvo com sucesso.']);
