<?php
    $catlink = jeg_get_category_link();
    $featured = jeg_get_featured_header(1200);
?>

<div <?php post_class('pageinnerwrapper') ?>>

    <?php if($featured) : ?>
    <div class='featured'>
        <?php echo jeg_get_featured_header(1200); ?>
    </div>
    <?php endif; ?>

    <div class="article-header">

        <div class="meta-top">
            <span class="meta-author"><?php _e('by ', 'photology-themes'); ?> <a href="<?php echo esc_url ( get_author_posts_url(get_the_author_meta('ID')) ); ?>"><?php echo esc_html ( get_the_author() ); ?></a></span>,
            <span class="meta-date"> <?php echo esc_html ( get_the_date() ); ?></span>
            <?php if(!empty($catlink)) { ?>
                , <span class="category-meta"><?php _e('In', 'photology-themes'); ?> <?php echo implode(' , ', $catlink); ?></span>
            <?php } ?>
        </div>
        <a href="<?php echo esc_url ( get_permalink() ) ?>"><h2><?php the_title() ; ?></h2></a>
    </div>

    <div class="article-content">
        <?php the_content() ?>
        <?php wp_link_pages(array('before'=>'<div class="post-pages">'.__('Pages:','photology-themes'),'after'=>'</div>')); ?>

    </div>

    <div class="article-tag-list">
        <?php the_tags('', ' '); ?>
    </div>

    <?php get_template_part('fragment/post-share'); ?>

    <div class="clearfix"></div>

    <?php comments_template(); ?>

</div>