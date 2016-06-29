/* Site Scripts ------------------------------------------------- */

jQuery(document).ready(function($) {

    // Mobile Nav Menu
    $('.nav-toggle').on('click', function() {
        $('header nav').slideToggle();
        $(this).toggleClass('active');
    });

});
