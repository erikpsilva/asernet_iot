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
<title>AserNet - Admin - Wi-Fi Profissional</title>
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
                    <h2>Conteúdo <span>Wi-Fi Profissional</span></h2>
                    <p class="adminConteudo__subtitle">Edite os textos e imagens da página Wi-Fi Profissional.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar alterações</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <!-- Seção: Compare — Problema -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Seu Wi-Fi não acompanha o ritmo (Problema)</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="cmpProbTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="cmpProbTexto" maxlength="200">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item <?= $i + 1 ?> <small>(ícone × fixo)</small></label>
                            <input type="text" class="formGroup__input" id="cmpProbItem-<?= $i ?>" maxlength="60">
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Imagem central</label>
                            <div class="adminConteudo__imgWrap">
                                <img class="adminConteudo__imgPreview" id="cmpImgPrev" src="" style="display:none">
                                <span id="cmpImgEmpty" style="color:#b0bdd6;font-size:12px">Sem imagem</span>
                                <label class="adminConteudo__imgBtn" for="upload-cmpImgPrev">Trocar imagem</label>
                                <input type="file" id="upload-cmpImgPrev" class="adminConteudo__fileInput" accept="image/jpeg,image/png,image/webp"
                                    data-img-field="cmpImagem" data-img-preview="cmpImgPrev" data-img-empty="cmpImgEmpty">
                                <input type="hidden" id="cmpImagem" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Compare — Solução -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Rede Wi-Fi profissional (Solução)</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="cmpSolTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="cmpSolTexto" maxlength="300">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item <?= $i + 1 ?> <small>(ícone checkmark fixo)</small></label>
                            <input type="text" class="formGroup__input" id="cmpSolItem-<?= $i ?>" maxlength="60">
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Seção: Como funciona -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Como funciona</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="stepsTitulo" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Subtítulo</label>
                            <input type="text" class="formGroup__input" id="stepsTexto" maxlength="120">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo <?= $i + 1 ?> — título</label>
                            <input type="text" class="formGroup__input" id="stepTit-<?= $i ?>" maxlength="60">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo <?= $i + 1 ?> — texto</label>
                            <input type="text" class="formGroup__input" id="stepTxt-<?= $i ?>" maxlength="120">
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Seção: Business Wi-Fi Pro (Plano) -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Business Wi-Fi Pro</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título do plano</label>
                            <input type="text" class="formGroup__input" id="planTitulo" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Preço (ex: R$ 159,90)</label>
                            <input type="text" class="formGroup__input" id="planPreco" maxlength="30">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">AP adicional</label>
                            <input type="text" class="formGroup__input" id="planAdicional" maxlength="60">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Incluso <?= $i + 1 ?></label>
                            <input type="text" class="formGroup__input" id="planItem-<?= $i ?>" maxlength="60">
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Imagem do plano</label>
                            <div class="adminConteudo__imgWrap">
                                <img class="adminConteudo__imgPreview" id="planImgPrev" src="" style="display:none">
                                <span id="planImgEmpty" style="color:#b0bdd6;font-size:12px">Sem imagem</span>
                                <label class="adminConteudo__imgBtn" for="upload-planImgPrev">Trocar imagem</label>
                                <input type="file" id="upload-planImgPrev" class="adminConteudo__fileInput" accept="image/jpeg,image/png,image/webp"
                                    data-img-field="planImagem" data-img-preview="planImgPrev" data-img-empty="planImgEmpty">
                                <input type="hidden" id="planImagem" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Para quem é indicado -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Para quem é indicado</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="audTitulo" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Subtítulo</label>
                            <input type="text" class="formGroup__input" id="audTexto" maxlength="120">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php for ($i = 0; $i < 8; $i++): ?>
                    <div class="col-md-3">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item <?= $i + 1 ?> <small>(ícone fixo)</small></label>
                            <input type="text" class="formGroup__input" id="audItem-<?= $i ?>" maxlength="60">
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Seção: Diferenciais AserNet -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Diferenciais AserNet</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título da seção</label>
                            <input type="text" class="formGroup__input" id="featTitulo" maxlength="80">
                        </div>
                    </div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards (3 fixos — ícones fixos)</p>
                <div class="row" id="featCardsContainer"></div>
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
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudowifiprofissional/conteudowifiprofissional.js?v=<?= time() ?>"></script>

</body>
</html>
