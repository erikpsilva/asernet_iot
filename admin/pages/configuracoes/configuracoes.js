$(function () {
    var API = ADMIN_BASE_URL + '/services/api/settings';

    // Load current settings
    $.ajax({
        url: API + '/get_settings.php',
        method: 'GET',
        success: function (res) {
            if (res.ok && res.settings) {
                $('#contactEmails').val(res.settings.contact_emails || '');
            }
        }
    });

    // Save
    $('#saveSettings').on('click', function () {
        var emails = $('#contactEmails').val();
        var $btn   = $(this).prop('disabled', true).text('Salvando…');
        var $fb    = $('#settingsFeedback').removeClass('is-success is-error').text('');

        $.ajax({
            url: API + '/save_settings.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ contact_emails: emails }),
            success: function (res) {
                $btn.prop('disabled', false).text('Salvar configurações');
                if (res.ok) {
                    $fb.addClass('is-success').text('Salvo com sucesso!');
                } else {
                    $fb.addClass('is-error').text(res.message || 'Erro ao salvar.');
                }
            },
            error: function (xhr) {
                $btn.prop('disabled', false).text('Salvar configurações');
                var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Erro interno.';
                $fb.addClass('is-error').text(msg);
            }
        });
    });
});
