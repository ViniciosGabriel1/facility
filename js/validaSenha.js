function verificarCoincidenciaSenhas() {
    var senha = document.getElementById("senha").value;
    var confirmaSenha = document.getElementById("confirma_senha").value;
    var mensagemErroSenha = document.getElementById("mensagemErroSenha");

    if (senha !== confirmaSenha) {
        mensagemErroSenha.textContent = "As senhas não coincidem.";
    } else {
        mensagemErroSenha.textContent = "";
    }
}