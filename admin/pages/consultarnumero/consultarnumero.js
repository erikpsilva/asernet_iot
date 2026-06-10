$(function () {
    var API = ADMIN_BASE_URL + '/services/api/campaign';

    function maskCpf(el) {
        $(el).on('input', function () {
            var v = $(this).val().replace(/\D/g, '').slice(0, 11);
            if (v.length > 9) v = v.replace(/(\d{3})(\d{3})(\d{3})(\d{0,2})/, '$1.$2.$3-$4');
            else if (v.length > 6) v = v.replace(/(\d{3})(\d{3})(\d{0,3})/, '$1.$2.$3');
            else if (v.length > 3) v = v.replace(/(\d{3})(\d{0,3})/, '$1.$2');
            $(this).val(v);
        });
    }

    maskCpf('#cpfAssinante');

    function tipoLabel(type) {
        if (type === 'signup') return 'Assinatura';
        if (type === 'referral') return 'Indicação';
        return type;
    }

    $('#consultarNumbers').on('click', function () {
        var cpf = $.trim($('#cpfAssinante').val());
        if (!cpf) { alert('Informe o CPF.'); return; }

        var $btn = $(this).prop('disabled', true).text('Consultando…');
        $('#resultsSection').hide();

        $.ajax({
            url: API + '/get_lucky_numbers_by_cpf.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ cpf: cpf }),
            success: function (res) {
                $btn.prop('disabled', false).text('Consultar');
                if (!res.ok) { alert(res.error || res.message || 'Nenhum registro encontrado.'); return; }

                $('#personName').text(res.person.name);

                var html = '';
                if (!res.numbersLucky || res.numbersLucky.length === 0) {
                    html = '<p class="consultNumerosPage__empty">Nenhum número cadastrado.</p>';
                } else {
                    res.numbersLucky.forEach(function (e) {
                        var d = new Date(e.date);
                        var dateBR = ('0' + d.getDate()).slice(-2) + '/' + ('0' + (d.getMonth() + 1)).slice(-2) + '/' + d.getFullYear() + ' ' + ('0' + d.getHours()).slice(-2) + ':' + ('0' + d.getMinutes()).slice(-2);
                        var indicadoHtml = (e.type === 'referral' && e.nomeIndicado)
                            ? '<span class="consultNumerosPage__indicado">→ ' + $('<span>').text(e.nomeIndicado).html() + '</span>'
                            : '';
                        html += '<div class="consultNumerosPage__item">' +
                                    '<span class="consultNumerosPage__number">' + e.number + '</span>' +
                                    '<div class="consultNumerosPage__typeWrap">' +
                                        '<span class="consultNumerosPage__type">' + tipoLabel(e.type) + '</span>' +
                                        indicadoHtml +
                                    '</div>' +
                                    '<span class="consultNumerosPage__date">' + dateBR + '</span>' +
                                '</div>';
                    });
                }

                $('#resultsList').html(html);
                $('#resultsSection').show();
            },
            error: function (xhr) {
                $btn.prop('disabled', false).text('Consultar');
                var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'CPF não encontrado.';
                alert(msg);
            }
        });
    });

    $('#cpfAssinante').on('keydown', function (e) {
        if (e.key === 'Enter') $('#consultarNumbers').trigger('click');
    });
});
