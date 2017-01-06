<!-- responsive header / mobile header -->
<?php

$mobilelogo = get_theme_mod('logo_mobile', get_template_directory_uri() .'/public/img/logov3-mobile.png');
if(ctype_digit($mobilelogo) || is_int($mobilelogo)) {
    $mobilelogo = wp_get_attachment_image_src($mobilelogo, "full");
    $mobilelogo = $mobilelogo[0];
}
$mobileretinalogo = get_theme_mod('logo_mobile_retina', get_template_directory_uri() .'/public/img/logov3.png');
if(ctype_digit($mobileretinalogo) || is_int($mobileretinalogo)) {
    $mobileretinalogo = wp_get_attachment_image_src($mobileretinalogo, "full");
    $mobileretinalogo = $mobileretinalogo[0];
}

?>
<div class="responsiveheader mobile-header">
    <div class="navleft mobile-menu-trigger" data-role="main-mobile-menu">
        <div class="navleftinner">
            <div class="navleftwrapper"><span class="iconlist"></span></div>
        </div>
    </div>
    <div class="logo">
        <a href="<?php echo esc_url ( home_url('/') ); ?>">
            <img data-at2x="<?php echo esc_url ( $mobileretinalogo ); ?>"
                 src="<?php echo esc_url ( $mobilelogo ); ?>"
                 alt="<?php echo esc_attr ( get_bloginfo('description') ) ?>"/>
        </a>
    </div>
    <div class="navright mobile-search-trigger">
        <div class="navrightinner">
            <div class="navrightwrapper"><span class="iconlist"></span></div>
        </div>
    </div>
    <div class="mobilesearch">
        <form method="get" class="search-form" action="<?php echo esc_url ( home_url('/') ); ?>/">
            <input type="text" autocomplete="off" name="s" placeholder="<?php esc_attr_e('Type and Enter to Search', 'photology-themes'); ?>">
        </form>
        <div class="closemobilesearch">
            <span class="fa fa-times"></span>
        </div>
    </div>
</div> <!-- .responsiveheader -->
<div class="responsiveheader-wrapper responsive-heaeder-filler"></div>
<!-- responsive header -->