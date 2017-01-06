<?php
/**
 * Template Name: Slider - Gallery
 */

get_header();

if ( ! post_password_required() )
{
    ?>
    <div class="headermenu">
        <?php get_template_part('fragment/header-search-bar'); ?>
    </div> <!-- headermenu -->

    <div class="fs-container">
        <div class="slideshowgallery" style='opacity: 0;' data-loop="true" data-autoplay="<?php echo esc_attr ( vp_metabox('photology_slider_gallery.toggle_autoplay') === "1" ? vp_metabox('photology_slider_gallery.autoplay_delay') : false ); ?>">
            <?php
            $mediagallery = get_post_meta(get_the_ID(), 'postgallery', true);
            if($mediagallery)
            {
                foreach ($mediagallery as $key => $value)
                {
                    if($value['type'] === 'image')
                    {
                        $image = jeg_get_image_attachment_full($value['imageid']);
                        $thumbnail = apply_filters('jeg_image_resizer',$image, 144, 96);
                        echo "<a href='" . esc_url( $image ) . " '><img src='" . esc_url( $thumbnail) . "' width='144' height='96'></a>";
                    } else if($value['type'] === 'youtube' || $value['type'] === 'vimeo')
                    {
                        $mediaurl = $value['mediaurl'];
                        $image = jeg_get_image_attachment_full($value['mediacover']);
                        $thumbnail = apply_filters('jeg_image_resizer', $image, 144, 96);
                        echo "<a href='" . esc_url($mediaurl ) . "' data-img='" . esc_attr($image ) . "'><img src='" . esc_url($thumbnail ) . "' width='144' height='96'></a>";
                    }
                }
            }
            ?>
        </div>
    </div>
    <div class="sliderloader bigloader"></div>

    <script>
        (function($){
            $(document).ready(function(){
                /** Full screen **/
                if($(".fs-container").length) {
                    $(".fs-container").fsfullheight(['.headermenu', '.responsiveheader', '.topnavigation']);
                }

                /** Fullscreen Fotorama **/
                $(".slideshowgallery").fotorama({
                    allowfullscreen: false,
                    arrows: <?php echo esc_js ( vp_metabox('photology_slider_gallery.show_arrow') === "1" ? "true" : "false" ); ?>,
                    width: '100%',
                    maxWidth: '100%',
                    height : '100%',
                    minheight : '100%',
                    maxheight : '100%',
                    nav: "<?php echo esc_js ( vp_metabox('photology_slider_gallery.show_thumb') === "1" ? "thumbs" : "false" );  ?>",
                    fit : "<?php echo esc_js ( vp_metabox('photology_slider_gallery.fit_mode') ) ?>"
                });

                $(".slideshowgallery").on('fotorama:load', function(){});

                $(window).load(function(){
                    $(".slideshowgallery").animate({
                        'opacity' : 1
                    }, 300);
                    $(".sliderloader").fadeOut();
                });
            });
        })(jQuery);
    </script>

<?php
} else {
    get_template_part('fragment/password-form');
}
get_footer();