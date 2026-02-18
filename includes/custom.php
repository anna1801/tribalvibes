<?php 
// Customize desktop header menu
class Tribal_Desktop_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = null ) {

        if ( $depth === 0 ) {
            $output .= '<ul class="megamenu dropdown">';
        } else {
            $output .= '<ul>';
        }
    }

    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );

        if ( in_array( 'menu-item-has-children', $classes ) && $depth === 0 ) {
            $class_names .= ' position-static';
        }

        if ( $depth === 1 ) {
            $class_names .= ' mega-title';
        }

        $output .= '<li class="' . esc_attr( $class_names ) . '">';

        $atts = ' href="' . esc_url( $item->url ) . '"';

        $output .= '<a' . $atts . '>';

        if ( in_array( 'menu-item-has-children', $classes ) && $depth === 0 ) {
            $output .= $item->title . ' <i class="fa fa-angle-down"></i>';
        } elseif ( $depth === 1 ) {
            $output .= '<span>' . $item->title . '</span>';
        } else {
            $output .= $item->title;
        }

        $output .= '</a>';
    }
}

// To add active class to current menu in header menu
add_filter('nav_menu_css_class', function($classes, $item) {
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active';
    }
    return $classes;
}, 10, 2);

// Customize mobile header menu
class Tribal_Mobile_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        if ($depth === 0) {
            $output .= "\n$indent<ul class=\"megamenu dropdown\">\n";
        } else {
            $output .= "\n$indent<ul class=\"dropdown\">\n";
        }
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        if ($depth === 0 && in_array('menu-item-has-children', $classes)) {
            $classes[] = 'menu-item-has-children';
        } elseif ($depth === 1) {
            $classes[] = 'mega-title';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= $indent . '<li' . $class_names . '>';

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '#';

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = esc_attr($value);
                $attributes .= " $attr=\"$value\"";
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $output .= '<a' . $attributes . '>' . $title . '</a>';
    }
    function end_el(&$output, $item, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
}

// Store Selected Attributes in Cart
add_filter( 'woocommerce_add_cart_item_data', 'add_custom_attributes_to_cart_item', 10, 3 );
function add_custom_attributes_to_cart_item( $cart_item_data, $product_id, $variation_id ) {

    $product = wc_get_product( $product_id );
    $attributes = $product->get_attributes();

    foreach ( $attributes as $attribute_name => $attribute ) {
        if ( isset( $_POST[ 'attribute_' . $attribute_name ] ) ) {
            $cart_item_data[ 'attribute_' . $attribute_name ] = sanitize_text_field( $_POST[ 'attribute_' . $attribute_name ] );
        }
    }

    return $cart_item_data;
}

// Show Attributes in Cart
add_filter( 'woocommerce_get_item_data', 'display_custom_attributes_cart', 10, 2 );
function display_custom_attributes_cart( $item_data, $cart_item ) {
    foreach ( $cart_item as $key => $value ) {
        if ( strpos( $key, 'attribute_' ) === 0 ) {
            $name = str_replace( 'attribute_', '', $key );
            $item_data[] = array(
                'key'   => wc_attribute_label( $name ),
                'value' => $value,
            );
        }
    }
    return $item_data;
}

// Change “Shipment 1” to Custom Text (Recommended) in cart page 
add_filter( 'woocommerce_shipping_package_name', 'custom_shipping_package_name', 10, 3 );
function custom_shipping_package_name( $package_name, $i, $package ) {
    return 'Shipping'; // change this to anything you want
}

// Wrap WooCommerce message content in a container
add_filter( 'woocommerce_add_message', function( $message ) {
    return '<div class="container">' . $message . '</div>';
} );
add_filter( 'woocommerce_add_error', function( $message ) {
    return '<div class="container">' . $message . '</div>';
} );
add_filter( 'woocommerce_add_notice', function( $message ) {
    return '<div class="container">' . $message . '</div>';
} );


?>