$(function () {
    var API     = ADMIN_BASE_URL + '/services/api/settings';
    var pdfUrl  = BASE_URL + '/uploads/regulamento/regulamento.pdf';

    function showPdf(filename) {
        if (!filename) return;
        $('#regulamentoPdfNome').text(filename);
        $('#regulamentoPdfVer').attr('href', pdfUrl).show();
    }

    // ── Load settings ────────────────────────────────────────────────────────
    $.ajax({
        url: API + '/get_settings.php',
        method: 'GET',
        success: function (res) {
            if (!res.ok) return;
            var s = res.settings || {};

            if (s.sorteio_date) {
                $('#sorteioDate').val(s.sorteio_date.substring(0, 16));
            }
            if (s.regulamento_titulo) {
                $('#regulamentoTitulo').val(s.regulamento_titulo);
            }
            if (s.regulamento_pdf) {
                showPdf(s.regulamento_pdf);
            }
        }
    });

    // ── Upload PDF ───────────────────────────────────────────────────────────
    $('#btnUploadPdf').on('click', function () {
        $('#regulamentoPdfInput').trigger('click');
    });

    $('#regulamentoPdfInput').on('change', function () {
        var file = this.files[0];
        if (!file) return;

        var $fb = $('#pdfUploadFeedback').text('Enviando…').css('color', '#8a9ab8');
        var fd  = new FormData();
        fd.append('pdf', file);

        $.ajax({
            url:         API + '/upload_regulamento.php',
            method:      'POST',
            data:        fd,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.ok) {
                    showPdf(res.filename);
                    $fb.css('color', '#1d9e5c').text('PDF enviado com sucesso!');
                } else {
                    $fb.css('color', '#c0392b').text(res.message || 'Erro no upload.');
                }
                setTimeout(function () { $fb.text(''); }, 4000);
            },
            error: function () {
                $fb.css('color', '#c0392b').text('Erro de comunicação.');
                setTimeout(function () { $fb.text(''); }, 4000);
            }
        });

        // Reset input so same file can be re-sent
        $(this).val('');
    });

    // ── Save title + date ────────────────────────────────────────────────────
    $('#saveConf').on('click', function () {
        var dateVal = $('#sorteioDate').val();
        var titulo  = $.trim($('#regulamentoTitulo').val());

        var $btn = $(this).prop('disabled', true).text('Salvando…');
        var $fb  = $('#confFeedback').removeClass('is-success is-error').text('');

        $.ajax({
            url:         API + '/save_settings.php',
            method:      'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                sorteio_date:       dateVal ? dateVal + ':00' : '',
                regulamento_titulo: titulo
            }),
            success: function (res) {
                $btn.prop('disabled', false).text('Salvar configurações');
                if (res.ok) {
                    $fb.addClass('is-success').text('Salvo com sucesso!');
                    setTimeout(function () { $fb.text(''); }, 3000);
                } else {
                    $fb.addClass('is-error').text(res.message || 'Erro ao salvar.');
                }
            },
            error: function (xhr) {
                $btn.prop('disabled', false).text('Salvar configurações');
                var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Erro interno.';
                $fb.addClass('is-error').text(msg);
            }
        });
    });
});
