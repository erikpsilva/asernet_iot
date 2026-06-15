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

    function isMobile() {
        return window.innerWidth <= 991;
    }

    $mega.on('mouseenter', function() {
        if (isMobile()) return;
        clearTimeout(megaCloseTimer);
        alignMegaArrow();
        $mega.addClass('header__mega--open');
        $megaLink.attr('aria-expanded', 'true');
    });

    $mega.on('mouseleave', function() {
        if (isMobile()) return;
        megaCloseTimer = setTimeout(function() {
            $mega.removeClass('header__mega--open');
            $megaLink.attr('aria-expanded', 'false');
        }, 220);
    });

    $mega.on('focusin', function() {
        if (isMobile()) return;
        $mega.addClass('header__mega--open');
        $megaLink.attr('aria-expanded', 'true');
    });

    $mega.on('focusout', function() {
        if (isMobile()) return;
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

    var cartStorageKey = 'asernet_cart';

    function getCartItems() {
        try {
            return JSON.parse(localStorage.getItem(cartStorageKey)) || [];
        } catch (e) {
            return [];
        }
    }

    function saveCartItems(items) {
        localStorage.setItem(cartStorageKey, JSON.stringify(items));
        window.dispatchEvent(new CustomEvent('asernetCartUpdated'));
    }

    function getItemGroup(item) {
        if (item.group) return item.group;
        if (/^internet-/.test(item.id || '')) return 'internet-residencial';
        if (/^camera-/.test(item.id || '')) return 'cameras-seguranca';
        if (/^mobile-/.test(item.id || '')) return 'aser-mobile';
        if (/^(rastreador|tag-)/.test(item.id || '')) return 'rastreamento';
        if (/^wifi-mesh/.test(item.id || '')) return 'wifi-mesh';
        return item.id;
    }

    function getCartProduct($button) {
        return {
            id: $button.data('cartId'),
            group: $button.data('cartGroup') || $button.data('cartId'),
            title: $button.data('cartTitle'),
            subtitle: $button.data('cartSubtitle'),
            price: $button.data('cartPrice'),
            icon: $button.data('cartIcon'),
            url: $button.data('cartUrl'),
            qty: 1
        };
    }

    function updateCartButtons() {
        var cart = getCartItems();

        $('[data-cart-add]').each(function() {
            var $button = $(this);
            var product = getCartProduct($button);
            var exists = cart.some(function(item) {
                return item.id === product.id;
            });

            if (!$button.data('cartOriginalText')) {
                $button.data('cartOriginalText', $.trim($button.text()));
                $button.data('cartOriginalHtml', $button.html());
            }

            $button.toggleClass('is-in-cart', exists);
            $button.attr('aria-pressed', exists ? 'true' : 'false');
            $button.closest('article').toggleClass('is-in-cart-card', exists);

            if (exists) {
                $button.text('Adicionado ao carrinho');
            } else {
                $button.html($button.data('cartOriginalHtml'));
            }
        });
    }

    $(document).on('click', '[data-cart-add]', function(event) {
        event.preventDefault();

        var $button = $(this);
        var product = getCartProduct($button);
        var cart = getCartItems();
        var exists = cart.some(function(item) {
            return item.id === product.id;
        });

        if (!exists) {
            cart = cart.filter(function(item) {
                return getItemGroup(item) !== product.group;
            });
            cart.push(product);
            saveCartItems(cart);
        }

        updateCartButtons();
    });

    $(window).on('storage asernetCartUpdated', updateCartButtons);
    updateCartButtons();

    // Accordion do footer (mobile only)
    $(document).on('click', '[data-footer-accordion] h2', function() {
        if (window.innerWidth > 991) return;
        $(this).closest('[data-footer-accordion]').toggleClass('footer--open');
    });
});
