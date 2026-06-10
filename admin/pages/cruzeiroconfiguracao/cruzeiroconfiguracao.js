$(function () {
    var API = ADMIN_BASE_URL + '/services/api/settings';

    // ── Quill init ──────────────────────────────────────────────────────────
    var quill = new Quill('#quillEditor', {
        theme: 'snow',
        placeholder: 'Escreva o regulamento aqui…',
        modules: {
            toolbar: [
                [{ header: [2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['link'],
                ['clean']
            ]
        }
    });

    // Bold = semibold: override Quill format
    var Bold = Quill.import('formats/bold');
    Bold.tagName = 'strong';
    Quill.register(Bold, true);

    // ── Load settings ────────────────────────────────────────────────────────
    $.ajax({
        url: API + '/get_settings.php',
        method: 'GET',
        success: function (res) {
            if (!res.ok) return;
            var s = res.settings || {};

            if (s.sorteio_date) {
                // Strip timezone suffix for datetime-local input (expects YYYY-MM-DDTHH:MM)
                $('#sorteioDate').val(s.sorteio_date.substring(0, 16));
            }

            if (s.regulamento_titulo) {
                $('#regulamentoTitulo').val(s.regulamento_titulo);
            }

            if (s.regulamento_texto) {
                quill.root.innerHTML = s.regulamento_texto;
            }
        }
    });

    // ── Save ─────────────────────────────────────────────────────────────────
    $('#saveConf').on('click', function () {
        var dateVal  = $('#sorteioDate').val();
        var titulo   = $.trim($('#regulamentoTitulo').val());
        var htmlText = quill.root.innerHTML;

        // Quill empty state
        if (quill.getText().trim() === '') htmlText = '';

        var $btn = $(this).prop('disabled', true).text('Salvando…');
        var $fb  = $('#confFeedback').removeClass('is-success is-error').text('');

        $.ajax({
            url: API + '/save_settings.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                sorteio_date:       dateVal ? dateVal + ':00' : '',
                regulamento_titulo: titulo,
                regulamento_texto:  htmlText
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
