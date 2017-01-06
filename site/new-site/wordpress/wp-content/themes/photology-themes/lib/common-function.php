<?php
/**
 * @author Jegtheme
 */


if(!defined('JEG_PLUGIN_VERSION')) {

    if(!function_exists('vp_option'))
    {
        function vp_option($key, $default = null)
        {
            return $default;
        }
    }

    if(!function_exists('vp_metabox'))
    {
        function vp_metabox($key, $default = null, $post_id = null)
        {
            return $default;
        }
    }

    if(!function_exists('vp_get_gwf_style'))
    {
        function vp_get_gwf_style()
        {
            return null;
        }
    }

    if(!function_exists('vp_get_gwf_weight'))
    {
        function vp_get_gwf_weight()
        {
            return null;
        }
    }

    if(!function_exists('vp_get_gwf_family'))
    {
        function vp_get_gwf_family()
        {
            return null;
        }
    }

}

function jeg_log($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}



function jeg_get_google_font()
{
    $font = vp_get_gwf_family();
    $fontlist = array();
    $fontlist[] = '';
    if($font) {
        foreach($font as $fl){
            $fontlist[$fl['value']] = $fl['label'];
        }
    }
    return $fontlist;
}



/** page type checker **/
function jeg_check_page_type()
{
    $type = array();

    if(is_home()) 			array_push($type, 'is_home');
    if(is_front_page()) 	array_push($type, 'is_front_page');
    if(is_404()) 			array_push($type, 'is_404');
    if(is_search()) 		array_push($type, 'is_search');
    if(is_date()) 			array_push($type, 'is_date');
    if(is_author()) 		array_push($type, 'is_author');
    if(is_category()) 		array_push($type, 'is_category');
    if(is_tag()) 			array_push($type, 'is_tag');
    if(is_tax()) 			array_push($type, 'is_tax');
    if(is_archive()) 		array_push($type, 'is_archive');
    if(is_single()) 		array_push($type, 'is_single');
    if(is_attachment()) 	array_push($type, 'is_attachment');
    if(is_page()) 			array_push($type, 'is_page');

    return implode(', ', $type);
}



function jeg_get_query_paged ()
{
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $page = ( get_query_var('page') ) ? get_query_var('page') : 1;
    return ( $paged > $page ) ? $paged : $page;
}



function jeg_new_pagination($pageid, $curpage, $totalPage = 0, $step = 2)
{
    if($totalPage > 1) {
        $pagingCount = ( $step * 2 ) + 1;

        $html = '<div class="pagedot">';

        if( $curpage > $step + 1 && $totalPage > $pagingCount ) {
            $html .= "<a data-page='1' href='" . esc_url(get_pagenum_link(1)) . "'><span>&laquo</span></a>";
        }
        if( $curpage > 1 && $pagingCount < $totalPage ) {
            $html .= get_previous_posts_link('<span>&lsaquo;</span>');
        }

        /** loop page **/
        for($i = jlimitme('low', $curpage - $step, 1) ; $i <= jlimitme('high', $totalPage , $curpage + $step) ; $i++){
            if($i == $curpage) {
                $html .= '<span>'.$i.'</span>';
            } else {
                $html .= "<a data-page='{$i}' href='" . get_pagenum_link($i) . "'><span>{$i}</span></a>";
            }
        }

        if( $curpage < $totalPage && $pagingCount < $totalPage ) {
            $html .= get_next_posts_link('<span>&rsaquo;</span>');
        }

        if( $curpage < $totalPage - 1 && $curpage + $step + 1 <= $totalPage && $pagingCount < $totalPage ) {
            $html .= "<a data-page='{$totalPage}' href='" . get_pagenum_link($totalPage) . "'><span>&raquo;</span></a>";
        }

        $html .= "</div>";

        $html .= "<div class='pagetext'>
			<span class='pagenow'>" . __('Page','photology-themes') . "  <strong class='curpage'>{$curpage}</strong></span>
			<span class='pagetotal'>" . __('From','photology-themes') . "  <strong class='totalpage'>{$totalPage}</strong></span>
		</div>";

        return $html;
    } else {
        return ;
    }
}


