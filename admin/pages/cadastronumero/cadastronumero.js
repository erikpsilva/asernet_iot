$(function () {
    var API = ADMIN_BASE_URL + '/services/api/campaign';

    // ---- CPF mask ----
    function maskCpf(el) {
        $(el).on('input', function () {
            var v = $(this).val().replace(/\D/g, '').slice(0, 11);
            if (v.length > 9) v = v.replace(/(\d{3})(\d{3})(\d{3})(\d{0,2})/, '$1.$2.$3-$4');
            else if (v.length > 6) v = v.replace(/(\d{3})(\d{3})(\d{0,3})/, '$1.$2.$3');
            else if (v.length > 3) v = v.replace(/(\d{3})(\d{0,3})/, '$1.$2');
            $(this).val(v);
        });
    }

    function maskPhone(el) {
        $(el).on('input', function () {
            var v = $(this).val().replace(/\D/g, '').slice(0, 11);
            if (v.length > 10) v = v.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            else if (v.length > 6) v = v.replace(/(\d{2})(\d{4,5})(\d{0,4})/, '($1) $2-$3');
            else if (v.length > 2) v = v.replace(/(\d{2})(\d{0,5})/, '($1) $2');
            else if (v.length > 0) v = '(' + v;
            $(this).val(v);
        });
    }

    maskCpf('#cpfInd'); maskCpf('#cpfNew'); maskCpf('#na_cpf');
    maskPhone('#phoneInd'); maskPhone('#phoneNew'); maskPhone('#na_tel');

    // ---- Tab switching ----
    $('.cadNumerosPage__tab').on('click', function () {
        var tab = $(this).data('tab');
        $('.cadNumerosPage__tab').removeClass('is-active');
        $(this).addClass('is-active');
        $('.cadNumerosPage__panel').removeClass('is-active');
        $('#panel-' + tab).addClass('is-active');
    });

    // ---- Copiar texto ----
    function copyText(text, $btn) {
        var restore = function () {
            setTimeout(function () { $btn.text('Copiar texto'); }, 1500);
        };

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(function () {
                $btn.text('Copiado!');
                restore();
            });
            return;
        }

        var $tmp = $('<textarea>').val(text).css({ position: 'fixed', top: '-9999px' }).appendTo('body');
        $tmp[0].select();
        document.execCommand('copy');
        $tmp.remove();
        $btn.text('Copiado!');
        restore();
    }

    function switchState(panel, state) {
        $('#' + panel + ' .cadNumerosPage__state').removeClass('is-active');
        $('#' + state).addClass('is-active');
    }

    // ---- Indicação + Novo Assinante ----
    $('#sendIndNew').on('click', function () {
        var name    = $.trim($('#nameInd').val());
        var phone   = $.trim($('#phoneInd').val());
        var email   = $.trim($('#emailInd').val());
        var cpf     = $.trim($('#cpfInd').val());
        var nameN   = $.trim($('#nameNew').val());
        var phoneN  = $.trim($('#phoneNew').val());
        var emailN  = $.trim($('#emailNew').val());
        var cpfN    = $.trim($('#cpfNew').val());

        if (!name || !email || !cpf || !nameN || !emailN || !cpfN) {
            alert('Preencha todos os campos obrigatórios (*).');
            return;
        }

        var $btn = $(this).prop('disabled', true).text('Enviando…');

        $.ajax({
            url: API + '/register_referral_pair.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                referrer: { name: name, phone: phone, email: email, cpf: cpf },
                referred: { name: nameN, phone: phoneN, email: emailN, cpf: cpfN }
            }),
            success: function (res) {
                if (!res.ok) { alert(res.message || 'Erro ao cadastrar.'); $btn.prop('disabled', false).text('Enviar'); return; }

                var numR = res.generated.referrer.number;
                var numN = res.generated.referred.number;

                $('#numIndicou').text(numR);
                $('#numNovoCliente').text(numN);

                var msgR = 'Parabéns, ' + name + '! Sua indicação foi registrada com sucesso 🎉\n\nSeu número da sorte para o Cruzeiro é: *' + numR + '*\n\nBoa sorte!';
                var msgN = 'Bem-vindo(a) à AserNet, ' + nameN + '! 🎉\n\nSeu número da sorte para o sorteio do Cruzeiro é: *' + numN + '*\n\nBoa sorte!';

                $('#msgIndicou').val(msgR);
                $('#msgNovoCliente').val(msgN);

                $('#copyIndicou').off('click').on('click', function () { copyText(msgR, $(this)); });
                $('#copyNovoCliente').off('click').on('click', function () { copyText(msgN, $(this)); });

                switchState('panel-indicacao', 'indicacao-success');
            },
            error: function (xhr) {
                var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Erro interno.';
                alert(msg);
                $btn.prop('disabled', false).text('Enviar');
            }
        });
    });

    $('#resetIndicacao').on('click', function () {
        $('#nameInd,#phoneInd,#emailInd,#cpfInd,#nameNew,#phoneNew,#emailNew,#cpfNew').val('');
        $('#sendIndNew').prop('disabled', false).text('Enviar');
        switchState('panel-indicacao', 'indicacao-form');
    });

    // ---- Só Novo Assinante ----
    $('#enviaSomenteNovoAssinante').on('click', function () {
        var nome  = $.trim($('#na_nome').val());
        var tel   = $.trim($('#na_tel').val());
        var email = $.trim($('#na_email').val());
        var cpf   = $.trim($('#na_cpf').val());

        if (!nome || !cpf) {
            alert('Nome e CPF são obrigatórios.');
            return;
        }

        var $btn = $(this).prop('disabled', true).text('Enviando…');

        $.ajax({
            url: API + '/add_lucky_number.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ name: nome, phone: tel, email: email, cpf: cpf, type: 'signup' }),
            success: function (res) {
                if (!res.ok) { alert(res.message || 'Erro ao cadastrar.'); $btn.prop('disabled', false).text('Enviar'); return; }

                var num = res.generated.number;
                $('#numSorteNovo').text(num);

                var msg = 'Bem-vindo(a) à AserNet, ' + nome + '! 🎉\n\nSeu número da sorte para o sorteio do Cruzeiro é: *' + num + '*\n\nBoa sorte!';
                $('#msgSorteNovo').val(msg);
                $('#copySorteNovo').off('click').on('click', function () { copyText(msg, $(this)); });

                switchState('panel-novo', 'novo-success');
            },
            error: function (xhr) {
                var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Erro interno.';
                alert(msg);
                $btn.prop('disabled', false).text('Enviar');
            }
        });
    });

    $('#resetNovo').on('click', function () {
        $('#na_nome,#na_tel,#na_email,#na_cpf').val('');
        $('#enviaSomenteNovoAssinante').prop('disabled', false).text('Enviar');
        switchState('panel-novo', 'novo-form');
    });
});
