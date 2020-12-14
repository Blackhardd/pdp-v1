jQuery(function($){
    $(function(){
        $('.vacancies__item-btn').click(function(){
            $('.vacancies__item, .vacancies__details-block').removeClass('active');
            $(this).parent().addClass('active');
            $('.vacancies__details-block[data-vacancy="' + $(this).data('vacancy') + '"]').addClass('active');
            $('.cv-form input[name="vacancy"]').val($(this).data('title'));
        });
    });
});