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
<title>AserNet - Admin - Telefonia Empresarial</title>
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
                    <h2>Conteúdo <span>Telefonia Empresarial</span></h2>
                    <p class="adminConteudo__subtitle">Edite os textos e imagens da página Telefonia Empresarial.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar alterações</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <!-- Seção: Pain -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Sua empresa ainda perde oportunidades</h3>
                <div class="row">
                    <div class="col-md-8">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="painTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="painTexto" maxlength="200">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php for ($i = 0; $i < 4; $i++): ?>
                    <div class="col-md-3">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item <?= $i + 1 ?> <small>(ícone × fixo)</small></label>
                            <input type="text" class="formGroup__input" id="painItem-<?= $i ?>" maxlength="60">
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Seção: Soluções -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Soluções que se adaptam ao seu negócio</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="solTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Subtítulo</label>
                            <input type="text" class="formGroup__input" id="solTexto" maxlength="160">
                        </div>
                    </div>
                </div>

                <!-- Card 1: Linha empresarial (com imagem) -->
                <h4 class="adminConteudo__sectionTitle" style="font-size:14px;margin-top:16px">Card 1 — Linha empresarial</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="solCard0Tit" maxlength="80">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="solCard0Txt" maxlength="200">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Imagem</label>
                            <div class="adminConteudo__imgWrap">
                                <img class="adminConteudo__imgPreview" id="solCard0ImgPrev" src="" style="display:none">
                                <span id="solCard0ImgEmpty" style="color:#b0bdd6;font-size:12px">Sem imagem</span>
                                <label class="adminConteudo__imgBtn" for="upload-solCard0ImgPrev">Trocar imagem</label>
                                <input type="file" id="upload-solCard0ImgPrev" class="adminConteudo__fileInput" accept="image/jpeg,image/png,image/webp"
                                    data-img-field="solCard0Img" data-img-preview="solCard0ImgPrev" data-img-empty="solCard0ImgEmpty">
                                <input type="hidden" id="solCard0Img" value="">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cards 2 e 3: ícone fixo -->
                <h4 class="adminConteudo__sectionTitle" style="font-size:14px;margin-top:16px">Card 2 — Número 0800 <small>(ícone fixo)</small></h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="solCard1Tit" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="solCard1Txt" maxlength="200">
                        </div>
                    </div>
                </div>

                <h4 class="adminConteudo__sectionTitle" style="font-size:14px;margin-top:8px">Card 3 — Número 4000 <small>(ícone fixo)</small></h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="solCard2Tit" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="solCard2Txt" maxlength="200">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Diferenciais -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Diferenciais AserNet</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="featTitulo" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Subtítulo</label>
                            <input type="text" class="formGroup__input" id="featTexto" maxlength="120">
                        </div>
                    </div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards (4 fixos — ícones fixos)</p>
                <div class="row" id="featContainer"></div>
            </div>

            <!-- Seção: Resources -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Para quem é indicado / Recursos</h3>

                <h4 class="adminConteudo__sectionTitle" style="font-size:14px">Para quem é indicado</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="resAudTitulo" maxlength="80">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php for ($i = 0; $i < 7; $i++): ?>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item <?= $i + 1 ?> <small>(ícone fixo)</small></label>
                            <input type="text" class="formGroup__input" id="resAudItem-<?= $i ?>" maxlength="60">
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>

                <div class="row" style="margin-top:12px">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Imagem central</label>
                            <div class="adminConteudo__imgWrap">
                                <img class="adminConteudo__imgPreview" id="resImgPrev" src="" style="display:none">
                                <span id="resImgEmpty" style="color:#b0bdd6;font-size:12px">Sem imagem</span>
                                <label class="adminConteudo__imgBtn" for="upload-resImgPrev">Trocar imagem</label>
                                <input type="file" id="upload-resImgPrev" class="adminConteudo__fileInput" accept="image/jpeg,image/png,image/webp"
                                    data-img-field="resImagem" data-img-preview="resImgPrev" data-img-empty="resImgEmpty">
                                <input type="hidden" id="resImagem" value="">
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="adminConteudo__sectionTitle" style="font-size:14px;margin-top:16px">Recursos que geram resultados</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="resRecTitulo" maxlength="80">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php for ($i = 0; $i < 6; $i++): ?>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Recurso <?= $i + 1 ?></label>
                            <input type="text" class="formGroup__input" id="resRecItem-<?= $i ?>" maxlength="60">
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Seção: Flow -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Integre a telefonia com outras soluções</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="flowTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Subtítulo</label>
                            <input type="text" class="formGroup__input" id="flowTexto" maxlength="160">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item <?= $i + 1 ?> <small>(ícone fixo)</small></label>
                            <input type="text" class="formGroup__input" id="flowItem-<?= $i ?>" maxlength="60">
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Seção: Benefícios -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Benefícios que impulsionam sua empresa</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título da seção</label>
                            <input type="text" class="formGroup__input" id="benTitulo" maxlength="80">
                        </div>
                    </div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards (4 fixos — ícones fixos)</p>
                <div class="row" id="benContainer"></div>
            </div>

            <!-- Seção: Trust -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Avaliações / Instalação profissional e acompanhamento</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto Google</label>
                            <input type="text" class="formGroup__input" id="trustGoogle" maxlength="80">
                        </div>
                    </div>
                    <?php for ($i = 0; $i < 3; $i++): ?>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item <?= $i + 1 ?> <small>(ícone fixo)</small></label>
                            <input type="text" class="formGroup__input" id="trustItem-<?= $i ?>" maxlength="60">
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
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudotelefoniaempresarial/conteudotelefoniaempresarial.js?v=<?= time() ?>"></script>

</body>
</html>
