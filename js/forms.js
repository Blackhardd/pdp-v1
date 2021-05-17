jQuery(document).ready(function($){
    const regex_email = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    const regex_phone = /^\+?3?8?(0\d{9})$/;

    const input_selectors = 'input[type="text"],input[type="tel"],input[type="email"],select';

    $('.form').on('submit', function(){
        let is_form_valid = true;

        let $form = $(this);
        let $inputs = $form.find(input_selectors);

        $inputs.each(function(){
            let $field = $(this);
            let is_field_valid = validate_input($field);

            if(!is_field_valid && is_form_valid){
                is_form_valid = false;
            }
        });

        $inputs.on('input, change', function(){
            if($(this).is('input')){
                $(this).closest('.input').removeClass('error');
            }
            else if($(this).is('select')){
                $(this).closest('.select').removeClass('error');
            }
        });

        if(is_form_valid){
            submit_form($form);
        }

        return false;
    });

    function validate_input($input){
        switch($input.attr('name')){
            case 'name':
                return validate_required($input) && validate_name($input);
                break;
            case 'phone':
                return validate_required($input) && validate_phone($input);
                break;
            case 'email':
                return validate_required($input) && validate_email($input);
                break;
            case 'salon':
            case 'service':
            case 'gift_card':
            case 'course':
                return validate_required($input) && validate_select($input);
        }
    }

    function validate_required($input){
        if($input.prop('required') && !$input.val().length){
            input_error($input, 'Обязательное поле');
            return false;
        }

        return true;
    }

    function validate_name($input){
        if($input.val().length < 3){
            input_error($input, 'Должно быть больше 3-х символов');
            return false;
        }
        else if($input.val().length > 24){
            input_error($input, 'Должно быть меньше 25 символов');
            return false;
        }

        return true;
    }

    function validate_email($input){
        if(!regex_email.test($input.val())){
            input_error($input, 'Неверный формат');
            return false;
        }

        return true;
    }

    function validate_phone($input){
        if(!regex_phone.test($input.val())){
            input_error($input, 'Неверный формат');
            return false;
        }

        return true;
    }

    function validate_select($input){
        if(!$input.val()){
            input_error($input, 'Вы не выбрали опцию');
        }

        return true;
    }

    function input_error($input, error){
        let $input_wrap = null;

        if($input.is('input')){
            $input_wrap = $input.closest('.input');
            $input_wrap.find('.input__errors').text(error);
        }
        else if($input.is('select')){
            $input_wrap = $input.closest('.select');
            $input_wrap.find('.select__errors').text(error);
        }

        $input_wrap.addClass('error error-tooltip');

        setTimeout(function(){
            $input_wrap.removeClass('error-tooltip');
        }, 2000);
    }

    function submit_form($form){
        let form_data = new FormData($form[0]);

        $.ajax({
            method: 'POST',
            url: pdpData.ajaxurl,
            data: form_data,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $form.addClass('loading');
            },
            success: function(response){
                $form.removeClass('loading');
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
        });
    }
});