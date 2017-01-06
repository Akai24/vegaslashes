<?php
/*
	Plugin Name: Photology Plugin
	Plugin URI: http://jegtheme.com/
	Description: Mandatory Plugin for Photology
	Version: 1.0.3
	Author: Agung Bayu Iswara
	Author URI: http://jegtheme.com
	License: GPL2
*/

defined( 'PHOTOLOGY_PLUGIN_VERSION' ) 	    or define( 'PHOTOLOGY_PLUGIN_VERSION', '1.0.3' );
defined( 'PHOTOLOGY_PLUGIN_URL' ) 		    or define( 'PHOTOLOGY_PLUGIN_URL', plugins_url('photology-plugin'));
defined( 'PHOTOLOGY_PLUGIN_FILE' ) 		    or define( 'PHOTOLOGY_PLUGIN_FILE',  __FILE__ );
defined( 'PHOTOLOGY_PLUGIN_DIR' ) 		    or define( 'PHOTOLOGY_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

function photology_plugin_load()
{
    if( defined('JEG_PLUGIN_VERSION') )
    {
        require_once PHOTOLOGY_PLUGIN_DIR . '/lib/plugin-helper.php';
        require_once PHOTOLOGY_PLUGIN_DIR . '/lib/post-type.php';
        require_once PHOTOLOGY_PLUGIN_DIR . '/lib/add-remove-widget.php';
        require_once PHOTOLOGY_PLUGIN_DIR . '/lib/additional-widget.php';
        require_once PHOTOLOGY_PLUGIN_DIR . '/lib/additional-filter.php';
        require_once PHOTOLOGY_PLUGIN_DIR . '/lib/metabox-option.php';
        require_once PHOTOLOGY_PLUGIN_DIR . '/lib/init-image.php';

        // admin panel
        require_once PHOTOLOGY_PLUGIN_DIR . '/lib/admin-helper.php';
        require_once PHOTOLOGY_PLUGIN_DIR . '/lib/admin-panel.php';
        require_once PHOTOLOGY_PLUGIN_DIR . '/lib/admin-option.php';

        // post type
        require_once PHOTOLOGY_PLUGIN_DIR . '/lib/post-type.php';

        // shortcode
        require_once PHOTOLOGY_PLUGIN_DIR . '/lib/shortcode.php';
        require_once PHOTOLOGY_PLUGIN_DIR . '/lib/build-shortcode.php';
        require_once PHOTOLOGY_PLUGIN_DIR . '/lib/filter-shortcode.php';
    }
}

add_action('plugins_loaded', 'photology_plugin_load');

function photology_load_textdomain()
{
    $domain = 'photology-plugin';
    $jeg_lang_dir = dirname( plugin_basename( PHOTOLOGY_PLUGIN_FILE ) ) . '/lang/';

    // Traditional WordPress plugin locale filter
    $locale        = apply_filters( 'plugin_locale',  get_locale(), $domain );
    $mofile        = sprintf( '%1$s-%2$s.mo', $domain, $locale );

    // Setup paths to current locale file
    $mofile_local  = $jeg_lang_dir . $mofile;
    $mofile_global = WP_LANG_DIR . '/' . $domain . '/' . $mofile;


    if ( file_exists( $mofile_global ) )
    {
        load_textdomain( $domain, $mofile_global );
    } elseif ( file_exists( $mofile_local ) )
    {
        load_textdomain( $domain, $mofile_local );
    } else
    {
        load_plugin_textdomain( $domain, false, $jeg_lang_dir );
    }
}
add_action('init', 'photology_load_textdomain');