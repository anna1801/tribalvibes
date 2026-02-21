<?php 
/* WordPress default template for pages */ 
?>
<?php get_header(); ?> 
    <?php get_template_part('template/breadcrumb');  ?>
    <section class="policy-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="policy-list">
                        <h3 class="policy-title"><?php the_title();?></h3>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>