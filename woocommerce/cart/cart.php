<?php
/**
 * Custom WooCommerce Cart Table Template
 * Fully compatible with quantity update and remove
 */

defined( 'ABSPATH' ) || exit;

get_template_part('template/breadcrumb'); 

do_action( 'woocommerce_before_cart' );
?>
    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
        <?php do_action( 'woocommerce_before_cart_table' ); ?>
            <div class="cart-main-wrapper section-padding">
                <div class="container">
                    <div class="section-bg-color">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-table table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="pro-thumbnail">Thumbnail</th>
                                                <th class="pro-title">Product</th>
                                                <th class="pro-price">Price</th>
                                                <th class="pro-quantity">Quantity</th>
                                                <th class="pro-subtotal">Total</th>
                                                <th class="pro-remove">Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php do_action( 'woocommerce_before_cart_contents' ); ?>
                                            <?php 
                                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                                                    $_product   = $cart_item['data'];
                                                    $product_id = $cart_item['product_id'];
                                                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) :
                                                        $product_permalink = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
                                                        ?>
                                                        <tr class="woocommerce-cart-form__cart-item cart_item">
                                                            <?php
                                                                $thumbnail_id = $_product->get_image_id();
                                                                $featured_image_url = $thumbnail_id ? wp_get_attachment_url( $thumbnail_id ) : '';
                                                                if ( $featured_image_url ) {
                                                                    $img = $featured_image_url;
                                                                } else {
                                                                    $img = get_template_directory_uri().'/assets/images/placeholder.png';
                                                                }
                                                                echo '<td class="pro-thumbnail"><a href="'.$product_permalink.'"><img class="img-fluid" src="'.$img.'" alt="'.$_product->get_name().'" /></a></td>';
                                                            ?>
                                                            <td class="pro-title" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                                                <?php
                                                                    if ( ! $product_permalink ) {
                                                                        echo wp_kses_post( $_product->get_name() );
                                                                    } else {
                                                                        echo '<a href="' . esc_url( $product_permalink ) . '">' . wp_kses_post( $_product->get_name() ) . '</a>';
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td class="pro-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                                                <?php echo WC()->cart->get_product_price( $_product ); ?>
                                                            </td>
                                                            <td class="pro-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                                                    <?php
                                                                        if ( $_product->is_sold_individually() ) {
                                                                            echo '1';
                                                                            echo '<input type="hidden" name="cart[' . $cart_item_key . '][qty]" value="1" />';
                                                                        } else {
                                                                            woocommerce_quantity_input( array(
                                                                                'input_name'  => 'cart[' . $cart_item_key . '][qty]',
                                                                                'input_value' => $cart_item['quantity'],
                                                                                'max_value'   => $_product->get_max_purchase_quantity(),
                                                                                'min_value'   => '0',
                                                                                'input_class' => 'input-text qty text', // ✅ REQUIRED
                                                                            ), $_product, true );
                                                                        }
                                                                    ?>
                                                            </td>
                                                            <td class="pro-subtotal" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
                                                                <?php echo WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ); ?>
                                                            </td>
                                                            <td class="pro-remove">
                                                                <?php
                                                                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                                                        '<a href="%s" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-trash-o"></i></a>',
                                                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                                        __( 'Remove this item', 'woocommerce' ),
                                                                        esc_attr( $product_id ),
                                                                        esc_attr( $_product->get_sku() )
                                                                    ), $cart_item_key );
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php 
                                                    endif; 
                                                endforeach; 
                                            ?>
                                            <?php do_action( 'woocommerce_cart_contents' ); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="cart-update-option d-block d-md-flex justify-content-between">
                                    <?php if ( wc_coupons_enabled() ) : ?>
                                        <div class="apply-coupon-wrapper">
                                            <div class="form d-block d-md-flex">
                                                <input type="text"
                                                    name="coupon_code"
                                                    class="input-text"
                                                    id="coupon_code"
                                                    value=""
                                                    placeholder="<?php esc_attr_e( 'Enter your coupon code', 'woocommerce' ); ?>" />
                                                <button type="submit"
                                                    class="btn btn-sqr"
                                                    name="apply_coupon"
                                                    value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
                                                    <?php esc_html_e( 'Apply Coupon', 'woocommerce' ); ?>
                                                </button>
                                                <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="cart-update">
                                        <button type="submit" class="btn btn-sqr" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
                                            <?php esc_html_e( 'Update Cart', 'woocommerce' ); ?>
                                        </button>
                                        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                                    </div>
                                </div>
                                <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 ml-auto">
                                <div class="cart-calculator-wrapper">
                                    <div class="cart-calculate-items">
                                        <h6><?php esc_html_e( 'Cart Totals', 'woocommerce' ); ?></h6>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <td><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></td>
                                                    <td><?php wc_cart_totals_subtotal_html(); ?></td>
                                                </tr>
                                                <?php if ( wc_coupons_enabled() && WC()->cart->get_coupons() ) : ?>
                                                    <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                                                        <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                                                            <td>
                                                                <?php wc_cart_totals_coupon_label( $coupon ); ?>
                                                            </td>
                                                            <td>
                                                                <?php wc_cart_totals_coupon_html( $coupon ); ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                                                    <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
                                                    <?php wc_cart_totals_shipping_html(); ?>
                                                    <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
                                                <?php endif; ?>
                                                <tr class="order-total total">
                                                    <td><?php esc_html_e( 'Total', 'woocommerce' ); ?></td>
                                                    <td class="total-amount">
                                                        <?php wc_cart_totals_order_total_html(); ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-sqr d-block">
                                        <?php esc_html_e( 'Proceed to Checkout', 'woocommerce' ); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php do_action( 'woocommerce_after_cart_table' ); ?>
    </form>

<?php do_action( 'woocommerce_after_cart' ); ?>