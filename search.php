<?php get_header(); ?>

    <?php get_template_part('template/breadcrumb');  ?>

    <div class="shop-main-wrapper section-padding search-result">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ">
                    <h1>Search Results for: <span><?php echo get_search_query(); ?></span></h1>
                    <div class="shop-product-wrapper">
                        <div class="shop-product-wrap grid-view row mbn-30" id="ajax-product-container">
                            <?php
                                if ( have_posts() ) :
                                    while ( have_posts() ) : the_post();
                                        echo '<div class="col-md-4 col-sm-6">';
                                            get_template_part('template/product-grid-layout');
                                        echo '</div>';
                                    endwhile;
                                    wp_reset_postdata();
                                else :
                                    echo '<h4 class="text-center">No products found</h4>';
                                endif; 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>