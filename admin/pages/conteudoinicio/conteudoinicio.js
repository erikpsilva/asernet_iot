$(document).ready(function () {
    var SITE = (typeof window.SITE_BASE !== 'undefined') ? window.SITE_BASE : '';
    var ADMIN = (typeof window.ADMIN_BASE !== 'undefined') ? window.ADMIN_BASE : '';
    var API_GET = ADMIN + '/services/api/content/get_home_content.php';
    var API_SAVE = ADMIN + '/services/api/content/save_home_content.php';
    var API_UPLOAD = ADMIN + '/services/api/content/upload_home_image.php';

    function escAttr(s) {
        return String(s || '')
            .replace(/&/g, '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    }

    function buildCard(section, i, card) {
        var imgSrc = card.imagem
            ? (SITE + '/images/home/' + card.imagem)
            : '';
        var imgTag = imgSrc
            ? '<img class="adminConteudo__imgPreview" id="preview-' + section + '-' + i + '" src="' + escAttr(imgSrc) + '" alt="">'
            : '<span class="adminConteudo__imgPreview" id="preview-' + section + '-' + i + '" style="display:flex;align-items:center;justify-content:center;color:#b0bdd6;font-size:12px;">Sem imagem</span>';

        return '<div class="col-md-6">' +
            '<div class="adminConteudo__card">' +

            '<div class="adminConteudo__imgWrap">' +
            imgTag +
            '<label class="adminConteudo__imgBtn" for="upload-' + section + '-' + i + '">Trocar imagem</label>' +
            '<input type="file" id="upload-' + section + '-' + i + '" class="adminConteudo__fileInput" accept="image/jpeg,image/png,image/webp" data-section="' + section + '" data-idx="' + i + '">' +
            '<input type="hidden" id="imagem-' + section + '-' + i + '" value="' + escAttr(card.imagem || '') + '">' +
            '</div>' +

            '<div class="formGroup__item"><label class="formGroup__label">Título</label>' +
            '<input type="text" class="formGroup__input" id="titulo-' + section + '-' + i + '" value="' + escAttr(card.titulo) + '" maxlength="80"></div>' +

            '<div class="formGroup__item"><label class="formGroup__label">Descrição</label>' +
            '<input type="text" class="formGroup__input" id="descricao-' + section + '-' + i + '" value="' + escAttr(card.descricao) + '" maxlength="120"></div>' +

            '<div class="formGroup__item"><label class="formGroup__label">Texto do link</label>' +
            '<input type="text" class="formGroup__input" id="link_texto-' + section + '-' + i + '" value="' + escAttr(card.link_texto) + '" maxlength="40"></div>' +

            '<div class="formGroup__item"><label class="formGroup__label">Destino do link <small style="color:#8a9ab8">(ex: /residencial)</small></label>' +
            '<input type="text" class="formGroup__input" id="link_href-' + section + '-' + i + '" value="' + escAttr(card.link_href) + '" maxlength="200"></div>' +

            '</div></div>';
    }

    function renderSection(containerId, cards, section) {
        var $c = $('#' + containerId).empty();
        $.each(cards, function (i, card) {
            $c.append(buildCard(section, i, card));
        });
    }

    // Load
    $.get(API_GET).done(function (res) {
        if (!res.ok) return;
        var c = res.content;
        $('#introTitulo').val(c.intro_titulo || '');
        $('#introSubtitulo').val(c.intro_subtitulo || '');
        renderSection('cardsCasa', c.cards_casa || [], 'casa');
        renderSection('cardsEmpresa', c.cards_empresa || [], 'empresa');
        renderSection('cardsSeguranca', c.cards_seguranca || [], 'seguranca');
    }).fail(function () {
        showMsg('Erro ao carregar conteúdo.', 'error');
    });

    // Image upload (delegated)
    $(document).on('change', '.adminConteudo__fileInput', function () {
        var $input = $(this);
        var file = this.files[0];
        if (!file) return;
        var section = $input.data('section');
        var idx = $input.data('idx');
        var fd = new FormData();
        fd.append('image', file);
        fd.append('section', section);
        fd.append('idx', idx);

        $input.closest('.adminConteudo__imgWrap').find('.adminConteudo__imgBtn').text('Enviando...');

        $.ajax({
            url: API_UPLOAD,
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false
        }).done(function (res) {
            if (res.ok) {
                $('#imagem-' + section + '-' + idx).val(res.filename);
                var $prev = $('#preview-' + section + '-' + idx);
                if ($prev.is('img')) {
                    $prev.attr('src', SITE + '/images/home/' + res.filename + '?v=' + new Date().getTime());
                } else {
                    $prev.replaceWith('<img class="adminConteudo__imgPreview" id="preview-' + section + '-' + idx + '" src="' + SITE + '/images/home/' + res.filename + '?v=' + new Date().getTime() + '" alt="">');
                }
                showMsg('Imagem enviada com sucesso.', 'success');
            } else {
                showMsg(res.message || 'Erro ao enviar imagem.', 'error');
            }
        }).fail(function () {
            showMsg('Erro ao enviar imagem.', 'error');
        }).always(function () {
            $input.closest('.adminConteudo__imgWrap').find('.adminConteudo__imgBtn').text('Trocar imagem');
            $input.val('');
        });
    });

    // Save
    $('#btnSalvarConteudo').on('click', function () {
        var $btn = $(this).prop('disabled', true).text('Salvando...');

        function collectCards(section, count) {
            var cards = [];
            for (var i = 0; i < count; i++) {
                cards.push({
                    titulo:      $('#titulo-' + section + '-' + i).val().trim(),
                    descricao:   $('#descricao-' + section + '-' + i).val().trim(),
                    imagem:      $('#imagem-' + section + '-' + i).val(),
                    link_texto:  $('#link_texto-' + section + '-' + i).val().trim(),
                    link_href:   $('#link_href-' + section + '-' + i).val().trim()
                });
            }
            return cards;
        }

        var payload = {
            intro_titulo:    $('#introTitulo').val().trim(),
            intro_subtitulo: $('#introSubtitulo').val().trim(),
            cards_casa:      collectCards('casa', 4),
            cards_empresa:   collectCards('empresa', 4),
            cards_seguranca: collectCards('seguranca', 2)
        };

        $.ajax({
            url: API_SAVE,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(payload)
        }).done(function (res) {
            showMsg(res.message || 'Salvo!', res.ok ? 'success' : 'error');
        }).fail(function () {
            showMsg('Erro ao salvar. Tente novamente.', 'error');
        }).always(function () {
            $btn.prop('disabled', false).text('Salvar alterações');
        });
    });

    function showMsg(msg, type) {
        var $el = $('#conteudoMsg');
        $el.text(msg)
            .removeClass('adminConteudo__msg--success adminConteudo__msg--error')
            .addClass('adminConteudo__msg--' + type)
            .show();
        $('html, body').animate({ scrollTop: $el.offset().top - 20 }, 200);
        setTimeout(function () { $el.fadeOut(); }, 5000);
    }
});
