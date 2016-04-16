/*
 * Slides
 */
ASag.homeSlides = (function($) {

    "use strict";

    var
        // vars
        $bgs = $(".bg-img"),
        $tracks = $(".track"),
        $soundBars = $(".sound-control-bar"),
        $trackr = $('.bg-container'),
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

            if ($tracks.length < 1) { return; }

            // https://github.com/woothemes/FlexSlider/wiki/FlexSlider-Properties
            $trackr.flexslider({
                animation      : "track",
                selector       : ".bg > .bg-img",
                trackshow      : false,
                controlNav     : false,
                prevText       : "&lt;",
                nextText       : "&gt;",

                // fade track content
                before: function(trackr){
                    $tracks.not(":eq("+trackr.animatingTo+")").fadeOut();
                    $currentSlide = $tracks.eq(trackr.animatingTo);

                    $currentSlide.fadeIn();
                    var trackNo = $currentSlide.data("track");
                    var album = $currentSlide.data("album");
                    if (trackNo) {
                        loadTrack(trackNo, album);
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
            $(".track-control-back").on("click", function(){
               $trackr.flexslider("prev");
            });
            $(".track-control-forward").on("click", function(){
               $trackr.flexslider("next");
            });
            $(".track-control-fullscreen").on("click", function(){
               toggleFullscreen();
            });

            // swipe
            $("#content").swipe({
                swipe:function(event, direction, distance, duration, fingerCount) {
                    if (direction === "left") {
                        $trackr.flexslider("next");
                    } else if (direction === "right") {
                        $trackr.flexslider("prev");
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

        loadTrack = function(track, album) {
            stopAudio();
            createAudio();
            $("<source/>").attr("src", templateDirectory+"/audio/"+album+"/"+track+".mp3").attr("type", "audio/mpeg").appendTo($audio);
            $("<source/>").attr("src", templateDirectory+"/audio/"+album+"/"+track+".ogg").attr("type", "audio/ogg").appendTo($audio);
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
                $trackr.flexslider("next");
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