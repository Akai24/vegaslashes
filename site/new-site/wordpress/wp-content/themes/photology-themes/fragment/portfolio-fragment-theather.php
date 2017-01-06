<!-- portfolio overflow -->
<div class="portfoliooverflow">
    <div class="theatherloader bigloader"></div>
    <div class="ptcontainer">
        <div class="ptwrapper">

            <!-- wrapper container -->
            <div class="ptwrappercontainer">
                <div class="ptnavigation ppopup">
                    <ul>
                        <li class="portfoliolove" data-title="" data-cover="" data-url="">
                            <a href="#"><div class="navicon"></div></a>
                            <div class="portfoliopopup">
                                <div class="popuparrow"></div>
                                <div class="popuptext"><?php _e('Share this portfolio', 'photology-themes') ?></div>
                            </div>
                        </li>
                        <li class="portfolioprev">
                            <a href="#"><div class="navicon"></div></a>
                            <div class="portfoliopopup">
                                <div class="popuparrow"></div>
                                <div class="popuptext"><?php _e('Previous Portfolio', 'photology-themes') ?></div>
                            </div>
                        </li>
                        <li class="portfolionext">
                            <a href="#"><div class="navicon"></div></a>
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
                            <a href="#"><div class="navicon"></div></a>
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

                <!-- pt content -->
                <div class="ptcontent">
                    <div class="ptcontent-wrapper"></div>
                    <div class="portfoliobottombar"><div class="portfolionavtitle"></div></div>
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
                <!-- end of pt content -->

                <!-- pt description -->
                <div class="ptdescription">
                    <div class="ptdescription-wrapper"></div>
                </div>
                <!-- end of pt description -->
            </div>
            <!-- wrapper container end -->

            <!-- password form -->
            <div class="ptpasswordform">
                <div class="portfolio-passsword">
                    <div class="portfolio-form">
                        <div class="portfolio-form-header">
                            <h2><?php _e('Enter Your Password', 'photology-themes'); ?></h2>
                        </div>
                        <div class="portfolio-form-body">
                            <input type="hidden" value="" name="url">
                            <input type="password" name="password" placeholder="<?php esc_attr_e('Password', 'photology-themes'); ?>">
                            <input type="hidden" name="portfolioid" value="">
                            <div>
                                <a class="slider-button" href="#">
                                    <span class="button-text">Submit</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- password form end -->
        </div>
    </div>
</div>
<!-- portfolio overflow end -->

<!-- portfolio share overflow -->
<div class="pt-portfolio-share-overlay">
    <div class="share-container">
        <div class="share-close"></div>
        <div class="share-header">
            <h2><?php _e('Share Our Portfolio','photology-themes'); ?></h2>
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
<!-- end portfolio share overflow -->