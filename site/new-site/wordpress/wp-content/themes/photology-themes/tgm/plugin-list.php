<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.3.6
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'JPlugin',
			'slug'     				=> 'jplugin',
			'source'   				=> get_template_directory() . '/plugin/jplugin.zip',
			'required' 				=> true, 
			'version' 				=> '1.0.8',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),

        array(
            'name'     				=> 'Photology Plugin',
            'slug'     				=> 'photology-plugin',
            'source'   				=> get_template_directory() . '/plugin/photology-plugin.zip',
            'required' 				=> true,
            'version' 				=> '1.0.3',
            'force_activation' 		=> false,
            'force_deactivation' 	=> false,
        ),

        array(
            'name'                  => 'Vafpress Post Formats UI',
            'slug'                  => 'vafpress-post-formats-ui-develop',
            'source'                => get_template_directory() . '/plugin/vafpress-post-formats-ui-develop.zip',
            'required'              => true,
            'version'               => '1.5',
            'force_activation'      => false,
            'force_deactivation'    => false,
        ),

        array(
            'name' 					=> 'Simple Page Ordering',
            'slug' 					=> 'simple-page-ordering',
            'required' 				=> true,
            'force_activation' 		=> false,
        ),

        array(
            'name' 					=> 'Contact Form 7',
            'slug' 					=> 'contact-form-7',
            'required' 				=> false,
        ),

		array(
			'name' 					=> 'WP Retina 2x',
			'slug' 					=> 'wp-retina-2x',
			'required' 				=> true,
			'force_activation' 		=> false,
		),

	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'photology-themes',         	    // Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __('Install Required Plugins', 'photology-themes' ),
			'menu_title'                       			=> __('Install Plugins', 'photology-themes' ),
			'installing'                       			=> __('Installing Plugin: %s', 'photology-themes' ),
			'oops'                             			=> __('Something went wrong with the plugin API.', 'photology-themes' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'photology-themes'), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'photology-themes'), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'photology-themes'), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'photology-themes'), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' , 'photology-themes'), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'photology-themes'), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'photology-themes'), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' , 'photology-themes'), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'photology-themes' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'photology-themes' ),
			'return'                           			=> __('Return to Required Plugins Installer', 'photology-themes' ),
			'plugin_activated'                 			=> __('Plugin activated successfully.', 'photology-themes' ),
			'complete' 									=> __('All plugins installed and activated successfully. %s', 'photology-themes' ),
			'nag_type'									=> __('updated', 'photology-themes' ) // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}