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
<title>AserNet - Admin - Câmeras de Segurança</title>
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
                    <h2>Conteúdo <span>Câmeras de Segurança</span></h2>
                    <p class="adminConteudo__subtitle">Edite os textos e imagens da página Câmeras de Segurança.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar alterações</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <!-- Seção: Dor -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Você nem sempre consegue estar presente</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="dorTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Destaque <small style="color:#8a9ab8">(parte em negrito)</small></label>
                            <input type="text" class="formGroup__input" id="dorDestaque" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 1</label>
                            <input type="text" class="formGroup__input" id="dorItem-0" maxlength="60">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 2</label>
                            <input type="text" class="formGroup__input" id="dorItem-1" maxlength="60">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 3</label>
                            <input type="text" class="formGroup__input" id="dorItem-2" maxlength="60">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 4</label>
                            <input type="text" class="formGroup__input" id="dorItem-3" maxlength="60">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Monitor -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Acompanhe tudo em tempo real</h3>
                <div class="row">
                    <div class="col-md-8">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="monitorTitulo" maxlength="120">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="monitorTexto" maxlength="300">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Bullets <small style="color:#8a9ab8">(até 5)</small></label>
                            <div id="monitorBullets"></div>
                            <button type="button" class="adminConteudo__addBulletBtn"
                                data-bullets-target="monitorBullets" data-bullets-max="5">+ Adicionar item</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="formGroup__label">Imagem principal</label>
                        <div class="adminConteudo__imgWrap">
                            <img class="adminConteudo__imgPreview" id="monitor-img-prev" src="" alt="" style="display:none">
                            <span id="monitor-img-empty" style="color:#b0bdd6;font-size:12px;">Sem imagem</span>
                            <label class="adminConteudo__imgBtn" for="upload-monitor-img">Trocar imagem</label>
                            <input type="file" id="upload-monitor-img" class="adminConteudo__fileInput"
                                accept="image/jpeg,image/png,image/webp"
                                data-img-field="monitor-imagem" data-img-preview="monitor-img-prev" data-img-empty="monitor-img-empty">
                            <input type="hidden" id="monitor-imagem" value="">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:16px">
                    <div class="col-md-6">
                        <div class="adminConteudo__card">
                            <p class="adminConteudo__cardLabel">Card — Para sua casa</p>
                            <div class="formGroup__item">
                                <label class="formGroup__label">Título</label>
                                <input type="text" class="formGroup__input" id="monitorCasaTitulo" maxlength="40">
                            </div>
                            <div class="formGroup__item">
                                <label class="formGroup__label">Texto</label>
                                <input type="text" class="formGroup__input" id="monitorCasaTexto" maxlength="160">
                            </div>
                            <label class="formGroup__label">Imagem</label>
                            <div class="adminConteudo__imgWrap">
                                <img class="adminConteudo__imgPreview" id="monitor-casa-img-prev" src="" alt="" style="display:none">
                                <span id="monitor-casa-img-empty" style="color:#b0bdd6;font-size:12px;">Sem imagem</span>
                                <label class="adminConteudo__imgBtn" for="upload-monitor-casa-img">Trocar imagem</label>
                                <input type="file" id="upload-monitor-casa-img" class="adminConteudo__fileInput"
                                    accept="image/jpeg,image/png,image/webp"
                                    data-img-field="monitor-casa-imagem" data-img-preview="monitor-casa-img-prev" data-img-empty="monitor-casa-img-empty">
                                <input type="hidden" id="monitor-casa-imagem" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="adminConteudo__card">
                            <p class="adminConteudo__cardLabel">Card — Para sua empresa</p>
                            <div class="formGroup__item">
                                <label class="formGroup__label">Título</label>
                                <input type="text" class="formGroup__input" id="monitorEmpresaTitulo" maxlength="40">
                            </div>
                            <div class="formGroup__item">
                                <label class="formGroup__label">Texto</label>
                                <input type="text" class="formGroup__input" id="monitorEmpresaTexto" maxlength="160">
                            </div>
                            <label class="formGroup__label">Imagem</label>
                            <div class="adminConteudo__imgWrap">
                                <img class="adminConteudo__imgPreview" id="monitor-empresa-img-prev" src="" alt="" style="display:none">
                                <span id="monitor-empresa-img-empty" style="color:#b0bdd6;font-size:12px;">Sem imagem</span>
                                <label class="adminConteudo__imgBtn" for="upload-monitor-empresa-img">Trocar imagem</label>
                                <input type="file" id="upload-monitor-empresa-img" class="adminConteudo__fileInput"
                                    accept="image/jpeg,image/png,image/webp"
                                    data-img-field="monitor-empresa-imagem" data-img-preview="monitor-empresa-img-prev" data-img-empty="monitor-empresa-img-empty">
                                <input type="hidden" id="monitor-empresa-imagem" value="">
                            </div>
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

            <!-- Seção: Como funciona -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Como funciona</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="comoTitulo" maxlength="80">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="comoTexto" maxlength="120">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 1</label>
                            <input type="text" class="formGroup__input" id="comoStep-0" maxlength="80">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 2</label>
                            <input type="text" class="formGroup__input" id="comoStep-1" maxlength="80">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 3</label>
                            <input type="text" class="formGroup__input" id="comoStep-2" maxlength="80">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 4</label>
                            <input type="text" class="formGroup__input" id="comoStep-3" maxlength="80">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="adminConteudo__card">
                            <p class="adminConteudo__cardLabel">Card — Aplicativo</p>
                            <div class="formGroup__item">
                                <label class="formGroup__label">Título</label>
                                <input type="text" class="formGroup__input" id="comoAppTitulo" maxlength="60">
                            </div>
                            <div class="formGroup__item">
                                <label class="formGroup__label">Texto</label>
                                <input type="text" class="formGroup__input" id="comoAppTexto" maxlength="160">
                            </div>
                            <div class="formGroup__item">
                                <label class="formGroup__label">Bullets <small style="color:#8a9ab8">(até 3)</small></label>
                                <div id="comoAppBullets"></div>
                                <button type="button" class="adminConteudo__addBulletBtn adminConteudo__addBulletBtn--sm"
                                    data-bullets-target="comoAppBullets" data-bullets-max="3">+ Adicionar item</button>
                            </div>
                            <label class="formGroup__label">Imagem</label>
                            <div class="adminConteudo__imgWrap">
                                <img class="adminConteudo__imgPreview" id="como-app-img-prev" src="" alt="" style="display:none">
                                <span id="como-app-img-empty" style="color:#b0bdd6;font-size:12px;">Sem imagem</span>
                                <label class="adminConteudo__imgBtn" for="upload-como-app-img">Trocar imagem</label>
                                <input type="file" id="upload-como-app-img" class="adminConteudo__fileInput"
                                    accept="image/jpeg,image/png,image/webp"
                                    data-img-field="como-app-imagem" data-img-preview="como-app-img-prev" data-img-empty="como-app-img-empty">
                                <input type="hidden" id="como-app-imagem" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Diferenciais -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Diferenciais Aser Câmeras</h3>
                <div class="formGroup__item">
                    <label class="formGroup__label">Título da seção</label>
                    <input type="text" class="formGroup__input" id="diferenciaisTitulo" maxlength="80">
                </div>
                <div class="row" id="diferenciaisContainer"></div>
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
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudocameras/conteudocameras.js?v=<?= time() ?>"></script>

</body>
</html>
