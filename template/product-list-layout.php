<?php
    $id = get_the_ID();
    $product = wc_get_product($id);
    if ($product) :
        $title = get_the_title();
        $link = get_the_permalink();
        $regular_price = $product->get_regular_price();
        $sale_price    = $product->get_sale_price();
        ?>
        <div class="product-list-item">
            <figure class="product-thumb">
                <a href="<?php echo $link; ?>">
                    <?php
                        if (has_post_thumbnail()) {
                            $image_url = get_the_post_thumbnail_url($id, 'full');
                            echo '<img class="pri-img" src="'.$image_url.'" alt="'.$title.'">';
                        }

                        $image_url = '';
                        $gallery_ids = $product->get_gallery_image_ids();
                        if (!empty($gallery_ids)) {
                            $first_image_id = $gallery_ids[0];
                            $image_url = wp_get_attachment_image_url($first_image_id, 'medium');
                        }
                        if ($image_url) :
                            echo '<img class="sec-img" src="'.$image_url.'" alt="'.$title.'">';
                        endif;
                    ?>
                </a>
                <div class="product-badge">
                    <?php
                        $post_date = get_post_field( 'post_date', $id );
                        $post_timestamp = strtotime( $post_date );
                        $five_days_ago = strtotime( '-5 days' );
                        // red
                        if ( $post_timestamp >= $five_days_ago ) {
                            echo '<div class="product-label new"> <span>new</span> </div>';
                        } 
                        elseif ( $post_timestamp < $five_days_ago && $product->is_on_sale() ) {
                            echo '<div class="product-label new"> <span>sale</span> </div>';
                        }
                        // green
                        if($product->is_on_sale()) {
                            if ($regular_price && $sale_price) {
                                $percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
                                echo '<div class="product-label discount"> <span>'.$percentage.'%</span></div>';
                            }
                        } 
                    ?>
                </div>
                <!-- to do 
                <div class="button-group">
                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                    <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                </div>
                to do end -->
                <div class="cart-hover">
                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                    data-quantity="1"
                    class="btn btn-cart add_to_cart_button ajax_add_to_cart"
                    data-product_id="<?php echo esc_attr($product->get_id()); ?>"
                    data-product_sku="<?php echo esc_attr($product->get_sku()); ?>">
                        <?php echo esc_html($product->add_to_cart_text()); ?>
                    </a>
                </div>
            </figure>
            <div class="product-content-list">
                <?php 
                    $categories = wp_get_post_terms( $id, 'product_cat' );
                    if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                        echo '<ul class="product-identity">';
                        foreach ( $categories as $category ) {
                            if ( $category->parent == 0 ) {
                                $category_link = get_term_link( $category );
                                echo '<li class="manufacturer-name">
                                        <a href="' . esc_url( $category_link ) . '">' . esc_html( $category->name ) . '</a>
                                    </li>';
                            }
                        }
                        echo '</ul>';
                    }
                ?>
                <h5 class="product-name"><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h5>
                <div class="price-box">
                    <?php
                        if ($product->is_on_sale()) :
                            echo '<span class="price-regular"><i class="fa fa-inr"></i> '.$sale_price.'</span>';
                            echo '<span class="price-old"><del><i class="fa fa-inr"></i> '.$regular_price.'</del></span>';
                        else :
                            echo '<span class="price-regular"><i class="fa fa-inr"></i> '.$regular_price.'</span>';
                        endif;
                    ?>
                </div>
                <?php
                    $description = $product->get_description();
                    if ( ! empty( $description ) ) {
                        echo '<p>' . wp_trim_words( wp_strip_all_tags( $description ), 45, '...' ) . '</p>';
                    }
                ?>
            </div>
        </div>
        <?php 
    endif;
?>