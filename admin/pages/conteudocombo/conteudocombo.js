(function ($) {
    'use strict';

    var API_BASE = ADMIN_BASE + '/services/api/content/';
    var IMG_BASE = SITE_BASE + '/images/combos/';
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

    function buildCard(group, i, item, withBadge) {
        var fieldId = group + '-img-' + i;
        var prevId = group + '-prev-' + i;
        var emptyId = group + '-empty-' + i;
        var badgeField = withBadge ? '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Selo</label><input type="text" class="formGroup__input" id="' + group + 'Badge-' + i + '" value="' + escHtml(item.badge) + '" maxlength="40"></div>' : '';
        var html = '<div class="col-md-6">' +
            '<div class="adminConteudo__card">' +
                '<p class="formGroup__label adminConteudo__cardLabel" style="font-weight:600">Card ' + (i + 1) + '</p>' +
                badgeField +
                '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Titulo</label><input type="text" class="formGroup__input" id="' + group + 'Tit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="90"></div>' +
                '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Texto</label><input type="text" class="formGroup__input" id="' + group + 'Txt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="180"></div>';
        for (var b = 0; b < 4; b++) {
            html += '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Bullet ' + (b + 1) + '</label><input type="text" class="formGroup__input" id="' + group + 'Bullet-' + i + '-' + b + '" value="' + escHtml((item.bullets || [])[b]) + '" maxlength="90"></div>';
        }
        html += '<div class="formGroup__item"><label class="formGroup__label adminConteudo__cardLabel">Imagem</label>' + buildImgWidget(fieldId, prevId, emptyId, item.imagem) + '</div>' +
            '</div>' +
        '</div>';
        return html;
    }

    function renderCards(containerId, group, items, withBadge) {
        var $c = $('#' + containerId).empty();
        $.each(items, function (i, item) { $c.append(buildCard(group, i, item, withBadge)); });
    }

    function collectCards(group, count, withBadge) {
        var out = [];
        for (var i = 0; i < count; i++) {
            var bullets = [];
            for (var b = 0; b < 4; b++) bullets.push($('#' + group + 'Bullet-' + i + '-' + b).val().trim());
            var card = {
                titulo: $('#' + group + 'Tit-' + i).val().trim(),
                texto: $('#' + group + 'Txt-' + i).val().trim(),
                imagem: $('#' + group + '-img-' + i).val().trim(),
                bullets: bullets
            };
            if (withBadge) card.badge = $('#' + group + 'Badge-' + i).val().trim();
            out.push(card);
        }
        return out;
    }

    function renderConnCard(item) {
        $('#connCardContainer').empty().append(buildCard('conn', 0, item, false));
    }

    function loadConteudo() {
        $.get(API_BASE + 'get_combo_content.php', function (res) {
            if (!res.ok) return;
            content = res.content;
            var c = content;

            $('#introTitulo').val(c.intro_titulo);
            $('#introTexto').val(c.intro_texto);

            $('#resTitulo').val(c.res_titulo);
            $('#resTexto').val(c.res_texto);
            renderCards('resCardsContainer', 'res', c.res_cards || [], true);

            $('#bizTitulo').val(c.biz_titulo);
            $('#bizTexto').val(c.biz_texto);
            renderCards('bizCardsContainer', 'biz', c.biz_cards || [], false);

            $('#connTitulo').val(c.conn_titulo);
            $('#connTexto').val(c.conn_texto);
            renderConnCard(c.conn_card || {});
            $('#customTitulo').val(c.custom_titulo);
            $('#customTexto').val(c.custom_texto);

            $('#trustGoogle').val(c.trust_google);
            $.each(c.trust_items || [], function (i, v) { $('#trustItem-' + i).val(v); });
        });
    }

    function saveConteudo() {
        var body = {
            intro_titulo: $('#introTitulo').val().trim(),
            intro_texto: $('#introTexto').val().trim(),

            res_titulo: $('#resTitulo').val().trim(),
            res_texto: $('#resTexto').val().trim(),
            res_cards: collectCards('res', (content.res_cards || []).length, true),

            biz_titulo: $('#bizTitulo').val().trim(),
            biz_texto: $('#bizTexto').val().trim(),
            biz_cards: collectCards('biz', (content.biz_cards || []).length, false),

            conn_titulo: $('#connTitulo').val().trim(),
            conn_texto: $('#connTexto').val().trim(),
            conn_card: collectCards('conn', 1, false)[0],
            custom_titulo: $('#customTitulo').val().trim(),
            custom_texto: $('#customTexto').val().trim(),

            trust_google: $('#trustGoogle').val().trim(),
            trust_items: [0,1,2].map(function (i) { return $('#trustItem-' + i).val().trim(); })
        };

        $.ajax({
            url: API_BASE + 'save_combo_content.php',
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
            url: API_BASE + 'upload_combo_image.php',
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
