<?php
get_header();
the_post();
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
                    ?>
                    <div <?php post_class('pageinnerwrapper') ?>>
                        <div class="article-header">
                            <a href="<?php echo esc_url ( get_permalink() ) ?>"><h2><?php the_title() ; ?></h2></a>
                        </div>
                        <div class="article-content">
                            <?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>
                        </div>
                        <?php get_template_part('fragment/post-share'); ?>
                    </div>

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