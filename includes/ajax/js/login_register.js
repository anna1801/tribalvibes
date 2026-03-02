jQuery(function($){

    $('#woo_login_form form, #woo_register_form form').on('submit', function(e){
        e.preventDefault();

        var form = $(this);
        var formData = form.serialize();
        var action = form.hasClass('login') ? 'custom_ajax_login' : 'custom_ajax_register';

        $.ajax({
            type: 'POST',
            url: wc_login_params.ajax_url,
            data: formData + '&action=' + action,
            success: function(response){

                if(response.success){
                    location.reload();
                } else {
                    $('.woocommerce-notices-wrapper').html(response.data);
                }
            }
        });
    });

});