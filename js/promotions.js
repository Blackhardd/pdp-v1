jQuery(function($){
    $(function(){
        function pdp_init_promotions_slider(){
            if(window.matchMedia("(max-width: 800px)").matches) {
                $('.promotions').slick({
                    infinite: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    swipeToSlide: true,
                    arrows: false,
                    variableWidth: true
                });
            }
        }

        pdp_init_promotions_slider();

        $(window).resize(function(){
            pdp_init_promotions_slider();
        });


        /**
         *  Details Modal
         */

        $('.promotion').click(function(){
            let current_promotion = $(this).data('promotion');

            MicroModal.show('modal-promotions', {
                onShow: function(){
                    $('#modal-promotions .promotion-details').removeClass('active');
                    $('#modal-promotions .promotion-details[data-promotion="' + current_promotion + '"]').addClass('active');
                    $('#modal-promotions .promotion-form input[name="promotion"]').val(current_promotion);
                },
                disableScroll: true,
                awaitOpenAnimation: true,
                awaitCloseAnimation: true
            });
        });
    })
});