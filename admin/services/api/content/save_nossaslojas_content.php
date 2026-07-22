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

function sanitize_store_cb(array $item): array {
    return [
        'titulo'     => trim((string) ($item['titulo'] ?? '')),
        'endereco'   => trim((string) ($item['endereco'] ?? '')),
        'cidade'     => trim((string) ($item['cidade'] ?? '')),
        'maps_query' => trim((string) ($item['maps_query'] ?? '')),
        'horario1'   => trim((string) ($item['horario1'] ?? '')),
        'horario2'   => trim((string) ($item['horario2'] ?? '')),
        'imagem'     => trim((string) ($item['imagem'] ?? '')),
    ];
}

$stores = [];
foreach (array_slice(array_filter($body['stores'] ?? [], 'is_array'), 0, 30) as $item) {
    $store = sanitize_store_cb($item);
    if ($store['titulo'] === '') continue;
    $stores[] = $store;
}

$content = [
    'section_titulo' => $s('section_titulo'),
    'section_texto'  => $s('section_texto'),

    'stores' => $stores,

    'expansion_titulo'          => $s('expansion_titulo'),
    'expansion_titulo_destaque' => $s('expansion_titulo_destaque'),
    'expansion_texto'           => $s('expansion_texto'),

    'closing_titulo'          => $s('closing_titulo'),
    'closing_titulo_destaque' => $s('closing_titulo_destaque'),
    'closing_texto'           => $s('closing_texto'),
    'closing_imagem'          => $s('closing_imagem'),
];

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('nossaslojas_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteudo salvo com sucesso.']);
