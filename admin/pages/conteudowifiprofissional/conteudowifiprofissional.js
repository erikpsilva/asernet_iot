(function ($) {
    'use strict';

    var API_BASE = ADMIN_BASE + '/services/api/content/';
    var IMG_BASE = SITE_BASE + '/images/wifiprofissional/';
    var content  = {};

    /* ---------- utils ---------- */
    function escHtml(str) {
        return $('<div>').text(str || '').html();
    }

    /* ---------- image widget (JS-rendered) ---------- */
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

    /* ---------- static image populate ---------- */
    function loadStaticImg(hiddenId, prevId, emptyId, filename) {
        $('#' + hiddenId).val(filename || '');
        if (filename) {
            $('#' + prevId).attr('src', IMG_BASE + filename).show();
            $('#' + emptyId).hide();
        }
    }

    /* ---------- feat cards (3 fixos, com imagem) ---------- */
    var FEAT_ICONS = ['icon-wifiestavel', 'icon-monitoramento', 'icon-wificobertura'];

    function buildFeatCard(i, item) {
        var fieldId = 'feat-img-' + i;
        var prevId  = 'feat-prev-' + i;
        var emptyId = 'feat-empty-' + i;
        return '<div class="col-md-4">' +
            '<div class="adminConteudo__card">' +
                '<p class="formGroup__label adminConteudo__cardLabel" style="font-weight:600"><i class="' + FEAT_ICONS[i] + '"></i> Card ' + (i + 1) + '</p>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Título</label>' +
                    '<input type="text" class="formGroup__input" id="featTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="80">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Texto</label>' +
                    '<textarea class="formGroup__input" id="featTxt-' + i + '" rows="2" maxlength="200">' + escHtml(item.texto) + '</textarea>' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Imagem</label>' +
                    buildImgWidget(fieldId, prevId, emptyId, item.imagem) +
                '</div>' +
            '</div>' +
        '</div>';
    }

    function renderFeatCards(items) {
        var $c = $('#featCardsContainer').empty();
        $.each(items, function (i, item) { $c.append(buildFeatCard(i, item)); });
    }

    function collectFeatCards(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({
                titulo: $('#featTit-' + i).val().trim(),
                texto:  $('#featTxt-' + i).val().trim(),
                imagem: $('#feat-img-' + i).val().trim(),
            });
        }
        return out;
    }

    /* ---------- load ---------- */
    function loadConteudo() {
        $.get(API_BASE + 'get_wifiprofissional_content.php', function (res) {
            if (!res.ok) return;
            content = res.content;
            var c = content;

            $('#cmpProbTitulo').val(c.cmp_prob_titulo);
            $('#cmpProbTexto').val(c.cmp_prob_texto);
            $.each(c.cmp_prob_items || [], function (i, v) { $('#cmpProbItem-' + i).val(v); });
            loadStaticImg('cmpImagem', 'cmpImgPrev', 'cmpImgEmpty', c.cmp_imagem);

            $('#cmpSolTitulo').val(c.cmp_sol_titulo);
            $('#cmpSolTexto').val(c.cmp_sol_texto);
            $.each(c.cmp_sol_items || [], function (i, v) { $('#cmpSolItem-' + i).val(v); });

            $('#stepsTitulo').val(c.steps_titulo);
            $('#stepsTexto').val(c.steps_texto);
            $.each(c.steps || [], function (i, step) {
                $('#stepTit-' + i).val(step.titulo);
                $('#stepTxt-' + i).val(step.texto);
            });

            $('#planTitulo').val(c.plan_titulo);
            $('#planPreco').val(c.plan_preco);
            $('#planAdicional').val(c.plan_adicional);
            $.each(c.plan_items || [], function (i, v) { $('#planItem-' + i).val(v); });
            loadStaticImg('planImagem', 'planImgPrev', 'planImgEmpty', c.plan_imagem);

            $('#audTitulo').val(c.aud_titulo);
            $('#audTexto').val(c.aud_texto);
            $.each(c.aud_items || [], function (i, v) { $('#audItem-' + i).val(v); });

            $('#featTitulo').val(c.feat_titulo);
            renderFeatCards(c.feat_cards || []);
        });
    }

    /* ---------- save ---------- */
    function saveConteudo() {
        var steps = [];
        for (var i = 0; i < 5; i++) {
            steps.push({ titulo: $('#stepTit-' + i).val().trim(), texto: $('#stepTxt-' + i).val().trim() });
        }

        var body = {
            cmp_prob_titulo: $('#cmpProbTitulo').val().trim(),
            cmp_prob_texto:  $('#cmpProbTexto').val().trim(),
            cmp_prob_items:  [0,1,2,3,4].map(function (i) { return $('#cmpProbItem-' + i).val().trim(); }),
            cmp_imagem:      $('#cmpImagem').val().trim(),
            cmp_sol_titulo:  $('#cmpSolTitulo').val().trim(),
            cmp_sol_texto:   $('#cmpSolTexto').val().trim(),
            cmp_sol_items:   [0,1,2,3,4].map(function (i) { return $('#cmpSolItem-' + i).val().trim(); }),

            steps_titulo: $('#stepsTitulo').val().trim(),
            steps_texto:  $('#stepsTexto').val().trim(),
            steps:        steps,

            plan_titulo:    $('#planTitulo').val().trim(),
            plan_preco:     $('#planPreco').val().trim(),
            plan_items:     [0,1,2,3,4].map(function (i) { return $('#planItem-' + i).val().trim(); }),
            plan_adicional: $('#planAdicional').val().trim(),
            plan_imagem:    $('#planImagem').val().trim(),

            aud_titulo: $('#audTitulo').val().trim(),
            aud_texto:  $('#audTexto').val().trim(),
            aud_items:  [0,1,2,3,4,5,6,7].map(function (i) { return $('#audItem-' + i).val().trim(); }),

            feat_titulo: $('#featTitulo').val().trim(),
            feat_cards:  collectFeatCards((content.feat_cards || []).length),
        };

        $.ajax({
            url:         API_BASE + 'save_wifiprofissional_content.php',
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
            url:         API_BASE + 'upload_wifiprofissional_image.php',
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
