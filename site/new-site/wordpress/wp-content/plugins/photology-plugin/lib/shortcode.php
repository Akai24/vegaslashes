<?php
/************************
 * Load additional shortcode
 ***********************/

function jeg_load_shortcode() {
    /** General shortcode */
    new VP_ShortcodeGenerator(array(
        'name'                  => 'generalshortcode',
        'template'              => PHOTOLOGY_PLUGIN_DIR . '/lib/shortcode/general-shortcode.php',
        'modal_title'           =>  'Photology Shortocde',
        'button_title'          =>  'Photology Shortocde',
        'types'                 => array( 'post', 'page', 'portfolio' ),
        'included_pages'        => array( '' ),
        'main_image'            => PHOTOLOGY_PLUGIN_URL . '/public/img/jshortcode.png',
        'sprite_image'          => PHOTOLOGY_PLUGIN_URL . '/public/img/jshortcode.png',
    ));
}

add_action('after_setup_theme'	, 'jeg_load_shortcode');

/* Plugin Name: My TinyMCE Buttons */
add_action( 'admin_init', 'jeg_tinymce_button' );

function jeg_tinymce_button()
{
    if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) )
    {
        add_filter( 'mce_external_plugins', 'jeg_add_tinymce_button' );
    }
}

function jeg_add_tinymce_button( $plugin_array ) {
    $plugin_array['jcode'] = PHOTOLOGY_PLUGIN_URL . "/public/js/tinymce/jcode.js"  ;
    return $plugin_array;
}