<?php
defined( 'ABSPATH' ) || exit;

$wishlist_items = $wishlist->get_items();
?>

<?php if ( $wishlist_items ) : ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="pro-thumbnail">Thumbnail</th>
                <th class="pro-title">Product</th>
                <th class="pro-price">Price</th>
                <th class="pro-quantity">Stock Status</th>
                <th class="pro-subtotal">Add to Cart</th>
                <th class="pro-remove">Remove</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ( $wishlist_items as $item ) :
                $product = wc_get_product( $item['product_id'] );
                if ( ! $product ) {
                    continue;
                }
                $product_id = $product->get_id();
                $product_link = get_permalink( $product_id );
                ?>
                <tr>
                    <td class="pro-thumbnail">
                        <a href="<?php echo esc_url($product_link); ?>"><?php echo $product->get_image('thumbnail'); ?></a>
                    </td>
                    <td class="pro-title">
                        <a href="<?php echo esc_url($product_link); ?>"><?php echo esc_html($product->get_name()); ?></a>
                    </td>
                    <td class="pro-price"><span><?php echo $product->get_price_html(); ?></span></td>
                    <td class="pro-quantity">
                        <?php if ( $product->is_in_stock() ) : ?>
                            <span class="text-success">In Stock</span>
                        <?php else : ?>
                            <span class="text-danger">Out of Stock</span>
                        <?php endif; ?>
                    </td>                
                    <td class="pro-subtotal">
                        <?php if ( $product->is_in_stock() ) : ?>
                            <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                                data-quantity="1"
                                class="btn btn-sqr add_to_cart_button ajax_add_to_cart"
                                data-product_id="<?php echo $product_id; ?>"
                                data-product_sku="<?php echo esc_attr($product->get_sku()); ?>">
                                    <?php echo esc_html($product->add_to_cart_text()); ?>
                                </a>
                        <?php else : ?>
                            <a href="#" class="btn btn-sqr disabled">Add to Cart</a>
                        <?php endif; ?>
                    </td>
                    <td class="pro-remove">
                        <a href="<?php echo esc_url( $item['remove_url'] ); ?>" class="remove_from_wishlist"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <h3 class="text-center">Your wishlist is empty.</h3>
<?php endif; ?>