function jeg_set_post_views($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count=='') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}




function jlimitme ($type = "high", $point, $limit)
{
    if ($type == "high") {
        return ($point > $limit) ? $limit : $point;
    } else {
        return ($point > $limit) ? $point : $limit;
    }
}


function jeg_blog_pagination( $query = null ) {
    global $wp_query;

    if ( !$query ) {
        $query = $wp_query;
    }

    if($query->max_num_pages > 1) {
        ?>
        <div class='blognormalpaging blogpagingholder'>
            <div class='blognormalpagingwrapper'>
                <?php echo jeg_new_pagination(get_the_ID(), jeg_get_query_paged(), $query->max_num_pages); ?>
            </div>
        </div>
        <?php
    }
}


function jeg_video_type($url)
{
    if (strpos($url, 'youtube') > 0) {
        return 'youtube';
    } elseif (strpos($url, 'vimeo') > 0) {
        return 'vimeo';
    } elseif (strpos($url, 'soundcloud') > 0) {
        return 'soundcloud';
    } else {
        return 'unknown';
    }
}


function jeg_audio_type($url)
{
    if (strpos($url, 'soundcloud') > 0) {
        return 'soundcloud';
    } else {
        return 'unknown';
    }
}



function jeg_get_featured_header($w = null, $h = null)
{
    $postformat = get_post_format();
    $featuredhtml = '';
    $imgid = get_post_thumbnail_id(get_the_ID());

    $featured_img   = apply_filters('jeg_image_resizer', jeg_get_image_attachment_full($imgid), $w, $h);
    $imgalt = get_the_title($imgid);

    switch( $postformat ) {
        case "video" :
            $video_url      = get_post_meta( get_the_ID(), '_format_video_embed', true );
            $video_format   = strtolower( pathinfo( $video_url, PATHINFO_EXTENSION ) );

            if( jeg_video_type($video_url) === 'youtube' ) {
                $featuredhtml =
                    "<div data-src='". esc_url( $video_url ) ."' data-repeat='false' data-autoplay='false' data-type='youtube'><div class='video-container'></div></div>";
            } else if( jeg_video_type($video_url) === 'vimeo' ) {
                $featuredhtml =
                    "<div data-src='". esc_url( $video_url ) ."' data-repeat='false' data-autoplay='false' data-type='vimeo'><div class='video-container'></div></div>";
            } else if( wp_oembed_get( $video_url ) ) {
                $featuredhtml =
                    "<div class='video-container'>" . wp_oembed_get( $video_url ) . "</div>";
            } else if( $video_format == 'mp4' ) {
                $featuredhtml =
                    "<div data-type='html5video' data-mp4='" . esc_url( $video_url ) . "' data-cover='" . esc_attr($featured_img) . "'>
					    <div class='video-container'></div>
				    </div>";
            }
            break;
        case "audio" :
            $audio_url      = get_post_meta( get_the_ID(), '_format_audio_embed', true );
            $audio_format   = strtolower( pathinfo( $audio_url, PATHINFO_EXTENSION ) );

            if( jeg_video_type($audio_url) === 'soundcloud' ) {
                $featuredhtml =
                    "<div data-src='". esc_url( $audio_url ) ."' data-repeat='false' data-autoplay='false' data-type='soundcloud'><div class='video-container'></div></div>";
            } else if( $audio_format == 'mp3' ) {
                $featuredhtml = "
                    <img src='" . $featured_img  . "' alt='" . $imgalt . "'>
                    <div data-mp3=" . esc_url( $audio_url ) . " data-type='audio' class='audio-class'></div>";
            }

            break;
        case "gallery" :
            $images = get_post_meta(get_the_ID(), '_format_gallery_images', true);
            if($images)
            {
                if($h === null) $h = $w * 9 / 16;
                $featuredhtml = "<div class='article-slider-wrapper loading'>
                                    <div class='article-image-slider'>";
                foreach($images as $imgid)
                {
                    $imgfeatured = apply_filters('jeg_image_resizer', jeg_get_image_attachment_full($imgid), $w, $h);
                    $imgalt = get_the_title( $imgid );
                    $featuredhtml .= "<img src=' "  . esc_url ( $imgfeatured ) .  " ' alt=' " . esc_attr( $imgalt ) . "'/>";
                }
                $featuredhtml .= "</div>
                            </div>";


            }
            break;
        default :
            if(has_post_thumbnail()) {
                $imgalt = get_the_title($imgid);
                $featuredhtml =
                    "<div class='featured'>
                        <a href='" . get_permalink() . "'>
                            <img src='" . esc_url ( $featured_img ) . "' alt='" . esc_attr ( $imgalt ) . "'>
                        </a>
                    </div>";
            }
    }

    return $featuredhtml;

}



