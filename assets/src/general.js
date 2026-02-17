// change add to cart button to tick after added ti cart
jQuery(document).ready(function($){
    $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button){
        if ($button) {
            var originalText = $button.html();
            $button
                .removeClass('loading')
                .addClass('added')
                .html('<i class="fa fa-check"></i>');
                setTimeout(function(){
                    $button
                        .removeClass('added')
                        .html(originalText);
                }, 2000);
        }
    });
});