jQuery(document).ready(function($) {

    $('.custom-ajax-add-to-cart').on('submit', function(e) {
        e.preventDefault();

        var $form = $(this);
        var product_id = $form.find('button[name="add-to-cart"]').val();
        var quantity = $form.find('input[name="quantity"]').val();
        var data = {
            action: 'custom_ajax_add_to_cart',
            product_id: product_id,
            quantity: quantity
        };

        var allSelected = true;

        $form.find('select').each(function() {
            var value = $(this).val();
            if (!value) {
                allSelected = false;
                return false;
            }
            var name = $(this).attr('name');
            data[name] = value;
        });

        if (!allSelected) {
            $('.custom-cart-message').html('<p style="color:red;">Please select all options before adding to cart.</p>');
            return;
        }

        $('.custom-cart-message').html('');

        $.post(ajax_atc.ajax_url, data, function(response) {
            if (response.success) {
                $('.custom-cart-message').html('<p style="color:green;">Product added to cart!</p>');
               
                $form.find('select').val('').niceSelect('update');
                $form.find('input[name="quantity"]').val(1);

                $(document.body).trigger('wc_fragment_refresh');

                setTimeout(function() {
                    $('.custom-cart-message').fadeOut('slow', function() {
                        $(this).html('').show();
                    });
                }, 2000);
            } else {
                $('.custom-cart-message').html('<p style="color:red;">Could not add product to cart. Try again!</p>');

                setTimeout(function() {
                    $('.custom-cart-message').fadeOut('slow', function() {
                        $(this).html('').show();
                    });
                }, 2000);
            }
        });

    });

});