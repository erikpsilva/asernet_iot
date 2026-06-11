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
<title>AserNet - Admin - Link Dedicado</title>
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
                    <h2>Conte&uacute;do <span>Link Dedicado</span></h2>
                    <p class="adminConteudo__subtitle">Edite os textos e imagens da p&aacute;gina Link Dedicado.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar altera&ccedil;&otilde;es</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Sua opera&ccedil;&atilde;o n&atilde;o pode parar</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">T&iacute;tulo</label>
                            <input type="text" class="formGroup__input" id="problemTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="problemTexto" maxlength="220">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php for ($i = 0; $i < 4; $i++): ?>
                    <div class="col-md-3">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item <?= $i + 1 ?> <small>(&iacute;cone &times; fixo)</small></label>
                            <input type="text" class="formGroup__input" id="problemItem-<?= $i ?>" maxlength="80">
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Imagem</label>
                            <div class="adminConteudo__imgWrap">
                                <img class="adminConteudo__imgPreview" id="problemImgPrev" src="" style="display:none" alt="">
                                <span id="problemImgEmpty" style="color:#b0bdd6;font-size:12px">Sem imagem</span>
                                <label class="adminConteudo__imgBtn" for="upload-problemImgPrev">Trocar imagem</label>
                                <input type="file" id="upload-problemImgPrev" class="adminConteudo__fileInput" accept="image/jpeg,image/png,image/webp"
                                    data-img-field="problemImagem" data-img-preview="problemImgPrev" data-img-empty="problemImgEmpty">
                                <input type="hidden" id="problemImagem" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Conex&atilde;o exclusiva</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">T&iacute;tulo</label>
                            <input type="text" class="formGroup__input" id="exclusiveTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="exclusiveTexto" maxlength="260">
                        </div>
                    </div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards (4 fixos — &iacute;cones fixos)</p>
                <div class="row" id="exclusiveContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Para quem &eacute; indicado</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">T&iacute;tulo</label>
                            <input type="text" class="formGroup__input" id="audTitulo" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Subt&iacute;tulo</label>
                            <input type="text" class="formGroup__input" id="audTexto" maxlength="140">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php for ($i = 0; $i < 7; $i++): ?>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item <?= $i + 1 ?> <small>(&iacute;cone fixo)</small></label>
                            <input type="text" class="formGroup__input" id="audItem-<?= $i ?>" maxlength="80">
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Diferenciais AserNet</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">T&iacute;tulo da se&ccedil;&atilde;o</label>
                            <input type="text" class="formGroup__input" id="featTitulo" maxlength="80">
                        </div>
                    </div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards (4 fixos — &iacute;cones fixos)</p>
                <div class="row" id="featContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Integra&ccedil;&atilde;o</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">T&iacute;tulo</label>
                            <input type="text" class="formGroup__input" id="integrationTitulo" maxlength="140">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Subt&iacute;tulo</label>
                            <input type="text" class="formGroup__input" id="integrationTexto" maxlength="180">
                        </div>
                    </div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards (4 fixos — com imagem)</p>
                <div class="row" id="integrationContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Benef&iacute;cios</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">T&iacute;tulo da se&ccedil;&atilde;o</label>
                            <input type="text" class="formGroup__input" id="benefitsTitulo" maxlength="80">
                        </div>
                    </div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards (4 fixos — &iacute;cones fixos)</p>
                <div class="row" id="benefitContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Avalia&ccedil;&otilde;es / Instala&ccedil;&atilde;o profissional e acompanhamento</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto Google</label>
                            <input type="text" class="formGroup__input" id="trustGoogle" maxlength="90">
                        </div>
                    </div>
                    <?php for ($i = 0; $i < 3; $i++): ?>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item <?= $i + 1 ?> <small>(&iacute;cone fixo)</small></label>
                            <input type="text" class="formGroup__input" id="trustItem-<?= $i ?>" maxlength="80">
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
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudolinkdedicado/conteudolinkdedicado.js?v=<?= time() ?>"></script>

</body>
</html>
