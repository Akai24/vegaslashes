<?php
/**
 * @author : Jegtheme
 */
get_header();
?>

<div class="headermenu">
    <?php get_template_part('fragment/header-search-bar'); ?>
</div>

<div class="contentheaderspace"></div>
<div class="pagewrapper pagecenter fullwidth nosidebar">
    <div class="pageholder">
        <div class="pageholdwrapper">
            <div class="mainpage blog-normal-article">
                <div class="pageinnerwrapper notfound">
                    <h1><?php _e("404",'photology-themes'); ?>	</h1>
                    <div class="notfoundsec">
                        <div class="notfoundtext">
                            <?php _e("It look like the page you're looking for doesn't exist, sorry",'photology-themes'); ?>
                        </div>
                        <div>
                            <form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>/">
                                <input type="text" placeholder="<?php esc_attr_e('Type and Enter to Search', 'photology-themes'); ?>" id="s" name="s" class="field">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>