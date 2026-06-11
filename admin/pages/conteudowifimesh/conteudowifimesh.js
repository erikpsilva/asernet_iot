(function ($) {
    'use strict';

    var API_BASE = ADMIN_BASE + '/services/api/content/';
    var content  = {};

    /* ---------- bullets ---------- */
    function buildBulletRow(val) {
        return '<div class="adminConteudo__bulletRow">' +
            '<input type="text" class="formGroup__input adminConteudo__bulletInput" value="' + escHtml(val) + '" maxlength="120">' +
            '<button type="button" class="adminConteudo__removeBullet">&#x2715;</button>' +
            '</div>';
    }

    function renderBullets(containerId, items) {
        var $c = $('#' + containerId).empty();
        $.each(items, function (_, v) { $c.append(buildBulletRow(v)); });
    }

    function collectBullets(containerId) {
        var out = [];
        $('#' + containerId + ' .adminConteudo__bulletInput').each(function () {
            var v = $(this).val().trim();
            if (v) out.push(v);
        });
        return out;
    }

    /* ---------- "Por que escolher" cards ---------- */
    function renderPorque(items) {
        var $c = $('#porqueContainer').empty();
        $.each(items, function (i, item) {
            $c.append(
                '<div class="col-md-6">' +
                    '<div class="adminConteudo__card">' +
                        '<label class="formGroup__label adminConteudo__cardLabel">Título</label>' +
                        '<input type="text" class="formGroup__input" id="porqueTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="80">' +
                        '<label class="formGroup__label adminConteudo__cardLabel" style="margin-top:8px">Texto</label>' +
                        '<input type="text" class="formGroup__input" id="porqueTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="200">' +
                    '</div>' +
                '</div>'
            );
        });
    }

    function collectPorque(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({ titulo: $('#porqueTit-' + i).val().trim(), texto: $('#porqueTxt-' + i).val().trim() });
        }
        return out;
    }

    /* ---------- image util ---------- */
    function escHtml(str) {
        return $('<div>').text(str || '').html();
    }

    function loadStaticImg(fieldId, previewId, emptyId, filename) {
        if (!filename) return;
        $('#' + previewId).attr('src', SITE_BASE + '/images/wifimesh/' + filename).show();
        $('#' + emptyId).hide();
        $('#' + fieldId).val(filename);
    }

    /* ---------- load ---------- */
    function loadConteudo() {
        $.get(API_BASE + 'get_wifimesh_content.php', function (res) {
            if (!res.ok) return;
            content = res.content;
            var c = content;

            /* dor */
            $('#dorTitulo').val(c.dor_titulo);
            $('#dorTitulo2').val(c.dor_titulo2);
            $.each(c.dor_items || [], function (i, v) { $('#dorItem-' + i).val(v); });

            /* tech */
            $('#techTitulo').val(c.tech_titulo);
            $('#techTexto').val(c.tech_texto);
            renderBullets('techBullets', c.tech_bullets || []);
            loadStaticImg('tech-imagem', 'tech-img-prev', 'tech-img-empty', c.tech_imagem);

            /* como funciona */
            $('#comoTitulo').val(c.como_titulo);
            $('#comoTexto').val(c.como_texto);
            $.each(c.como_steps || [], function (i, v) { $('#comoStep-' + i).val(v); });

            /* por que */
            $('#porqueTitulo').val(c.porque_titulo);
            renderPorque(c.porque_items || []);

            /* ideal */
            $('#idealTitulo').val(c.ideal_titulo);
            $.each(c.ideal_items || [], function (i, v) { $('#idealItem-' + i).val(v); });

            /* performance */
            $('#perfTitulo').val(c.perf_titulo);
            $('#perfTexto').val(c.perf_texto);
            $.each(c.perf_bullets || [], function (i, v) { $('#perfBullet-' + i).val(v); });
            loadStaticImg('perf-imagem', 'perf-img-prev', 'perf-img-empty', c.perf_imagem);
        });
    }

    /* ---------- save ---------- */
    function saveConteudo() {
        var porqueCount = (content.porque_items || []).length;

        var body = {
            dor_titulo:  $('#dorTitulo').val().trim(),
            dor_titulo2: $('#dorTitulo2').val().trim(),
            dor_items:   [],

            tech_titulo:  $('#techTitulo').val().trim(),
            tech_texto:   $('#techTexto').val().trim(),
            tech_bullets: collectBullets('techBullets'),
            tech_imagem:  $('#tech-imagem').val().trim(),

            como_titulo: $('#comoTitulo').val().trim(),
            como_texto:  $('#comoTexto').val().trim(),
            como_steps:  [],

            porque_titulo: $('#porqueTitulo').val().trim(),
            porque_items:  collectPorque(porqueCount),

            ideal_titulo: $('#idealTitulo').val().trim(),
            ideal_items:  [],

            perf_titulo:  $('#perfTitulo').val().trim(),
            perf_texto:   $('#perfTexto').val().trim(),
            perf_imagem:  $('#perf-imagem').val().trim(),
            perf_bullets: [],
        };

        for (var i = 0; i < 5; i++) body.dor_items.push($('#dorItem-' + i).val().trim());
        for (var j = 0; j < 4; j++) body.como_steps.push($('#comoStep-' + j).val().trim());
        for (var k = 0; k < 6; k++) body.ideal_items.push($('#idealItem-' + k).val().trim());
        for (var l = 0; l < 4; l++) body.perf_bullets.push($('#perfBullet-' + l).val().trim());

        $.ajax({
            url:         API_BASE + 'save_wifimesh_content.php',
            method:      'POST',
            contentType: 'application/json',
            data:        JSON.stringify(body),
            success: function (res) {
                showMsg(res.ok, res.message || (res.ok ? 'Salvo!' : 'Erro ao salvar.'));
            },
            error: function () { showMsg(false, 'Erro de comunicação.'); }
        });
    }

    /* ---------- image upload (generic via data attrs) ---------- */
    $(document).on('change', 'input[type="file"][data-img-field]', function () {
        var $input   = $(this);
        var fieldId  = $input.data('img-field');
        var previewId= $input.data('img-preview');
        var emptyId  = $input.data('img-empty');
        var file     = this.files[0];
        if (!file) return;

        var fd = new FormData();
        fd.append('image', file);

        $.ajax({
            url:         API_BASE + 'upload_wifimesh_image.php',
            method:      'POST',
            data:        fd,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.ok) {
                    $('#' + fieldId).val(res.filename);
                    $('#' + previewId).attr('src', SITE_BASE + '/images/wifimesh/' + res.filename).show();
                    if (emptyId) $('#' + emptyId).hide();
                } else {
                    showMsg(false, res.message || 'Erro no upload.');
                }
            },
            error: function () { showMsg(false, 'Erro no upload.'); }
        });
    });

    /* ---------- bullet: add / remove ---------- */
    $(document).on('click', '[data-bullets-target]', function () {
        var targetId = $(this).data('bullets-target');
        var max      = parseInt($(this).data('bullets-max'), 10) || 5;
        var $c       = $('#' + targetId);
        if ($c.find('.adminConteudo__bulletRow').length >= max) return;
        $c.append(buildBulletRow(''));
    });

    $(document).on('click', '.adminConteudo__removeBullet', function () {
        $(this).closest('.adminConteudo__bulletRow').remove();
    });

    /* ---------- save button ---------- */
    $('#btnSalvarConteudo').on('click', saveConteudo);

    /* ---------- msg ---------- */
    function showMsg(ok, text) {
        var $m = $('#conteudoMsg');
        $m.removeClass('adminConteudo__msg--ok adminConteudo__msg--err')
          .addClass(ok ? 'adminConteudo__msg--ok' : 'adminConteudo__msg--err')
          .text(text).show();
        setTimeout(function () { $m.fadeOut(); }, 3500);
    }

    /* ---------- init ---------- */
    loadConteudo();

}(jQuery));
