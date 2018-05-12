/*================================================================*\

 Name: Scripts.js
 Author: Theme pxlr
 Author URI: http://www.pixelaar.com
 Version: 0.1

 \*================================================================*/


jQuery(function ($) {

    'use strict';

    /*================================================================*\
     ================================================================
     Table Of Contents
     ================================================================

     # Blank JS Wrapper
     # Off Canvas Menu
     # Mega Menu widget nav menu sub
     # Enable Bootstrap tooltip
     # Sticky Blog Sidebar
     # Sticky Menu
     # Enable Bootstrap DropDown
     # Drop Down Menu
     # Back to Top
     # Twitter Scroll Widget
     # Flickr Photo Feed
     # prettyPhoto Image Popup
     # Social Share Button Popup
     # MiniCart count on Added to cart
     # MiniCart remove item ajax
     # Before Remove From MiniCart Action
     # After Removed From MiniCart Action
     # MiniCart refresh
     # Login modal
     # Single Product Gallery
     # Variation Product Carousal
     # Product filter toggle
     # Category list toggle button
     # Enable Select2 on Country Select and State Select
     # Page Pre loader Remove after Page Load
     # Material Style SelectBox

     \*================================================================*/


    // ================================================================
    // Blank JS Wrapper
    // ================================================================

    (function () {


    }());

    // ================================================================
    // Off Canvas Menu
    // ================================================================

    (function () {

        // click button
        $('.navbar-toggle').blogeyOffCanvasMenu({

            documentWrapper : '#wrapper',
            contentWrapper  : '.contents',
            position        : blogeyJSObject.offcanvas_menu_position,    // class name
            // opener         : 'st-menu-open',         // class name
            effect          : blogeyJSObject.offcanvas_menu_effect,  // class name
            closeButton     : '.close-sidebar',
            menuWrapper     : '#offcanvasmenu',                // class name
            documentPusher  : '.pusher'
        });
    }());

    // ================================================================
    // Mega Menu widget nav menu sub
    // ================================================================

    (function () {

        $('.megamenu-widget.widget_nav_menu .current-menu-item').parents("ul.sub-menu").addClass('show-child');

        $('.megamenu-widget.widget_nav_menu .menu-item-has-children > a').each(function () {
            $(this).append($('<i class="fa fa-angle-right child-opener"></i>'));
        });

        $('.megamenu-widget.widget_nav_menu .menu-item-has-children > ul').each(function () {
            $(this).prepend($('<li class="child-closer-wrapper"><a class="child-closer" href="#"><i class="fa fa-angle-left"></i> Back </a></li>'));
        });

        $('.megamenu-widget.widget_nav_menu .menu-item-has-children .child-opener').on('click', function (e) {

            e.preventDefault();

            $(this).closest('li').find('>ul').addClass('show-child');
            //var height = $(this).closest('li').find('>ul').height();
            var height = $(this).closest('li').find('>ul')[0].scrollHeight;
            $(this).closest('.megamenu-widget.widget_nav_menu > div > ul').css('height', height);

        });

        $('.megamenu-widget.widget_nav_menu .menu-item-has-children .child-closer').on('click', function (e) {

            e.preventDefault();

            $(this).closest('ul').removeClass('show-child');
            //var height = $(this).closest('ul').prev().closest('ul').height();
            var height = $(this).closest('ul').prev().closest('ul')[0].scrollHeight;

            if ($(this).closest('ul').prev().closest('ul').is($(this).closest('ul.menu'))) {
                $(this).closest('.megamenu-widget.widget_nav_menu > div > ul').css('height', '');
            }
            else {
                $(this).closest('.megamenu-widget.widget_nav_menu > div > ul').css('height', height);
            }
        });
    }());

    // ================================================================
    // Enable Bootstrap tooltip
    // ================================================================

    (function () {
        $('[data-toggle="tooltip"]').tooltip();
    }());

    // ================================================================
    // Sticky Blog Sidebar
    // ================================================================
    if (blogeyJSObject.is_sticky_sidebar && (blogeyJSObject.is_home || blogeyJSObject.is_single_post)) {
        (function () {

            $('.blog-section .right-sidebar, .blog-section .left-sidebar').stick_in_parent();
        }());
    }

    // ================================================================
    // Sticky Menu
    // ================================================================

    if (blogeyJSObject.is_sticky_menu) {
        (function () {

            var class_added = false;

            var minimum_scroll_to_show = 150; // px

            $(document.body).on('windowScrolling', function (event, current_position, last_position, default_position) {

                // Going down and reach minimum scroll requirement :)
                if ((current_position >= last_position || current_position <= minimum_scroll_to_show) && class_added) {
                    $('.header').removeClass('sticky-header animated fadeInDown');
                    class_added = false;
                }

                // Going up and class already added :)
                if ((current_position <= last_position && current_position >= minimum_scroll_to_show) && !class_added) {
                    $('.header').addClass('sticky-header animated fadeInDown');
                    class_added = true;
                }
            });
        }());
    }


    // ================================================================
    // Enable Bootstrap DropDown
    // ================================================================

    (function () {
        $('[data-toggle="dropdown"]').dropdown();
    }());

    // ================================================================
    // Drop Down Menu
    // ================================================================

    (function () {

        function getIEVersion() {
            var match = navigator.userAgent.match(/(?:MSIE |Trident\/.*; rv:)(\d+)/);
            return match ? parseInt(match[1]) : false;
        }

        if (getIEVersion()) {
            $('html').addClass('ie ie' + getIEVersion());
        }

        if ($('html').hasClass('ie9') || $('html').hasClass('ie10')) {
            $('.submenu-wrapper').each(function () {
                $(this).addClass('no-pointer-events');
            });
        }


        var timer;

        $('li.dropdown').on('mouseenter', function (event) {


            event.stopImmediatePropagation();
            event.stopPropagation();

            $(this).removeClass('open menu-animating').addClass('menu-animating');
            var that = this;

            if (timer) {
                clearTimeout(timer);
                timer = null;
            }

            timer = setTimeout(function () {

                $(that).removeClass('menu-animating');
                $(that).addClass('open');

            }, 300);   // 300ms as css animation end time

        });

        // on mouse leave

        $('li.dropdown').on('mouseleave', function (event) {

            var that = this;

            $(this).removeClass('open menu-animating').addClass('menu-animating');


            if (timer) {
                clearTimeout(timer);
                timer = null;
            }

            timer = setTimeout(function () {

                $(that).removeClass('menu-animating');
                $(that).removeClass('open');

            }, 300);  // 300ms as animation end time

        });

    }());

    // ================================================================
    // Back to Top
    // ================================================================

    (function () {
        $('#toTop').on('click', function () {
            $("html, body").animate({scrollTop : 0}, 600);
            return false;
        });
    }());

    // ================================================================
    // prettyPhoto Image Popup
    // ================================================================

    (function () {
        $(window).load(function () {
            $("a[href$='.png'], a[href$='.jpg'], a[href$='.jpeg'], .element-lightbox").prettyPhoto({
                social_tools : ''
            });
        });
    }());

    // ================================================================
    // Video Popup
    // ================================================================

    (function () {

        $('.video-popup')
            .on('show.bs.modal', function () {
                var data = $(this).next().html();
                $(this).find('.embed-responsive').html('').html(data);
            })
            .on('hide.bs.modal', function () {
                $(this).find('.embed-responsive').html('');
            });

    }());

    // ================================================================
    // Social Share Button Popup
    // ================================================================

    (function () {
        $('.social a').on('click', function () {
            var newwindow = window.open($(this).attr('href'), '', 'height=450,width=700');
            if (window.focus) {
                newwindow.focus()
            }
            return false;
        });
    }());


    // ================================================================
    // Search Box
    // ================================================================

    (function () {
        $('.search-btn').on('click', function () {
            $('body').stop().addClass('active-searchbox');
            $('.input-search').trigger('focus');
        });

        $('.icon-close').on('click', function () {
            $('body').stop().removeClass('active-searchbox');
        });
    }());

    // ================================================================
    // Material input styles
    // ================================================================

    (function () {

        // Check default values
        $(".input-field .form-control").each(function () {
            if ($(this).val() !== "") {
                $(this).closest('.input-field').addClass("is-completed");
            }
        });

        // Active and focused on focus
        $(".input-field .form-control").on('focus', function () {
            $(this).closest('.input-field').addClass("is-active is-completed");
        });

        // Inactive on focusout
        $(".input-field .form-control").on('focusout', function () {
            if ($(this).val() === "") {
                $(this).closest('.input-field').removeClass("is-completed");
            }
            $(this).closest('.input-field').removeClass("is-active");
        });
    }());


    // ================================================================
    // Testimonial Carousel
    // ================================================================




    // ================================================================
    // Page Pre loader Remove after Page Load
    // ================================================================

    (function () {
        $(window).load(function () {
            $('#page-pre-loader').fadeOut(500, function () {
                $(this).remove();
            });
        });
    }());

});  // end of jquery main wrapper