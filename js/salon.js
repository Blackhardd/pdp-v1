jQuery(function($){
    $(function(){
        $('.salon-carousel__slider').slick({
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            swipeToSlide: true,
            arrows: false,
            asNavFor: '.salon-carousel-nav__slider'
        });

        $('.salon-carousel-nav__slider').slick({
            centerMode: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            swipeToSlide: true,
            arrows: false,
            asNavFor: '.salon-carousel__slider'
        });

        $('.team-slider').slick({
            variableWidth: true,
            slidesToScroll: 1,
            swipeToSlide: true,
            arrows: false
        });

        $('.masterCard__btn').click(function(){
            if(!$('.master-details[data-master="' + $(this).data('master') + '"]').hasClass('active')){
                $('.master-details.active').removeClass('active');
                $('.master-details[data-master="' + $(this).data('master') + '"]').addClass('active');
            }
            else{
                $('.master-details.active').removeClass('active');
            }
        });
    })
});