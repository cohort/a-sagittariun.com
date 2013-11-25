/*
 * Slides
 */
ASag.homeSlides = (function($) {

    "use strict";

    var
        // vars
        $bgs = $(".bg-img"),
        $slides = $(".slide"),
        $soundBars = $(".sound-control-bar"),
        $slider = $('.bg-container'),
        $audio,
        $currentSlide,
        isPlaying = false,
        animateBarsTimeout,
        trackTime = 0,
        trackDuration = 0,

        // funcs
        init, initShare,
        toggleFullscreen,
        updateTimer,
        createAudio, loadTrack, playAudio, pauseAudio, stopAudio,
        hideSoundBars, animateSoundBars, stopAnimatingSoundBars;


        init = function() {

            if ($slides.length < 1) { return; }

            // https://github.com/woothemes/FlexSlider/wiki/FlexSlider-Properties
            $slider.flexslider({
                animation      : "slide",
                selector       : ".bg > .bg-img",
                slideshow      : false,
                controlNav     : false,
                prevText       : "&lt;",
                nextText       : "&gt;",

                // fade slide content
                before: function(slider){
                    $slides.not(":eq("+slider.animatingTo+")").fadeOut();
                    $currentSlide = $slides.eq(slider.animatingTo);

                    $currentSlide.fadeIn();
                    var trackNo = $currentSlide.data("track");
                    if (trackNo) {
                        loadTrack(trackNo);
                    } else {
                        stopAudio();
                    }
                }
            });

            // FF
            $(".flex-direction-nav a").on("click", function(e){
                $(e.target).closest("a").blur();
            });

            // full screen
            $(window).keypress(function(e){
                if (e.charCode === 102) { // F
                    toggleFullscreen();
                }
            });

            // controls
            $(".slide-control-back").on("click", function(){
               $slider.flexslider("prev");
            });
            $(".slide-control-forward").on("click", function(){
               $slider.flexslider("next");
            });
            $(".slide-control-fullscreen").on("click", function(){
               toggleFullscreen();
            });

            // swipe
            $("#content").swipe({
                swipe:function(event, direction, distance, duration, fingerCount) {
                    if (direction === "left") {
                        $slider.flexslider("next");
                    } else if (direction === "right") {
                        $slider.flexslider("prev");
                    }
                },
            });

            // play/pause
            $(".sound-control").on("click", function(e){
                e.preventDefault();
                $(e.target).closest("a").blur();
                if (!$audio) { return; }
                if (isPlaying) {
                    pauseAudio();
                } else {
                    playAudio();
                }
            });

            initShare();
        };

        toggleFullscreen = function() {
            screenfull.toggle($("#page")[0]);
        };

        loadTrack = function(track) {
            stopAudio();
            createAudio();
            $("<source/>").attr("src", templateDirectory+"/audio/"+track+".mp3").attr("type", "audio/mpeg").appendTo($audio);
            $("<source/>").attr("src", templateDirectory+"/audio/"+track+".ogg").attr("type", "audio/ogg").appendTo($audio);
            $audio[0].load();
            $audio[0].play();
            $audio.on("loadedmetadata", function(e){
                playAudio();
                trackDuration = $audio[0].duration;
                updateTimer();
            });
            $audio.on("timeupdate", function(e) {
                trackTime = $audio[0].currentTime;
                updateTimer();
            });
            $audio.on("ended", function(e){
                $slider.flexslider("next");
            });
        };

        createAudio = function() {
            $audio = $("<audio/>").prop("autoplay",true).appendTo("#page");
        };

        playAudio = function() {
            $audio[0].play();
            if (!animateBarsTimeout) {
                animateSoundBars();
            }
            isPlaying = true;
        };

        pauseAudio = function() {
            $audio[0].pause();
            stopAnimatingSoundBars();
            isPlaying = false;
        };

        stopAudio = function() {
            if ($audio) {
                $audio[0].pause();
                $audio.remove();
            }
            hideSoundBars();
            trackTime = 0;
            trackDuration = 0;
            isPlaying = false;
        };

        hideSoundBars = function() {
            stopAnimatingSoundBars();
            $soundBars.each(function(counter,el){
                el.style.height = "0%";
            });
        };

        animateSoundBars = function() {
            $soundBars.each(function(counter,el){
                var height = Math.floor(Math.random() * 100);
                el.style.height = height + "%";
            });
            animateBarsTimeout = setTimeout(animateSoundBars, 100);
        };

        stopAnimatingSoundBars = function() {
            clearTimeout(animateBarsTimeout);
            animateBarsTimeout = null;
        };

        updateTimer = function() {
            if (trackDuration > 0 && trackTime > 0) {
                var $progress = $currentSlide.find(".progress");
                var width = Math.round((trackTime/trackDuration)*100);
                $progress.css({width:width+"%"});
            }
        };

        initShare = function() {
            var $shareBtn = $(".share-link");
            var $shareOverlay = $(".share-popup");
            var $shareOverlayCloseBtn = $shareOverlay.find(".close");

            $shareBtn.click(showShareOverlay);
            $shareOverlayCloseBtn.click(hideShareOverlay);

            $(document).keyup(function(e) {
                if (e.keyCode == 27) { hideShareOverlay(e); }   // esc
            });

            function showShareOverlay(e) {
                e.preventDefault();
                $shareOverlay.fadeIn();
            }
            function hideShareOverlay(e) {
                e.preventDefault();
                $shareOverlay.fadeOut();
            }
        };

        return {
            init: init
        };

})(jQuery);