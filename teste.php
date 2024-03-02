<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changing Text Color</title>
    <style>
        /* Estilize o texto conforme desejado */
        #changing-text {
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Texto que será alterado -->
    <div id="changing-text">Texto que muda de cor!</div>

    <script>
        // Função para mudar a cor do texto em loop
        function changeTextColor() {
            // Obter o elemento de texto
            var textElement = document.getElementById("changing-text");
            
            // Array de cores
            var colors = ["red", "green", "blue", "orange", "purple", "yellow"];
            
            // Índice de cor inicial
            var index = 0;
            
            // Intervalo para mudar a cor a cada 1 segundo (1000 milissegundos)
            setInterval(function() {
                // Altera a cor do texto
                textElement.style.color = colors[index];
                
                // Incrementa o índice para a próxima cor
                index++;
                
                // Se o índice for maior que o número de cores, reinicie para 0
                if (index >= colors.length) {
                    index = 0;
                }
            }, 1000); // 1000 milissegundos = 1 segundo
        }

        // Chame a função para iniciar o loop de mudança de cor
        changeTextColor();
    </script>
</body>
</html>
