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
<title>AserNet - Admin - Conteúdo da Home</title>
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
                    <h2>Conteúdo da <span>Home Page</span></h2>
                    <p class="adminConteudo__subtitle">Edite os textos e imagens exibidos na página inicial do site.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar alterações</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <!-- Intro -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Texto de introdução</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título principal</label>
                            <input type="text" class="formGroup__input" id="introTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Subtítulo</label>
                            <input type="text" class="formGroup__input" id="introSubtitulo" maxlength="300">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cards casa -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Soluções para sua casa</h3>
                <div class="row" id="cardsCasa"></div>
            </div>

            <!-- Cards empresa -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Soluções para empresas</h3>
                <div class="row" id="cardsEmpresa"></div>
            </div>

            <!-- Cards segurança -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Segurança e monitoramento</h3>
                <div class="row" id="cardsSeguranca"></div>
            </div>

        </div>

    </main>
</div>

<?php include ROOT . '/admin/includes/footer/footer.php'; ?>
<?php include ROOT . '/admin/includes/scripts.php'; ?>
<script>
    var SITE_BASE = "<?= BASE_URL ?>";
    var ADMIN_BASE = "<?= ADMIN_BASE_URL ?>";
</script>
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudoinicio/conteudoinicio.js?v=<?= time() ?>"></script>

</body>
</html>
