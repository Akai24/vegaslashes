<?php

/**
 * @author Jegtheme
 * Initialize All Variable
 */


/**
 * setup page id
 */

function jeg_init_page_variable() {
    global $post;
    if($post !== null) {
        if(!is_404()) {
            defined( 'JEG_PAGE_ID' ) or define('JEG_PAGE_ID', $post->ID);
            jeg_set_post_views($post->ID);
        }
    } else {
        defined( 'JEG_PAGE_ID' ) or define('JEG_PAGE_ID', 0);
    }

}

add_action('get_header', 'jeg_init_page_variable');

function jeg_init_variable()
{
    /* Initialize variable */
    defined( 'JEG_THEMENAME' ) or define("JEG_THEMENAME", 'Photology');
    defined( 'JEG_SHORTNAME' ) or define("JEG_SHORTNAME", 'plgy');
    defined( 'JEG_THEME' ) or define("JEG_THEME", 'jegtheme');

    /* Themes version */
    $themeData			= wp_get_theme();
    $themeVersion 		= trim($themeData['Version']);
    if (!$themeVersion)   $themeVersion = "1.0.0";
    define("JEG_VERSION"	, $themeVersion);

    // Content Width
    if ( ! isset( $content_width ) ) $content_width = 900;
}
jeg_init_variable();



function jeg_themes_setup() {
    // support feed link
    add_theme_support( 'automatic-feed-links' );

    // featured image

    add_theme_support( 'post-thumbnails' );

    // title tag
    add_theme_support( 'title-tag' );

    // post format
    add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );
}

add_action( 'after_setup_theme', 'jeg_themes_setup' );

/**
 * Load Languages
 */
function jeg_tb_load_textdomain()
{
    load_theme_textdomain('photology-themes', get_template_directory() . '/lang/');
}
add_action('after_setup_theme', 'jeg_tb_load_textdomain');

