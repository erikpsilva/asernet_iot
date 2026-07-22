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
<title>AserNet - Admin - Controle Corporativo</title>
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
                    <h2>Conte&uacute;do <span>Controle Corporativo</span></h2>
                    <p class="adminConteudo__subtitle">Edite os textos e imagens da p&aacute;gina Controle de Acesso Corporativo.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar altera&ccedil;&otilde;es</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <div class="adminConteudo__msg adminConteudo__msg--ok" style="margin-bottom:24px">
                O topo (banner) desta p&aacute;gina &eacute; editado em
                <a href="<?= BASE_URL ?>/admin/banner?page=controlecorporativo" style="text-decoration:underline"><strong>Banners &rsaquo; Banner Controle Corporativo</strong></a>.
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Parceiro oficial</h3>
                <div class="row">
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">Selo</label><input type="text" class="formGroup__input" id="partnerLabel" maxlength="60"></div></div>
                    <div class="col-md-8"><div class="formGroup__item"><label class="formGroup__label">Texto</label><input type="text" class="formGroup__input" id="partnerTexto" maxlength="160"></div></div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Logo do parceiro</label>
                            <div id="partnerImgWidget"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Introdu&ccedil;&atilde;o</h3>
                <div class="row">
                    <div class="col-md-5"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo</label><input type="text" class="formGroup__input" id="introTitulo" maxlength="120"></div></div>
                    <div class="col-md-7"><div class="formGroup__item"><label class="formGroup__label">Texto</label><input type="text" class="formGroup__input" id="introTexto" maxlength="320"></div></div>
                </div>
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
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Tecnologias dispon&iacute;veis</h3>
                <div class="row">
                    <div class="col-md-12"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo da se&ccedil;&atilde;o</label><input type="text" class="formGroup__input" id="technologiesTitulo" maxlength="60"></div></div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Itens (8 fixos — &iacute;cones fixos)</p>
                <div class="row">
                    <?php for ($i = 0; $i < 8; $i++): ?>
                    <div class="col-md-3"><div class="formGroup__item"><label class="formGroup__label">Item <?= $i + 1 ?></label><input type="text" class="formGroup__input" id="technologiesItem-<?= $i ?>" maxlength="60"></div></div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — O que sua empresa ganha?</h3>
                <div class="row">
                    <div class="col-md-12"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo da se&ccedil;&atilde;o</label><input type="text" class="formGroup__input" id="gainsTitulo" maxlength="60"></div></div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards (4 fixos — &iacute;cones fixos)</p>
                <div class="row" id="gainsContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Aplica&ccedil;&otilde;es</h3>
                <div class="row">
                    <div class="col-md-12"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo da se&ccedil;&atilde;o</label><input type="text" class="formGroup__input" id="applicationsTitulo" maxlength="60"></div></div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards (4 fixos — &iacute;cones fixos, foto edit&aacute;vel)</p>
                <div class="row" id="applicationsContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Integra&ccedil;&atilde;o com outros sistemas</h3>
                <div class="row">
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo</label><input type="text" class="formGroup__input" id="integrationTitulo" maxlength="90"></div></div>
                    <div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Texto</label><input type="text" class="formGroup__input" id="integrationTexto" maxlength="160"></div></div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Itens (5 fixos — &iacute;cones fixos)</p>
                <div class="row">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">Item <?= $i + 1 ?></label><input type="text" class="formGroup__input" id="integrationItem-<?= $i ?>" maxlength="60"></div></div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Equipamentos profissionais</h3>
                <div class="row">
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo</label><input type="text" class="formGroup__input" id="equipmentTitulo" maxlength="60"></div></div>
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo em destaque</label><input type="text" class="formGroup__input" id="equipmentTituloDestaque" maxlength="40"></div></div>
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">Texto do bot&atilde;o</label><input type="text" class="formGroup__input" id="equipmentBtnTexto" maxlength="60"></div></div>
                    <div class="col-md-8"><div class="formGroup__item"><label class="formGroup__label">Texto</label><input type="text" class="formGroup__input" id="equipmentTexto" maxlength="220"></div></div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Imagem</label>
                            <div id="equipmentImgWidget"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Como funciona</h3>
                <div class="row">
                    <div class="col-md-12"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo da se&ccedil;&atilde;o</label><input type="text" class="formGroup__input" id="stepsTitulo" maxlength="60"></div></div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Passos (5 fixos — n&uacute;meros e &iacute;cones fixos)</p>
                <div class="row" id="stepsContainer"></div>
            </div>

            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Se&ccedil;&atilde;o — Chamada final (CTA)</h3>
                <div class="row">
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo</label><input type="text" class="formGroup__input" id="ctaTitulo" maxlength="60"></div></div>
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">T&iacute;tulo em destaque</label><input type="text" class="formGroup__input" id="ctaTituloDestaque" maxlength="60"></div></div>
                    <div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">Texto</label><input type="text" class="formGroup__input" id="ctaTexto" maxlength="160"></div></div>
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
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudocontrolecorporativo/conteudocontrolecorporativo.js?v=<?= time() ?>"></script>

</body>
</html>
