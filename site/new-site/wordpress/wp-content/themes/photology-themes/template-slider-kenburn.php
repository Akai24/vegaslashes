<?php
/**
 * Template Name: Slider - Kenburn
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
        <div class="kenburnwrapper"></div>
        <div class="kenburntext">

            <?php
            $slideritem = vp_metabox('photology_slider_content.slideritem');
            if($slideritem) {
                foreach($slideritem as $id => $slider) {
                    echo "<div class='kenburntextcontent ioscontainer item'>";
                    echo "<div class='text1'>" . do_shortcode($slider['firstline']) . "</div>\n";
                    if($slider['secondline']) {
                        echo "<div class='text2'>" . esc_html ($slider['secondline']) . "</div>\n";
                    }
                    if($slider['show_thirdline']) {
                        echo "<div class='text3'><a class='slider-button' href='" . esc_url ($slider['buttonurl']) . "'><span class='button-text'>" . esc_html ($slider['buttontext']) . "</span></a></div>\n";
                    }
                    echo "</div>\n";
                }
            }
            ?>

        </div>
        <div class="kennav">
            <ul>
                <?php
                if($slideritem) {
                    foreach ($slideritem as $id => $slider) {
                        echo "<li data-seq='" . esc_attr($id) . "'>" . esc_html($id + 1) . "</li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="sliderloader bigloader"></div>

    <script>
        (function($){
            $(document).ready(function(){

                if($(".fs-container").length) {
                    $(".fs-container").fsfullheight(['.headermenu', '.responsiveheader', '.topnavigation']);
                    $(".sliderloader").show();
                }

                var instance = null;
                var resizetimeout = null;

                /** Kenburn slider **/
                var recreate_slider = function(){
                    if(instance !== null) instance.stop();
                    $(".kenburntextcontent").hide();
                    $(".kenburntextcontent > div").attr('style', '');

                    $(".kenburns").remove();
                    $(".kenburnwrapper").append("<canvas class='kenburns'></canvas>");
                    $('.kenburns').attr('width',$(".fs-container").width()).attr('height',$(".fs-container").height());

                    instance = $('.kenburns').kenburned({
                        images:[
                            <?php
                             if($slideritem) {
                                foreach($slideritem as $id => $slider) {
                                    echo "'" . jeg_get_image_attachment_full($slider['background']) . "',";
                                }
                             }
                            ?>
                        ],
                        frames_per_second: 30,
                        display_time: <?php echo esc_js ( vp_metabox('photology_kenburn.displaytime') ); ?>,
                        fade_time: <?php echo esc_js ( vp_metabox('photology_kenburn.fadetime') ); ?>,
                        zoom: <?php echo esc_js ( vp_metabox('photology_kenburn.zoom') ); ?>,
                        background_color:'#<?php echo esc_js ( vp_metabox('photology_kenburn.color') ); ?>'
                    });
                };

                $(window).bind('resize load', function(){
                    clearTimeout(resizetimeout);
                    resizetimeout = setTimeout(function(){
                        recreate_slider();
                    }, 250);
                });
            });
        })(jQuery);
    </script>
    <!-- end IOS Slider -->

<?php
} else {
    get_template_part('fragment/password-form');
}
get_footer();