(function ($) {
    'use strict';

    var API_BASE = ADMIN_BASE + '/services/api/content/';
    var IMG_BASE = SITE_BASE + '/images/skeelo/';
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

    /* ---------- features (moments) ---------- */
    function buildFeatureCard(i, item) {
        return '<div class="col-md-4">' +
            '<div class="adminConteudo__card">' +
                '<label class="formGroup__label adminConteudo__cardLabel">Título</label>' +
                '<input type="text" class="formGroup__input" id="featTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="40">' +
                '<label class="formGroup__label adminConteudo__cardLabel" style="margin-top:8px">Texto</label>' +
                '<input type="text" class="formGroup__input" id="featTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="100">' +
            '</div>' +
        '</div>';
    }

    function renderFeatures(items) {
        var $c = $('#featuresContainer').empty();
        $.each(items, function (i, item) { $c.append(buildFeatureCard(i, item)); });
    }

    function collectFeatures(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({ titulo: $('#featTit-' + i).val().trim(), texto: $('#featTxt-' + i).val().trim() });
        }
        return out;
    }

    /* ---------- routine cards ---------- */
    function buildRoutineCard(i, item) {
        var fieldId = 'rc-img-' + i;
        var prevId  = 'rc-prev-' + i;
        var emptyId = 'rc-empty-' + i;
        return '<div class="col-md-6">' +
            '<div class="adminConteudo__card">' +
                buildImgWidget(fieldId, prevId, emptyId, item.imagem) +
                '<div class="formGroup__item" style="margin-top:8px">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Título</label>' +
                    '<input type="text" class="formGroup__input" id="rcTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="50">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Texto</label>' +
                    '<input type="text" class="formGroup__input" id="rcTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="120">' +
                '</div>' +
            '</div>' +
        '</div>';
    }

    function renderRoutineCards(items) {
        var $c = $('#routineCardsContainer').empty();
        $.each(items, function (i, item) { $c.append(buildRoutineCard(i, item)); });
    }

    function collectRoutineCards(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({ titulo: $('#rcTit-' + i).val().trim(), texto: $('#rcTxt-' + i).val().trim(), imagem: $('#rc-img-' + i).val().trim() });
        }
        return out;
    }

    /* ---------- benefits ---------- */
    function buildBenefitCard(i, item) {
        return '<div class="col-md-6">' +
            '<div class="adminConteudo__card">' +
                '<label class="formGroup__label adminConteudo__cardLabel">Título</label>' +
                '<input type="text" class="formGroup__input" id="benTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="50">' +
                '<label class="formGroup__label adminConteudo__cardLabel" style="margin-top:8px">Texto</label>' +
                '<input type="text" class="formGroup__input" id="benTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="120">' +
            '</div>' +
        '</div>';
    }

    function renderBenefits(items) {
        var $c = $('#benefitsContainer').empty();
        $.each(items, function (i, item) { $c.append(buildBenefitCard(i, item)); });
    }

    function collectBenefits(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({ titulo: $('#benTit-' + i).val().trim(), texto: $('#benTxt-' + i).val().trim() });
        }
        return out;
    }

    /* ---------- load ---------- */
    function loadConteudo() {
        $.get(API_BASE + 'get_skeelo_content.php', function (res) {
            if (!res.ok) return;
            content = res.content;
            var c = content;

            $('#momentsSpan').val(c.moments_span);
            $('#momentsTitulo').val(c.moments_titulo);
            renderFeatures(c.moments_features || []);

            $('#routineSpan').val(c.routine_span);
            $('#routineTitulo').val(c.routine_titulo);
            $('#routineTexto').val(c.routine_texto);
            renderRoutineCards(c.routine_cards || []);

            $('#howSpan').val(c.how_span);
            $.each(c.how_steps || [], function (i, step) {
                $('#howTit-' + i).val(step.titulo);
                $('#howTxt-' + i).val(step.texto);
            });

            $('#benefitsTitulo').val(c.benefits_titulo);
            renderBenefits(c.benefits || []);

            $('#trustGoogle').val(c.trust_google);
            $('#trustItem1').val(c.trust_item1);
            $('#trustItem2').val(c.trust_item2);
        });
    }

    /* ---------- save ---------- */
    function saveConteudo() {
        var howSteps = [];
        for (var i = 0; i < 3; i++) {
            howSteps.push({ titulo: $('#howTit-' + i).val().trim(), texto: $('#howTxt-' + i).val().trim() });
        }

        var body = {
            moments_span:     $('#momentsSpan').val().trim(),
            moments_titulo:   $('#momentsTitulo').val().trim(),
            moments_features: collectFeatures((content.moments_features || []).length),

            routine_span:   $('#routineSpan').val().trim(),
            routine_titulo: $('#routineTitulo').val().trim(),
            routine_texto:  $('#routineTexto').val().trim(),
            routine_cards:  collectRoutineCards((content.routine_cards || []).length),

            how_span:  $('#howSpan').val().trim(),
            how_steps: howSteps,

            benefits_titulo: $('#benefitsTitulo').val().trim(),
            benefits:        collectBenefits((content.benefits || []).length),

            trust_google: $('#trustGoogle').val().trim(),
            trust_item1:  $('#trustItem1').val().trim(),
            trust_item2:  $('#trustItem2').val().trim(),
        };

        $.ajax({
            url:         API_BASE + 'save_skeelo_content.php',
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
        var $input   = $(this);
        var fieldId  = $input.data('img-field');
        var previewId= $input.data('img-preview');
        var emptyId  = $input.data('img-empty');
        var file     = this.files[0];
        if (!file) return;

        var fd = new FormData();
        fd.append('image', file);

        $.ajax({
            url:         API_BASE + 'upload_skeelo_image.php',
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
