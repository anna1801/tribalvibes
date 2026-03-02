<?php 
/* Template Name: About page */ 
/* Template Post Type: page */ 
?>
<?php get_header(); ?>

    <?php get_template_part('template/breadcrumb');  ?>

    <?php
        $intro_heading = get_field('intro_heading');
        $intro_description = get_field('intro_description');
        $intro_featured_image = get_field('intro_featured_image');
        if($intro_description || $intro_featured_image) : 
    ?>
        <section class="about-us section-padding">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <?php if($intro_featured_image) : ?>
                        <div class="col-lg-5">
                            <div class="about-thumb">
                                <?php echo '<img src="'.$intro_featured_image['url'].'" alt="'.$intro_featured_image['alt'].'">'; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-lg-7">
                        <div class="about-content">
                            <?php
                                if($intro_heading) :
                                    echo '<h2 class="about-title">'.$intro_heading.'</h2>';
                                endif;
                                if($intro_description) :
                                    echo $intro_description;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if( have_rows('services') ): ?>
        <div class="choosing-area section-padding pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <?php
                                $services_title = get_field('services_title');
                                $services_description = get_field('services_description');
                                if($services_title) :
                                    echo '<h2 class="title">'.$services_title.'</h2>';
                                endif;
                                if($services_description) :
                                    echo '<p class="sub-title">'.$services_description.'</p>';
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row mbn-30 justify-content-center">
                <?php 
                    while( have_rows('services') ): the_row(); 
                        $icon = get_sub_field('icon');
                        $title = get_sub_field('title');
                        $description = get_sub_field('description');
                    ?>
                    <div class="col-lg-4 col-md-4">
                        <div class="single-choose-item text-center mb-30">
                            <i class="pe-7s-<?php echo $icon; ?>"></i>
                            <?php
                                if($title) :
                                    echo '<h4>'.$title.'</h4>';
                                endif;
                                if($description) :
                                    echo '<p>'.$description.'</p>';
                                endif;
                            ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php get_template_part('template/testimonial-slider');  ?>

<?php get_footer(); ?>