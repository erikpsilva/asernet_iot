<?php include ROOT . '/admin/includes/auth_check.php'; ?>
<?php
if ($_SESSION['usuario']['nivel_acesso'] !== 'admin') {
    header('Location: ' . BASE_URL . '/admin/inicio');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Admin - Administrar Usuários</title>
<?php include ROOT . '/admin/includes/assets.php'; ?>
</head>
<body>

<?php include ROOT . '/admin/includes/header/header.php'; ?>

<div class="adminLayout">
    <?php include ROOT . '/admin/includes/sidebar/sidebar.php'; ?>
    <main class="adminLayout__content">

        <section class="adminUsers">

            <div class="adminUsers__head">
                <div>
                    <span>Controle de acesso</span>
                    <h1>Administrar <strong>Usuários</strong></h1>
                    <p>Gerencie permissões, dados de acesso e contas do painel administrativo.</p>
                </div>
                <div class="adminUsers__headActions">
                    <a class="btn btn--primary" href="<?= BASE_URL ?>/admin/cadastrarusuario">+ Novo usuário</a>
                </div>
            </div>

            <div class="adminUsers__card">
                <div class="adminUsers__table-wrap" id="usersTableWrap">
                    <p class="adminUsers__empty">Carregando usuários...</p>
                </div>
            </div>

        </section>

    </main>
</div>

<!-- Modal: Editar usuário -->
<div class="adminModal" id="modalEditUser">
    <div class="adminModal__box">
        <button class="adminModal__close" id="closeEditModal" type="button" aria-label="Fechar">&times;</button>
        <h2 class="adminModal__title">Editar usuário</h2>

        <input type="hidden" id="editUserId">
        <div class="row">
            <div class="col-md-12">
                <div class="formGroup__item">
                    <label>Nome completo</label>
                    <input class="input" type="text" id="editNome">
                </div>
            </div>
            <div class="col-md-6">
                <div class="formGroup__item">
                    <label>E-mail</label>
                    <input class="input" type="email" id="editEmail">
                </div>
            </div>
            <div class="col-md-6">
                <div class="formGroup__item">
                    <label>CPF</label>
                    <input class="input" type="text" id="editCpf">
                </div>
            </div>
            <div class="col-md-12">
                <div class="formGroup__item">
                    <label>Nível de acesso</label>
                    <select class="input" id="editNivel">
                        <option value="admin">Admin</option>
                        <option value="editor">Editor</option>
                        <option value="cruzeiro">Cruzeiro</option>
                        <option value="leitor">Leitor</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="formGroup__item">
                    <label>Nova senha <small class="adminModal__hint">(deixe em branco para manter)</small></label>
                    <input class="input" type="password" id="editSenha" placeholder="Nova senha">
                </div>
            </div>
            <div class="col-md-6">
                <div class="formGroup__item">
                    <label>Confirmar nova senha</label>
                    <input class="input" type="password" id="editSenhaConfirm" placeholder="Repita a nova senha">
                </div>
            </div>
            <div class="col-md-12">
                <span class="adminModal__error" id="editError"></span>
            </div>
            <div class="col-md-12">
                <button class="btn btn--primary" id="saveEditUser" type="button">Salvar alterações</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Confirmar exclusão -->
<div class="adminModal" id="modalDeleteUser">
    <div class="adminModal__box adminModal__box--sm">
        <button class="adminModal__close" id="closeDeleteModal" type="button" aria-label="Fechar">&times;</button>
        <div class="adminModal__deleteIcon">
            <i class="icon-warning" aria-hidden="true"></i>
        </div>
        <h2 class="adminModal__title">Excluir usuário</h2>
        <p class="adminModal__deleteMsg">Tem certeza que deseja excluir <strong id="deleteUserName"></strong>? Esta ação não pode ser desfeita.</p>
        <input type="hidden" id="deleteUserId">
        <span class="adminModal__error" id="deleteError"></span>
        <div class="adminModal__deleteActions">
            <button class="btn btn--gray"   id="cancelDeleteUser"  type="button">Cancelar</button>
            <button class="btn btn--danger" id="confirmDeleteUser" type="button">Sim, excluir</button>
        </div>
    </div>
</div>

<?php include ROOT . '/admin/includes/footer/footer.php'; ?>
<?php include ROOT . '/admin/includes/scripts.php'; ?>
<script>
    var ADMIN_BASE_URL  = "<?= ADMIN_BASE_URL ?>";
    var BASE_URL        = "<?= BASE_URL ?>";
    var SESSION_USER_ID = <?= (int) $_SESSION['usuario']['id'] ?>;
</script>
<?php $v = time(); echo '<script src="' . ADMIN_BASE_URL . '/pages/administrarusuarios/administrarusuarios.js?v=' . $v . '"></script>'; ?>

</body>
</html>
