<?php
defined( 'ABSPATH' ) || exit;
get_template_part('template/breadcrumb'); 
?>

<div class="checkout-page-wrapper section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="checkoutaccordion" id="checkOutAccordion">
                    <?php if ( ! is_user_logged_in() ) : ?>
                        <div class="card">
                            <h6>Returning Customer? 
                                <span data-bs-toggle="collapse" data-bs-target="#logInaccordion">Click Here To Login</span>
                            </h6>
                            <div id="logInaccordion" class="collapse" data-parent="#checkOutAccordion">
                                <div class="card-body">
                                    <p>If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to Billing & Shipping.</p>
                                    <div class="login-reg-form-wrap mt-20">
                                        <div class="row">
                                            <div class="col-lg-7 m-auto">
                                                <form method="post" class="woocommerce-form woocommerce-form-login login">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="single-input-item">
                                                                <input type="text" name="username" placeholder="Enter your Email" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="single-input-item">
                                                                <input type="password" name="password" placeholder="Enter your Password" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                                            <div class="remember-meta">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="rememberme" id="rememberMe" value="forever" />
                                                                    <label class="custom-control-label" for="rememberMe">Remember Me</label>
                                                                </div>
                                                            </div>
                                                            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="forget-pwd">Forget Password?</a>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <button type="submit" class="btn btn-sqr woocommerce-button" name="login" value="Login">Login</button>
                                                    </div>
                                                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="card">
                        <h6>Have A Coupon? <span data-bs-toggle="collapse" data-bs-target="#couponaccordion">Click
                                Here To Enter Your Code</span></h6>
                        <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                            <div class="card-body">
                                <div class="cart-update-option">
                                    <div class="apply-coupon-wrapper">
                                        <form class="d-block d-md-flex" method="post">
                                            <input type="text" name="coupon_code" class="input-text" placeholder="Enter Your Coupon Code" required />
                                            <button type="submit" class="btn btn-sqr" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">Apply Coupon</button>
                                            <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkout-billing-details-wrap">
                        <h5 class="checkout-title">Billing Details</h5>
                        <div class="billing-form-wrap">
                            <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
                            <div class="woocommerce-billing-fields">
                                <div class="row">
                                    <?php
                                    $checkout = WC()->checkout(); 
                                    foreach ( $checkout->get_checkout_fields( 'billing' ) as $key => $field ) :
                                        $col_class = in_array( $key, ['billing_first_name', 'billing_last_name'] ) ? 'col-md-6' : 'col-12';
                                    ?>
                                    <div class="<?php echo esc_attr( $col_class ); ?>">
                                        <div class="single-input-item">
                                            <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php if ( ! is_user_logged_in() ) : ?>
                                <div class="checkout-box-wrap">
                                    <div class="single-input-item">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="createaccount" value="1" id="create_pwd" />
                                            <label class="custom-control-label" for="create_pwd">Create an
                                                account?</label>
                                        </div>
                                    </div>
                                    <div class="account-create single-form-row">
                                        <p>Create an account by entering the information below. If you are a
                                            returning customer please login at the top of the page.</p>
                                        <div class="single-input-item">
                                            <?php do_action( 'woocommerce_checkout_registration_form_start' ); ?>
                                            <?php woocommerce_form_field( 'account_password', array(
                                                'type'        => 'password',
                                                'label'       => __( 'Account Password', 'woocommerce' ),
                                                'placeholder' => __( 'Account Password', 'woocommerce' ),
                                                'required'    => true,
                                            ), '' ); ?>
                                            <?php do_action( 'woocommerce_after_checkout_registration_form' ); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="checkout-box-wrap">
                                <div class="single-input-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="ship_to_different" name="ship_to_different" />
                                        <label class="custom-control-label" for="ship_to_different">Ship to a different address?</label>
                                    </div>
                                </div>
                                <div class="ship-to-different single-form-row">
                                    <div class="row">
                                        <?php
                                        foreach ( WC()->checkout->get_checkout_fields( 'shipping' ) as $key => $field ) :
                                            $col_class = ( in_array( $key, ['shipping_first_name', 'shipping_last_name'] ) ) ? 'col-md-6' : 'col-12';
                                            ?>
                                            <div class="<?php echo esc_attr( $col_class ); ?>">
                                                <div class="single-input-item">
                                                    <?php
                                                    woocommerce_form_field( $key, $field, WC()->checkout->get_value( $key ) );
                                                    ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="single-input-item">
                                <?php woocommerce_form_field( 'order_comments', array(
                                    'type'              => 'textarea',
                                    'class'             => array('form-row-wide'),
                                    'id'                => 'ordernote',
                                    'custom_attributes' => array(
                                        'cols'          => 30,
                                        'rows'          => 3,
                                    ),
                                    'label'             => __('Order Note', 'woocommerce'),
                                    'placeholder'       => __('Notes about your order, e.g. special notes for delivery.'),
                                ), $checkout->get_value( 'order_comments' )); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="order-summary-details">
                        <h5 class="checkout-title">Your Order Summary</h5>
                        <div class="order-summary-content">
                            <div class="order-summary-table table-responsive text-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Products</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                                            $_product = $cart_item['data'];
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo esc_url( $_product->get_permalink() ); ?>">
                                                    <?php echo esc_html( $_product->get_name() ); ?>
                                                    <strong> × <?php echo esc_html( $cart_item['quantity'] ); ?></strong>
                                                </a>
                                            </td>
                                            <td><?php echo wc_price( $cart_item['line_total'] ); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php
                                            if ( isset( $_GET['remove_coupon'] ) && ! empty( $_GET['remove_coupon'] ) ) {
                                                WC()->cart->remove_coupon( sanitize_text_field( $_GET['remove_coupon'] ) );
                                                wc_add_notice( sprintf( 'Coupon "%s" removed.', sanitize_text_field( $_GET['remove_coupon']) ), 'error' );
                                                WC()->cart->calculate_totals();
                                                wp_safe_redirect( remove_query_arg( 'remove_coupon' ) );
                                                exit;
                                            }
                                            if ( WC()->cart->get_applied_coupons() ) : ?>
                                            <?php foreach ( WC()->cart->get_applied_coupons() as $coupon_code ) : 
                                                $discount_amount = WC()->cart->get_coupon_discount_amount( $coupon_code );
                                            ?>
                                            <tr class="cart-discount">
                                                <td>
                                                    Coupon: <?php echo esc_html( $coupon_code ); ?>
                                                    <a href="<?php echo esc_url( add_query_arg( 'remove_coupon', $coupon_code ) ); ?>" style="color:red;">Remove</a>
                                                </td>
                                                <td>- <?php echo wc_price( $discount_amount ); ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Sub Total</td>
                                            <td><strong><?php echo WC()->cart->get_cart_subtotal(); ?></strong></td>
                                        </tr>
                                        <?php
                                            if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) :
                                                wc_cart_totals_shipping_html();
                                            endif;
                                        ?>
                                        <tr>
                                            <td>Total Amount</td>
                                            <td><strong><?php echo WC()->cart->get_total(); ?></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="order-payment-method">
                                <?php
                                $available_gateways = WC()->payment_gateways->get_available_payment_gateways();
                                if ( ! empty( $available_gateways ) ) :
                                    foreach ( $available_gateways as $gateway ) :
                                        ?>
                                        <div class="single-payment-method">
                                            <div class="payment-method-name">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="<?php echo esc_attr( $gateway->id ); ?>" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" class="custom-control-input" <?php checked( $gateway->chosen, true ); ?> />
                                                    <label class="custom-control-label" for="<?php echo esc_attr( $gateway->id ); ?>">
                                                        <?php echo esc_html( $gateway->get_title() ); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="payment-method-details" data-method="<?php echo esc_attr( $gateway->id ); ?>">
                                                <p><?php echo wp_kses_post( $gateway->get_description() ); ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                                <div class="summary-footer-area">
                                    <div class="custom-control custom-checkbox mb-20">
                                        <input type="checkbox" class="custom-control-input" id="terms" required />
                                        <label class="custom-control-label" for="terms">I have read and agree to
                                            the website <a href="terms-conditions.html">terms and conditions.</a></label>
                                    </div>
                                    <button type="submit" class="btn btn-sqr">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
            <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
        </form>
    </div>
</div>