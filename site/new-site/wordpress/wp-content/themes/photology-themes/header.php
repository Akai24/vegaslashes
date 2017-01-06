<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="no-js lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
</head>
<?php $additionalclass = jeg_get_additional_body_class(); ?>
<body <?php body_class($additionalclass); ?>>
    <div class="jviewport">

        <?php get_template_part('fragment/mobile-menu'); ?>

        <div class="container">
            <div class="containerwrapper">

                <?php get_template_part('fragment/mobile-header'); ?>

                <!-- left sidebar menu -->
                <div id="leftsidebar">
                    <div class="lefttop">
                        <?php get_template_part('fragment/logo-wrapper'); ?>
                        <?php jeg_main_navigation(); ?>
                    </div> <!-- lefttop -->
                    <?php get_template_part('fragment/side-foot'); ?>

                </div> <!-- #leftsidebar -->
                <!-- left sidebar menu end -->

                <div id="rightsidecontainer">
                    <div class="contentholder">
                        <div class="content">