<div class="blog-post-item">
    <figure class="blog-thumb">
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
    <div class="blog-content">
        <div class="blog-meta">
            <p><?php the_time('d/m/Y'); ?></p>
        </div>
        <h5 class="blog-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h5>
    </div>
</div>