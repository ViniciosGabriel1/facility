$(document).ready(function() {
    // Função para atualizar o carrossel com base no filtro de especialização
    function updateCarousel(especializacaoSelecionada) {
        console.log(especializacaoSelecionada);
        var numMedicos = 0;

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

        // Após atualizar o carrossel, rolar até ele com uma animação suave
        var targetPosition = $('#carrossel').offset().top;
        $('html, body').animate({
            scrollTop: targetPosition
        }, 200); // 1000 é a duração da animação em milissegundos
    }

    // Atualizar o carrossel quando um botão de filtro é clicado
    $('.filtro-btn').click(function() {
        var especializacaoSelecionada = $(this).attr('data-especializacao');
        updateCarousel(especializacaoSelecionada);
    });

    document.addEventListener("DOMContentLoaded", function() {
        var link = document.getElementById('filtro-btn');
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
