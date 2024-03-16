<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro.css">

    <title>Cadastro de Médico</title>
</head>

<body>

    <h2>Cadastro de Médico</h2>

    <!-- Adicione os campos de e-mail, telefone, senha e foto ao formulário -->
    <form action="back/processa_cadastro_medico.php" method="post" enctype="multipart/form-data" id="cadastroForm">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" onblur="verificarDisponibilidadeEmail()" required>
        <div id="mensagemErro"></div>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <label for="confirma_senha">Confirme a Senha:</label>
        <input type="password" id="confirma_senha" name="confirma_senha" onblur="verificarCoincidenciaSenhas()" required>
        <div id="mensagemErroSenha" style="color: red"></div>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" required>

        <label for="especializacao">Especialização:</label>
        <select id="especializacao" name="especializacao" required>
            <option value="Clinico Geral">Clínico Geral</option>
            <option value="Dentista">Dentista</option>
            <option value="Buco Maxilo">Buco Maxilo</option>
            <option value="Cirurgiao">Cirurgião</option>
        </select>

        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" accept="image/*" required>

        <!-- Campos para os serviços -->
        <h3>Serviços:</h3>
        <div id="servicosContainer">
            <!-- Conteúdo dinâmico será adicionado aqui -->
        </div>
        <br>
        <!-- <button type="button" onclick="adicionarServico()">Adicionar Serviço</button> -->
        <br>
        <button type="submit">Cadastrar Médico</button>

        <br>
        <p>Já tem uma conta? <a href="login.php">Faça login</a></p>

    </form>
    <!--
    <script>
        // Função para adicionar dinamicamente campos de serviço
        function adicionarServico() {
            const container = document.getElementById("servicosContainer");
            const novoCampo = document.createElement("div");
            novoCampo.classList.add("servicoContainer");
            

            novoCampo.innerHTML = `
                <input type="text" name="servicos[]" placeholder="Digite o serviço" class="servicoInput" required>
                <button type="button" onclick="removerServico(this)">Remover Serviço</button>
            `;

            container.appendChild(novoCampo);
        }

        // Função para remover o campo de serviço
        function removerServico(botao) {
            const container = document.getElementById("servicosContainer");
            container.removeChild(botao.parentNode);
        }
    </script>
    
-->
    <script src="js/validaEmail.js"></script>
    <script src="js/validaSenha.js"></script>

</body>

</html>