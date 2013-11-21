(function($){

    "use strict";

    // inits
    immediateInit();
    $(document).ready(domInit);
    $(window).load(pageInit);


    /*
    * Run immediately
    */
    function immediateInit() {

    }

    /*
    * Run on DOM load
    */
    function domInit(){
        ASag.responsiveMenu.init();
        ASag.homeSlides.init();
        ASag.releases.init();

        $('a[rel="external"]').attr('target', '_blank');
    }

    /*
    * Run on page (window) load
    */
    function pageInit() {

    }

})(jQuery);