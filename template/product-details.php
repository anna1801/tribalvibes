<?php function product_details($product) { ?>
    <?php
        // var_dump($product);
        $id = $product->id; 
        $title = $product->name;
        $attributes = $product->get_attributes();
    ?>
    <div class="product-details-inner">
        <div class="row">
            <div class="col-lg-5">
                <?php 
                    $attachment_ids = $product->get_gallery_image_ids(); 
                    $featured_id = $product->get_image_id();
                ?>
                <div class="product-large-slider">
                    <?php
                        if ( $featured_id ) :
                            $featured_url = wp_get_attachment_image_url( $featured_id, 'full' );
                            echo '<div class="pro-large-img img-zoom"> <img src="'. esc_url( $featured_url ) .'" alt="'. get_the_title(). '" /> </div>';
                        endif; 

                        if ( ! empty( $attachment_ids ) ) : 
                            foreach ( $attachment_ids as $attachment_id ) :
                                $image_url = wp_get_attachment_image_url( $attachment_id, 'full' );
                                echo '<div class="pro-large-img img-zoom"> <img src="'. esc_url( $image_url ) .'" alt="'. get_the_title() .'" /></div>';
                            endforeach; 
                        endif; 
                    ?>
                </div>
                <div class="pro-nav slick-row-10 slick-arrow-style">
                    <?php
                        if ( $featured_id ) :
                            $featured_url = wp_get_attachment_image_url( $featured_id, 'full' );
                            echo '<div class="pro-nav-thumb"> <img src="'. esc_url( $featured_url ) .'" alt="'. get_the_title(). '" /> </div>';
                        endif; 

                        if ( ! empty( $attachment_ids ) ) : 
                            foreach ( $attachment_ids as $attachment_id ) :
                                $image_url = wp_get_attachment_image_url( $attachment_id, 'full' );
                                echo '<div class="pro-nav-thumb"> <img src="'. esc_url( $image_url ) .'" alt="'. get_the_title() .'" /></div>';
                            endforeach; 
                        endif; 
                    ?>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="product-details-des">
                    <?php
                        $terms = get_the_terms( $id, 'product_cat' );
                        if ( $terms && ! is_wp_error( $terms ) ) {
                            echo '<div class="manufacturer-name">';
                            foreach ( $terms as $term ) {
                                if ( $term->parent != 0 ) {
                                    $parent = get_term( $term->parent, 'product_cat' );
                                    $link = get_term_link($parent);
                                    if ( $parent && ! is_wp_error( $parent ) ) {
                                        echo '<a href="' . esc_url($link) . '">'.esc_html( $parent->name ).'</a>';
                                        break; 
                                    }
                                }
                            }
                            echo '</div>';
                        }
                    ?>

                    <h3 class="product-name"><?php echo $title; ?></h3>

                    <!-- to do 
                    <div class="ratings d-flex">
                        <span><i class="fa fa-star-o"></i></span>
                        <span><i class="fa fa-star-o"></i></span>
                        <span><i class="fa fa-star-o"></i></span>
                        <span><i class="fa fa-star-o"></i></span>
                        <span><i class="fa fa-star-o"></i></span>
                        <div class="pro-review">
                            <span>1 Reviews</span>
                        </div>
                    </div>
                    to do end-->

                    <div class="price-box">
                        <?php
                            $regular_price = $product->get_regular_price();
                            $sale_price    = $product->get_sale_price();
                            if ($product->is_on_sale()) :
                                echo '<span class="price-regular"><i class="fa fa-inr"></i> '.$sale_price.'</span>';
                                echo '<span class="price-old"><del><i class="fa fa-inr"></i> '.$regular_price.'</del></span>';
                            else :
                                echo '<span class="price-regular"><i class="fa fa-inr"></i> '.$regular_price.'</span>';
                            endif;
                        ?>
                    </div>

                    <?php
                        $sale_start = $product->get_date_on_sale_from();
                        $sale_end   = $product->get_date_on_sale_to();
                        
                        if ( $sale_start instanceof WC_DateTime ) {
                            $date_sale_start = $sale_start->date('Y/m/d');
                        } else {
                            $date_sale_start = '';
                        }
                        
                        if ( $sale_end instanceof WC_DateTime ) {
                            $date_sale_end = $sale_end->date('Y/m/d');
                        } else {
                            $date_sale_end = '';
                        }
                        if ($product->is_on_sale() && $sale_end) :
                        ?>
                            <h5 class="offer-text"><strong>Hurry up</strong>! offer ends in:</h5>
                            <div class="product-countdown" data-countdown="<?php echo $date_sale_end; ?>"></div>
                    <?php endif; ?>

                    <div class="availability">
                        <?php
                            if ( $product->managing_stock() && $product->is_in_stock() ) {
                                $stock_qty = $product->get_stock_quantity();
                                if ( $stock_qty > 0 ) {
                                    echo '<i class="fa fa-check-circle"></i> <span>' . esc_html( $stock_qty ) . ' in stock</span>';
                                } else {
                                    echo '<i class="fa fa-check-circle"></i> <span>In stock</span>';
                                }
                            } elseif ( $product->is_in_stock() ) {
                                echo '<i class="fa fa-check-circle"></i> <span>In stock</span>';
                            } else {
                                echo '<i class="fa fa-times-circle-o"></i> <span>Out of Stock</span>';
                            }
                        ?>
                    </div>
                    <?php
                        $short_description = $product->get_short_description();
                        if ( ! empty( $short_description ) ) {
                            echo '<p class="pro-desc">';
                            echo wp_kses_post( $short_description );
                            echo '</p>';
                        }
                    ?>
                    <form class="custom-ajax-add-to-cart" method="post">
                        <?php 
                            if ( $attributes ) :
                                foreach ( $attributes as $attribute_name => $attribute ) :
                                    $label = wc_attribute_label( $attribute_name );
                                    if ( $attribute->is_taxonomy() ) {
                                        $terms = wc_get_product_terms( $product->get_id(), $attribute_name, array( 'fields' => 'names' ) );
                                    } else {
                                        $terms = $attribute->get_options();
                                    }
                                    if ( ! empty( $terms ) ) : ?>
                                        <div class="pro-size">
                                            <h6 class="option-title"><?php echo esc_html( $label ); ?> :</h6>
                                            <select name="attribute_<?php echo esc_attr( $attribute_name ); ?>" class="nice-select">
                                                <option value="">Select <?php echo esc_html( $label ); ?></option>
                                                <?php foreach ( $terms as $term ) : ?>
                                                    <option value="<?php echo esc_attr( $term ); ?>"><?php echo esc_html( $term ); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php 
                                    endif; 
                                endforeach;
                            endif; 
                        ?>
                        <div class="quantity-cart-box d-flex align-items-center">
                            <h6 class="option-title">Qty:</h6>
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="quantity" value="1" min="1">
                                </div>
                            </div>
                            <div class="action_link">
                                <button type="submit" name="add-to-cart" value="<?php echo $product->get_id(); ?>" class="btn btn-cart2 add_to_cart_button ajax_add_to_cart">
                                    Add to cart
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="custom-cart-message"></div> 
                    <div class="useful-links">
                        <?php
                            $added = false;
                            if (isset($_SESSION['compare']) && in_array($id, $_SESSION['compare'])) :
                                $added = true;
                            endif;
                            if ($added) {
                                $text = '<i class="fa fa-check-circle" aria-hidden="true"></i> Compare';
                                $tooltip = 'Added to Compare';
                            } else {
                                $text = '<i class="pe-7s-refresh-2"></i> Compare';
                                $tooltip = 'Compare';
                            }
                        ?>
                        <a href="#" class="custom-compare-btn <?php echo $added ? 'added' : ''; ?>" data-product-id="<?php echo $id; ?>" data-bs-toggle="tooltip" title="<?php echo $tooltip; ?>"> <?php echo $text; ?> </a> 
                        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist label="wishlist" ]'); ?>
                    </div>
                    <div class="like-icon">
                        <?php
                            $share_link = get_the_permalink($id);
                            $share_title = $title;
                            if ( has_post_thumbnail( $id ) ) {
                                $share_img = get_the_post_thumbnail_url( $id, 'full' );
                            } else {
                                $share_img = get_template_directory_uri().'/assets/images/placeholder.png';
                            }
                        ?>
                        <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_link; ?>" target="_blank"><i class="fa fa-facebook"></i>like</a>
                        <a class="twitter" href="https://twitter.com/intent/tweet?text=<?php echo $share_title; ?>&url=<?php echo $share_link; ?>" target="_blank"><i class="fa fa-twitter"></i>tweet</a>
                        <a class="pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo $share_link; ?>&media=<?php echo $share_img; ?>&description=<?php echo $share_title; ?>"><i class="fa fa-pinterest"></i>save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>