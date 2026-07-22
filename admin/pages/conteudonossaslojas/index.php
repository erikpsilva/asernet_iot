<?php include ROOT . '/admin/includes/auth_check.php'; ?>
<?php
if (!in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor', 'leitor'])) {
    header('Location: ' . BASE_URL . '/admin/inicio');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Admin - Nossas Lojas</title>
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
                    <h2>Conte&uacute;do <span>Nossas Lojas</span></h2>
                    <p class="adminConteudo__subtitle">Edite os textos, imagens e as lojas exibidas na p&aacute;gina Nossas Lojas.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar altera&ccedil;&otilde;es</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <div class="adminConteudo__msg adminConteudo__msg--ok" style="margin-bottom:24px">
                O topo (banner) desta p&aacute;gina agora &eacute; editado em
                <a href="<?= BASE_URL ?>/admin/banner?page=nossaslojas" style="text-decoration:underline"><strong>Banners &rsaquo; Banner Nossas Lojas</strong></a>.
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Cabe&ccedil;alho da lista de lojas</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo</label><input type="text" class="formGroup__input" id="sectionTitulo" maxlength="60"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item"><label class="formGroup__label">Texto</label><input type="text" class="formGroup__input" id="sectionTexto" maxlength="140"></div>
                    </div>
                </div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Lojas</h3>
                <div id="storesContainer"></div>
                <button type="button" class="adminConteudo__addBulletBtn" id="btnAddStore">+ Adicionar loja</button>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Bloco de expans&atilde;o</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo</label><input type="text" class="formGroup__input" id="expansionTitulo" maxlength="60"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo em destaque</label><input type="text" class="formGroup__input" id="expansionTituloDestaque" maxlength="80"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="formGroup__item"><label class="formGroup__label">Texto</label><input type="text" class="formGroup__input" id="expansionTexto" maxlength="220"></div>
                    </div>
                </div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Fechamento</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo</label><input type="text" class="formGroup__input" id="closingTitulo" maxlength="90"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo em destaque</label><input type="text" class="formGroup__input" id="closingTituloDestaque" maxlength="40"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Imagem</label>
                            <div id="closingImgWidget"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="formGroup__item"><label class="formGroup__label">Texto</label><input type="text" class="formGroup__input" id="closingTexto" maxlength="220"></div>
                    </div>
                </div>
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
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudonossaslojas/conteudonossaslojas.js?v=<?= time() ?>"></script>

</body>
</html>
