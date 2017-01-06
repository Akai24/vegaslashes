<?php
$queryarray = array(
    'post_type' 			=> 'portfolio',
    'post_status'			=> array('publish'),
    'meta_query' 			=> array(
        array(
            'key' => 'portfolio_parent',
            'value' => array(JEG_PAGE_ID),
            'compare' => 'IN',
        )
    ),
    'orderby' 				=> 'menu_order',
    'order' 				=> 'ASC',
    'posts_per_page' 		=> vp_metabox('photology_portfolio_list.load_limit', null, JEG_PAGE_ID),
    'paged' 				=> JEG_PORTFOLIO_PAGE
);

if(JEG_CATEGORY !== '') {
    $queryarray['tax_query'] =
        array(
            array(
                'taxonomy' 	=>  'portfolio_category',
                'terms' 	=>  JEG_CATEGORY,
                'field' 	=> 'id',
                'operator' 	=> 'IN'
            )
        );
}

$usemargin =  vp_metabox('photology_portfolio_list.use_margin', null, JEG_PAGE_ID);
$marginsize = '';
$marginportfolioclass = '';
if($usemargin) {
    $marginsize = vp_metabox('photology_portfolio_list.margin_size', null, JEG_PAGE_ID);
    $marginportfolioclass = 'marginportfolio';
}

$query = new WP_Query($queryarray);
$result = $query->posts;
?>

<div class="portfoliocontentwrapper">
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
            if($coverwidth >= 2 && $usemargin) {
                $itw = $itw + ( ($coverwidth - 1) * $marginsize);
            }

            $ith = null;
            if($portfoliolayout == 'normal') {
                $ith = $itemheightbase * $coverheight * 1.5;
                if($coverheight >= 2 && $usemargin) {
                    $ith = $ith + ( ( $coverheight - 1 ) * $marginsize * 2 );
                }
            }

            $coverimage = jeg_get_image_attachment_full(get_post_meta($value->ID, "coverimage", true));
            $thumbnail = apply_filters('jeg_image_resizer', $coverimage, $itw, $ith);

            $portfoliotype = get_post_meta($value->ID, "portfolio_layout", true);

            if($portfoliotype === 'anotherpage') {
                $portfoliolink = vp_metabox('photology_portfolio_link.portfolio_link', null, $value->ID);
            } else {
                $portfoliolink = get_permalink($value->ID);
            }

            if(JEG_CATEGORY !== '') $portfoliolink .= "?filter=" . JEG_CATEGORY ;


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
            "<div class='portfolioitem' style='padding: {$marginsize}px;' data-width='{$coverwidth}' data-height='{$coverheight}'>
					<a href='{$portfoliolink}' data-type='{$portfoliotype}' data-id='{$value->ID}' style='margin: 0;'>
						<img src='{$thumbnail}'>
						<div class='mask {$overlaytextswitch}' style='{$overlaycss}'>
							<div class='info'>
							    {$categorystring}
								<h2>{$value->post_title}</h2>
							</div>
						</div>
					</a>
				</div>\n";
        }
        ?>

    </div>
    <div class="portfoliopagingholder">
        <div class="portfoliopagingwrapper">
            <div class="pagedot">
                <ul>
                    <?php
                    $maxnum = $query->max_num_pages;
                    for($i = 1; $i <= $maxnum; $i++) {
                        $activeclass = '';
                        if($i === 1) $activeclass = 'active';
                        echo "<li data-page='" . esc_attr ( $i ) . "' class='" . esc_attr ( $activeclass ) . "'><span>" . esc_html ( $i ) . "</span></li>";
                    }
                    ?>
                </ul>
            </div>
            <div class="pagetext">
                <span class="pagenow">Page <strong class="curpage">1</strong></span>
                <span class="pagetotal">From <strong class="totalpage"><?php echo esc_html ( $query->max_num_pages ); ?></strong></span>
            </div>
        </div>
    </div>
</div>