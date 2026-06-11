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
<title>AserNet - Admin - Skeelo</title>
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
                    <h2>Conteúdo <span>Skeelo</span></h2>
                    <p class="adminConteudo__subtitle">Edite os textos e imagens da página Skeelo.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar alterações</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <!-- Seção: Moments -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Tudo que você gosta de ler e ouvir</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Destaque (span)</label>
                            <input type="text" class="formGroup__input" id="momentsSpan" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título (h2)</label>
                            <input type="text" class="formGroup__input" id="momentsTitulo" maxlength="80">
                        </div>
                    </div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Features (6 cards)</p>
                <div class="row" id="featuresContainer"></div>
            </div>

            <!-- Seção: Rotina -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Integrado ao seu dia</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Destaque (span)</label>
                            <input type="text" class="formGroup__input" id="routineSpan" maxlength="60">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título (h2)</label>
                            <input type="text" class="formGroup__input" id="routineTitulo" maxlength="100">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto (p)</label>
                            <input type="text" class="formGroup__input" id="routineTexto" maxlength="160">
                        </div>
                    </div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards com imagem</p>
                <div class="row" id="routineCardsContainer"></div>

                <h4 class="adminConteudo__sectionTitle" style="font-size:14px;margin-top:24px">Como ativar</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Destaque (span)</label>
                            <input type="text" class="formGroup__input" id="howSpan" maxlength="60">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 1 — negrito</label>
                            <input type="text" class="formGroup__input" id="howTit-0" maxlength="50">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 1 — descrição</label>
                            <input type="text" class="formGroup__input" id="howTxt-0" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 2 — negrito</label>
                            <input type="text" class="formGroup__input" id="howTit-1" maxlength="50">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 2 — descrição</label>
                            <input type="text" class="formGroup__input" id="howTxt-1" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 3 — negrito</label>
                            <input type="text" class="formGroup__input" id="howTit-2" maxlength="50">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 3 — descrição</label>
                            <input type="text" class="formGroup__input" id="howTxt-2" maxlength="80">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Benefícios -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Um benefício exclusivo para você</h3>
                <div class="formGroup__item">
                    <label class="formGroup__label">Título (h2)</label>
                    <input type="text" class="formGroup__input" id="benefitsTitulo" maxlength="80">
                </div>
                <div class="row" id="benefitsContainer"></div>
            </div>

            <!-- Seção: Trust -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Atendimento / Suporte rápido e especializado</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto Google</label>
                            <input type="text" class="formGroup__input" id="trustGoogle" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 1</label>
                            <input type="text" class="formGroup__input" id="trustItem1" maxlength="60">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 2</label>
                            <input type="text" class="formGroup__input" id="trustItem2" maxlength="60">
                        </div>
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
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudoskeelo/conteudoskeelo.js?v=<?= time() ?>"></script>

</body>
</html>
