jQuery(document).ready(function($){
    let parsley_base_config = {
        trigger: 'change',
        errorClass: 'inputWrap_error',
        successClass: 'inputWrap_success',
        classHandler: function(field){
            let input_wrapper = field.$element.closest('.inputWrap');

            if(input_wrapper.length > 0){
                return input_wrapper;
            }

            return field;
        },
        errorsContainer: function(field){
            let input_wrapper = field.$element.closest('.inputWrap');

            if(input_wrapper.length > 0){
                return input_wrapper.find('.inputWrap__errors');
            }

            return field;
        },
        errorsWrapper: '<ul class="form-errors"></ul>'
    };

    function pdp_form_submit($form){
        let data = new FormData($form[0]);

        $.ajax({
            method: 'POST',
            url: pdpData.ajaxurl,
            data: data,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $form.find('.backdrop').addClass('active');
            },
            success: function(response){
                $form.find('.backdrop').removeClass('active');
                let res = JSON.parse(response);

                if(res.status == true){
                    $form.trigger('reset');
                    $form.find('.form__response').addClass('active success');
                }
                else{
                    $form.find('.form__response').addClass('active error');
                }

                $form.find('.form__response').html(res.message);
            }
        })
    }

    if($('.form').length){
        $('.form').each(function(i, $el){
            $($el).parsley(parsley_base_config).on('form:submit', function(){
                pdp_form_submit($($el));
                return false;
            });
        });
    }

    if($('input[type="tel"]').length){
        $('input[type="tel"]').each(function(i, $el){
            IMask($el, {
                mask: '+{38} (000) 000 00 00'
            });
        });
    }
});