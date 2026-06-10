$(function () {
    var API = ADMIN_BASE_URL + '/services/api/campaign';

    $.ajax({
        url: API + '/get_lucky_numbers.php',
        method: 'GET',
        success: function (res) {
            if (!res.ok || !res.data || res.data.length === 0) {
                $('#insertResult').html('<p class="bilhetesPage__empty">Nenhum bilhete cadastrado.</p>');
                return;
            }

            var html = '';
            res.data.forEach(function (e) {
                html += '<div class="bilhetesPage__ticket">' +
                            '<div class="bilhetesPage__ticketTop">' +
                                '<span class="bilhetesPage__ticketName">' + $('<span>').text(e.name).html() + '</span>' +
                            '</div>' +
                            '<div class="bilhetesPage__ticketNum">' + e.number + '</div>' +
                            '<div class="bilhetesPage__ticketDate">' + e.date + '</div>' +
                        '</div>';
            });

            $('#insertResult').html(html);
        },
        error: function () {
            $('#insertResult').html('<p class="bilhetesPage__empty bilhetesPage__empty--error">Erro ao carregar bilhetes.</p>');
        }
    });

    $('#downloadTickets').on('click', function () {
        window.print();
    });
});
