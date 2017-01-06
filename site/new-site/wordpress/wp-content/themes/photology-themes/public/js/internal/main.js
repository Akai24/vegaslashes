(function ($, window, document, MediaElement) {
    "use strict";


    function dispatch() {

        /*************************
         * fix anything
         *************************/

        $(window).bind('load', function () {
            $(window).trigger('resize');

            if($(".landingpagewrapper").length) {
                setTimeout(function(){
                    $(window).trigger('resize');
                }, 3000);
            }
        });

        /**************************
         * Collapsible Navigation
         *************************/

        if ($(".sidebarcollapse").length) {
            var showcollapsiblemenu = function (e) {
                if (this === e.target) {
                    $("#leftsidebar").animate({
                        "left": 0
                    });

                    $(".csbwrapper").fadeOut();
                    $(".lefttop, .leftfooter").fadeIn();
                }
            };
            $(".csbwrapper, .csbhicon, .cbsheader").bind('click', showcollapsiblemenu);

            var hidecollapsiblemenu = function () {
                var leftpos = "-210px";
                if ($(window).width() <= 1024) { leftpos = "-190px"; }

                $("#leftsidebar").animate({
                    "left": leftpos
                });
                $(".lefttop, .leftfooter").fadeOut(function () {
                    $(".csbwrapper").fadeIn();
                });
            };

            $(".sidebarcollapse #leftsidebar").hoverIntent({
                over: function () {
                },
                out: function () {
                    hidecollapsiblemenu();
                },
                timeout: 500
            });

            $(window).bind('resize', hidecollapsiblemenu);
        }

        /**************************
         * search function
         **************************/

        var toogle_search = function (event) {
            event.preventDefault();
            if ($("body").hasClass('opensearch')) {
                $("body").removeClass('opensearch');
                $(".topsearchwrapper").fadeOut();
            } else {
                $("body").addClass('opensearch');
                $(".searchcontent input").focus();
                $(".topsearchwrapper input").focus();
                $(".topsearchwrapper").fadeIn();
            }
        };

        $(".searchheader, .topnavigationsearch").bind('click', toogle_search);
        $(".closesearch").bind('click', toogle_search);
        $(".searchcontent input").width($("#rightsidecontainer").width() - 70);


        /**************************
         * mobile search
         **************************/

        $(".mobile-search-trigger").bind('click', function () {
            $(".mobilesearch").show();
            $(".mobilesearch input").focus();
        });
        $(".closemobilesearch").bind('click', function () {
            $(".mobilesearch").hide();
        });


        /**************************
         * mobile menu
         **************************/

        var mobilemenu = function (element) {
            var role = "main-mobile-menu";
            $(".mobile-menu-trigger").removeClass('active');

            if ($('body').hasClass('menuopen')) {
                $('body').removeClass('menuopen').attr('role', '');
                $(".contentoverflow").hide();
            } else {
                $(element).addClass('active');
                $('body').addClass('menuopen').attr('role', role);
                $(".contentoverflow").show();
            }
        };

        $(".mobile-menu-trigger").bind('click', function () {
            mobilemenu(this);
        });
        $(".contentoverflow").bind('click', function () {
            mobilemenu(null);
        });


        /**************************
         * menu
         **************************/


        $(".mainnav li").bind('click', function (e) {
            var element = $(e.target).parents('li').get(0);

            if (e.currentTarget === element) {
                if ($(element).find("> .childmenu").length) {
                    e.preventDefault();
                    $(element).siblings().each(function () {
                        $(this).removeClass("menudown")
                            .find('> .childmenu')
                            .slideUp("fast");
                    });

                    if ($(element).hasClass("menudown")) {
                        $(element).removeClass("menudown")
                            .find('> .childmenu')
                            .slideUp("fast", function () {
                                $(window).trigger('navchange');
                            });
                    } else {
                        $(element).addClass("menudown")
                            .find('> .childmenu')
                            .slideDown("fast", function () {
                                $(window).trigger('navchange');
                            });
                    }
                } else {
                    return true;
                }
            }
        });

        $(".childmenu").each(function () {
            var element = $(this).prev();
            $(element).append('<span class="arrow"></span>');
        });


        var active_class_name = ['current-menu-ancestor','current-menu-parent','current-menu-item'];
        var is_menu_active = function(element){
            for(var i = 0; i < active_class_name.length; i++) {
                if($(element).hasClass(active_class_name[i])) {
                    return true;
                }
            }
        };

        $(".mainnav li").each(function(){
            if(is_menu_active(this)) {
                $(this).trigger('click');
                if($(this).find('.childmenu').length === 0) {
                    return false;
                }
            }
        });

        /**************************
         * navigation scroll
         **************************/

        if (!$('body').hasClass('horizontalnav')) {
            $('.lefttop').jScrollPane({
                mouseWheelSpeed: 50,
                contentWidth: '0px'
            });
            var navscrolpane = $('.lefttop').data('jsp');

            var calculate_lefttop = function () {
                var ww = $(window).height();
                var leftfooterheight = $(".leftfooter").height();
                var lefttopheight = ww - leftfooterheight;
                $(".lefttop").height(lefttopheight);
                navscrolpane.reinitialise();
            };

            $(window).bind('resize navchange', calculate_lefttop);
            calculate_lefttop();
        }



        /**************************
         * tweetticker
         **************************/

        var tweetticker = function () {
            $('.jeg-tweets').each(function () {
                var element = $(this),
                    $tweet = null,
                    $next = null;
                $(element).height($(element).find('li:first').outerHeight());

                window.setInterval(function () {
                    $tweet = $(element).find('li:first');
                    $next = $tweet.next();

                    $(element).animate({height: ($next.outerHeight()) + 'px'}, 800);
                    $tweet.animate({marginTop: '-' + $tweet.outerHeight() + 'px'}, 400, function () {
                        $(this).detach().appendTo($(element).find('ul')).removeAttr('style');
                    });
                }, 4000);
            });
        };

        tweetticker();



        /**************************
         * sidebar follow
         *************************/

        if ($(".mainsidebar-wrapper").length) {
            var sidebar = $(".mainsidebar-wrapper");
            var parentsidebar = $(".mainsidebar");
            var parentpos, sidebarheight, sidebarwidth, wh, ww, sidebarmode, headermenuheight;
            var margin = 15;
            var bottommargin = 0;
            var enabled = true;

            var ishorizontal = $(".horizontalnav").length;
            var istwoline = $(".topnavtwoline").length;
            var issmallnav = $(".topnavsmaller").length;
            var issidenav = $(".sidenav").length;
            var issidenoheadermenu = $(".noheadermenu").length;

            var getheadermenuposition = function(){
                if(issidenav) {
                    if(issidenoheadermenu) {
                        headermenuheight = 0;
                    } else {
                        headermenuheight = $(".headermenu").height();
                    }
                } else if(ishorizontal) {
                    bottommargin = $(".footercontent").height();
                    headermenuheight = $(".topnavigation").height();

                    if(window.jpobj.globaltop > window.joption.menucollapsed) {
                        if (istwoline && !issmallnav) {
                            headermenuheight = $(".topwrapperbottom").height();
                        } else if( ( issmallnav && !istwoline ) || ( istwoline && issmallnav ) ) {
                            headermenuheight = window.joption.smallmenuheight;
                        }
                    }
                }

                headermenuheight = parseInt(headermenuheight, 10);
            };


            var setupsidebar = function () {
                getheadermenuposition();
                parentpos = $(parentsidebar).offset().top;
                sidebarheight = $(sidebar).height();
                sidebarwidth = $(sidebar).attr('style', '').css({
                    'position': 'relative'
                }).width();
                $(sidebar).width(sidebarwidth);

                wh = $(window).height();
                ww = $(window).width();

                if ((sidebarheight + margin + headermenuheight) < wh) {
                    sidebarmode = 'sticktop';
                } else {
                    sidebarmode = 'stickbottom';
                }

                if (sidebarheight > $('.mainpage').height()) {
                    enabled = false;
                } else {
                    enabled = true;
                }
            };

            var followsidebar = function () {
                getheadermenuposition();
                var sidebarpos;
                if (ww > 1152 && enabled) {
                    if (sidebarmode === 'stickbottom') {
                        sidebarpos = (window.jpobj.globaltop + wh) - sidebarheight - parentpos - bottommargin;

                        if (sidebarpos > 0) {
                            $(sidebar).css({
                                'top': -(sidebarheight + bottommargin - wh),
                                'position': 'fixed'
                            }).addClass('fixedelement');
                        } else {
                            $(sidebar).css({
                                'top': 0,
                                'position': 'relative'
                            }).removeClass('fixedelement');
                        }
                    } else {
                        sidebarpos = (window.jpobj.globaltop + headermenuheight + margin) - parentpos;

                        if (sidebarpos > 0) {
                            $(sidebar).css({
                                'top': parseInt(margin, 10) + parseInt(headermenuheight, 10),
                                'position': 'fixed'
                            }).addClass('fixedelement');
                        } else {
                            $(sidebar).css({
                                'top': 0,
                                'position': 'relative'
                            }).removeClass('fixedelement');
                        }
                    }
                } else {
                    $(sidebar).css({
                        'top': 0,
                        'position': 'relative'
                    });
                }
            };

            var dofollowsidebar = function () {
                setupsidebar();
                followsidebar();
            };

            $(window).bind('load', function () {
                dofollowsidebar();
                window.setTimeout(dofollowsidebar, 2000);
            });

            $(document).bind('ready', function () {
                dofollowsidebar();
                window.setTimeout(dofollowsidebar, 2000);
            });

            $(window).bind('resize', function () {
                dofollowsidebar();
                window.setTimeout(dofollowsidebar, 2000);
            });

            $(window).bind('scroll', followsidebar);
        }




    }


    $(document).ready(dispatch);

})(jQuery, window, document, window.MediaElement);