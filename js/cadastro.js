$(document).ready(function() {
    $('#btnCadastrar').click(function() {
        var nome = $('#nome').val();
        var telefone = $('#telefone').val();
        var email = $('#email').val();
        var senha = $('#senha').val();
        var confirmaSenha = $('#confirma_senha').val();

        // Limpar mensagens de erro
        $('#emailErro, #senhaErro, #confirmaSenhaErro, #mensagemAviso').text('');

        // Validar e-mail
        if (!isValidEmail(email)) {
            $('#emailErro').text('Por favor, insira um e-mail válido.');
            return;
        }

        // Validar senha
        if (!isValidPassword(senha)) {
            $('#senhaErro').text('A senha deve conter pelo menos 6 caracteres.');
            return;
        }

        // Confirmar senha
        if (senha !== confirmaSenha) {
            $('#confirmaSenhaErro').text('As senhas não coincidem.');
            return;
        }

        // Enviar os dados via AJAX
        $.ajax({
            type: 'POST',
            url: 'back/processa_cadastro.php',
            data: {
                nome: nome,
                telefone: telefone,
                email: email,
                senha: senha,
                confirma_senha: confirmaSenha
            },
            success: function(response) {
                if (response.trim() === 'success') {
                    // Redireciona para a página de login
                    window.location.href = 'login.php';
                } else {
                    // Se não for sucesso, exibe a mensagem de erro
                    $('#mensagemAviso').text(response);
                }
            },
        });
    });

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function isValidPassword(password) {
        return password.length >= 6;
    }
});
