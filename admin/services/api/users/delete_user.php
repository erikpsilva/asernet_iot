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
if ($_SESSION['usuario']['nivel_acesso'] !== 'admin') {
    json_response(['ok' => false, 'message' => 'Permissão negada.'], 403);
}

require_once dirname(__FILE__, 5) . '/config/database.php';

$body = read_json();
$id   = (int) ($body['id'] ?? 0);

if ($id < 1) {
    json_response(['ok' => false, 'message' => 'ID inválido.'], 400);
}

// Cannot delete own account
if ($id === (int) $_SESSION['usuario']['id']) {
    json_response(['ok' => false, 'message' => 'Você não pode excluir sua própria conta.'], 409);
}

$pdo = getDbConnection();

// Cannot delete last admin
$stmt = $pdo->prepare("SELECT nivel_acesso FROM admin_usuarios WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$target = $stmt->fetch();

if (!$target) {
    json_response(['ok' => false, 'message' => 'Usuário não encontrado.'], 404);
}

if ($target['nivel_acesso'] === 'admin') {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM admin_usuarios WHERE nivel_acesso = 'admin'");
    $stmt->execute();
    if ((int) $stmt->fetchColumn() <= 1) {
        json_response(['ok' => false, 'message' => 'Não é possível excluir o único administrador do sistema.'], 409);
    }
}

$stmt = $pdo->prepare("DELETE FROM admin_usuarios WHERE id = ?");
$stmt->execute([$id]);

json_response(['ok' => true, 'message' => 'Usuário excluído com sucesso.']);
