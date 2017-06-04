<?php
get_header();
if ( ! post_password_required() )
{
    the_post();
?>

    <div class="headermenu">
        <?php get_template_part('fragment/header-search-bar'); ?>
    </div>

    <div class="contentheaderspace"></div>

    <div class="pagewrapper fullwidth pagecenter <?php echo esc_attr ( vp_metabox('photology_default_page.page_layout') === 'withsidebar' ? 'withsidebar' : 'nosidebar' ) ; ?>">
        <div class="pageholder">
            <?php if (has_post_thumbnail( $post->ID ) ): ?>
              <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
              <img src="<?php echo $image[0]; ?>">
            <?php endif; ?>
            <div class="pageholdwrapper">

                <div class="mainpage blog-normal-article">
                    <?php get_template_part('fragment/page-full-content'); ?>
                </div>

                <?php if(vp_metabox('photology_default_page.page_layout') === 'withsidebar') { ?>
                    <div class="mainsidebar">
                        <div class="mainsidebar-wrapper">
                            <?php
                                $sidebarname = vp_metabox('photology_default_page.page_sidebar');
                                get_sidebar();
                            ?>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

    <script>
        (function($) {
            $(document).ready(function() {
                $(".mainpage").jnormalblog();
            });
        })(jQuery);
    </script>

<?php
} else {
    get_template_part('fragment/password-form');
}
get_footer();