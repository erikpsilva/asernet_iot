/* global SITE_BASE, ADMIN_BASE, PAGE_KEY */
(function ($) {
    'use strict';

    var API_BASE = ADMIN_BASE + '/services/api/banner/';
    var IMG_BASE = SITE_BASE + '/images/banners/' + PAGE_KEY + '/';
    var content  = {};

    // ── bullets dinâmicos ────────────────────────────────────────────────────
    function buildBulletRow(val) {
        return '<div class="adminConteudo__bulletRow">' +
            '<input type="text" class="formGroup__input adminConteudo__bulletInput" value="' + escHtml(val || '') + '" maxlength="120" placeholder="Item">' +
            '<button type="button" class="adminConteudo__removeBullet" title="Remover">&times;</button>' +
        '</div>';
    }

    function renderBullets(containerId, items) {
        var $c = $('#' + containerId).empty();
        $.each(items || [], function (_, v) { $c.append(buildBulletRow(v)); });
    }

    function collectBullets(containerId) {
        var out = [];
        $('#' + containerId + ' .adminConteudo__bulletInput').each(function () {
            var v = $(this).val().trim();
            if (v) out.push(v);
        });
        return out;
    }

    function escHtml(str) { return $('<div>').text(str || '').html(); }

    // ── load ─────────────────────────────────────────────────────────────────
    function loadConteudo() {
        $.get(API_BASE + 'get_banner.php', { page: PAGE_KEY }, function (res) {
            if (!res.ok) return;
            content = res.content;

            $('#bnTitulo').val(content.titulo || '');
            $('#bnTituloDestaque').val(content.titulo_destaque || '');
            $('#bnTituloComplemento').val(content.titulo_complemento || '');
            $('#bnTexto').val(content.texto || '');
            $('#bnPreco').val(content.preco || '');
            $('#bnBtn1').val(content.btn1_texto || '');
            $('#bnBtn2').val(content.btn2_texto || '');

            renderBullets('bnBullets', content.bullets || []);

            var img = content.imagem || '';
            $('#bnImagem').val(img);
            if (img) {
                $('#bnImgPrev').attr('src', IMG_BASE + img).show();
                $('#bnImgEmpty').hide();
            }
        }, 'json');
    }

    // ── save ─────────────────────────────────────────────────────────────────
    function saveConteudo() {
        var body = {
            page:                PAGE_KEY,
            titulo:              $('#bnTitulo').val().trim(),
            titulo_destaque:     $('#bnTituloDestaque').val().trim(),
            titulo_complemento:  $('#bnTituloComplemento').val().trim(),
            texto:               $('#bnTexto').val().trim(),
            bullets:             collectBullets('bnBullets'),
            preco:               $('#bnPreco').val().trim(),
            btn1_texto:          $('#bnBtn1').val().trim(),
            btn2_texto:          $('#bnBtn2').val().trim(),
            imagem:              $('#bnImagem').val().trim(),
        };
        $.ajax({
            url:         API_BASE + 'save_banner.php',
            method:      'POST',
            contentType: 'application/json',
            data:        JSON.stringify(body),
            success: function (res) { showMsg(res.ok, res.message || (res.ok ? 'Salvo!' : 'Erro.')); },
            error:   function ()    { showMsg(false, 'Erro de comunicação.'); }
        });
    }

    // ── upload imagem ─────────────────────────────────────────────────────────
    $(document).on('change', 'input[type="file"][data-img-field]', function () {
        var $input    = $(this);
        var fieldId   = $input.data('img-field');
        var previewId = $input.data('img-preview');
        var emptyId   = $input.data('img-empty');

        var fd = new FormData();
        fd.append('image', this.files[0]);
        fd.append('page', PAGE_KEY);

        $.ajax({
            url:         API_BASE + 'upload_banner_image.php',
            method:      'POST',
            data:        fd,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.ok) {
                    $('#' + fieldId).val(res.filename);
                    $('#' + previewId).attr('src', IMG_BASE + res.filename).show();
                    $('#' + emptyId).hide();
                } else {
                    showMsg(false, res.message || 'Erro no upload.');
                }
            },
            error: function () { showMsg(false, 'Erro no upload.'); }
        });
    });

    // ── bullets add / remove ──────────────────────────────────────────────────
    $(document).on('click', '[data-bullets-target]', function () {
        var target = $(this).data('bullets-target');
        var max    = parseInt($(this).data('bullets-max') || 10, 10);
        if ($('#' + target + ' .adminConteudo__bulletRow').length < max) {
            $('#' + target).append(buildBulletRow(''));
        }
    });
    $(document).on('click', '.adminConteudo__removeBullet', function () {
        $(this).closest('.adminConteudo__bulletRow').remove();
    });

    // ── init ──────────────────────────────────────────────────────────────────
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
