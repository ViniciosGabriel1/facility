$(document).ready(function() {
    // Função para atualizar o carrossel com base no filtro de especialização
    function updateCarousel() {
        var especializacaoSelecionada = $('#filtro-especializacao').val();
        var numMedicos = 0;

        // Iterar sobre cada slide do carrossel
        $('.swiper-slide').each(function() {
            var especializacaoMedico = $(this).find('.profession').text();
            
            // Verificar se a especialização do médico corresponde à opção selecionada ou se é 'todos'
            if (especializacaoSelecionada === 'todos' || especializacaoSelecionada === especializacaoMedico) {
                numMedicos++;
                $(this).show(); // Mostrar o slide
            } else {
                $(this).hide(); // Ocultar o slide
            }
        });

        // Atualizar o número de slides visíveis com base na quantidade de médicos
        swiper.params.slidesPerView = Math.min(numMedicos, 3);
        swiper.update(); // Atualizar o swiper para refletir as mudanças

        // Retornar o carrossel à posição inicial
        swiper.slideTo(0);

        // Configurar o carrossel para permitir ou não a navegação
        if (numMedicos <= 3) {
            swiper.allowSlidePrev = false;
            swiper.allowSlideNext = false;
        } else {
            swiper.allowSlidePrev = true;
            swiper.allowSlideNext = true;
        }
    }

    // Atualizar o carrossel quando o filtro de especialização for alterado
    $('#filtro-especializacao').change(function() {
        updateCarousel();
    });

    // Atualizar o carrossel na inicialização da página
    updateCarousel();
});
