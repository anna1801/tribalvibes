<?php get_header(); ?>

    <?php  
        if ( ! defined( 'ABSPATH' ) ) exit;

        global $post;

        if ( ! is_a( $post, 'WC_Product' ) ) {
            $product = wc_get_product( get_the_ID() );
        }

        get_template_part('template/breadcrumb'); 
    ?>

    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 order-1 order-lg-2">

                    <?php product_details($product); ?>

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

<?php get_footer(); ?>