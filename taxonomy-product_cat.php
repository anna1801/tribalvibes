<?php get_header(); ?>

    <?php 
        $current_cat = get_queried_object(); 
        $total_count = isset($current_cat->count) ? $current_cat->count : 0;
        get_template_part('template/breadcrumb'); 
    ?>

    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="sidebar-wrapper">
                        <div class="sidebar-single">
                            <?php
                                if ( $current_cat && isset($current_cat->term_id) ) {
                                    if ( $current_cat->parent != 0 ) {
                                        $parent_id = $current_cat->parent;
                                        $siblings = get_terms( array(
                                            'taxonomy'   => 'product_cat',
                                            'parent'     => $parent_id,
                                            'hide_empty' => true,
                                            'exclude'    => array( $current_cat->term_id ),
                                        ) );
                                        if ( !empty($siblings) ) {
                                            echo '<h5 class="sidebar-title">Product Sub Category</h5>';
                                            echo '<div class="sidebar-body">';
                                                echo '<ul class="shop-categories">';
                                                    foreach ( $siblings as $sibling ) {
                                                        echo '<li><a href="' . get_term_link($sibling) . '">' . $sibling->name . ' <span>(' . $sibling->count . ')</span></a></li>';
                                                    }
                                                echo '</ul>';
                                            echo '</div>';
                                        }
                                    } else {
                                        $parent_cats = get_terms( array(
                                            'taxonomy'   => 'product_cat',
                                            'parent'     => 0,
                                            'hide_empty' => true,
                                            'exclude'    => array( $current_cat->term_id ),
                                        ) );
                                        if ( !empty($parent_cats) ) {
                                            echo '<h5 class="sidebar-title">Product Category</h5>';
                                            echo '<div class="sidebar-body">';
                                                echo '<ul class="shop-categories">';
                                                    foreach ( $parent_cats as $parent_cat ) {
                                                        echo '<li><a href="' . get_term_link($parent_cat) . '">' . $parent_cat->name . ' <span>(' . $parent_cat->count . ')</span></a></li>';
                                                    }
                                                echo '</ul>';
                                            echo '</div>';
                                        }
                                    }
                                }
                            ?>
                        </div>

                        <?php
                            global $wpdb;
                            $min_price = $wpdb->get_var("
                                SELECT MIN(CAST(meta_value AS DECIMAL)) 
                                FROM {$wpdb->postmeta} pm
                                INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
                                WHERE pm.meta_key = '_price'
                                AND p.post_type = 'product'
                                AND p.post_status = 'publish'
                            ");

                            $max_price = $wpdb->get_var("
                                SELECT MAX(CAST(meta_value AS DECIMAL)) 
                                FROM {$wpdb->postmeta} pm
                                INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
                                WHERE pm.meta_key = '_price'
                                AND p.post_type = 'product'
                                AND p.post_status = 'publish'
                            ");
                            $min_price = $min_price ? $min_price : 0;
                            $max_price = $max_price ? $max_price : 1000;

                            if($total_count != 0) :
                                ?>
                                <div class="sidebar-single">
                                    <h5 class="sidebar-title">price</h5>
                                    <div class="sidebar-body">
                                        <div class="price-range-wrap">
                                            <div class="price-range" data-min="<?php echo esc_attr($min_price); ?>" data-max="<?php echo esc_attr($max_price); ?>"></div>
                                            <div class="range-slider">
                                                <form action="#" class="d-flex align-items-center justify-content-between">
                                                    <div class="price-input">
                                                        <label for="amount">Price: </label>
                                                        <input type="text" id="amount">
                                                    </div>
                                                    <button class="filter-btn">filter</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php endif; ?>

                        <?php
                            if ( $current_cat && isset($current_cat->term_id) ) {
                                $attributes = wc_get_attribute_taxonomies();
                                foreach ( $attributes as $attribute ) {
                                    $taxonomy = wc_attribute_taxonomy_name( $attribute->attribute_name );
                                    $terms = get_terms( array(
                                        'taxonomy'   => $taxonomy,
                                        'hide_empty' => true,
                                    ) );
                                    $valid_terms = array();
                                    foreach ( $terms as $term ) {
                                        $products = wc_get_products( array(
                                            'status' => 'publish',
                                            'limit' => -1,
                                            'tax_query' => array(
                                                'relation' => 'AND',
                                                array(
                                                    'taxonomy' => 'product_cat',
                                                    'field'    => 'slug',
                                                    'terms'    => $current_cat->slug,
                                                ),
                                                array(
                                                    'taxonomy' => $taxonomy,
                                                    'field'    => 'slug',
                                                    'terms'    => $term->slug,
                                                ),
                                            ),
                                        ) );

                                        if ( count($products) > 0 ) {
                                            $valid_terms[] = array(
                                                'term'  => $term,
                                                'count' => count($products),
                                            );
                                        }
                                    }

                                    if ( !empty($valid_terms) ) {
                                        echo '<div class="sidebar-single">';
                                        echo '<h5 class="sidebar-title">' . esc_html( $attribute->attribute_label ) . '</h5>';
                                        echo '<div class="sidebar-body"><ul class="checkbox-container categories-list">';
                                            $counter = 1;
                                            foreach ( $valid_terms as $item ) {
                                                $input_id = 'customCheck_'. $attribute->attribute_label . $counter;
                                                $taxonomy = $attribute->attribute_name; 
                                            
                                                echo '<li>';
                                                echo '<div class="custom-control custom-checkbox">';
                                                echo '<input type="checkbox" class="custom-control-input ajax-attribute" id="'. $input_id .'" 
                                                        data-attribute="'. $taxonomy .'" value="'. $item['term']->slug .'">';
                                                echo '<label class="custom-control-label" for="'. $input_id .'">'
                                                    . esc_html( $item['term']->name ) . ' (' . $item['count'] . ')'
                                                    . '</label>';
                                                echo '</div>';
                                                echo '</li>';
                                                $counter++;
                                            }
                                        echo '</ul></div></div>';
                                    }
                                }
                            }
                        ?>

                        <?php
                            $woo_side_banner = get_field('woo_side_banner', 'option');
                            if( $woo_side_banner ) :
                                $banner_image = $woo_side_banner['banner_image'];
                                $cta_link = $woo_side_banner['cta_link'];
                                if($cta_link) {
                                    $link = $cta_link;
                                } else {
                                    $link = '#';
                                }
                                if($banner_image) :
                                    echo'<div class="sidebar-banner">
                                            <div class="img-container">
                                                <a href="'.$link.'" target="_blank">
                                                    <img src="'.$banner_image['url'].'" alt="'.$banner_image['alt'].'">
                                                </a>
                                            </div>
                                        </div>';
                                endif;
                            endif;
                        ?>
                    </aside>
                </div>

                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="shop-product-wrapper">
                        
                        <div class="shop-top-bar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a class="active" href="#" data-target="grid-view" data-bs-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></a>
                                            <a href="#" data-target="list-view" data-bs-toggle="tooltip" title="List View"><i class="fa fa-list"></i></a>
                                        </div>
                                        <?php
                                            $product_count = isset($current_cat->count) ? $current_cat->count : 0;
                                            if($product_count != 0) :
                                                if($product_count < 12) {
                                                    $count = $product_count;
                                                } else {
                                                    $count = '12';
                                                }
                                                echo '<div class="product-amount"> <p>Showing 1–'.$count.' of '.$product_count.' results</p></div>';
                                            endif;
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                    <div class="top-bar-right">
                                        <?php if($total_count != 0) : ?>
                                            <div class="product-short">
                                                <p>Sort By : </p>
                                                <select class="nice-select ajax-sort" name="sortby">
                                                    <option value="default">Relevance</option>
                                                    <option value="name-asc">Name (A - Z)</option>
                                                    <option value="name-desc">Name (Z - A)</option>
                                                    <option value="price-asc">Price (Low → High)</option>
                                                    <option value="price-desc">Price (High → Low)</option>
                                                    <option value="date-desc">Newest</option>
                                                    <option value="date-asc">Oldest</option>
                                                </select>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="shop-product-wrap grid-view row mbn-30" id="ajax-product-container">
                            <?php
                                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                                $args = array(
                                    'post_type'      => 'product',
                                    'posts_per_page' => 12,
                                    'post_status'    => 'publish',
                                    'orderby'        => 'date', 
                                    'order'          => 'DESC', 
                                    'paged'          => $paged,
                                    'tax_query'      => array(
                                        array(
                                            'taxonomy' => 'product_cat',
                                            'field'    => 'term_id',  
                                            'terms'    => $current_cat->term_id, 
                                        ),
                                    ),
                                );
                                $products = new WP_Query($args);
                                if ($products->have_posts()) : 
                                    while ($products->have_posts()) : $products->the_post(); 
                                        echo '<div class="col-md-4 col-sm-6">';
                                            get_template_part('template/product-grid-layout');
                                            get_template_part('template/product-list-layout');
                                        echo '</div>';
                                    endwhile;
                                    wp_reset_postdata();
                                else :
                                    echo '<h4 class="text-center">No products found</h4>';
                                endif; 
                            ?>     
                        </div>
                        <?php
                            if ($products->max_num_pages > 1) {
                                echo '<div id="ajax-pagination">';
                                    echo '<div class="paginatoin-area text-center">';
                                        echo '<ul class="pagination-box">';
                                        if ($paged > 1) {
                                            echo '<li><a href="#" class="ajax-page" data-page="'.($paged-1).'"><i class="pe-7s-angle-left"></i></a></li>';
                                        }
                                        for ($i = 1; $i <= $products->max_num_pages; $i++) {
                                            $active = ($i == $paged) ? 'active' : '';
                                            echo '<li class="'.$active.'">
                                                    <a href="#" class="ajax-page" data-page="'.$i.'">'.$i.'</a>
                                                </li>';
                                        }
                                        if ($paged < $products->max_num_pages) {
                                            echo '<li><a href="#" class="ajax-page" data-page="'.($paged+1).'"><i class="pe-7s-angle-right"></i></a></li>';
                                        }
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>