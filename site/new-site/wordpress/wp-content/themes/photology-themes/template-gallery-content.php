<?php
/**
 * Template Name: Gallery - Side Content Media Gallery
 */
get_header();


if ( ! post_password_required() )
{
    the_post();
?>
    <div class="headermenu">
        <?php get_template_part('fragment/header-search-bar'); ?>
    </div> <!-- headermenu -->

<?php
    defined( 'JEG_GALLERY_PAGE' ) or define('JEG_GALLERY_PAGE', 0);

    $usemargin =  vp_metabox('photology_media_gallery.use_margin');
    $marginsize = 0;
    $additionalmarginclass = "";
    $althidetitle = vp_metabox('photology_media_gallery.photoswipe_setting.0.photoswipe_hide_title');

    $mediagallery = get_post_meta(JEG_PAGE_ID, 'photology_gallery', true);
    $limitload = vp_metabox('photology_media_gallery.load_limit', 50, JEG_PAGE_ID);

    $useisotope = 'isotopewrapper';
    $gallerylayout 	= vp_metabox('photology_media_gallery.gallery_type', null, JEG_PAGE_ID);


    $switchposition = '';
    if(vp_metabox('photology_media_gallery_side.switch_position') === '1') {
        $switchposition = 'left-media-content';
    }

    $additionalmarginclass = 'nomargin';
    if($usemargin) {
        $marginsize = vp_metabox('photology_media_gallery.margin_size');
        $paddingsize = 1 * $marginsize;
        $additionalmarginclass = "marginimg";
    }
?>
    <div class="contentheaderspace"></div>
    <div class="pagewrapper coverwidth <?php echo esc_attr ( $gallerylayout ); ?>_layout">
        <div class="pageholder row-fluid <?php echo esc_attr ( $switchposition ); ?>">

            <div class="pageholdwrapper">
                <div class="mainpage blog-normal-article span8">
                    <div class="imagelist-wrapper <?php echo esc_attr ( $additionalmarginclass ); ?>">
                        <div class="imagelist-content-wrapper" style="padding :0; margin: -<?php echo esc_attr ( $marginsize ); ?>px; margin-bottom: 10px;">
                            <div class="<?php echo esc_attr ( $useisotope ); ?>">
                                <?php get_template_part('fragment/media-gallery') ?>
                            </div>
                        </div>
                    </div>
                    <div class="galleryloadmore"><div class="galleryloaderinner"></div></div>
                    <div class="portfolioloader bigloader"></div>
                </div>
            </div>

            <div class="mainsidebar">
                <div class="mainsidebar-wrapper">
                    <div class="blog-sidebar">
                        <div class="blog-sidebar-content">
                            <div class="article-header">
                                <h2><?php the_title(); ?></h2>
                            </div> <!-- article header -->

                            <div class="article-content">
                                <?php the_content(); ?>
                            </div>	<!-- article content -->

                            <?php get_template_part('fragment/post-share'); ?>

                            <div class="clearfix"></div>
                            <?php comments_template(); ?>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

    <script>
        (function($){
            $(document).ready(function(){
                $(".imagelist-wrapper").jimggallery({
                    adminurl : '<?php echo esc_url ( admin_url("admin-ajax.php") ); ?>',
                    pageid : <?php echo esc_js (get_the_ID()) ?>,
                    totalpage : <?php echo esc_js ( floor( sizeof($mediagallery) / $limitload) + 1 ); ?>,
                    loadcount : <?php echo esc_js ( vp_metabox('photology_media_gallery.load_limit', 50) ); ?>,
                    dimension : <?php echo esc_js ( vp_metabox('photology_media_gallery.item_height', 0.6) ); ?>,
                    tiletype : "<?php echo esc_js ( vp_metabox('photology_media_gallery.gallery_type') );  ?>",
                    justifiedheight :  <?php echo esc_js ( vp_metabox('photology_media_gallery.justified_item_height', 250) ); ?>,
                    loadAnimation : "<?php echo esc_js ( vp_metabox('photology_media_gallery.load_animation', 'randomfade') ); ?>",
                    gallerysize : <?php echo esc_js ( vp_metabox('photology_media_gallery.item_width', 400) ); ?>,
                    galleryexpand : "<?php echo esc_js ( vp_metabox('photology_media_gallery.expand_mode') ); ?>",
                    margin : <?php echo esc_js( $marginsize ) ?>
                });
            });
        })(jQuery);
    </script>

<?php
} else {
    get_template_part('fragment/password-form');
}

get_footer();