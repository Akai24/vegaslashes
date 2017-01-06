<?php
$joptionglobal = null;
function jeg_theme_option() {
    global $joptionglobal;

    $dashboard_option  = jeg_dashboard_option();
    $joptionglobal  =
        new VP_Option(array(
            'is_dev_mode'           => false,
            'option_key'            => 'joption',
            'page_slug'             => 'jeg_option',
            'template'              => $dashboard_option,
            'use_auto_group_naming' => true,
            'use_util_menu'         => true,
            'menu_page'             => array(
                'icon_url'      => PHOTOLOGY_PLUGIN_URL . '/public/img/dashboard_icon.png',
                'position'      => 90
            ),
            'minimum_role'          => 'edit_theme_options',
            'layout'                => 'fixed',
            'page_title'            => 'Photology Themes Options',
            'menu_label'            => 'Photology',
        ));
}
add_action('after_setup_theme', 'jeg_theme_option');


/** import dummy panel */
function jeg_import_dummy_panel() {
    // dashboard
    add_submenu_page('jeg_option','Dashboard' ,'Dashboard' ,'edit_theme_options' ,'jeg_option');

    // customize
    add_submenu_page('jeg_option', "Import Dummy Data" , "Import Dummy Data" ,'edit_theme_options', 'jeg_import_content' , 'jeg_import_view');

    // customize
    add_submenu_page('jeg_option','Customize Style' ,'Customize Style' ,'edit_theme_options' ,'customize.php');
}
add_action('admin_menu', 'jeg_import_dummy_panel', 50);
