<?php include ROOT . '/admin/includes/auth_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Admin - Config. do Sorteio</title>
<?php include ROOT . '/admin/includes/assets.php'; ?>
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
.ql-editor strong { font-weight: 600 !important; }
.ql-snow .ql-editor { min-height: 220px; font-family: inherit; font-size: 14px; line-height: 1.6; color: #06133c; }
.ql-toolbar.ql-snow { border-radius: 6px 6px 0 0; border-color: #d0daea; background: #f7faff; }
.ql-container.ql-snow { border-radius: 0 0 6px 6px; border-color: #d0daea; }
</style>
</head>
<body>

<?php include ROOT . '/admin/includes/header/header.php'; ?>

<div class="adminLayout">
    <?php include ROOT . '/admin/includes/sidebar/sidebar.php'; ?>
    <main class="adminLayout__content">

        <section class="cruzConf">
            <div class="formGroup" style="max-width: 720px;">
                <div class="row">

                    <div class="col-md-12 formGroup__divisor">
                        <h3>Data e hora do <span>sorteio</span></h3>
                    </div>
                    <div class="col-md-6">
                        <div class="formGroup__item">
                            <label>Data e hora</label>
                            <input class="input" type="datetime-local" id="sorteioDate">
                            <small style="color:#8a9ab8;font-size:12px;margin-top:4px;display:block;">Horário de Brasília (UTC-3). Esta data atualiza o contador na página do cruzeiro.</small>
                        </div>
                    </div>

                    <div class="col-md-12 formGroup__divisor">
                        <h3>Regulamento da <span>promoção</span></h3>
                    </div>
                    <div class="col-md-12">
                        <div class="formGroup__item">
                            <label>Título</label>
                            <input class="input" type="text" id="regulamentoTitulo" placeholder="Ex.: Regulamento da Promoção Cruzeiro AserNet">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="formGroup__item">
                            <label>Texto do regulamento</label>
                            <div id="quillEditor"></div>
                            <input type="hidden" id="regulamentoTexto">
                        </div>
                    </div>

                    <div class="col-md-12" style="margin-top: 20px;">
                        <button class="btn btn--primary cruzConf__save" id="saveConf" type="button">Salvar configurações</button>
                        <span class="configPage__feedback" id="confFeedback"></span>
                    </div>

                </div>
            </div>
        </section>

    </main>
</div>

<?php include ROOT . '/admin/includes/footer/footer.php'; ?>
<?php include ROOT . '/admin/includes/scripts.php'; ?>
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    var ADMIN_BASE_URL = "<?= ADMIN_BASE_URL ?>";
    var BASE_URL       = "<?= BASE_URL ?>";
</script>
<?php $v = time(); echo '<script src="' . ADMIN_BASE_URL . '/pages/cruzeiroconfiguracao/cruzeiroconfiguracao.js?v=' . $v . '"></script>'; ?>

</body>
</html>
