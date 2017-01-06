<?php
/**
 * Template Name: Half Page
 */
get_header();
if ( ! post_password_required() )
{
    the_post();
    ?>

    <div class="headermenu">
        <?php get_template_part('fragment/header-search-bar'); ?>
    </div>

    <div class="contentheaderspace"></div>

    <div class="pagewrapper halfwidth pageright nosidebar">
        <div class="pageholder">
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