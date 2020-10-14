jQuery(document).ready(function($) {

/*------------------------------------------------
            DECLARATIONS
------------------------------------------------*/

    var loader = $('#loader');
    var scroll = $(window).scrollTop();  
    var scrollup = $('.backtotop');
    var menu_toggle = $('.menu-toggle');
    var dropdown_toggle = $('button.dropdown-toggle');
    var nav_menu = $('.shadow-main-navigation ul.nav-menu');
    var breaking_slider = $('.breaking-wrapper');
    var featured_slider = $('.slider-posts');
    var double_slider = $('.double-slider-posts');
    var regular = $('.regular');
    var masonry_gallery = $('.grid');


/*------------------------------------------------
            PRELOADER
------------------------------------------------*/

    loader.delay(1000).fadeOut("slow");

/*------------------------------------------------
                BACK TO TOP
------------------------------------------------*/

    $(window).scroll(function() {
        if ($(this).scrollTop() > 1) {
            scrollup.css({bottom:"25px"});
        } 
        else {
            scrollup.css({bottom:"-100px"});
        }
    });

    scrollup.click(function() {
        $('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });

/*------------------------------------------------
                MENU, STICKY MENU AND SEARCH
------------------------------------------------*/

    $('#topbar-menu > button').click(function(){
        $('#topbar-menu .wrapper').slideToggle();
        $('#topbar-menu').toggleClass('topbar-menu-active');
    });

    menu_toggle.click(function(){
        nav_menu.slideToggle();
       $('.shadow-main-navigation').toggleClass('menu-open');
    });

    dropdown_toggle.click(function() {
        $(this).toggleClass('active');
       $(this).parent().find('.sub-menu').first().slideToggle();
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() > 150) {
            $('.site-header').addClass('nav-shrink');             
        } 
        else {
            $('.site-header').removeClass('nav-shrink');
        }
    });

    $('.shadow-main-navigation ul li a.search').click(function() {
        $(this).toggleClass('search-open');
        $('.shadow-main-navigation #search').toggle();
        $('.shadow-main-navigation .search-field').focus();
        $('body').addClass('search-open');
    });

    $(document).keyup(function(e) {
        if (e.keyCode === 27) {
            $('.shadow-main-navigation .search').removeClass('search-open');
            $('.shadow-main-navigation #search').hide();
            $('body').removeClass('search-open');
        }
    });

    $(document).click(function (e) {
      var container = $("#shadow-masthead");
       if (!container.is(e.target) && container.has(e.target).length === 0) {
            $('.shadow-main-navigation .search').removeClass('search-open');
            $('.shadow-main-navigation #search').hide();
            $('body').removeClass('search-open');
        }
    });

/*------------------------------------------------
                SLICK SLIDERS
------------------------------------------------*/

breaking_slider.slick();
regular.slick();

featured_slider.slick();
regular.slick();

double_slider.slick({
    responsive: [
    {
        breakpoint: 769,
            settings: {
            slidesToShow: 1,
        }
    }
    ]
});

/*------------------------------------------------
                    STICKY-BAR
------------------------------------------------*/
    jQuery('#homepage-secondary').theiaStickySidebar({
        // Settings
        additionalMarginTop: 30
      });
    jQuery('#secondary').theiaStickySidebar({
        // Settings
        additionalMarginTop: 30
      });
    
/*--------------------------------------------------------------
 Keyboard Navigation
----------------------------------------------------------------*/
if( $(window).width() < 1024 ) {
        $( '#primary-menu > li:last-child' ).bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#shadow-masthead').find('.menu-toggle').focus();
            }
        });
    }
    else {
        $( '#primary-menu > li:last-child' ).unbind('keydown');
    }
    $(window).resize(function() {
        if( $(window).width() < 1024 ) {
            $( '#primary-menu > li:last-child' ).bind( 'keydown', function(e) {
                if( e.which === 9 ) {
                    e.preventDefault();
                    $('#shadow-masthead').find('.menu-toggle').focus();
                }
            });
        }
        else {
            $( '#primary-menu > li:last-child' ).unbind('keydown');
        }
    });

    if( $(window).width() < 1024 ) {
        $( '#topbar-menu' ).find('li').last().bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#topbar-menu').find('button').focus();
            }
        });
    }
    else {
        $( '#topbar-menu' ).find('li').unbind('keydown');
    }
    $(window).resize(function() {
        if( $(window).width() < 1024 ) {
            $( '#topbar-menu li' ).find('li').bind( 'keydown', function(e) {
                if( e.which === 9 ) {
                    e.preventDefault();
                    $('#topbar-menu').find('button').focus();
                }
            });
        }
        else {
            $( '#topbar-menu li' ).find('li').unbind('keydown');
        }
    });


/*------------------------------------------------
            MASONRY GALLERY
------------------------------------------------*/
    
    masonry_gallery.imagesLoaded( function() {
        masonry_gallery.packery({
            itemSelector: '.grid-item'
        });
    });

/*------------------------------------------------
            MATCH HEIGHT
------------------------------------------------*/
$('#trending .shadow-entry-container').matchHeight();
$('.shadow-column-two .shadow-entry-container').matchHeight();
$('#must-read .shadow-entry-container').matchHeight();
$('.archive article .shadow-entry-container').matchHeight();


/*------------------------------------------------
                END JQUERY
------------------------------------------------*/

});