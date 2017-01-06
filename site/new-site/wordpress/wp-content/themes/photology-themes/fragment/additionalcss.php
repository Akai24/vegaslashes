
<?php if(get_theme_mod('general_color')) { ?>
    body { color : <?php echo get_theme_mod('general_color') ?> }
<?php } if(get_theme_mod('general_heading_color')) { ?>
    h1 , h2 , h3 , h4 , h5 , h6 { color : <?php echo get_theme_mod('general_heading_color') ?> }
<?php } if(get_theme_mod('general_link_color') ) { ?>
    a, .slide-dot.selected { color : <?php echo get_theme_mod('general_link_color') ?> }
<?php } if(get_theme_mod('general_hover_link_color') ) { ?>
    a:hover { color : <?php echo get_theme_mod('general_hover_link_color') ?> }
<?php } ?>


<?php
// first font
if(jeg_check_use_font_uploader('additional_font_1')) {
    ?>
    @font-face {
    font-family: '<?php echo vp_option('joption.additional_font_1_fontname'); ?>';
    src: url('<?php echo vp_option('joption.additional_font_1_eot'); ?>');
    src: url('<?php echo vp_option('joption.additional_font_1_eot'); ?>?#iefix') format('embedded-opentype'),
    url('<?php echo vp_option('joption.additional_font_1_woff'); ?>') format('woff'),
    url('<?php echo vp_option('joption.additional_font_1_ttf'); ?>') format('truetype'),
    url('<?php echo vp_option('joption.additional_font_1_svg'); ?>#champagne__limousinesregular') format('svg');
    }
<?php
}
if(jeg_check_use_font_uploader('additional_font_2')) {
    ?>
    @font-face {
    font-family: '<?php echo vp_option('joption.additional_font_2_fontname'); ?>';
    src: url('<?php echo vp_option('joption.additional_font_2_eot'); ?>');
    src: url('<?php echo vp_option('joption.additional_font_2_eot'); ?>?#iefix') format('embedded-opentype'),
    url('<?php echo vp_option('joption.additional_font_2_woff'); ?>') format('woff'),
    url('<?php echo vp_option('joption.additional_font_2_ttf'); ?>') format('truetype'),
    url('<?php echo vp_option('joption.additional_font_2_svg'); ?>#champagne__limousinesregular') format('svg');
    }
<?php
}
if(jeg_check_use_font_uploader('additional_font_3')) {
    ?>
    @font-face {
    font-family: '<?php echo vp_option('joption.additional_font_3_fontname'); ?>';
    src: url('<?php echo vp_option('joption.additional_font_3_eot'); ?>');
    src: url('<?php echo vp_option('joption.additional_font_3_eot'); ?>?#iefix') format('embedded-opentype'),
    url('<?php echo vp_option('joption.additional_font_3_woff'); ?>') format('woff'),
    url('<?php echo vp_option('joption.additional_font_3_ttf'); ?>') format('truetype'),
    url('<?php echo vp_option('joption.additional_font_3_svg'); ?>#champagne__limousinesregular') format('svg');
    }
<?php
}
?>

/** font setup **/

<?php
// first font
$firstfont = get_theme_mod('first_font');
if(jeg_check_use_font_uploader('additional_font_1')){
    $firstfont = vp_option('joption.additional_font_1_fontname');
}

if(!empty($firstfont)) {
    ?>
    .mobile-menu h2, .portfolioitem .info p, .portfolio-form-header > h2, .article-masonry-box .article-meta,
    .blog-normal-article .readmore, .article-masonry-summary .readmore, .blog-normal-article .meta-top,
    .mainsidebar .blog-sidebar-title h3, .article-tag-list a, .comment-meta, .mapitem .mapbutton,
    .widget_calendar thead th, .widget_tag_cloud a {
        font-family : "<?php echo esc_html($firstfont); ?>";
    }
<?php
}
// second font
$secondfont = get_theme_mod('second_font');
if(jeg_check_use_font_uploader('additional_font_2')){
    $secondfont = vp_option('joption.additional_font_2_fontname');
}

if(!empty($secondfont)) {
    ?>
    body, .infowindow .detail {
    font-family : "<?php echo esc_html($secondfont); ?>";
    }
<?php
}
// third font
$thirdfont = get_theme_mod('third_font');
if(jeg_check_use_font_uploader('additional_font_3')){
    $thirdfont = vp_option('joption.additional_font_3_fontname');
}

