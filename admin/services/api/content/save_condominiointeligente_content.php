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

function sanitize_label_items_ci(array $items, int $count): array {
    $out = [];
    for ($i = 0; $i < $count; $i++) {
        $item = is_array($items[$i] ?? null) ? $items[$i] : [];
        $out[] = ['label' => trim((string) ($item['label'] ?? ''))];
    }
    return $out;
}

function sanitize_text_items_ci(array $items, int $count): array {
    $out = [];
    for ($i = 0; $i < $count; $i++) {
        $item = is_array($items[$i] ?? null) ? $items[$i] : [];
        $out[] = ['titulo' => trim((string) ($item['titulo'] ?? '')), 'texto' => trim((string) ($item['texto'] ?? ''))];
    }
    return $out;
}

function sanitize_benefit_items_ci(array $items, int $count): array {
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
    'complete_titulo' => $s('complete_titulo'),
    'complete_texto'  => $s('complete_texto'),
    'complete_items'  => sanitize_text_items_ci(is_array($body['complete_items'] ?? null) ? $body['complete_items'] : [], 6),

    'benefits_titulo' => $s('benefits_titulo'),
    'benefits_items'  => sanitize_benefit_items_ci(is_array($body['benefits_items'] ?? null) ? $body['benefits_items'] : [], 4),

    'integrations_titulo' => $s('integrations_titulo'),
    'integrations_items'  => sanitize_label_items_ci(is_array($body['integrations_items'] ?? null) ? $body['integrations_items'] : [], 6),

    'steps_titulo' => $s('steps_titulo'),
    'steps_items'  => sanitize_text_items_ci(is_array($body['steps_items'] ?? null) ? $body['steps_items'] : [], 4),

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
     VALUES ('condominiointeligente_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteudo salvo com sucesso.']);
