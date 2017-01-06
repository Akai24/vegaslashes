<?php
get_header();
global $pageoption;
?>

<div class="headermenu">
    <div class="topheadertitle topleftmenu"><?php echo jeg_get_archive_title(); ?></div>
    <?php get_template_part('fragment/header-search-bar'); ?>
</div> <!-- headermenu -->
<div class="contentheaderspace"></div>
<div class="pagewrapper fullwidth pagecenter <?php echo esc_html ( $pageoption['usesidebar'] === 'withsidebar' ? 'withsidebar' : 'nosidebar' ) ; ?>">
    <div class="pageholder">
        <div class="pageholdwrapper">
            <div class="mainpage blog-normal-article">
                <?php
                if ( have_posts() )
                {
                    while ( have_posts() )
                    {
                        the_post();
                        get_template_part('fragment/normal-blog-post-summary');
                    }

                    jeg_blog_pagination();
                } else {
                    ?>
                    <div class='pageinnerwrapper postnotfound'>
                        <div class='blognormalpagingwrapper'>
                            <div class='pagetext'>
                                <span class='pagetotal'> <?php _e('Post Not Found','photology-themes'); ?> </span>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div> <!-- mainpage -->

            <?php if($pageoption['usesidebar'] === 'withsidebar') { ?>
                <div class="mainsidebar">
                    <div class="mainsidebar-wrapper">
                        <?php
                            $sidebarname = $pageoption['sidebarname'];
                            get_sidebar();
                        ?>
                    </div>
                </div>
            <?php } ?>

        </div> <!-- pageholdwrapper -->
    </div> <!-- pageholder -->
</div> <!-- pagewrapper -->

<script>
    (function($) {
        $(document).ready(function() {
            $(".mainpage").jnormalblog();
        });
    })(jQuery);
</script>

<?php
get_footer();