if(!empty($thirdfont)) {
    ?>
    input, textarea, select,
    .uneditable-input, input[type="submit"],
    button, .btn, h1, h2, h3, h4, h5, h6, .mobile-menu li a,
    .mainnav > li > a > h2, .mainnav .childmenu h2, .additionalblock p,
    .article-header h2, .article-header h1,
    .portfoliofilterbutton, .blogfilterbutton, .filterfloatbutton, .filterfloatlist h3,
    .headermenu .searchcontent input, .portfolioitem .info h2, .portfolionavtitle, .popuptext,
    .portfolio-date, .portfolio-meta-desc, .portfolio-link > span, .portfolio-single-nav > span,
    .portfoliosidebarmeta ul, .iosSlider .item, .slider-button .button-text, .kenburntextcontent.item .text1,
    .dropcaps, blockquote p, .article-masonry-wrapper h2 a, .article-normal-wrapper h2 a, .blogfilter h3,
    #comments > h2, #respond > h3, .contactheading, .article-sidebar .article-category, .notfoundtext {
        font-family : "<?php echo esc_html($thirdfont); ?>";
    }
<?php
}
?>


/** loader style **/

<?php
if(get_theme_mod('ajax_loading_big')) {
    $ajax_loading_big = get_theme_mod('ajax_loading_big');
    if(ctype_digit($ajax_loading_big) || is_int($ajax_loading_big)) {
        $ajax_loading_big = wp_get_attachment_image_src($ajax_loading_big, "full");
        $ajax_loading_big = $ajax_loading_big[0];
    }
    ?>
    .bigloader, .portfolio-content-holder, .article-slider-wrapper.loading, .mapoverlay:after, div.ps-carousel-item-loading, .mejs-overlay-loading span { background-image : url("<?php echo esc_url($ajax_loading_big) ?>"); }
<?php
}
?>

<?php
if(get_theme_mod('ajax_loading_small')) {
    $ajax_loading_small = get_theme_mod('ajax_loading_small');
    if(ctype_digit($ajax_loading_small) || is_int($ajax_loading_small)) {
        $ajax_loading_small = wp_get_attachment_image_src($ajax_loading_small, "full");
        $ajax_loading_small = $ajax_loading_small[0];
    }
    ?>
    .galleryloaderinner, div.ps-carousel-item-loading { background-image : url("<?php echo esc_url($ajax_loading_small) ?>"); }
<?php
}
?>

<?php
if(get_theme_mod('ajax_loading_horizontal') ) {
    $ajax_loading_horizontal = get_theme_mod('ajax_loading_horizontal');
    if(ctype_digit($ajax_loading_horizontal) || is_int($ajax_loading_horizontal)) {
        $ajax_loading_horizontal = wp_get_attachment_image_src($ajax_loading_horizontal, "full");
        $ajax_loading_horizontal = $ajax_loading_horizontal[0];
    }
    ?>
    .galleryloaderinner { background-image : url("<?php echo esc_url($ajax_loading_horizontal); ?>"); }
<?php
}
?>


/** side nav **/

<?php if(get_theme_mod('jeg_side_bg')) { ?>
    #leftsidebar { background-color : <?php echo get_theme_mod('jeg_side_bg') ?> }
<?php } if(get_theme_mod('jeg_side_link_color')) { ?>
    #leftsidebar a, .mainnavigation li .arrow { color : <?php echo get_theme_mod('jeg_side_link_color') ?> }
<?php } if(get_theme_mod('jeg_side_link_color_hover')) { ?>
    #leftsidebar a:hover, .mainnavigation li:hover .arrow { color : <?php echo get_theme_mod('jeg_side_link_color_hover') ?> }
<?php } ?>


