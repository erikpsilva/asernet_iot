$(document).ready(function() {
    var $header = $('.header');
    var $toggle = $('.header__toggle');
    var $mega = $('.header__mega');
    var $megaLink = $('.header__nav-link--mega');
    var $megaPanel = $('.header__mega-panel');
    var megaCloseTimer;

    function alignMegaArrow() {
        if (window.innerWidth <= 991) return;
        var panelLeft = $megaPanel.offset().left;
        var linkCenter = $megaLink.offset().left + $megaLink.outerWidth() / 2;
        var arrowLeft = linkCenter - panelLeft - 8;
        $megaPanel.css('--arrow-left', arrowLeft + 'px');
    }

    function closeMenu() {
        $header.removeClass('header--menu-open');
        $toggle.attr('aria-expanded', 'false');
    }

    $toggle.on('click', function() {
        var isOpen = $header.toggleClass('header--menu-open').hasClass('header--menu-open');
        $toggle.attr('aria-expanded', isOpen ? 'true' : 'false');
    });

    $('.header__nav a').on('click', function() {
        closeMenu();
    });

    $mega.on('mouseenter', function() {
        clearTimeout(megaCloseTimer);
        alignMegaArrow();
        $mega.addClass('header__mega--open');
        $megaLink.attr('aria-expanded', 'true');
    });

    $mega.on('mouseleave', function() {
        megaCloseTimer = setTimeout(function() {
            $mega.removeClass('header__mega--open');
            $megaLink.attr('aria-expanded', 'false');
        }, 220);
    });

    $mega.on('focusin', function() {
        $mega.addClass('header__mega--open');
        $megaLink.attr('aria-expanded', 'true');
    });

    $mega.on('focusout', function() {
        $mega.removeClass('header__mega--open');
        $megaLink.attr('aria-expanded', 'false');
    });

    $(document).on('keyup', function(event) {
        if (event.key === 'Escape') {
            closeMenu();
            $mega.removeClass('header__mega--open');
            $megaLink.attr('aria-expanded', 'false');
        }
    });

    $(window).on('resize', function() {
        if (window.innerWidth > 991) {
            closeMenu();
            alignMegaArrow();
        }
    });

    alignMegaArrow();
});
