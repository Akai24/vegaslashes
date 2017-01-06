(function($){
    $(document).ready(function(){

        var get_template_value = function()
        {
            var element = $("select[name='photology_portfolio_setting[portfolio_layout]']");
            return $(element).val();
        };

        var normalize_view = function()
        {
            $("#postdivrich").show();
            $("#normal-sortables > div").each(function(){
                $(this).attr('style', '');
            });
        };

        var page_metabox_visibililty = function()
        {
            var template = get_template_value();
            normalize_view();

            if(template === 'ajax')
            {
                $("#photology_portfolio_meta_metabox").show();
                $("#photology_portfolio_ajax_metabox").show();
                $("#photology_portfolio_media_gallery").show();
                $("#postdivrich").show();
            } else if(template === 'sidecontent')
            {
                $("#photology_portfolio_meta_metabox").show();
                $("#photology_portfolio_sidecontent_metabox").show();
                $("#photology_portfolio_media_gallery").show();
                $("#postdivrich").show();
            } else if(template === 'anotherpage')
            {
                $("#photology_portfolio_link_metabox").show();
                $("#postdivrich").hide();
            }
        };

        setTimeout(function(){ page_metabox_visibililty(); }, 500);
        $("select[name='photology_portfolio_setting[portfolio_layout]']").bind('change', page_metabox_visibililty);
    });
})(jQuery);
