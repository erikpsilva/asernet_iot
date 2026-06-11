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
<title>AserNet - Admin - Combo</title>
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
                    <h2>Conte&uacute;do <span>Combo</span></h2>
                    <p class="adminConteudo__subtitle">Edite os textos e imagens da p&aacute;gina Combo.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar altera&ccedil;&otilde;es</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Escolha o combo ideal para voc&ecirc;</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">T&iacute;tulo</label>
                            <input type="text" class="formGroup__input" id="introTitulo" maxlength="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="introTexto" maxlength="220">
                        </div>
                    </div>
                </div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Combos Residenciais</h3>
                <div class="row">
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo do grupo</label><input type="text" class="formGroup__input" id="resTitulo" maxlength="80"></div></div>
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Texto do grupo</label><input type="text" class="formGroup__input" id="resTexto" maxlength="140"></div></div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards residenciais (2 fixos — &iacute;cones fixos)</p>
                <div class="row" id="resCardsContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Combos Empresariais</h3>
                <div class="row">
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo do grupo</label><input type="text" class="formGroup__input" id="bizTitulo" maxlength="80"></div></div>
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Texto do grupo</label><input type="text" class="formGroup__input" id="bizTexto" maxlength="140"></div></div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards empresariais (3 fixos — &iacute;cones fixos)</p>
                <div class="row" id="bizCardsContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Combos de Conectividade</h3>
                <div class="row">
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo do grupo</label><input type="text" class="formGroup__input" id="connTitulo" maxlength="90"></div></div>
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Texto do grupo</label><input type="text" class="formGroup__input" id="connTexto" maxlength="150"></div></div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Card Internet + Mobile</p>
                <div class="row" id="connCardContainer"></div>
                <div class="row" style="margin-top:12px">
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo do card customizado</label><input type="text" class="formGroup__input" id="customTitulo" maxlength="90"></div></div>
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Texto do card customizado</label><input type="text" class="formGroup__input" id="customTexto" maxlength="140"></div></div>
                </div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Avalia&ccedil;&otilde;es / Suporte r&aacute;pido e especializado</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto Google</label>
                            <input type="text" class="formGroup__input" id="trustGoogle" maxlength="120">
                        </div>
                    </div>
                    <?php for ($i = 0; $i < 3; $i++): ?>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item <?= $i + 1 ?> <small>(&iacute;cone fixo)</small></label>
                            <input type="text" class="formGroup__input" id="trustItem-<?= $i ?>" maxlength="90">
                        </div>
                    </div>
                    <?php endfor; ?>
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
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudocombo/conteudocombo.js?v=<?= time() ?>"></script>

</body>
</html>
