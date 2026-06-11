$(document).ready(function () {
    var ADMIN = (typeof window.ADMIN_BASE !== 'undefined') ? window.ADMIN_BASE : '';
    var API_GET = ADMIN + '/services/api/content/get_faq_content.php';
    var API_SAVE = ADMIN + '/services/api/content/save_faq_content.php';

    var _cats = []; // original metadata (id, icone, card_modifiers)

    function escAttr(s) {
        return String(s || '').replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    }

    function escHtml(s) {
        return String(s || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    }

    function renderAll(content) {
        _cats = content.categorias || [];
        var $cards = $('#faqCards').empty();
        var $container = $('#faqCategorias').empty();

        $.each(_cats, function (ci, cat) {
            $cards.append(buildCardEditor(cat, ci));
            $container.append(buildCatPanel(cat, ci));
        });
    }

    function buildCardEditor(cat, ci) {
        return '<div class="col-md-6 col-lg-4">' +
            '<div class="adminFaq__cardEditor" id="faqCard-' + ci + '">' +
            '<div class="adminFaq__cardEditorHead">' +
            '<span class="adminFaq__catToggle__num">' + (ci + 1) + '</span>' +
            '<strong>' + escHtml(cat.titulo) + '</strong>' +
            '</div>' +
            '<div class="formGroup__item"><label class="formGroup__label">Titulo do card</label>' +
            '<input type="text" class="formGroup__input" data-cat="' + ci + '" data-card-field="titulo" value="' + escAttr(cat.titulo) + '" maxlength="80"></div>' +
            '<div class="formGroup__item"><label class="formGroup__label">Descricao do card</label>' +
            '<textarea class="formGroup__input adminFaq__cardDescription" data-cat="' + ci + '" data-card-field="descricao" rows="3" maxlength="200">' + escHtml(cat.descricao) + '</textarea></div>' +
            '</div>' +
            '</div>';
    }

    function buildCatPanel(cat, ci) {
        return '<div class="adminFaq__catPanel" id="faqCat-' + ci + '" ' +
            'data-cat-id="' + escAttr(cat.id) + '" ' +
            'data-cat-icone="' + escAttr(cat.icone) + '" ' +
            'data-cat-modifiers="' + escAttr(cat.card_modifiers || '') + '">' +
            '<details>' +
            '<summary class="adminFaq__catToggle">' +
            '<span class="adminFaq__catToggle__left">' +
            '<span class="adminFaq__catToggle__num">' + (ci + 1) + '</span>' +
            '<span class="adminFaq__catToggle__title">' + escHtml(cat.titulo) + '</span>' +
            '<span class="adminFaq__catToggle__count" id="faqCount-' + ci + '">' + (cat.perguntas ? cat.perguntas.length : 0) + ' perguntas</span>' +
            '</span>' +
            '<span class="adminFaq__catToggle__arrow">&rsaquo;</span>' +
            '</summary>' +
            '<div class="adminFaq__catBody">' +
            '<p class="adminFaq__perguntasLabel">Perguntas e respostas</p>' +
            '<div class="adminFaq__perguntasList" id="perguntas-' + ci + '">' +
            buildQuestionsHTML(cat.perguntas || [], ci) +
            '</div>' +
            '<button type="button" class="adminFaq__addBtn" data-cat="' + ci + '">+ Adicionar pergunta</button>' +
            '</div>' +
            '</details>' +
            '</div>';
    }

    function buildQuestionsHTML(perguntas, ci) {
        if (!perguntas.length) {
            return '<p class="adminFaq__empty" id="empty-' + ci + '">Nenhuma pergunta cadastrada.</p>';
        }

        var html = '';
        $.each(perguntas, function (qi, pq) {
            html += buildPqRow(pq, ci, qi);
        });
        return html;
    }

    function buildPqRow(pq, ci, qi) {
        return '<div class="adminFaq__pqRow" id="pq-' + ci + '-' + qi + '">' +
            '<div class="adminFaq__pqHead">' +
            '<span class="adminFaq__pqNum">' + (qi + 1) + '</span>' +
            '<button type="button" class="adminFaq__pqDel" data-cat="' + ci + '" data-qi="' + qi + '">Excluir</button>' +
            '</div>' +
            '<div class="formGroup__item"><label class="formGroup__label">Pergunta</label>' +
            '<input type="text" class="formGroup__input" data-cat="' + ci + '" data-qi="' + qi + '" data-pfield="q" ' +
            'value="' + escAttr(pq.q || '') + '" maxlength="200"></div>' +
            '<div class="formGroup__item"><label class="formGroup__label">Resposta</label>' +
            '<textarea class="formGroup__input adminFaq__resposta" data-cat="' + ci + '" data-qi="' + qi + '" data-pfield="a" ' +
            'rows="2" maxlength="600">' + escHtml(pq.a || '') + '</textarea></div>' +
            '</div>';
    }

    function renumber(ci) {
        var $rows = $('#perguntas-' + ci).find('.adminFaq__pqRow');

        if ($rows.length === 0) {
            $('#perguntas-' + ci).html('<p class="adminFaq__empty" id="empty-' + ci + '">Nenhuma pergunta cadastrada.</p>');
        } else {
            $rows.each(function (i) {
                $(this).attr('id', 'pq-' + ci + '-' + i);
                $(this).find('.adminFaq__pqNum').text(i + 1);
                $(this).find('[data-qi]').attr('data-qi', i);
            });
        }

        $('#faqCount-' + ci).text($rows.length + ' perguntas');
    }

    $(document).on('input', '[data-card-field="titulo"]', function () {
        var ci = $(this).data('cat');
        var title = $(this).val() || '-';

        $('#faqCat-' + ci).find('.adminFaq__catToggle__title').text(title);
        $('#faqCard-' + ci).find('.adminFaq__cardEditorHead strong').text(title);
    });

    $(document).on('click', '.adminFaq__addBtn', function () {
        var ci = $(this).data('cat');
        var $list = $('#perguntas-' + ci);
        $list.find('.adminFaq__empty').remove();

        var qi = $list.find('.adminFaq__pqRow').length;
        $list.append(buildPqRow({ q: '', a: '' }, ci, qi));
        $('#faqCount-' + ci).text((qi + 1) + ' perguntas');
        $list.find('#pq-' + ci + '-' + qi + ' input').first().focus();
    });

    $(document).on('click', '.adminFaq__pqDel', function () {
        var ci = $(this).data('cat');
        $(this).closest('.adminFaq__pqRow').remove();
        renumber(ci);
    });

    function collectData() {
        var cats = [];

        $.each(_cats, function (ci, orig) {
            var $card = $('#faqCard-' + ci);
            var titulo = $card.find('[data-card-field="titulo"]').val().trim();
            var descricao = $card.find('[data-card-field="descricao"]').val().trim();
            var perguntas = [];

            $('#perguntas-' + ci).find('.adminFaq__pqRow').each(function () {
                var q = $(this).find('[data-pfield="q"]').val().trim();
                var a = $(this).find('[data-pfield="a"]').val().trim();
                perguntas.push({ q: q, a: a });
            });

            cats.push({
                id: orig.id || $('#faqCat-' + ci).data('cat-id'),
                icone: orig.icone || $('#faqCat-' + ci).data('cat-icone'),
                card_modifiers: orig.card_modifiers !== undefined ? orig.card_modifiers : $('#faqCat-' + ci).data('cat-modifiers'),
                titulo: titulo,
                descricao: descricao,
                perguntas: perguntas,
            });
        });

        return { categorias: cats };
    }

    $('#btnSalvarFaq').on('click', function () {
        var $btn = $(this).prop('disabled', true).text('Salvando...');

        $.ajax({
            url: API_SAVE,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(collectData())
        }).done(function (res) {
            showMsg(res.message || 'Salvo!', res.ok ? 'success' : 'error');
        }).fail(function () {
            showMsg('Erro ao salvar. Tente novamente.', 'error');
        }).always(function () {
            $btn.prop('disabled', false).text('Salvar alteracoes');
        });
    });

    $.get(API_GET).done(function (res) {
        if (res.ok) {
            renderAll(res.content);
        } else {
            showMsg('Erro ao carregar conteudo.', 'error');
        }
    }).fail(function () {
        showMsg('Erro ao carregar conteudo.', 'error');
    });

    function showMsg(msg, type) {
        var $el = $('#faqMsg');
        $el.text(msg)
            .removeClass('adminFaq__msg--success adminFaq__msg--error')
            .addClass('adminFaq__msg--' + type)
            .show();
        $('html, body').animate({ scrollTop: $el.offset().top - 20 }, 200);
        setTimeout(function () { $el.fadeOut(); }, 5000);
    }
});
