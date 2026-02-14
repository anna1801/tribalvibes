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

?>