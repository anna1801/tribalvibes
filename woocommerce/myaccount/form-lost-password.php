<?php
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );

if ( function_exists( 'woocommerce_output_all_notices' ) ) {
    woocommerce_output_all_notices();
}
?>

<div class="login-register-wrapper section-padding">
	<div class="container">
		<div class="member-area-from-wrap">
			<div class="row">
				<div class="col-lg-6 m-auto">
                    <div class="login-reg-form-wrap">
                        <h5>Forgot Password</h5>
                        <form method="post" class="woocommerce-ResetPassword lost_reset_password">
                            <div class="single-input-item">
                                <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" placeholder="Email or Username" required aria-required="true" required />
                            </div>
                            <div class="clear"></div>
                            <?php do_action( 'woocommerce_lostpassword_form' ); ?>
                            <div class="single-input-item">
                                <input type="hidden" name="wc_reset_password" value="true" />
                                <button type="submit" class="btn btn-sqr" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Send Link', 'woocommerce' ); ?></button>
                            </div>
                            <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
                            <div class="single-input-item form_redirect">
                                <div class="form_redirect_head"><h6>Back to Login?</h6></div> 
                                <a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>" class="account_btn">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_lost_password_form' ); ?>