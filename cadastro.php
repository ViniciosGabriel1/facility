<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro.css">
    <title>Cadastro</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <style>
        /* Estilos para o modal */
        

        p,strong,li{
            color: white;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: dodgerblue;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* Estilo para esconder a caixa de seleção */
        .hidden {
            display: none;
        }
    </style>
    <?php include "menu_login.php"; ?>
    <br>
    <h2>Cadastre-se Já.</h2>
    <button onclick="goBack()">Voltar</button>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <div id="show">
        
    <div id="modalLGPD" class="modal">
        <div class="modal-content">
        <span class="close">&times;</span>

            <h2>Regulamento da LGPD</h2>
            <p><strong>Art. 1º</strong> Este regulamento tem por objetivo regulamentar a aplicação da Lei nº 13.709, de 14 de agosto de 2018, Lei Geral de Proteção de Dados Pessoais (LGPD), para agentes de tratamento de pequeno porte, com base nas competências previstas no art. 55-J, inciso XVIII, da referida Lei.</p>

            <p><strong>Parágrafo único.</strong> Este regulamento não se aplica ao tratamento de dados pessoais realizado por pessoa natural para fins exclusivamente particulares e não econômicos, bem como nas demais hipóteses previstas no art. 4º da LGPD.</p>

            <h2>CAPÍTULO II</h2>

            <h2>DAS DEFINIÇÕES</h2>

            <p><strong>Art. 2º</strong> Para efeitos deste regulamento são adotadas as seguintes definições:</p>

            <ol>
                <li><strong>agentes de tratamento de pequeno porte</strong>: microempresas, empresas de pequeno porte, startups, pessoas jurídicas de direito privado, inclusive sem fins lucrativos, nos termos da legislação vigente, bem como pessoas naturais e entes privados despersonalizados que realizam tratamento de dados pessoais, assumindo obrigações típicas de controlador ou de operador;</li>
                <li><strong>microempresas e empresas de pequeno porte</strong>: sociedade empresária, sociedade simples, sociedade limitada unipessoal, nos termos do art. 41 da Lei nº 14.195, de 26 de agosto de 2021, e o empresário a que se refere o art. 966 da Lei nº 10.406, de 10 de janeiro de 2002 (Código Civil), incluído o microempreendedor individual, devidamente registrados no Registro de Empresas Mercantis ou no Registro Civil de Pessoas Jurídicas, que se enquadre nos termos do art. 3º e 18-A, §1º da Lei Complementar nº 123, de 14 de dezembro de 2006;</li>
                <li><strong>startups</strong>: organizações empresariais ou societárias, nascentes ou em operação recente, cuja atuação caracteriza-se pela inovação aplicada a modelo de negócios ou a produtos ou serviços ofertados, que atendam aos critérios previstos no Capítulo II da Lei Complementar nº 182, de 1º de junho de 2021; e</li>
                <li><strong>zonas acessíveis ao público</strong>: espaços abertos ao público, como praças, centros comerciais, vias públicas, estações de ônibus, de metrô e de trem, aeroportos, portos, bibliotecas públicas, dentre outros.</li>
            </ol>

            <p><strong>Art. 3º</strong> Não poderão se beneficiar do tratamento jurídico diferenciado previsto neste Regulamento os agentes de tratamento de pequeno porte que:</p>

            <ol>
                <li>realizem tratamento de alto risco para os titulares, ressalvada a hipótese prevista no art. 8º;</li>
                <li>aufiram receita bruta superior ao limite estabelecido no art. 3º, II, da Lei Complementar nº 123, de 2006 ou, no caso de startups, no art. 4º, § 1º, I, da Lei Complementar nº 182, de 2021; ou</li>
                <li>pertençam a grupo econômico de fato ou de direito, cuja receita global ultrapasse os limites referidos no inciso II, conforme o caso.</li>
            </ol>

            <h2>CAPÍTULO III</h2>

            <h2>DO TRATAMENTO DE ALTO RISCO</h2>

            <p><strong>Art. 4º</strong> Para fins deste regulamento, e sem prejuízo do disposto no art. 16, será considerado de alto risco o tratamento de dados pessoais que atender cumulativamente a pelo menos um critério geral e um critério específico, dentre os a seguir indicados:</p>

            <ol>
                <li>critérios gerais:
                    <ol type="a">
                        <li>tratamento de dados pessoais em larga escala; ou</li>
                        <li>tratamento de dados pessoais que possa afetar significativamente interesses e direitos fundamentais dos titulares;</li>
                    </ol>
                </li>
                <li>critérios específicos:
                    <ol type="a">
                        <li>uso de tecnologias emergentes ou inovadoras;</li>
                        <li>vigilância ou controle de zonas acessíveis ao público;</li>
                        <li>decisões tomadas unicamente com base em tratamento automatizado de dados pessoais, inclusive aquelas destinadas a definir o perfil pessoal, profissional, de saúde, de consumo e de crédito ou os aspectos da personalidade do titular; ou</li>
                        <li>utilização de dados pessoais sensíveis ou de dados pessoais de crianças, de adolescentes e de idosos.</li>
                    </ol>
                </li>
            </ol>

            <p><strong>Art. 5º</strong> Caberá ao agente de tratamento de pequeno porte, quando solicitado pela ANPD, comprovar que se enquadra nas disposições do art. 2º e do art. 3º deste regulamento em até quinze dias.</p>

            <h2>TÍTULO II</h2>

            <h2>DO TRATAMENTO DE DADOS PESSOAIS PELOS AGENTES DE TRATAMENTO DE PEQUENO PORTE</h2>

            <h2>CAPÍTULO I</h2>

            <h2>DAS DISPOSIÇÕES GERAIS</h2>

            <p><strong>Art. 6º</strong> A dispensa ou flexibilização das obrigações dispostas neste regulamento não isenta os agentes de tratamento de pequeno porte do cumprimento dos demais dispositivos da LGPD, inclusive das bases legais e dos princípios, de outras disposições legais, regulamentares e contratuais relativas à proteção de dados pessoais, bem como direitos dos titulares.</p>

            <h2>CAPÍTULO II</h2>

            <h2>DAS OBRIGAÇÕES DO AGENTE DE TRATAMENTO DE PEQUENO PORTE</h2>

            <h3>Seção I</h3>

            <h3>Das obrigações relacionadas aos direitos do titular</h3>

            <p><strong>Art. 7º</strong> Os agentes de tratamento de pequeno porte devem disponibilizar informações sobre o tratamento de dados pessoais e atender às requisições dos titulares em conformidade com o disposto nos arts. 9º e 18 da LGPD, por meio:</p>

            <ol>
                <li>eletrônico;</li>
                <li>impresso; ou</li>
                <li>qualquer outro que assegure os direitos previstos na LGPD e o acesso facilitado às informações pelos titulares.</li>
            </ol>

            <p><strong>Art. 8º</strong> Fica facultado aos agentes de tratamento de pequeno porte, inclusive àqueles que realizem tratamento de alto risco, organizarem-se por meio de entidades de representação da atividade empresarial, por pessoas jurídicas ou por pessoas naturais para fins de negociação, mediação e conciliação de reclamações apresentadas por titulares de dados.</p>

            <h3>Seção II</h3>

            <h3>Do Registro das Atividades de Tratamento</h3>

            <p><strong>Art. 9º</strong> Os agentes de tratamento de pequeno porte podem cumprir a obrigação de elaboração e manutenção de registro das operações de tratamento de dados pessoais, constante do art. 37 da LGPD, de forma simplificada.</p>

            <p>Parágrafo único. A ANPD fornecerá modelo para o registro simplificado de que trata o caput.</p>

            <h3>Seção III</h3>

            <h3>Das Comunicações dos Incidentes de Segurança</h3>

            <p><strong>Art. 10.</strong> A ANPD disporá sobre flexibilização ou procedimento simplificado de comunicação de incidente de segurança para agentes de tratamento de pequeno porte, nos termos da regulamentação específica.</p>

            <h3>Seção IV</h3>

            <h3>Do Encarregado pelo Tratamento de Dados Pessoais</h3>

            <p><strong>Art. 11.</strong> Os agentes de tratamento de pequeno porte não são obrigados a indicar o encarregado pelo tratamento de dados pessoais exigido no art. 41 da LGPD.</p>

            <p>§ 1º O agente de tratamento de pequeno porte que não indicar um encarregado deve disponibilizar um canal de comunicação com o titular de dados para atender o disposto no art. 41, § 2º, I da LGPD.</p>

            <p>§ 2º A indicação de encarregado por parte dos agentes de tratamento de pequeno porte será considerada política de boas práticas e governança para fins do disposto no art. 52, §1º, IX da LGPD.</p>

            <h3>Seção V</h3>

            <h3>Da Segurança e das Boas Práticas</h3>

            <p><strong>Art. 12.</strong> Os agentes de tratamento de pequeno porte devem adotar medidas administrativas e técnicas essenciais e necessárias, com base em requisitos mínimos de segurança da informação para proteção dos dados pessoais, considerando, ainda, o nível de risco à privacidade dos titulares de dados e a realidade do agente de tratamento.</p>

            <p>Parágrafo único. O atendimento às recomendações e às boas práticas de prevenção e segurança divulgadas pela ANPD, inclusive por meio de guias orientativos, será considerado como observância ao disposto no art. 52, §1º, VIII da LGPD.</p>

            <p><strong>Art. 13.</strong> Os agentes de tratamento de pequeno porte podem estabelecer política simplificada de segurança da informação, que contemple requisitos essenciais e necessários para o tratamento de dados pessoais, com o objetivo de protegê-los de acessos não autorizados e de situações acidentais ou ilícitas de destruição, perda, alteração, comunicação ou qualquer forma de tratamento inadequado ou ilícito.</p>

            <p>§ 1º A política simplificada de segurança da informação deve levar em consideração os custos de implementação, bem como a estrutura, a escala e o volume das operações do agente de tratamento de pequeno porte.</p>

            <p>§ 2º A ANPD considerará a existência de política simplificada de segurança da informação para fins do disposto no art. 6º, X e no art. 52, §1º, VIII e IX da LGPD.</p>

            <h2>TÍTULO III</h2>

            <h2>DOS PRAZOS DIFERENCIADOS</h2>

            <p><strong>Art. 14.</strong> Aos agentes de tratamento de pequeno porte será concedido prazo em dobro:</p>

            <ol>
                <li>no atendimento das solicitações dos titulares referentes ao tratamento de seus dados pessoais, conforme previsto no art. 18, §§ 3º e 5º da LGPD, nos termos de regulamentação específica;</li>
                <li>na comunicação à ANPD e ao titular da ocorrência de incidente de segurança que possa acarretar risco ou dano relevante aos titulares, nos termos de regulamentação específica, exceto quando houver potencial comprometimento à integridade física ou moral dos titulares ou à segurança nacional, devendo, nesses casos, a comunicação atender aos prazos conferidos aos demais agentes de tratamento, conforme os termos da mencionada regulamentação;</li>
                <li>no fornecimento de declaração clara e completa, prevista no art. 19, II da LGPD;</li>
                <li>em relação aos prazos estabelecidos nos normativos próprios para a apresentação de informações, documentos, relatórios e registros solicitados pela ANPD a outros agentes de tratamento.</li>
            </ol>

            <p>Parágrafo único. Os prazos não dispostos neste regulamento para agentes de tratamento de pequeno porte serão determinados por regulamentação específica.</p>

            <p><strong>Art. 15.</strong> Os agentes de tratamento de pequeno porte podem fornecer a declaração simplificada de que trata o art. 19, I, da LGPD no prazo de até quinze dias, contados da data do requerimento do titular.</p>

            <h2>TÍTULO IV</h2>

            <h2>DISPOSIÇÕES FINAIS</h2>

            <p><strong>Art. 16.</strong> A ANPD poderá determinar ao agente de tratamento de pequeno porte o cumprimento das obrigações dispensadas ou flexibilizadas neste regulamento, considerando as circunstâncias relevantes da situação, tais como a natureza ou o volume das operações, bem como os riscos para os titulares.</p>
            <br><h2 for="concordo">Eu concordo com os termos da LGPD:</h2>
            <input type="checkbox" id="concordoLGPD">
            <button type="button" id="btnConfirmarCadastro">Confirmar</button>
        </div>
    </div>
        <img class="img" src="img/cadastro.svg" alt="Sua Imagem" width="400" height="400" style="margin-top: 12%;">

        <section class="signup-section">

            <h2>Cadastro</h2>
            <form id="cadastroForm" action="back/processa_cadastro.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" required>

                <p id="mensagemAviso" style="color: red;"></p>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
                <div id="emailErro" style="color: red;"></div>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
                <div id="senhaErro" style="color: red;"></div>

                <label for="confirma_senha">Confirme a Senha:</label>
                <input type="password" id="confirma_senha" name="confirma_senha" required>
                <div id="confirmaSenhaErro" style="color: red;"></div>
                <br>
                <!-- <div class="form-group">
                <label for="rg">RG:</label>
                <input type="text" id="rg" name="rg" required>
                <div id="rgErro" style="color: red;"></div>
            </div> -->

                <a class="abrirM" id="btnAbrirModal">Cadastrar</a><br>
                <p class="signup-link">Já tem uma conta? <a href="login.php">Entre aqui!</a></p>


            </form>
        </section>
    </div>

    <script>
    // JavaScript para o modal
    var modal = document.getElementById("modalLGPD");
    var btnAbrirModal = document.getElementById("btnAbrirModal");
    var btnConfirmarCadastro = document.getElementById("btnConfirmarCadastro");
    var concordoLGPD = document.getElementById("concordoLGPD");

    // Função para abrir o modal
    btnAbrirModal.onclick = function() {
        modal.style.display = "block";
    }

    // Função para fechar o modal quando o usuário clicar no botão 'X'
    modal.getElementsByClassName("close")[0].onclick = function() {
        modal.style.display = "none";
    }

    // Função para confirmar o cadastro
    btnConfirmarCadastro.onclick = function() {
        if (concordoLGPD.checked) {
            // Se o usuário concordou com o regulamento, envie o formulário de cadastro
            document.getElementById("cadastroForm").submit();
        } else {
            // Se o usuário não concordou, exiba uma mensagem de erro ou faça outra ação adequada
            alert("Você precisa concordar com o regulamento da LGPD para cadastrar.");
        }
    }
</script>
    <script src="js/cadastro.js"></script>

</body>

</html>