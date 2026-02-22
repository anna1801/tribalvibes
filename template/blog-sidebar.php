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