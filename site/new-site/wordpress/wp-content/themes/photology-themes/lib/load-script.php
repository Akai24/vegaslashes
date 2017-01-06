<?php

/**
 * @author Jegtheme
 */

function jeg_is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

function jeg_get_template_multisite_url() {
    $templateurl = apply_filters('jeg_template_multisite_url', get_template_directory_uri());
    return apply_filters('jeg_remove_http', $templateurl);
}

function jeg_get_admin_js_option() {
    global $is_IE;
    $option = array();
    $option['ajaxurl'] = apply_filters('jeg_remove_http',admin_url("admin-ajax.php"));
    $option['gacode'] = vp_option('joption.google_analytic_code');
    $option['ismobile'] = wp_is_mobile();
    $option['isie'] = $is_IE;
    $option['shareto'] = __('Share Article to','photology-themes');

    return $option;
}

function jeg_init_script() {
    global $post;
    $templateurl = jeg_get_template_multisite_url();

    if(!jeg_is_login_page()) {
        wp_enqueue_script( 'wp-mediaelement' );

        // external script
        wp_enqueue_script( 'jeg-bootstrap', $templateurl . '/public/js/external/bootstrap.js', null, JEG_VERSION, true);
        wp_enqueue_script( 'jeg-fotorama', $templateurl . '/public/js/external/fotorama.js', null, JEG_VERSION, true);
        wp_enqueue_script( 'jeg-isotope', $templateurl . '/public/js/external/jquery.isotope.min.js', null, JEG_VERSION, true);
        wp_enqueue_script( 'jeg-magnific', $templateurl . '/public/js/external/jquery.magnific-popup.min.js', null, JEG_VERSION, true);
        wp_enqueue_script( 'jeg-swipebox', $templateurl . '/public/js/external/jquery.swipebox.js', null, JEG_VERSION, true);
        wp_enqueue_script( 'jeg-plugin', $templateurl . '/public/js/external/plugin.js', null, JEG_VERSION, true);
        wp_enqueue_script( 'jeg-iosslider', $templateurl . '/public/js/external/jquery.iosslider.min.js', null, JEG_VERSION, true);

        // internal script
        wp_enqueue_script( 'jeg-common', $templateurl . '/public/js/internal/common.js', null, JEG_VERSION, true);
        wp_enqueue_script( 'jeg-gallery', $templateurl . '/public/js/internal/jquery.gallery.js', null, JEG_VERSION, true);
        wp_enqueue_script( 'jeg-normalblog', $templateurl . '/public/js/internal/jquery.jnormalblog.js', null, JEG_VERSION, true);
        wp_enqueue_script( 'jeg-single-portfolio', $templateurl . '/public/js/internal/jquery.jportfoliosingle.js', null, JEG_VERSION, true);
        wp_enqueue_script( 'jeg-masonryblog', $templateurl . '/public/js/internal/jquery.jmasonryblog.js', null, JEG_VERSION, true);
        wp_enqueue_script( 'jeg-main', $templateurl . '/public/js/internal/main.js', null, JEG_VERSION, true);

        if(is_page()) {
            $template = get_post_meta($post->ID,'_wp_page_template',true);

            if($template === 'template-contact-fullmap.php') {
                wp_enqueue_script('jeg-maps', '//maps.googleapis.com/maps/api/js?libraries=places&v=3&key=' . vp_option('joption.googlemap_key'), null, JEG_VERSION, true);
                wp_enqueue_script( 'jeg-fsmap', $templateurl . '/public/js/internal/jquery.jfsmap.js', null, JEG_VERSION, true);
                wp_enqueue_script( 'jeg-infobubble', $templateurl . '/public/js/external/infobubble.js', null, JEG_VERSION, true);
            } else if ($template === 'template-slider-ios.php') {
                wp_enqueue_script( 'jeg-fullscreenios', $templateurl . '/public/js/internal/jquery.jfullscreenios.js', null, JEG_VERSION, true);
            } else if($template === 'template-slider-kenburn.php') {
                wp_enqueue_script( 'jeg-kenburn', $templateurl . '/public/js/external/kenburn.js', null, JEG_VERSION, true);
            } else if($template === 'template-slider-service.php') {
                wp_enqueue_script( 'jeg-slitslider', $templateurl . '/public/js/external/jquery.slitslider.js', null, JEG_VERSION, true);
            } else if($template === 'template-portfolio.php') {
                wp_enqueue_script( 'jeg-portfolio', $templateurl . '/public/js/internal/jquery.jportfolio.js', null, JEG_VERSION, true);
            }
        }

        if ( is_singular() )
            wp_enqueue_script( 'comment-reply' );

        wp_localize_script('jeg-main', 'joption', jeg_get_admin_js_option());
    }
}


