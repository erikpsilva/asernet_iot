(function () {
    'use strict';

    const isLocal = location.hostname === 'localhost' || location.hostname === '127.0.0.1';
    const API_BASE = isLocal ? '/asernet_iot/services/api' : '/services/api';

    const form    = document.getElementById('contactForm');
    const success = document.getElementById('contactSuccess');
    const errEl   = document.getElementById('cfError');
    const btn     = document.getElementById('cfSubmit');

    // Phone mask
    const telEl = document.getElementById('cfTel');
    if (telEl) {
        telEl.addEventListener('input', () => {
            let v = telEl.value.replace(/\D/g, '').substring(0, 11);
            if (v.length > 10)     v = v.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            else if (v.length > 6) v = v.replace(/(\d{2})(\d{4,5})(\d{0,4})/, '($1) $2-$3');
            else if (v.length > 2) v = v.replace(/(\d{2})(\d{0,5})/, '($1) $2');
            telEl.value = v;
        });
    }

    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const nome  = document.getElementById('cfNome').value.trim();
        const tel   = document.getElementById('cfTel').value.trim();
        const cidade = document.getElementById('cfCidade').value.trim();
        const checks = [...form.querySelectorAll('input[name="interesse[]"]:checked')].map(c => c.value);

        errEl.style.display = 'none';

        if (!nome) { showError('Informe seu nome.'); return; }
        if (tel.replace(/\D/g, '').length < 10) { showError('Informe um telefone válido com DDD.'); return; }

        btn.disabled = true;
        btn.textContent = 'Enviando…';

        try {
            const res  = await fetch(`${API_BASE}/contact/send_contact.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ nome, telefone: tel, cidade, interesses: checks }),
            });
            const data = await res.json();

            if (!data.ok) { showError(data.message || 'Erro ao enviar. Tente novamente.'); return; }

            form.style.display = 'none';
            success.style.display = '';
        } catch {
            showError('Erro ao enviar. Verifique sua conexão e tente novamente.');
        } finally {
            btn.disabled = false;
            btn.textContent = 'Quero falar com um consultor';
        }
    });

    function showError(msg) {
        errEl.textContent = msg;
        errEl.style.display = 'block';
    }
})();
