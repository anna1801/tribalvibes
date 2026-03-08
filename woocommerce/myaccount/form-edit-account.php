<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook - woocommerce_before_edit_account_form.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_before_edit_account_form' );
?>

	<h5>Account Details</h5>

    <div class="account-details-form">

		<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

			<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

			<div class="row">
				<div class="col-lg-6">
					<div class="single-input-item">
						<label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="First Name" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" aria-required="true" />
					</div>
				</div>
				<div class="col-lg-6">
					<div class="single-input-item">
						<label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Last Name" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" aria-required="true" />
					</div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="single-input-item">
				<label for="account_display_name"><?php esc_html_e( 'Display name', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Display Name" name="account_display_name" id="account_display_name" aria-describedby="account_display_name_description" value="<?php echo esc_attr( $user->display_name ); ?>" aria-required="true" /> <span id="account_display_name_description"><em><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'woocommerce' ); ?></em></span>
			</div>
			<div class="clear"></div>

			<div class="single-input-item">
				<label for="account_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--email input-text" placeholder="Email Address" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" aria-required="true" />
			</div>

			<?php
				/**
				 * Hook where additional fields should be rendered.
				 *
				 * @since 8.7.0
				 */
				do_action( 'woocommerce_edit_account_form_fields' );
			?>

			<fieldset>
				<legend><?php esc_html_e( 'Password change', 'woocommerce' ); ?></legend>

				<div class="single-input-item">
					<label for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" placeholder="Current Password" name="password_current" id="password_current" autocomplete="current-password" />
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="single-input-item">
							<label for="password_1"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
							<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" placeholder="New Password" name="password_1" id="password_1" autocomplete="new-password" />
						</div>
					</div>
					<div class="col-lg-6">
						<div class="single-input-item">
							<label for="password_2"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></label>
							<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" placeholder="Confirm Password" name="password_2" id="password_2" autocomplete="new-password" />
						</div>
					</div>
				</div>
			</fieldset>
			<div class="clear"></div>

			<?php
				/**
				 * My Account edit account form.
				 *
				 * @since 2.6.0
				 */
				do_action( 'woocommerce_edit_account_form' );
			?>

			<div class="single-input-item">
				<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
				<button type="submit" class="btn btn-sqr woocommerce-Button" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
				<input type="hidden" name="action" value="save_account_details" />
			</div>

			<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
		</form>
	</div>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>