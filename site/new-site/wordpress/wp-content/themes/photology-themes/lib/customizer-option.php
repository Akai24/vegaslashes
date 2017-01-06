<?php

/*** Navigation Styling **/
function jeg_customize_general($wp_customize)
{
    new Jeg_Customizer_Framework(array(
        'name'			=> 'jeg_general_setup',
        'title'			=> 'General color setup',
        'priority' 		=> 30,
        'description'	=> 'General themes color setup'
    ), array(

        array(
            'type' 		=> 'color',
            'name' 		=> 'general_color',
            'title' 	=> 'General Text Color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'general_heading_color',
            'title' 	=> 'Heading Color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'general_link_color',
            'title' 	=> 'Link Color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'general_hover_link_color',
            'title' 	=> 'Hover Link Color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),

    ), $wp_customize);
}


/*** Logo Customize **/
function jeg_customize_logo($wp_customize)
{
    new Jeg_Customizer_Framework(array(
        'name'			=> 'jeg_customize_logo',
        'title'			=> 'Website Logo',
        'priority' 		=> 31,
        'description'	=> 'Upload your website logo'
    ), array(

        array(
            'type' 		=> 'newupload',
            'name' 		=> 'logo',
            'title' 	=> 'Logo',
            'transport' => 'refresh',
            'default' 	=> get_template_directory_uri() .'/public/img/logov3.png'
        ),
        array(
            'type' 		=> 'newupload',
            'name' 		=> 'logo_retina',
            'title' 	=> 'Logo Retina',
            'transport' => 'refresh',
            'default' 	=> get_template_directory_uri() .'/public/img/logov3@2x.png'
        ),
        array(
            'type' 		=> 'newupload',
            'name' 		=> 'logo_mobile',
            'title' 	=> 'Mobile Logo',
            'transport' => 'refresh',
            'default' 	=> get_template_directory_uri() .'/public/img/logov3-mobile.png'
        ),
        array(
            'type' 		=> 'newupload',
            'name' 		=> 'logo_mobile_retina',
            'title' 	=> 'Mobile Logo Retina',
            'transport' => 'refresh',
            'default' 	=> get_template_directory_uri() .'/public/img/logov3.png'
        ),

    ), $wp_customize);
}



/*** Layout Customize **/
function jeg_customize_layout($wp_customize)
{
    new Jeg_Customizer_Framework(array(
        'name'			=> 'jeg_customize_layout',
        'title'			=> 'Website Layout',
        'priority' 		=> 32,
        'description'	=> 'choose your website layout'
    ), array(

        array(
            'type' 		=> 'checkbox',
            'name' 		=> 'collapse_navigation',
            'title' 	=> 'Enable collapse navigation',
            'transport'	=> 'refresh',
            'default' 	=> false
        ),
        array(
            'type' 		=> 'checkbox',
            'name' 		=> 'hide_top_menu_navigation',
            'title' 	=> 'Hide Top Menu Navigation',
            'transport'	=> 'refresh',
            'default' 	=> false
        ),

    ), $wp_customize);
}

/** font setup */

function jeg_customize_font($wp_customize)
{
    $googlefont = jeg_get_google_font();
    new Jeg_Customizer_Framework(array(
        'name'			=> 'jeg_font',
        'title'			=> 'Font Switcher',
        'priority' 		=> 40,
        'description'	=> 'Switch themes font'
    ), array(
        array(
            'type' 		=> 'select',
            'name' 		=> 'first_font',
            'title' 	=> 'First section font',
            'transport'	=> 'refresh',
            'default' 	=> null,
            'choices'	=> $googlefont
        ),
        array(
            'type' 		=> 'select',
            'name' 		=> 'second_font',
            'title' 	=> 'Font for body',
            'transport'	=> 'refresh',
            'default' 	=> null,
            'choices'	=> $googlefont
        ),
        array(
            'type' 		=> 'select',
            'name' 		=> 'third_font',
            'title' 	=> 'Serif font for menu, etc',
            'transport'	=> 'refresh',
            'default' 	=> null,
            'choices'	=> $googlefont
        ),

    ), $wp_customize);
}


/** loader */


function jeg_customize_loader_ajax($wp_customize)
{
    new Jeg_Customizer_Framework(array(
        'name'			=> 'jeg_ajax_loader',
        'title'			=> 'Loading Image',
        'priority' 		=> 40,
        'description'	=> 'Change your ajax loading image'
    ), array(

        array(
            'type' 		=> 'newupload',
            'name' 		=> 'ajax_loading_big',
            'title' 	=> 'Circle big ajax loading image  (80x80px)',
            'transport' => 'refresh',
            'default' 	=> get_template_directory_uri() . '/public/img/loading.gif'
        ),

        array(
            'type' 		=> 'newupload',
            'name' 		=> 'ajax_loading_small',
            'title' 	=> 'Circle small ajax loading image  (32x32px)',
            'transport' => 'refresh',
            'default' 	=> get_template_directory_uri() . '/public/img/loader.gif'
        ),

        array(
            'type' 		=> 'newupload',
            'name' 		=> 'ajax_loading_horizontal',
            'title' 	=> 'Horizontal ajax loading image  (100x15px)',
            'transport' => 'refresh',
            'default' 	=> get_template_directory_uri() . '/public/img/horizontal-loader.gif'
        ),

    ), $wp_customize);
}

/** navigation side */


function jeg_customize_side_nav($wp_customize)
{
    new Jeg_Customizer_Framework(array(
        'name'			=> 'jeg_side_nav',
        'title'			=> 'Navigation - Main',
        'priority' 		=> 45,
        'description'	=> ''
    ), array(

        array(
            'type' 		=> 'flag',
            'name' 		=> 'jeg_top_logo_flag',
            'title' 	=> 'Side Navigation Logo'
        ),
        array(
            'type' 		=> 'slider',
            'name' 		=> 'side_nav_top_padding',
            'title' 	=> 'Logo top padding',
            'transport' => 'refresh',
            'default' 	=> 30,
            'min'		=> 0,
            'max'		=> 150,
            'step'		=> 1
        ),
        array(
            'type' 		=> 'slider',
            'name' 		=> 'side_nav_bottom_padding',
            'title' 	=> 'Logo Bottom Padding',
            'transport' => 'refresh',
            'default' 	=> 30,
            'min'		=> 0,
            'max'		=> 150,
            'step'		=> 1
        ),

        array(
            'type' 		=> 'flag',
            'name' 		=> 'jeg_side_style_flag',
            'title' 	=> 'Side Style'
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_bg',
            'title' 	=>  'Menu Background',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),

        array(
            'type' 		=> 'flag',
            'name' 		=> 'jeg_side_main_flag',
            'title' 	=> 'Main Navigation Style'
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_nav_color',
            'title' 	=>  'Side navigation color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_nav_hover_color',
            'title' 	=>  'Side navigation hover color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_nav_hover_background',
            'title' 	=>  'Side navigation hover background',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),


        array(
            'type' 		=> 'flag',
            'name' 		=> 'jeg_side_bottom_style_flag',
            'title' 	=> 'Side Bottom'
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_bottom_bg',
            'title' 	=>  'Bottom Background',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),

        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_link_color',
            'title' 	=>  'Bottom Link Color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_link_color_hover',
            'title' 	=>  'Bottom hover link color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_bottom_copyright',
            'title' 	=>  'Copyright color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_social',
            'title' 	=>  'Side social',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_social_border',
            'title' 	=>  'Side social border',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_social_hover',
            'title' 	=>  'Side social hovered',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_social_border_hovered',
            'title' 	=>  'Side social border_hovered',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_btm_link_color',
            'title' 	=>  'Bottom link color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_btm_link_color_hover',
            'title' 	=>  'Bottom link hover color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),



        array(
            'type' 		=> 'flag',
            'name' 		=> 'jeg_side_collapse',
            'title' 	=> 'Collapse side'
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_collapse_icon_color',
            'title' 	=>  'Side collapse icon color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
    ), $wp_customize);
}

/** side header option */

function jeg_customize_side_header($wp_customize)
{
    new Jeg_Customizer_Framework(array(
        'name'			=> 'jeg_side_header',
        'title'			=> 'Navigation - Header Menu',
        'priority' 		=> 50,
        'description'	=> ''
    ), array(


        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_header_bg_color',
            'title' 	=>  'Header menu background',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),


        array(
            'type' 		=> 'flag',
            'name' 		=> 'jeg_side_header_search_flag',
            'title' 	=>  'Header menu search',
        ),
        array(
            'type' 		=> 'checkbox',
            'name' 		=> 'jeg_side_header_show_search',
            'title' 	=> 'Show Search',
            'transport'	=> 'refresh',
            'default' 	=> true
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_header_search_bg_color',
            'title' 	=> 'Search background color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_header_text_color',
            'title' 	=> 'Search text color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_header_search_icon_color',
            'title' 	=> 'Search close icon color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),

        array(
            'type' 		=> 'flag',
            'name' 		=> 'jeg_side_header_menu_flag',
            'title' 	=>  'Header menu - Menu',
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_header_menu_color',
            'title' 	=> 'Menu Color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_header_menu_color_bg_active',
            'title' 	=> 'Menu Active Background Color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_header_menu_color_text_active',
            'title' 	=> 'Menu Active Text Color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),


        array(
            'type' 		=> 'flag',
            'name' 		=> 'jeg_side_header_menu_filter_flag',
            'title' 	=>  'Header menu - Menu (Filter)',
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_header_menu_drop_bg',
            'title' 	=> 'Menu drop background color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_header_menu_drop_text',
            'title' 	=> 'Menu drop text color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'jeg_side_header_menu_drop_text_hovered',
            'title' 	=> 'Menu drop text hovered color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),

    ), $wp_customize);
}

/** navigation mobile */


function jeg_customize_mobile($wp_customize)
{
    new Jeg_Customizer_Framework(array(
        'name'			=> 'jeg_mobile',
        'title'			=> 'Navigation - Mobile',
        'priority' 		=> 55,
        'description'	=> 'Please resize your window to see mobile navigation element'
    ), array(

        array(
            'type' 		=> 'color',
            'name' 		=> 'mobile_nav_bg_color',
            'title' 	=>  'Mobile navigation background color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),

        array(
            'type' 		=> 'color',
            'name' 		=> 'mobile_nav_icon_color',
            'title' 	=>  'Mobile navigation icon color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),

        // search
        array(
            'type' 		=> 'flag',
            'name' 		=> 'mobile_nav_search_flag',
            'title' 	=>  'Mobile navigation search',
        ),
        array(
            'type' 		=> 'checkbox',
            'name' 		=> 'mobile_nav_show_search',
            'title' 	=> 'Show Search',
            'transport'	=> 'refresh',
            'default' 	=> true
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'mobile_nav_search_bg_color',
            'title' 	=> 'Search background color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'mobile_nav_search_text_color',
            'title' 	=> 'Search text color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'mobile_nav_search_icon_color',
            'title' 	=> 'Search close icon color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),


        array(
            'type' 		=> 'flag',
            'name' 		=> 'mobile_nav_col_flag',
            'title' 	=>  'Collapsible Navigation',
        ),

        array(
            'type' 		=> 'color',
            'name' 		=> 'mobile_nav_col_bg_color',
            'title' 	=> 'Heading Menu Background',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'mobile_nav_col_menu_color',
            'title' 	=> 'Heading Menu color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'mobile_nav_col_list_color',
            'title' 	=> 'Normal - Menu list color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'mobile_nav_col_list_border_bottom',
            'title' 	=> 'Normal - Menu border bottom color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),


        array(
            'type' 		=> 'color',
            'name' 		=> 'mobile_nav_col_list_color_hovered',
            'title' 	=> 'Hover - Menu list color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
        array(
            'type' 		=> 'color',
            'name' 		=> 'mobile_nav_col_list_border_bottom_hovered',
            'title' 	=> 'Hover - Menu border bottom color',
            'transport'	=> 'refresh',
            'default' 	=> null,
        ),
    ), $wp_customize);
}


/** customize background */


function jeg_customize_background($wp_customize)
{
    new Jeg_Customizer_Framework(array(
        'name'			=> 'jeg_background',
        'title'			=> 'Website Background',
        'priority' 		=> 60,
        'description'	=> 'This option will only valid if you are not overwrite background option on single page'
    ), array(

        array(
            'type' 		=> 'color',
            'name' 		=> 'website_color_background',
            'title' 	=> 'Website background color',
            'transport'	=> 'refresh',
            'default' 	=> '',
        ),

        array(
            'type' 		=> 'newupload',
            'name' 		=> 'website_image_background',
            'title' 	=> 'Website Image Background',
            'transport'	=> 'refresh',
            'default' 	=> '',
        ),

        array(
            'type' 		=> 'select',
            'name' 		=> 'website_background_vertical_position',
            'title' 	=> 'Website image background vertical position',
            'transport'	=> 'refresh',
            'default' 	=> 'center',
            'choices'	=> array(
                'left'		=> 'Left',
                'center'	=> 'Center',
                'right'		=> 'Right',
            )
        ),

        array(
            'type' 		=> 'select',
            'name' 		=> 'website_background_horizontal_position',
            'title' 	=> 'Website image background horizontal position',
            'transport'	=> 'refresh',
            'default' 	=> 'center',
            'choices'	=> array(
                'top'		=> 'Top',
                'center'	=> 'Center',
                'bottom'	=> 'Bottom',
            )
        ),

        array(
            'type' 		=> 'select',
            'name' 		=> 'website_background_repeat',
            'title' 	=> 'Website image background repeat',
            'transport'	=> 'refresh',
            'default' 	=> 'repeat',
            'choices'	=> array(
                'repeat-x'		=> 'Repeat Horizontal',
                'repeat-y'		=> 'Repeat Vertical',
                'repeat'		=> 'Repeat Image',
                'no-repeat'		=> 'No Repeat'
            )
        ),

        array(
            'type' 		=> 'checkbox',
            'name' 		=> 'website_background_fullscreen',
            'title' 	=> 'Enable fullscreen background',
            'transport'	=> 'refresh',
            'default' 	=> false
        ),

    ), $wp_customize);
}