<?php 
/* WordPress default template for pages */ 
?>
<?php get_header(); ?> 
    <?php if ( is_cart() || is_checkout() || is_account_page() ) : ?>
        <?php the_content(); ?>
    <?php else :?>
        <?php get_template_part('template/breadcrumb');  ?>
        <section class="policy-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="policy-list">
                            <h1 class="policy-title"><?php the_title();?></h1>
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php get_footer(); ?>