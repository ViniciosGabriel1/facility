$(document).ready(function() {
    // Inicializar o Swiper
    var swiper = new Swiper('.mySwiper', {
        slidesPerView: 'auto', // Defina 'auto' para permitir que o Swiper ajuste dinamicamente o número de slides visíveis
        spaceBetween: 70, // Adicione um espaçamento entre os slides
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
    

    // Função para atualizar o carrossel com base no filtro
    function updateCarousel() {
        var especializacaoSelecionada = $('#filtro-especializacao').val();
        var numMedicos = 0;

        // Verificar cada slide do carrossel e contar os médicos correspondentes à especialização selecionada
        $('.swiper-slide').each(function() {
            var especializacaoMedico = $(this).find('.profession').text();
            
            if (especializacaoSelecionada === 'todos' || especializacaoSelecionada === especializacaoMedico) {
                numMedicos++;
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        // Ajustar o número de slides visíveis com base na quantidade de médicos
        console.log("Número de médicos antes do ajuste: " + numMedicos);
        swiper.params.slidesPerView = Math.min(numMedicos, 3);
        swiper.update(); // Atualizar o swiper para refletir as mudanças

        // Retornar o carrossel à posição inicial
        console.log("Retornando o carrossel à posição inicial");
        swiper.slideTo(-1);

        // Configurar o carrossel para permitir ou não a navegação
        if (numMedicos <= 3) {
            swiper.allowSlidePrev = false;
            swiper.allowSlideNext = false;
        } else {
            swiper.allowSlidePrev = true;
            swiper.allowSlideNext = true;
        }

        console.log("Número de médicos atualizado: " + numMedicos);
    }

    // Atualizar o carrossel quando o filtro for alterado
    $('#filtro-especializacao').change(function() {
        console.log("Filtro alterado: " + $(this).val());
        updateCarousel();
    });

    // Atualizar o carrossel na inicialização da página
    updateCarousel();
});
