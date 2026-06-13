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
<title>AserNet - Admin - Para Empresas</title>
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
                    <h2>Conteúdo <span>Para Empresas</span></h2>
                    <p class="adminConteudo__subtitle">Edite os textos e imagens da página Para Empresas.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar alterações</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <!-- Seção: Problemas -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Sua empresa depende de tecnologia</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="probTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="probTexto" maxlength="200">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $probLabels = ['Internet instável', 'Wi-Fi congestionado', 'Atendimento falhando', 'Sistemas lentos', 'Impacto na produtividade'];
                    foreach ($probLabels as $i => $lbl): ?>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item <?= $i + 1 ?> <small>(ícone fixo)</small></label>
                            <input type="text" class="formGroup__input" id="probItem-<?= $i ?>" maxlength="60" placeholder="<?= htmlspecialchars($lbl) ?>">
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Seção: Soluções Integradas -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Soluções integradas para empresas modernas</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="intTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="intTexto" maxlength="300">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $intBullets = ['Projetos personalizados', 'Estrutura escalável', 'Atendimento especializado', 'Suporte local'];
                    foreach ($intBullets as $i => $lbl): ?>
                    <div class="col-md-3">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Bullet <?= $i + 1 ?></label>
                            <input type="text" class="formGroup__input" id="intBullet-<?= $i ?>" maxlength="60" placeholder="<?= htmlspecialchars($lbl) ?>">
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Seção: Soluções Empresariais -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Soluções empresariais</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título da seção</label>
                            <input type="text" class="formGroup__input" id="solTitulo" maxlength="80">
                        </div>
                    </div>
                </div>
                <p class="formGroup__label" style="margin-bottom:8px">Cards de soluções (5 fixos — ícones fixos)</p>
                <div class="row" id="solCardsContainer"></div>
            </div>

            <!-- Seção: Por que escolher -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Por que escolher a AserNet?</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título da seção</label>
                            <input type="text" class="formGroup__input" id="whyTitulo" maxlength="80">
                        </div>
                    </div>
                </div>
                <div class="row" id="whyContainer"></div>
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
                </div>
                <div class="row">
                    <?php
                    $audLabels = ['Escritórios', 'Hotéis e pousadas', 'Clínicas', 'Comércios', 'Escolas', 'Empresas com múltiplos usuários', 'Restaurantes'];
                    foreach ($audLabels as $i => $lbl): ?>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item <?= $i + 1 ?> <small>(ícone fixo)</small></label>
                            <input type="text" class="formGroup__input" id="audItem-<?= $i ?>" maxlength="60" placeholder="<?= htmlspecialchars($lbl) ?>">
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <h4 class="adminConteudo__sectionTitle" style="font-size:14px;margin-top:24px">Tecnologia integrada</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="techTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto</label>
                            <input type="text" class="formGroup__input" id="techTexto" maxlength="200">
                        </div>
                    </div>
                </div>
                <p class="formGroup__label" style="font-size:12px;color:#b0bdd6">O fluxo de ícones (Internet → Wi-Fi Pro → Telefonia → Link → Segurança) é fixo.</p>
            </div>

            <!-- Seção: Benefícios -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Benefícios para sua empresa</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título da seção</label>
                            <input type="text" class="formGroup__input" id="benTitulo" maxlength="80">
                        </div>
                    </div>
                </div>
                <div class="row" id="benContainer"></div>
            </div>

            <!-- Seção: Trust -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Avaliações / Acompanhamento contínuo</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto Google</label>
                            <input type="text" class="formGroup__input" id="trustGoogle" maxlength="80">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $trustLabels = ['Atendimento local de verdade', 'Suporte especializado', 'Instalação profissional', 'Acompanhamento contínuo'];
                    foreach ($trustLabels as $i => $lbl): ?>
                    <div class="col-md-3">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item <?= $i + 1 ?> <small>(ícone fixo)</small></label>
                            <input type="text" class="formGroup__input" id="trustItem-<?= $i ?>" maxlength="60" placeholder="<?= htmlspecialchars($lbl) ?>">
                        </div>
                    </div>
                    <?php endforeach; ?>
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
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudoparaempresas/conteudoparaempresas.js?v=<?= time() ?>"></script>

</body>
</html>
