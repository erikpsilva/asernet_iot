(function ($) {
    'use strict';

    var API_BASE = ADMIN_BASE + '/services/api/content/';
    var IMG_BASE = SITE_BASE + '/images/sobre/';
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

    function buildTextCard(prefix, i, item) {
        return '<div class="col-md-6"><div class="adminConteudo__card">' +
            '<p class="formGroup__label adminConteudo__cardLabel" style="font-weight:600">Item ' + (i + 1) + '</p>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Titulo</label><input type="text" class="formGroup__input" id="' + prefix + 'Tit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="90"></div>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Texto</label><input type="text" class="formGroup__input" id="' + prefix + 'Txt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="180"></div>' +
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

    function buildSolutionCard(i, item) {
        return '<div class="col-md-6"><div class="adminConteudo__card">' +
            '<p class="formGroup__label adminConteudo__cardLabel" style="font-weight:600">Card ' + (i + 1) + '</p>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Titulo</label><input type="text" class="formGroup__input" id="solutionTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="90"></div>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Texto</label><input type="text" class="formGroup__input" id="solutionTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="180"></div>' +
            '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Imagem</label>' + buildImgWidget('solution-img-' + i, 'solution-prev-' + i, 'solution-empty-' + i, item.imagem) + '</div>' +
            '</div></div>';
    }

    function renderSolutionCards(items) {
        var $c = $('#solutionsContainer').empty();
        $.each(items, function (i, item) { $c.append(buildSolutionCard(i, item)); });
    }

    function collectSolutionCards(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({
                titulo: $('#solutionTit-' + i).val().trim(),
                texto: $('#solutionTxt-' + i).val().trim(),
                imagem: $('#solution-img-' + i).val().trim()
            });
        }
        return out;
    }

    function renderTeamImages(items) {
        var $c = $('#teamImagesContainer').empty();
        $.each(items, function (i, filename) {
            $c.append('<div class="col-md-4"><div class="formGroup__item"><label class="formGroup__label">Imagem ' + (i + 1) + '</label>' + buildImgWidget('team-img-' + i, 'team-prev-' + i, 'team-empty-' + i, filename) + '</div></div>');
        });
    }

    function collectTeamImages(count) {
        var out = [];
        for (var i = 0; i < count; i++) out.push($('#team-img-' + i).val().trim());
        return out;
    }

    function loadConteudo() {
        $.get(API_BASE + 'get_sobreasernet_content.php', function (res) {
            if (!res.ok) return;
            content = res.content;
            var c = content;

            $('#historyLabel').val(c.history_label);
            $('#historyTitulo').val(c.history_titulo);
            $.each(c.history_textos || [], function (i, v) { $('#historyTexto-' + i).val(v); });
            loadStaticImg('historyImagem', 'historyImgPrev', 'historyImgEmpty', c.history_imagem);

            $('#beliefLabel').val(c.belief_label);
            $('#beliefTitulo').val(c.belief_titulo);
            $('#beliefTexto').val(c.belief_texto);
            renderTextCards('beliefContainer', 'belief', c.belief_cards || []);

            $('#solutionsLabel').val(c.solutions_label);
            $('#solutionsTitulo').val(c.solutions_titulo);
            renderSolutionCards(c.solutions_cards || []);

            $('#trustGoogle').val(c.trust_google);
            $.each(c.trust_items || [], function (i, v) { $('#trustItem-' + i).val(v); });

            $('#diffLabel').val(c.diff_label);
            $('#diffTitulo').val(c.diff_titulo);
            renderTextCards('diffContainer', 'diff', c.diff_cards || []);

            $('#teamLabel').val(c.team_label);
            $('#teamTitulo').val(c.team_titulo);
            renderTeamImages(c.team_images || []);

            $('#purposeLabel').val(c.purpose_label);
            $('#purposeTitulo').val(c.purpose_titulo);
            $('#purposeTexto').val(c.purpose_texto);
            $.each(c.purpose_items || [], function (i, v) { $('#purposeItem-' + i).val(v); });
        });
    }

    function saveConteudo() {
        var body = {
            history_label: $('#historyLabel').val().trim(),
            history_titulo: $('#historyTitulo').val().trim(),
            history_textos: [0,1].map(function (i) { return $('#historyTexto-' + i).val().trim(); }),
            history_imagem: $('#historyImagem').val().trim(),

            belief_label: $('#beliefLabel').val().trim(),
            belief_titulo: $('#beliefTitulo').val().trim(),
            belief_texto: $('#beliefTexto').val().trim(),
            belief_cards: collectTextCards('belief', (content.belief_cards || []).length),

            solutions_label: $('#solutionsLabel').val().trim(),
            solutions_titulo: $('#solutionsTitulo').val().trim(),
            solutions_cards: collectSolutionCards((content.solutions_cards || []).length),

            trust_google: $('#trustGoogle').val().trim(),
            trust_items: [0,1,2].map(function (i) { return $('#trustItem-' + i).val().trim(); }),

            diff_label: $('#diffLabel').val().trim(),
            diff_titulo: $('#diffTitulo').val().trim(),
            diff_cards: collectTextCards('diff', (content.diff_cards || []).length),

            team_label: $('#teamLabel').val().trim(),
            team_titulo: $('#teamTitulo').val().trim(),
            team_images: collectTeamImages((content.team_images || []).length),

            purpose_label: $('#purposeLabel').val().trim(),
            purpose_titulo: $('#purposeTitulo').val().trim(),
            purpose_texto: $('#purposeTexto').val().trim(),
            purpose_items: [0,1,2,3].map(function (i) { return $('#purposeItem-' + i).val().trim(); })
        };

        $.ajax({
            url: API_BASE + 'save_sobreasernet_content.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(body),
            success: function (res) { showMsg(res.ok, res.message || (res.ok ? 'Salvo!' : 'Erro ao salvar.')); },
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
            url: API_BASE + 'upload_sobreasernet_image.php',
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
