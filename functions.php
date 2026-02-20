<?php
if ( ! defined( '_S_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'theme_setup' ) ) :
  function theme_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
  }
endif;
add_action( 'after_setup_theme', 'theme_setup' );

/* Register menu */
    function register_my_menu() {
      register_nav_menu('header-menu',__( 'Header Menu' ));
      register_nav_menu('footer-menu',__( 'Footer menu' ));
    }
    add_action( 'init', 'register_my_menu' );
/* Register menu end */

//Disable Gutenburg Editor
    add_filter('use_block_editor_for_post', '__return_false', 10);
//Disable Gutenburg Editor end

// support SVG
    function cc_mime_types($mimes) {
      $mimes['svg'] = 'image/svg+xml';
      return $mimes;
    }
    add_filter('upload_mimes', 'cc_mime_types');
// support SVG end

/* Convert to WEBP URL*/
    function webpUrl($url) {
      if($url && strpos($url, 'uploads') !== false){
        $url = str_replace("uploads","uploads-webpc/uploads", $url);
        $url = $url . '.webp';
      }
      return $url;
    }
/* Convert to WEBP URL end*/

/* Enqueue scripts and styles.*/
function theme_scripts() {
  // css
    wp_enqueue_style( 'theme-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style('bootstrap-css',get_template_directory_uri() . '/theme_assets/css/vendors/bootstrap.min.css');
    wp_enqueue_style('pe-icon-7-stroke-css',get_template_directory_uri() . '/theme_assets/css/vendors/pe-icon-7-stroke.css');
    wp_enqueue_style('font-awesome-css',get_template_directory_uri() . '/theme_assets/css/vendors/font-awesome.min.css');
    wp_enqueue_style('slick-css',get_template_directory_uri() . '/theme_assets/css/plugins/slick.min.css');
    wp_enqueue_style('animate-css',get_template_directory_uri() . '/theme_assets/css/plugins/animate.css');
    wp_enqueue_style('nice-select-css',get_template_directory_uri() . '/theme_assets/css/plugins/nice-select.css');
    wp_enqueue_style('jqueryui-css',get_template_directory_uri() . '/theme_assets/css/plugins/jqueryui.min.css');
    wp_enqueue_style( 'theme-styles', get_template_directory_uri() . '/theme_assets/css/style.css', array(), '1.0' );
    //custom
    wp_enqueue_style( 'default-styles', get_template_directory_uri() . '/assets/css/style.min.css', array(), '1.0' );
    wp_enqueue_style( 'additional-styles', get_template_directory_uri() . '/assets/custom/css/custom.css', array(), '1.0' );
    wp_style_add_data( 'style', 'rtl', 'replace' );
  // js
    wp_enqueue_script( 'modernizr-js',get_template_directory_uri() . '/theme_assets/js/vendors/modernizr-3.6.0.min.js',array(), _S_VERSION, true );
    wp_enqueue_script( 'jquery-js', get_template_directory_uri() . '/theme_assets/js/vendors/jquery-3.6.0.min.js', array('jquery'), _S_VERSION, true );
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/theme_assets/js/vendors/bootstrap.bundle.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/theme_assets/js/plugins/slick.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'countdown-js', get_template_directory_uri() . '/theme_assets/js/plugins/countdown.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'nice-select-js', get_template_directory_uri() . '/theme_assets/js/plugins/nice-select.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'jqueryui-js', get_template_directory_uri() . '/theme_assets/js/plugins/jqueryui.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'image-zoom-js', get_template_directory_uri() . '/theme_assets/js/plugins/image-zoom.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'imagesloaded-js', get_template_directory_uri() . '/theme_assets/js/plugins/imagesloaded.pkgd.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'ajaxchimp-js', get_template_directory_uri() . '/theme_assets/js/plugins/ajaxchimp.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'ajax-mail-js', get_template_directory_uri() . '/theme_assets/js/plugins/ajax-mail.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'google-map-js', get_template_directory_uri() . '/theme_assets/js/plugins/google-map.js', array(), _S_VERSION, true );
    // custom
    wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/assets/js/main.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/assets/custom/js/custom.js', array(), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

// Disable automatic <p> and <br> tags in Contact Form 7 forms
add_filter('wpcf7_autop_or_not', '__return_false');

// custom functions
    require get_template_directory() . '/includes/custom.php';
    require get_template_directory() . '/includes/image-sizes.php';
    require get_template_directory() . '/template/product-grid-layout.php';
    require get_template_directory() . '/template/product-list-layout.php';  
    require get_template_directory() . '/includes/ajax/product-list.php';
    require get_template_directory() . '/includes/ajax/add_to_cart.php';
// custom functions end

// CPT
    require get_template_directory() . '/includes/cpt/testimonials.php'; 
// CPT end

// Remove editor for 'Page' and 'Expertises' custom post type
  // function remove_editor_for_event_cpt() {
  //   remove_post_type_support( 'expertises', 'editor' );
  //   remove_post_type_support( 'page', 'editor' );
  // }
  // add_action( 'init', 'remove_editor_for_event_cpt' );
// end

// Submenu wrapper 
class Custom_Submenu_Walker extends Walker_Nav_Menu {
  // Start the submenu
  function start_lvl( &$output, $depth = 0, $args = null ) {
    $indent = str_repeat("\t", $depth);
    $submenu_class = ($depth > 0) ? 'sub-menu inner-sub-menu' : 'sub-menu';
    // Only wrap the first submenu (depth 0)
    if ($depth === 0) {
      $output .= "\n$indent<div class=\"submenu-wrapper\"><div class=\"container\">\n";
    }
    $output .= "$indent<ul class=\"$submenu_class\">\n";
  }
  // End the submenu
  function end_lvl( &$output, $depth = 0, $args = null ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
    if ($depth === 0) {
      $output .= "$indent</div></div>\n";
    }
  }
}
// end

// Support woocommerce
function mytheme_add_woocommerce_support() {
  add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');
// end

?>