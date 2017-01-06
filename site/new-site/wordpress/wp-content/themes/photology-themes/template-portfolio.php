<?php
/**
 * Template Name: Portfolio List
 */
get_header();

if ( ! post_password_required() )
{
    $category = jeg_get_all_portfolio_category(JEG_PAGE_ID);
    $query = new WP_Query(array(
        'post_type' => 'portfolio',
        'meta_query' => array(
            array(
                'key' => 'portfolio_parent',
                'value' => array(JEG_PAGE_ID),
                'compare' => 'IN',
            )
        ),
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'posts_per_page' => vp_metabox('photology_portfolio_list.load_limit'),
        'paged' => 1
    ));

    $result = $query->posts;
    ?>
    <div class="headermenu">
        <?php  if(sizeof($category) > 0) : ?>
            <div class="portfoliofilter topleftmenu">
                <div class="portfoliofilterbutton" data-text="<?php echo esc_attr ( vp_metabox('photology_portfolio_list.filtertitle') ); ?>">
                    <span><?php echo esc_html ( vp_metabox('photology_portfolio_list.filtertitle') ); ?></span>
                </div>
                <div class="portfoliofilterlist">
                    <ul>
                        <li data-filter=""><?php _e('All Category','photology-themes'); ?></li>
                        <?php
                        foreach($category as $key => $cat) :
                            echo "<li data-filter='" . esc_attr ( $key ) . "'> " . esc_html ( $cat ) . "</li>";
                        endforeach;
                        ?>
                    </ul>
                </div>
            </div>
        <?php  endif; ?>
        <?php get_template_part('fragment/header-search-bar'); ?>
    </div> <!-- headermenu -->


    <?php
    $pinterestclass = '';
    $usepinterest = vp_metabox('photology_portfolio_list.portfolio_type');

    $marginsize = '';
    $marginportfolioclass = '';

    if($usepinterest == 'pinterest') {
        $pinterestclass = 'pinterestportfolio';
    }

    $usemargin =  vp_metabox('photology_portfolio_list.use_margin');
    if($usemargin) {
        $marginsize = vp_metabox('photology_portfolio_list.margin_size');
        $marginportfolioclass = 'marginportfolio';
    }

    ?>
    <div class="portfoliowrapper <?php echo esc_attr( $pinterestclass ) ?>">
        <div class="contentheaderspace"></div>

        <?php  if(sizeof($category) > 0) : ?>
            <div class="filterfloat">
                <div class="filterfloatbutton">
                    <span><?php echo esc_html ( vp_metabox('photology_portfolio_list.filtertitle') ); ?></span>
                </div>
                <div class="filterfloatlist">
                    <ul>
                        <li data-filter=""><?php _e('All Category','photology-themes'); ?></li>
                        <?php
                        foreach($category as $key => $cat) :
                            echo "<li data-filter='" . esc_attr($key) . "'>" . esc_attr( $cat ) . "</li>";
                        endforeach;
                        ?>
                    </ul>
                </div>
            </div>
        <?php  endif; ?>

        <div class="portfoliocontentwrapper <?php echo esc_attr ( $marginportfolioclass ); ?>" style="<?php echo "padding: " . esc_attr( $marginsize ) . "px"; ?>">
            <div class="isotopewrapper">
                <?php
                $itemwidthbase = vp_metabox('photology_portfolio_list.item_width', null, JEG_PAGE_ID);
                $portfoliolayout = vp_metabox("photology_portfolio_list.portfolio_type", null, JEG_PAGE_ID);
                $itemheightdim = null;
                $itemheightbase = '';

                if($portfoliolayout == 'normal') {
                    $itemheightdim = floatval ( vp_metabox('photology_portfolio_list.item_height', null, JEG_PAGE_ID) );
                    $itemheightbase = $itemheightdim * $itemwidthbase;
                }

                foreach($result as $key => $value) {
                    $coverwidth = get_post_meta($value->ID, "coverwidth", true);
                    $coverheight = get_post_meta($value->ID, "coverheight", true);

                    // calculate width & height cover
                    $itw = $itemwidthbase * $coverwidth * 1.5;

                    $ith = null;
                    if($portfoliolayout == 'normal') {
                        $ith = $itemheightbase * $coverheight * 1.5;
                    }

                    $coverimage = jeg_get_image_attachment_full(get_post_meta($value->ID, "coverimage", true));
                    $thumbnail = apply_filters('jeg_image_resizer', $coverimage, $itw, $ith);

                    $portfoliotype = get_post_meta($value->ID, "portfolio_layout", true);

                    if($portfoliotype === 'anotherpage') {
                        $portfoliolink = vp_metabox('photology_portfolio_link.portfolio_link', null, $value->ID);
                    } else {
                        $portfoliolink = get_permalink($value->ID);
                    }


                    /** term list / category **/
                    $termlist = get_the_terms($value->ID, 'portfolio_category');
                    $termstring = array();

                    if($termlist) {
                        foreach($termlist as $term) {
                            $termstring[] = $term->name;
                        }
                    }

                    $categorystring = '';
                    if(!empty($termstring)) {
                        $categorystring = "<span></span><p>" . implode(', ', $termstring)  . "</p>";
                    }

                    /** overlay **/
                    $overrideoverlay = get_post_meta($value->ID, "override_overlay", true);
                    $overlaycss = '';
                    $overlaytextswitch = '';
                    if($overrideoverlay) {
                        $overlaydata = get_post_meta($value->ID, "portfolio_overlay", true);
                        $overlaycss = "background-color: {$overlaydata[0]['color']}";
                        if($overlaydata[0]['switch_text']) {
                            $overlaytextswitch = 'textswitch';
                        }
                    }

                    echo
                    "<div class='portfolioitem' style='padding:" . esc_attr( $marginsize ) . "px;' data-width='" . esc_attr($coverwidth) . "' data-height='" . esc_attr($coverheight) . "'>
						<a href='" . esc_attr( $portfoliolink ) . "' data-type='" . esc_attr($portfoliotype ) . "' data-id='" . esc_attr($value->ID ) . "' style='margin: 0;'>
							<img alt='" . esc_attr($value->post_title) . "' src='" . esc_attr($thumbnail) . "'>
							<div class='mask " . esc_attr($overlaytextswitch) . "' style='" . esc_attr($overlaycss) . "'>
								<div class='info'>
								    " . $categorystring . "
									<h2>" . esc_attr($value->post_title) . "</h2>
								</div>
							</div>
						</a>
					</div>\n";
                }
                ?>
            </div>
            <div class="portfoliopagingholder">
                <div class="portfoliopagingwrapper hideme">
                    <div class="pagedot">
                        <ul>
                            <?php
                            $maxnum = $query->max_num_pages;
                            for($i = 1; $i <= $maxnum; $i++) {
                                $activeclass = '';
                                if($i === 1) $activeclass = 'active';
                                echo "<li data-page='" . esc_attr($i) . "' class='" . esc_attr( $activeclass ) . "'><span>$i</span></li>";
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="pagetext">
                        <span class="pagenow"><?php _e('Page','photology-themes'); ?> <strong class="curpage">1</strong></span>
                        <span class="pagetotal"><?php _e('From','photology-themes'); ?> <strong class="totalpage"><?php echo esc_html ( $query->max_num_pages ); ?></strong></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="portfolioinputfilter">
            <form>
                <input type="hidden" name="portfolioid" value="<?php echo esc_attr( get_the_ID() ); ?>"/>
                <input type="hidden" name="category"/>
                <input type="hidden" name="page"/>
                <input type="hidden" name="action" value="get_portfolio_filter"/>
            </form>
        </div>
    </div>


    <?php
    if(vp_metabox("photology_portfolio_list.expand_type") === 'normal') {
        get_template_part('fragment/portfolio-fragment-content');
    }
    ?>
    <div class="portfolioloader bigloader"></div>
    <script>
        (function($){
            $(document).ready(function(){
                $(".portfoliowrapper").jportfolio({
                    adminurl : '<?php echo esc_url ( admin_url("admin-ajax.php") ); ?>',
                    loadAnimation : '<?php echo esc_js ( vp_metabox("photology_portfolio_list.load_animation")); ?>',
                    portfoliosize : <?php echo esc_js ( vp_metabox("photology_portfolio_list.item_width", 400)); ?>,
                    expandtype : '<?php echo esc_js ( vp_metabox("photology_portfolio_list.expand_type")); ?>',
                    tiletype : '<?php echo esc_js ( vp_metabox("photology_portfolio_list.portfolio_type")); ?>',
                    dimension : '<?php echo esc_js ( floatval ( vp_metabox('photology_portfolio_list.item_height') )); ?>',
                    margin: '<?php echo esc_js ( $marginsize ); ?>'
                });
            });
        })(jQuery);
    </script>

<?php
} else {
    get_template_part('fragment/password-form');
}
get_footer('portfolio');