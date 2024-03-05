$(document).ready(function() {
    // Função para atualizar o carrossel com base no filtro de especialização
    function updateCarousel() {
        var especializacaoSelecionada = $('#filtro-especializacao').val();
        console.log(especializacaoSelecionada);
        var numMedicos = 0;
        console.log($(this).find('.profession').text());
        // Iterar sobre cada slide do carrossel
        $('.swiper-slide').each(function() {
            
            var especializacaoMedico = $(this).find('.profession').text();
            console.log(especializacaoMedico);
            
            // Verificar se a especialização do médico corresponde à opção selecionada ou se é 'todos'
            if (especializacaoSelecionada === 'todos' || especializacaoSelecionada === especializacaoMedico) {
                numMedicos++;
                $(this).show(); // Mostrar o slide
            } else {
                $(this).hide(); // Ocultar o slide
            }
        });
    }

    // Atualizar o carrossel quando o filtro de especialização for alterado
    $('#filtro-especializacao').change(function() {
        updateCarousel();
        
    });

    document.addEventListener("DOMContentLoaded", function() {
        var link = document.getElementById('scroll-link');
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Evita o comportamento padrão do link

            // Obtém o elemento alvo pelo ID
            var target = document.getElementById(this.getAttribute('href').substring(1));

            // Verifica se o elemento alvo existe
            if (target) {
                // Calcula a posição do elemento alvo em relação ao topo da página
                var targetPosition = target.getBoundingClientRect().top + window.scrollY;

                // Anima a rolagem suave até o elemento alvo
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });


});
