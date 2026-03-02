<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="login-register-wrapper section-padding">
	<div class="container">
		<div class="member-area-from-wrap">
			<div class="row">
				<div class="col-lg-6 m-auto">
					<div id="custom_login_register">
						<div class="login-reg-form-wrap" id="woo_login_form">
							<h5>Sign In</h5>
							<form class="woocommerce-form woocommerce-form-login login" method="post" novalidate>
								<?php do_action( 'woocommerce_login_form_start' ); ?>
								<div class="single-input-item">
									<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Email or Username" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) && is_string( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
								</div>
								<div class="single-input-item">
									<input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Enter your Password" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true" />
								</div>
								<?php do_action( 'woocommerce_login_form' ); ?>
								<div class="single-input-item">
									<div class="login-reg-form-meta d-flex align-items-center justify-content-between">
										<div class="remember-meta">
											<div class="custom-control custom-checkbox">
												<input class="woocommerce-form__input woocommerce-form__input-checkbox custom-control-input" name="rememberme" type="checkbox" id="rememberMe" value="forever">
												<label class="custom-control-label" for="rememberMe">Remember Me</label>
											</div>
										</div>
										<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="forget-pwd">Forget Password?</a>
									</div>
								</div>
								<div class="single-input-item">
									<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
									<button type="submit" class="btn btn-sqr woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
								</div>
								<?php do_action( 'woocommerce_login_form_end' ); ?>
								<div class="single-input-item form_redirect">
									<div class="form_redirect_head"><h6>New to Tribal Vibes?</h6></div>
									<div id="create_account" class="account_btn">Create Account</div>
								</div>
							</form>							
						</div>
						<div class="login-reg-form-wrap"  id="woo_register_form">
							<h5>Registeration Form</h5>
							<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
								<?php do_action( 'woocommerce_register_form_start' ); ?>
								<div class="single-input-item">
									<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" 
										name="full_name" id="reg_full_name" 
										value="<?php echo ( ! empty( $_POST['full_name'] ) ) ? esc_attr( wp_unslash( $_POST['full_name'] ) ) : ''; ?>" 
										required aria-required="true" placeholder="Full Name" />
								</div>
								<div class="single-input-item">
									<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" required aria-required="true" placeholder="Enter your Email" />
								</div>
								<div class="single-input-item">
									<input type="tel" class="woocommerce-Input woocommerce-Input--text input-text" 
										name="phone_number" id="reg_phone_number" 
										value="<?php echo ( ! empty( $_POST['phone_number'] ) ) ? esc_attr( wp_unslash( $_POST['phone_number'] ) ) : ''; ?>" 
										required aria-required="true" placeholder="Enter your Phone Number" />
								</div>
								<div class="single-input-item">
									<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" required aria-required="true" placeholder="Enter your Password" />
								</div>					
								<?php do_action( 'woocommerce_register_form' ); ?>
								<div class="single-input-item">
									<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
									<button type="submit" class="btn btn-sqr <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
								</div>
								<?php do_action( 'woocommerce_register_form_end' ); ?>
								<div class="single-input-item form_redirect">
									<div class="form_redirect_head"><h6>Already have an account?</h6></div>
									<div id="login_account" class="account_btn">Sign in</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>