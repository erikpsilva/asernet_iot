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
<title>AserNet - Admin - Plano Móvel</title>
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
                    <h2>Conteúdo <span>Plano Móvel</span></h2>
                    <p class="adminConteudo__subtitle">Edite os textos e imagens da página Plano Móvel.</p>
                </div>
                <div class="col-sm-4 adminConteudo__headActions">
                    <button class="btn btn--primary" id="btnSalvarConteudo">Salvar alterações</button>
                </div>
            </div>

            <div id="conteudoMsg" class="adminConteudo__msg" style="display:none"></div>

            <!-- Seção: Rotina -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Sua conexão não pode parar...</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="rotinaTitulo" maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 1</label>
                            <input type="text" class="formGroup__input" id="rotinaItem-0" maxlength="50">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 2</label>
                            <input type="text" class="formGroup__input" id="rotinaItem-1" maxlength="50">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 3</label>
                            <input type="text" class="formGroup__input" id="rotinaItem-2" maxlength="50">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 4</label>
                            <input type="text" class="formGroup__input" id="rotinaItem-3" maxlength="50">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Item 5</label>
                            <input type="text" class="formGroup__input" id="rotinaItem-4" maxlength="50">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Planos -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Planos</h3>
                <div class="row">
                    <div class="col-md-8">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título da seção</label>
                            <input type="text" class="formGroup__input" id="planosTitulo" maxlength="100">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto portabilidade</label>
                            <input type="text" class="formGroup__input" id="planosPortabilidade" maxlength="80">
                        </div>
                    </div>
                </div>
                <div class="row" id="planosContainer"></div>
            </div>

            <!-- Seção: Benefícios -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Benefícios</h3>
                <div class="formGroup__item">
                    <label class="formGroup__label">Título da seção</label>
                    <input type="text" class="formGroup__input" id="beneficiosTitulo" maxlength="80">
                </div>
                <div class="row" id="beneficiosContainer"></div>
            </div>

            <!-- Seção: Como funciona -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Como funciona</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="comoTitulo" maxlength="100">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 1 — negrito</label>
                            <input type="text" class="formGroup__input" id="comoTit-0" maxlength="40">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 1 — texto</label>
                            <input type="text" class="formGroup__input" id="comoTxt-0" maxlength="60">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 2 — negrito</label>
                            <input type="text" class="formGroup__input" id="comoTit-1" maxlength="40">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 2 — texto</label>
                            <input type="text" class="formGroup__input" id="comoTxt-1" maxlength="60">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 3 — negrito</label>
                            <input type="text" class="formGroup__input" id="comoTit-2" maxlength="40">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 3 — texto</label>
                            <input type="text" class="formGroup__input" id="comoTxt-2" maxlength="60">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 4 — negrito</label>
                            <input type="text" class="formGroup__input" id="comoTit-3" maxlength="40">
                        </div>
                        <div class="formGroup__item">
                            <label class="formGroup__label">Passo 4 — texto</label>
                            <input type="text" class="formGroup__input" id="comoTxt-3" maxlength="60">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Ecossistema -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Ecossistema AserNet</h3>
                <div class="row">
                    <div class="col-md-8">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Título</label>
                            <input type="text" class="formGroup__input" id="ecoTitulo" maxlength="160">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Resultado (texto após =)</label>
                            <input type="text" class="formGroup__input" id="ecoResultado" maxlength="60">
                        </div>
                    </div>
                </div>
                <div class="row" id="ecoContainer"></div>
            </div>

            <!-- Seção: Trust -->
            <div class="formGroup adminConteudo__section">
                <h3 class="adminConteudo__sectionTitle">Seção — Atendimento local / Clientes satisfeitos</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="formGroup__item">
                            <label class="formGroup__label">Texto Google</label>
                            <input type="text" class="formGroup__input" id="trustGoogle" maxlength="60">
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
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudomovel/conteudomovel.js?v=<?= time() ?>"></script>

</body>
</html>