/** comment **/
function jeg_get_wordpress_comment()
{
    $number = get_comments_number();

    if ( $number > 1 ) {
        $output = str_replace('%', number_format_i18n($number), __('% Comments', 'photology-themes'));
    }
    elseif ( $number == 0 ) {
        $output = __('No Comments', 'photology-themes');
    }
    else { // must be one
        $output = __('1 Comment', 'photology-themes');
    }

    return $output;
}


function jeg_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?>>
        <div id="comment-<?php comment_ID(); ?>">
            <div class="coment-box">
                <div class="coment-box-inner">
                    <div class="comment-autor">
                        <?php echo get_avatar($comment,$size='80',$default='' ); ?>
                    </div>

                    <div class="comment-meta">
                        <ul>
                            <li class="addby">
                                <div class="authorcomment"><?php comment_author_link(); ?></div>
                                <span data-comment-id="<?php comment_ID(); ?>" class="replycomment"><?php _e('Reply', 'photology-themes'); ?></span>
                                <span class="closecommentform"><?php _e('Cancel Reply', 'photology-themes'); ?></span>
                            </li>
                            <li class="addtime"><?php echo get_comment_date('F j, Y'); ?></li>
                        </ul>
                    </div>

                    <div class="comment-text">
                        <?php
                        if($comment->comment_approved == '0') :
                            echo "<em class=\"comment-moderation-text\">" . __("Your comment is awaiting moderation", "photology-themes") . "</em>";
                        endif;
                        echo '<p>' . get_comment_text() . '</p>';
                        ?>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </li>
<?php
}



function jeg_get_category_link()
{
    $catlink = array();

    foreach(get_the_category() as $category)
    {
        $catlink[] = '<a href="' . get_category_link($category->term_id) . '" title="' . $category->description . '">' . $category->name . '</a>';
    }

    return $catlink;
}

/**
 * Convert a hexa decimal color code to its RGB equivalent (http://php.net/manual/en/function.hexdec.php)
 *
 * @param string $hexStr (hexadecimal color value)
 * @param boolean $returnAsString (if set true, returns the value separated by the separator character. Otherwise returns associative array)
 * @param string $seperator (to separate RGB values. Applicable only if second parameter is true.)
 * @return array or string (depending on second parameter. Returns False if invalid hex color value)
 */
function jeg_hex2RGB($hexStr, $returnAsString = false, $seperator = ',')
{
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}



/**
 * social icon
 */
