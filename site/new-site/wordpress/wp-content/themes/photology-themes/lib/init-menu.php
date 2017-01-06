<?php

/**
 * @author : Jegtheme
 */


/** register support for wordpress menu **/
add_action('after_setup_theme', 'jeg_register_menu');

function jeg_register_menu() {
    add_theme_support( 'menus' );
    if(function_exists('register_nav_menu')):
        register_nav_menus(array(
            'navigation' => 'Navigation',
            'mobile_navigation' => 'Mobile Navigation',
        ));
    endif;
};


function jeg_mobile_navigation() {
    if(function_exists('wp_nav_menu')) {
        wp_nav_menu(
            array(
                'theme_location' => 'mobile_navigation',
                'container' => false,
                'menu_class' => '',
                'depth' => 3,
                'fallback_cb'     => ''
            )
        );
    }
}



/******************************************************************
 * Main side navigation
 ******************************************************************/

function jeg_main_navigation() {
    if(function_exists('wp_nav_menu')) {
        wp_nav_menu(
            array(
                'theme_location' => 'navigation',
                'container' => 'div',
                'container_class' => 'mainnavigation',
                'menu_class' => 'mainnav',
                'depth' => 3,
                'walker' => new jeg_navigation_walker(),
                'fallback_cb'     => ''
            )
        );
    }
}

class jeg_navigation_walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = Array(), $current_object_id = 0)
    {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'bgnav';

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . '<h2>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</h2>' ;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"childmenu\">\n";
    }
}
