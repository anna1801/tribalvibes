<?php
add_action('wp_ajax_update_wishlist_count', 'my_update_wishlist_count');
add_action('wp_ajax_nopriv_update_wishlist_count', 'my_update_wishlist_count');

function my_update_wishlist_count() {
    if( function_exists('YITH_WCWL') ) {
        $count = YITH_WCWL()->count_products();
        wp_send_json_success(array('count' => $count));
    } else {
        wp_send_json_error();
    }
}

function my_enqueue_wishlist_ajax() {
    wp_enqueue_script(
        'my-wishlist-ajax',
        get_stylesheet_directory_uri() . '/includes/ajax/js/wishlist.js', 
        array('jquery'),
        '1.0',
        true
    );
    wp_localize_script(
        'my-wishlist-ajax',
        'myWishlistAjax',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        )
    );
}
add_action('wp_enqueue_scripts', 'my_enqueue_wishlist_ajax');
?>