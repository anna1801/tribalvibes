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