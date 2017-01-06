(function($){
    $(document).ready(function(){

        var postrich = $("#postdivrich");

        var get_template_value = function() {
            return $("#page_template").val();
        };

        var normalize_view = function(){
            postrich.show();
            $("#normal-sortables > div").each(function(){
                $(this).attr('style', '');
            });
        };

        var page_metabox_visibililty = function() {
            var template = get_template_value();
            normalize_view();

            if(template === 'template-blog-normal.php' ) {
                $("#photology_normal_blog_metabox").show();
                $("#photology_blogcontent_metabox").show();
                postrich.hide();
            } else if(template === 'template-blog-masonry.php' ) {
                $("#photology_blogcontent_metabox").show();
                $("#photology_masonry_blog_metabox").show();
                postrich.hide();
            } else if(template === 'template-slider-kenburn.php' ) {
                $("#photology_kenburn_metabox").show();
                $("#photology_slider_content_metabox").show();
                postrich.hide();
            } else if(template === 'template-slider-ios.php' ) {
                $("#photology_ios_metabox").show();
                $("#photology_slider_content_metabox").show();
                postrich.hide();
            } else if(template === 'template-slider-service.php' ) {
                $("#photology_service_slider_metabox").show();
                postrich.hide();
            } else if(template === 'template-slider-gallery.php' ) {
                $("#photology_slider_gallery_metabox").show();
                $("#photology_slider_gallery").show();
                postrich.hide();
            } else if(template === 'template-gallery.php' ) {
                $("#photology_media_gallery_metabox").show();
                $("#photology_media_gallery").show();
                postrich.hide();
            } else if(template === 'template-gallery-content.php' ) {
                $("#photology_media_gallery_side_metabox").show();
                $("#photology_media_gallery_metabox").show();
                $("#photology_media_gallery").show();
                postrich.show();
            } else if(template === 'template-portfolio.php') {
                $("#photology_portfolio_list_metabox").show();
                postrich.hide();
            } else if(template === 'template-contact-fullmap.php'){
                $("#photology_contact_map_metabox").show();
                postrich.show();
            } else if(template === 'template-half-page.php'){
                $("#photology_page_metabox").show();
            } else {
                $("#photology_page_metabox").show();
                $("#photology_default_page_metabox").show();
                postrich.show();
            }
        };

        setTimeout(function(){ page_metabox_visibililty(); }, 500);
        $("#page_template").bind('change', page_metabox_visibililty);	});
})(jQuery);
