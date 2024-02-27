$(document).ready(function() {
    $('#form-formacao').submit(function(event) {
        event.preventDefault(); // Impedir o envio padrão do formulário
        var formData = $(this).serialize(); // Obter os dados do formulário
        $.ajax({
            type: 'POST',
            url: '../back/processa_formacao.php', // Arquivo PHP para lidar com a requisição
            data: formData,
            success: function(response) {
                $('#mensagem').html(response); // Exibir a resposta do servidor na div "mensagem"
                $('#form-formacao')[0].reset(); // Limpar o formulário após adicionar a formação
            }
        });
    });
});
