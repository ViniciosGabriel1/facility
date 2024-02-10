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

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <label for="confirmar_senha">Confirmar Senha:</label>
        <input type="password" id="confirmar_senha" name="confirmar_senha" required>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" required>

        <label for="especializacao">Especialização:</label>
        <input type="text" id="especializacao" name="especializacao" required>

        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" accept="image/*" required>

        <!-- Campos para os serviços -->
        <h3>Serviços:</h3>
        <div id="servicosContainer">
            <!-- Conteúdo dinâmico será adicionado aqui -->
        </div>
<br>
        <button type="button" onclick="adicionarServico()">Adicionar Serviço</button>
        <br>
        <button type="submit">Cadastrar Médico</button>
    </form>

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

</body>

</html>
