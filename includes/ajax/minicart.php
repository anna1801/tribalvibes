<div class="woocommerce-minicart-fragments">
    <?php if ( WC()->cart && ! WC()->cart->is_empty() ) : ?>
        <div class="minicart-content-box">
            <div class="minicart-item-wrapper">
                <ul>
                    <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                        $product   = $cart_item['data'];
                        $product_id = $cart_item['product_id'];
                        if ( $product && $product->exists() && $cart_item['quantity'] > 0 ) :
                            $product_name  = $product->get_name();
                            $thumbnail_id  = $product->get_image_id();
                            $thumbnail_url = wp_get_attachment_image_url( $thumbnail_id, 'full' );
                            $product_price = WC()->cart->get_product_price( $product );
                            $product_link  = $product->is_visible() ? $product->get_permalink( $cart_item ) : '';
                            ?>
                            <li class="minicart-item">
                                <div class="minicart-thumb">
                                    <a href="<?php echo esc_url( $product_link ); ?>">
                                        <img src="<?php echo $thumbnail_url; ?>" alt="<?php echo esc_html( $product_name ); ?>">
                                    </a>
                                </div>
                                <div class="minicart-content">
                                    <h3 class="product-name">
                                        <a href="<?php echo esc_url( $product_link ); ?>">
                                            <?php echo esc_html( $product_name ); ?>
                                        </a>
                                    </h3>
                                    <p>
                                        <span class="cart-quantity">
                                            <?php echo esc_html( $cart_item['quantity'] ); ?> <strong>&times;</strong>
                                        </span>
                                        <span class="cart-price"><?php echo $product_price; ?></span>
                                    </p>
                                </div>
                                <a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>"
                                    class="minicart-remove remove"
                                    aria-label="<?php esc_attr_e( 'Remove this item', 'woocommerce' ); ?>"
                                    data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>"
                                    data-product_id="<?php echo esc_attr( $product_id ); ?>"
                                    data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>">
                                    <i class="pe-7s-close"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="minicart-pricing-box">
                <ul>
                    <li>
                        <span>sub-total</span>
                        <span>
                            <strong><?php echo WC()->cart->get_cart_subtotal(); ?></strong>
                        </span>
                    </li>
                    <li>
                        <span>Shipping</span>
                        <span>
                            <strong>
                                <?php 
                                    $shipping_total = WC()->cart->get_shipping_total();
                                    echo wc_price( $shipping_total );
                                ?>
                            </strong>
                        </span>
                    </li>
                    <li class="total">
                        <span>total</span>
                        <span>
                            <strong><?php echo WC()->cart->get_total(); ?></strong>
                        </span>
                    </li>
                </ul>
            </div>
            <?php
                $cart_url     = wc_get_cart_url();
                $checkout_url = wc_get_checkout_url();
            ?>
            <div class="minicart-button">
                <a href="<?php echo $cart_url; ?>"><i class="fa fa-shopping-cart"></i> View Cart</a>
                <a href="<?php echo $checkout_url; ?>"><i class="fa fa-share"></i> Checkout</a>
            </div>
        </div>
    <?php else : ?>
        <li class="minicart-item empty">
            <p><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>
        </li>
    <?php endif; ?>
</div>