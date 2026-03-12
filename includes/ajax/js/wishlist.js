jQuery(document).ready(function($){

    function refreshWishlistCount() {
        $.post(myWishlistAjax.ajaxurl, { action: 'update_wishlist_count' }, function(response){
            if(response.success){
                $('.my-wishlist-count').text(response.data.count);
            }
        });
    }

    $('.yith-add-to-wishlist-button-block').each(function(){
        var $wrapper = $(this);
        var triggered = false;

        setInterval(function(){
            var $link = $wrapper.find('a');

            if($link.hasClass('yith-wcwl-add-to-wishlist-button--added') && !triggered){
                triggered = true;
                refreshWishlistCount();
            }

            if(!$link.hasClass('yith-wcwl-add-to-wishlist-button--added')){
                triggered = false;
            }

        }, 800);
    });

    $(document).on('added_to_wishlist removed_from_wishlist', function(){
        refreshWishlistCount();
    });

});