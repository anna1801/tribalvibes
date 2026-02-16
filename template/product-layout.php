<?php
    $id = get_the_ID();
    $product = wc_get_product($id);
    if ($product) :
        $title = get_the_title();
        $link = get_the_permalink();
        
        $regular_price = $product->get_regular_price();
        $sale_price    = $product->get_sale_price();
        ?>
        <div class="product-item">
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
                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                </div>
                to do end -->
                <!-- to do -->
                <div class="cart-hover">
                    <button class="btn btn-cart">add to cart</button>
                </div>
                <!-- to do end-->
            </figure>
            <div class="product-caption text-center">
                <h6 class="product-name">
                    <a href="<?php echo $link; ?>"><?php echo $title; ?></a>
                </h6>
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
            </div>
        </div>
        <?php 
    endif;
?>