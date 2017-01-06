<?php
add_filter( 'excerpt_length', 'jeg_excerpt_masonry_length' );
?>

<div class="article-masonry-container">
    <article class="article-masonry-box">
        <div class="article-masonry-wrapper clearfix">
            <?php if(!post_password_required()) { ?>
                <div class="article-image">
                <?php echo jeg_get_featured_header(500); ?>
                </div>
            <?php } ?>

            <div class="clearfix article-meta"><?php echo get_the_date(); ?></div>
            <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

            <?php if ( get_the_excerpt() != "" ): ?>
                <div class="article-masonry-summary">
                    <p class="post-excerpt">
                        <?php echo get_the_excerpt() ?>
                    </p>
                    <a class="readmore" href="<?php echo esc_url ( get_permalink() ); ?>"><?php _e('Continue reading', 'photology-themes'); ?> <span class="meta-nav">&rarr;</span></a>
                </div>
            <?php endif; ?>

        </div>
    </article>
</div>
<?php
remove_filter('excerpt_length', 'jeg_excerpt_masonry_length');
?>