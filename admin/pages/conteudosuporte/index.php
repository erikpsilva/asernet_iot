<?php include ROOT . '/admin/includes/auth_check.php'; ?>
<?php
if (!in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor'])) {
    header('Location: ' . BASE_URL . '/admin/inicio');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Admin - Conteúdo do Suporte</title>
<?php include ROOT . '/admin/includes/assets.php'; ?>
</head>
<body>

<?php include ROOT . '/admin/includes/header/header.php'; ?>

<div class="adminLayout">
    <?php include ROOT . '/admin/includes/sidebar/sidebar.php'; ?>
    <main class="adminLayout__content">

        <div class="adminFaq">

            <div class="row adminFaq__head">
                <div class="col-sm-8">
                    <h2>Conteúdo do <span>Suporte / FAQ</span></h2>
                    <p class="adminFaq__subtitle">Gerencie as categorias e perguntas da página de suporte.</p>
                </div>
                <div class="col-sm-4 adminFaq__headActions">
                    <button class="btn btn--primary" id="btnSalvarFaq">Salvar alterações</button>
                </div>
            </div>

            <div id="faqMsg" class="adminFaq__msg" style="display:none"></div>

            <div class="adminFaq__cardsBlock">
                <p class="adminFaq__perguntasLabel">Cards de categorias</p>
                <div class="row" id="faqCards">
                    <div class="col-sm-12">
                        <p style="color:#8a9ab8;font-size:14px">Carregando cards...</p>
                    </div>
                </div>
            </div>

            <p class="adminFaq__perguntasLabel">Perguntas por categoria</p>
            <div id="faqCategorias">
                <p style="color:#8a9ab8;font-size:14px">Carregando categorias...</p>
            </div>

        </div>

    </main>
</div>

<?php include ROOT . '/admin/includes/footer/footer.php'; ?>
<?php include ROOT . '/admin/includes/scripts.php'; ?>
<script>
    var SITE_BASE  = "<?= BASE_URL ?>";
    var ADMIN_BASE = "<?= ADMIN_BASE_URL ?>";
</script>
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudosuporte/conteudosuporte.js?v=<?= time() ?>"></script>

</body>
</html>
