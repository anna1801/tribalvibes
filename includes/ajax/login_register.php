<?php
// Login
add_action( 'wp_ajax_nopriv_custom_ajax_login', 'custom_ajax_login' );
function custom_ajax_login() {
    if ( ! isset( $_POST['woocommerce-login-nonce'] ) || 
         ! wp_verify_nonce( $_POST['woocommerce-login-nonce'], 'woocommerce-login' ) ) {
        wp_send_json_error();
    }
    do_action( 'woocommerce_login_post', $_POST['username'], $_POST['password'], new WP_Error() );
    $creds = array(
        'user_login'    => sanitize_text_field( $_POST['username'] ),
        'user_password' => $_POST['password'],
        'remember'      => ! empty( $_POST['rememberme'] ),
    );
    $user = wp_signon( $creds, false );
    if ( is_wp_error( $user ) ) {
        wc_add_notice( $user->get_error_message(), 'error' );
    }
    if ( wc_notice_count( 'error' ) > 0 ) {
        ob_start();
        wc_print_notices();
        $notices = ob_get_clean();
        wp_send_json_error( $notices );
    }
    wp_send_json_success();
}

// Register
add_action( 'wp_ajax_nopriv_custom_ajax_register', 'custom_ajax_register' );
function custom_ajax_register() {
    if ( ! isset( $_POST['woocommerce-register-nonce'] ) || 
         ! wp_verify_nonce( $_POST['woocommerce-register-nonce'], 'woocommerce-register' ) ) {
        wp_send_json_error();
    }
    $username = sanitize_user( $_POST['email'] );
    $email    = sanitize_email( $_POST['email'] );
    $password = $_POST['password'];
    $validation_error = new WP_Error();
    $validation_error = apply_filters(
        'woocommerce_registration_errors',
        $validation_error,
        $username,
        $email
    );
    if ( $validation_error->get_error_code() ) {
        foreach ( $validation_error->get_error_messages() as $message ) {
            wc_add_notice( $message, 'error' );
        }
        ob_start();
        wc_print_notices();
        $notices = ob_get_clean();
        wp_send_json_error( $notices );
    }
    $user_id = wc_create_new_customer( $email, $username, $password );

    if ( is_wp_error( $user_id ) ) {

        foreach ( $user_id->get_error_messages() as $message ) {
            wc_add_notice( $message, 'error' );
        }

        ob_start();
        wc_print_notices();
        $notices = ob_get_clean();
        wp_send_json_error( $notices );
    }
    update_user_meta( $user_id, 'full_name', sanitize_text_field($_POST['full_name']) );
    update_user_meta( $user_id, 'phone_number', sanitize_text_field($_POST['phone_number']) );
    wp_set_current_user( $user_id );
    wp_set_auth_cookie( $user_id );
    wp_send_json_success();
}

// J file
function ajax_login_register() {
    wp_enqueue_script('ajax-login_register', get_template_directory_uri() . '/includes/ajax/js/login_register.js', array('jquery'), null, true);
    wp_localize_script('ajax-login_register', 'wc_login_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'ajax_login_register');
?>