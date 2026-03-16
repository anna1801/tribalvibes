<?php
    defined( 'ABSPATH' ) || exit;

    $wishlist_items = $wishlist->get_items();

    if ( $wishlist_items ) : 
        wishlist_table($wishlist_items);
    else : 
        echo '<h3 class="text-center">Your wishlist is empty.</h3>';
endif;
?>