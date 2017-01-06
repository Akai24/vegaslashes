<?php
/**
 * Template Name: Slider - IOS
 */

get_header();

if ( ! post_password_required() )
{
    ?>
    <div class="headermenu">
        <?php get_template_part('fragment/header-search-bar'); ?>
    </div> <!-- headermenu -->


    <!-- begin IOS Slider -->
    <div class="fs-container">
        <div class="sliderContainer">
            <div class="iosSlider" data-autoplay="<?php echo esc_attr( vp_metabox('photology_ios.autoplay', 'false') );  ?>" data-delay="<?php echo esc_attr(  vp_metabox('photology_ios.sliderdelay', '5000') ); ?>">
                <div class="slider sliderhold">
                    <?php
                    $slideritem = vp_metabox('photology_slider_content.slideritem');
                    if($slideritem) {
                        foreach($slideritem as $slider) {
                            echo "<div class='item'>";
                            echo "<img src='" . esc_url( jeg_get_image_attachment_full($slider['background'])) . "'/>\n";
                            echo "<div class='iosoverlay' style='background-color: " . esc_attr ( $slider['overlay_color'] ) . "'></div>";
                            echo "<div class='ioscontainer'>\n";
                            echo "<div class='text1'>" . do_shortcode($slider['firstline']) . "</div>\n";
                            if($slider['show_secondline']) {
                                echo "<div class='text2'>" . esc_html ( $slider['secondline'] ) . "</div>\n";
                            }
                            if($slider['show_thirdline']) {
                                echo "<div class='text3'><a class='slider-button' href='" . esc_attr($slider['buttonurl']) . "'><span class='button-text'>" . esc_attr($slider['buttontext']) . "</span></a></div>\n";
                            }
                            echo "</div>\n";
                            echo "</div>\n";
                        }
                    }
                    ?>
                </div>
                <div class="navigationdot">
                    <?php
                    if($slideritem) {
                        foreach ($slideritem as $slider) {
                            echo '<div class="slide-dot"></div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="sliderloader bigloader"></div>

    <script>
        (function($){
            $(document).ready(function(){
                /** Full screen **/
                if($(".fs-container").length) {
                    $(".fs-container").fsfullheight(['.headermenu', '.responsiveheader', '.topnavigation']);
                    $(".sliderloader").show();
                }

                /** Fullscreen IOS Slider **/
                if($(".iosSlider").length) {
                    $(".iosSlider").jfullscreenios();
                }
            });
        })(jQuery);
    </script>

<?php
} else {
    get_template_part('fragment/password-form');
}

get_footer();