$(document).ready(function() {
    // Inicializar o Swiper
    var swiper = new Swiper('.mySwiper', {
        slidesPerView: 3,
        spaceBetween: 30,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 3
            }
        }
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
            }
             else {
                $(this).hide();
            }
        });

        // Ajustar o número de slides visíveis com base na quantidade de médicos
        swiper.params.slidesPerView = Math.min(numMedicos, 3);
        swiper.updateSlides();
        swiper.slideTo(0); // Retornar o carrossel à posição inicial

        // Configurar o carrossel para permitir ou não a navegação
        swiper.allowSlidePrev = numMedicos > 3;
        swiper.allowSlideNext = numMedicos > 3;

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
