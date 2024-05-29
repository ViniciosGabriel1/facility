<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <title>Cadastro de Médico</title>
</head>

<body>
<header>
    <a href="index.php"><div class="logo"><strong>FacilityOdonto    <i class="fas fa-tooth"></i>
</strong></div></a><input type="checkbox" id="nav_check" hidden>
        <nav>
            <ul>
                <li>
                    <a href="#" class="active"><i class="fa fa-home"></i> <strong>Home</strong></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-search"></i> <strong>Sobre o Sistema</strong></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-calendar"></i> <strong>Contatos</strong></a>
                </li>
            </ul>
        </nav>
        <label for="nav_check" class="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </label>
    </header>
    <div id="show">
        <img class="img" src="img/login.svg" alt="Sua Imagem" width="400" height="400" style="margin-top: 12%;">

        <section class="signup-section">
            <h2>Cadastro de Médico</h2>

            <!-- Adicione os campos de e-mail, telefone, senha e foto ao formulário -->
            <form action="back/processa_cadastro_medico.php" id="cadastroForm" method="post" enctype="multipart/form-data" id="cadastroForm" class="cadastro-form">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" onblur="verificarDisponibilidadeEmail()" required>
                <div id="mensagemErro" class="mensagem-erro"></div>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>

                <label for="confirma_senha">Confirme a Senha:</label>
                <input type="password" id="confirma_senha" name="confirma_senha" onblur="verificarCoincidenciaSenhas()" required>
                <div id="mensagemErroSenha" style="color: red" class="mensagem-erro-senha"></div>

                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" required>

                <label for="especializacao">Especialização:</label>
                <select id="especializacao" name="especializacao" required>
                    <option value="Clinico Geral">Clínico Geral</option>
                    <option value="Dentista">Dentista</option>
                    <option value="Buco Maxilo">Buco Maxilo</option>
                    <option value="Cirurgiao">Cirurgião</option>
                </select>
                <br>
                <label for="foto">Foto:</label>
                <input type="file" id="foto" name="foto" accept="image/*" required>

                <button type="submit" class="cadastro-button">Cadastrar Médico</button>

                <br>
                <p class="cadastro-link">Já tem uma conta? <a href="index.php">Faça login</a></p>
            </form>
        </section>
    </div>
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
<div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    <script src="js/validaEmail.js"></script>
    <script src="js/validaSenha.js"></script>

</body>

</html>