function jeg_populate_social () {
    $socialarray = array();

    // facebook
    if(vp_option('joption.social_facebook')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-facebook',
            'class' => 'social-facebook',
            'url'	=> vp_option('joption.social_facebook'),
            'text'	=> 'Facebook'
        );
    }

    // twitter
    if(vp_option('joption.social_twitter')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-twitter',
            'class' => 'social-twitter',
            'url'	=> vp_option('joption.social_twitter'),
            'text'	=> 'Twitter'
        );
    }

    // linked in
    if(vp_option('joption.social_linkedin')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-linkedin',
            'class' => 'social-linkedin',
            'url'	=> vp_option('joption.social_linkedin'),
            'text'	=> 'Linked In'
        );
    }

    // Google Plus
    if(vp_option('joption.social_googleplus')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-google-plus',
            'class' => 'social-googleplus',
            'url'	=> vp_option('joption.social_googleplus'),
            'text'	=> 'Google Plus'
        );
    }

    // Pinterest
    if(vp_option('joption.social_pinterest')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-pinterest',
            'class' => 'social-pinterest',
            'url'	=> vp_option('joption.social_pinterest'),
            'text'	=> 'Pinterest'
        );
    }

    // Github
    if(vp_option('joption.social_github')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-github',
            'class' => 'social-github',
            'url'	=> vp_option('joption.social_github'),
            'text'	=> 'Github'
        );
    }

    // Flickr
    if(vp_option('joption.social_flickr')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-flickr',
            'class' => 'social-flickr',
            'url'	=> vp_option('joption.social_flickr'),
            'text'	=> 'Flickr'
        );
    }

    // Tumblr
    if(vp_option('joption.social_tumblr')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-tumblr',
            'class' => 'social-tumblr',
            'url'	=> vp_option('joption.social_tumblr'),
            'text'	=> 'Tumblr'
        );
    }

    // Dribbble
    if(vp_option('joption.social_dribbble')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-dribbble',
            'class' => 'social-dribbble',
            'url'	=> vp_option('joption.social_dribbble'),
            'text'	=> 'Dribbble'
        );
    }

    // Soundcloud
    if(vp_option('joption.social_soundcloud')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-soundcloud',
            'class' => 'social-soundcloud',
            'url'	=> vp_option('joption.social_soundcloud'),
            'text'	=> 'Soundcloud'
        );
    }

    // Behance
    if(vp_option('joption.social_behance')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-behance',
            'class' => 'social-behance',
            'url'	=> vp_option('joption.social_behance'),
            'text'	=> 'Behance'
        );
    }

    // instagram
    if(vp_option('joption.social_instagram')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-instagram',
            'class' => 'social-instagram',
            'url'	=> vp_option('joption.social_instagram'),
            'text'	=> 'Instagram'
        );
    }

    // Vimeo
    if(vp_option('joption.social_vimeo')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-vimeo-square',
            'class' => 'social-vimeo',
            'url'	=> vp_option('joption.social_vimeo'),
            'text'	=> 'Vimeo'
        );
    }

    // Youtube
    if(vp_option('joption.social_youtube')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-youtube',
            'class' => 'social-youtube',
            'url'	=> vp_option('joption.social_youtube'),
            'text'	=> 'youtube'
        );
    }

    // 500px
    if(vp_option('joption.social_500px')) {
        $socialarray[] = array(
            'icon'	=> 'icon-500px',
            'class' => 'social-500px',
            'url'	=> vp_option('joption.social_500px'),
            'text'	=> '500px'
        );
    }

    // vk
    if(vp_option('joption.social_vk')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-vk',
            'class' => 'social-vk',
            'url'	=> vp_option('joption.social_vk'),
            'text'	=> 'vk'
        );
    }

    // vk
    if(vp_option('joption.social_rss')) {
        $socialarray[] = array(
            'icon'	=> 'fa fa-rss',
            'class' => 'social-rss',
            'url'	=> vp_option('joption.social_rss'),
            'text'	=> 'vk'
        );
    }

    return $socialarray;
}


function jeg_social_icon($withtext)
{
    $html = "<ul>";
    $socialarray = jeg_populate_social();
    foreach($socialarray as $soc) {
        if($withtext) {
            $html .= "<li><a target='_blank' href='" . esc_url($soc['url']) . "' class='" . esc_attr($soc['class']) . "'><i class='" . esc_attr($soc['icon']) . "'></i>" . esc_html($soc['text']) . "</a></li>";
        } else {
            $html .= "<li><a target='_blank' href='" . esc_url($soc['url']) . "' class='" . esc_attr($soc['class']) . "'><i class='" . esc_attr($soc['icon']) . "'></i></a></li>";
        }
    }
    $html .= "</ul>";
    return $html;
}



