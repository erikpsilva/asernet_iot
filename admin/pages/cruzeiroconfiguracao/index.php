<?php include ROOT . '/admin/includes/auth_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Admin - Config. do Sorteio</title>
<?php include ROOT . '/admin/includes/assets.php'; ?>
<style>
.regulamentoPdf__box { display:flex; align-items:center; gap:12px; padding:12px 16px; background:#f4f8ff; border:1px solid #d0daea; border-radius:6px; font-size:13px; color:#06133c; }
.regulamentoPdf__box i { color:#075fff; font-size:22px; flex-shrink:0; }
.regulamentoPdf__info { flex:1; min-width:0; }
.regulamentoPdf__info strong { display:block; font-size:13px; }
.regulamentoPdf__info a { font-size:12px; color:#075fff; }
.regulamentoPdf__actions { display:flex; gap:8px; margin-top:10px; }
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
                            <label>Título exibido no modal</label>
                            <input class="input" type="text" id="regulamentoTitulo" placeholder="Ex.: Regulamento da Promoção Cruzeiro AserNet">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="formGroup__item">
                            <label>Arquivo PDF do regulamento</label>
                            <div class="regulamentoPdf__box" id="regulamentoPdfBox">
                                <i class="icon-calendar" aria-hidden="true"></i>
                                <div class="regulamentoPdf__info">
                                    <strong id="regulamentoPdfNome">Nenhum arquivo enviado</strong>
                                    <a id="regulamentoPdfVer" href="#" target="_blank" style="display:none">Visualizar PDF atual</a>
                                </div>
                            </div>
                            <div class="regulamentoPdf__actions">
                                <input type="file" id="regulamentoPdfInput" accept="application/pdf" style="display:none">
                                <button type="button" class="btn btn--secondary" id="btnUploadPdf">Enviar novo PDF</button>
                                <span id="pdfUploadFeedback" style="font-size:13px;line-height:36px;"></span>
                            </div>
                            <small style="color:#8a9ab8;font-size:12px;margin-top:4px;display:block;">Máximo 10 MB. O arquivo substituirá o PDF anterior.</small>
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
<script>
    var ADMIN_BASE_URL = "<?= ADMIN_BASE_URL ?>";
    var BASE_URL       = "<?= BASE_URL ?>";
</script>
<?php $v = time(); echo '<script src="' . ADMIN_BASE_URL . '/pages/cruzeiroconfiguracao/cruzeiroconfiguracao.js?v=' . $v . '"></script>'; ?>

</body>
</html>
