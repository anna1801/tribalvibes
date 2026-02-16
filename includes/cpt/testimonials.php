<?php
/**
 * Register a custom post type called "testimonial".
 *
 * @see get_post_type_labels() for label keys.
 */
function wpdocs_codex_testimonial_new_init() {
  $labels = array(
      'name'                  => _x( 'Testimonials', 'Post type general name', 'textdomain' ),
      'singular_name'         => _x( 'Testimonial', 'Post type singular name', 'textdomain' ),
      'menu_name'             => _x( 'Testimonials', 'Admin Menu text', 'textdomain' ),
      'name_admin_bar'        => _x( 'Testimonial', 'Add New on Toolbar', 'textdomain' ),
      'add_new'               => __( 'Add New', 'textdomain' ),
      'add_new_item'          => __( 'Add New Testimonial', 'textdomain' ),
      'new_item'              => __( 'New Testimonial', 'textdomain' ),
      'edit_item'             => __( 'Edit Testimonial', 'textdomain' ),
      'view_item'             => __( 'View Testimonial', 'textdomain' ),
      'all_items'             => __( 'All Testimonials', 'textdomain' ),
      'search_items'          => __( 'Search Testimonials', 'textdomain' ),
      'parent_item_colon'     => __( 'Parent Testimonials:', 'textdomain' ),
      'not_found'             => __( 'No testimonials found.', 'textdomain' ),
      'filter_items_list'     => _x( 'Filter testimonials list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
      'items_list_navigation' => _x( 'Testimonials list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
      'items_list'            => _x( 'Testimonials list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
  );

  $args = array(
      'labels'             => $labels,
      'public'             => false,
      'publicly_queryable' => false,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'capability_type'    => 'post',
      'has_archive'        => false,
      'hierarchical'       => false,
      'menu_position'      => null,
      'menu_icon'          => 'dashicons-format-aside',
      'supports'           => array( 'title' ),
  );

  register_post_type( 'testimonials', $args );
}

add_action( 'init', 'wpdocs_codex_testimonial_new_init' );