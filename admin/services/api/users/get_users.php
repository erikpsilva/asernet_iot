<?php
declare(strict_types=1);

require_once dirname(__FILE__, 3) . '/_session.php';

require_once dirname(__FILE__, 3) . '/response.php';

if (empty($_SESSION['usuario'])) {
    json_response(['ok' => false, 'message' => 'Não autorizado.'], 401);
}
if ($_SESSION['usuario']['nivel_acesso'] !== 'admin') {
    json_response(['ok' => false, 'message' => 'Permissão negada.'], 403);
}

require_once dirname(__FILE__, 5) . '/config/database.php';

$pdo  = getDbConnection();
$stmt = $pdo->query("SELECT id, nome_completo, email, cpf, nivel_acesso FROM admin_usuarios ORDER BY nome_completo ASC");
$rows = $stmt->fetchAll();

json_response(['ok' => true, 'users' => $rows]);
