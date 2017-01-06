<?php
/**
 * Template Name: Blog - Normal Layout
 */
get_header();
if ( ! post_password_required() )
{
?>

<div class="headermenu">
    <?php get_template_part('fragment/header-search-bar'); ?>
</div> <!-- headermenu -->
<div class="contentheaderspace"></div>
<div class="pagewrapper fullwidth pagecenter <?php echo esc_attr ( vp_metabox('photology_normal_blog.normal_blog_layout') === 'withsidebar'  ? 'withsidebar' : 'nosidebar' ) ; ?>">
    <div class="pageholder">
        <div class="pageholdwrapper">
            <div class="mainpage blog-normal-article">
                <?php

                $paged = jeg_get_query_paged();
                $statement = array(
                    'post_type'				=> 'post',
                    'orderby'				=> "date",
                    'order'					=> "DESC",
                    'paged' 				=> $paged,
                    'posts_per_page'		=> vp_metabox('photology_blogcontent.post_perpage')
                );

                if(vp_metabox('photology_blogcontent.toggle_filtering') === '1')
                {
                    $filter = vp_metabox('photology_blogcontent.filtering_group.0');

                    if($filter['filter_type'] === 'category')
                    {
                        $statement['category__in'] = $filter['filter_category'];
                    } else if($filter['filter_type'] === 'tags')
                    {
                        $statement['tag__in'] = $filter['filter_tags'];
                    }
                }

                $query = new WP_Query($statement);

                if ( $query->have_posts() )
                {
                    while ( $query->have_posts() )
                    {
                        $query->the_post();
                        get_template_part('fragment/normal-blog-post-summary');
                    }

                    jeg_blog_pagination($query);
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
                wp_reset_postdata();
                ?>
            </div> <!-- mainpage -->


            <?php if( vp_metabox('photology_normal_blog.normal_blog_layout') === 'withsidebar') { ?>
                <div class="mainsidebar">
                    <div class="mainsidebar-wrapper">
                        <?php
                            $sidebarname = vp_metabox('photology_normal_blog.normal_blog_sidebar');
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
} else {
    get_template_part('fragment/password-form');
}
get_footer();