function jeg_get_navigation_setup($pageid = null) {
    $navobj = array();

    $navobj['navcollapse'] = apply_filters('jeg_navigation_collapse', get_theme_mod('collapse_navigation'));
    $navobj['hidetopmenu'] = apply_filters('jeg_show_hide_header', get_theme_mod('hide_top_menu_navigation'));

    return $navobj;
}


function jeg_get_additional_body_class()
{
    $classstring = array();
    $navobj = jeg_get_navigation_setup();

    array_push($classstring, "sidenav");
    if($navobj['navcollapse']) {
        array_push($classstring, "sidebarcollapse");
    }
    if($navobj['hidetopmenu']) {
        array_push($classstring, "noheadermenu");
    }

    global $post;
    if(is_single()){
        if($post->post_type === 'portfolio') {
            $layout = get_post_meta($post->ID, 'portfolio_layout', true);
            array_push($classstring , "portfolio-" . $layout);
        }
    }

    array_push($classstring , "photology");

    return $classstring;
}



/** next prev item **/

if ( ! function_exists( 'jeg_next_prev_portfolio' ) )
{
    function jeg_next_prev_portfolio($parentid, $currentid, $to, $category = '')
    {
        $portfolioquery = array(
            'post_type' => 'portfolio',
            'meta_query' => array(
                array(
                    'key' => 'portfolio_parent',
                    'value' => array($parentid),
                    'compare' => 'IN',
                )
            ),
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'nopaging' => true
        );


        if($category !== '') {
            $portfolioquery['tax_query'] =
                array(
                    array(
                        'taxonomy' 	=>  'portfolio_category',
                        'terms' 	=>  $category,
                        'field' 	=> 'id',
                        'operator' 	=> 'IN'
                    )
                );
        }

        $query = new WP_Query($portfolioquery);

        $result = $query->posts;
        $currentpost = 0;

        foreach($result as $key => $res) {
            if($currentid === $res->ID) {
                $currentpost = $key;
                break;
            }
        }

        if($to === 'next') {
            $nextpost = $currentpost + 1;
            if($nextpost >= sizeof($result)) {
                $nextpost = 0;
            }

            $nextcontent = $result[$nextpost];
            return $nextcontent->ID;
        } else {
            $prevpost = $currentpost - 1;
            if($prevpost < 0) {
                $prevpost = sizeof($result) - 1;
            }
            $prevcontent = $result[$prevpost];
            return $prevcontent->ID;
        }
    }
}



