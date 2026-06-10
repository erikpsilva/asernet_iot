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

if (empty($body['categorias']) || !is_array($body['categorias'])) {
    json_response(['ok' => false, 'message' => 'Dados inválidos.'], 400);
}

$categorias = [];
foreach (array_slice($body['categorias'], 0, 10) as $cat) {
    if (!is_array($cat)) continue;
    $perguntas = [];
    if (!empty($cat['perguntas']) && is_array($cat['perguntas'])) {
        foreach (array_slice($cat['perguntas'], 0, 50) as $pq) {
            if (!is_array($pq)) continue;
            $q = trim((string) ($pq['q'] ?? ''));
            $a = trim((string) ($pq['a'] ?? ''));
            if ($q !== '' || $a !== '') {
                $perguntas[] = ['q' => $q, 'a' => $a];
            }
        }
    }
    $categorias[] = [
        'id'             => preg_replace('/[^a-z0-9_-]/', '', strtolower((string) ($cat['id'] ?? ''))),
        'icone'          => preg_replace('/[^a-z0-9_-]/', '', (string) ($cat['icone'] ?? '')),
        'card_modifiers' => preg_replace('/[^a-z0-9_ -]/', '', (string) ($cat['card_modifiers'] ?? '')),
        'titulo'         => substr(trim((string) ($cat['titulo'] ?? '')), 0, 120),
        'descricao'      => substr(trim((string) ($cat['descricao'] ?? '')), 0, 200),
        'perguntas'      => $perguntas,
    ];
}

require_once dirname(__FILE__, 5) . '/config/database.php';
$pdo = getDbConnection();
$pdo->prepare(
    "INSERT INTO system_settings (setting_key, setting_value)
     VALUES ('faq_content', ?)
     ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
)->execute([json_encode(['categorias' => $categorias], JSON_UNESCAPED_UNICODE)]);

json_response(['ok' => true, 'message' => 'Conteúdo salvo com sucesso.']);