function jeg_get_body_background() {
    $bgobj = array();
    $bgobj['color'] 		= get_theme_mod('website_color_background');
    $bgobj['imgbg'] 		= get_theme_mod('website_image_background');

    if(ctype_digit($bgobj['imgbg']) || is_int($bgobj['imgbg'])) {
        $bgobj['imgbg'] = wp_get_attachment_image_src($bgobj['imgbg'], "full");
        $bgobj['imgbg'] = $bgobj['imgbg'][0];
    }

    $bgobj['bgvertical'] 	= get_theme_mod('website_background_vertical_position', 'center');
    $bgobj['bghorizontal'] 	= get_theme_mod('website_background_horizontal_position', 'center');
    $bgobj['bgrepeat'] 		= get_theme_mod('website_background_repeat', 'repeat');
    $bgobj['bgfullscreen'] 	= get_theme_mod('website_background_fullscreen', false);

    // alter page id
    global $post;
    $pageid = get_the_ID();

    if(vp_metabox('photology_general.override_background', null, $pageid)) {
        $bgobj = array();
        $bgobj['color'] 		= vp_metabox('photology_general.override_background_group.0.color_background', null, $pageid);
        $bgobj['imgbg'] 		= jeg_get_image_attachment(vp_metabox('photology_general.override_background_group.0.image_background', null, $pageid));
        $bgobj['bgvertical'] 	= vp_metabox('photology_general.override_background_group.0.background_vertical_position', null, $pageid);
        $bgobj['bghorizontal'] 	= vp_metabox('photology_general.override_background_group.0.background_horizontal_position', null, $pageid);
        $bgobj['bgrepeat'] 		= vp_metabox('photology_general.override_background_group.0.background_repeat', null, $pageid);
        $bgobj['bgfullscreen'] 	= vp_metabox('photology_general.override_background_group.0.background_fullscreen', null, $pageid);
    }

    return $bgobj;
}



function jeg_generate_body_background() {
    $bgobj = jeg_get_body_background();


    $css = "body { ";
    if(!empty($bgobj['color'])) $css .= "\n\tbackground-color: {$bgobj['color']};";
    if(!empty($bgobj['imgbg'])) {
        $css .= "\n\tbackground-image: url('{$bgobj['imgbg']}');";
        $css .= "\n\tbackground-position: {$bgobj['bgvertical']} {$bgobj['bghorizontal']};";
        $css .= "\n\tbackground-repeat: {$bgobj['bgrepeat']};";
        if($bgobj['bgfullscreen']) {
            $css .= "\n\tbackground-attachment: fixed;";
            $css .= "\n\tbackground-size: cover;";
        }
    }
    $css .= "\n}";
    return $css;
}

function jeg_additional_style() {
    ob_start();
    get_template_part('fragment/additionalcss');
    echo jeg_generate_body_background();
    return ob_get_clean();
}

function jeg_init_style() {
    $templateurl = jeg_get_template_multisite_url();

    if(!jeg_is_login_page()) {
        wp_enqueue_style( 'wp-mediaelement' );

        wp_enqueue_style('jeg-fontawesome', $templateurl . '/public/css/fontawesome/font-awesome.min.css', null, JEG_VERSION);
        wp_enqueue_style('jeg-plugin', $templateurl . '/public/css/plugin.css', null, JEG_VERSION);
        wp_enqueue_style('jeg-style', get_stylesheet_uri() , null, JEG_VERSION);
        wp_enqueue_style('jeg-responsive', $templateurl . '/public/css/responsive.css', null, JEG_VERSION);

        $additionalcss = jeg_additional_style();
        wp_add_inline_style( 'jeg-style',  $additionalcss);
    }
}

