<?php include ROOT . '/admin/includes/auth_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Admin - Relatório Cruzeiro</title>
<?php include ROOT . '/admin/includes/assets.php'; ?>
</head>
<body>

<?php include ROOT . '/admin/includes/header/header.php'; ?>

<div class="adminLayout">
    <?php include ROOT . '/admin/includes/sidebar/sidebar.php'; ?>
    <main class="adminLayout__content">

        <section class="relatorioPage">
            <header class="relatorioPage__header">
                <span>Campanha Cruzeiro</span>
                <h1>Relat&oacute;rio</h1>
                <p>Exporte os dados da campanha ou gere os bilhetes para impress&atilde;o.</p>
            </header>

            <div class="formGroup relatorioPage__box">
                <div class="row">
                    <div class="col-md-12 formGroup__divisor">
                        <h3>Relatório <span>campanha cruzeiro</span></h3>
                    </div>
                    <div class="col-md-12">
                        <div class="relatorioPage__actions">
                            <button class="btn btn--primary" id="downloadReport" type="button">
                                Baixar relatório (CSV)
                            </button>
                            <button class="btn btn--gray" id="generatePrint" type="button">
                                Gerar Bilhetes
                            </button>
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
<?php $v = time(); echo '<script src="' . ADMIN_BASE_URL . '/pages/relatorio/relatorio.js?v=' . $v . '"></script>'; ?>

</body>
</html>
