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

function sanitize_titulotext_sk(array $item): array {
    return [
        'titulo' => trim((string) ($item['titulo'] ?? '')),
        'texto'  => trim((string) ($item['texto']  ?? '')),
    ];
}

function sanitize_routine_card_sk(array $item): array {
    return [
        'titulo' => trim((string) ($item['titulo'] ?? '')),
        'texto'  => trim((string) ($item['texto']  ?? '')),
        'imagem' => trim((string) ($item['imagem'] ?? '')),
    ];
}

$content = [
    'moments_span'     => $s('moments_span'),
    'moments_titulo'   => $s('moments_titulo'),
    'moments_features' => array_map('sanitize_titulotext_sk', array_slice(array_filter($body['moments_features'] ?? [], 'is_array'), 0, 6)),

    'routine_span'  => $s('routine_span'),
    'routine_titulo'=> $s('routine_titulo'),
    'routine_texto' => $s('routine_texto'),
    'routine_cards' => array_map('sanitize_routine_card_sk', array_slice(array_filter($body['routine_cards'] ?? [], 'is_array'), 0, 4)),

    'how_span'  => $s('how_span'),
    'how_steps' => array_map('sanitize_titulotext_sk', array_slice(array_filter($body['how_steps'] ?? [], 'is_array'), 0, 3)),

    'benefits_titulo' => $s('benefits_titulo'),
    'benefits' => array_map('sanitize_titulotext_sk', array_slice(array_filter($body['benefits'] ?? [], 'is_array'), 0, 4)),

    'trust_google' => $s('trust_google'),
    'trust_item1'  => $s('trust_item1'),
    'trust_item2'  => $s('trust_item2'),
];

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('skeelo_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteúdo salvo com sucesso.']);
