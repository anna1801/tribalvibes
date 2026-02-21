<?php 
/* Template Name: Reviews page */ 
/* Template Post Type: page */ 
?>
<?php get_header(); ?>

    <?php get_template_part('template/breadcrumb'); ?>

    <?php $args = array(
        'post_type'      => 'testimonials',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'date', 
        'order'          => 'DESC', 
    );
    $reviews = new WP_Query($args);
    if ($reviews->have_posts()) : ?>
        <div class="choosing-area section-padding pb-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <?php
                                $title = get_field('title');
                                $description = get_field('description');
                                if($title) :
                                    echo '<h2 class="title">'.$title.'</h2>';
                                endif;
                                if($description) :
                                    echo '<p class="sub-title">'.$description.'</p>';
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section id="masonry" class="masonry testimonials-section" aria-live="polite">
            <?php 
                while ($reviews->have_posts()) : $reviews->the_post(); 
                    $name = get_the_title();
                    $profile_picture = get_field('profile_picture');
                    $location = get_field('location');
                    $reviews_desc = get_field('reviews');
                    if($reviews_desc) :
                        ?>
                        <article class="card" data-rating="4" data-author="<?php echo $name; ?>">
                            <div class="meta">
                                <?php 
                                    if($profile_picture) :
                                        echo '<div class="avatar"><img src="'.$profile_picture.'" alt="'.$name.'"></div>';
                                    endif;
                                ?>
                                <div class="person">
                                    <div class="name"><?php echo $name; ?></div>
                                    <?php 
                                        if($location) :
                                            echo '<div class="role">'.$location.'</div>';
                                        endif;
                                    ?>
                                </div>
                            </div>
                            <div class="quote"><?php echo $reviews_desc; ?></div>
                        </article>
                        <?php 
                    endif;
                endwhile; 
                wp_reset_postdata(); 
            ?>
        </section>
    <?php endif; ?>

<?php get_footer(); ?>