jQuery(function($){
    $(function(){
        $('[data-post-like]').click(function(){
            let post = $(this).data('post-like');
            let counter = $(this).parent().find('span');

            $.ajax({
                method: 'POST',
                url: pdp.ajaxurl,
                data: {
                    action: 'add_post_like',
                    post_id:   post
                },
                beforeSend: function(){
                    let likes = parseInt(counter.text());
                    counter.text(likes + 1);
                },
                success: function(data) {
                    let data_object = JSON.parse(data);
                }
            });
        });

        new ClipboardJS('.btn_copy');
    })
});