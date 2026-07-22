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
<title>AserNet - Admin - Bairro Seguro</title>
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
                    <h2>Conte&uacute;do <span>Bairro Seguro</span></h2>
                    <p class="adminConteudo__subtitle">Edite os textos e imagens da p&aacute;gina Bairro Seguro.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar altera&ccedil;&otilde;es</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <div class="adminConteudo__msg adminConteudo__msg--ok" style="margin-bottom:24px">
                O topo (banner) desta p&aacute;gina &eacute; editado em
                <a href="<?= BASE_URL ?>/admin/banner?page=bairroseguro" style="text-decoration:underline"><strong>Banners &rsaquo; Banner Bairro Seguro</strong></a>.
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Seguran&ccedil;a compartilhada</h3>
                <div class="row">
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo (destaque)</label><input type="text" class="formGroup__input" id="sharedTitulo" maxlength="60"></div></div>
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo (complemento)</label><input type="text" class="formGroup__input" id="sharedTituloComplemento" maxlength="60"></div></div>
                    <div class="col-md-12"><div class="formGroup__item"><label class="formGroup__label">Par&aacute;grafo 1</label><input type="text" class="formGroup__input" id="sharedTexto1" maxlength="260"></div></div>
                    <div class="col-md-12"><div class="formGroup__item"><label class="formGroup__label">Par&aacute;grafo 2</label><input type="text" class="formGroup__input" id="sharedTexto2" maxlength="260"></div></div>
                    <div class="col-md-12"><div class="formGroup__item"><label class="formGroup__label">Par&aacute;grafo 3</label><input type="text" class="formGroup__input" id="sharedTexto3" maxlength="260"></div></div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Imagem</label>
                            <div id="sharedImgWidget"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Como funciona</h3>
                <div class="row">
                    <div class="col-md-12"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo da se&ccedil;&atilde;o</label><input type="text" class="formGroup__input" id="stepsTitulo" maxlength="60"></div></div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Passos (4 fixos — n&uacute;meros fixos, foto edit&aacute;vel)</p>
                <div class="row" id="stepsContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Ideal para</h3>
                <div class="row">
                    <div class="col-md-12"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo da se&ccedil;&atilde;o</label><input type="text" class="formGroup__input" id="audiencesTitulo" maxlength="60"></div></div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Itens (6 fixos — &iacute;cones fixos)</p>
                <div class="row">
                    <?php for ($i = 0; $i < 6; $i++): ?>
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">Item <?= $i + 1 ?></label><input type="text" class="formGroup__input" id="audiencesItem-<?= $i ?>" maxlength="60"></div></div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — O que est&aacute; incluso</h3>
                <div class="row">
                    <div class="col-md-8"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo</label><input type="text" class="formGroup__input" id="includedTitulo" maxlength="60"></div></div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Imagem</label>
                            <div id="includedImgWidget"></div>
                        </div>
                    </div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Itens da lista</p>
                <div id="includedItemsContainer"></div>
                <button type="button" class="adminConteudo__addBulletBtn" id="btnAddIncluded">+ Adicionar item</button>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Vantagens para a comunidade</h3>
                <div class="row">
                    <div class="col-md-12"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo da se&ccedil;&atilde;o</label><input type="text" class="formGroup__input" id="advantagesTitulo" maxlength="60"></div></div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards (4 fixos — &iacute;cones fixos)</p>
                <div class="row" id="advantagesContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Perguntas frequentes</h3>
                <div class="row">
                    <div class="col-md-12"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo da se&ccedil;&atilde;o</label><input type="text" class="formGroup__input" id="faqTitulo" maxlength="60"></div></div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Perguntas (4 fixas)</p>
                <div class="row" id="faqContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Chamada final (CTA)</h3>
                <div class="row">
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo (linha 1)</label><input type="text" class="formGroup__input" id="ctaTitulo" maxlength="60"></div></div>
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo (linha 2)</label><input type="text" class="formGroup__input" id="ctaTituloComplemento" maxlength="60"></div></div>
                    <div class="col-md-12"><div class="formGroup__item"><label class="formGroup__label">Texto</label><input type="text" class="formGroup__input" id="ctaTexto" maxlength="200"></div></div>
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Bot&atilde;o 1 — Telefone</label><input type="text" class="formGroup__input" id="ctaBtn1" maxlength="40"></div></div>
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Bot&atilde;o 2 — WhatsApp</label><input type="text" class="formGroup__input" id="ctaBtn2" maxlength="60"></div></div>
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
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudobairroseguro/conteudobairroseguro.js?v=<?= time() ?>"></script>

</body>
</html>