/** font usage  */

function jeg_build_font($fontarray) {
    $fonturl = "https://fonts.googleapis.com/css?family=";

    $fullfonturl = array();

    foreach($fontarray as $idx => $font)
    {
        $fontname = str_replace(' ', '+', $font['fontname']);
        $farray = array();

        if(!empty($font['fontstyle'])) {
            foreach($font['fontstyle'] as $fontstyle) {
                // font normal
                if($fontstyle == 'normal') $fontstyle = '';

                if(!empty($font['fontweight'])) {
                    foreach($font['fontweight'] as $fontweight) {
                        // font weight
                        if($fontweight == 'normal') $fontweight = 400;
                        $farray[] = $fontweight . $fontstyle;
                    }
                }

            }
        }

        if(empty($farray)) {
            $fullfonturl[] =  $fontname;
        } else {
            $fullfonturl[] =  $fontname . ":" . implode(',', $farray);
        }
    }

    $fullfonturl = add_query_arg( array(
        'family' =>  implode('%7C', $fullfonturl),
        'subset' => urlencode( 'latin,latin-ext' ),
    ) , "//fonts.googleapis.com/css" );
    wp_enqueue_style ('jeg_font', $fullfonturl , null, null);
}

function jeg_check_use_font_uploader($option) {
    $fontname = vp_option('joption.' . $option . '_fontname');
    if( !empty($fontname) ) {
        return true;
    }
    return false;
}

function jeg_font_setup () {
    $fontarray = array();

    // Load fonts for color scheme
    $fontarray[0] = array(
        'fontname' => 'Lato',
        'fontstyle' => array('normal', 'italic'),
        'fontweight' => array('400', '700')
    );
    $fontarray[1] = array(
        'fontname' => 'Lora',
        'fontstyle' => array('normal', 'italic'),
        'fontweight' => array('400', '700')
    );
    $fontarray[2] = array(
        'fontname' => 'Playfair Display',
        'fontstyle' => array('normal', 'italic'),
        'fontweight' => array('400', '700')
    );

    if(!jeg_check_use_font_uploader('additional_font_1')){
        $firstfont = get_theme_mod('first_font');
        if(!empty($firstfont)) {
            $fontarray[0] = array(
                'fontname' => $firstfont,
                'fontstyle' => jeg_extract_value(vp_get_gwf_style($firstfont)),
                'fontweight' => jeg_extract_value(vp_get_gwf_weight($firstfont))
            );
        }
    }

    if(!jeg_check_use_font_uploader('additional_font_2')) {
        $secondfont = get_theme_mod('second_font');
        if (!empty($secondfont)) {
            $fontarray[1] = array(
                'fontname' => $secondfont,
                'fontstyle' => jeg_extract_value(vp_get_gwf_style($secondfont)),
                'fontweight' => jeg_extract_value(vp_get_gwf_weight($secondfont))
            );
        }
    }

    if(!jeg_check_use_font_uploader('additional_font_3')){
        $thirdfont = get_theme_mod('third_font');
        if(!empty($thirdfont)) {
            $fontarray[2] = array(
                'fontname' => $thirdfont,
                'fontstyle' => jeg_extract_value(vp_get_gwf_style($thirdfont)),
                'fontweight' => jeg_extract_value(vp_get_gwf_weight($thirdfont))
            );
        }
    }

    jeg_build_font($fontarray);
}

add_action('wp_enqueue_scripts', 'jeg_init_script');
add_action('wp_enqueue_scripts', 'jeg_init_style');
add_action('wp_enqueue_scripts', 'jeg_font_setup');


/** additional javascript **/
function jeg_additional_script() {
    ?>
    <script><?php echo vp_option('joption.jseditor'); ?></script>
<?php

}

add_action('wp_footer', 'jeg_additional_script');

