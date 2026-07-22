(function ($) {
    'use strict';

    var API_BASE = ADMIN_BASE + '/services/api/content/';
    var IMG_BASE = SITE_BASE + '/images/bairroseguro/';
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

    // ── steps (titulo + texto + imagem) ─────────────────────────────────────
    function buildStepCard(i, item) {
        return '<div class="col-md-6"><div class="adminConteudo__card">' +
            '<p class="formGroup__label adminConteudo__cardLabel" style="font-weight:600">Passo ' + (i + 1) + '</p>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Titulo</label><input type="text" class="formGroup__input" id="stepTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="90"></div>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Texto</label><input type="text" class="formGroup__input" id="stepTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="200"></div>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Imagem</label>' + buildImgWidget('step-img-' + i, 'step-prev-' + i, 'step-empty-' + i, item.imagem) + '</div>' +
            '</div></div>';
    }

    function renderStepCards(items) {
        var $c = $('#stepsContainer').empty();
        $.each(items, function (i, item) { $c.append(buildStepCard(i, item)); });
    }

    function collectStepCards(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({
                titulo: $('#stepTit-' + i).val().trim(),
                texto: $('#stepTxt-' + i).val().trim(),
                imagem: $('#step-img-' + i).val().trim()
            });
        }
        return out;
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

    // ── faq cards (pergunta + resposta) ─────────────────────────────────────
    function buildFaqCard(i, item) {
        return '<div class="col-md-6"><div class="adminConteudo__card">' +
            '<p class="formGroup__label adminConteudo__cardLabel" style="font-weight:600">Pergunta ' + (i + 1) + '</p>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Pergunta</label><input type="text" class="formGroup__input" id="faqQ-' + i + '" value="' + escHtml(item.pergunta) + '" maxlength="140"></div>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Resposta</label><input type="text" class="formGroup__input" id="faqA-' + i + '" value="' + escHtml(item.resposta) + '" maxlength="260"></div>' +
            '</div></div>';
    }

    function renderFaqCards(items) {
        var $c = $('#faqContainer').empty();
        $.each(items, function (i, item) { $c.append(buildFaqCard(i, item)); });
    }

    function collectFaqCards(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({ pergunta: $('#faqQ-' + i).val().trim(), resposta: $('#faqA-' + i).val().trim() });
        }
        return out;
    }

    // ── included items (lista dinamica de bullets) ──────────────────────────
    function buildIncludedRow(val) {
        return '<div class="adminConteudo__bulletRow">' +
            '<input type="text" class="formGroup__input adminConteudo__bulletInput" value="' + escHtml(val || '') + '" maxlength="120" placeholder="Item">' +
            '<button type="button" class="adminConteudo__removeBullet" title="Remover">&times;</button>' +
            '</div>';
    }

    function renderIncludedItems(items) {
        var $c = $('#includedItemsContainer').empty();
        $.each(items || [], function (i, v) { $c.append(buildIncludedRow(v)); });
    }

    function collectIncludedItems() {
        var out = [];
        $('#includedItemsContainer .adminConteudo__bulletInput').each(function () {
            var v = $(this).val().trim();
            if (v) out.push(v);
        });
        return out;
    }

    $('#btnAddIncluded').on('click', function () {
        if ($('#includedItemsContainer .adminConteudo__bulletRow').length < 12) {
            $('#includedItemsContainer').append(buildIncludedRow(''));
        }
    });
    $(document).on('click', '#includedItemsContainer .adminConteudo__removeBullet', function () {
        $(this).closest('.adminConteudo__bulletRow').remove();
    });

    function loadConteudo() {
        $.get(API_BASE + 'get_bairroseguro_content.php', function (res) {
            if (!res.ok) return;
            content = res.content;
            var c = content;

            $('#sharedTitulo').val(c.shared_titulo);
            $('#sharedTituloComplemento').val(c.shared_titulo_complemento);
            $('#sharedTexto1').val(c.shared_texto1);
            $('#sharedTexto2').val(c.shared_texto2);
            $('#sharedTexto3').val(c.shared_texto3);
            $('#sharedImgWidget').html(buildImgWidget('sharedImagem', 'sharedImgPrev', 'sharedImgEmpty', c.shared_imagem));

            $('#stepsTitulo').val(c.steps_titulo);
            renderStepCards(c.steps_items || []);

            $('#audiencesTitulo').val(c.audiences_titulo);
            $.each(c.audiences_items || [], function (i, v) { $('#audiencesItem-' + i).val(v.label); });

            $('#includedTitulo').val(c.included_titulo);
            $('#includedImgWidget').html(buildImgWidget('includedImagem', 'includedImgPrev', 'includedImgEmpty', c.included_imagem));
            renderIncludedItems(c.included_items || []);

            $('#advantagesTitulo').val(c.advantages_titulo);
            renderTextCards('advantagesContainer', 'advantages', c.advantages_items || []);

            $('#faqTitulo').val(c.faq_titulo);
            renderFaqCards(c.faq_items || []);

            $('#ctaTitulo').val(c.cta_titulo);
            $('#ctaTituloComplemento').val(c.cta_titulo_complemento);
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
            shared_titulo: $('#sharedTitulo').val().trim(),
            shared_titulo_complemento: $('#sharedTituloComplemento').val().trim(),
            shared_texto1: $('#sharedTexto1').val().trim(),
            shared_texto2: $('#sharedTexto2').val().trim(),
            shared_texto3: $('#sharedTexto3').val().trim(),
            shared_imagem: $('#sharedImagem').val().trim(),

            steps_titulo: $('#stepsTitulo').val().trim(),
            steps_items: collectStepCards((content.steps_items || []).length),

            audiences_titulo: $('#audiencesTitulo').val().trim(),
            audiences_items: collectLabelItems('audiencesItem', 6),

            included_titulo: $('#includedTitulo').val().trim(),
            included_items: collectIncludedItems(),
            included_imagem: $('#includedImagem').val().trim(),

            advantages_titulo: $('#advantagesTitulo').val().trim(),
            advantages_items: collectTextCards('advantages', (content.advantages_items || []).length),

            faq_titulo: $('#faqTitulo').val().trim(),
            faq_items: collectFaqCards((content.faq_items || []).length),

            cta_titulo: $('#ctaTitulo').val().trim(),
            cta_titulo_complemento: $('#ctaTituloComplemento').val().trim(),
            cta_texto: $('#ctaTexto').val().trim(),
            cta_btn1_texto: $('#ctaBtn1').val().trim(),
            cta_btn2_texto: $('#ctaBtn2').val().trim()
        };

        $.ajax({
            url: API_BASE + 'save_bairroseguro_content.php',
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
            url: API_BASE + 'upload_bairroseguro_image.php',
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
