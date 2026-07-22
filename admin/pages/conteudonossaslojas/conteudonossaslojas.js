(function ($) {
    'use strict';

    var API_BASE = ADMIN_BASE + '/services/api/content/';
    var IMG_BASE = SITE_BASE + '/images/nossaslojas/';
    var storeSeq = 0;

    function escHtml(str) {
        return $('<div>').text(str || '').html();
    }

    function buildImgWidget(fieldId, filename) {
        var prevId = fieldId + '-prev';
        var emptyId = fieldId + '-empty';
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

    function buildStoreCard(store, uid) {
        return '<div class="adminConteudo__card" id="store-' + uid + '" data-uid="' + uid + '">' +
            '<div class="row">' +
            '<div class="col-md-9"><p class="formGroup__label adminConteudo__cardLabel" style="font-weight:600">Loja</p></div>' +
            '<div class="col-md-3" style="text-align:right"><button type="button" class="adminConteudo__removeBullet" data-remove-store="' + uid + '" title="Remover loja">&times;</button></div>' +
            '</div>' +
            '<div class="row">' +
            '<div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Nome da loja</label><input type="text" class="formGroup__input" id="store-' + uid + '-titulo" value="' + escHtml(store.titulo) + '" maxlength="80"></div></div>' +
            '<div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Endere&ccedil;o</label><input type="text" class="formGroup__input" id="store-' + uid + '-endereco" value="' + escHtml(store.endereco) + '" maxlength="150"></div></div>' +
            '<div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Cidade / Bairro</label><input type="text" class="formGroup__input" id="store-' + uid + '-cidade" value="' + escHtml(store.cidade) + '" maxlength="120"></div></div>' +
            '<div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Endere&ccedil;o para o Google Maps</label><input type="text" class="formGroup__input" id="store-' + uid + '-maps" value="' + escHtml(store.maps_query) + '" maxlength="180"></div></div>' +
            '<div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Hor&aacute;rio — linha 1</label><input type="text" class="formGroup__input" id="store-' + uid + '-h1" value="' + escHtml(store.horario1) + '" maxlength="60"></div></div>' +
            '<div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Hor&aacute;rio — linha 2</label><input type="text" class="formGroup__input" id="store-' + uid + '-h2" value="' + escHtml(store.horario2) + '" maxlength="60"></div></div>' +
            '<div class="col-md-6"><div class="formGroup__item"><label class="formGroup__label">Foto da fachada</label>' + buildImgWidget('store-' + uid + '-img', store.imagem) + '</div></div>' +
            '</div>' +
            '</div>';
    }

    function renderStores(stores) {
        var $c = $('#storesContainer').empty();
        storeSeq = 0;
        $.each(stores, function (i, store) {
            var uid = storeSeq++;
            $c.append(buildStoreCard(store, uid));
        });
    }

    function addStore() {
        var uid = storeSeq++;
        $('#storesContainer').append(buildStoreCard({ titulo: '', endereco: '', cidade: '', maps_query: '', horario1: 'Seg a Sex: 8h às 18h', horario2: 'Sáb: 8h às 12h', imagem: '' }, uid));
    }

    function collectStores() {
        var out = [];
        $('#storesContainer .adminConteudo__card').each(function () {
            var uid = $(this).data('uid');
            out.push({
                titulo: $('#store-' + uid + '-titulo').val().trim(),
                endereco: $('#store-' + uid + '-endereco').val().trim(),
                cidade: $('#store-' + uid + '-cidade').val().trim(),
                maps_query: $('#store-' + uid + '-maps').val().trim(),
                horario1: $('#store-' + uid + '-h1').val().trim(),
                horario2: $('#store-' + uid + '-h2').val().trim(),
                imagem: $('#store-' + uid + '-img').val().trim()
            });
        });
        return out;
    }

    function loadConteudo() {
        $.get(API_BASE + 'get_nossaslojas_content.php', function (res) {
            if (!res.ok) return;
            var c = res.content;

            $('#sectionTitulo').val(c.section_titulo);
            $('#sectionTexto').val(c.section_texto);

            renderStores(c.stores || []);

            $('#expansionTitulo').val(c.expansion_titulo);
            $('#expansionTituloDestaque').val(c.expansion_titulo_destaque);
            $('#expansionTexto').val(c.expansion_texto);

            $('#closingTitulo').val(c.closing_titulo);
            $('#closingTituloDestaque').val(c.closing_titulo_destaque);
            $('#closingTexto').val(c.closing_texto);
            $('#closingImgWidget').html(buildImgWidget('closingImagem', c.closing_imagem));
        });
    }

    function saveConteudo() {
        var body = {
            section_titulo: $('#sectionTitulo').val().trim(),
            section_texto: $('#sectionTexto').val().trim(),

            stores: collectStores(),

            expansion_titulo: $('#expansionTitulo').val().trim(),
            expansion_titulo_destaque: $('#expansionTituloDestaque').val().trim(),
            expansion_texto: $('#expansionTexto').val().trim(),

            closing_titulo: $('#closingTitulo').val().trim(),
            closing_titulo_destaque: $('#closingTituloDestaque').val().trim(),
            closing_texto: $('#closingTexto').val().trim(),
            closing_imagem: $('#closingImagem').val().trim()
        };

        $.ajax({
            url: API_BASE + 'save_nossaslojas_content.php',
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
            url: API_BASE + 'upload_nossaslojas_image.php',
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

    $('#btnAddStore').on('click', addStore);

    $(document).on('click', '[data-remove-store]', function () {
        $('#store-' + $(this).data('remove-store')).remove();
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
