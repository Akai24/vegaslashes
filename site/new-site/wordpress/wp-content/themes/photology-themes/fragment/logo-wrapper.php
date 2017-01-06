<!-- logo -->
<?php

    $websitelogo = get_theme_mod('logo', get_template_directory_uri() .'/public/img/logov3.png');
    if(ctype_digit($websitelogo) || is_int($websitelogo)) {
        $websitelogo = wp_get_attachment_image_src($websitelogo, "full");
        $websitelogo = $websitelogo[0];
    }

    $websiteretinalogo = get_theme_mod('logo_retina', get_template_directory_uri() .'/public/img/logov3@2x.png');
    if(ctype_digit($websiteretinalogo) || is_int($websiteretinalogo)) {
        $websiteretinalogo = wp_get_attachment_image_src($websiteretinalogo, "full");
        $websiteretinalogo = $websiteretinalogo[0];
    }

    $sidenavlogoimagesize = apply_filters( 'jeg_get_image_meta', $websitelogo );
    if(is_array($sidenavlogoimagesize))
    {
        $sidenavlogoimagesize = "width : {$sidenavlogoimagesize['width']}px; height: {$sidenavlogoimagesize['height']}px;";
    }

?>
<div class="logo" style="padding-top: <?php echo esc_attr( get_theme_mod('side_nav_top_padding', 30)); ?>px; padding-bottom: <?php echo esc_attr( get_theme_mod('side_nav_bottom_padding', 30) ); ?>px;">
    <a href="<?php echo esc_url( home_url('/') ); ?>">
        <img style="<?php echo esc_html($sidenavlogoimagesize) ?>"
             data-at2x="<?php echo esc_url( $websiteretinalogo ); ?>"
             src="<?php echo esc_url( $websitelogo ); ?>"
             alt="<?php  echo esc_attr( get_bloginfo('description') );?>"/>
    </a>
</div>
<!-- logo -->