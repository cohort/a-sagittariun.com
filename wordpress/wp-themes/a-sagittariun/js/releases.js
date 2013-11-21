/*
 * Releases
 */
ASag.releases = (function($) {

    "use strict";

    var
        // vars
        $releases = $(".release"),
        $iframes = $("iframe"),
        $iframeClones = $iframes.clone(true),
        currentRelease,

        // funcs
        init, toggleRelease, toggleReleaseCheck;


        init = function() {

            if ($releases.length < 1) { return; }

            $releases.each(function(counter, el){
                $(el).data("counter", counter);
            });

            $releases.on("click", toggleReleaseCheck);
            $releases.find(".release-toggle").on("click", toggleRelease);
            $releases.find(".release-content").css({opacity:0});

            $iframes.remove();
        };

        toggleReleaseCheck = function(e) {
            if (e.target.tagName.toLowerCase() !== "a") {
                toggleRelease(e);
            }
        };

        toggleRelease = function(e) {
            e.preventDefault();
            var $release = $(e.target).closest(".release");
            if (currentRelease) {
                $(currentRelease).find(".release-toggle").text("Listen");
                $(currentRelease).find(".release-content")
                    .slideUp({
                        easing:"easeInQuad",
                        duration:250,
                        complete:function() {
                            $(this).empty();
                        }
                    });
            }
            if (currentRelease !== $release[0]) {
                $release.find(".release-toggle").text("Close");
                $release.find(".release-content")
                    .append($iframeClones[$release.data("counter")])
                    .slideDown({
                        easing:"easeOutQuad",
                        duration:250,
                        complete:function(){
                            $(this).animate({opacity:1}, { duration:250 });
                            $('html, body').animate({ scrollTop: $release.offset().top }, 250);
                        }
                    });
                currentRelease = $release[0];
            } else {
                currentRelease = null;
            }
        };


        return {
            init: init
        };

})(jQuery);