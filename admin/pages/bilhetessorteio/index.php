<?php include ROOT . '/admin/includes/auth_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Admin - Bilhetes de Sorteio</title>
<?php include ROOT . '/admin/includes/assets.php'; ?>
</head>
<body>

<?php include ROOT . '/admin/includes/header/header.php'; ?>

<div class="adminLayout">
    <?php include ROOT . '/admin/includes/sidebar/sidebar.php'; ?>
    <main class="adminLayout__content">

        <section class="bilhetesPage">

            <div class="bilhetesPage__header">
                <div>
                    <span>Campanha Cruzeiro</span>
                    <h1>Bilhetes de Sorteio</h1>
                    <p>Visualize e imprima os bilhetes gerados para o sorteio.</p>
                </div>
                <button class="btn btn--primary bilhetesPage__printBtn" id="downloadTickets" type="button">
                    Imprimir
                </button>
            </div>

            <div class="bilhetesPage__grid" id="insertResult">
                <p class="bilhetesPage__empty">Carregando bilhetes...</p>
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
<?php $v = time(); echo '<script src="' . ADMIN_BASE_URL . '/pages/bilhetessorteio/bilhetessorteio.js?v=' . $v . '"></script>'; ?>

</body>
</html>
