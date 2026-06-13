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
if ($_SESSION['usuario']['nivel_acesso'] !== 'admin') {
    json_response(['ok' => false, 'message' => 'Permissão negada.'], 403);
}

require_once dirname(__FILE__, 5) . '/config/database.php';

$body         = read_json();
$id           = (int) ($body['id']            ?? 0);
$nomeCompleto = trim($body['nome_completo']   ?? '');
$email        = trim($body['email']           ?? '');
$cpf          = preg_replace('/\D/', '', $body['cpf'] ?? '');
$nivel        = trim($body['nivel_acesso']    ?? '');
$novaSenha    = $body['nova_senha']           ?? '';

if ($id < 1)                                              json_response(['ok' => false, 'message' => 'ID inválido.'], 400);
if (mb_strlen($nomeCompleto) < 3)                         json_response(['ok' => false, 'message' => 'Nome muito curto.'], 400);
if (!filter_var($email, FILTER_VALIDATE_EMAIL))           json_response(['ok' => false, 'message' => 'E-mail inválido.'], 400);
if (strlen($cpf) !== 11)                                  json_response(['ok' => false, 'message' => 'CPF inválido.'], 400);
if (!in_array($nivel, ['admin', 'editor', 'leitor'], true)) json_response(['ok' => false, 'message' => 'Nível inválido.'], 400);

$pdo = getDbConnection();

// Check email/CPF not used by another user
$stmt = $pdo->prepare("SELECT id FROM admin_usuarios WHERE (email = ? OR cpf = ?) AND id != ? LIMIT 1");
$stmt->execute([$email, $cpf, $id]);
if ($stmt->fetch()) {
    json_response(['ok' => false, 'message' => 'E-mail ou CPF já pertence a outro usuário.'], 409);
}

// If changing own level away from admin, ensure at least one other admin remains
if ($id === (int) $_SESSION['usuario']['id'] && $nivel !== 'admin') {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM admin_usuarios WHERE nivel_acesso = 'admin' AND id != ?");
    $stmt->execute([$id]);
    if ((int) $stmt->fetchColumn() === 0) {
        json_response(['ok' => false, 'message' => 'Não é possível rebaixar o único administrador do sistema.'], 409);
    }
}

if ($novaSenha !== '') {
    if (strlen($novaSenha) < 6 || strlen($novaSenha) > 20) {
        json_response(['ok' => false, 'message' => 'A nova senha deve ter entre 6 e 20 caracteres.'], 400);
    }
    $hash = password_hash($novaSenha, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("UPDATE admin_usuarios SET nome_completo = ?, email = ?, cpf = ?, nivel_acesso = ?, senha = ? WHERE id = ?");
    $stmt->execute([$nomeCompleto, $email, $cpf, $nivel, $hash, $id]);
} else {
    $stmt = $pdo->prepare("UPDATE admin_usuarios SET nome_completo = ?, email = ?, cpf = ?, nivel_acesso = ? WHERE id = ?");
    $stmt->execute([$nomeCompleto, $email, $cpf, $nivel, $id]);
}

// Refresh session if editing own data
if ($id === (int) $_SESSION['usuario']['id']) {
    $_SESSION['usuario']['nome_completo'] = $nomeCompleto;
    $_SESSION['usuario']['email']         = $email;
    $_SESSION['usuario']['nivel_acesso']  = $nivel;
}

json_response(['ok' => true, 'message' => 'Usuário atualizado com sucesso.']);
