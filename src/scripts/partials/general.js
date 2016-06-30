/* Site Scripts ------------------------------------------------- */

jQuery(document).ready(function($) {

    // Mobile Nav Menu
    $('.nav-toggle').on('click', function() {
        $('header nav').slideToggle();
        $(this).toggleClass('active');
    });

    $('.menu-item-has-children').each(function(e) {
        var self = $(this);
        self.append('<span class="toggle-sub"></span>');
    });

    $('.toggle-sub').click(function(e) {
        $(this).toggleClass('active');
        var submenu = $(this).prev('.sub-menu');

        if ( submenu.is(':visible')) {
            submenu.slideToggle();
        } else {
            $('.sub-menu').slideUp();
            submenu.slideToggle();
        }

        e.preventDefault();
    });

});
