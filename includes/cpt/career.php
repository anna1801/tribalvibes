<?php
/**
 * Register a custom post type called "career".
 *
 * @see get_post_type_labels() for label keys.
 */
function wpdocs_codex_career_new_init() {
  $labels = array(
      'name'                  => _x( 'Careers', 'Post type general name', 'textdomain' ),
      'singular_name'         => _x( 'Career', 'Post type singular name', 'textdomain' ),
      'menu_name'             => _x( 'Careers', 'Admin Menu text', 'textdomain' ),
      'name_admin_bar'        => _x( 'Career', 'Add New on Toolbar', 'textdomain' ),
      'add_new'               => __( 'Add New', 'textdomain' ),
      'add_new_item'          => __( 'Add New Career', 'textdomain' ),
      'new_item'              => __( 'New Career', 'textdomain' ),
      'edit_item'             => __( 'Edit Career', 'textdomain' ),
      'view_item'             => __( 'View Career', 'textdomain' ),
      'all_items'             => __( 'All Careers', 'textdomain' ),
      'search_items'          => __( 'Search Careers', 'textdomain' ),
      'parent_item_colon'     => __( 'Parent Careers:', 'textdomain' ),
      'not_found'             => __( 'No industires found.', 'textdomain' ),
      /*
      'not_found_in_trash'    => __( 'No industires found in Trash.', 'textdomain' ),
      'featured_image'        => _x( 'Desktop Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
      'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
      'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
      'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
      'archives'              => _x( 'Career archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
      'insert_into_item'      => _x( 'Insert into Career', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
      'uploaded_to_this_item' => _x( 'Uploaded to this Career', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
      */
      'filter_items_list'     => _x( 'Filter industires list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
      'items_list_navigation' => _x( 'Careers list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
      'items_list'            => _x( 'Careers list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
  );

  $args = array(
      'labels'             => $labels,
      'public'             => false,
      'publicly_queryable' => false,
      'taxonomies'         => array('career-category'),
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      // 'rewrite'            => array( 'slug' => 'career' ),
      'capability_type'    => 'post',
      'has_archive'        => false,
      'hierarchical'       => false,
      'menu_position'      => null,
      'menu_icon'          => 'dashicons-format-aside',
      'supports'           => array( 'title', 'editor', 'author', 'excerpt', 'comments' ),
  );

  register_post_type( 'careers', $args );
}

add_action( 'init', 'wpdocs_codex_career_new_init' );


function career_category_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Categories' ),
    'all_items' => __( 'All Categories' ),
    'parent_item' => __( 'Parent Category' ),
    'parent_item_colon' => __( 'Parent Category:' ),
    'edit_item' => __( 'Edit Category' ), 
    'update_item' => __( 'Update Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Category Name' ),
    'menu_name' => __( 'Categories' ),
  );    

  register_taxonomy('career-category',array('careers'), array(
    'hierarchical' => true,
    'public'       => false,
    'publicly_queryable' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    // 'rewrite' => array( 'slug' => 'ind-category' ),
  ));
 
}

add_action( 'init', 'career_category_taxonomy', 0 );