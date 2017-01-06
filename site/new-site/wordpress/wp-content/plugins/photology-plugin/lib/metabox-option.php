<?php

/********** page metabox *****************/

function jeg_pagemetabox_setup ()
{
    // blog & page
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/normal-page-metabox.php');
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/normal-blog-metabox.php');
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/masonry-blog-metabox.php');
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/blog-filter-metabox.php');
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/default-page-metabox.php');
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/portfolio-metabox.php');
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/contact-metabox-fullmap.php');

    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/page-option-metabox.php');

    // gallery
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/media-gallery-side-metabox.php');
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/media-gallery-metabox.php');

    // slider
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/kenburn-metabox.php');
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/ios-metabox.php');
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/slider-content-metabox.php');
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/service-slider-metabox.php');
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/slider-gallery-metabox.php');
}

add_action('after_setup_theme', 'jeg_pagemetabox_setup');

function load_additional_script_for_page()
{
    $screen = get_current_screen();
    if($screen->post_type === 'page' && is_admin())
    {
        wp_enqueue_script('jquery');
        wp_enqueue_script('jeg-page-metabox', PHOTOLOGY_PLUGIN_URL . '/public/js/pagemetabox.js', null, null);
        wp_enqueue_style('jeg-page-metabox', PHOTOLOGY_PLUGIN_URL . '/public/css/pagemetabox.css', null, null);
    }
}

add_action('current_screen', 'load_additional_script_for_page');


/********** portfolio metabox *****************/


function jeg_portfolio_metabox_setup()
{
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/portfolio-meta-metabox.php');
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/portfolio-setting-metabox.php');
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/portfolio-single-ajax-metabox.php');
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/portfolio-side-content-metabox.php');
    new VP_Metabox(PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/portfolio-link-metabox.php');
}


add_action('after_setup_theme', 'jeg_portfolio_metabox_setup');

function load_additional_script_for_portfolio() {
    $screen = get_current_screen();
    if($screen->post_type === 'portfolio' && is_admin()) {
        wp_enqueue_script('jquery');
        wp_enqueue_script('jeg-portfolio-metabox', PHOTOLOGY_PLUGIN_URL . '/public/js/portfoliometabox.js', null, null);

        $option = array();
        $postid = jeg_get_post_id();
        $option['portfoliolayout'] = get_post_meta($postid, 'portfolio_layout', true);
        wp_localize_script('jeg-portfolio-metabox', 'jpageoption', $option);

        wp_enqueue_style ('jeg-blog-css', PHOTOLOGY_PLUGIN_URL . '/public/css/portfoliometabox.css', null, null);
    }
}

add_action('current_screen', 'load_additional_script_for_portfolio');

/***
 * Gallery - Metabox
 */
function jeg_gallery_metabox_setup()
{
    require_once PHOTOLOGY_PLUGIN_DIR . '/lib/metabox/gallery-metabox.php';
}
add_action('after_setup_theme', 'jeg_gallery_metabox_setup');
