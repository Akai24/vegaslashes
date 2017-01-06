/**
 * jquery.jnormalblog.js
 */
(function ($) {
    "use strict";
    $.fn.jnormalblog = function (options) {

        options = $.extend({
            followlike: 0
        }, options);

        return $(this).each(function () {

            var blog_content_type = function () {
                // gallery
                if ($(".article-slider-wrapper").length) {
                    $(".article-slider-wrapper").each(function () {
                        $(".article-slider-wrapper").imagesLoaded(function () {
                            $(".article-slider-wrapper").removeClass('loading');
                            $(".article-image-slider").fadeIn();
                            create_fotorama();
                        });
                    });
                }

                // youtube
                if ($("[data-type='youtube']").length) {
                    $("[data-type='youtube']").each(function () {
                        var autoplay = $(this).data('autoplay');
                        var repeat = $(this).data('repeat');
                        $.type_video_youtube($(this), autoplay, repeat);
                    });
                }

                // vimeo
                if ($("[data-type='vimeo']").length) {
                    $("[data-type='vimeo']").each(function () {
                        var autoplay = $(this).data('autoplay');
                        var repeat = $(this).data('repeat');
                        $.type_video_vimeo($(this), autoplay, repeat);
                    });
                }

                // sound cloud
                if ($("[data-type='soundcloud']").length) {
                    $("[data-type='soundcloud']").each(function () {
                        $.type_soundcloud($(this));
                    });
                }

                // html 5 video
                if ($("[data-type='html5video']").length) {
                    $("[data-type='html5video']").each(function () {
                        $.type_video_html5($(this), false, {
                            enableAutosize: true,
                            videoWidth: '100%',
                            videoHeight: '100%',
                            features: ['playpause', 'progress', 'current', 'duration', 'tracks', 'volume', 'fullscreen']
                        }, '.video-container');
                    });
                }

                if ($("[data-type='audio']").length) {
                    $("[data-type='audio']").each(function () {
                        $.type_audio($(this));
                    });
                }
            };

            var create_fotorama = function () {
                $(".article-image-slider").fotorama({
                    allowfullscreen: false,
                    arrows: false,
                    width: '100%',
                    maxWidth: '100%'
                });
            };

            var followlike = function () {
                $(".article-share").jsharefollow();
            };

            var blog_shortcode = function () {
                if ($("[data-toggle='tooltip']").length) {
                    $("[data-toggle='tooltip']").tooltip();
               }
                if ($(".jrmap").length) {
                    do_load_googlemap('mapshortcode');
                }
                if ($(".skillgraph").length) {
                    $(window).bind('load', function () {
                        $(".skillgraph").jskill();
                    });
                }
            };

            var blog_facebook_widget = function(){
                if($(".blog-fb-likebox").length){
                    window.fbAsyncInit = function() {
                        FB.init({
                            xfbml      : true,
                            version    : 'v2.0'
                        });
                    };

                    (function(d, s, id){
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) {return;}
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/en_US/sdk.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                }
            };


            var open_share = function() {
                "use strict";
                $(".socials-share > a").each(function(){
                    $(this).bind('click', function(e){
                        e.preventDefault();
                        var url = $(this).attr('href');
                        var social = $(this).data('shareto');
                        window.open(url, joption.shareto , "height=300,width=600");
                    });
                });
            }

            var blog_expand = function(){
                $('body').magnificPopup({
                    type: 'image',
                    delegate: 'a.expand',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    gallery: {enabled: true},
                    callbacks: {
                        elementParse: function (item) {

                            if ($(item.el).data('expand-mode') === 'image') {
                                item.type = 'image';
                            } else if ($(item.el).data('expand-mode') === 'html5video') {
                                item.type = 'inline';

                                // video type
                                var dummyvideotest = "<video></video>",
                                    canplaymp4 = $(dummyvideotest).get(0).canPlayType("video/mp4"),
                                    canplaywebm = $(dummyvideotest).get(0).canPlayType("video/webm"),
                                    canplayogg = $(dummyvideotest).get(0).canPlayType("video/ogg");

                                // options
                                options = {
                                    videoWidth: '100%',
                                    videoHeight: '100%'
                                };

                                // option video player (force to use flash)
                                if (!window.joption.ismobile && ((canplaymp4 === 'maybe' || canplaymp4 === '') && (canplaywebm === 'maybe' || canplaywebm === '') && (canplayogg === 'maybe' || canplayogg === ''))) {
                                    options.mode = 'shim';
                                }

                                // option feature
                                options.features = ['playpause', 'progress', 'current', 'duration', 'tracks', 'volume', 'fullscreen'];

                                // exec media element player
                                $(".html5popup-wrapper video").mediaelementplayer(options);
                            } else if ($(item.el).data('expand-mode') === 'soundcloud-gallery') {
                                item.type = 'iframe';
                                item.src = "https://w.soundcloud.com/player/?url=" + encodeURIComponent(item.src);
                            } else {
                                item.type = 'iframe';
                            }
                        }
                    }
                });
            };

            blog_shortcode();
            blog_content_type();
            blog_facebook_widget();
            blog_expand();
            create_fotorama();
            open_share();

            $.bindComment();
            if (options.followlike === 1) {
                $(window).bind('load', followlike);
            }
        });
    };
})(jQuery);

/** need to use asynch map and loaded only when it needed **/
function mapshortcode() {
    jQuery(".jrmap").jrmap();
}