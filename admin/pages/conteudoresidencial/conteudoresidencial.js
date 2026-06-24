$(document).ready(function () {
    var SITE  = window.SITE_BASE  || '';
    var ADMIN = window.ADMIN_BASE || '';
    var API_GET    = ADMIN + '/services/api/content/get_residencial_content.php';
    var API_SAVE   = ADMIN + '/services/api/content/save_residencial_content.php';
    var API_UPLOAD = ADMIN + '/services/api/content/upload_residencial_image.php';

    function escAttr(s) {
        return String(s || '')
            .replace(/&/g, '&amp;').replace(/"/g, '&quot;')
            .replace(/</g, '&lt;').replace(/>/g, '&gt;');
    }

    // --- BULLETS ---

    function buildBulletRow(text) {
        return '<div class="adminConteudo__bulletRow">' +
            '<input type="text" class="formGroup__input adminConteudo__bulletInput" value="' + escAttr(text) + '" maxlength="120">' +
            '<button type="button" class="adminConteudo__removeBullet" title="Remover">&times;</button>' +
            '</div>';
    }

    function renderBullets(containerId, bullets) {
        var $c = $('#' + containerId).empty();
        $.each(bullets || [], function (i, b) { $c.append(buildBulletRow(b)); });
    }

    function collectBullets(containerId) {
        var out = [];
        $('#' + containerId + ' .adminConteudo__bulletInput').each(function () {
            var v = $(this).val().trim();
            if (v) out.push(v);
        });
        return out;
    }

    // Add bullet (delegated — works for static and dynamic buttons)
    $(document).on('click', '[data-bullets-target]', function () {
        var id  = $(this).data('bullets-target');
        var max = parseInt($(this).data('bullets-max') || 5);
        if ($('#' + id + ' .adminConteudo__bulletRow').length < max) {
            $('#' + id).append(buildBulletRow(''));
        }
    });

    // Remove bullet (delegated)
    $(document).on('click', '.adminConteudo__removeBullet', function () {
        $(this).closest('.adminConteudo__bulletRow').remove();
    });

    // "Mais pedido" funciona como rádio: marcar um desmarca os outros
    $(document).on('change', '.adminConteudo__planoFeatured', function () {
        if (this.checked) {
            $('.adminConteudo__planoFeatured').not(this).prop('checked', false);
        }
    });

    // --- PLANOS ---

    function renderPlanos(planos) {
        var $c = $('#planosContainer').empty();
        $.each(planos || [], function (i, plano) { $c.append(buildPlanoCard(i, plano)); });
    }

    function buildPlanoCard(i, plano) {
        var bulletsHtml = '';
        $.each(plano.bullets || [], function (j, b) { bulletsHtml += buildBulletRow(b); });
        var featuredChecked = plano.featured ? 'checked' : '';

        return '<div class="col-md-4">' +
            '<div class="adminConteudo__card">' +
            '<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">' +
            '<p class="adminConteudo__cardLabel" style="margin:0">Plano ' + (i + 1) + '</p>' +
            '<label style="font-size:12px;color:#8a9ab8;cursor:pointer;display:flex;align-items:center;gap:5px">' +
            '<input type="checkbox" class="adminConteudo__planoFeatured" id="plano-featured-' + i + '" ' + featuredChecked + '> Mais pedido</label>' +
            '</div>' +

            '<div class="formGroup__item"><label class="formGroup__label">Nome</label>' +
            '<input type="text" class="formGroup__input" id="plano-nome-' + i + '" value="' + escAttr(plano.nome) + '" maxlength="60"></div>' +

            '<div class="formGroup__item"><label class="formGroup__label">Descrição</label>' +
            '<input type="text" class="formGroup__input" id="plano-desc-' + i + '" value="' + escAttr(plano.descricao) + '" maxlength="120"></div>' +

            '<div class="formGroup__item"><label class="formGroup__label">Bullets <small style="color:#8a9ab8">(até 5)</small></label>' +
            '<div id="planoBullets-' + i + '">' + bulletsHtml + '</div>' +
            '<button type="button" class="adminConteudo__addBulletBtn adminConteudo__addBulletBtn--sm" ' +
                'data-bullets-target="planoBullets-' + i + '" data-bullets-max="5">+ Item</button>' +
            '</div>' +

            '<div class="formGroup__item"><label class="formGroup__label">Preço <small style="color:#8a9ab8">(ex: 109,90)</small></label>' +
            '<input type="text" class="formGroup__input" id="plano-preco-' + i + '" value="' + escAttr(plano.preco) + '" maxlength="20"></div>' +

            '</div></div>';
    }

    // --- SUPORTE ---

    function renderSuporteItems(items) {
        var $c = $('#suporteContainer').empty();
        $.each(items || [], function (i, item) {
            $c.append(
                '<div class="col-md-6">' +
                '<div class="adminConteudo__card">' +
                '<p class="adminConteudo__cardLabel">Item ' + (i + 1) + '</p>' +
                '<div class="formGroup__item"><label class="formGroup__label">Título</label>' +
                '<input type="text" class="formGroup__input" id="suporte-titulo-' + i + '" value="' + escAttr(item.titulo) + '" maxlength="80"></div>' +
                '<div class="formGroup__item"><label class="formGroup__label">Texto</label>' +
                '<input type="text" class="formGroup__input" id="suporte-texto-' + i + '" value="' + escAttr(item.texto) + '" maxlength="200"></div>' +
                '</div></div>'
            );
        });
    }

    // --- IMAGE UPLOAD ---

    $('#diagImgUpload').on('change', function () {
        var file = this.files[0];
        if (!file) return;
        var fd = new FormData();
        fd.append('image', file);
        $('label[for="diagImgUpload"]').text('Enviando...');

        $.ajax({ url: API_UPLOAD, type: 'POST', data: fd, processData: false, contentType: false })
            .done(function (res) {
                if (res.ok) {
                    $('#diagImagem').val(res.filename);
                    var src = SITE + '/images/residencial/' + res.filename + '?v=' + Date.now();
                    $('#diagImgPreview').attr('src', src).show();
                    $('#diagImgEmpty').hide();
                    showMsg('Imagem enviada com sucesso.', 'success');
                } else {
                    showMsg(res.message || 'Erro ao enviar imagem.', 'error');
                }
            })
            .fail(function () { showMsg('Erro ao enviar imagem.', 'error'); })
            .always(function () {
                $('label[for="diagImgUpload"]').text('Trocar imagem');
                $('#diagImgUpload').val('');
            });
    });

    // --- LOAD ---

    $.get(API_GET).done(function (res) {
        if (!res.ok) return;
        var c = res.content;

        $('#diagTitulo').val(c.diagnostico_titulo || '');
        $('#diagTexto').val(c.diagnostico_texto   || '');
        $('#diagImagem').val(c.diagnostico_imagem  || '');
        if (c.diagnostico_imagem) {
            $('#diagImgPreview').attr('src', SITE + '/images/residencial/' + c.diagnostico_imagem).show();
            $('#diagImgEmpty').hide();
        }

        $('#solucaoTitulo').val(c.solucao_titulo || '');
        $('#solucaoTexto').val(c.solucao_texto   || '');
        renderBullets('solucaoBullets', c.solucao_bullets || []);

        $('#planosTitulo').val(c.planos_titulo || '');
        renderPlanos(c.planos || []);

        renderSuporteItems(c.suporte || []);

    }).fail(function () { showMsg('Erro ao carregar conteúdo.', 'error'); });

    // --- SAVE ---

    $('#btnSalvarConteudo').on('click', function () {
        var $btn = $(this).prop('disabled', true).text('Salvando...');

        var planos = [];
        $('#planosContainer .adminConteudo__card').each(function (i) {
            planos.push({
                nome:      $('#plano-nome-'  + i).val().trim(),
                descricao: $('#plano-desc-'  + i).val().trim(),
                bullets:   collectBullets('planoBullets-' + i),
                preco:     $('#plano-preco-' + i).val().trim(),
                featured:  $('#plano-featured-' + i).is(':checked')
            });
        });

        var suporte = [];
        $('#suporteContainer .adminConteudo__card').each(function (i) {
            suporte.push({
                titulo: $('#suporte-titulo-' + i).val().trim(),
                texto:  $('#suporte-texto-'  + i).val().trim()
            });
        });

        var payload = {
            diagnostico_titulo:  $('#diagTitulo').val().trim(),
            diagnostico_texto:   $('#diagTexto').val().trim(),
            diagnostico_imagem:  $('#diagImagem').val(),
            solucao_titulo:      $('#solucaoTitulo').val().trim(),
            solucao_texto:       $('#solucaoTexto').val().trim(),
            solucao_bullets:     collectBullets('solucaoBullets'),
            planos_titulo:       $('#planosTitulo').val().trim(),
            planos:              planos,
            suporte:             suporte
        };

        $.ajax({ url: API_SAVE, type: 'POST', contentType: 'application/json', data: JSON.stringify(payload) })
            .done(function (res) { showMsg(res.message || 'Salvo!', res.ok ? 'success' : 'error'); })
            .fail(function ()    { showMsg('Erro ao salvar. Tente novamente.', 'error'); })
            .always(function ()  { $btn.prop('disabled', false).text('Salvar alterações'); });
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
