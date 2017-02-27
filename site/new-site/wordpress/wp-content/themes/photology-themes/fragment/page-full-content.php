<div <?php post_class('pageinnerwrapper') ?>>

    <div class="article-header">
        <!-- the below was added by Ayo on 2/11/2017 to inject a call to action -->
        <?php if(wp_make_link_relative(get_permalink()) != '/contact/') : ?>
            <div>Located here in Las Vegas - Call or text me at (702) 885-9551</div>
        <?php endif; ?>

        <?php if(!vp_metabox('photology_page.hide_meta')) : ?>
        <div class="meta-top">
            <span class="meta-author"><?php _e('by ', 'photology-themes'); ?> <a href="<?php echo esc_url (get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo esc_html (get_the_author()); ?></a></span>,
            <span class="meta-date"> <?php echo get_the_date(); ?></span>
            <?php if(!empty($catlink)) { ?>
                , <span class="category-meta"><?php _e('In', 'photology-themes'); ?> <?php echo esc_html ( implode(' , ', $catlink) ); ?></span>
            <?php } ?>
        </div>
        <?php endif; ?>
        <a href="<?php echo esc_url (get_permalink()) ?>"><h2><?php the_title(); ?></h2></a>
    </div>

    <div class="article-content">
        <?php the_content() ?>
        <?php wp_link_pages(array('before'=>'<div class="post-pages">'.__('Pages:','photology-themes'),'after'=>'</div>')); ?>

    </div>

    <div class="article-tag-list">
        <?php the_tags('', ' '); ?>
    </div>


    <?php
    if(!vp_metabox('photology_page.hide_sharing')) :
        get_template_part('fragment/post-share');
    endif;
    ?>

    <div class="clearfix"></div>

    <?php comments_template(); ?>

</div>