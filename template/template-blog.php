<?php 
/* Template Name: Blog page */ 
/* Template Post Type: page */ 
?>
<?php get_header(); ?>

    <?php get_template_part('template/breadcrumb'); ?>

    <div class="blog-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="blog-sidebar-wrapper">

                        <?php
                            $categories = get_categories();
                            if($categories) :
                                echo '<div class="blog-sidebar">';
                                    echo '<h5 class="title">categories</h5>';
                                    echo '<ul class="blog-archive blog-category">';
                                        foreach ($categories as $category) :
                                            echo '<li><a href="'.esc_url(get_category_link($category->term_id)).'">'.esc_html($category->name).' ('.$category->count.')</a></li>'; 
                                        endforeach;
                                    echo '</ul>';
                                echo '</div>';
                            endif;
                        ?>

                        <div class="blog-sidebar">
                            <h5 class="title">Blog Archives</h5>
                            <ul class="blog-archive">
                                <?php
                                    wp_get_archives(array(
                                        'type'              => 'monthly',
                                        'show_post_count'   => true
                                    ));
                                ?>
                            </ul>
                        </div> 

                        <?php
                            $args = array(
                                'post_type'      => 'post',
                                'posts_per_page' => 3,
                                'post_status'    => 'publish',
                                'orderby'        => 'date', 
                                'order'          => 'DESC', 
                            );
                            $posts = new WP_Query($args);
                            if ($posts->have_posts()) : 
                                ?>
                                <div class="blog-sidebar">
                                    <h5 class="title">recent post</h5>
                                    <div class="recent-post">
                                        <?php
                                            while ($posts->have_posts()) : $posts->the_post(); 
                                            ?>
                                            <div class="recent-post-item">
                                                <figure class="product-thumb">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php
                                                            if (has_post_thumbnail()) {
                                                                $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                                            } else {
                                                                $image_url = get_template_directory_uri().'/assets/images/placeholder.png';
                                                            }
                                                            echo '<img src="'.$image_url.'" alt="'.get_the_title().'">';
                                                        ?>
                                                    </a>
                                                </figure>
                                                <div class="recent-post-description">
                                                    <div class="product-name">
                                                        <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                                        <p><?php the_time('F j Y'); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            endwhile;
                                            wp_reset_postdata();
                                        ?>
                                    </div>
                                </div> 
                                <?php 
                            endif; 
                        ?> 

                        <?php
                            $tags = get_tags();
                            if ($tags) :
                                echo '<div class="blog-sidebar">';
                                    echo '<h5 class="title">Tags</h5>';
                                    echo '<ul class="blog-tags">';
                                        foreach ($tags as $tag) :
                                            echo '<li><a href="' . esc_url(get_tag_link($tag->term_id)) . '">';
                                            echo esc_html($tag->name);
                                            echo '</a> </li>';
                                        endforeach;
                                    echo '</ul>';
                                echo '</div>';
                            endif;
                        ?>

                    </aside>
                </div>

                <div class="col-lg-9 order-1 order-lg-2 blog-page-list">
                    <div class="blog-item-wrapper">
                        <div class="row mbn-30" id="ajax-post-container">
                            <?php
                                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                                $args = array(
                                    'post_type'      => 'post',
                                    'posts_per_page' => 6,
                                    'post_status'    => 'publish',
                                    'orderby'        => 'date', 
                                    'order'          => 'DESC', 
                                    'paged'          => $paged,
                                );
                                $posts = new WP_Query($args);
                                if ($posts->have_posts()) : 
                                    while ($posts->have_posts()) : $posts->the_post(); 
                                        echo '<div class="col-md-6">';
                                            get_template_part('template/blog-list-layout');
                                        echo '</div>';
                                    endwhile;
                                    wp_reset_postdata();
                                else :
                                    echo '<h4 class="text-center">No post found</h4>';
                                endif; 
                            ?>  
                        </div>
                        <?php
                            if ($posts->max_num_pages > 1) :
                                echo '<div id="ajax-pagination">';
                                    echo '<div class="paginatoin-area text-center">';
                                        echo '<ul class="pagination-box">';
                                        if ($paged > 1) {
                                            echo '<li><a href="#" class="ajax-post" data-page="'.($paged-1).'"><i class="pe-7s-angle-left"></i></a></li>';
                                        }
                                        for ($i = 1; $i <= $posts->max_num_pages; $i++) {
                                            $active = ($i == $paged) ? 'active' : '';
                                            echo '<li class="'.$active.'">
                                                    <a href="#" class="ajax-post" data-page="'.$i.'">'.$i.'</a>
                                                </li>';
                                        }
                                        if ($paged < $posts->max_num_pages) {
                                            echo '<li><a href="#" class="ajax-post" data-page="'.($paged+1).'"><i class="pe-7s-angle-right"></i></a></li>';
                                        }
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>