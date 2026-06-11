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
<title>AserNet - Admin - Conteúdo Residencial</title>
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
                    <h2>Conteúdo <span>Residencial</span></h2>
                    <p class="adminConteudo__subtitle">Edite os textos e imagens da página Residencial.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar alterações</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <!-- Seção: Diagnóstico -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — A diferença não está na velocidade</h3>
                <div class="row">
                    <div class="col-md-8">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="diagTitulo" maxlength="120">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="diagTexto" maxlength="300">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="formGroup__label">Imagem da casa</label>
                        <div class="adminConteudo__imgWrap">
                            <img class="adminConteudo__imgPreview" id="diagImgPreview" src="" alt="" style="display:none">
                            <span id="diagImgEmpty" style="color:#b0bdd6;font-size:12px;">Sem imagem</span>
                            <label class="adminConteudo__imgBtn" for="diagImgUpload">Trocar imagem</label>
                            <input type="file" id="diagImgUpload" class="adminConteudo__fileInput" accept="image/jpeg,image/png,image/webp">
                            <input type="hidden" id="diagImagem" value="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Solução -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Internet pensada para sua casa</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="solucaoTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="solucaoTexto" maxlength="300">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Bullets <small style="color:#8a9ab8">(até 5 itens)</small></label>
                            <div id="solucaoBullets"></div>
                            <button type="button" class="adminConteudo__addBulletBtn"
                                data-bullets-target="solucaoBullets" data-bullets-max="5">+ Adicionar item</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Planos -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Planos</h3>
                <div class="formGroup__item">
                    <label class="formGroup__label">Título da seção</label>
                    <input type="text" class="formGroup__input" id="planosTitulo" maxlength="120">
                </div>
                <div class="row" id="planosContainer"></div>
            </div>

            <!-- Seção: Suporte -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Diferenciais (do Suporte local ao Wi-Fi preparado)</h3>
                <div class="row" id="suporteContainer"></div>
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
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudoresidencial/conteudoresidencial.js?v=<?= time() ?>"></script>

</body>
</html>
