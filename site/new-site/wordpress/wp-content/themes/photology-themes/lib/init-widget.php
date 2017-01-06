<?php

// add additional add button on widget
defined('JEG_WIDGET_NAME') or define('JEG_WIDGET_NAME', 'jeg-widget-list');
defined('JEG_DEFAULT_WIDGET') or define('JEG_DEFAULT_WIDGET', 'Default Widget');

/** register sidebar **/
if(!function_exists('jeg_theme_register_widget')) {
    function jeg_theme_register_widget($sidebars) {
        if($sidebars) {
            foreach($sidebars as $sidebar) {
                // normal blog sidebar
                register_sidebar(array(
                    'name'			=> $sidebar,
                    'id' 			=> $sidebar,
                    'before_widget' => '<div class="blog-sidebar %2$s" id="%1$s"><div class="blog-sidebar-content">',
                    'before_title'	=> '<div class="blog-sidebar-title"><h3>',
                    'after_title' 	=> '</h3></div>',
                    'after_widget' 	=> '</div></div>',
                ));
            }
        }
    }
}

function jeg_get_all_widget_list()
{
    $widgetlist = get_option(JEG_WIDGET_NAME) ? get_option(JEG_WIDGET_NAME) : array() ;
    $defaultwidget = array(
        JEG_DEFAULT_WIDGET
    );
    return array_merge($defaultwidget, $widgetlist);
}

function jeg_register_widget_list()
{
    $widgetlist = jeg_get_all_widget_list();
    jeg_theme_register_widget($widgetlist);
}


add_action('widgets_init', 'jeg_register_widget_list');