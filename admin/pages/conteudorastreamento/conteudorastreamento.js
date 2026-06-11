(function ($) {
    'use strict';

    var API_BASE = ADMIN_BASE + '/services/api/content/';
    var IMG_BASE = SITE_BASE + '/images/rastreamentoveicular/';
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

    /* ---------- image widget ---------- */
    function buildImgWidget(fieldId, prevId, emptyId, filename) {
        var hasSrc    = !!filename;
        var src       = hasSrc ? IMG_BASE + filename : '';
        var prevStyle = hasSrc ? '' : 'display:none';
        var emptyVis  = hasSrc ? 'display:none' : '';
        return '<div class="adminConteudo__imgWrap">' +
            '<img class="adminConteudo__imgPreview" id="' + prevId + '" src="' + src + '" style="' + prevStyle + '">' +
            '<span id="' + emptyId + '" style="color:#b0bdd6;font-size:12px;' + emptyVis + '">Sem imagem</span>' +
            '<label class="adminConteudo__imgBtn" for="upload-' + prevId + '">Trocar imagem</label>' +
            '<input type="file" id="upload-' + prevId + '" class="adminConteudo__fileInput" accept="image/jpeg,image/png,image/webp"' +
            ' data-img-field="' + fieldId + '" data-img-preview="' + prevId + '" data-img-empty="' + emptyId + '">' +
            '<input type="hidden" id="' + fieldId + '" value="' + escHtml(filename || '') + '">' +
            '</div>';
    }

    function loadStaticImg(fieldId, prevId, emptyId, filename) {
        if (!filename) return;
        $('#' + prevId).attr('src', IMG_BASE + filename).show();
        $('#' + emptyId).hide();
        $('#' + fieldId).val(filename);
    }

    /* ---------- quick cards ---------- */
    function buildQuickCard(i, item) {
        return '<div class="col-md-6">' +
            '<div class="adminConteudo__card">' +
                '<label class="formGroup__label adminConteudo__cardLabel">Título</label>' +
                '<input type="text" class="formGroup__input" id="quickTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="60">' +
                '<label class="formGroup__label adminConteudo__cardLabel" style="margin-top:8px">Texto</label>' +
                '<input type="text" class="formGroup__input" id="quickTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="120">' +
            '</div>' +
        '</div>';
    }

    function renderQuick(items) {
        var $c = $('#quickContainer').empty();
        $.each(items, function (i, item) { $c.append(buildQuickCard(i, item)); });
    }

    function collectQuick(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({ titulo: $('#quickTit-' + i).val().trim(), texto: $('#quickTxt-' + i).val().trim() });
        }
        return out;
    }

    /* ---------- category cards ---------- */
    function buildCatCard(i, item) {
        var fieldId = 'catCard-img-' + i;
        var prevId  = 'catCard-prev-' + i;
        var emptyId = 'catCard-empty-' + i;
        var featuredChecked = item.featured ? 'checked' : '';
        return '<div class="col-md-6">' +
            '<div class="adminConteudo__card">' +
                '<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">' +
                    '<label class="formGroup__label adminConteudo__cardLabel" style="margin:0">Card ' + (i + 1) + '</label>' +
                    '<label style="font-size:12px;color:#8a9ab8;cursor:pointer">' +
                        '<input type="checkbox" id="catFeatured-' + i + '" ' + featuredChecked + '> Destaque</label>' +
                '</div>' +
                buildImgWidget(fieldId, prevId, emptyId, item.imagem) +
                '<div class="formGroup__item" style="margin-top:8px">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Título</label>' +
                    '<input type="text" class="formGroup__input" id="catTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="60">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Texto</label>' +
                    '<input type="text" class="formGroup__input" id="catTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="120">' +
                '</div>' +
            '</div>' +
        '</div>';
    }

    function renderCatCards(items) {
        var $c = $('#catCardsContainer').empty();
        $.each(items, function (i, item) { $c.append(buildCatCard(i, item)); });
    }

    function collectCatCards(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({
                titulo:   $('#catTit-' + i).val().trim(),
                texto:    $('#catTxt-' + i).val().trim(),
                imagem:   $('#catCard-img-' + i).val().trim(),
                featured: $('#catFeatured-' + i).is(':checked'),
            });
        }
        return out;
    }

    /* ---------- category more items ---------- */
    function buildMoreItem(i, item) {
        var fieldId = 'catMore-img-' + i;
        var prevId  = 'catMore-prev-' + i;
        var emptyId = 'catMore-empty-' + i;
        return '<div class="col-md-4">' +
            '<div class="adminConteudo__card">' +
                buildImgWidget(fieldId, prevId, emptyId, item.imagem) +
                '<div class="formGroup__item" style="margin-top:8px">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Rótulo</label>' +
                    '<input type="text" class="formGroup__input" id="catMoreTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="40">' +
                '</div>' +
            '</div>' +
        '</div>';
    }

    function renderCatMore(items) {
        var $c = $('#catMoreContainer').empty();
        $.each(items, function (i, item) { $c.append(buildMoreItem(i, item)); });
    }

    function collectCatMore(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({ texto: $('#catMoreTxt-' + i).val().trim(), imagem: $('#catMore-img-' + i).val().trim() });
        }
        return out;
    }

    /* ---------- planos ---------- */
    function buildPlanCard(i, plano) {
        var labels = ['Plano 1 — Rastreador Veicular', 'Plano 2 — Veicular + Tag (Destaque)', 'Plano 3 — Tag Localizadora'];
        var bulletsHtml = '';
        $.each(plano.bullets || [], function (_, b) { bulletsHtml += buildBulletRow(b); });

        return '<div class="col-md-4">' +
            '<div class="adminConteudo__card">' +
                '<label class="formGroup__label adminConteudo__cardLabel" style="margin-bottom:8px">' + (labels[i] || 'Plano ' + (i + 1)) + '</label>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Nome</label>' +
                    '<input type="text" class="formGroup__input" id="planoNome-' + i + '" value="' + escHtml(plano.nome) + '" maxlength="60">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Descrição</label>' +
                    '<input type="text" class="formGroup__input" id="planoDesc-' + i + '" value="' + escHtml(plano.descricao) + '" maxlength="120">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Preço (R$)</label>' +
                    '<input type="text" class="formGroup__input" id="planoPreco-' + i + '" value="' + escHtml(plano.preco) + '" maxlength="10">' +
                '</div>' +
                '<div class="formGroup__item">' +
                    '<label class="formGroup__label adminConteudo__cardLabel">Bullets <small style="color:#8a9ab8">(até 6)</small></label>' +
                    '<div id="planBullets-' + i + '">' + bulletsHtml + '</div>' +
                    '<button type="button" class="adminConteudo__addBulletBtn adminConteudo__addBulletBtn--sm"' +
                        ' data-bullets-target="planBullets-' + i + '" data-bullets-max="6">+ Adicionar item</button>' +
                '</div>' +
            '</div>' +
        '</div>';
    }

    function renderPlanos(planos) {
        var $c = $('#planosContainer').empty();
        $.each(planos, function (i, p) { $c.append(buildPlanCard(i, p)); });
    }

    function collectPlanos(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({
                nome:      $('#planoNome-' + i).val().trim(),
                descricao: $('#planoDesc-' + i).val().trim(),
                preco:     $('#planoPreco-' + i).val().trim(),
                bullets:   collectBullets('planBullets-' + i),
            });
        }
        return out;
    }

    /* ---------- why items ---------- */
    function buildWhyCard(i, item) {
        return '<div class="col-md-6">' +
            '<div class="adminConteudo__card">' +
                '<label class="formGroup__label adminConteudo__cardLabel">Título</label>' +
                '<input type="text" class="formGroup__input" id="whyTit-' + i + '" value="' + escHtml(item.titulo) + '" maxlength="60">' +
                '<label class="formGroup__label adminConteudo__cardLabel" style="margin-top:8px">Texto</label>' +
                '<input type="text" class="formGroup__input" id="whyTxt-' + i + '" value="' + escHtml(item.texto) + '" maxlength="120">' +
            '</div>' +
        '</div>';
    }

    function renderWhy(items) {
        var $c = $('#whyContainer').empty();
        $.each(items, function (i, item) { $c.append(buildWhyCard(i, item)); });
    }

    function collectWhy(count) {
        var out = [];
        for (var i = 0; i < count; i++) {
            out.push({ titulo: $('#whyTit-' + i).val().trim(), texto: $('#whyTxt-' + i).val().trim() });
        }
        return out;
    }

    /* ---------- load ---------- */
    function loadConteudo() {
        $.get(API_BASE + 'get_rastreamento_content.php', function (res) {
            if (!res.ok) return;
            content = res.content;
            var c = content;

            renderQuick(c.quick_items || []);

            $('#catTitulo').val(c.cat_titulo);
            $('#catSubtitulo').val(c.cat_subtitulo);
            renderCatCards(c.cat_cards || []);
            renderCatMore(c.cat_more || []);

            loadStaticImg('bike-imagem', 'bike-img-prev', 'bike-img-empty', c.bike_imagem);
            $('#bikeTitulo').val(c.bike_titulo);
            $('#bikeTexto').val(c.bike_texto);
            renderBullets('bikeBullets', c.bike_bullets || []);

            $('#planosTitulo').val(c.planos_titulo);
            $('#planosSubtitulo').val(c.planos_subtitulo);
            $('#planosNota').val(c.planos_nota);
            renderPlanos(c.planos || []);

            $('#whyTitulo').val(c.why_titulo);
            renderWhy(c.why_items || []);

            $('#trustGoogle').val(c.trust_google);
            $.each(c.trust_items || [], function (i, v) { $('#trustItem-' + i).val(v); });
        });
    }

    /* ---------- save ---------- */
    function saveConteudo() {
        var trustItems = [];
        for (var ti = 0; ti < 4; ti++) trustItems.push($('#trustItem-' + ti).val().trim());

        var body = {
            quick_items: collectQuick((content.quick_items || []).length),

            cat_titulo:    $('#catTitulo').val().trim(),
            cat_subtitulo: $('#catSubtitulo').val().trim(),
            cat_cards:     collectCatCards((content.cat_cards || []).length),
            cat_more:      collectCatMore((content.cat_more || []).length),

            bike_titulo:  $('#bikeTitulo').val().trim(),
            bike_texto:   $('#bikeTexto').val().trim(),
            bike_imagem:  $('#bike-imagem').val().trim(),
            bike_bullets: collectBullets('bikeBullets'),

            planos_titulo:    $('#planosTitulo').val().trim(),
            planos_subtitulo: $('#planosSubtitulo').val().trim(),
            planos_nota:      $('#planosNota').val().trim(),
            planos:           collectPlanos((content.planos || []).length),

            why_titulo: $('#whyTitulo').val().trim(),
            why_items:  collectWhy((content.why_items || []).length),

            trust_google: $('#trustGoogle').val().trim(),
            trust_items:  trustItems,
        };

        $.ajax({
            url:         API_BASE + 'save_rastreamento_content.php',
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
            url:         API_BASE + 'upload_rastreamento_image.php',
            method:      'POST',
            data:        fd,
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

    /* ---------- bullets: add / remove ---------- */
    $(document).on('click', '[data-bullets-target]', function () {
        var targetId = $(this).data('bullets-target');
        var max      = parseInt($(this).data('bullets-max'), 10) || 6;
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
