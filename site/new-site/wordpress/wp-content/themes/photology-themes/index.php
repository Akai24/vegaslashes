<?php
get_header();
?>

<div class="headermenu">
    <?php get_template_part('fragment/header-search-bar'); ?>
</div>
<div class="contentheaderspace"></div>
<div class="pagewrapper fullwidth pagecenter nosidebar">
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