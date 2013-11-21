/*
 * Menu
 */
ASag.responsiveMenu = (function($) {

    "use strict";

    var
        // vars
        $wrapper,
        $menu,
        $trigger,

        // functions
        init, toggleMenu;


    // init
    init = function(){
        $wrapper    = $(".site-head");
        $menu       = $wrapper.find(".responsive-menu");
        $trigger    = $wrapper.find(".responsive-menu-toggle");

        $trigger.on("click", toggleMenu);
    };


    // open menu
    toggleMenu = function(e) {
        if (!!e) {
            e.preventDefault();
            e.stopPropagation();
        }

        var top = $wrapper.outerHeight();
        if ($("body").hasClass("admin-bar")) {
            top += $("#wpadminbar").outerHeight();
        }
        $menu.css({top:top});

        $wrapper.toggleClass("menu-open");
        $menu.fadeToggle();
    };

    // expose public methods
    return {
        init: init,
        toggleMenu: toggleMenu
    };

})(jQuery);