<?php
/**
 * @author: Jegtheme
 */


function jeg_get_post_id()
{
    global $post;
    $p_post_id = isset($_POST['post_ID']) ? $_POST['post_ID'] : null ;
    $g_post_id = isset($_GET['post']) ? $_GET['post'] : null ;
    $post_id = $g_post_id ? $g_post_id : $p_post_id ;
    $post_id = isset($post->ID) ? $post->ID : $post_id ;

    if (isset($post_id)) {
        return (integer) $post_id;
    }
    return null;
}


function jeg_get_featured_heading($postid, $w = null, $h = null) {
    $postformat = get_post_format();
    $featuredhtml = '';
    $imgid = get_post_thumbnail_id($postid);

    $featured_img   = jeg_image_resizer(jeg_get_image_attachment($imgid), $w, $h);
    $imgalt = get_the_title($imgid);

    switch( $postformat ) {
        case "video" :
            $video_url      = get_post_meta( $postid, '_format_video_embed', true );
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
            $audio_url      = get_post_meta( $postid, '_format_audio_embed', true );
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
            $images = get_post_meta( $postid, '_format_gallery_images', true);
            if($images)
            {
                if($h === null) $h = $w * 9 / 16;
                $featuredhtml = "<div class='article-slider-wrapper loading'>
                                    <div class='article-image-slider'>";
                foreach($images as $imgid)
                {
                    $imgfeatured = jeg_image_resizer(jeg_get_image_attachment($imgid), $w, $h);
                    $imgalt = get_the_title($imgid);
                    $featuredhtml .= "<img src='{$imgfeatured}' alt='{$imgalt}'/>";
                }
                $featuredhtml .= "</div>
                            </div>";


            }
            break;
        default :
            if(has_post_thumbnail($postid)) {
                $imgalt = get_the_title($imgid);
                $featuredhtml =
                    "<div class='featured'>
                        <a href='" . get_permalink() . "'>
                            <img src='" . $featured_img  . "' alt='" . $imgalt . "'>
                        </a>
                    </div>";
            }
    }

    return $featuredhtml;
}