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
<title>AserNet - Admin - Rastreamento Veicular</title>
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
                    <h2>Conteúdo <span>Rastreamento Veicular</span></h2>
                    <p class="adminConteudo__subtitle">Edite os textos e imagens da página Rastreamento Veicular.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar alterações</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <!-- Seção: Quick -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Monitoramento 24h (4 cards rápidos)</h3>
                <div class="row" id="quickContainer"></div>
            </div>

            <!-- Seção: Categorias -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Muito mais que rastreamento tradicional</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="catTitulo" maxlength="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Subtítulo</label>
                            <input type="text" class="formGroup__input" id="catSubtitulo" maxlength="200">
                        </div>
                    </div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards principais</p>
                <div class="row" id="catCardsContainer"></div>
                <p class="formGroup__label" style="margin:16px 0 8px">Itens "e muito mais"</p>
                <div class="row" id="catMoreContainer"></div>
            </div>

            <!-- Seção: Bicicleta elétrica -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Bicicletas elétricas</h3>
                <div class="row">
                    <div class="col-md-4">
                        <label class="formGroup__label">Imagem</label>
                        <div class="adminConteudo__imgWrap">
                            <img class="adminConteudo__imgPreview" id="bike-img-prev" src="" alt="" style="display:none">
                            <span id="bike-img-empty" style="color:#b0bdd6;font-size:12px;">Sem imagem</span>
                            <label class="adminConteudo__imgBtn" for="upload-bike-img">Trocar imagem</label>
                            <input type="file" id="upload-bike-img" class="adminConteudo__fileInput"
                                accept="image/jpeg,image/png,image/webp"
                                data-img-field="bike-imagem" data-img-preview="bike-img-prev" data-img-empty="bike-img-empty">
                            <input type="hidden" id="bike-imagem" value="">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="bikeTitulo" maxlength="120">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="bikeTexto" maxlength="250">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Bullets <small style="color:#8a9ab8">(até 6)</small></label>
                            <div id="bikeBullets"></div>
                            <button type="button" class="adminConteudo__addBulletBtn"
                                data-bullets-target="bikeBullets" data-bullets-max="6">+ Adicionar item</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Planos -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Planos</h3>
                <div class="row">
                    <div class="col-md-5">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título da seção</label>
                            <input type="text" class="formGroup__input" id="planosTitulo" maxlength="100">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Subtítulo</label>
                            <input type="text" class="formGroup__input" id="planosSubtitulo" maxlength="160">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Nota (rodapé)</label>
                            <input type="text" class="formGroup__input" id="planosNota" maxlength="60">
                        </div>
                    </div>
                </div>
                <div class="row" id="planosContainer"></div>
            </div>

            <!-- Seção: Por que escolher -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Por que escolher a AserNet?</h3>
                <div class="formGroup__item">
                    <label class="formGroup__label">Título da seção</label>
                    <input type="text" class="formGroup__input" id="whyTitulo" maxlength="80">
                </div>
                <div class="row" id="whyContainer"></div>
            </div>

            <!-- Seção: Trust -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Instalação profissional / Plataforma 100% online</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto Google</label>
                            <input type="text" class="formGroup__input" id="trustGoogle" maxlength="60">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 1</label>
                            <input type="text" class="formGroup__input" id="trustItem-0" maxlength="50">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 2</label>
                            <input type="text" class="formGroup__input" id="trustItem-1" maxlength="50">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 3</label>
                            <input type="text" class="formGroup__input" id="trustItem-2" maxlength="50">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 4</label>
                            <input type="text" class="formGroup__input" id="trustItem-3" maxlength="50">
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
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudorastreamento/conteudorastreamento.js?v=<?= time() ?>"></script>

</body>
</html>
