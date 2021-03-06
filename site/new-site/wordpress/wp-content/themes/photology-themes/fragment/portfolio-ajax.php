<?php
get_header();

if ( ! post_password_required() )
{
    global $post;
    the_post();

    $coverpage = jeg_get_image_attachment_full(get_post_meta($post->ID, "coverimage", true));
?>

<div class="headermenu">
    <?php get_template_part('fragment/header-search-bar'); ?>
</div> <!-- headermenu -->

<div class="portfoliocontent">
    <div class="portfoliocontentwrapper">
        <div class="portfolionavbar">
            <div class="portfolionavtitle"><?php the_title(); ?></div>
            <div class="portfolionavlist ppopup">
                <ul>
                    <li class="portfoliolove" data-title="<?php esc_attr( the_title() ); ?>" data-cover="<?php echo esc_attr ($coverpage); ?>" data-url="<?php echo esc_attr (get_permalink($post->ID)); ?>">
                        <a href="#"><div class="navicon"></div></a>
                        <div class="portfoliopopup">
                            <div class="popuparrow"></div>
                            <div class="popuptext"><?php _e('Share this portfolio', 'photology-themes') ?></div>
                        </div>
                    </li>
                    <?php
                    $filter = isset($_REQUEST['filter']) ? $_REQUEST['filter'] : "";

                    $currentparentid = get_post_meta($post->ID, 'portfolio_parent', true);
                    $currentlink = get_permalink($currentparentid);

                    $prevlink = jeg_next_prev_portfolio($currentparentid, $post->ID, 'prev', $filter);
                    $prevpagelink = get_permalink($prevlink);
                    if($filter !== '') $prevpagelink .= "?filter=" . $filter ;

                    $nextlink = jeg_next_prev_portfolio($currentparentid, $post->ID, 'next', $filter);
                    $nextpagelink = get_permalink($nextlink);
                    if($filter !== '') $nextpagelink .= "?filter=" . $filter ;
                    ?>
                    <li class="portfolioprev">
                        <a href="<?php echo esc_url ($prevpagelink); ?>"><div class="navicon"></div></a>
                        <div class="portfoliopopup">
                            <div class="popuparrow"></div>
                            <div class="popuptext"><?php _e('Previous Portfolio', 'photology-themes') ?></div>
                        </div>
                    </li>
                    <li class="portfolionext">
                        <a href="<?php echo esc_url ($nextpagelink); ?>"><div class="navicon"></div></a>
                        <div class="portfoliopopup">
                            <div class="popuparrow"></div>
                            <div class="popuptext"><?php _e('Next Portfolio', 'photology-themes') ?></div>
                        </div>
                    </li>
                    <li class="portfolioinfo">
                        <a href="#"><div class="navicon"></div></a>
                        <div class="portfoliopopup">
                            <div class="popuparrow"></div>
                            <div class="popuptext"><?php _e('Portfolio Detail', 'photology-themes') ?></div>
                        </div>
                    </li>
                    <li class="portfoliozoom">
                        <a href="#"><div class="navicon"></div></a>
                        <div class="portfoliopopup">
                            <div class="popuparrow"></div>
                            <div class="popuptext"><?php _e('Change Portfolio Zoom', 'photology-themes') ?></div>
                        </div>
                    </li>
                    <li class="portfolioclose">
                        <a href="<?php echo esc_url ($currentlink); ?>"><div class="navicon"></div></a>
                        <div class="portfoliopopup">
                            <div class="popuparrow"></div>
                            <div class="popuptext"><?php _e('Portfolio List', 'photology-themes') ?></div>
                        </div>
                    </li>
                    <li class="portfoliovideoclose">
                        <a href="#"><div class="navicon"></div></a>
                        <div class="portfoliopopup">
                            <div class="popuparrow"></div>
                            <div class="popuptext"><?php _e('Close Video', 'photology-themes') ?></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="portfolioholder">
            <div class="portfolioholderwrap">

                <div class="portfolio-content-slider">
                    <div class="portfolio-slider-holder">
                        <div class="slider sliderhold">
                            <?php echo jeg_get_portfolio_featured_heading($post->ID); ?>
                        </div>

                        <div class="portfolio-navigation">
                            <div class="pt-next portfolionavnext portfolionavprevnext">
                                <span class="pt-bgarrow"></span>
                                <div class="pt-next-bg pt-next-prev-bg"></div>
                            </div>
                            <div class="pt-prev portfolionavprev portfolionavprevnext">
                                <span class="pt-bgarrow"></span>
                                <div class="pt-prev-bg pt-next-prev-bg"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portfolio-content-wrapper">
                    <div class="portfolio-content-wrapper-inner">

                        <h1><?php the_title(); ?></h1>
                        <span class="portfolio-date"><?php echo get_the_date(); ?></span>
                        <span class="portfolio-meta-line" style=""></span>
                        <div class="portfolio-meta-description">
                            <?php the_content(); ?>
                        </div>
                        <span class="portfolio-meta-line" style=""></span>

                        <?php
                        $portfoliometa = vp_metabox('photology_portfolio_meta.portfolio_meta');
                        foreach($portfoliometa as $meta ) :
                            if(empty($meta['meta_content_url'])) {
                                echo
                                "<div class='portfolio-meta nopadding'>
                                        <h2>" . esc_html( $meta['meta_title'] ) . "</h2>
                                        <div class='portfolio-meta-desc'>
                                            <p>" . esc_html($meta['meta_content'] ) . "</p>
                                        </div>
                                    </div>";
                            } else {
                                echo
                                "<div class='portfolio-meta nopadding'>
                                        <h2>" . esc_html($meta['meta_title'] ) . "</h2>
                                        <div class='portfolio-meta-desc'>
                                            <p><a target='_blank' href='" . esc_url($meta['meta_content_url']) . "'> " . esc_html($meta['meta_content']) . " </a></p>
                                        </div>
                                    </div>";
                            }

                        endforeach;
                        ?>

                        <?php
                        $enable_project_link = vp_metabox('photology_portfolio_meta.enable_project_link');
                        if($enable_project_link) {
                            ?>
                            <span class="portfolio-meta-line" style=""></span>
                            <div class="portfolio-link">
                                <span><?php echo esc_html ( vp_metabox('photology_portfolio_meta.project_link.0.title') ); ?></span>
                                <a class="slider-button" target="_blank" href="<?php echo esc_url( vp_metabox('photology_portfolio_meta.project_link.0.url') ); ?>">
                                    <span class="button-text"><?php echo esc_html ( vp_metabox('photology_portfolio_meta.project_link.0.content') ); ?></span>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if(!vp_metabox('photology_portfolio_ajax.hide_image_title')) { ?>
            <div class="portfoliobottombar">
                <div class="portfolionavtitle"></div>
            </div>
        <?php } ?>
    </div>

    <div class="portfolio-share-overlay">
        <div class="share-container">
            <div class="share-close"></div>
            <div class="share-header">
                <h2><?php _e('Share Our Portfolio', 'photology-themes') ?></h2>
            </div>
            <div class="share-body">
                <div data-id="facebook" class="share-facebook">
                    <div class="share-text"><?php _e('Share on Facebook', 'photology-themes') ?></div>
                </div>
                <div data-id="twitter" class="share-twitter">
                    <div class="share-text"><?php _e('Tweet on Twitter', 'photology-themes') ?></div>
                </div>
                <div data-id="googleplus" class="share-googleplus">
                    <div class="share-text"><?php _e('Share on Google Plus', 'photology-themes') ?></div>
                </div>
                <div data-id="pinterest" class="share-pinterest">
                    <div class="share-text"><?php _e('Pin on Pinterest', 'photology-themes') ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolioloader bigloader"></div>

<script>
    (function($){
        $(document).ready(function(){
            $(".portfoliocontent").jportfoliosingle({
                adminurl : '<?php echo esc_url ( admin_url("admin-ajax.php") ); ?>',
                imgfsmode : '<?php echo esc_js ( vp_metabox("photology_portfolio_ajax.single_scale_mode", "fit")) ; ?>'
            });
        });
    })(jQuery);
</script>

<?php
} else {
    get_template_part('fragment/password-form');
}

get_footer();
?>