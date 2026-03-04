<?php 
/* Template Name: Compare page */ 
/* Template Post Type: page */ 
?>
<?php get_header(); ?>

    <?php get_template_part('template/breadcrumb');  ?>

    <?php echo do_shortcode('[custom_compare_page]'); ?>

<?php get_footer(); ?>