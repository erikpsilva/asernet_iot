document.addEventListener('DOMContentLoaded', () => {
    const base = window.CAMERA_V2_ADMIN_BASE;
    const site = window.CAMERA_V2_SITE_BASE;
    const csrf = window.CAMERA_V2_CSRF;
    const fields = Array.from(document.querySelectorAll('[data-camera-field]'));
    const initialValues = new Map(fields.map(field => [field, field.value]));
    const saveButton = document.getElementById('cameraV2Save');
    const message = document.getElementById('cameraV2Message');
    const faqList = document.getElementById('cameraV2FaqList');
    const faqAdd = document.getElementById('cameraV2FaqAdd');

    function showMessage(text, type) {
        message.textContent = text;
        message.className = 'adminConteudo__msg adminConteudo__msg--' + type;
        message.style.display = 'block';
        message.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
    }

    function atPath(data, path) {
        return path.split('.').reduce((current, part) => current?.[part], data);
    }

    function numberFaqItems() {
        faqList.querySelectorAll('[data-camera-faq-item]').forEach((item, index) => {
            const question = item.querySelector('[data-camera-faq-question]');
            const editor = item.querySelector('[data-camera-faq-editor]');
            item.querySelector('[data-camera-faq-number]').textContent = 'Pergunta ' + (index + 1);
            question.id = 'camera-faq-question-' + index;
            editor.id = 'camera-faq-editor-' + index;
            item.querySelector('label[for^="camera-faq-question-"]').htmlFor = question.id;
            item.querySelector('label[for^="camera-faq-editor-"]').htmlFor = editor.id;
        });
    }

    function mountFaqEditor(item) {
        const element = item.querySelector('[data-camera-faq-editor]');
        item.cameraFaqQuill = new Quill(element, {
            theme: 'snow',
            placeholder: 'Escreva a resposta aqui...',
            modules: { toolbar: [
                ['bold', 'italic', 'underline'],
                [{ header: [3, false] }],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['link'],
                ['clean'],
            ] },
        });
        item.cameraFaqQuill.root.setAttribute('aria-label', 'Resposta da ' + item.querySelector('[data-camera-faq-number]').textContent.toLowerCase());
    }

    if (saveButton && !window.Quill) {
        showMessage('O editor de texto não carregou. Atualize a página para editar o FAQ.', 'error');
        saveButton.disabled = true;
        faqAdd.disabled = true;
    } else if (saveButton) {
        faqList.querySelectorAll('[data-camera-faq-item]').forEach(mountFaqEditor);
    }

    faqAdd?.addEventListener('click', () => {
        if (faqList.querySelectorAll('[data-camera-faq-item]').length >= 50) {
            showMessage('O limite é de 50 perguntas.', 'error');
            return;
        }
        const item = document.createElement('article');
        item.className = 'cameraV2Admin__faqItem';
        item.dataset.cameraFaqItem = '';
        item.innerHTML = '<div class="cameraV2Admin__faqItemHead"><span data-camera-faq-number></span>' +
            '<button class="cameraV2Admin__faqRemove" type="button" data-camera-faq-remove>Remover</button></div>' +
            '<label class="cameraV2Admin__faqLabel" for="camera-faq-question-new">Pergunta</label>' +
            '<textarea class="cameraV2Admin__faqQuestion" id="camera-faq-question-new" data-camera-faq-question rows="2" maxlength="4000"></textarea>' +
            '<label class="cameraV2Admin__faqLabel" for="camera-faq-editor-new">Resposta</label>' +
            '<div class="cameraV2Admin__faqEditor" id="camera-faq-editor-new" data-camera-faq-editor><p><br></p></div>';
        faqList.appendChild(item);
        numberFaqItems();
        mountFaqEditor(item);
        item.querySelector('[data-camera-faq-question]').focus();
    });

    faqList?.addEventListener('click', event => {
        if (!event.target.closest('[data-camera-faq-remove]')) return;
        event.target.closest('[data-camera-faq-item]').remove();
        numberFaqItems();
    });

    fetch(base + '/services/api/content/get_cameras_v2_content.php', { credentials: 'same-origin' })
        .then(response => response.json())
        .then(result => {
            if (!result.ok) throw new Error(result.message || 'Não foi possível carregar o conteúdo.');
            fields.forEach(field => {
                const value = atPath(result.content, field.dataset.cameraField);
                if (typeof value === 'string' && field.value === initialValues.get(field)) field.value = value;
            });
        })
        .catch(error => showMessage(error.message, 'error'));

    document.querySelectorAll('[data-camera-upload]').forEach(input => {
        input.addEventListener('change', async () => {
            const file = input.files?.[0];
            if (!file) return;
            const path = input.dataset.cameraUpload;
            const data = new FormData();
            data.append('image', file);
            input.disabled = true;
            try {
                const response = await fetch(base + '/services/api/content/upload_camera_v2_image.php', {
                    method: 'POST', credentials: 'same-origin', headers: { 'X-CSRF-Token': csrf }, body: data,
                });
                const result = await response.json();
                if (!result.ok) throw new Error(result.message || 'Falha no envio da imagem.');
                const field = fields.find(item => item.dataset.cameraField === path);
                field.value = result.filename;
                const preview = document.querySelector('[data-camera-preview="' + path + '"]');
                preview.src = site + '/images/camerasegurancav2/' + encodeURIComponent(result.filename) + '?v=' + Date.now();
                showMessage('Imagem enviada. Salve as alterações para aplicá-la à página.', 'success');
            } catch (error) {
                showMessage(error.message, 'error');
            } finally {
                input.disabled = false;
                input.value = '';
            }
        });
    });

    saveButton?.addEventListener('click', async () => {
        const payload = {};
        fields.forEach(field => { payload[field.dataset.cameraField] = field.value; });
        const faq = Array.from(faqList.querySelectorAll('[data-camera-faq-item]'), item => {
            const plain = item.cameraFaqQuill.getText().trim();
            return {
                question: item.querySelector('[data-camera-faq-question]').value.trim(),
                answers: [plain],
                answer_html: item.cameraFaqQuill.root.innerHTML,
            };
        });
        const invalidIndex = faq.findIndex(item => !item.question || !item.answers[0] || item.answers[0].length > 4000 || item.answer_html.length > 30000);
        if (invalidIndex !== -1) {
            showMessage('Preencha a pergunta e a resposta do item ' + (invalidIndex + 1) + ' (até 4.000 caracteres).', 'error');
            return;
        }
        saveButton.disabled = true;
        try {
            const response = await fetch(base + '/services/api/content/save_cameras_v2_content.php', {
                method: 'POST', credentials: 'same-origin',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': csrf },
                body: JSON.stringify({ fields: payload, faq }),
            });
            const result = await response.json();
            if (!result.ok) throw new Error(result.message || 'Falha ao salvar.');
            showMessage(result.message, 'success');
        } catch (error) {
            showMessage(error.message, 'error');
        } finally {
            saveButton.disabled = false;
        }
    });
});
