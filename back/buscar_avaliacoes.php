<?php
// Arquivo: buscar_avaliacoes.php
echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous">';

// Incluir o arquivo de conexão com o banco de dados
include "conexao.php";

// Verificar se o parâmetro id_medico foi enviado na solicitação POST
if (isset($_POST['id_medico'])) {
    $id_medico = $_POST['id_medico'];

    // Consulta SQL para obter as avaliações do médico, juntamente com os dados do paciente
    $sql_avaliacoes = "SELECT a.estrelas, a.comentario, a.data_avaliacao, p.nome AS nome_paciente, p.foto AS foto_paciente
                       FROM avaliacoes a
                       INNER JOIN pacientes p ON a.id_paciente = p.id
                       WHERE a.id_medico = ?";
    $stmt_avaliacoes = $conn->prepare($sql_avaliacoes);
    $stmt_avaliacoes->bind_param("i", $id_medico);
    $stmt_avaliacoes->execute();
    $result_avaliacoes = $stmt_avaliacoes->get_result();

    $sql_media_avaliacoes = "SELECT AVG(estrelas) AS media_avaliacoes FROM avaliacoes WHERE id_medico = ?";
    $stmt_media_avaliacoes = $conn->prepare($sql_media_avaliacoes);
    $stmt_media_avaliacoes->bind_param("i", $id_medico);
    $stmt_media_avaliacoes->execute();
    $result_media_avaliacoes = $stmt_media_avaliacoes->get_result();
    $media_avaliacoes = $result_media_avaliacoes->fetch_assoc()["media_avaliacoes"];

    // Verificar se a média das avaliações foi obtida com sucesso
    if ($media_avaliacoes !== null) {
        // Exibir a média das avaliações
        echo "<h5><strong>Média das Avaliações: " . number_format($media_avaliacoes, 1) . " estrelas </strong> </h5>";
    } else {
        echo "<p>Nenhuma avaliação encontrada para este médico.</p>";
    }

    // Fechar a consulta
    $stmt_media_avaliacoes->close();

    // Construir o HTML com as avaliações
    $avaliacoes_html = "<ul>";

    while ($avaliacao = $result_avaliacoes->fetch_assoc()) {
        // Formatando a data da avaliação
        $data_avaliacao_formatada = date('d/m/Y', strtotime($avaliacao['data_avaliacao']));
        // Adicionando a avaliação ao HTML
        $avaliacoes_html .= "<li class='avaliacao-item'>";
        $avaliacoes_html .= "<img src='" . $avaliacao['foto_paciente'] . "' alt='Foto do Paciente' class='foto-paciente'>";
        $avaliacoes_html .= "<p><strong>Paciente:</strong> " . $avaliacao['nome_paciente'] . "</p>";
        $avaliacoes_html .= "<p><strong>Data da Avaliação:</strong> " . $data_avaliacao_formatada . "</p>";
        $avaliacoes_html .= "<p><strong>Classificação:</strong> ";
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $avaliacao['estrelas']) {
                $avaliacoes_html .= "<i class='fas fa-star' style= 'color:yellow;'></i>"; // Estrela preenchida
            } else {
                $avaliacoes_html .= "<i class='far fa-star'></i>"; // Estrela vazia
            }
        }
        $avaliacoes_html .= "</p>";
        $avaliacoes_html .= "<p class = 'coment'><strong>Comentário:</strong> " . $avaliacao['comentario'] . "</p>";
    
        $avaliacoes_html .= "</li>";
    }
    $avaliacoes_html .= "</ul>";
    

    // Enviar as avaliações como resposta
    echo $avaliacoes_html;

    // Fechar a consulta e a conexão com o banco de dados
    $stmt_avaliacoes->close();
    $conn->close();
} else {
    echo "ID do médico não fornecido.";
}
