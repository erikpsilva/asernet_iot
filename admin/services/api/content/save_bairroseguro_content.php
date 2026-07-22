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

function sanitize_str_arr_bs(array $arr, int $max): array {
    $out = [];
    foreach ($arr as $v) {
        $v = trim((string) $v);
        if ($v !== '') $out[] = $v;
        if (count($out) >= $max) break;
    }
    return $out;
}

function sanitize_label_items_bs(array $items, int $count): array {
    $out = [];
    for ($i = 0; $i < $count; $i++) {
        $item = is_array($items[$i] ?? null) ? $items[$i] : [];
        $out[] = ['label' => trim((string) ($item['label'] ?? ''))];
    }
    return $out;
}

function sanitize_text_items_bs(array $items, int $count): array {
    $out = [];
    for ($i = 0; $i < $count; $i++) {
        $item = is_array($items[$i] ?? null) ? $items[$i] : [];
        $out[] = ['titulo' => trim((string) ($item['titulo'] ?? '')), 'texto' => trim((string) ($item['texto'] ?? ''))];
    }
    return $out;
}

function sanitize_step_items_bs(array $items, int $count): array {
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

function sanitize_faq_items_bs(array $items, int $count): array {
    $out = [];
    for ($i = 0; $i < $count; $i++) {
        $item = is_array($items[$i] ?? null) ? $items[$i] : [];
        $out[] = ['pergunta' => trim((string) ($item['pergunta'] ?? '')), 'resposta' => trim((string) ($item['resposta'] ?? ''))];
    }
    return $out;
}

$content = [
    'shared_titulo'             => $s('shared_titulo'),
    'shared_titulo_complemento' => $s('shared_titulo_complemento'),
    'shared_texto1'             => $s('shared_texto1'),
    'shared_texto2'             => $s('shared_texto2'),
    'shared_texto3'             => $s('shared_texto3'),
    'shared_imagem'             => $s('shared_imagem'),

    'steps_titulo' => $s('steps_titulo'),
    'steps_items'  => sanitize_step_items_bs(is_array($body['steps_items'] ?? null) ? $body['steps_items'] : [], 4),

    'audiences_titulo' => $s('audiences_titulo'),
    'audiences_items'  => sanitize_label_items_bs(is_array($body['audiences_items'] ?? null) ? $body['audiences_items'] : [], 6),

    'included_titulo' => $s('included_titulo'),
    'included_items'  => sanitize_str_arr_bs(is_array($body['included_items'] ?? null) ? $body['included_items'] : [], 12),
    'included_imagem' => $s('included_imagem'),

    'advantages_titulo' => $s('advantages_titulo'),
    'advantages_items'  => sanitize_text_items_bs(is_array($body['advantages_items'] ?? null) ? $body['advantages_items'] : [], 4),

    'faq_titulo' => $s('faq_titulo'),
    'faq_items'  => sanitize_faq_items_bs(is_array($body['faq_items'] ?? null) ? $body['faq_items'] : [], 4),

    'cta_titulo'             => $s('cta_titulo'),
    'cta_titulo_complemento' => $s('cta_titulo_complemento'),
    'cta_texto'              => $s('cta_texto'),
    'cta_btn1_texto'         => $s('cta_btn1_texto'),
    'cta_btn2_texto'         => $s('cta_btn2_texto'),
];

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('bairroseguro_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteudo salvo com sucesso.']);
