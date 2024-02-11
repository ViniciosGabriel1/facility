function verificarDisponibilidadeEmail() {
    var email = document.getElementById("email").value;

    // Fazer uma requisição assíncrona para verificar a disponibilidade do e-mail
    fetch('back/verifica_email.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'email=' + encodeURIComponent(email),
        })
        .then(response => response.json())
        .then(data => {
            // Manipular a resposta do servidor
            var mensagemErro = document.getElementById("mensagemErro");
            mensagemErro.textContent = data.mensagem; // Exibir mensagem do servidor

            // Remover a classe CSS "disponivel" e "erro" antes de adicionar a correta
            mensagemErro.classList.remove("disponivel", "erro");

            // Adicionar a classe CSS correta com base na disponibilidade
            mensagemErro.classList.add(data.disponivel ? "disponivel" : "erro");
        })
        .catch(error => {
            console.error('Erro na requisição:', error);
        });
}