<?php if(get_theme_mod('jeg_side_bottom_bg')) { ?>
    .leftfooter { background-color : <?php echo get_theme_mod('jeg_side_bottom_bg') ?> }
<?php } if(get_theme_mod('jeg_side_bottom_copyright')) { ?>
    .footcopy { color : <?php echo get_theme_mod('jeg_side_bottom_copyright') ?> }
<?php } if(get_theme_mod('jeg_side_social')) { ?>
    #leftsidebar .footsocial a i, .csbwrapper li a i { color : <?php echo get_theme_mod('jeg_side_social') ?> }
<?php } if(get_theme_mod('jeg_side_social_border')) { ?>
    #leftsidebar .footsocial a, .csbwrapper li a { border-color : <?php echo get_theme_mod('jeg_side_social_border') ?> }
<?php } if(get_theme_mod('jeg_side_social_hover')) { ?>
    #leftsidebar .footsocial a:hover i, .csbwrapper li a:hover i { color : <?php echo get_theme_mod('jeg_side_social_hover') ?> }
<?php } if(get_theme_mod('jeg_side_social_border_hovered')) { ?>
    #leftsidebar .footsocial a:hover, .csbwrapper li a:hover { border-color : <?php echo get_theme_mod('jeg_side_social_border_hovered') ?> }
<?php } if(get_theme_mod('jeg_side_btm_link_color')) { ?>
    #leftsidebar .footlink li a { color : <?php echo get_theme_mod('jeg_side_btm_link_color') ?> }
<?php } if(get_theme_mod('jeg_side_btm_link_color_hover')) { ?>
    #leftsidebar .footlink li a:hover { color : <?php echo get_theme_mod('jeg_side_btm_link_color_hover') ?> }
<?php } ?>


<?php  if(get_theme_mod('jeg_side_nav_color')) { ?>
    .mainnav > li > a > h2, .mainnav .childmenu h2, .mainnavigation li:hover .arrow
    { color : <?php echo get_theme_mod('jeg_side_nav_color'); ?>; }
<?php } if(get_theme_mod('jeg_side_nav_hover_color')) { ?>
    .mainnav > li.active > a > h2, .mainnav > li:hover > a > h2, .mainnav > li.menudown > a > h2 {
        color: <?php echo get_theme_mod('jeg_side_nav_hover_color'); ?>;
    }
<?php } if(get_theme_mod('jeg_side_nav_hover_background')) { ?>
    .mainnav > li.active > a > h2, .mainnav > li:hover > a > h2, .mainnav > li.menudown > a > h2 {
        background: <?php echo get_theme_mod('jeg_side_nav_hover_background'); ?>;
    }
<?php } ?>

<?php if(get_theme_mod('jeg_side_additional_top_border')) { ?>
    .additionalblock { border-top-color : <?php echo get_theme_mod('jeg_side_additional_top_border') ?> }
<?php } if(get_theme_mod('jeg_side_additional_bottom_border')) { ?>
    .additionalblock:last-child { border-bottom-color : <?php echo get_theme_mod('jeg_side_additional_bottom_border') ?> }
<?php } if(get_theme_mod('jeg_side_additional_title')) { ?>
    .additionalblock h3 { color : <?php echo get_theme_mod('jeg_side_additional_title') ?> }
<?php } if(get_theme_mod('jeg_side_additional_title_border')) { ?>
    .additionalblock .line { background-color : <?php echo get_theme_mod('jeg_side_additional_title_border') ?> }
<?php } if(get_theme_mod('jeg_side_additional_text_color')) { ?>
    .additionalblock { color : <?php echo get_theme_mod('jeg_side_additional_text_color') ?> }
<?php } ?>

<?php if(get_theme_mod('jeg_side_collapse_icon_color')) { ?>
    .cbsheader .csbhicon:before { color : <?php echo get_theme_mod('jeg_side_collapse_icon_color') ?> }
<?php } ?>


/** side nav header menu **/


<?php if(get_theme_mod('jeg_side_header_bg_color')) { ?>
    .headermenu { background-color : <?php echo get_theme_mod('jeg_side_header_bg_color') ?> }
<?php } if(get_theme_mod('jeg_side_header_show_search', true) === false ) { ?>
    .headermenu .searchheader { display : none; }
<?php } if(get_theme_mod('jeg_side_header_search_bg_color')) { ?>
    .headermenu .searchcontent input { background-color : <?php echo get_theme_mod('jeg_side_header_search_bg_color') ?> }
<?php } if(get_theme_mod('jeg_side_header_text_color')) { ?>
    .headermenu .searchcontent input, .closesearch i { color : <?php echo get_theme_mod('jeg_side_header_text_color') ?> }
<?php } if(get_theme_mod('jeg_side_header_search_icon_color')) { ?>
    .searchheader i { color : <?php echo get_theme_mod('jeg_side_header_search_icon_color') ?> }
<?php } ?>



