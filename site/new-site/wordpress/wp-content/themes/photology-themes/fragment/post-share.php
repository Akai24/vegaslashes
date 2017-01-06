<?php

if ( post_password_required() )
    return;

$featured_img = wp_get_attachment_url( get_post_thumbnail_id());
$posttitle = get_the_title();
?>
<div class="article-sharing">
    <div class="sharing-title"><h5><?php _e('Share This Article', 'photology-themes'); ?></h5></div>
    <div class="sharing-icons">
        <div class="sharing-icon sharing-facebook socials-share">
            <a data-shareto="Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo wp_get_shortlink() ?>"><i class="fa fa-facebook"></i></a>
        </div>
        <div class="sharing-icon sharing-twitter socials-share">
            <a data-shareto="Twitter" target="_blank" href="https://twitter.com/home?status=<?php echo urlencode($posttitle . ". " . esc_url( wp_get_shortlink() )); ?>"><i class="fa fa-twitter"></i></a>
        </div>
        <div class="sharing-icon sharing-google socials-share">
            <a data-shareto="Google" target="_blank" href="https://plus.google.com/share?url=<?php echo wp_get_shortlink() ?>"><i class="fa fa-google"></i></a>
        </div>
        <div class="sharing-icon sharing-pinterest socials-share">
            <a data-shareto="Pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo wp_get_shortlink() ?>&amp;media=<?php echo esc_url( $featured_img ); ?>&amp;description=<?php echo urlencode( get_the_title() ); ?>"><i class="fa fa-pinterest"></i></a>
        </div>
        <div class="sharing-icon sharing-linkedin socials-share">
            <a data-shareto="Linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo wp_get_shortlink() ?>&amp;title=<?php echo urlencode( get_the_title() ) ?>&amp;summary=<?php echo urlencode( wp_strip_all_tags( get_the_excerpt() )) ?>&amp;source=<?php echo urlencode( get_bloginfo( 'name' ) ) ?>"><i class="fa fa-linkedin"></i></a>
        </div>
    </div>
</div>