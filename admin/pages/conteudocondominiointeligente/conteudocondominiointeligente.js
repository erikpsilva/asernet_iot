(function ($) {
    'use strict';

    var API_BASE = ADMIN_BASE + '/services/api/content/';
    var IMG_BASE = SITE_BASE + '/images/condominiointeligente/';
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

    // ── text cards (titulo + texto, sem imagem) ─────────────────────────────
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

    // ── benefit cards (titulo + texto + imagem) ─────────────────────────────
    function buildBenefitCard(i, item) {
        return '<div class="col-md-6"><div class="adminConteudo__card">' +
            '<p class="formGroup__label adminConteudo__cardLabel" style="font-weight:600">Card ' + (i + 1) + '</p>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Titulo</label><input type="text" class="formGroup__input" id="benefitTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="90"></div>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Texto</label><input type="text" class="formGroup__input" id="benefitTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="200"></div>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Imagem</label>' + buildImgWidget('benefit-img-' + i, 'benefit-prev-' + i, 'benefit-empty-' + i, item.imagem) + '</div>' +
            '</div></div>';
    }

    function renderBenefitCards(items) {
        var $c = $('#benefitsContainer').empty();
        $.each(items, function (i, item) { $c.append(buildBenefitCard(i, item)); });
    }

    function collectBenefitCards(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({
                titulo: $('#benefitTit-' + i).val().trim(),
                texto: $('#benefitTxt-' + i).val().trim(),
                imagem: $('#benefit-img-' + i).val().trim()
            });
        }
        return out;
    }

    function loadConteudo() {
        $.get(API_BASE + 'get_condominiointeligente_content.php', function (res) {
            if (!res.ok) return;
            content = res.content;
            var c = content;

            $('#completeTitulo').val(c.complete_titulo);
            $('#completeTexto').val(c.complete_texto);
            renderTextCards('completeContainer', 'complete', c.complete_items || []);

            $('#benefitsTitulo').val(c.benefits_titulo);
            renderBenefitCards(c.benefits_items || []);

            $('#integrationsTitulo').val(c.integrations_titulo);
            $.each(c.integrations_items || [], function (i, v) { $('#integrationsItem-' + i).val(v.label); });

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
            complete_titulo: $('#completeTitulo').val().trim(),
            complete_texto: $('#completeTexto').val().trim(),
            complete_items: collectTextCards('complete', (content.complete_items || []).length),

            benefits_titulo: $('#benefitsTitulo').val().trim(),
            benefits_items: collectBenefitCards((content.benefits_items || []).length),

            integrations_titulo: $('#integrationsTitulo').val().trim(),
            integrations_items: collectLabelItems('integrationsItem', 6),

            steps_titulo: $('#stepsTitulo').val().trim(),
            steps_items: collectTextCards('steps', (content.steps_items || []).length),

            cta_titulo: $('#ctaTitulo').val().trim(),
            cta_titulo_destaque: $('#ctaTituloDestaque').val().trim(),
            cta_texto: $('#ctaTexto').val().trim(),
            cta_btn1_texto: $('#ctaBtn1').val().trim(),
            cta_btn2_texto: $('#ctaBtn2').val().trim()
        };

        $.ajax({
            url: API_BASE + 'save_condominiointeligente_content.php',
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
            url: API_BASE + 'upload_condominiointeligente_image.php',
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
