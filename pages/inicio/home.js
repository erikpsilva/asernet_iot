$(document).ready(function() {
    $('.header__toggle').on('click', function() {
        var $button = $(this);
        var isOpen = $('.header').toggleClass('header--menu-open').hasClass('header--menu-open');

        $button.attr('aria-expanded', isOpen ? 'true' : 'false');
    });
});
