<?php
function custom_compare_page() {

    if (!session_id()) {
        session_start();
    }

    if (empty($_SESSION['compare'])) {
        return '<div class="compare-page-wrapper section-padding">
                    <div class="container"><div class="section-bg-color"><div class="row"><div class="col-lg-12">
                        <h3 class="text-center">No products added to compare.</h3>
                    </div></div></div></div>
                </div>';
    }

    $product_ids = $_SESSION['compare'];
    $products = [];

    foreach ($product_ids as $id) {
        $product = wc_get_product($id);
        if ($product) {
            $products[] = $product;
        }
    }

    ob_start();

    if ( function_exists('wc_print_notices') ) {
        echo '<div class="woocommerce-notices-wrapper">';
        wc_print_notices();
        echo '</div>';
    }

    ?>

    <div class="compare-page-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="compare-page-content-wrap">
                            <div class="compare-table table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tbody>

                                        <!-- Product Row -->
                                        <tr>
                                            <td class="first-column">Product</td>
                                            <?php foreach ($products as $product) : ?>
                                                <td class="product-image-title">
                                                    <a href="<?php echo get_permalink($product->get_id()); ?>" class="image">
                                                        <?php echo $product->get_image('medium', ['class' => 'img-fluid']); ?>
                                                    </a>
                                                    <a href="#" class="category">
                                                        <?php
                                                        $terms = get_the_terms($product->get_id(), 'product_cat');
                                                        if ($terms && !is_wp_error($terms)) {
                                                            echo esc_html($terms[0]->name);
                                                        }
                                                        ?>
                                                    </a>
                                                    <a href="<?php echo get_permalink($product->get_id()); ?>" class="title">
                                                        <?php echo $product->get_name(); ?>
                                                    </a>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>

                                        <!-- Description -->
                                        <tr>
                                            <td class="first-column">Description</td>
                                            <?php foreach ($products as $product) : ?>
                                                <td class="pro-desc">
                                                    <p><?php echo wp_trim_words($product->get_short_description(), 20); ?></p>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>

                                        <!-- Price -->
                                        <tr>
                                            <td class="first-column">Price</td>
                                            <?php foreach ($products as $product) : ?>
                                                <td class="pro-price">
                                                    <?php echo $product->get_price_html(); ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>

                                        <!-- Stock -->
                                        <tr>
                                            <td class="first-column">Stock</td>
                                            <?php foreach ($products as $product) : ?>
                                                <td class="pro-stock">
                                                    <?php echo $product->is_in_stock() ? 'In Stock' : 'Stock Out'; ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>

                                        <!-- Add to Cart -->
                                        <tr>
                                            <td class="first-column">Add to cart</td>
                                            <?php foreach ($products as $product) : 
                                                $product_id = $product->get_id();
                                                $is_in_stock = $product->is_in_stock() && $product->is_purchasable();
                                            ?>
                                                <td>
                                                    <?php if ( $is_in_stock ) : ?>
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
                                            <?php endforeach; ?>
                                        </tr>

                                        <!-- Remove -->
                                        <tr>
                                            <td class="first-column">Remove</td>
                                            <?php foreach ($products as $product) : ?>
                                                <td class="pro-remove">
                                                    <button class="remove-compare" data-product-id="<?php echo $product->get_id(); ?>">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
    return ob_get_clean();
}
add_shortcode('custom_compare_page', 'custom_compare_page');

// count
function get_compare_count() {
    if (!session_id()) {
        session_start();
    }

    return isset($_SESSION['compare']) ? count($_SESSION['compare']) : 0;
}
?>