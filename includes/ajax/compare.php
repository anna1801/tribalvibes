<?php
add_action('init', function() {
    if (!session_id()) {
        session_start();
    }
});

// add
add_action('wp_ajax_add_to_compare', 'add_to_compare');
add_action('wp_ajax_nopriv_add_to_compare', 'add_to_compare');
function add_to_compare() {
    if (!session_id()) {
        session_start();
    }
    $product_id = intval($_POST['product_id']);
    if (!isset($_SESSION['compare'])) {
        $_SESSION['compare'] = [];
    }

    if (!in_array($product_id, $_SESSION['compare'])) {
        $_SESSION['compare'][] = $product_id;
    }
    wp_send_json_success([
        'added' => !$already_added,
        'count' => count($_SESSION['compare'])
    ]);
}

// remove
add_action('wp_ajax_remove_from_compare', 'remove_from_compare');
add_action('wp_ajax_nopriv_remove_from_compare', 'remove_from_compare');
function remove_from_compare() {
    if (!session_id()) {
        session_start();
    }
    $product_id = intval($_POST['product_id']);
    if (isset($_SESSION['compare'])) {

        $_SESSION['compare'] = array_diff(
            $_SESSION['compare'],
            [$product_id]
        );

        $_SESSION['compare'] = array_values($_SESSION['compare']);
    }
    wp_send_json_success([
        'count' => count($_SESSION['compare'])
    ]);
}

function my_enqueue_compare_ajax() {
    wp_enqueue_script(
        'my-compare-ajax',
        get_stylesheet_directory_uri() . '/includes/ajax/js/compare.js',
        array('jquery'),
        '1.0',
        true
    );
    wp_localize_script(
        'my-compare-ajax',
        'myCompareAjax',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        )
    );
}
add_action('wp_enqueue_scripts', 'my_enqueue_compare_ajax');
?>