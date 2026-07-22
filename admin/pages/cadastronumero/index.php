<?php include ROOT . '/admin/includes/auth_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Admin - Cadastrar Número da Sorte</title>
<?php include ROOT . '/admin/includes/assets.php'; ?>
</head>
<body>

<?php include ROOT . '/admin/includes/header/header.php'; ?>

<div class="adminLayout">
    <?php include ROOT . '/admin/includes/sidebar/sidebar.php'; ?>
    <main class="adminLayout__content">

        <section class="cadNumerosPage">
            <header class="cadNumerosPage__header">
                <span>Campanha Cruzeiro</span>
                <h1>Cadastrar n&uacute;mero da sorte</h1>
                <p>Registre indica&ccedil;&otilde;es ou novos assinantes e gere os bilhetes para o sorteio.</p>
            </header>

            <div class="cadNumerosPage__tabs">
                <button class="cadNumerosPage__tab is-active" data-tab="indicacao" type="button">Indicação</button>
                <button class="cadNumerosPage__tab" data-tab="novo" type="button">Novo Assinante</button>
            </div>

            <!-- PAINEL: Indicação -->
            <div class="cadNumerosPage__panel is-active" id="panel-indicacao">

                <!-- Form -->
                <div class="cadNumerosPage__state is-active" id="indicacao-form">
                    <div class="formGroup">
                        <div class="row">
                            <div class="col-md-12 formGroup__divisor">
                                <h3>Quem está <span>indicando</span></h3>
                            </div>
                            <div class="col-md-6">
                                <div class="formGroup__item">
                                    <label>Nome *</label>
                                    <input class="input" type="text" id="nameInd" placeholder="Nome completo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="formGroup__item">
                                    <label>Telefone</label>
                                    <input class="input" type="text" id="phoneInd" placeholder="(00) 00000-0000">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="formGroup__item">
                                    <label>E-mail *</label>
                                    <input class="input" type="email" id="emailInd" placeholder="email@exemplo.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="formGroup__item">
                                    <label>CPF *</label>
                                    <input class="input" type="text" id="cpfInd" placeholder="000.000.000-00">
                                </div>
                            </div>

                            <div class="col-md-12 formGroup__divisor">
                                <h3>Novo <span>assinante</span></h3>
                            </div>
                            <div class="col-md-6">
                                <div class="formGroup__item">
                                    <label>Nome *</label>
                                    <input class="input" type="text" id="nameNew" placeholder="Nome completo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="formGroup__item">
                                    <label>Telefone</label>
                                    <input class="input" type="text" id="phoneNew" placeholder="(00) 00000-0000">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="formGroup__item">
                                    <label>E-mail *</label>
                                    <input class="input" type="email" id="emailNew" placeholder="email@exemplo.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="formGroup__item">
                                    <label>CPF *</label>
                                    <input class="input" type="text" id="cpfNew" placeholder="000.000.000-00">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn--primary cadNumerosPage__submit" id="sendIndNew" type="button">Gerar n&uacute;meros da sorte</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sucesso -->
                <div class="cadNumerosPage__state" id="indicacao-success">
                    <div class="formGroup">
                        <div class="cadNumerosPage__successCard">
                            <div class="cadNumerosPage__successBlock">
                                <p class="cadNumerosPage__successTitle">Número da Sorte — Quem Indicou</p>
                                <p class="cadNumerosPage__successNumber" id="numIndicou">—</p>
                                <div class="cadNumerosPage__copyBox">
                                    <textarea class="cadNumerosPage__copyText" id="msgIndicou" readonly></textarea>
                                    <button class="cadNumerosPage__copyBtn" id="copyIndicou" type="button">Copiar texto</button>
                                </div>
                            </div>
                            <div class="cadNumerosPage__successBlock">
                                <p class="cadNumerosPage__successTitle">Número da Sorte — Novo Cliente AserNet</p>
                                <p class="cadNumerosPage__successNumber" id="numNovoCliente">—</p>
                                <div class="cadNumerosPage__copyBox">
                                    <textarea class="cadNumerosPage__copyText" id="msgNovoCliente" readonly></textarea>
                                    <button class="cadNumerosPage__copyBtn" id="copyNovoCliente" type="button">Copiar texto</button>
                                </div>
                            </div>
                            <button class="btn btn--gray" id="resetIndicacao" type="button">Nova indicação</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- PAINEL: Novo Assinante -->
            <div class="cadNumerosPage__panel" id="panel-novo">

                <!-- Form -->
                <div class="cadNumerosPage__state is-active" id="novo-form">
                    <div class="formGroup">
                        <div class="row">
                            <div class="col-md-12 formGroup__divisor">
                                <h3>Novo <span>assinante</span></h3>
                            </div>
                            <div class="col-md-6">
                                <div class="formGroup__item">
                                    <label>Nome *</label>
                                    <input class="input" type="text" id="na_nome" placeholder="Nome completo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="formGroup__item">
                                    <label>Telefone</label>
                                    <input class="input" type="text" id="na_tel" placeholder="(00) 00000-0000">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="formGroup__item">
                                    <label>E-mail</label>
                                    <input class="input" type="email" id="na_email" placeholder="email@exemplo.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="formGroup__item">
                                    <label>CPF *</label>
                                    <input class="input" type="text" id="na_cpf" placeholder="000.000.000-00">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn--primary cadNumerosPage__submit" id="enviaSomenteNovoAssinante" type="button">Gerar n&uacute;mero da sorte</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sucesso -->
                <div class="cadNumerosPage__state" id="novo-success">
                    <div class="formGroup">
                        <div class="cadNumerosPage__successCard">
                            <div class="cadNumerosPage__successBlock">
                                <p class="cadNumerosPage__successTitle">Número da Sorte</p>
                                <p class="cadNumerosPage__successNumber" id="numSorteNovo">—</p>
                                <div class="cadNumerosPage__copyBox">
                                    <textarea class="cadNumerosPage__copyText" id="msgSorteNovo" readonly></textarea>
                                    <button class="cadNumerosPage__copyBtn" id="copySorteNovo" type="button">Copiar texto</button>
                                </div>
                            </div>
                            <button class="btn btn--gray" id="resetNovo" type="button">Novo cadastro</button>
                        </div>
                    </div>
                </div>

            </div>

        </section>

    </main>
</div>

<?php include ROOT . '/admin/includes/footer/footer.php'; ?>
<?php include ROOT . '/admin/includes/scripts.php'; ?>
<script>
    var ADMIN_BASE_URL = "<?= ADMIN_BASE_URL ?>";
    var BASE_URL = "<?= BASE_URL ?>";
</script>
<?php $v = time(); echo '<script src="' . ADMIN_BASE_URL . '/pages/cadastronumero/cadastronumero.js?v=' . $v . '"></script>'; ?>

</body>
</html>
