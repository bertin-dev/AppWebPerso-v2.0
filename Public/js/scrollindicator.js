
(function($) {
    $.fn.prognroll = function(options) {

        var settings = $.extend({
            height: 2, //Progress bar height
            color: "#0a8de0", //Progress bar background color
            custom: false, //If you make it true, you can add your custom div and see it's scroll progress on the page.
            transition: "top .5s",
            transparenceProgessBar: "0 2px 7px #0a8de0,0 1px 2px rgba(0,0,0,.2) inset"
        }, options);

        return this.each(function() {
            if ($(this).data('prognroll')) {
                return false;
            }
            $(this).data('prognroll', true);

            var $span = $("<span>", {
                class: "bar"
            });
            $("body").prepend($span);

            $span.css({
                position: "fixed",
                top: 50,
                left: 0,
                width: 0,
                height: settings.height,
                backgroundColor: settings.color,
                zIndex: 9999999,
                transition: settings.transition,
                boxShadow: settings.transparenceProgessBar
            });

            if (settings.custom === false) {

                $(window).scroll(function(e) {
                    e.preventDefault();
                    var windowScrollTop = $(window).scrollTop();
                    var windowHeight = $(window).outerHeight();
                    var bodyHeight = $(document).height();

                    var total = (windowScrollTop / (bodyHeight - windowHeight)) * 100;

                    $(".bar").css("width", total + "%");
                });

            } else {

                $(this).scroll(function(e) {
                    e.preventDefault();
                    var customScrollTop = $(this).scrollTop();
                    var customHeight = $(this).outerHeight();
                    var customScrollHeight = $(this).prop("scrollHeight");

                    var total = (customScrollTop / (customScrollHeight - customHeight)) * 100;

                    $(".bar").css("width", total + "%");
                });

            }

            /* Get scroll position  on page load */
            $(window).on('hashchange', function(e) {
                e.preventDefault();
                console.log($(window).scrollTop());
            });
            $(window).trigger('hashchange');

            var windowScrollTop = $(window).scrollTop();
            var windowHeight = $(window).outerHeight();
            var bodyHeight = $("body").outerHeight();

            var total = (windowScrollTop / (bodyHeight - windowHeight)) * 100;

            $(".bar").css("width", total + "%");
            /* Get scroll position on on page load */

        });
    };
})(jQuery);
