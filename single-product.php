<?php get_header(); ?>

    <?php  
        if ( ! defined( 'ABSPATH' ) ) exit;

        global $post;

        if ( ! is_a( $post, 'WC_Product' ) ) {
            $product = wc_get_product( get_the_ID() );
        }

        $attributes = $product->get_attributes();

        get_template_part('template/breadcrumb'); 
    ?>

    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 order-1 order-lg-2">
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
                                        $terms = get_the_terms( get_the_ID(), 'product_cat' );
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

                                    <h3 class="product-name"><?php the_title(); ?></h3>

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
                                                <button type="submit" name="add-to-cart" value="<?php echo $product->get_id(); ?>" class="btn btn-cart2">
                                                    Add to cart
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="custom-cart-message"></div> 
                                    <!-- to do 
                                    <div class="useful-links">
                                        <a href="compare.html" data-bs-toggle="tooltip" title="Compare"><i class="pe-7s-refresh-2"></i>compare</a>
                                        <a href="wishlist.html" data-bs-toggle="tooltip" title="Wishlist"><i class="pe-7s-like"></i>wishlist</a>
                                    </div>
                                    to do end -->
                                    <div class="like-icon">
                                        <?php
                                            $share_link = get_the_permalink();
                                            $share_title = get_the_title();
                                            if ( has_post_thumbnail( get_the_ID() ) ) {
                                                $share_img = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                                            } else {
                                                $share_img = '';
                                            }
                                        ?>
                                        <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_link; ?>" target="_blank"><i class="fa fa-facebook"></i>like</a>
                                        <a class="twitter" href="https://twitter.com/intent/tweet?text=<?php echo $share_title; ?>&url=<?php echo $share_link; ?>" target="_blank"><i class="fa fa-twitter"></i>tweet</a>
                                        <a class="pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo $share_link; ?>&media=<?php echo $share_img; ?>&description=<?php echo $share_title; ?>"><i class="fa fa-pinterest"></i>save</a>
                                        <!-- <a class="google" href=""><i class="fa fa-google-plus"></i>share</a> -->
                                        <!-- <a class="linkedin" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $share_link; ?>"><i class="fa fa-linkedin"></i>share</a> -->
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="product-details-reviews section-padding pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <?php
                                        $description = $product->get_description();
                                    ?>
                                    <ul class="nav review-tab">
                                        <li>
                                            <a class="active" data-bs-toggle="tab" href="#tab_one">description</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tab" href="#tab_two">information</a>
                                        </li>
                                        <!-- to do
                                        <li>
                                            <a data-bs-toggle="tab" href="#tab_three">reviews (1)</a>
                                        </li>
                                        to do end -->
                                    </ul>
                                    <div class="tab-content reviews-tab">
                                        <?php
                                            // tab 1
                                            echo '<div class="tab-pane fade show active" id="tab_one"> <div class="tab-one">';
                                                if ( ! empty( $description ) ) {
                                                    echo $description;
                                                } else {
                                                    echo 'Nothing found';
                                                }
                                            echo '</div> </div>';
                                            
                                            // tab 2
                                            echo '<div class="tab-pane fade" id="tab_two">';
                                                if ( $attributes ) {
                                                    echo '<table class="table table-bordered">';
                                                        echo '<tbody>';
                                                            foreach ( $attributes as $attribute_name => $attribute ) :
                                                                $label = wc_attribute_label( $attribute_name );
                                                                if ( $attribute->is_taxonomy() ) {
                                                                    $terms = wc_get_product_terms( $product->get_id(), $attribute_name, array( 'fields' => 'names' ) );
                                                                } else {
                                                                    $terms = $attribute->get_options();
                                                                }
                                                                if ( ! empty( $terms ) ) : 
                                                                    echo '<tr>';
                                                                        echo '<td>'.esc_html( $label ).'</td>';
                                                                        echo '<td>';
                                                                            $i = 1;
                                                                            foreach ( $terms as $term ) :
                                                                                if( $i != 1) :
                                                                                    echo ', ';
                                                                                endif;
                                                                                echo esc_html( $term );
                                                                                $i++;
                                                                            endforeach;
                                                                        echo '</td>';
                                                                    echo '</tr>';
                                                                endif; 
                                                            endforeach;
                                                        echo '</tbody>';
                                                    echo '</table>';
                                                } else {
                                                    echo 'Nothing found';
                                                }
                                            echo '</div>';
                                        ?>
                                        <!-- to do 
                                        <div class="tab-pane fade" id="tab_three">
                                            <form action="#" class="review-form">
                                                <h5>1 review for <span>Client Name</span></h5>
                                                <div class="total-reviews">
                                                    <div class="rev-avatar">
                                                        <img src="assets/img/about/avatar.jpg" alt="">
                                                    </div>
                                                    <div class="review-box">
                                                        <div class="ratings">
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                        </div>
                                                        <div class="post-author">
                                                            <p><span>Username -</span> 30 Dec, 2025</p>
                                                        </div>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Your Name</label>
                                                        <input type="text" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Your Email</label>
                                                        <input type="email" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Your Review</label>
                                                        <textarea class="form-control" required></textarea>
                                                        <div class="help-block pt-10"><span class="text-danger">Note:</span>
                                                            HTML is not translated!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Rating</label>
                                                        &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                                        <input type="radio" value="1" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="2" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="3" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="4" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="5" name="rating" checked>
                                                        &nbsp;Good
                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    <button class="btn btn-sqr" type="submit">Continue</button>
                                                </div>
                                            </form> 
                                        </div>
                                        to do end-->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php
        $current_product_id = $product->get_id();
        $terms = wp_get_post_terms( $current_product_id, 'product_cat', array( 'fields' => 'ids' ) );
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 8, 
            'post_status'    => 'publish',
            'orderby'        => 'rand', 
            'post__not_in'   => array( $current_product_id ), 
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $terms,
                ),
            ),
        );
        $related_products = new WP_Query($args);
        if ($related_products->have_posts()) : 
    ?>
        <section class="related-products section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <?php
                                $related_intro = get_field('related_product_single_product', 'option');
                                if($related_intro) :
                                    $related_title = $related_intro['title'];
                                    $related_description = $related_intro['short_description'];
                                    if($related_title) :
                                        echo '<h2 class="title">'.$related_title.'</h2>';
                                    endif;
                                    if($related_description) :
                                        echo '<p class="sub-title">'.$related_description.'</p>';
                                    endif;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                            <?php
                                while ($related_products->have_posts()) : $related_products->the_post(); 
                                    get_template_part('template/product-grid-layout');
                                endwhile;
                                wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- related products area end -->

<?php get_footer(); ?>