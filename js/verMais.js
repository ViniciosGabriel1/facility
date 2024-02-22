$(document).ready(function() {
    // Ao clicar no botão "Ver Mais"
    $('.ver-mais-btn').click(function() {
        var foto = $(this).data('foto');
        var nome = $(this).data('nome');
        var especializacao = $(this).data('especializacao');
        
        // Preenche os elementos do modal com as informações do médico
        $('#medico-foto').attr('src', foto);
        $('#medico-nome').text(nome);
        $('#medico-especializacao').text(especializacao);
        
        // Exibe o modal
        $('#modal').show();
    });

    // Ao clicar no botão Fechar (X), fecha o modal
    $('.close').click(function() {
        $('#modal').hide();
    });
});
