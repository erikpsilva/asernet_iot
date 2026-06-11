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
<title>AserNet - Admin - Wi-Fi Mesh</title>
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
                    <h2>Conteúdo <span>Wi-Fi Mesh</span></h2>
                    <p class="adminConteudo__subtitle">Edite os textos e imagens da página Wi-Fi Mesh.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar alterações</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <!-- Seção: Dor -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Sua internet pode ser rápida...</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título (linha 1)</label>
                            <input type="text" class="formGroup__input" id="dorTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título (linha 2)</label>
                            <input type="text" class="formGroup__input" id="dorTitulo2" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 1</label>
                            <input type="text" class="formGroup__input" id="dorItem-0" maxlength="60">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 2</label>
                            <input type="text" class="formGroup__input" id="dorItem-1" maxlength="60">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 3</label>
                            <input type="text" class="formGroup__input" id="dorItem-2" maxlength="60">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 4</label>
                            <input type="text" class="formGroup__input" id="dorItem-3" maxlength="60">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 5</label>
                            <input type="text" class="formGroup__input" id="dorItem-4" maxlength="60">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Tecnologia Mesh -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Tecnologia Mesh</h3>
                <div class="row">
                    <div class="col-md-8">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="techTitulo" maxlength="120">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="techTexto" maxlength="300">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Bullets <small style="color:#8a9ab8">(até 5)</small></label>
                            <div id="techBullets"></div>
                            <button type="button" class="adminConteudo__addBulletBtn"
                                data-bullets-target="techBullets" data-bullets-max="5">+ Adicionar item</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="formGroup__label">Imagem</label>
                        <div class="adminConteudo__imgWrap">
                            <img class="adminConteudo__imgPreview" id="tech-img-prev" src="" alt="" style="display:none">
                            <span id="tech-img-empty" style="color:#b0bdd6;font-size:12px;">Sem imagem</span>
                            <label class="adminConteudo__imgBtn" for="upload-tech-img">Trocar imagem</label>
                            <input type="file" id="upload-tech-img" class="adminConteudo__fileInput"
                                accept="image/jpeg,image/png,image/webp"
                                data-img-field="tech-imagem" data-img-preview="tech-img-prev" data-img-empty="tech-img-empty">
                            <input type="hidden" id="tech-imagem" value="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Como funciona -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Como funciona</h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="comoTitulo" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="comoTexto" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 1</label>
                            <input type="text" class="formGroup__input" id="comoStep-0" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 2</label>
                            <input type="text" class="formGroup__input" id="comoStep-1" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 3</label>
                            <input type="text" class="formGroup__input" id="comoStep-2" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 4</label>
                            <input type="text" class="formGroup__input" id="comoStep-3" maxlength="80">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Por que escolher -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Por que escolher o Wi-Fi Mesh da AserNet?</h3>
                <div class="formGroup__item">
                    <label class="formGroup__label">Título da seção</label>
                    <input type="text" class="formGroup__input" id="porqueTitulo" maxlength="120">
                </div>
                <div class="row" id="porqueContainer"></div>
            </div>

            <!-- Seção: Ideal -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Ideal para quem usa muitos dispositivos</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título da seção</label>
                            <input type="text" class="formGroup__input" id="idealTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 1</label>
                            <input type="text" class="formGroup__input" id="idealItem-0" maxlength="40">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 2</label>
                            <input type="text" class="formGroup__input" id="idealItem-1" maxlength="40">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 3</label>
                            <input type="text" class="formGroup__input" id="idealItem-2" maxlength="40">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 4</label>
                            <input type="text" class="formGroup__input" id="idealItem-3" maxlength="40">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 5</label>
                            <input type="text" class="formGroup__input" id="idealItem-4" maxlength="40">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 6</label>
                            <input type="text" class="formGroup__input" id="idealItem-5" maxlength="40">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Performance -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Equipamentos de alta performance</h3>
                <div class="row">
                    <div class="col-md-4">
                        <label class="formGroup__label">Imagem</label>
                        <div class="adminConteudo__imgWrap">
                            <img class="adminConteudo__imgPreview" id="perf-img-prev" src="" alt="" style="display:none">
                            <span id="perf-img-empty" style="color:#b0bdd6;font-size:12px;">Sem imagem</span>
                            <label class="adminConteudo__imgBtn" for="upload-perf-img">Trocar imagem</label>
                            <input type="file" id="upload-perf-img" class="adminConteudo__fileInput"
                                accept="image/jpeg,image/png,image/webp"
                                data-img-field="perf-imagem" data-img-preview="perf-img-prev" data-img-empty="perf-img-empty">
                            <input type="hidden" id="perf-imagem" value="">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="perfTitulo" maxlength="80">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="perfTexto" maxlength="200">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Bullet 1</label>
                            <input type="text" class="formGroup__input" id="perfBullet-0" maxlength="80">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Bullet 2</label>
                            <input type="text" class="formGroup__input" id="perfBullet-1" maxlength="80">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Bullet 3</label>
                            <input type="text" class="formGroup__input" id="perfBullet-2" maxlength="80">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Bullet 4</label>
                            <input type="text" class="formGroup__input" id="perfBullet-3" maxlength="80">
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
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudowifimesh/conteudowifimesh.js?v=<?= time() ?>"></script>

</body>
</html>
