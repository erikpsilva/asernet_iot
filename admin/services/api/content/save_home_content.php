<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) session_start();

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

$allowed_card_keys = ['titulo', 'descricao', 'imagem', 'link_texto', 'link_href'];

function sanitize_card(array $card): array {
    global $allowed_card_keys;
    $out = [];
    foreach ($allowed_card_keys as $k) {
        $out[$k] = isset($card[$k]) ? trim((string) $card[$k]) : '';
    }
    return $out;
}

function sanitize_card_array($arr, int $expected): array {
    if (!is_array($arr)) return [];
    $out = [];
    foreach (array_slice($arr, 0, $expected) as $card) {
        $out[] = sanitize_card(is_array($card) ? $card : []);
    }
    return $out;
}

$content = [
    'intro_titulo'    => trim((string) ($body['intro_titulo'] ?? '')),
    'intro_subtitulo' => trim((string) ($body['intro_subtitulo'] ?? '')),
    'cards_casa'      => sanitize_card_array($body['cards_casa'] ?? [], 4),
    'cards_empresa'   => sanitize_card_array($body['cards_empresa'] ?? [], 4),
    'cards_seguranca' => sanitize_card_array($body['cards_seguranca'] ?? [], 2),
];

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('home_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode($content, JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteúdo salvo com sucesso.']);
