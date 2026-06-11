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
<title>AserNet - Admin - Sobre AserNet</title>
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
                    <h2>Conte&uacute;do <span>Sobre AserNet</span></h2>
                    <p class="adminConteudo__subtitle">Edite textos e imagens da p&aacute;gina Sobre a AserNet.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar altera&ccedil;&otilde;es</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Nossa hist&oacute;ria</h3>
                <div class="row">
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">Selo</label><input type="text" class="formGroup__input" id="historyLabel" maxlength="60"></div></div>
                    <div class="col-md-8"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo</label><input type="text" class="formGroup__input" id="historyTitulo" maxlength="120"></div></div>
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Texto 1</label><input type="text" class="formGroup__input" id="historyTexto-0" maxlength="260"></div></div>
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Texto 2</label><input type="text" class="formGroup__input" id="historyTexto-1" maxlength="260"></div></div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Imagem</label>
                            <div class="adminConteudo__imgWrap">
                                <img class="adminConteudo__imgPreview" id="historyImgPrev" src="" style="display:none" alt="">
                                <span id="historyImgEmpty" style="color:#b0bdd6;font-size:12px">Sem imagem</span>
                                <label class="adminConteudo__imgBtn" for="upload-historyImgPrev">Trocar imagem</label>
                                <input type="file" id="upload-historyImgPrev" class="adminConteudo__fileInput" accept="image/jpeg,image/png,image/webp" data-img-field="historyImagem" data-img-preview="historyImgPrev" data-img-empty="historyImgEmpty">
                                <input type="hidden" id="historyImagem" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — O que acreditamos</h3>
                <div class="row">
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">Selo</label><input type="text" class="formGroup__input" id="beliefLabel" maxlength="60"></div></div>
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo</label><input type="text" class="formGroup__input" id="beliefTitulo" maxlength="100"></div></div>
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">Texto</label><input type="text" class="formGroup__input" id="beliefTexto" maxlength="120"></div></div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards (4 fixos — &iacute;cones fixos)</p>
                <div class="row" id="beliefContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — O que fazemos</h3>
                <div class="row">
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">Selo</label><input type="text" class="formGroup__input" id="solutionsLabel" maxlength="60"></div></div>
                    <div class="col-md-8"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo</label><input type="text" class="formGroup__input" id="solutionsTitulo" maxlength="130"></div></div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards (4 fixos — &iacute;cones e links fixos)</p>
                <div class="row" id="solutionsContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Confian&ccedil;a</h3>
                <div class="row">
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Texto Google</label><input type="text" class="formGroup__input" id="trustGoogle" maxlength="120"></div></div>
                    <?php for ($i = 0; $i < 3; $i++): ?>
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">Item <?= $i + 1 ?> <small>(&iacute;cone fixo)</small></label><input type="text" class="formGroup__input" id="trustItem-<?= $i ?>" maxlength="90"></div></div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Nosso diferencial</h3>
                <div class="row">
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">Selo</label><input type="text" class="formGroup__input" id="diffLabel" maxlength="60"></div></div>
                    <div class="col-md-8"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo</label><input type="text" class="formGroup__input" id="diffTitulo" maxlength="120"></div></div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards (4 fixos — &iacute;cones fixos)</p>
                <div class="row" id="diffContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Nosso time e estrutura</h3>
                <div class="row">
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">Selo</label><input type="text" class="formGroup__input" id="teamLabel" maxlength="70"></div></div>
                    <div class="col-md-8"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo</label><input type="text" class="formGroup__input" id="teamTitulo" maxlength="120"></div></div>
                </div>
                <div class="row" id="teamImagesContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Nosso prop&oacute;sito</h3>
                <div class="row">
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">Selo</label><input type="text" class="formGroup__input" id="purposeLabel" maxlength="70"></div></div>
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo</label><input type="text" class="formGroup__input" id="purposeTitulo" maxlength="100"></div></div>
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">Texto</label><input type="text" class="formGroup__input" id="purposeTexto" maxlength="220"></div></div>
                    <?php for ($i = 0; $i < 4; $i++): ?>
                    <div class="col-md-3"><div class="formGroup__item"><label class="formGroup__label">Item <?= $i + 1 ?> <small>(&iacute;cone fixo)</small></label><input type="text" class="formGroup__input" id="purposeItem-<?= $i ?>" maxlength="60"></div></div>
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
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudosobreasernet/conteudosobreasernet.js?v=<?= time() ?>"></script>

</body>
</html>
