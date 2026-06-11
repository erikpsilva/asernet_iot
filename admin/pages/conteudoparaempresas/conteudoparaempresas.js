(function ($) {
    'use strict';

    var API_BASE = ADMIN_BASE + '/services/api/content/';
    var IMG_BASE = SITE_BASE + '/images/paraempresas/';
    var content  = {};

    /* ---------- utils ---------- */
    function escHtml(str) {
        return $('<div>').text(str || '').html();
    }

    /* ---------- image widget ---------- */
    function buildImgWidget(fieldId, prevId, emptyId, filename) {
        var hasSrc    = !!filename;
        var src       = hasSrc ? IMG_BASE + filename : '';
        var prevStyle = hasSrc ? '' : 'display:none';
        var emptyVis  = hasSrc ? 'display:none' : '';
        return '<div class="adminConteudo__imgWrap">' +
            '<img class="adminConteudo__imgPreview" id="' + prevId + '" src="' + src + '" style="' + prevStyle + '">' +
            '<span id="' + emptyId + '" style="color:#b0bdd6;font-size:12px;' + emptyVis + '">Sem imagem</span>' +
            '<label class="adminConteudo__imgBtn" for="upload-' + prevId + '">Trocar imagem</label>' +
            '<input type="file" id="upload-' + prevId + '" class="adminConteudo__fileInput" accept="image/jpeg,image/png,image/webp"' +
            ' data-img-field="' + fieldId + '" data-img-preview="' + prevId + '" data-img-empty="' + emptyId + '">' +
            '<input type="hidden" id="' + fieldId + '" value="' + escHtml(filename || '') + '">' +
            '</div>';
    }

    /* ---------- sol cards (5 fixos, cada um com imagem) ---------- */
    var SOL_NAMES = ['Internet PME', 'Wi-Fi Profissional', 'Telefonia Empresarial', 'Link Dedicado', 'Segurança e Monitoramento'];

    function buildSolCard(i, item) {
        var fieldId = 'sol-img-' + i;
        var prevId  = 'sol-prev-' + i;
        var emptyId = 'sol-empty-' + i;
        return '<div class="col-md-6">' +
            '<div class="adminConteudo__card">' +
                '<p class="formGroup__label adminConteudo__cardLabel" style="font-weight:600">' + SOL_NAMES[i] + '</p>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Título</label>' +
                    '<input type="text" class="formGroup__input" id="solTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="80">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Texto</label>' +
                    '<input type="text" class="formGroup__input" id="solTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="200">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Imagem</label>' +
                    buildImgWidget(fieldId, prevId, emptyId, item.imagem) +
                '</div>' +
            '</div>' +
        '</div>';
    }

    function renderSolCards(items) {
        var $c = $('#solCardsContainer').empty();
        $.each(items, function (i, item) { $c.append(buildSolCard(i, item)); });
    }

    function collectSolCards(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({
                titulo: $('#solTit-' + i).val().trim(),
                texto:  $('#solTxt-' + i).val().trim(),
                imagem: $('#sol-img-' + i).val().trim(),
            });
        }
        return out;
    }

    /* ---------- why items (4 fixos, sem imagem) ---------- */
    function buildWhyCard(i, item) {
        return '<div class="col-md-6">' +
            '<div class="adminConteudo__card">' +
                '<label class="formGroup__label adminConteudo__cardLabel">Título</label>' +
                '<input type="text" class="formGroup__input" id="whyTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="80">' +
                '<label class="formGroup__label adminConteudo__cardLabel" style="margin-top:8px">Texto</label>' +
                '<input type="text" class="formGroup__input" id="whyTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="200">' +
            '</div>' +
        '</div>';
    }

    function renderWhyCards(items) {
        var $c = $('#whyContainer').empty();
        $.each(items, function (i, item) { $c.append(buildWhyCard(i, item)); });
    }

    function collectWhyItems(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({ titulo: $('#whyTit-' + i).val().trim(), texto: $('#whyTxt-' + i).val().trim() });
        }
        return out;
    }

    /* ---------- ben items (4 fixos, sem imagem) ---------- */
    function buildBenCard(i, item) {
        return '<div class="col-md-6">' +
            '<div class="adminConteudo__card">' +
                '<label class="formGroup__label adminConteudo__cardLabel">Título</label>' +
                '<input type="text" class="formGroup__input" id="benTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="80">' +
                '<label class="formGroup__label adminConteudo__cardLabel" style="margin-top:8px">Texto</label>' +
                '<input type="text" class="formGroup__input" id="benTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="200">' +
            '</div>' +
        '</div>';
    }

    function renderBenCards(items) {
        var $c = $('#benContainer').empty();
        $.each(items, function (i, item) { $c.append(buildBenCard(i, item)); });
    }

    function collectBenItems(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({ titulo: $('#benTit-' + i).val().trim(), texto: $('#benTxt-' + i).val().trim() });
        }
        return out;
    }

    /* ---------- load ---------- */
    function loadConteudo() {
        $.get(API_BASE + 'get_paraempresas_content.php', function (res) {
            if (!res.ok) return;
            content = res.content;
            var c = content;

            $('#probTitulo').val(c.prob_titulo);
            $('#probTexto').val(c.prob_texto);
            $.each(c.prob_items || [], function (i, v) { $('#probItem-' + i).val(v); });

            $('#intTitulo').val(c.int_titulo);
            $('#intTexto').val(c.int_texto);
            $.each(c.int_bullets || [], function (i, v) { $('#intBullet-' + i).val(v); });

            $('#solTitulo').val(c.sol_titulo);
            renderSolCards(c.sol_cards || []);

            $('#whyTitulo').val(c.why_titulo);
            renderWhyCards(c.why_items || []);

            $('#audTitulo').val(c.aud_titulo);
            $.each(c.aud_items || [], function (i, v) { $('#audItem-' + i).val(v); });

            $('#techTitulo').val(c.tech_titulo);
            $('#techTexto').val(c.tech_texto);

            $('#benTitulo').val(c.ben_titulo);
            renderBenCards(c.ben_items || []);

            $('#trustGoogle').val(c.trust_google);
            $.each(c.trust_items || [], function (i, v) { $('#trustItem-' + i).val(v); });
        });
    }

    /* ---------- save ---------- */
    function saveConteudo() {
        var body = {
            prob_titulo: $('#probTitulo').val().trim(),
            prob_texto:  $('#probTexto').val().trim(),
            prob_items:  [0,1,2,3,4].map(function (i) { return $('#probItem-' + i).val().trim(); }),

            int_titulo:  $('#intTitulo').val().trim(),
            int_texto:   $('#intTexto').val().trim(),
            int_bullets: [0,1,2,3].map(function (i) { return $('#intBullet-' + i).val().trim(); }),

            sol_titulo: $('#solTitulo').val().trim(),
            sol_cards:  collectSolCards((content.sol_cards || []).length),

            why_titulo: $('#whyTitulo').val().trim(),
            why_items:  collectWhyItems((content.why_items || []).length),

            aud_titulo: $('#audTitulo').val().trim(),
            aud_items:  [0,1,2,3,4,5,6].map(function (i) { return $('#audItem-' + i).val().trim(); }),

            tech_titulo: $('#techTitulo').val().trim(),
            tech_texto:  $('#techTexto').val().trim(),

            ben_titulo: $('#benTitulo').val().trim(),
            ben_items:  collectBenItems((content.ben_items || []).length),

            trust_google: $('#trustGoogle').val().trim(),
            trust_items:  [0,1,2,3].map(function (i) { return $('#trustItem-' + i).val().trim(); }),
        };

        $.ajax({
            url:         API_BASE + 'save_paraempresas_content.php',
            method:      'POST',
            contentType: 'application/json',
            data:        JSON.stringify(body),
            success: function (res) {
                showMsg(res.ok, res.message || (res.ok ? 'Salvo!' : 'Erro ao salvar.'));
            },
            error: function () { showMsg(false, 'Erro de comunicação.'); }
        });
    }

    /* ---------- upload genérico via data-attrs ---------- */
    $(document).on('change', 'input[type="file"][data-img-field]', function () {
        var $input    = $(this);
        var fieldId   = $input.data('img-field');
        var previewId = $input.data('img-preview');
        var emptyId   = $input.data('img-empty');
        var file      = this.files[0];
        if (!file) return;

        var fd = new FormData();
        fd.append('image', file);

        $.ajax({
            url:         API_BASE + 'upload_paraempresas_image.php',
            method:      'POST',
            data:        fd,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.ok) {
                    $('#' + fieldId).val(res.filename);
                    $('#' + previewId).attr('src', IMG_BASE + res.filename).show();
                    if (emptyId) $('#' + emptyId).hide();
                } else {
                    showMsg(false, res.message || 'Erro no upload.');
                }
            },
            error: function () { showMsg(false, 'Erro no upload.'); }
        });
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
