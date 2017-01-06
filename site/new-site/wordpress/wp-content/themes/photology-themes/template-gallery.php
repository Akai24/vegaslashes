<?php
/**
 * Template Name: Gallery - Media Gallery
 */
get_header();

if ( ! post_password_required() )
{
?>
    <div class="headermenu">
        <?php get_template_part('fragment/header-search-bar'); ?>
    </div> <!-- headermenu -->

    <?php
    defined( 'JEG_GALLERY_PAGE' ) or define('JEG_GALLERY_PAGE', 0);

    $usemargin =  vp_metabox('photology_media_gallery.use_margin');
    $marginsize = 0;
    $additionalmarginclass = "";
    $paddingsize = '';

    $mediagallery = get_post_meta(JEG_PAGE_ID, 'photology_gallery', true);
    $limitload = vp_metabox('photology_media_gallery.load_limit', 50, JEG_PAGE_ID);
    $gallerylayout 	= vp_metabox('photology_media_gallery.gallery_type', null, JEG_PAGE_ID);

    if($usemargin) {
        $marginsize = vp_metabox('photology_media_gallery.margin_size');
        $paddingsize = 1 * $marginsize;
        $additionalmarginclass = "marginimg";
    }
    ?>

    <div class="imagelist-wrapper <?php echo esc_attr( $additionalmarginclass ); ?> <?php echo esc_attr ( $gallerylayout ); ?>_layout">
        <div class="contentheaderspace"></div>
        <div class="imagelist-content-wrapper" style="<?php echo "padding: " . esc_attr( $paddingsize ) . "px"; ?>">
            <div class="isotopewrapper">
                <?php get_template_part('fragment/media-gallery') ?>
            </div>
        </div>
    </div>


    <?php
    $overrideoverlay =  vp_metabox('photology_media_gallery.override_overlay');
    $bgimage = '';
    if($overrideoverlay) {
        $colorarray = vp_metabox('photology_media_gallery.gallery_overlay.0.color');
        if(vp_metabox('photology_media_gallery.gallery_overlay.0.dark_sign')) {
            $bgimage = "background-image: url('" . get_template_directory_uri() . "/public/img/white-zoom.png');";
        }
        ?>
        <style>
            .imggalitem .galoverlay, .imggalitem .videooverlay {
                background-color: <?php echo esc_html( $colorarray ); ?>;
            <?php echo esc_html($bgimage); ?>
            }
        </style>
    <?php
    }
    ?>


    <div class="galleryloadmore"><div class="galleryloaderinner"></div></div>
    <div class="portfolioloader bigloader"></div>
    <script>
        (function($){
            $(document).ready(function(){
                $(".imagelist-wrapper").jimggallery({
                    adminurl : '<?php echo esc_url ( admin_url("admin-ajax.php") ); ?>',
                    pageid : <?php echo esc_js ( get_the_ID() ); ?>,
                    totalpage : <?php echo esc_js ( floor( sizeof($mediagallery) / $limitload) + 1 ); ?>,
                    loadcount : <?php echo esc_js ( vp_metabox('photology_media_gallery.load_limit', 50) ); ?>,
                    dimension : <?php echo esc_js ( vp_metabox('photology_media_gallery.item_height', 0.6) ); ?>,
                    tiletype : "<?php echo esc_js ( vp_metabox('photology_media_gallery.gallery_type') );  ?>",
                    justifiedheight :  <?php echo esc_js ( vp_metabox('photology_media_gallery.justified_item_height', 250) ); ?>,
                    loadAnimation : "<?php echo esc_js ( vp_metabox('photology_media_gallery.load_animation', 'randomfade') ); ?>",
                    gallerysize : <?php echo esc_js ( vp_metabox('photology_media_gallery.item_width', 400) ); ?>,
                    galleryexpand : "<?php echo esc_js ( vp_metabox('photology_media_gallery.expand_mode') ); ?>",
                    margin : '<?php echo esc_js ( $marginsize ); ?>'
                });
            });
        })(jQuery);
    </script>



<?php
} else {
    get_template_part('fragment/password-form');
}
get_footer();