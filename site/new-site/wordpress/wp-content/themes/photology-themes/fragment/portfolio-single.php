<?php
$query = new WP_Query(array(
    'post_type' => 'portfolio',
    'p' => JEG_PORTFOLIO_ID
));

if($query->have_posts()) :
    $query->the_post();

    if(get_post_meta(JEG_PORTFOLIO_ID, "portfolio_layout", true) == 'ajax') {
        $expandtype = vp_metabox('photology_portfolio_ajax.single_scale_mode');
    }

    $coverpage = jeg_get_image_attachment_full(get_post_meta($post->ID, "coverimage", true));
    ?>
    <div class="portfoliocontent" data-expand="<?php echo esc_html($expandtype) ?>" data-hide-title="<?php echo vp_metabox('photology_portfolio_ajax.hide_image_title'); ?>">
        <div class="portfoliocontentwrapper">
            <div class="portfolionavbar">
                <div class="portfolionavtitle"><?php echo the_title(); ?></div>
                <div class="portfolionavlist ppopup">
                    <ul>
                        <li class="portfoliolove" data-title="<?php the_title(); ?>"
                            data-cover="<?php echo esc_attr( $coverpage ); ?>"
                            data-url="<?php echo esc_url ( get_permalink($post->ID)); ?>">
                            <a href="#"><div class="navicon"></div></a>
                            <div class="portfoliopopup">
                                <div class="popuparrow"></div>
                                <div class="popuptext"><?php _e('Share this portfolio', 'photology-themes') ?></div>
                            </div>
                        </li>
                        <?php
                        $currentparentid = get_post_meta($post->ID, 'portfolio_parent', true);
                        $currentlink = get_permalink($currentparentid);

                        $prevlink = jeg_next_prev_portfolio($currentparentid, $post->ID, 'prev', JEG_CATEGORY);
                        $prevtype = get_post_meta($prevlink, "portfolio_layout", true);
                        $prevpagelink = get_permalink($prevlink);
                        if(JEG_CATEGORY !== '') $prevpagelink .= "?filter=" . JEG_CATEGORY ;

                        $nextlink = jeg_next_prev_portfolio($currentparentid, $post->ID, 'next', JEG_CATEGORY);
                        $nexttype = get_post_meta($nextlink, "portfolio_layout", true);
                        $nextpagelink = get_permalink($nextlink);
                        if(JEG_CATEGORY !== '') $nextpagelink .= "?filter=" . JEG_CATEGORY ;
                        ?>
                        <li class="portfolioprev">
                            <a href="<?php echo esc_url ($prevpagelink); ?>" data-type="<?php echo esc_attr($prevtype); ?>" data-id="<?php echo esc_attr($prevlink); ?>"><div class="navicon"></div></a>
                            <div class="portfoliopopup">
                                <div class="popuparrow"></div>
                                <div class="popuptext"><?php _e('Previous Portfolio', 'photology-themes') ?></div>
                            </div>
                        </li>
                        <li class="portfolionext">
                            <a href="<?php echo esc_url ( $nextpagelink ); ?>" data-type="<?php echo esc_attr( $nexttype ); ?>" data-id="<?php echo esc_attr($nextlink); ?>"><div class="navicon"></div></a>
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
                            <a href="<?php echo esc_url ( $currentlink ); ?>"><div class="navicon"></div></a>
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

                    <?php if(!empty($post->post_password) && empty($_REQUEST['password'])) { ?>
                        <div class="portfolio-password-overlay">
                            <div class="portfolio-passsword">
                                <div class="portfolio-form">
                                    <div class="portfolio-form-header">
                                        <h2><?php _e('Enter Your Password', 'photology-themes'); ?></h2>
                                    </div>
                                    <div class="portfolio-form-body">
                                        <input type="hidden" name="url" value="<?php echo esc_attr ( get_permalink(JEG_PORTFOLIO_ID) ); ?>">
                                        <input type="hidden" name="portfolioid" value="<?php echo esc_attr ( JEG_PORTFOLIO_ID ); ?>">
                                        <input type="password" placeholder="Password" name="password">
                                        <div>
                                            <a href="#" class="slider-button">
                                                <span class="button-text"><?php _e('Submit', 'photology-themes'); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else if(!empty($post->post_password) && ($_REQUEST['password'] != $post->post_password)) { ?>
                        <div class="portfolio-password-overlay">
                            <div class="portfolio-passsword">
                                <div class="portfolio-form">
                                    <div class="portfolio-form-header">
                                        <h2><?php _e('Wrong Password', 'photology-themes'); ?></h2>
                                    </div>
                                    <div class="portfolio-form-body">
                                        <input type="hidden" name="url" value="<?php echo esc_attr ( get_permalink(JEG_PORTFOLIO_ID) ); ?>">
                                        <input type="hidden" name="portfolioid" value="<?php echo esc_attr ( JEG_PORTFOLIO_ID ); ?>">
                                        <input type="password" placeholder="Password" name="password">
                                        <div>
                                            <a href="#" class="slider-button">
                                                <span class="button-text"><?php _e('Submit', 'photology-themes'); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <!-- slider content -->
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
                                    <?php echo apply_filters('the_content', $post->post_content); ?>
                                </div>
                                <span class="portfolio-meta-line" style=""></span>

                                <?php
                                $portfoliometa = vp_metabox('photology_portfolio_meta.portfolio_meta');
                                foreach($portfoliometa as $meta ) :
                                    if(empty($meta['meta_content_url'])) {
                                        echo
                                        "<div class='portfolio-meta nopadding'>
											<h2> " . esc_html ( $meta['meta_title'] ) . "</h2>
											<div class='portfolio-meta-desc'>
												<p>" . esc_html ( $meta['meta_content'] ) . "</p>
											</div>
										</div>";
                                    } else {
                                        echo
                                        "<div class='portfolio-meta nopadding'>
											<h2>" . esc_html ( $meta['meta_title'] ) . "</h2>
											<div class='portfolio-meta-desc'>
												<p><a target='_blank' href='" . esc_html ( $meta['meta_content_url'] ) . "'>" . esc_html ( $meta['meta_content'] ) . "</a></p>
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
                                        <a class="slider-button" target="_blank" href="<?php echo esc_url ( vp_metabox('photology_portfolio_meta.project_link.0.url') ); ?>">
                                            <span class="button-text"><?php echo esc_html ( vp_metabox('photology_portfolio_meta.project_link.0.content')); ?></span>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!-- end slider content -->
                    <?php } ?>
                </div>
            </div>

            <div class="portfoliobottombar">
                <div class="portfolionavtitle"></div>
            </div>
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
<?php
endif;
?>