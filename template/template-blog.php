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
                    <?php get_template_part('template/blog-sidebar'); ?>
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