if(!function_exists('jeg_get_portfolio_featured_heading'))
{
    function jeg_get_portfolio_featured_heading($postid)
    {
        $portfolioitem = get_post_meta($postid, 'photology_portfolio_media_gallery', true);
        $featured = '';

        if(!empty($portfolioitem)) {
            foreach($portfolioitem as $idx => $portfolio) {
                $portfoliotype = $portfolio['type'];
                $loadclass = ( $idx === 0 ) ? "loaded" : "notloaded";
                $mediacover = '';

                if(isset($portfolio['mediacover'])) {
                    $mediacover = jeg_get_image_attachment_full($portfolio['mediacover']);
                    $mediacoversize = wp_get_attachment_image_src($portfolio['mediacover'], 'full');
                }

                switch ($portfoliotype) {
                    case 'image' :
                        $image = wp_get_attachment_image_src($portfolio['imageid'], 'full');
                        $thumb = apply_filters('jeg_image_resizer', $image[0], 90, 90);

                        if($idx === 0) {
                            $featured .=
                                "<div class='portfolio-content-holder item' data-type='image' data-title='{$portfolio['imagename']}' data-thumb='{$thumb}'>
                                    <img src='{$image[0]}' alt='{$portfolio['imagename']}' class='{$loadclass}' data-width='{$image[1]}' data-height='{$image[2]}'/>
                                </div>";
                        } else {
                            $featured .=
                                "<div class='portfolio-content-holder item' data-type='image' data-title='{$portfolio['imagename']}' data-thumb='{$thumb}'>
                                    <img src='#' data-src='{$image[0]}' alt='{$portfolio['imagename']}' class='{$loadclass}' data-width='{$image[1]}' data-height='{$image[2]}'/>
                                </div>";
                        }

                        break;
                    case 'youtube' :
                    case 'vimeo' :
                        $thumb = apply_filters('jeg_image_resizer', $mediacover, 90, 90);
                        if($idx === 0) {
                            $featured .=
                                "<div class='portfolio-content-holder item' data-type='{$portfoliotype}' data-src='{$portfolio['mediaurl']}' data-title='{$portfolio['title']}' data-thumb='{$thumb}'>
                                    <div class='portfoliovideo-wrapper'>
                                        <img src='{$mediacover}' alt='{$portfolio['title']}' class='{$loadclass}' data-width='{$mediacoversize[1]}' data-height='{$mediacoversize[2]}'/>
                                        <div class='videooverlay'></div>
                                    </div>
                                    <div class='portfoliovideo-container'><div class='video-container'></div></div>
                                </div>";
                        } else {
                            $featured .=
                                "<div class='portfolio-content-holder item' data-type='{$portfoliotype}' data-src='{$portfolio['mediaurl']}' data-title='{$portfolio['title']}' data-thumb='{$thumb}'>
                                    <div class='portfoliovideo-wrapper'>
                                        <img src='#' alt='{$portfolio['title']}' data-src='{$mediacover}' class='{$loadclass}' data-width='{$mediacoversize[1]}' data-height='{$mediacoversize[2]}'/>
                                        <div class='videooverlay'></div>
                                    </div>
                                    <div class='portfoliovideo-container'><div class='video-container'></div></div>
                                </div>";
                        }
                        break;
                    case 'html5video' :
                        $thumb = apply_filters('jeg_image_resizer', $mediacover, 90, 90);
                        if($idx === 0) {
                            $featured .=
                                "<div class='portfolio-content-holder item' data-type='{$portfoliotype}' data-mp4='{$portfolio['videomp4']}' data-webm='{$portfolio['videowebm']}' data-ogg='{$portfolio['videoogg']}' data-title='{$portfolio['title']}' data-thumb='{$thumb}'>
                                    <div class='portfoliovideo-wrapper'>
                                        <img alt='{$portfolio['title']}' src='{$mediacover}' class='{$loadclass}' data-width='{$mediacoversize[1]}' data-height='{$mediacoversize[2]}'/>
                                        <div class='videooverlay'></div>
                                    </div>
                                    <div class='portfoliovideo-container'><div class='html5-video-container'></div></div>
                                </div>";
                        } else {
                            $featured .=
                                "<div class='portfolio-content-holder item' data-type='{$portfoliotype}' data-cover='{$mediacover}' data-mp4='{$portfolio['videomp4']}' data-webm='{$portfolio['videowebm']}' data-ogg='{$portfolio['videoogg']}' data-title='{$portfolio['title']}' data-thumb='{$thumb}'>
                                    <div class='portfoliovideo-wrapper'>
                                        <img alt='{$portfolio['title']}' src='#' data-src='{$mediacover}' class='{$loadclass}' data-width='{$mediacoversize[1]}' data-height='{$mediacoversize[2]}'/>
                                        <div class='videooverlay'></div>
                                    </div>
                                    <div class='portfoliovideo-container'><div class='html5-video-container'></div></div>
                                </div>";
                        }
                        break;
                    case 'soundcloud' :
                        $thumb = apply_filters('jeg_image_resizer', $mediacover, 90, 90);
                        $featured .=
                            "<div class='portfolio-content-holder item' data-type='soundcloud' data-src='{$portfolio['mediaurl']}' data-title='{$portfolio['title']}' data-thumb='{$thumb}'>
                                <div class='video-container'></div>
                            </div>";
                        break;
                    default:
                        break;
                }
            }
        }

        return $featured;
    }
}


