$(function () {
    var API = ADMIN_BASE_URL + '/services/api/users';

    var nivelLabel = { admin: 'Admin', editor: 'Editor', cruzeiro: 'Cruzeiro', leitor: 'Leitor' };

    // ── Masks ─────────────────────────────────────────────────────────────
    function maskCpf(el) {
        $(el).on('input', function () {
            var v = $(this).val().replace(/\D/g, '').slice(0, 11);
            if (v.length > 9) v = v.replace(/(\d{3})(\d{3})(\d{3})(\d{0,2})/, '$1.$2.$3-$4');
            else if (v.length > 6) v = v.replace(/(\d{3})(\d{3})(\d{0,3})/, '$1.$2.$3');
            else if (v.length > 3) v = v.replace(/(\d{3})(\d{0,3})/, '$1.$2');
            $(this).val(v);
        });
    }
    maskCpf('#editCpf');

    // ── Modal helpers ─────────────────────────────────────────────────────
    function openModal(id) {
        $('#' + id).addClass('adminModal--open');
        $('body').css('overflow', 'hidden');
    }
    function closeModal(id) {
        $('#' + id).removeClass('adminModal--open');
        $('body').css('overflow', '');
    }

    $('#closeEditModal').on('click', function () { closeModal('modalEditUser'); });
    $('#modalEditUser').on('click', function (e) { if ($(e.target).is('#modalEditUser')) closeModal('modalEditUser'); });

    $('#closeDeleteModal, #cancelDeleteUser').on('click', function () { closeModal('modalDeleteUser'); });
    $('#modalDeleteUser').on('click', function (e) { if ($(e.target).is('#modalDeleteUser')) closeModal('modalDeleteUser'); });

    // ── Load users ────────────────────────────────────────────────────────
    function loadUsers() {
        $.ajax({
            url: API + '/get_users.php',
            method: 'GET',
            success: function (res) {
                if (!res.ok) { $('#usersTableWrap').html('<p class="adminUsers__empty adminUsers__empty--error">Erro ao carregar usuários.</p>'); return; }

                if (!res.users || res.users.length === 0) {
                    $('#usersTableWrap').html('<p class="adminUsers__empty">Nenhum usuário cadastrado.</p>');
                    return;
                }

                var rows = res.users.map(function (u) {
                    var isSelf = (u.id == SESSION_USER_ID);
                    return '<tr>' +
                        '<td class="adminUsers__td-name" data-label="Nome"><span>' + $('<span>').text(u.nome_completo).html() + '</span>' +
                            (isSelf ? '<span class="adminUsers__badge">Você</span>' : '') + '</td>' +
                        '<td class="adminUsers__td-level" data-label="Nível"><span class="adminUsers__nivel adminUsers__nivel--' + u.nivel_acesso + '">' + nivelLabel[u.nivel_acesso] + '</span></td>' +
                        '<td class="adminUsers__td-actions" data-label="Ações">' +
                            '<button class="adminUsers__btn adminUsers__btn--edit" data-id="' + u.id + '" data-nome="' + escAttr(u.nome_completo) + '" data-email="' + escAttr(u.email) + '" data-cpf="' + escAttr(u.cpf) + '" data-nivel="' + escAttr(u.nivel_acesso) + '" type="button">Editar</button>' +
                            '<button class="adminUsers__btn adminUsers__btn--delete" data-id="' + u.id + '" data-nome="' + escAttr(u.nome_completo) + '" type="button"' + (isSelf ? ' disabled title="Você não pode excluir sua própria conta"' : '') + '>Excluir</button>' +
                        '</td>' +
                    '</tr>';
                }).join('');

                $('#usersTableWrap').html(
                    '<table class="adminUsers__table">' +
                        '<thead><tr>' +
                            '<th>Nome</th><th>Nível</th><th></th>' +
                        '</tr></thead>' +
                        '<tbody>' + rows + '</tbody>' +
                    '</table>'
                );

                bindTableActions();
            },
            error: function () {
                $('#usersTableWrap').html('<p class="adminUsers__empty adminUsers__empty--error">Erro ao carregar usuários.</p>');
            }
        });
    }

    loadUsers();

    // ── Table button events ───────────────────────────────────────────────
    function bindTableActions() {
        // Edit
        $('.adminUsers__btn--edit').on('click', function () {
            var $b = $(this);
            $('#editUserId').val($b.data('id'));
            $('#editNome').val($b.data('nome'));
            $('#editEmail').val($b.data('email'));

            var rawCpf = String($b.data('cpf'));
            if (rawCpf.length === 11) rawCpf = rawCpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            $('#editCpf').val(rawCpf);

            $('#editNivel').val($b.data('nivel'));
            $('#editSenha, #editSenhaConfirm').val('');
            $('#editError').text('');
            openModal('modalEditUser');
        });

        // Delete
        $('.adminUsers__btn--delete').on('click', function () {
            var $b = $(this);
            $('#deleteUserId').val($b.data('id'));
            $('#deleteUserName').text($b.data('nome'));
            $('#deleteError').text('');
            openModal('modalDeleteUser');
        });
    }

    // ── Save edit ─────────────────────────────────────────────────────────
    $('#saveEditUser').on('click', function () {
        var senha        = $('#editSenha').val();
        var senhaConfirm = $('#editSenhaConfirm').val();

        if (senha !== '' && senha !== senhaConfirm) {
            $('#editError').text('As senhas não coincidem.');
            return;
        }
        if (senha !== '' && (senha.length < 6 || senha.length > 20)) {
            $('#editError').text('A nova senha deve ter entre 6 e 20 caracteres.');
            return;
        }

        var $btn = $(this).prop('disabled', true).text('Salvando…');
        $('#editError').text('');

        $.ajax({
            url: API + '/update_user.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                id:           parseInt($('#editUserId').val()),
                nome_completo: $.trim($('#editNome').val()),
                email:         $.trim($('#editEmail').val()),
                cpf:           $('#editCpf').val().replace(/\D/g, ''),
                nivel_acesso:  $('#editNivel').val(),
                nova_senha:    senha,
            }),
            success: function (res) {
                $btn.prop('disabled', false).text('Salvar alterações');
                if (!res.ok) { $('#editError').text(res.message || 'Erro ao salvar.'); return; }
                closeModal('modalEditUser');
                loadUsers();
            },
            error: function (xhr) {
                $btn.prop('disabled', false).text('Salvar alterações');
                var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Erro interno.';
                $('#editError').text(msg);
            }
        });
    });

    // ── Confirm delete ────────────────────────────────────────────────────
    $('#confirmDeleteUser').on('click', function () {
        var $btn = $(this).prop('disabled', true).text('Excluindo…');
        $('#deleteError').text('');

        $.ajax({
            url: API + '/delete_user.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ id: parseInt($('#deleteUserId').val()) }),
            success: function (res) {
                $btn.prop('disabled', false).text('Sim, excluir');
                if (!res.ok) { $('#deleteError').text(res.message || 'Erro ao excluir.'); return; }
                closeModal('modalDeleteUser');
                loadUsers();
            },
            error: function (xhr) {
                $btn.prop('disabled', false).text('Sim, excluir');
                var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Erro interno.';
                $('#deleteError').text(msg);
            }
        });
    });

    // ── Helpers ───────────────────────────────────────────────────────────
    function escAttr(str) {
        return String(str || '').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }
});
