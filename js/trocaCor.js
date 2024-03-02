  // Função para mudar a cor do texto em loop
  function changeTextColor() {
    // Obter o elemento de texto
    var textElement = document.getElementById("changing-text");
    
    // Array de cores
    var colors = ["hsl(199deg 86% 78% / 73%)", "dodgerblue", "#28B6F6"];
    
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