function jeg_get_all_portfolio_category ($pageid) {
    $category = array();

    $query = new WP_Query(array(
        'post_type' => 'portfolio',
        'meta_query' => array(
            array(
                'key' => 'portfolio_parent',
                'value' => array($pageid),
                'compare' => 'IN',
            )
        ),
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'nopaging' => true
    ));

    $result = $query->posts;
    foreach($result as $key => $value) {
        $termlist = get_the_terms($value->ID, 'portfolio_category');
        if( !empty($termlist) ) {
            foreach($termlist as $termkey => $termvalue) {
                if(!isset($category[$termvalue->term_id])) {
                    $category[$termvalue->term_id] = $termvalue->name;
                }
            }
        }
    }

    return $category;
}




/** location builder **/

function jeg_location_block($idx, $location) {
    $html = '<div class="locationlist"><div data-index="'. esc_attr( $idx ) .'" class="mapitem">';
    if($location['title_leading'] !== '') {
        $html .= '<h4>' . esc_html ( $location['title_leading'] . ' : ' . $location['title'] ) . '</h4>';
    } else {
        $html .= '<h4>' . esc_html ( $location['title'] ) . '</h4>';
    }
    $html .= '<div class="mapdetail"><ul>';

    if($location['address'] !== '') {
        $html .= '<li><div class="detail">' . esc_html ( $location['address'] ) . '</div></li>';
    }
    if($location['address_second'] !== '') {
        $html .= '<li><div class="detail">' . esc_html ( $location['address_second'] ) . '</div></li>';
    }
    if($location['phone'] !== '') {
        $html .= '<li><div class="detail">' . esc_html ( $location['phone'] ) . '</div></li>';
    }
    if($location['email'] !== '') {
        $html .= '<li><div class="detail">' . esc_html ( $location['email'] ) . '</div></li>';
    }
    if($location['website'] !== '') {
        $html .= '<li><div class="detail"><a target="_blank" href="' . esc_url( $location['website'] ) . '">' . esc_html ( $location['website'] ) . '</a></div></li>';
    }

    $html .= '</ul></div><div class="mapwrapper mapbutton"><span class="button-text">' . __('GET DIRECTION', 'photology-themes') . '</span></div>';
    $html .= '</div></div>';

    return $html;
}


function jeg_info_window($idx, $location) {
    $html = '<div class="infowindow" data-lat="' . esc_attr($location['x']) . '" data-lng="' . esc_attr($location['y']) . '">';
    $html .= '<div class="infowindow-wrapper">';
    $html .= '<h4>' . esc_html($location['title']) . '</h4>';
    $html .= '<ul>';

    if($location['address'] !== '') {
        $html .= '<li><div class="detail">' . esc_html($location['address']) . '</div></li>';
    }
    if($location['address_second'] !== '') {
        $html .= '<li><div class="detail">' . esc_html($location['address_second']) . '</div></li>';
    }
    if($location['phone'] !== '') {
        $html .= '<li><div class="detail">' . esc_html($location['phone']) . '</div></li>';
    }
    if($location['email'] !== '') {
        $html .= '<li><div class="detail">' . esc_html($location['email']) . '</div></li>';
    }
    if($location['website'] !== '') {
        $html .= '<li><div class="detail">' . esc_html($location['website']) . '</div></li>';
    }

    $html .= '</ul></div><div class="closeme"></div></div>';

    return $html;
}



function jeg_get_image_attachment_full($imageid)
{
    $imagedata = wp_get_attachment_image_src($imageid, "full");
    return $imagedata[0];
}

function jeg_get_archive_title() {
    $title = '';
    if (function_exists('is_tag') && is_tag()) {
        $title =  sprintf( __('Tag archive for : <b>%s</b>', 'photology-themes') , single_tag_title('', false) );
    } elseif (is_category()){
        $title =  sprintf( __('Post filled under : <b>%s</b>', 'photology-themes') , single_cat_title('', false) );
    } elseif (is_author()){
        $title =  sprintf( __('Post written by : <b>%s</b>', 'photology-themes') , get_userdata(get_query_var('author'))->display_name );
    } elseif (is_archive()) {
        $title =  sprintf( __('%s - Archive', 'photology-themes'),  wp_title('', false)) ;
    }

    return $title;
}