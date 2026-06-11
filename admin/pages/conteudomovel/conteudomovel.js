(function ($) {
    'use strict';

    var API_BASE = ADMIN_BASE + '/services/api/content/';
    var content  = {};

    /* ---------- utils ---------- */
    function escHtml(str) {
        return $('<div>').text(str || '').html();
    }

    /* ---------- bullets ---------- */
    function buildBulletRow(val) {
        return '<div class="adminConteudo__bulletRow">' +
            '<input type="text" class="formGroup__input adminConteudo__bulletInput" value="' + escHtml(val) + '" maxlength="120">' +
            '<button type="button" class="adminConteudo__removeBullet">&#x2715;</button>' +
            '</div>';
    }

    function renderBullets(containerId, items) {
        var $c = $('#' + containerId).empty();
        $.each(items, function (_, v) { $c.append(buildBulletRow(v)); });
    }

    function collectBullets(containerId) {
        var out = [];
        $('#' + containerId + ' .adminConteudo__bulletInput').each(function () {
            var v = $(this).val().trim();
            if (v) out.push(v);
        });
        return out;
    }

    /* ---------- imagem widget (para JS-rendered) ---------- */
    function buildImgWidget(fieldId, prevId, emptyId, filename) {
        var hasSrc    = !!filename;
        var src       = hasSrc ? SITE_BASE + '/images/planomovel/' + filename : '';
        var prevStyle = hasSrc ? '' : 'display:none';
        var emptyVis  = hasSrc ? 'display:none' : '';
        return '<div class="adminConteudo__imgWrap">' +
            '<img class="adminConteudo__imgPreview" id="' + prevId + '" src="' + src + '" style="' + prevStyle + '">' +
            '<span id="' + emptyId + '" style="color:#b0bdd6;font-size:12px;' + emptyVis + '">Sem imagem</span>' +
            '<label class="adminConteudo__imgBtn" for="upload-' + prevId + '">Trocar imagem</label>' +
            '<input type="file" id="upload-' + prevId + '" class="adminConteudo__fileInput" accept="image/jpeg,image/png,image/webp"' +
            ' data-img-field="' + fieldId + '" data-img-preview="' + prevId + '" data-img-empty="' + emptyId + '" data-img-base="planomovel">' +
            '<input type="hidden" id="' + fieldId + '" value="' + escHtml(filename || '') + '">' +
            '</div>';
    }

    /* ---------- planos ---------- */
    function buildPlanoCard(i, plano) {
        var featuredChecked = plano.featured ? 'checked' : '';
        var bulletsHtml = '';
        $.each(plano.bullets || [], function (_, b) { bulletsHtml += buildBulletRow(b); });

        return '<div class="col-md-4">' +
            '<div class="adminConteudo__card">' +
                '<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">' +
                    '<label class="formGroup__label adminConteudo__cardLabel" style="margin:0">Plano ' + (i + 1) + '</label>' +
                    '<label style="font-size:12px;color:#8a9ab8;cursor:pointer">' +
                        '<input type="checkbox" id="planoFeatured-' + i + '" ' + featuredChecked + '> Destaque</label>' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Nome (ex: 20 GB)</label>' +
                    '<input type="text" class="formGroup__input" id="planoNome-' + i + '" value="' + escHtml(plano.nome) + '" maxlength="20">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Subtítulo</label>' +
                    '<input type="text" class="formGroup__input" id="planoSub-' + i + '" value="' + escHtml(plano.subtitulo) + '" maxlength="60">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Preço (R$)</label>' +
                    '<input type="text" class="formGroup__input" id="planoPreco-' + i + '" value="' + escHtml(plano.preco) + '" maxlength="10">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Bullets <small style="color:#8a9ab8">(até 5)</small></label>' +
                    '<div id="planBullets-' + i + '">' + bulletsHtml + '</div>' +
                    '<button type="button" class="adminConteudo__addBulletBtn adminConteudo__addBulletBtn--sm"' +
                        ' data-bullets-target="planBullets-' + i + '" data-bullets-max="5">+ Adicionar item</button>' +
                '</div>' +
            '</div>' +
        '</div>';
    }

    function renderPlanos(planos) {
        var $c = $('#planosContainer').empty();
        $.each(planos, function (i, p) { $c.append(buildPlanoCard(i, p)); });
    }

    function collectPlanos(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({
                nome:      $('#planoNome-' + i).val().trim(),
                subtitulo: $('#planoSub-' + i).val().trim(),
                preco:     $('#planoPreco-' + i).val().trim(),
                bullets:   collectBullets('planBullets-' + i),
                featured:  $('#planoFeatured-' + i).is(':checked'),
            });
        }
        return out;
    }

    /* ---------- benefícios ---------- */
    function buildBeneficioCard(i, item) {
        return '<div class="col-md-6">' +
            '<div class="adminConteudo__card">' +
                '<label class="formGroup__label adminConteudo__cardLabel">Título</label>' +
                '<input type="text" class="formGroup__input" id="benefTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="60">' +
                '<label class="formGroup__label adminConteudo__cardLabel" style="margin-top:8px">Texto</label>' +
                '<input type="text" class="formGroup__input" id="benefTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="120">' +
            '</div>' +
        '</div>';
    }

    function renderBeneficios(items) {
        var $c = $('#beneficiosContainer').empty();
        $.each(items, function (i, item) { $c.append(buildBeneficioCard(i, item)); });
    }

    function collectBeneficios(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({ titulo: $('#benefTit-' + i).val().trim(), texto: $('#benefTxt-' + i).val().trim() });
        }
        return out;
    }

    /* ---------- ecossistema ---------- */
    function buildEcoCard(i, item) {
        var fieldId = 'eco-img-' + i;
        var prevId  = 'eco-prev-' + i;
        var emptyId = 'eco-empty-' + i;
        return '<div class="col-md-4">' +
            '<div class="adminConteudo__card">' +
                buildImgWidget(fieldId, prevId, emptyId, item.imagem) +
                '<div class="formGroup__item" style="margin-top:8px">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Rótulo</label>' +
                    '<input type="text" class="formGroup__input" id="ecoTexto-' + i + '" value="' + escHtml(item.texto) + '" maxlength="40">' +
                '</div>' +
            '</div>' +
        '</div>';
    }

    function renderEco(items) {
        var $c = $('#ecoContainer').empty();
        $.each(items, function (i, item) { $c.append(buildEcoCard(i, item)); });
    }

    function collectEco(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({ texto: $('#ecoTexto-' + i).val().trim(), imagem: $('#eco-img-' + i).val().trim() });
        }
        return out;
    }

    /* ---------- load ---------- */
    function loadConteudo() {
        $.get(API_BASE + 'get_movel_content.php', function (res) {
            if (!res.ok) return;
            content = res.content;
            var c = content;

            /* rotina */
            $('#rotinaTitulo').val(c.rotina_titulo);
            $.each(c.rotina_items || [], function (i, v) { $('#rotinaItem-' + i).val(v); });

            /* planos */
            $('#planosTitulo').val(c.planos_titulo);
            $('#planosPortabilidade').val(c.planos_portabilidade);
            renderPlanos(c.planos || []);

            /* benefícios */
            $('#beneficiosTitulo').val(c.beneficios_titulo);
            renderBeneficios(c.beneficios || []);

            /* como funciona */
            $('#comoTitulo').val(c.como_titulo);
            $.each(c.como_steps || [], function (i, step) {
                $('#comoTit-' + i).val(step.titulo);
                $('#comoTxt-' + i).val(step.texto);
            });

            /* ecossistema */
            $('#ecoTitulo').val(c.eco_titulo);
            $('#ecoResultado').val(c.eco_resultado);
            renderEco(c.eco_items || []);

            /* trust */
            $('#trustGoogle').val(c.trust_google);
            $('#trustItem1').val(c.trust_item1);
            $('#trustItem2').val(c.trust_item2);
        });
    }

    /* ---------- save ---------- */
    function saveConteudo() {
        var planosCount    = (content.planos    || []).length;
        var benefCount     = (content.beneficios || []).length;
        var ecoCount       = (content.eco_items  || []).length;

        var rotinaItems = [];
        for (var ri = 0; ri < 5; ri++) rotinaItems.push($('#rotinaItem-' + ri).val().trim());

        var comoSteps = [];
        for (var ci = 0; ci < 4; ci++) {
            comoSteps.push({ titulo: $('#comoTit-' + ci).val().trim(), texto: $('#comoTxt-' + ci).val().trim() });
        }

        var body = {
            rotina_titulo: $('#rotinaTitulo').val().trim(),
            rotina_items:  rotinaItems,

            planos_titulo:        $('#planosTitulo').val().trim(),
            planos_portabilidade: $('#planosPortabilidade').val().trim(),
            planos:               collectPlanos(planosCount),

            beneficios_titulo: $('#beneficiosTitulo').val().trim(),
            beneficios:        collectBeneficios(benefCount),

            como_titulo: $('#comoTitulo').val().trim(),
            como_steps:  comoSteps,

            eco_titulo:   $('#ecoTitulo').val().trim(),
            eco_resultado:$('#ecoResultado').val().trim(),
            eco_items:    collectEco(ecoCount),

            trust_google: $('#trustGoogle').val().trim(),
            trust_item1:  $('#trustItem1').val().trim(),
            trust_item2:  $('#trustItem2').val().trim(),
        };

        $.ajax({
            url:         API_BASE + 'save_movel_content.php',
            method:      'POST',
            contentType: 'application/json',
            data:        JSON.stringify(body),
            success: function (res) {
                showMsg(res.ok, res.message || (res.ok ? 'Salvo!' : 'Erro ao salvar.'));
            },
            error: function () { showMsg(false, 'Erro de comunicação.'); }
        });
    }

    /* ---------- upload genérico via data-attrs ---------- */
    $(document).on('change', 'input[type="file"][data-img-field]', function () {
        var $input   = $(this);
        var fieldId  = $input.data('img-field');
        var previewId= $input.data('img-preview');
        var emptyId  = $input.data('img-empty');
        var file     = this.files[0];
        if (!file) return;

        var fd = new FormData();
        fd.append('image', file);

        $.ajax({
            url:         API_BASE + 'upload_movel_image.php',
            method:      'POST',
            data:        fd,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.ok) {
                    $('#' + fieldId).val(res.filename);
                    $('#' + previewId).attr('src', SITE_BASE + '/images/planomovel/' + res.filename).show();
                    if (emptyId) $('#' + emptyId).hide();
                } else {
                    showMsg(false, res.message || 'Erro no upload.');
                }
            },
            error: function () { showMsg(false, 'Erro no upload.'); }
        });
    });

    /* ---------- bullet: add / remove ---------- */
    $(document).on('click', '[data-bullets-target]', function () {
        var targetId = $(this).data('bullets-target');
        var max      = parseInt($(this).data('bullets-max'), 10) || 5;
        var $c       = $('#' + targetId);
        if ($c.find('.adminConteudo__bulletRow').length >= max) return;
        $c.append(buildBulletRow(''));
    });

    $(document).on('click', '.adminConteudo__removeBullet', function () {
        $(this).closest('.adminConteudo__bulletRow').remove();
    });

    /* ---------- save button ---------- */
    $('#btnSalvarConteudo').on('click', saveConteudo);

    /* ---------- msg ---------- */
    function showMsg(ok, text) {
        var $m = $('#conteudoMsg');
        $m.removeClass('adminConteudo__msg--ok adminConteudo__msg--err')
          .addClass(ok ? 'adminConteudo__msg--ok' : 'adminConteudo__msg--err')
          .text(text).show();
        setTimeout(function () { $m.fadeOut(); }, 3500);
    }

    /* ---------- init ---------- */
    loadConteudo();

}(jQuery));
