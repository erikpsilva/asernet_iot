$(function () {
    var API    = ADMIN_BASE + '/services/api/content';

    // ── Helpers ────────────────────────────────────────────────────────────
    function esc(s)     { return $('<span>').text(String(s || '')).html(); }
    function escA(s)    { return String(s || '').replace(/"/g, '&quot;').replace(/'/g, '&#39;'); }
    function showMsg(msg, type) {
        var $el = $('#conteudoMsg');
        if (!msg) { $el.hide(); return; }
        $el.text(msg)
           .removeClass('adminConteudo__msg--success adminConteudo__msg--error')
           .addClass('adminConteudo__msg--' + type)
           .show();
    }
    function nomeFromPath(p) {
        if (!p) return 'Nenhum arquivo';
        return p.split('/').pop().replace(/_/g, ' ');
    }

    // ── Build HTML ─────────────────────────────────────────────────────────
    function buildDoc(doc) {
        var arquivo   = doc.arquivo   || '';
        var nome      = nomeFromPath(arquivo);
        var btnLabel  = arquivo ? 'Trocar PDF' : 'Fazer upload';
        return '<div class="crz-doc">' +
            '<div class="crz-doc__ord">' +
            '<button class="crz-btn-ord crz-doc-up"  type="button" title="Mover acima">↑</button>' +
            '<button class="crz-btn-ord crz-doc-down" type="button" title="Mover abaixo">↓</button>' +
            '</div>' +
            '<div class="crz-doc__fields">' +
            '<input type="text" class="formGroup__input crz-doc-titulo"    placeholder="Título do documento"   value="' + escA(doc.titulo)    + '">' +
            '<input type="text" class="formGroup__input crz-doc-subtitulo" placeholder="Subtítulo / descrição" value="' + escA(doc.subtitulo) + '">' +
            '</div>' +
            '<div class="crz-doc__file">' +
            '<span class="crz-doc-nome" title="' + escA(arquivo) + '">' + esc(nome) + '</span>' +
            '<label class="btn btn--gray crz-upload-label">' +
            '<input type="file" accept="application/pdf">' +
            btnLabel +
            '</label>' +
            '<input type="hidden" class="crz-doc-arquivo" value="' + escA(arquivo) + '">' +
            (arquivo ? '<a class="crz-doc-link" href="' + escA(SITE_BASE + '/' + arquivo) + '" target="_blank" rel="noopener">Abrir PDF</a>' : '') +
            '</div>' +
            '<button class="btn btn--danger crz-del-doc" type="button">Remover</button>' +
            '</div>';
    }

    function buildSecao(secao) {
        var docsHtml = '';
        if (secao.documentos && secao.documentos.length) {
            $.each(secao.documentos, function (i, d) { docsHtml += buildDoc(d); });
        } else {
            docsHtml = '<p class="crz-empty">Nenhum documento nesta seção.</p>';
        }
        return '<div class="crz-secao">' +
            '<div class="crz-secao__head">' +
            '<input type="text" class="crz-secao-titulo" placeholder="Título da seção" value="' + escA(secao.titulo) + '">' +
            '<div class="crz-secao__actions">' +
            '<button class="btn btn--gray crz-btn-ord crz-secao-up"   type="button" title="Mover seção acima">↑</button>' +
            '<button class="btn btn--gray crz-btn-ord crz-secao-down" type="button" title="Mover seção abaixo">↓</button>' +
            '<button class="btn btn--danger crz-del-secao"            type="button">Excluir seção</button>' +
            '</div>' +
            '</div>' +
            '<div class="crz-docs">' + docsHtml + '</div>' +
            '<div class="crz-secao__footer">' +
            '<button class="btn btn--gray crz-add-doc" type="button">+ Adicionar documento</button>' +
            '</div>' +
            '</div>';
    }

    function render(data) {
        var $ed = $('#contratosEditor').empty();
        if (!data.secoes || !data.secoes.length) {
            $ed.html('<p class="crz-empty-state">Nenhuma seção cadastrada. Clique em "Adicionar seção" para começar.</p>');
            return;
        }
        $.each(data.secoes, function (i, s) { $ed.append(buildSecao(s)); });

        if (!CONTRATOS_CAN_EDIT) {
            $ed.find('input, button').prop('disabled', true);
            $('#btnAddSecao').prop('disabled', true);
        }
    }

    // ── Load ───────────────────────────────────────────────────────────────
    $.get(API + '/get_contratos.php').done(function (res) {
        if (res.ok) render(res.data);
        else showMsg('Erro ao carregar dados.', 'error');
    }).fail(function () {
        showMsg('Erro de conexão ao carregar dados.', 'error');
    });

    // ── Add section ────────────────────────────────────────────────────────
    $('#btnAddSecao').on('click', function () {
        var $ed = $('#contratosEditor');
        if ($ed.find('p').length && !$ed.find('.crz-secao').length) $ed.empty();
        $ed.append(buildSecao({ titulo: '', documentos: [] }));
        $ed.find('.crz-secao:last .crz-secao-titulo').focus();
    });

    // ── Delete section ─────────────────────────────────────────────────────
    $(document).on('click', '.crz-del-secao', function () {
        if (!confirm('Excluir esta seção e todos os seus documentos?')) return;
        $(this).closest('.crz-secao').remove();
        if (!$('#contratosEditor .crz-secao').length) {
            $('#contratosEditor').html('<p class="crz-empty-state">Nenhuma seção cadastrada. Clique em "Adicionar seção" para começar.</p>');
        }
    });

    // ── Move section ───────────────────────────────────────────────────────
    $(document).on('click', '.crz-secao-up', function () {
        var $s = $(this).closest('.crz-secao'), $p = $s.prev('.crz-secao');
        if ($p.length) $s.insertBefore($p);
    });
    $(document).on('click', '.crz-secao-down', function () {
        var $s = $(this).closest('.crz-secao'), $n = $s.next('.crz-secao');
        if ($n.length) $s.insertAfter($n);
    });

    // ── Add document ───────────────────────────────────────────────────────
    $(document).on('click', '.crz-add-doc', function () {
        var $docs = $(this).closest('.crz-secao').find('.crz-docs');
        $docs.find('.crz-empty').remove();
        $docs.append(buildDoc({ titulo: '', subtitulo: '', arquivo: '' }));
    });

    // ── Delete document ────────────────────────────────────────────────────
    $(document).on('click', '.crz-del-doc', function () {
        var $docs = $(this).closest('.crz-docs');
        $(this).closest('.crz-doc').remove();
        if (!$docs.find('.crz-doc').length) {
            $docs.html('<p class="crz-empty">Nenhum documento nesta seção.</p>');
        }
    });

    // ── Move document ──────────────────────────────────────────────────────
    $(document).on('click', '.crz-doc-up', function () {
        var $d = $(this).closest('.crz-doc'), $p = $d.prev('.crz-doc');
        if ($p.length) $d.insertBefore($p);
    });
    $(document).on('click', '.crz-doc-down', function () {
        var $d = $(this).closest('.crz-doc'), $n = $d.next('.crz-doc');
        if ($n.length) $d.insertAfter($n);
    });

    // ── Upload PDF ─────────────────────────────────────────────────────────
    $(document).on('change', '.crz-upload-label input[type=file]', function () {
        var $input  = $(this);
        var file    = this.files[0];
        if (!file) return;
        if (file.type !== 'application/pdf') {
            showMsg('Somente arquivos PDF são aceitos.', 'error');
            return;
        }
        var $doc    = $input.closest('.crz-doc');
        var $label  = $input.closest('label');
        var $nome   = $doc.find('.crz-doc-nome');
        var $hidden = $doc.find('.crz-doc-arquivo');

        var origLabel = $label.text();
        $label.find('input[type=file]').detach();
        $label.text('Enviando…');

        var fd = new FormData();
        fd.append('pdf', file);
        $.ajax({
            url: API + '/upload_contrato_pdf.php',
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false
        }).done(function (res) {
            $label.html('<input type="file" accept="application/pdf">' + (res.ok ? 'Trocar PDF' : origLabel));
            if (res.ok) {
                $hidden.val(res.arquivo);
                $nome.text(res.nome).attr('title', res.arquivo);
                var $link = $doc.find('.crz-doc-link');
                var newHref = (typeof SITE_BASE !== 'undefined' ? SITE_BASE : '') + '/' + res.arquivo;
                if ($link.length) {
                    $link.attr('href', newHref);
                } else {
                    $doc.find('.crz-doc__file').append('<a class="crz-doc-link" href="' + newHref + '" target="_blank" rel="noopener">Abrir PDF</a>');
                }
                showMsg('PDF enviado com sucesso.', 'success');
            } else {
                showMsg(res.message || 'Erro ao enviar arquivo.', 'error');
            }
        }).fail(function () {
            $label.html('<input type="file" accept="application/pdf">' + origLabel);
            showMsg('Erro de conexão ao enviar arquivo.', 'error');
        });
    });

    // ── Collect data ───────────────────────────────────────────────────────
    function getData() {
        var secoes = [];
        $('#contratosEditor .crz-secao').each(function () {
            var $s   = $(this);
            var docs = [];
            $s.find('.crz-doc').each(function () {
                var $d      = $(this);
                var arquivo = $.trim($d.find('.crz-doc-arquivo').val());
                if (!arquivo) return;
                docs.push({
                    titulo:    $.trim($d.find('.crz-doc-titulo').val()),
                    subtitulo: $.trim($d.find('.crz-doc-subtitulo').val()),
                    arquivo:   arquivo,
                });
            });
            secoes.push({
                titulo:     $.trim($s.find('.crz-secao-titulo').val()),
                documentos: docs,
            });
        });
        return { secoes: secoes };
    }

    // ── Save ───────────────────────────────────────────────────────────────
    $('#btnSalvarConteudo').on('click', function () {
        showMsg('', '');
        var $btn = $(this).prop('disabled', true).text('Salvando…');
        $.ajax({
            url:         API + '/save_contratos.php',
            type:        'POST',
            contentType: 'application/json',
            data:        JSON.stringify(getData()),
        }).done(function (res) {
            $btn.prop('disabled', false).text('Salvar alterações');
            showMsg(res.message || (res.ok ? 'Salvo com sucesso.' : 'Erro ao salvar.'), res.ok ? 'success' : 'error');
        }).fail(function () {
            $btn.prop('disabled', false).text('Salvar alterações');
            showMsg('Erro de conexão ao salvar.', 'error');
        });
    });
});
