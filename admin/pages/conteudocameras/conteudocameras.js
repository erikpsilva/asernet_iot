$(document).ready(function () {
    var SITE  = window.SITE_BASE  || '';
    var ADMIN = window.ADMIN_BASE || '';
    var API_GET    = ADMIN + '/services/api/content/get_cameras_content.php';
    var API_SAVE   = ADMIN + '/services/api/content/save_cameras_content.php';
    var API_UPLOAD = ADMIN + '/services/api/content/upload_camera_image.php';

    function escAttr(s) {
        return String(s || '')
            .replace(/&/g, '&amp;').replace(/"/g, '&quot;')
            .replace(/</g, '&lt;').replace(/>/g, '&gt;');
    }

    // --- IMAGE ---

    function imgUrl(filename) {
        return SITE + '/images/cameraseguranca/' + filename + '?v=' + Date.now();
    }

    function loadStaticImg(fieldId, previewId, emptyId, filename) {
        $('#' + fieldId).val(filename || '');
        if (filename) {
            $('#' + previewId).attr('src', SITE + '/images/cameraseguranca/' + filename).show();
            if (emptyId) $('#' + emptyId).hide();
        }
    }

    function buildImgWidget(fieldId, previewId, filename) {
        var src = filename ? (SITE + '/images/cameraseguranca/' + filename) : '';
        var mediaEl = src
            ? '<img class="adminConteudo__imgPreview" id="' + previewId + '" src="' + escAttr(src) + '" alt="">'
            : '<span class="adminConteudo__imgPreview" id="' + previewId + '" style="display:flex;align-items:center;justify-content:center;color:#b0bdd6;font-size:12px;">Sem imagem</span>';

        return '<div class="adminConteudo__imgWrap">' +
            mediaEl +
            '<label class="adminConteudo__imgBtn" for="upload-' + escAttr(previewId) + '">Trocar imagem</label>' +
            '<input type="file" id="upload-' + escAttr(previewId) + '" class="adminConteudo__fileInput"' +
            ' accept="image/jpeg,image/png,image/webp"' +
            ' data-img-field="' + fieldId + '" data-img-preview="' + previewId + '">' +
            '<input type="hidden" id="' + fieldId + '" value="' + escAttr(filename || '') + '">' +
            '</div>';
    }

    // Generic delegated upload handler
    $(document).on('change', '.adminConteudo__fileInput', function () {
        var $input    = $(this);
        var fieldId   = $input.data('img-field');
        var previewId = $input.data('img-preview');
        var file      = this.files[0];
        if (!file) return;

        var $wrap = $input.closest('.adminConteudo__imgWrap');
        $wrap.find('.adminConteudo__imgBtn').text('Enviando...');

        var fd = new FormData();
        fd.append('image', file);

        $.ajax({ url: API_UPLOAD, type: 'POST', data: fd, processData: false, contentType: false })
            .done(function (res) {
                if (res.ok) {
                    $('#' + fieldId).val(res.filename);
                    var src = imgUrl(res.filename);
                    var $prev = $('#' + previewId);
                    if ($prev.is('img')) {
                        $prev.attr('src', src).show();
                    } else {
                        $prev.replaceWith('<img class="adminConteudo__imgPreview" id="' + previewId + '" src="' + src + '" alt="">');
                    }
                    showMsg('Imagem enviada com sucesso.', 'success');
                } else {
                    showMsg(res.message || 'Erro ao enviar imagem.', 'error');
                }
            })
            .fail(function () { showMsg('Erro ao enviar imagem.', 'error'); })
            .always(function () {
                $wrap.find('.adminConteudo__imgBtn').text('Trocar imagem');
                $input.val('');
            });
    });

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

    $(document).on('click', '[data-bullets-target]', function () {
        var id  = $(this).data('bullets-target');
        var max = parseInt($(this).data('bullets-max') || 5);
        if ($('#' + id + ' .adminConteudo__bulletRow').length < max) {
            $('#' + id).append(buildBulletRow(''));
        }
    });

    $(document).on('click', '.adminConteudo__removeBullet', function () {
        $(this).closest('.adminConteudo__bulletRow').remove();
    });

    // --- PLANOS ---

    function renderPlanos(planos) {
        var $c = $('#planosContainer').empty();
        $.each(planos || [], function (i, plano) { $c.append(buildPlanoCard(i, plano)); });
    }

    function buildPlanoCard(i, plano) {
        var bulletsHtml = '';
        $.each(plano.bullets || [], function (j, b) { bulletsHtml += buildBulletRow(b); });

        return '<div class="col-md-3">' +
            '<div class="adminConteudo__card">' +
            '<p class="adminConteudo__cardLabel">Plano ' + (i + 1) + '</p>' +

            '<div class="formGroup__item"><label class="formGroup__label">Nome</label>' +
            '<input type="text" class="formGroup__input" id="plano-nome-' + i + '" value="' + escAttr(plano.nome) + '" maxlength="60"></div>' +

            '<div class="formGroup__item"><label class="formGroup__label">Descrição</label>' +
            '<input type="text" class="formGroup__input" id="plano-desc-' + i + '" value="' + escAttr(plano.descricao) + '" maxlength="120"></div>' +

            '<div class="formGroup__item"><label class="formGroup__label">Quantidade</label>' +
            '<input type="text" class="formGroup__input" id="plano-qtd-' + i + '" value="' + escAttr(plano.quantidade) + '" maxlength="30"></div>' +

            '<div class="formGroup__item"><label class="formGroup__label">Taxa de instalação</label>' +
            '<input type="text" class="formGroup__input" id="plano-taxa-' + i + '" value="' + escAttr(plano.taxa) + '" maxlength="100"></div>' +

            '<div class="formGroup__item"><label class="formGroup__label">Bullets <small style="color:#8a9ab8">(até 6)</small></label>' +
            '<div id="planoBullets-' + i + '">' + bulletsHtml + '</div>' +
            '<button type="button" class="adminConteudo__addBulletBtn adminConteudo__addBulletBtn--sm" ' +
                'data-bullets-target="planoBullets-' + i + '" data-bullets-max="6">+ Item</button></div>' +

            '<div class="formGroup__item"><label class="formGroup__label">Preço <small style="color:#8a9ab8">(ex: 49,90)</small></label>' +
            '<input type="text" class="formGroup__input" id="plano-preco-' + i + '" value="' + escAttr(plano.preco) + '" maxlength="20"></div>' +

            '<div class="formGroup__item"><label class="formGroup__label">Imagem</label>' +
            buildImgWidget('plano-imagem-' + i, 'plano-img-prev-' + i, plano.imagem) + '</div>' +

            '</div></div>';
    }

    // --- DIFERENCIAIS ---

    function renderDiferenciais(items) {
        var $c = $('#diferenciaisContainer').empty();
        $.each(items || [], function (i, item) {
            $c.append(
                '<div class="col-md-6">' +
                '<div class="adminConteudo__card">' +
                '<p class="adminConteudo__cardLabel">Item ' + (i + 1) + '</p>' +
                '<div class="formGroup__item"><label class="formGroup__label">Título</label>' +
                '<input type="text" class="formGroup__input" id="dif-titulo-' + i + '" value="' + escAttr(item.titulo) + '" maxlength="60"></div>' +
                '<div class="formGroup__item"><label class="formGroup__label">Texto</label>' +
                '<input type="text" class="formGroup__input" id="dif-texto-' + i + '" value="' + escAttr(item.texto) + '" maxlength="160"></div>' +
                '</div></div>'
            );
        });
    }

    // --- LOAD ---

    $.get(API_GET).done(function (res) {
        if (!res.ok) return;
        var c = res.content;

        // Dor
        $('#dorTitulo').val(c.dor_titulo   || '');
        $('#dorDestaque').val(c.dor_destaque || '');
        $.each(c.dor_items || [], function (i, v) { $('#dorItem-' + i).val(v); });

        // Monitor
        $('#monitorTitulo').val(c.monitor_titulo || '');
        $('#monitorTexto').val(c.monitor_texto   || '');
        renderBullets('monitorBullets', c.monitor_bullets || []);
        loadStaticImg('monitor-imagem', 'monitor-img-prev', 'monitor-img-empty', c.monitor_imagem);

        $('#monitorCasaTitulo').val(c.monitor_casa_titulo   || '');
        $('#monitorCasaTexto').val(c.monitor_casa_texto     || '');
        loadStaticImg('monitor-casa-imagem', 'monitor-casa-img-prev', 'monitor-casa-img-empty', c.monitor_casa_imagem);

        $('#monitorEmpresaTitulo').val(c.monitor_empresa_titulo || '');
        $('#monitorEmpresaTexto').val(c.monitor_empresa_texto   || '');
        loadStaticImg('monitor-empresa-imagem', 'monitor-empresa-img-prev', 'monitor-empresa-img-empty', c.monitor_empresa_imagem);

        // Planos
        $('#planosTitulo').val(c.planos_titulo || '');
        renderPlanos(c.planos || []);

        // Como funciona
        $('#comoTitulo').val(c.como_titulo || '');
        $('#comoTexto').val(c.como_texto   || '');
        $.each(c.como_steps || [], function (i, v) { $('#comoStep-' + i).val(v); });
        $('#comoAppTitulo').val(c.como_app_titulo || '');
        $('#comoAppTexto').val(c.como_app_texto   || '');
        renderBullets('comoAppBullets', c.como_app_bullets || []);
        loadStaticImg('como-app-imagem', 'como-app-img-prev', 'como-app-img-empty', c.como_app_imagem);

        // Diferenciais
        $('#diferenciaisTitulo').val(c.diferenciais_titulo || '');
        renderDiferenciais(c.diferenciais || []);

    }).fail(function () { showMsg('Erro ao carregar conteúdo.', 'error'); });

    // --- SAVE ---

    $('#btnSalvarConteudo').on('click', function () {
        var $btn = $(this).prop('disabled', true).text('Salvando...');

        var planos = [];
        $('#planosContainer .adminConteudo__card').each(function (i) {
            planos.push({
                nome:      $('#plano-nome-'   + i).val().trim(),
                descricao: $('#plano-desc-'   + i).val().trim(),
                quantidade: $('#plano-qtd-'   + i).val().trim(),
                taxa:      $('#plano-taxa-'  + i).val().trim(),
                bullets:   collectBullets('planoBullets-' + i),
                preco:     $('#plano-preco-'  + i).val().trim(),
                imagem:    $('#plano-imagem-' + i).val()
            });
        });

        var diferenciais = [];
        $('#diferenciaisContainer .adminConteudo__card').each(function (i) {
            diferenciais.push({
                titulo: $('#dif-titulo-' + i).val().trim(),
                texto:  $('#dif-texto-'  + i).val().trim()
            });
        });

        var dorItems = [], comoSteps = [];
        for (var d = 0; d < 4; d++) dorItems.push($('#dorItem-'  + d).val().trim());
        for (var s = 0; s < 4; s++) comoSteps.push($('#comoStep-' + s).val().trim());

        var payload = {
            dor_titulo:    $('#dorTitulo').val().trim(),
            dor_destaque:  $('#dorDestaque').val().trim(),
            dor_items:     dorItems,

            monitor_titulo:          $('#monitorTitulo').val().trim(),
            monitor_texto:           $('#monitorTexto').val().trim(),
            monitor_bullets:         collectBullets('monitorBullets'),
            monitor_imagem:          $('#monitor-imagem').val(),
            monitor_casa_titulo:     $('#monitorCasaTitulo').val().trim(),
            monitor_casa_texto:      $('#monitorCasaTexto').val().trim(),
            monitor_casa_imagem:     $('#monitor-casa-imagem').val(),
            monitor_empresa_titulo:  $('#monitorEmpresaTitulo').val().trim(),
            monitor_empresa_texto:   $('#monitorEmpresaTexto').val().trim(),
            monitor_empresa_imagem:  $('#monitor-empresa-imagem').val(),

            planos_titulo: $('#planosTitulo').val().trim(),
            planos:        planos,

            como_titulo:      $('#comoTitulo').val().trim(),
            como_texto:       $('#comoTexto').val().trim(),
            como_steps:       comoSteps,
            como_app_titulo:  $('#comoAppTitulo').val().trim(),
            como_app_texto:   $('#comoAppTexto').val().trim(),
            como_app_bullets: collectBullets('comoAppBullets'),
            como_app_imagem:  $('#como-app-imagem').val(),

            diferenciais_titulo: $('#diferenciaisTitulo').val().trim(),
            diferenciais:        diferenciais
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
