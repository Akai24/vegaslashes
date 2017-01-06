<?php

/*** Additional Widget **/
function jeg_is_widget_page()
{
    return in_array($GLOBALS['pagenow'], array('widgets.php'));
}

function jeg_load_widget_script()
{
    if(jeg_is_widget_page())
    {
        wp_enqueue_script('jquery');
        wp_enqueue_script('jeg-widget-js', PHOTOLOGY_PLUGIN_URL . '/public/js/widget.js', null, null);
        wp_enqueue_style ('jeg-fontawesome', PHOTOLOGY_PLUGIN_URL . '/public/css/fontawesome/font-awesome.min.css', null, null);
        wp_enqueue_style ('jeg-widget-css', PHOTOLOGY_PLUGIN_URL . '/public/css/widget.css', null, null);
    }
}

function jeg_additional_widget_button()
{
    if(jeg_is_widget_page())
    {
        echo "<a class='sidebarwidget add-new-h2'>" . 'Add or remove widget area' . "</a><div class='clearfix'></div>";
    }
}

function jeg_save_widgetlist()
{
    if(jeg_is_widget_page())
    {
        if(isset($_POST['modifwidget']))
        {
            if(isset($_POST['widgetlist']))
            {
                update_option('jeg-widget-list', $_POST['widgetlist'] );
            } else
            {
                delete_option('jeg-widget-list');
            }
        }
    }
}

function jeg_populate_widget ()
{
    $widgetlist = get_option('jeg-widget-list');
    $html = '';
    if( $widgetlist)
    {
        foreach($widgetlist as $widget)
        {
            $html .= "<li><span>" . $widget . "</span><input type='hidden' name='widgetlist[]' value='" . $widget . "'><div class='remove fa fa-ban'></div></li>";
        }
        return $html;
    }
}

function jeg_widget_admin_page()
{
    if(jeg_is_widget_page())
    {
        echo
            "<div class='widget-overlay'>
                <form method='POST'>
                    <div class='widget-overlay-wrapper'>
                        <h3>" . 'Edit widget Area'. "</h3>
                    <div class='close fa fa-times'></div>
                    <div class='widget-content-list'>
                        <div class='widget-content-wrapper'>
                            <h4>Widget Area List</h4>
                            <ul> " . jeg_populate_widget() .  "</ul>
                        </div>
                        <div class='widget-confirm'>
                            <input type='button' class='addwidget' value='" .  'Create Widget Area' . "'>
                            <input type='submit' class='savewidget' style='background-color: #5CB85C;' value='" .  'Save Widget'  . "'>
                        </div>
                    </div>
                    <div class='widget-adding-content'>
                        <div class='widget-additional'>
                            <h4>" .  'Create Widget Area' . "</h4>
                            <input type='text' class='textwidgetconfirm' placeholder='" .  'Enter name of widget'  . "'>
                        </div>
                        <div class='widget-confirm'>
                            <input type='button' class='addwidgetconfirm' value='" .  'Add Widget'  . "'>
                        </div>
                    </div>
                </div>
                <input type='hidden' name='modifwidget' value='1'/>
                " . wp_nonce_field( 'edit-widgetlist' ) . "
            </form>
        </div>";
    }
}



add_action('widgets_admin_page', 'jeg_additional_widget_button');
add_action('sidebar_admin_page', 'jeg_widget_admin_page');
add_action('after_setup_theme', 'jeg_save_widgetlist');
add_action('admin_enqueue_scripts', 'jeg_load_widget_script');