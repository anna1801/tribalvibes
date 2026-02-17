<?php 
/* Template Name: Home page */ 
/* Template Post Type: page */ 
?>
<?php get_header(); ?>

    <!-- hero slider area start -->
    <?php if( have_rows('hero_slider') ): ?>
        <section class="hero-slider-area">
            <div class="container custom-container p-0">
                <div class="hero-slider-active-4 slick-dot-style">
                    <?php 
                        while( have_rows('hero_slider') ): the_row(); 
                            $featured_image = get_sub_field('featured_image');
                            $title = get_sub_field('title');
                            $sub_title = get_sub_field('sub_title');
                            $cta = get_sub_field('cta');
                            if($cta) {
                                $link = $cta['url'];
                                $target = $cta['target'];
                            } else {
                                $link = '#';
                                $target = '_self';
                            }
                            echo '<div class="slider-item">';
                                echo '<a href="'.$link.'" target="'.$target.'">';
                                    if($featured_image) :
                                        echo '<figure class="slider-thumb"> <img src="'.$featured_image['url'].'" alt="'.$featured_image['alt'].'"> </figure>';
                                    endif;
                                    echo '<div class="slider-item-content">';
                                        if($title) :
                                            echo '<h2>'.$title.'</h2>';
                                        endif;
                                        if($sub_title) :
                                            echo '<h3>'.$sub_title.'</h3>';
                                        endif;
                                        if($cta) :
                                            echo '<div class="btn btn-text">'.$cta['title'].'</div>';
                                        endif;
                                    echo '</div>';
                                echo '</a>';
                            echo '</div>';
                        endwhile; 
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- hero slider area end -->

    <!-- service policy area start -->
    <?php if( have_rows('services') ): ?>
        <div class="service-policy section-padding">
            <div class="container">
                <div class="row mtn-30 justify-content-center">
                    <?php while( have_rows('services') ): the_row(); 
                        $icon = get_sub_field('icon');
                        $title = get_sub_field('title');
                        $description = get_sub_field('description');
                    ?>
                        <div class="col-sm-6 col-lg-3">
                            <div class="policy-item">
                                <div class="policy-icon">
                                    <i class="pe-7s-<?php echo $icon; ?>"></i>
                                </div>
                                <div class="policy-content">
                                    <?php
                                        if($title) :
                                            echo '<h6>'.$title.'</h6>';
                                        endif;
                                        if($description) :
                                            echo '<p>'.$description.'</p>';
                                        endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- service policy area end -->

    <!-- banner statistics area start -->
    <?php if( have_rows('featured_items') ): ?>
        <div class="banner-statistics-area">
            <div class="container">
                <div class="row row-20 mtn-20">
                    <?php while( have_rows('featured_items') ): the_row(); 
                        $banner_image = get_sub_field('banner_image');
                        $title = get_sub_field('title');
                        $sub_title = get_sub_field('sub_title');
                        $cta = get_sub_field('cta');
                        if($cta) {
                            $link = $cta['url'];
                            $target = $cta['target'];
                        } else {
                            $link = '#';
                            $target = '_self';
                        }
                        ?>
                        <div class="col-sm-6">
                            <figure class="banner-statistics mt-20">
                                <a href="<?php echo $link; ?>" target="<?php echo $target; ?>">
                                    <?php 
                                        if($banner_image) :
                                            echo '<img src="'.$banner_image['url'].'" alt="'.$banner_image['alt'].'">';
                                        endif;
                                    ?>
                                </a>
                                <div class="banner-content text-right">
                                    <?php
                                        if($sub_title) :
                                            echo '<h5 class="banner-text1">'.$sub_title.'</h5>';
                                        endif;
                                        if($title) :
                                            echo '<h2 class="banner-text2">'.$title.'</h2>';
                                        endif;
                                        if($cta) :
                                            echo '<a href="'.$cta['url'].'" target="'.$cta['target'].'" class="btn btn-text">'.$cta['title'].'</a>';
                                        endif;
                                    ?>
                                </div>
                            </figure>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- banner statistics area end -->

    <!-- hot deals area start -->
    <?php
        $sale_show_hide = get_field('sale_show_hide');
        if($sale_show_hide == true) :
    ?>
        <section class="hot-deals section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <?php
                                $sales_title = get_field('sales_title');
                                $sales_description = get_field('sales_description');
                                if($sales_title) :
                                    echo '<h2 class="title">'.$sales_title.'</h2>';
                                endif;
                                if($sales_description) :
                                    echo '<p class="sub-title">'.$sales_description.'</p>';
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                    $sale_ids = wc_get_product_ids_on_sale();
                    $sale_args = array(
                        'post_type'      => 'product',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                        'orderby'        => 'date', 
                        'order'          => 'DESC', 
                        'post__in'       => $sale_ids,
                    );
                    $sale_products = new WP_Query($sale_args);
                    if ($sale_products->have_posts()) : 
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="deals-carousel-active--two slick-row-10 slick-arrow-style">
                                <?php 
                                    while ($sale_products->have_posts()) : $sale_products->the_post(); 
                                        $id = get_the_ID();
                                        $product = wc_get_product($id);
                                        if ($product) :
                                            $link = get_the_permalink();
                                            $title = get_the_title();
                                            
                                            $regular_price = $product->get_regular_price();
                                            $sale_price    = $product->get_sale_price();

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
                                            ?>
                                            <div class="hot-deals-item product-item">
                                                <figure class="product-thumb">
                                                    <a href="#">
                                                        <?php
                                                            if (has_post_thumbnail()) {
                                                                $image_url = get_the_post_thumbnail_url($id, 'full');
                                                                echo '<img src="'.$image_url.'" alt="'.$title.'">';
                                                            }
                                                        ?>
                                                    </a>
                                                    <div class="product-badge">
                                                        <div class="product-label new">
                                                            <span>sale</span>
                                                        </div>
                                                        <?php
                                                            $post_date = get_post_field( 'post_date', $id );
                                                            $post_timestamp = strtotime( $post_date );
                                                            $five_days_ago = strtotime( '-5 days' );
                                                            if ( $post_timestamp >= $five_days_ago ) :
                                                                echo '<div class="product-label discount"> <span>new</span> </div>';
                                                            endif;
                                                        ?>
                                                    </div>
                                                    <!-- to do 
                                                    <div class="button-group">
                                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                                    </div>
                                                    to do end-->
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
                                                <div class="product-caption">
                                                    <h6 class="product-name">
                                                        <a href="<?php echo $link; ?>"><?php echo $title; ?></a>
                                                    </h6>
                                                    <div class="price-box">
                                                        <span class="price-regular"> <i class="fa fa-inr"></i> <?php echo $sale_price; ?></span>
                                                        <span class="price-old"><del> <i class="fa fa-inr"></i> <?php echo $regular_price; ?></del></span>
                                                    </div>
                                                    <div class="product-countdown product-countdown--style-two" data-countdown="<?php echo $date_sale_end; ?>"></div>                                                
                                                </div>
                                            </div>
                                            <?php 
                                        endif;
                                    endwhile;
                                    wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
    <!-- hot deals area end -->

    <!-- product area start -->
    <?php
        $choose_category = get_field('choose_category');
        if($choose_category) : 
        ?>
        <section class="product-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <?php
                                $prod_cat_title = get_field('prod_cat_title');
                                $prod_cat_description = get_field('prod_cat_description');
                                if($prod_cat_title) :
                                    echo '<h2 class="title">'.$prod_cat_title.'</h2>';
                                endif;
                                if($prod_cat_description) :
                                    echo '<p class="sub-title">'.$prod_cat_description.'</p>';
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-container">
                            <div class="product-tab-menu">
                                <ul class="nav justify-content-center">
                                    <?php
                                        $i = 1;
                                        foreach ($choose_category as $cat_tab) :
                                            $cat_name = $cat_tab->name;
                                            $cat_id = $cat_tab->term_id;
                                            if($i == 1) {
                                                $class = 'active';
                                            } else {
                                                $class = '';
                                            }
                                            echo '<li><a href="#tab'.$i.'" class="'.$class.'" data-bs-toggle="tab">'.$cat_name.'</a></li>';
                                        $i++;
                                        endforeach;
                                    ?>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <?php
                                    $x = 1;
                                    foreach ($choose_category as $cat) :
                                        $cat_id = $cat->term_id;
                                        if($x == 1) {
                                            $class = 'active';
                                        } else {
                                            $class = '';
                                        }
                                        ?>
                                        <div class="tab-pane show <?php echo $class; ?>" id="tab<?php echo $x; ?>">
                                            <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                                <?php
                                                    $args = array(
                                                        'post_type'      => 'product',
                                                        'posts_per_page' => -1,
                                                        'post_status'    => 'publish',
                                                        'orderby'        => 'date', 
                                                        'order'          => 'DESC', 
                                                        'tax_query'      => array(
                                                            array(
                                                                'taxonomy' => 'product_cat',
                                                                'field'    => 'term_id',  
                                                                'terms'    => $cat_id, 
                                                            ),
                                                        ),
                                                    );
                                                    $products = new WP_Query($args);
                                                    if ($products->have_posts()) : 
                                                        while ($products->have_posts()) : $products->the_post(); 
                                                            get_template_part('template/product-grid-layout');
                                                        endwhile;
                                                        wp_reset_postdata();
                                                    endif; 
                                                ?>      
                                            </div>
                                        </div>
                                        <?php
                                        $x++;
                                    endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;?>
    <!-- product area end -->

    <!-- product banner statistics area start -->
    <?php
        $slider_category = get_field('slider_category');
        if($slider_category) : 
        ?>
        <section class="product-banner-statistics">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="product-banner-carousel slick-row-10">
                            <?php
                                foreach ($slider_category as $cat_tab) :
                                    $cat_name = $cat_tab->name;
                                    $cat_id = $cat_tab->term_id;
                                    $cat_link = get_category_link($cat_id);
                                    ?>
                                    <div class="banner-slide-item">
                                        <figure class="banner-statistics">
                                            <a href="<?php echo $cat_link; ?>">
                                                <?php 
                                                    $thumbnail_id = get_term_meta($cat_id, 'thumbnail_id', true);
                                                    if ($thumbnail_id) {
                                                        $image_url = wp_get_attachment_url($thumbnail_id);
                                                        echo '<img src="'.$image_url.'" alt="'.$cat_name .'">';
                                                    } else {
                                                        echo '<img src="'.get_template_directory_uri().'/assets/images/placeholder.png" alt="'.$cat_name .'">';
                                                    }
                                                ?>
                                            </a>
                                            <div class="banner-content banner-content_style2">
                                                <h5 class="banner-text3"><a href="<?php echo $cat_link; ?>"><?php echo $cat_name; ?></a></h5>
                                            </div>
                                        </figure>
                                    </div>
                                    <?php 
                                endforeach; 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;?>
    <!-- product banner statistics area end -->

    <!-- featured product area start -->
    <?php
        $featured_show_hide = get_field('featured_show_hide');
        if($featured_show_hide == true) :
        ?>
        <section class="feature-product section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <?php
                                $featured_title = get_field('featured_title');
                                $featured_description = get_field('featured_description');
                                if($featured_title) :
                                    echo '<h2 class="title">'.$featured_title.'</h2>';
                                endif;
                                if($featured_description) :
                                    echo '<p class="sub-title">'.$featured_description.'</p>';
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                            <?php
                                $args = array(
                                    'post_type'      => 'product',
                                    'posts_per_page' => -1,
                                    'post_status'    => 'publish',
                                    'orderby'        => 'date', 
                                    'order'          => 'DESC',
                                );
                                $products = new WP_Query($args);
                                if ($products->have_posts()) : 
                                    while ($products->have_posts()) : $products->the_post(); 
                                        get_template_part('template/product-grid-layout');
                                    endwhile;
                                    wp_reset_postdata();
                                endif; 
                            ?>  
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;?>
    <!-- featured product area end -->

    <!-- testimonial area start -->
    <?php
        $testimonials_args = array(
            'post_type'      => 'testimonials',
            'posts_per_page' => -1, 
            'post_status'    => 'publish',
            'orderby'        => 'date', 
            'order'          => 'DESC', 
        );
        $latest_testimonials = new WP_Query($testimonials_args);
        if ($latest_testimonials->have_posts()) :
        ?>
        <section class="testimonial-area section-padding bg-img" data-bg="<?php echo get_template_directory_uri(); ?>/assets/images/testimonials-bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <?php
                                $testimonials_title = get_field('testimonials_title');
                                $testimonials_description = get_field('testimonials_description');
                                if($testimonials_title) :
                                    echo '<h2 class="title">'.$testimonials_title.'</h2>';
                                endif;
                                if($testimonials_description) :
                                    echo '<p class="sub-title">'.$testimonials_description.'</p>';
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="testimonial-thumb-wrapper">
                            <div class="testimonial-thumb-carousel">
                                <?php
                                    while ($latest_testimonials->have_posts()) : $latest_testimonials->the_post(); 
                                        $id = get_the_ID();
                                        $title = get_the_title();
                                        $profile_picture = get_field('profile_picture', $id);
                                        if($profile_picture) :
                                            echo '<div class="testimonial-thumb"><img src="'.$profile_picture.'" alt="'.$title.'"></div>';
                                        endif;
                                    endwhile;
                                    wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                        <div class="testimonial-content-wrapper">
                            <div class="testimonial-content-carousel">

                                <?php
                                    while ($latest_testimonials->have_posts()) : $latest_testimonials->the_post(); 
                                        $id = get_the_ID();
                                        $title = get_the_title();
                                        $reviews = get_field('reviews', $id);
                                        if($reviews) :
                                            echo '<div class="testimonial-content">';
                                                echo '<p>'.$reviews.'</p>';
                                                echo '<h5 class="testimonial-author">'.$title.'</h5>';
                                            echo '</div>';
                                        endif;
                                    endwhile;
                                    wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- testimonial area end -->
        
    <!-- latest blog area start -->
    <?php
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => -1, 
            'post_status'    => 'publish',
            'orderby'        => 'date', 
            'order'          => 'DESC', 
        );
        $latest_posts = new WP_Query($args);
        if ($latest_posts->have_posts()) :
        ?>
        <section class="latest-blog-area section-padding pt-30">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <?php
                                $blog_title = get_field('blog_title');
                                $blog_description = get_field('blog_description');
                                if($blog_title) :
                                    echo '<h2 class="title">'.$blog_title.'</h2>';
                                endif;
                                if($blog_description) :
                                    echo '<p class="sub-title">'.$blog_description.'</p>';
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="blog-carousel-active slick-row-10 slick-arrow-style">
                            <?php
                                while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                                    <div class="blog-post-item">
                                        <figure class="blog-thumb">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php
                                                    if (has_post_thumbnail()) {
                                                        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                                        echo '<img src="'.$image_url.'" alt="'.get_the_title().'">';
                                                    }
                                                ?>
                                            </a>
                                        </figure>
                                        <div class="blog-content">
                                            <div class="blog-meta">
                                                <p><?php the_time('d/m/Y'); ?></p>
                                            </div>
                                            <h5 class="blog-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h5>
                                        </div>
                                    </div>
                                <?php 
                                endwhile;
                                wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- latest blog area end -->

<?php get_footer(); ?>