(function () {
    'use strict';

    const isLocal = location.hostname === 'localhost' || location.hostname === '127.0.0.1';
    const API_BASE = isLocal ? '/asernet_iot/services/api' : '/services/api';
    const WHATSAPP_NUMBER = '5508002225262';

    let clienteAtual = null;

    // ─── Modal ───────────────────────────────────────────────────────────

    const modal     = document.getElementById('modalParticipar');
    const openModal = () => {
        modal.classList.add('cruise-modal--open');
        document.body.style.overflow = 'hidden';
        resetModal();
    };
    const closeModal = () => {
        modal.classList.remove('cruise-modal--open');
        document.body.style.overflow = '';
    };
    const resetModal = () => {
        showStep('stepCpf');
        document.getElementById('inputCpfModal').value = '';
        clearErrors();
        clienteAtual = null;
    };
    const showStep = (stepId) => {
        ['stepCpf', 'stepSubscriber', 'stepNotSubscriber'].forEach(id => {
            document.getElementById(id).style.display = id === stepId ? '' : 'none';
        });
    };

    // ─── Masks ───────────────────────────────────────────────────────────

    const maskCpf = (el) => {
        el.addEventListener('input', () => {
            let v = el.value.replace(/\D/g, '').substring(0, 11);
            if (v.length > 9)      v = v.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            else if (v.length > 6) v = v.replace(/(\d{3})(\d{3})(\d{0,3})/, '$1.$2.$3');
            else if (v.length > 3) v = v.replace(/(\d{3})(\d{0,3})/, '$1.$2');
            el.value = v;
        });
    };

    const maskPhone = (el) => {
        el.addEventListener('input', () => {
            let v = el.value.replace(/\D/g, '').substring(0, 11);
            if (v.length > 10)     v = v.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            else if (v.length > 6) v = v.replace(/(\d{2})(\d{4,5})(\d{0,4})/, '($1) $2-$3');
            else if (v.length > 2) v = v.replace(/(\d{2})(\d{0,5})/, '($1) $2');
            el.value = v;
        });
    };

    // ─── Validation helpers ──────────────────────────────────────────────

    const clearErrors = () => {
        document.querySelectorAll('.cruise-modal__error').forEach(el => (el.textContent = ''));
        document.querySelectorAll('.cruise-modal__field').forEach(el => el.classList.remove('cruise-modal__field--error'));
    };

    const setError = (fieldId, errorId, msg) => {
        document.getElementById(errorId).textContent = msg;
        document.getElementById(fieldId).classList.add('cruise-modal__field--error');
        return false;
    };

    const digits = (str) => str.replace(/\D/g, '');

    // ─── API ─────────────────────────────────────────────────────────────

    const validateSubscriber = async (cpf) => {
        const res = await fetch(`${API_BASE}/ixc/validate_subscriber.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ cpf }),
        });
        if (!res.ok) throw new Error('Erro ao consultar. Tente novamente.');
        return res.json();
    };

    // ─── Handlers ────────────────────────────────────────────────────────

    const handleVerificarCpf = async () => {
        clearErrors();
        const cpf = digits(document.getElementById('inputCpfModal').value);

        if (cpf.length !== 11) {
            setError('fieldCpfModal', 'erroCpf', 'Informe um CPF válido com 11 dígitos.');
            return;
        }

        const btn = document.getElementById('btnVerificarCpf');
        btn.disabled = true;
        document.getElementById('btnVerificarTexto').style.display = 'none';
        document.getElementById('btnVerificarLoading').style.display = '';

        try {
            const data = await validateSubscriber(cpf);
            if (!data.ok) throw new Error(data.message || 'Erro ao consultar.');

            if (data.isSubscriber) {
                clienteAtual = data.client;
                document.getElementById('nomeCliente').textContent = data.client.name.split(' ')[0];
                showStep('stepSubscriber');
            } else {
                showStep('stepNotSubscriber');
            }
        } catch (err) {
            setError('fieldCpfModal', 'erroCpf', err.message || 'Erro ao consultar. Tente novamente.');
        } finally {
            btn.disabled = false;
            document.getElementById('btnVerificarTexto').style.display = '';
            document.getElementById('btnVerificarLoading').style.display = 'none';
        }
    };

    const handleIndicarWhatsApp = () => {
        clearErrors();
        let valid = true;

        const nome  = document.getElementById('inputNomeIndicado').value.trim();
        const email = document.getElementById('inputEmailIndicado').value.trim();
        const tel   = document.getElementById('inputTelIndicado').value.trim();

        if (!nome)
            valid = setError('fieldNomeIndicado', 'erroNomeIndicado', 'Informe o nome do amigo.');
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email))
            valid = setError('fieldEmailIndicado', 'erroEmailIndicado', 'Informe um e-mail válido.');
        if (digits(tel).length < 10)
            valid = setError('fieldTelIndicado', 'erroTelIndicado', 'Informe um telefone válido.');

        if (!valid) return;

        const linhas = [
            'Olá! Sou cliente AserNet e quero indicar um amigo para o sorteio do Cruzeiro.',
            '',
            '*Meus dados:*',
            `Nome: ${clienteAtual.name}`,
            `CPF: ${clienteAtual.cpf}`,
            '',
            '*Amigo que estou indicando:*',
            `Nome: ${nome}`,
            `E-mail: ${email}`,
            `Telefone: ${tel}`,
        ];

        window.open(
            `https://wa.me/${WHATSAPP_NUMBER}?text=${encodeURIComponent(linhas.join('\n'))}`,
            '_blank'
        );
    };

    // ─── Modal: Consultar números ─────────────────────────────────────────

    const modalConsultar      = document.getElementById('modalConsultarNumeros');
    const openModalConsultar  = () => {
        modalConsultar.classList.add('cruise-modal--open');
        document.body.style.overflow = 'hidden';
        resetModalConsultar();
    };
    const closeModalConsultar = () => {
        modalConsultar.classList.remove('cruise-modal--open');
        document.body.style.overflow = '';
    };
    const resetModalConsultar = () => {
        document.getElementById('consultStep1').style.display = '';
        document.getElementById('consultStep2').style.display = 'none';
        document.getElementById('inputCpfConsultar').value = '';
        document.getElementById('erroCpfConsultar').textContent = '';
        document.getElementById('fieldCpfConsultar').classList.remove('cruise-modal__field--error');
    };

    const tipoLabel = (type) => {
        if (type === 'signup') return 'Assinatura';
        if (type === 'referral') return 'Indicação';
        return type;
    };

    const handleBuscarNumeros = async () => {
        const cpf = digits(document.getElementById('inputCpfConsultar').value);
        document.getElementById('erroCpfConsultar').textContent = '';
        document.getElementById('fieldCpfConsultar').classList.remove('cruise-modal__field--error');

        if (cpf.length !== 11) {
            document.getElementById('erroCpfConsultar').textContent = 'Informe um CPF válido com 11 dígitos.';
            document.getElementById('fieldCpfConsultar').classList.add('cruise-modal__field--error');
            return;
        }

        const btn = document.getElementById('btnBuscarNumeros');
        btn.disabled = true;
        document.getElementById('btnBuscarTexto').style.display = 'none';
        document.getElementById('btnBuscarLoading').style.display = '';

        try {
            const res  = await fetch(`${API_BASE}/campaign/get_my_numbers.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ cpf }),
            });
            const data = await res.json();

            if (!data.ok) {
                document.getElementById('erroCpfConsultar').textContent = data.message || 'CPF não encontrado.';
                document.getElementById('fieldCpfConsultar').classList.add('cruise-modal__field--error');
                return;
            }

            document.getElementById('consultNome').textContent = data.name.split(' ')[0];
            document.getElementById('consultTotal').textContent =
                data.total === 1 ? 'Você tem 1 número da sorte cadastrado.' : `Você tem ${data.total} números da sorte cadastrados.`;

            const list = document.getElementById('consultList');
            if (!data.numbers || data.numbers.length === 0) {
                list.innerHTML = '<p style="color:#6b7fa8;font-size:13px;">Nenhum número encontrado.</p>';
            } else {
                list.innerHTML = data.numbers.map(n => {
                    const indicadoHtml = n.type === 'referral' && n.nomeIndicado
                        ? `<span>→ ${n.nomeIndicado}</span>`
                        : '';
                    return `<div class="cruise-modal__number-item">
                        <span class="cruise-modal__number-val">${n.number}</span>
                        <span class="cruise-modal__number-type">${tipoLabel(n.type)}</span>
                        <div class="cruise-modal__number-meta">
                            <span>${n.dateBR}</span>
                            ${indicadoHtml}
                        </div>
                    </div>`;
                }).join('');
            }

            document.getElementById('consultStep1').style.display = 'none';
            document.getElementById('consultStep2').style.display = '';
        } catch {
            document.getElementById('erroCpfConsultar').textContent = 'Erro ao consultar. Tente novamente.';
            document.getElementById('fieldCpfConsultar').classList.add('cruise-modal__field--error');
        } finally {
            btn.disabled = false;
            document.getElementById('btnBuscarTexto').style.display = '';
            document.getElementById('btnBuscarLoading').style.display = 'none';
        }
    };

    // ─── Modal: Regulamento ───────────────────────────────────────────────

    const modalReg      = document.getElementById('modalRegulamento');
    const openModalReg  = () => {
        modalReg.classList.add('cruise-modal--open');
        document.body.style.overflow = 'hidden';
    };
    const closeModalReg = () => {
        modalReg.classList.remove('cruise-modal--open');
        document.body.style.overflow = '';
    };

    // ─── Countdown ───────────────────────────────────────────────────────

    const updateCountdown = () => {
        const dateStr = (typeof SORTEIO_DATE !== 'undefined' && SORTEIO_DATE) ? SORTEIO_DATE : '2027-01-31T00:00:00-03:00';
        const target  = new Date(dateStr).getTime();
        const now    = Date.now();
        const diff   = Math.max(0, target - now);

        const days    = Math.floor(diff / 86400000);
        const hours   = Math.floor((diff % 86400000) / 3600000);
        const minutes = Math.floor((diff % 3600000) / 60000);
        const seconds = Math.floor((diff % 60000) / 1000);

        const els = document.querySelectorAll('.cruise-page__countdown strong');
        if (els.length === 4) {
            els[0].textContent = days;
            els[1].textContent = String(hours).padStart(2, '0');
            els[2].textContent = String(minutes).padStart(2, '0');
            els[3].textContent = String(seconds).padStart(2, '0');
        }
    };

    // ─── Init ─────────────────────────────────────────────────────────────

    document.addEventListener('DOMContentLoaded', () => {
        maskCpf(document.getElementById('inputCpfModal'));
        maskPhone(document.getElementById('inputTelIndicado'));

        document.getElementById('btnQueroParticipar').addEventListener('click', openModal);
        document.getElementById('btnFecharModal').addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

        document.getElementById('btnVerificarCpf').addEventListener('click', handleVerificarCpf);
        document.getElementById('inputCpfModal').addEventListener('keydown', (e) => {
            if (e.key === 'Enter') handleVerificarCpf();
        });

        document.getElementById('btnIndicarWhatsApp').addEventListener('click', handleIndicarWhatsApp);
        document.getElementById('btnVoltarStep1').addEventListener('click', resetModal);
        document.getElementById('btnVoltarStep1b').addEventListener('click', resetModal);

        // Modal regulamento
        document.getElementById('btnVerRegulamento').addEventListener('click', openModalReg);
        document.getElementById('btnFecharRegulamento').addEventListener('click', closeModalReg);
        modalReg.addEventListener('click', (e) => { if (e.target === modalReg) closeModalReg(); });

        // Modal consultar números
        maskCpf(document.getElementById('inputCpfConsultar'));
        document.getElementById('btnConsultarNumeros').addEventListener('click', openModalConsultar);
        document.getElementById('btnFecharConsultar').addEventListener('click', closeModalConsultar);
        modalConsultar.addEventListener('click', (e) => { if (e.target === modalConsultar) closeModalConsultar(); });
        document.getElementById('btnBuscarNumeros').addEventListener('click', handleBuscarNumeros);
        document.getElementById('inputCpfConsultar').addEventListener('keydown', (e) => {
            if (e.key === 'Enter') handleBuscarNumeros();
        });
        document.getElementById('btnVoltarConsultar').addEventListener('click', resetModalConsultar);

        updateCountdown();
        setInterval(updateCountdown, 1000);
    });

})();