<?php if(get_theme_mod('jeg_side_header_menu_color')) { ?>
    .portfoliofilterbutton, .blogfilterbutton, .headermenu .toplink li a { color : <?php echo get_theme_mod('jeg_side_header_menu_color') ?> }
<?php } if(get_theme_mod('jeg_side_header_menu_drop_bg')) { ?>
    .portfoliofilterlist, .blogfilterlist, .portfoliofilterlist ul, .blogfilterlist ul { background-color : <?php echo get_theme_mod('jeg_side_header_menu_drop_bg') ?> }
<?php } if(get_theme_mod('jeg_side_header_menu_drop_text')) { ?>
    .portfoliofilterlist li, .blogfilterlist li { color : <?php echo get_theme_mod('jeg_side_header_menu_drop_text') ?> }
<?php } if(get_theme_mod('jeg_side_header_menu_drop_text_hovered')) { ?>
    .portfoliofilterlist li:hover, .portfoliofilterlist li.active, .blogfilterlist li:hover, .blogfilterlist li.active { color : <?php echo get_theme_mod('jeg_side_header_menu_drop_text_hovered') ?> }
<?php } if(get_theme_mod('jeg_side_header_menu_color_bg_active')) { ?>
    .portfoliofilter.active .portfoliofilterbutton, .blogfilter.active .blogfilterbutton, .headermenu .toplink li.active, .headermenu .toplink li.active > a { background-color : <?php echo get_theme_mod('jeg_side_header_menu_color_bg_active') ?> }
<?php } if(get_theme_mod('jeg_side_header_menu_color_text_active')) { ?>
    .portfoliofilter.active .portfoliofilterbutton, .blogfilter.active .blogfilterbutton, .headermenu .toplink li.active, .headermenu .toplink li.active > a { color : <?php echo get_theme_mod('jeg_side_header_menu_color_text_active') ?> }
<?php } ?>


/*** Mobile navigation ***/


<?php if(get_theme_mod('mobile_nav_bg_color')) { ?>
    .responsiveheader { background-color : <?php echo get_theme_mod('mobile_nav_bg_color') ?> }
<?php } if(get_theme_mod('mobile_nav_icon_color')) { ?>
    .navleftwrapper span, .navrightwrapper span { color :  <?php echo get_theme_mod('mobile_nav_icon_color') ?> }
<?php } if(get_theme_mod('mobile_nav_show_search') === false ) { ?>
    .navright.mobile-search-trigger { display : none; }
<?php } if(get_theme_mod('mobile_nav_search_bg_color')) { ?>
    .mobilesearch input { background-color : <?php echo get_theme_mod('mobile_nav_search_bg_color') ?>  !important; }
<?php } if(get_theme_mod('mobile_nav_search_text_color')) { ?>
    .mobilesearch input { color : <?php echo get_theme_mod('mobile_nav_search_text_color') ?> }
<?php } if(get_theme_mod('mobile_nav_search_icon_color')) { ?>
    .closemobilesearch span { color : <?php echo get_theme_mod('mobile_nav_search_icon_color') ?> }
<?php } ?>

<?php if(get_theme_mod('mobile_nav_col_bg_color')) { ?>
     #main-mobile-menu { background : <?php echo get_theme_mod('mobile_nav_col_bg_color') ?> }
<?php } if(get_theme_mod('mobile_nav_col_menu_color')) { ?>
    .mobile-menu h2 { color : <?php echo get_theme_mod('mobile_nav_col_menu_color') ?> }
<?php } if(get_theme_mod('mobile_nav_col_list_color')) { ?>
    .mobile-menu li a { color :<?php echo get_theme_mod('mobile_nav_col_list_color') ?> }
<?php } if(get_theme_mod('mobile_nav_col_list_border_bottom')) { ?>
    .mobile-menu li a { border-bottom-color :<?php echo get_theme_mod('mobile_nav_col_list_border_bottom') ?> }
<?php } ?>

<?php if(get_theme_mod('mobile_nav_col_list_color_hovered')) { ?>
    .mobile-menu li a:hover, .mobile-menu li[class^='current'] > a, .mobile-menu li[class*='current_'] > a { color : <?php echo get_theme_mod('mobile_nav_col_list_color_hovered') ?> }
<?php } if(get_theme_mod('mobile_nav_col_list_border_bottom_hovered')) { ?>
    .mobile-menu li a:hover, .mobile-menu li[class^='current'] > a, .mobile-menu li[class*='current_'] > a { border-bottom-color : <?php echo get_theme_mod('mobile_nav_col_list_border_bottom_hovered') ?> }
<?php }  ?>





/*** additional css ***/
<?php echo vp_option('joption.styleeditor'); ?>