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
    
    // flexslider
    $('.flexslider').flexslider({
        controlNav: false
    });
    
    // init Isotope
    var $grid = $('.grid').isotope({
        itemSelector: '.grid-item',
        layoutMode: 'fitRows'
    });
    
    // change is-checked class on buttons
    $('.grid-filters').each( function( i, filters ) {
        var $filters = $( filters );
        $filters.on( 'click', 'li', function() {
            var filterValue = $( this ).attr('data-filter');
            console.log(filterValue);
            $grid.isotope({ filter: filterValue });
            $filters.find('.active').removeClass('active');
            $( this ).addClass('active');
        });
    });
    
    // Expand lists
    $('.expand-title').on('click', function() {
        
        if ( !$(this).hasClass('open')) {
            $('.expand-list li')
            .find('.expand-description').slideUp()
            .end()
            .find('.expand-title').removeClass('open')
            .end();
        }
        
        $(this).toggleClass('open');
        $(this).next('.expand-description').slideToggle();
    });
    
    // Equal Height Boxes
    $('.equal').matchHeight();
    
    // Expand/Collapse Filter Sections
    $('.searchandfilter h4').addClass('closed').next('ul, label').slideToggle();
    
    $('.searchandfilter h4').on('click', function() {
        $(this).toggleClass('closed').next('ul, label').slideToggle();
    });
    
    // Tabs
    $('.tab-nav a').on('click', function(e) {
        var id = $(this).attr('href');
        
        if ( id.substring(0, 1) == '#') {
            // Handle Nav
            $('.tab-nav a').removeClass('active');
            $(this).addClass('active');
            
            // Handle Tab Content
            $('.tab-content').removeClass('active');
            $('.tab-content' + id).addClass('active');
            
            e.preventDefault();
        }
    });
    
    // Smooth scroll to items!
    $('nav a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });    
    
});
