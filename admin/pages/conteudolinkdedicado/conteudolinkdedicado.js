(function ($) {
    'use strict';

    var API_BASE = ADMIN_BASE + '/services/api/content/';
    var IMG_BASE = SITE_BASE + '/images/linkdedicado/';
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

    function loadStaticImg(hiddenId, prevId, emptyId, filename) {
        $('#' + hiddenId).val(filename || '');
        if (filename) {
            $('#' + prevId).attr('src', IMG_BASE + filename).show();
            $('#' + emptyId).hide();
        }
    }

    var EXCLUSIVE_ICONS = ['icon-servidor', 'icon-speed', 'icon-security', 'icon-dashboard'];
    var FEAT_ICONS = ['icon-link', 'icon-dashboard', 'icon-customersupport', 'icon-puzzle'];
    var BENEFIT_ICONS = ['icon-cloud', 'icon-speed', 'icon-security', 'icon-group'];

    function buildTextCard(prefix, icons, i, item) {
        return '<div class="col-md-6">' +
            '<div class="adminConteudo__card">' +
                '<p class="formGroup__label adminConteudo__cardLabel" style="font-weight:600"><i class="' + icons[i] + '"></i> Item ' + (i + 1) + '</p>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Titulo</label>' +
                    '<input type="text" class="formGroup__input" id="' + prefix + 'Tit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="90">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Texto</label>' +
                    '<input type="text" class="formGroup__input" id="' + prefix + 'Txt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="220">' +
                '</div>' +
            '</div>' +
        '</div>';
    }

    function renderTextCards(containerId, prefix, icons, items) {
        var $c = $('#' + containerId).empty();
        $.each(items, function (i, item) { $c.append(buildTextCard(prefix, icons, i, item)); });
    }

    function collectTextCards(prefix, count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({
                titulo: $('#' + prefix + 'Tit-' + i).val().trim(),
                texto: $('#' + prefix + 'Txt-' + i).val().trim()
            });
        }
        return out;
    }

    function buildIntegrationCard(i, item) {
        var fieldId = 'integration-img-' + i;
        var prevId = 'integration-prev-' + i;
        var emptyId = 'integration-empty-' + i;
        return '<div class="col-md-6">' +
            '<div class="adminConteudo__card">' +
                '<p class="formGroup__label adminConteudo__cardLabel" style="font-weight:600">Card ' + (i + 1) + '</p>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Titulo</label>' +
                    '<input type="text" class="formGroup__input" id="integrationTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="90">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Texto</label>' +
                    '<input type="text" class="formGroup__input" id="integrationTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="180">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Imagem</label>' +
                    buildImgWidget(fieldId, prevId, emptyId, item.imagem) +
                '</div>' +
            '</div>' +
        '</div>';
    }

    function renderIntegrationCards(items) {
        var $c = $('#integrationContainer').empty();
        $.each(items, function (i, item) { $c.append(buildIntegrationCard(i, item)); });
    }

    function collectIntegrationCards(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({
                titulo: $('#integrationTit-' + i).val().trim(),
                texto: $('#integrationTxt-' + i).val().trim(),
                imagem: $('#integration-img-' + i).val().trim()
            });
        }
        return out;
    }

    function loadConteudo() {
        $.get(API_BASE + 'get_linkdedicado_content.php', function (res) {
            if (!res.ok) return;
            content = res.content;
            var c = content;

            $('#problemTitulo').val(c.problem_titulo);
            $('#problemTexto').val(c.problem_texto);
            $.each(c.problem_items || [], function (i, v) { $('#problemItem-' + i).val(v); });
            loadStaticImg('problemImagem', 'problemImgPrev', 'problemImgEmpty', c.problem_imagem);

            $('#exclusiveTitulo').val(c.exclusive_titulo);
            $('#exclusiveTexto').val(c.exclusive_texto);
            renderTextCards('exclusiveContainer', 'exclusive', EXCLUSIVE_ICONS, c.exclusive_cards || []);

            $('#audTitulo').val(c.aud_titulo);
            $('#audTexto').val(c.aud_texto);
            $.each(c.aud_items || [], function (i, v) { $('#audItem-' + i).val(v); });

            $('#featTitulo').val(c.feat_titulo);
            renderTextCards('featContainer', 'feat', FEAT_ICONS, c.feat_cards || []);

            $('#integrationTitulo').val(c.integration_titulo);
            $('#integrationTexto').val(c.integration_texto);
            renderIntegrationCards(c.integration_cards || []);

            $('#benefitsTitulo').val(c.benefits_titulo);
            renderTextCards('benefitContainer', 'benefit', BENEFIT_ICONS, c.benefit_cards || []);

            $('#trustGoogle').val(c.trust_google);
            $.each(c.trust_items || [], function (i, v) { $('#trustItem-' + i).val(v); });
        });
    }

    function saveConteudo() {
        var body = {
            problem_titulo: $('#problemTitulo').val().trim(),
            problem_texto: $('#problemTexto').val().trim(),
            problem_items: [0,1,2,3].map(function (i) { return $('#problemItem-' + i).val().trim(); }),
            problem_imagem: $('#problemImagem').val().trim(),

            exclusive_titulo: $('#exclusiveTitulo').val().trim(),
            exclusive_texto: $('#exclusiveTexto').val().trim(),
            exclusive_cards: collectTextCards('exclusive', (content.exclusive_cards || []).length),

            aud_titulo: $('#audTitulo').val().trim(),
            aud_texto: $('#audTexto').val().trim(),
            aud_items: [0,1,2,3,4,5,6].map(function (i) { return $('#audItem-' + i).val().trim(); }),

            feat_titulo: $('#featTitulo').val().trim(),
            feat_cards: collectTextCards('feat', (content.feat_cards || []).length),

            integration_titulo: $('#integrationTitulo').val().trim(),
            integration_texto: $('#integrationTexto').val().trim(),
            integration_cards: collectIntegrationCards((content.integration_cards || []).length),

            benefits_titulo: $('#benefitsTitulo').val().trim(),
            benefit_cards: collectTextCards('benefit', (content.benefit_cards || []).length),

            trust_google: $('#trustGoogle').val().trim(),
            trust_items: [0,1,2].map(function (i) { return $('#trustItem-' + i).val().trim(); })
        };

        $.ajax({
            url: API_BASE + 'save_linkdedicado_content.php',
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
            url: API_BASE + 'upload_linkdedicado_image.php',
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
