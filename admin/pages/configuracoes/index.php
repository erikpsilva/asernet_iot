<?php include ROOT . '/admin/includes/auth_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Admin - Configurações</title>
<?php include ROOT . '/admin/includes/assets.php'; ?>
</head>
<body>

<?php include ROOT . '/admin/includes/header/header.php'; ?>

<div class="adminLayout">
    <?php include ROOT . '/admin/includes/sidebar/sidebar.php'; ?>
    <main class="adminLayout__content">

        <section class="configPage">
            <div class="formGroup" style="max-width: 620px;">
                <div class="row">
                    <div class="col-md-12 formGroup__divisor">
                        <h3>E-mails de <span>contato</span></h3>
                    </div>
                    <div class="col-md-12">
                        <div class="formGroup__item">
                            <label>Destinatários dos e-mails do formulário de contato</label>
                            <textarea class="input configPage__textarea" id="contactEmails" rows="5"
                                placeholder="Um e-mail por linha:&#10;vendas@asernet.com.br&#10;contato@asernet.com.br"></textarea>
                            <small class="configPage__hint">Insira um endereço de e-mail por linha. Todos receberão uma cópia ao cliente preencher o formulário de contato do site.</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn--primary" id="saveSettings" type="button">Salvar configurações</button>
                        <span class="configPage__feedback" id="settingsFeedback"></span>
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
<?php $v = time(); echo '<script src="' . ADMIN_BASE_URL . '/pages/configuracoes/configuracoes.js?v=' . $v . '"></script>'; ?>

</body>
</html>
