<?php include ROOT . '/admin/includes/auth_check.php'; ?>
<?php
if (!in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor', 'leitor'])) {
    header('Location: ' . BASE_URL . '/admin/inicio'); exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Admin - Contratos e Regulamentos</title>
<?php include ROOT . '/admin/includes/assets.php'; ?>
</head>
<body>

<?php include ROOT . '/admin/includes/header/header.php'; ?>

<div class="adminLayout">
    <?php include ROOT . '/admin/includes/sidebar/sidebar.php'; ?>
    <main class="adminLayout__content">

        <div class="adminConteudo">

            <div class="row adminConteudo__head">
                <div class="col-sm-8">
                    <h2>Contratos e <span>Regulamentos</span></h2>
                    <p class="adminConteudo__subtitle">Gerencie seções e documentos exibidos na página pública.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar alterações</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <div id="contratosEditor"></div>

            <div class="crz-secao-add" id="areaAddSecao">
                <button class="btn btn--gray" id="btnAddSecao">+ Adicionar seção</button>
            </div>

        </div>

    </main>
</div>

<?php include ROOT . '/admin/includes/footer/footer.php'; ?>
<?php include ROOT . '/admin/includes/scripts.php'; ?>
<script>
    var ADMIN_BASE = "<?= ADMIN_BASE_URL ?>";
    var SITE_BASE  = "<?= BASE_URL ?>";
    var CONTRATOS_CAN_EDIT = <?= $_canEdit ? 'true' : 'false' ?>;
</script>
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudocontratoseregulamentos/conteudocontratoseregulamentos.js?v=<?= time() ?>"></script>

</body>
</html>
