<?php
    add_filter( 'excerpt_length', 'jeg_blog_normal_excerpt_length', 999 );
    add_filter('excerpt_more', 'jeg_blog_normal_excerpt_more');

    $catlink = jeg_get_category_link();
    $featured = jeg_get_featured_header(1200, 666);
?>

<div <?php post_class('pageinnerwrapper') ?>>

    <?php if($featured) : ?>
    <div class='featured'>
        <?php echo jeg_get_featured_header(1200); ?>
    </div>
    <?php endif; ?>

    <div class="article-header">

        <?php if ( !post_password_required() ) { ?>
        <div class="meta-top">
            <span class="meta-author"><?php _e('by ', 'photology-themes'); ?> <a href="<?php echo esc_url ( get_author_posts_url(get_the_author_meta('ID')) ); ?>"><?php echo esc_html ( get_the_author() ); ?></a></span>,
            <span class="meta-date"> <?php echo get_the_date(); ?></span>
            <?php if(!empty($catlink)) { ?>
                , <span class="category-meta"><?php _e('In', 'photology-themes'); ?> <?php echo implode(' , ', $catlink); ?></span>
            <?php } ?>
        </div>
        <?php } ?>
        <a href="<?php echo esc_url ( get_permalink() ); ?>"><h2><?php the_title(); ?></h2></a>
    </div>

    <div class="article-content">
        <p class="post-excerpt">
            <?php echo get_the_excerpt() ?>
            <a class="readmore" href="<?php echo esc_html ( get_permalink() ); ?>"><?php _e('Continue reading', 'photology-themes'); ?> <span class="meta-nav">&rarr;</span></a>
        </p>
    </div>

    <div class="clearfix"></div>
</div>

<?php
    remove_filter('excerpt_length', 'jeg_blog_normal_excerpt_length');
    remove_filter('excerpt_more', 'jeg_blog_normal_excerpt_more');
?>