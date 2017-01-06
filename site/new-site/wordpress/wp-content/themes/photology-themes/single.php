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

<div class="pagewrapper fullwidth pagecenter <?php echo esc_attr( vp_option('joption.single_post_layout') === 'withsidebar' ? 'withsidebar' : 'nosidebar' ); ?>">
    <div class="pageholder">
        <div class="pageholdwrapper">

            <div class="mainpage blog-normal-article">
                <?php get_template_part('fragment/normal-blog-post-full'); ?>
            </div>

            <?php if(vp_option('joption.single_post_layout') === 'withsidebar') { ?>
                <div class="mainsidebar">
                    <div class="mainsidebar-wrapper">
                        <?php
                            $sidebarname = vp_option('joption.single_post_sidebar');
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