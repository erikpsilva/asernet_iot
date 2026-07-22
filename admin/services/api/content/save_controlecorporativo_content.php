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

function sanitize_label_items_cc(array $items, int $count): array {
    $out = [];
    for ($i = 0; $i < $count; $i++) {
        $item = is_array($items[$i] ?? null) ? $items[$i] : [];
        $out[] = ['label' => trim((string) ($item['label'] ?? ''))];
    }
    return $out;
}

function sanitize_text_items_cc(array $items, int $count): array {
    $out = [];
    for ($i = 0; $i < $count; $i++) {
        $item = is_array($items[$i] ?? null) ? $items[$i] : [];
        $out[] = ['titulo' => trim((string) ($item['titulo'] ?? '')), 'texto' => trim((string) ($item['texto'] ?? ''))];
    }
    return $out;
}

function sanitize_app_items_cc(array $items, int $count): array {
    $out = [];
    for ($i = 0; $i < $count; $i++) {
        $item = is_array($items[$i] ?? null) ? $items[$i] : [];
        $out[] = [
            'titulo' => trim((string) ($item['titulo'] ?? '')),
            'texto'  => trim((string) ($item['texto'] ?? '')),
            'imagem' => trim((string) ($item['imagem'] ?? '')),
        ];
    }
    return $out;
}

$content = [
    'partner_label'  => $s('partner_label'),
    'partner_texto'  => $s('partner_texto'),
    'partner_imagem' => $s('partner_imagem'),

    'intro_titulo' => $s('intro_titulo'),
    'intro_texto'  => $s('intro_texto'),

    'audiences_titulo' => $s('audiences_titulo'),
    'audiences_items'  => sanitize_label_items_cc(is_array($body['audiences_items'] ?? null) ? $body['audiences_items'] : [], 6),

    'technologies_titulo' => $s('technologies_titulo'),
    'technologies_items'  => sanitize_label_items_cc(is_array($body['technologies_items'] ?? null) ? $body['technologies_items'] : [], 8),

    'gains_titulo' => $s('gains_titulo'),
    'gains_items'  => sanitize_text_items_cc(is_array($body['gains_items'] ?? null) ? $body['gains_items'] : [], 4),

    'applications_titulo' => $s('applications_titulo'),
    'applications_items'  => sanitize_app_items_cc(is_array($body['applications_items'] ?? null) ? $body['applications_items'] : [], 4),

    'integration_titulo' => $s('integration_titulo'),
    'integration_texto'  => $s('integration_texto'),
    'integration_items'  => sanitize_label_items_cc(is_array($body['integration_items'] ?? null) ? $body['integration_items'] : [], 5),

    'equipment_titulo'          => $s('equipment_titulo'),
    'equipment_titulo_destaque' => $s('equipment_titulo_destaque'),
    'equipment_texto'           => $s('equipment_texto'),
    'equipment_btn_texto'       => $s('equipment_btn_texto'),
    'equipment_imagem'          => $s('equipment_imagem'),

    'steps_titulo' => $s('steps_titulo'),
    'steps_items'  => sanitize_text_items_cc(is_array($body['steps_items'] ?? null) ? $body['steps_items'] : [], 5),

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
     VALUES ('controlecorporativo_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteudo salvo com sucesso.']);
