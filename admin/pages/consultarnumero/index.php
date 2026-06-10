<?php include ROOT . '/admin/includes/auth_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Admin - Consultar Número da Sorte</title>
<?php include ROOT . '/admin/includes/assets.php'; ?>
</head>
<body>

<?php include ROOT . '/admin/includes/header/header.php'; ?>

<div class="adminLayout">
    <?php include ROOT . '/admin/includes/sidebar/sidebar.php'; ?>
    <main class="adminLayout__content">

        <section class="consultNumerosPage">
            <header class="consultNumerosPage__header">
                <span>Campanha Cruzeiro</span>
                <h1>Consultar n&uacute;mero da sorte</h1>
                <p>Busque pelo CPF do assinante para visualizar os bilhetes cadastrados.</p>
            </header>

            <div class="formGroup consultNumerosPage__search">
                <div class="row">
                    <div class="col-md-12 formGroup__divisor">
                        <h3>Consultar <span>número da sorte</span></h3>
                    </div>
                    <div class="col-md-12">
                        <div class="formGroup__item">
                            <label>CPF do assinante</label>
                            <input class="input" type="text" id="cpfAssinante" placeholder="000.000.000-00">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn--primary" id="consultarNumbers" type="button">Consultar</button>
                    </div>
                </div>
            </div>

            <div id="resultsSection" class="consultNumerosPage__resultsSection" style="display:none;">
                <p class="consultNumerosPage__resultsTitle">
                    Resultados para: <strong id="personName"></strong>
                </p>
                <div id="resultsList" class="consultNumerosPage__results"></div>
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
<?php $v = time(); echo '<script src="' . ADMIN_BASE_URL . '/pages/consultarnumero/consultarnumero.js?v=' . $v . '"></script>'; ?>

</body>
</html>
