<?php 
    add_action('wp_ajax_load_posts', 'load_posts_ajax');
    add_action('wp_ajax_nopriv_load_posts', 'load_posts_ajax');

    function load_posts_ajax() {
        $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $posts_per_page = 6; 
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => $posts_per_page,
            'post_status'    => 'publish',
            'orderby'        => 'date', 
            'order'          => 'DESC', 
            'paged'          => $paged,
        );

        $posts = new WP_Query($args);

        $total_posts = $posts->found_posts;
        $start = ($total_posts > 0) ? (($paged - 1) * $posts_per_page + 1) : 0;
        $end = min($paged * $posts_per_page, $total_posts);

        // posts HTML
        ob_start();
        if ($posts->have_posts()) : 
            while ($posts->have_posts()) : $posts->the_post(); 
                echo '<div class="col-md-6">';
                    get_template_part('template/blog-list-layout');
                echo '</div>';
            endwhile;
            wp_reset_postdata();
        else :
            echo '<h4 class="text-center">No posts found</h4>';
        endif; 
        $posts_html = ob_get_clean();

        // Custom pagination HTML
        ob_start();
        if ($posts->max_num_pages > 1) {
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
        }
        $pagination_html = ob_get_clean();

        $post_count_text = "Showing {$start}–{$end} of {$total_posts} results";

        wp_send_json(array(
            'posts'   => $posts_html,
            'pagination' => $pagination_html,
            'post_count' => $post_count_text,
        ));
    }

    function ajax_posts_script() {
        wp_enqueue_script('ajax-posts', get_template_directory_uri() . '/includes/ajax/js/blog-list.js', array('jquery'), null, true);
        wp_localize_script('ajax-posts', 'ajax_post_obj', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
    }
    add_action('wp_enqueue_scripts', 'ajax_posts_script');
?>