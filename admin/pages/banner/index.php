<?php include ROOT . '/admin/includes/auth_check.php'; ?>
<?php
if (!in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor', 'leitor'])) {
    header('Location: ' . BASE_URL . '/admin/inicio'); exit;
}

$pageLabels = [
    'inicio'           => 'Início',
    'residencial'      => 'Internet Residencial',
    'cameras'          => 'Câmeras de Segurança',
    'wifimesh'         => 'Wi-Fi Mesh',
    'movel'            => 'Plano Móvel',
    'rastreamento'     => 'Rastreamento Veicular',
    'skeelo'           => 'Skeelo',
    'paraempresas'     => 'Para Empresas',
    'wifiprofissional' => 'Wi-Fi Profissional',
    'telefonia'        => 'Telefonia Empresarial',
    'linkdedicado'     => 'Link Dedicado',
    'combo'            => 'Combo',
    'sobreasernet'     => 'Sobre AserNet',
    'nossaslojas'      => 'Nossas Lojas',
    'controlecorporativo' => 'Controle de Acesso Corporativo',
    'bairroseguro'     => 'Bairro Seguro',
    'controleconcominial' => 'Controle de Acesso Condominial',
    'condominiointeligente' => 'Condomínio Inteligente',
];

$pageKey = trim($_GET['page'] ?? '');
if (!isset($pageLabels[$pageKey])) {
    header('Location: ' . BASE_URL . '/admin/inicio'); exit;
}

$pageLabel = $pageLabels[$pageKey];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>AserNet - Admin - Banner <?= htmlspecialchars($pageLabel) ?></title>
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
                    <h2>Banner <span><?= htmlspecialchars($pageLabel) ?></span></h2>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar alterações</button>
                </div>
            </div>
            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <!-- Título -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Título do Banner</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Linha 1 (texto normal)</label>
                            <input type="text" class="formGroup__input" id="bnTitulo" maxlength="120"
                                   placeholder="Ex: Internet de verdade,">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Destaque (texto em azul / negrito)</label>
                            <input type="text" class="formGroup__input" id="bnTituloDestaque" maxlength="120"
                                   placeholder="Ex: sem complicação.">
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-top:12px">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Linha 3 (complemento, opcional)</label>
                            <input type="text" class="formGroup__input" id="bnTituloComplemento" maxlength="120"
                                   placeholder="Ex: para sua vida.">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Texto e Preço -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Subtítulo e Preço</h3>
                <div class="row">
                    <div class="col-md-8">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto / Subtítulo</label>
                            <input type="text" class="formGroup__input" id="bnTexto" maxlength="240"
                                   placeholder="Texto descritivo abaixo do título">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Preço (opcional)</label>
                            <input type="text" class="formGroup__input" id="bnPreco" maxlength="80"
                                   placeholder="Ex: A partir de R$ 49,90/mês">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bullets -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Lista de itens (bullets)</h3>
                <div id="bnBullets"></div>
                <button type="button" class="adminConteudo__addBulletBtn"
                        data-bullets-target="bnBullets" data-bullets-max="8">+ Adicionar item</button>
            </div>

            <!-- Botões -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Botões de ação</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Botão principal (texto)</label>
                            <input type="text" class="formGroup__input" id="bnBtn1" maxlength="80"
                                   placeholder="Ex: Quero contratar agora">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Botão telefone</label>
                            <input type="text" class="formGroup__input" id="bnBtn2" maxlength="40"
                                   placeholder="0800 222 5262">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Imagem hero -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Imagem do Banner</h3>
                <p class="adminConteudo__hint">Substitui o fundo padrão do banner. Recomendado: 1200×700px, JPG/PNG/WebP, máx. 3MB.</p>
                <div class="adminConteudo__imgWrap">
                    <img class="adminConteudo__imgPreview" id="bnImgPrev" src="" alt="" style="display:none">
                    <span id="bnImgEmpty" style="color:#b0bdd6;font-size:12px">Sem imagem personalizada</span>
                    <label class="adminConteudo__imgBtn" for="uploadBnImg">Enviar imagem</label>
                    <input type="file" id="uploadBnImg" class="adminConteudo__fileInput"
                           accept="image/jpeg,image/png,image/webp"
                           data-img-field="bnImagem" data-img-preview="bnImgPrev" data-img-empty="bnImgEmpty">
                    <input type="hidden" id="bnImagem" value="">
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
    var PAGE_KEY   = "<?= htmlspecialchars($pageKey) ?>";
</script>
<script src="<?= ADMIN_BASE_URL ?>/pages/banner/banner.js?v=<?= time() ?>"></script>
</body>
</html>
