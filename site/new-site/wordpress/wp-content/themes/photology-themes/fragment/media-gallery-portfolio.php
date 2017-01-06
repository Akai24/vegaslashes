<?php

$mediagallery 	= get_post_meta(JEG_PAGE_ID, 'photology_portfolio_media_gallery', true);
$gallerylayout 	= vp_metabox('photology_portfolio_sidecontent.grid.0.gallery_type', null, JEG_PAGE_ID);
$itemwidthbase 	= vp_metabox('photology_portfolio_sidecontent.grid.0.item_width', null, JEG_PAGE_ID);
$itemheightdim 	= null;
$itemheightbase = '';


if($gallerylayout == 'normal') {
    $itemheightdim = floatval ( vp_metabox('photology_portfolio_sidecontent.grid.0.item_height', null, JEG_PAGE_ID) );
    $itemheightbase = $itemheightdim * $itemwidthbase;
} else if($gallerylayout === 'justified') {
    $itemheightbase = floatval ( vp_metabox('photology_portfolio_sidecontent.grid.0.justified_item_height', null, JEG_PAGE_ID) );
}

$usemargin =  vp_metabox('photology_portfolio_sidecontent.grid.0.use_margin', null, JEG_PAGE_ID);
$marginsize = 0;
$althidetitle = vp_metabox('photology_portfolio_sidecontent.grid.0.photoswipe_setting.0.photoswipe_hide_title', null, JEG_PAGE_ID);
$notloadedclass = 'notloaded';

if($usemargin) {
    $marginsize = vp_metabox('photology_portfolio_sidecontent.grid.0.margin_size',  null, JEG_PAGE_ID);
    $additionalmarginclass = "marginimg";
}

$limitload = vp_metabox('photology_portfolio_sidecontent.load_limit', 50, JEG_PAGE_ID);

if($mediagallery)
{
    $bottomlimit = JEG_GALLERY_PAGE * $limitload;
    $uplimit = ( JEG_GALLERY_PAGE + 1 ) * $limitload;

    for($key = $bottomlimit ; $key < $uplimit ; $key++)
    {
        if(!isset($mediagallery[$key])) continue;
        $value = $mediagallery[$key];

        // calculate width & height cover
        if($gallerylayout === 'normal' || $gallerylayout === 'masonry') {
            $itw = $itemwidthbase * $value['width'] * 1.5;

            $ith = null;
            if($gallerylayout !== null) {
                $ith = $itemheightbase * $value['height'] * 1.5;
            }
        } else if($gallerylayout === 'justified') {
            $itw = null;
            $ith = $itemheightbase * 1.5;
        }


        if($value['type'] === 'image') {
            $image = jeg_get_image_attachment_full($value['imageid']);
            $thumbnail = apply_filters('jeg_image_resizer', $image, $itw, $ith);

            if(!$althidetitle) {
                $imgname = $value['imagename'];
            } else {
                $imgname = '';
            }

            $galleryoverlay = "<div class='galoverlay'></div>";

            echo
            "<div class='imggalitem {$notloadedclass}' data-width='{$value['width']}' data-height='{$value['height']}' style='padding: {$marginsize}px;'>
                <a href='{$image}' data-type='image' style='margin: 0px;' title='{$imgname}'>
                    <img src='{$thumbnail}' alt='{$value['imagename']}'>
                    {$galleryoverlay}
                </a>
            </div>";

        } else if($value['type'] === 'youtube' || $value['type'] === 'vimeo' || $value['type'] === 'soundcloud') {
            $image = jeg_get_image_attachment_full($value['mediacover']);
            $thumbnail = apply_filters('jeg_image_resizer', $image, $itw, $ith);
            $videoname = $value['title'];

            $videooverlay = "<div class='videooverlay'></div>";

            echo
            "<div class='imggalitem {$notloadedclass}'  data-width='{$value['width']}' data-height='{$value['height']}' style='padding: {$marginsize}px;'>
                <a href='{$value['mediaurl']}' data-type='{$value['type']}-gallery' style='margin: 0px;' title='{$videoname}'>
                    <img src='{$thumbnail}' alt=''>
                    {$videooverlay}
                </a>
            </div>";

        } else if($value['type'] === 'html5video') {
            $image = jeg_get_image_attachment_full($value['mediacover']);
            $thumbnail = apply_filters('jeg_image_resizer', $image, $itw, $ith);
            $videoname = $value['title'];

            $videomp4 = '';
            $videowebm = '';
            $videoogg = '';

            if($value['videomp4'] !== '') {
                $videomp4 = "<source type='video/mp4' src='{$value['videomp4']}' />";
            }

            if($value['videowebm'] !== '') {
                $videowebm = "<source type='video/webm' src='{$value['videowebm']}' />";
            }

            if($value['videoogg'] !== '') {
                $videoogg = "<source type='video/ogg' src='{$value['videoogg']}' />";
            }

            $html5video =
                "<video id='player' poster='{$image}' controls='controls' preload='none'>
					{$videomp4}
					{$videowebm}
					{$videoogg}
					<object width='100%' height='100%' type='application/x-shockwave-flash' data='" . get_template_directory_uri() . "/public/mediaelementjs/flashmediaelement.swf'>
						<param name='movie' value='" . get_template_directory_uri() . "/public/mediaelementjs/flashmediaelement.swf' />
						<param name='flashvars' value='controls=true&amp;file={$value['videomp4']}' />
						<img src='{$image}' alt='No video playback capabilities' title='No video playback capabilities' />
					</object>
				</video>";


            $videooverlay = "<div class='videooverlay'></div>";

            $uniqueid = uniqid();
            echo
                "<div class='imggalitem {$notloadedclass}' data-width='{$value['width']}' data-height='{$value['height']}' style='padding: {$marginsize}px;'>
                    <a href='#html5popup" . $uniqueid . "' data-type='{$value['type']}' style='margin: 0px;' title='{$videoname}'>
                        <img src='{$thumbnail}' alt=''>
                        {$videooverlay}
                    </a>
                    <div id='html5popup" . $uniqueid . "' class='html5popup-wrapper mfp-hide'>
                        <div class='mfp-html5video-scaler'>
                            {$html5video}
                        </div>
                    </div>
                </div>";
        }
    }
}