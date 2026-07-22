(function ($) {
    'use strict';

    var API_BASE = ADMIN_BASE + '/services/api/content/';
    var IMG_BASE = SITE_BASE + '/images/controleacessocorporativo/';
    var content = {};

    function escHtml(str) {
        return $('<div>').text(str || '').html();
    }

    function buildImgWidget(fieldId, prevId, emptyId, filename) {
        var hasSrc = !!filename;
        var src = hasSrc ? IMG_BASE + filename : '';
        var prevStyle = hasSrc ? '' : 'display:none';
        var emptyVis = hasSrc ? 'display:none' : '';
        return '<div class="adminConteudo__imgWrap">' +
            '<img class="adminConteudo__imgPreview" id="' + prevId + '" src="' + src + '" style="' + prevStyle + '" alt="">' +
            '<span id="' + emptyId + '" style="color:#b0bdd6;font-size:12px;' + emptyVis + '">Sem imagem</span>' +
            '<label class="adminConteudo__imgBtn" for="upload-' + prevId + '">Trocar imagem</label>' +
            '<input type="file" id="upload-' + prevId + '" class="adminConteudo__fileInput" accept="image/jpeg,image/png,image/webp"' +
            ' data-img-field="' + fieldId + '" data-img-preview="' + prevId + '" data-img-empty="' + emptyId + '">' +
            '<input type="hidden" id="' + fieldId + '" value="' + escHtml(filename || '') + '">' +
            '</div>';
    }

    function buildTextCard(prefix, i, item) {
        return '<div class="col-md-6"><div class="adminConteudo__card">' +
            '<p class="formGroup__label adminConteudo__cardLabel" style="font-weight:600">Item ' + (i + 1) + '</p>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Titulo</label><input type="text" class="formGroup__input" id="' + prefix + 'Tit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="90"></div>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Texto</label><input type="text" class="formGroup__input" id="' + prefix + 'Txt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="200"></div>' +
            '</div></div>';
    }

    function renderTextCards(containerId, prefix, items) {
        var $c = $('#' + containerId).empty();
        $.each(items, function (i, item) { $c.append(buildTextCard(prefix, i, item)); });
    }

    function collectTextCards(prefix, count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({ titulo: $('#' + prefix + 'Tit-' + i).val().trim(), texto: $('#' + prefix + 'Txt-' + i).val().trim() });
        }
        return out;
    }

    function buildAppCard(i, item) {
        return '<div class="col-md-6"><div class="adminConteudo__card">' +
            '<p class="formGroup__label adminConteudo__cardLabel" style="font-weight:600">Card ' + (i + 1) + '</p>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Titulo</label><input type="text" class="formGroup__input" id="appTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="90"></div>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Texto</label><input type="text" class="formGroup__input" id="appTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="200"></div>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Imagem</label>' + buildImgWidget('app-img-' + i, 'app-prev-' + i, 'app-empty-' + i, item.imagem) + '</div>' +
            '</div></div>';
    }

    function renderAppCards(items) {
        var $c = $('#applicationsContainer').empty();
        $.each(items, function (i, item) { $c.append(buildAppCard(i, item)); });
    }

    function collectAppCards(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({
                titulo: $('#appTit-' + i).val().trim(),
                texto: $('#appTxt-' + i).val().trim(),
                imagem: $('#app-img-' + i).val().trim()
            });
        }
        return out;
    }

    function loadConteudo() {
        $.get(API_BASE + 'get_controlecorporativo_content.php', function (res) {
            if (!res.ok) return;
            content = res.content;
            var c = content;

            $('#partnerLabel').val(c.partner_label);
            $('#partnerTexto').val(c.partner_texto);
            $('#partnerImgWidget').html(buildImgWidget('partnerImagem', 'partnerImgPrev', 'partnerImgEmpty', c.partner_imagem));

            $('#introTitulo').val(c.intro_titulo);
            $('#introTexto').val(c.intro_texto);

            $('#audiencesTitulo').val(c.audiences_titulo);
            $.each(c.audiences_items || [], function (i, v) { $('#audiencesItem-' + i).val(v.label); });

            $('#technologiesTitulo').val(c.technologies_titulo);
            $.each(c.technologies_items || [], function (i, v) { $('#technologiesItem-' + i).val(v.label); });

            $('#gainsTitulo').val(c.gains_titulo);
            renderTextCards('gainsContainer', 'gains', c.gains_items || []);

            $('#applicationsTitulo').val(c.applications_titulo);
            renderAppCards(c.applications_items || []);

            $('#integrationTitulo').val(c.integration_titulo);
            $('#integrationTexto').val(c.integration_texto);
            $.each(c.integration_items || [], function (i, v) { $('#integrationItem-' + i).val(v.label); });

            $('#equipmentTitulo').val(c.equipment_titulo);
            $('#equipmentTituloDestaque').val(c.equipment_titulo_destaque);
            $('#equipmentTexto').val(c.equipment_texto);
            $('#equipmentBtnTexto').val(c.equipment_btn_texto);
            $('#equipmentImgWidget').html(buildImgWidget('equipmentImagem', 'equipmentImgPrev', 'equipmentImgEmpty', c.equipment_imagem));

            $('#stepsTitulo').val(c.steps_titulo);
            renderTextCards('stepsContainer', 'steps', c.steps_items || []);

            $('#ctaTitulo').val(c.cta_titulo);
            $('#ctaTituloDestaque').val(c.cta_titulo_destaque);
            $('#ctaTexto').val(c.cta_texto);
            $('#ctaBtn1').val(c.cta_btn1_texto);
            $('#ctaBtn2').val(c.cta_btn2_texto);
        });
    }

    function collectLabelItems(prefix, count) {
        var out = [];
        for (var i = 0; i < count; i++) out.push({ label: $('#' + prefix + '-' + i).val().trim() });
        return out;
    }

    function saveConteudo() {
        var body = {
            partner_label: $('#partnerLabel').val().trim(),
            partner_texto: $('#partnerTexto').val().trim(),
            partner_imagem: $('#partnerImagem').val().trim(),

            intro_titulo: $('#introTitulo').val().trim(),
            intro_texto: $('#introTexto').val().trim(),

            audiences_titulo: $('#audiencesTitulo').val().trim(),
            audiences_items: collectLabelItems('audiencesItem', 6),

            technologies_titulo: $('#technologiesTitulo').val().trim(),
            technologies_items: collectLabelItems('technologiesItem', 8),

            gains_titulo: $('#gainsTitulo').val().trim(),
            gains_items: collectTextCards('gains', (content.gains_items || []).length),

            applications_titulo: $('#applicationsTitulo').val().trim(),
            applications_items: collectAppCards((content.applications_items || []).length),

            integration_titulo: $('#integrationTitulo').val().trim(),
            integration_texto: $('#integrationTexto').val().trim(),
            integration_items: collectLabelItems('integrationItem', 5),

            equipment_titulo: $('#equipmentTitulo').val().trim(),
            equipment_titulo_destaque: $('#equipmentTituloDestaque').val().trim(),
            equipment_texto: $('#equipmentTexto').val().trim(),
            equipment_btn_texto: $('#equipmentBtnTexto').val().trim(),
            equipment_imagem: $('#equipmentImagem').val().trim(),

            steps_titulo: $('#stepsTitulo').val().trim(),
            steps_items: collectTextCards('steps', (content.steps_items || []).length),

            cta_titulo: $('#ctaTitulo').val().trim(),
            cta_titulo_destaque: $('#ctaTituloDestaque').val().trim(),
            cta_texto: $('#ctaTexto').val().trim(),
            cta_btn1_texto: $('#ctaBtn1').val().trim(),
            cta_btn2_texto: $('#ctaBtn2').val().trim()
        };

        $.ajax({
            url: API_BASE + 'save_controlecorporativo_content.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(body),
            success: function (res) {
                showMsg(res.ok, res.message || (res.ok ? 'Salvo!' : 'Erro ao salvar.'));
            },
            error: function () { showMsg(false, 'Erro de comunicacao.'); }
        });
    }

    $(document).on('change', 'input[type="file"][data-img-field]', function () {
        var $input = $(this);
        var fieldId = $input.data('img-field');
        var previewId = $input.data('img-preview');
        var emptyId = $input.data('img-empty');
        var file = this.files[0];
        if (!file) return;

        var fd = new FormData();
        fd.append('image', file);

        $.ajax({
            url: API_BASE + 'upload_controlecorporativo_image.php',
            method: 'POST',
            data: fd,
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

    $('#btnSalvarConteudo').on('click', saveConteudo);

    function showMsg(ok, text) {
        var $m = $('#conteudoMsg');
        $m.removeClass('adminConteudo__msg--ok adminConteudo__msg--err')
          .addClass(ok ? 'adminConteudo__msg--ok' : 'adminConteudo__msg--err')
          .text(text).show();
        setTimeout(function () { $m.fadeOut(); }, 3500);
    }

    loadConteudo();

}(jQuery));
