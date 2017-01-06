<?php
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
    $usemargin =  vp_metabox('photology_portfolio_sidecontent.grid.0.use_margin');
    $marginsize = 0;
    $additionalmarginclass = "";
    $althidetitle = vp_metabox('photology_portfolio_sidecontent.grid.0.photoswipe_setting.0.photoswipe_hide_title');

    $mediagallery = get_post_meta(JEG_PAGE_ID, 'photology_portfolio_media_gallery', true);
    $limitload = vp_metabox('photology_portfolio_sidecontent.load_limit', 50, JEG_PAGE_ID);

    $useisotope = 'isotopewrapper';
    $gallerylayout 	= vp_metabox('photology_portfolio_sidecontent.grid.0.gallery_type', null, JEG_PAGE_ID);

    $switchposition = '';
    if(vp_metabox('photology_portfolio_sidecontent.switch_position') === '1') {
        $switchposition = 'left-media-content';
    }

    $additionalmarginclass = 'nomargin';
    if($usemargin) {
        $marginsize = vp_metabox('photology_portfolio_sidecontent.grid.0.margin_size');
        $paddingsize = 1 * $marginsize;
        $additionalmarginclass = "marginimg";
    }
?>
<div class="contentheaderspace"></div>
<div class="pagewrapper coverwidth <?php echo esc_attr ( $gallerylayout ); ?>_layout">
    <div class="pageholder row-fluid <?php echo esc_attr ( $switchposition ); ?>">
        <div class="pageholdwrapper">

            <div class="pageholdwrapper">
                <div class="mainpage blog-normal-article span8">
                    <div class="imagelist-wrapper <?php echo esc_attr ( $additionalmarginclass ); ?>">
                        <div class="imagelist-content-wrapper" style="padding :0; margin: -<?php echo esc_attr ( $marginsize ); ?>px; margin-bottom: 10px;">
                            <div class="<?php echo esc_attr ( $useisotope ); ?>">
                                <?php get_template_part('fragment/media-gallery-portfolio') ?>
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
                                <h2><?php the_title(); ?> </h2>
                            </div> <!-- article header -->

                            <div class="article-content">
                                <?php the_content(); ?>
                            </div>	<!-- article content -->

                            <div class="portfoliosidebarmeta withcontent">
                                <ul>
                                    <?php
                                    $portfoliometa = vp_metabox('photology_portfolio_meta.portfolio_meta');
                                    foreach($portfoliometa as $meta ) :
                                        if(empty($meta['meta_content_url'])) {
                                            echo "<li><strong>" . esc_html ( $meta['meta_title'] ) . " : </strong>  <span> " . esc_html ( $meta['meta_content'] ) . " </span></li>";
                                        } else {
                                            echo "<li><strong>" . esc_html ( $meta['meta_title'] ) . " : </strong>  <span> <a target='_blank' href='" . esc_url ( $meta['meta_content_url'] ) . "'> " . esc_html ( $meta['meta_content'] ) . " </a> </span></li>";
                                        }
                                    endforeach;

                                    $enable_project_link = vp_metabox('photology_portfolio_meta.enable_project_link');
                                    if($enable_project_link) {
                                        $metatite = vp_metabox('photology_portfolio_meta.project_link.0.title');
                                        $metacontent = vp_metabox('photology_portfolio_meta.project_link.0.content');
                                        $metaurl = vp_metabox('photology_portfolio_meta.project_link.0.url');
                                        echo "<li><strong> " . esc_html ( $metatite ) . ": </strong>  <span> <a target='_blank' href='" . esc_url ( $metaurl ) . "'> " . esc_html ( $metacontent ) . " </a> </span></li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php
                            $filter = isset($_REQUEST['filter']) ? $_REQUEST['filter'] : "";

                            $currentparentid = get_post_meta($post->ID, 'portfolio_parent', true);
                            $currentlink = get_permalink($currentparentid);

                            $prevlink = jeg_next_prev_portfolio($currentparentid, $post->ID, 'prev', $filter);
                            $prevpagelink = get_permalink($prevlink);
                            if($filter !== '') $prevpagelink .= "?filter=" . $filter ;

                            $nextlink = jeg_next_prev_portfolio($currentparentid, $post->ID, 'next', $filter);
                            $nextpagelink = get_permalink($nextlink);
                            if($filter !== '') $nextpagelink .= "?filter=" . $filter ;
                            ?>
                            <div class="portfolio-single-nav">
                                <a class="slider-button" href="<?php echo esc_url ( $prevpagelink ); ?>">
                                    <span class="button-text"><i class="fa fa-angle-left singlenavicon"></i><?php _e('prev','photology-themes') ?></span>
                                </a>
                                <a class="slider-button" href="<?php echo esc_url ( $currentlink ) ?>">
                                    <span class="button-text"><i class="fa fa-bars singlenavicon"></i> <?php _e('list','photology-themes') ?></span>
                                </a>
                                <a class="slider-button" href="<?php echo esc_url ( $nextpagelink ); ?>">
                                    <span class="button-text"> <i class="fa fa-angle-right singlenavicon right"></i><?php _e('next','photology-themes') ?></span>
                                </a>
                            </div>


                            <?php get_template_part('fragment/post-share'); ?>


                            <div class="clearfix"></div>
                            <?php comments_template(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    (function($){
        $(document).ready(function(){
            $(".pageholder").jnormalblog();

            $(".imagelist-wrapper").jimggallery({
                adminurl : '<?php echo esc_url ( admin_url("admin-ajax.php") ); ?>',
                pageid : <?php echo esc_js ( get_the_ID() ); ?>,
                totalpage : <?php echo esc_js ( floor( sizeof($mediagallery) / $limitload) + 1 );; ?>,
                loadcount : <?php echo esc_js ( vp_metabox('photology_portfolio_sidecontent.load_limit', 50)); ?>,
                dimension : <?php echo esc_js ( vp_metabox('photology_portfolio_sidecontent.grid.0.item_height', 0.6)); ?>,
                tiletype : "<?php echo esc_js ( vp_metabox('photology_portfolio_sidecontent.grid.0.gallery_type')); ?>",
                justifiedheight :  <?php echo esc_js ( vp_metabox('photology_portfolio_sidecontent.grid.0.justified_item_height', 250)); ?>,
                loadAnimation : "<?php echo esc_js ( vp_metabox('photology_portfolio_sidecontent.grid.0.load_animation', 'randomfade')); ?>",
                gallerysize : <?php echo esc_js ( vp_metabox('photology_portfolio_sidecontent.grid.0.item_width', 400)); ?>,
                galleryexpand : "<?php echo esc_js ( vp_metabox('photology_portfolio_sidecontent.grid.0.expand_mode')); ?>",
                action : 'get_gallery_pagemore_portfolio',
                margin : '<?php echo esc_js ( $marginsize ) ?>'
            });
        });
    })(jQuery);
</script>
<?php
} else {
    get_template_part('fragment/password-form');
}

get_footer();
?>