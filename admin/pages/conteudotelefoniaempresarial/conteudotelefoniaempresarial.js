(function ($) {
    'use strict';

    var API_BASE = ADMIN_BASE + '/services/api/content/';
    var IMG_BASE = SITE_BASE + '/images/telefoniaempresarial/';
    var content  = {};

    /* ---------- utils ---------- */
    function escHtml(str) {
        return $('<div>').text(str || '').html();
    }

    /* ---------- static image populate ---------- */
    function loadStaticImg(hiddenId, prevId, emptyId, filename) {
        $('#' + hiddenId).val(filename || '');
        if (filename) {
            $('#' + prevId).attr('src', IMG_BASE + filename).show();
            $('#' + emptyId).hide();
        }
    }

    /* ---------- feat cards (4 fixos, sem imagem) ---------- */
    var FEAT_ICONS = ['icon-setting', 'icon-cloud', 'icon-customersupport', 'icon-puzzle'];

    function buildFeatCard(i, item) {
        return '<div class="col-md-6">' +
            '<div class="adminConteudo__card">' +
                '<p class="formGroup__label adminConteudo__cardLabel" style="font-weight:600"><i class="' + FEAT_ICONS[i] + '"></i> Item ' + (i + 1) + '</p>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Título</label>' +
                    '<input type="text" class="formGroup__input" id="featTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="60">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Texto</label>' +
                    '<input type="text" class="formGroup__input" id="featTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="160">' +
                '</div>' +
            '</div>' +
        '</div>';
    }

    function renderFeatCards(items) {
        var $c = $('#featContainer').empty();
        $.each(items, function (i, item) { $c.append(buildFeatCard(i, item)); });
    }

    function collectFeatItems(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({ titulo: $('#featTit-' + i).val().trim(), texto: $('#featTxt-' + i).val().trim() });
        }
        return out;
    }

    /* ---------- ben cards (4 fixos, sem imagem) ---------- */
    var BEN_ICONS = ['icon-phone', 'icon-mobile-phone', 'icon-group', 'icon-speed'];

    function buildBenCard(i, item) {
        return '<div class="col-md-6">' +
            '<div class="adminConteudo__card">' +
                '<p class="formGroup__label adminConteudo__cardLabel" style="font-weight:600"><i class="' + BEN_ICONS[i] + '"></i> Item ' + (i + 1) + '</p>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Título</label>' +
                    '<input type="text" class="formGroup__input" id="benTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="60">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Texto</label>' +
                    '<input type="text" class="formGroup__input" id="benTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="160">' +
                '</div>' +
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
        $.get(API_BASE + 'get_telefonia_content.php', function (res) {
            if (!res.ok) return;
            content = res.content;
            var c = content;

            $('#painTitulo').val(c.pain_titulo);
            $('#painTexto').val(c.pain_texto);
            $.each(c.pain_items || [], function (i, v) { $('#painItem-' + i).val(v); });

            $('#solTitulo').val(c.sol_titulo);
            $('#solTexto').val(c.sol_texto);
            if (c.sol_cards && c.sol_cards[0]) {
                $('#solCard0Tit').val(c.sol_cards[0].titulo);
                $('#solCard0Txt').val(c.sol_cards[0].texto);
                loadStaticImg('solCard0Img', 'solCard0ImgPrev', 'solCard0ImgEmpty', c.sol_cards[0].imagem);
            }
            if (c.sol_cards && c.sol_cards[1]) {
                $('#solCard1Tit').val(c.sol_cards[1].titulo);
                $('#solCard1Txt').val(c.sol_cards[1].texto);
            }
            if (c.sol_cards && c.sol_cards[2]) {
                $('#solCard2Tit').val(c.sol_cards[2].titulo);
                $('#solCard2Txt').val(c.sol_cards[2].texto);
            }

            $('#featTitulo').val(c.feat_titulo);
            $('#featTexto').val(c.feat_texto);
            renderFeatCards(c.feat_items || []);

            $('#resAudTitulo').val(c.res_aud_titulo);
            $.each(c.res_aud_items || [], function (i, v) { $('#resAudItem-' + i).val(v); });
            loadStaticImg('resImagem', 'resImgPrev', 'resImgEmpty', c.res_imagem);
            $('#resRecTitulo').val(c.res_rec_titulo);
            $.each(c.res_rec_items || [], function (i, v) { $('#resRecItem-' + i).val(v); });

            $('#flowTitulo').val(c.flow_titulo);
            $('#flowTexto').val(c.flow_texto);
            $.each(c.flow_items || [], function (i, v) { $('#flowItem-' + i).val(v); });

            $('#benTitulo').val(c.ben_titulo);
            renderBenCards(c.ben_items || []);

            $('#trustGoogle').val(c.trust_google);
            $.each(c.trust_items || [], function (i, v) { $('#trustItem-' + i).val(v); });
        });
    }

    /* ---------- save ---------- */
    function saveConteudo() {
        var body = {
            pain_titulo: $('#painTitulo').val().trim(),
            pain_texto:  $('#painTexto').val().trim(),
            pain_items:  [0,1,2,3].map(function (i) { return $('#painItem-' + i).val().trim(); }),

            sol_titulo: $('#solTitulo').val().trim(),
            sol_texto:  $('#solTexto').val().trim(),
            sol_cards: [
                { titulo: $('#solCard0Tit').val().trim(), texto: $('#solCard0Txt').val().trim(), imagem: $('#solCard0Img').val().trim() },
                { titulo: $('#solCard1Tit').val().trim(), texto: $('#solCard1Txt').val().trim(), imagem: '' },
                { titulo: $('#solCard2Tit').val().trim(), texto: $('#solCard2Txt').val().trim(), imagem: '' },
            ],

            feat_titulo: $('#featTitulo').val().trim(),
            feat_texto:  $('#featTexto').val().trim(),
            feat_items:  collectFeatItems((content.feat_items || []).length),

            res_aud_titulo: $('#resAudTitulo').val().trim(),
            res_aud_items:  [0,1,2,3,4,5,6].map(function (i) { return $('#resAudItem-' + i).val().trim(); }),
            res_imagem:     $('#resImagem').val().trim(),
            res_rec_titulo: $('#resRecTitulo').val().trim(),
            res_rec_items:  [0,1,2,3,4,5].map(function (i) { return $('#resRecItem-' + i).val().trim(); }),

            flow_titulo: $('#flowTitulo').val().trim(),
            flow_texto:  $('#flowTexto').val().trim(),
            flow_items:  [0,1,2,3,4].map(function (i) { return $('#flowItem-' + i).val().trim(); }),

            ben_titulo: $('#benTitulo').val().trim(),
            ben_items:  collectBenItems((content.ben_items || []).length),

            trust_google: $('#trustGoogle').val().trim(),
            trust_items:  [0,1,2].map(function (i) { return $('#trustItem-' + i).val().trim(); }),
        };

        $.ajax({
            url:         API_BASE + 'save_telefonia_content.php',
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
            url:         API_BASE + 'upload_telefonia_image.php',
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
