(function () {
    'use strict';

    var selector = '.adminConteudo input[type="text"], .adminConteudo textarea, .adminMenu input[type="text"], .adminMenu textarea, .adminFaq input[type="text"], .adminFaq textarea';
    var editors = new Map();

    function isTextField(field) {
        if (field.disabled || field.readOnly || field.dataset.richTextIgnore !== undefined) return false;
        if (field.closest('.ql-container, .ql-toolbar, [contenteditable], .adminConteudo__imgWrap')) return false;
        var identity = (field.id + ' ' + field.name + ' ' + (field.dataset.cameraField || '')).toLowerCase();
        return !/(?:preco|price|valor|telefone|phone|whatsapp|email|url|href|slug|imagem|image|arquivo|filename|horario|time|cep|cpf|cnpj)/.test(identity);
    }

    function labelFor(field) {
        var label = field.id ? document.querySelector('label[for="' + CSS.escape(field.id) + '"]') : null;
        if (!label) label = field.closest('.formGroup__item, .adminMenu__field')?.querySelector('label');
        return label ? label.textContent.trim() : 'Texto';
    }

    function startsBold(field) {
        var name = (field.id + ' ' + field.name + ' ' + (field.dataset.cameraField || '') + ' ' + labelFor(field)).toLowerCase();
        return /(?:t[ií]tulo|title|destaque|chamada|assinatura|nome do plano|bot[aã]o|button|statement)/.test(name);
    }

    function render(editor, value) {
        editor.replaceChildren();
        var pattern = /\*\*([\s\S]+?)\*\*/g;
        var last = 0;
        var match;
        while ((match = pattern.exec(value)) !== null) {
            editor.append(document.createTextNode(value.slice(last, match.index)));
            var strong = document.createElement('strong');
            strong.textContent = match[1];
            editor.append(strong);
            last = pattern.lastIndex;
        }
        editor.append(document.createTextNode(value.slice(last)));
    }

    function serialize(editor) {
        function walk(node) {
            if (node.nodeType === Node.TEXT_NODE) return node.nodeValue;
            if (node.nodeType !== Node.ELEMENT_NODE) return '';
            if (node.tagName === 'BR') return '\n';
            var text = Array.from(node.childNodes, walk).join('');
            if (node.tagName === 'STRONG' || node.tagName === 'B') {
                return text.split('\n').map(function (line) { return line ? '**' + line + '**' : ''; }).join('\n');
            }
            if (node !== editor && /^(DIV|P)$/.test(node.tagName)) return text + '\n';
            return text;
        }
        return walk(editor).replace(/\n$/, '');
    }

    function mount(field) {
        if (editors.has(field) || !isTextField(field)) return;
        var label = labelFor(field);
        var box = document.createElement('div');
        box.className = 'adminInlineBold';
        if (field.tagName === 'TEXTAREA') box.classList.add('adminInlineBold--multiline');
        var toolbar = document.createElement('div');
        toolbar.className = 'adminInlineBold__toolbar';
        var button = document.createElement('button');
        button.type = 'button';
        button.className = 'adminInlineBold__button';
        button.innerHTML = '<strong>B</strong>';
        button.title = 'Negrito (Ctrl+B)';
        button.setAttribute('aria-label', 'Aplicar ou remover negrito no texto selecionado');
        var hint = document.createElement('span');
        hint.textContent = 'Selecione um trecho e clique em B';
        toolbar.append(button, hint);
        var editor = document.createElement('div');
        editor.className = 'adminInlineBold__editor';
        if (startsBold(field)) editor.classList.add('adminInlineBold__editor--heading');
        editor.contentEditable = 'true';
        editor.setAttribute('role', 'textbox');
        editor.setAttribute('aria-label', label);
        editor.setAttribute('aria-multiline', field.tagName === 'TEXTAREA' ? 'true' : 'false');
        editor.spellcheck = true;
        render(editor, field.value);
        box.append(toolbar, editor);
        field.classList.add('adminInlineBold__source');
        field.insertAdjacentElement('afterend', box);

        button.addEventListener('mousedown', function (event) { event.preventDefault(); });
        button.addEventListener('click', function () {
            editor.focus();
            document.execCommand('bold', false);
            editor.dispatchEvent(new Event('input', { bubbles: true }));
        });
        editor.addEventListener('input', function () {
            var value = serialize(editor);
            if (field.tagName === 'INPUT') value = value.replace(/\s*\n\s*/g, ' ');
            var visibleLength = value.replace(/\*\*/g, '').length;
            if (field.maxLength > 0 && visibleLength > field.maxLength) {
                render(editor, field.value);
                return;
            }
            field.value = value;
            field.dispatchEvent(new Event('input', { bubbles: true }));
        });
        editor.addEventListener('blur', function () { field.dispatchEvent(new Event('change', { bubbles: true })); });
        editor.addEventListener('paste', function (event) {
            event.preventDefault();
            var pasted = event.clipboardData.getData('text/plain');
            if (field.tagName === 'INPUT') pasted = pasted.replace(/\s*\n\s*/g, ' ');
            document.execCommand('insertText', false, pasted);
        });
        if (field.tagName === 'INPUT') editor.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') event.preventDefault();
        });
        field.addEventListener('focus', function () { editor.focus(); });
        editors.set(field, { editor: editor, value: field.value });
    }

    function refresh() {
        document.querySelectorAll(selector).forEach(mount);
        editors.forEach(function (state, field) {
            if (!field.isConnected) { editors.delete(field); return; }
            if (field.value !== state.value && document.activeElement !== state.editor) render(state.editor, field.value);
            state.value = field.value;
        });
    }

    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', refresh);
    else refresh();
    setInterval(refresh, 500);
})();
