(function () {
    var page = document.querySelector('[data-cart-page]');
    if (!page) return;

    var storageKey = 'asernet_cart';
    var selectedList = page.querySelector('[data-selected-list]');
    var emptyState = page.querySelector('[data-empty-cart]');
    var totals = page.querySelectorAll('[data-cart-total]');
    var estimate = page.querySelector('[data-cart-estimate]');
    var estimateNote = page.querySelector('[data-cart-estimate-note]');
    var whatsappCart = page.querySelector('[data-whatsapp-cart]');
    var clearButton = page.querySelector('[data-clear-cart]');
    var optionCards = page.querySelectorAll('[data-product-option]');
    var groups = page.querySelectorAll('[data-cart-group]');

    function getCart() {
        try {
            return JSON.parse(localStorage.getItem(storageKey)) || [];
        } catch (e) {
            return [];
        }
    }

    function saveCart(cart) {
        localStorage.setItem(storageKey, JSON.stringify(cart));
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

    function escapeHtml(value) {
        return String(value || '').replace(/[&<>"']/g, function (char) {
            return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[char];
        });
    }

    function getProduct(card) {
        return {
            id: card.getAttribute('data-product-id'),
            group: card.getAttribute('data-product-group') || card.getAttribute('data-product-id'),
            title: card.getAttribute('data-product-title'),
            subtitle: card.getAttribute('data-product-subtitle'),
            price: card.getAttribute('data-product-price'),
            icon: card.getAttribute('data-product-icon'),
            url: card.getAttribute('data-product-url'),
            qty: 1
        };
    }

    function parsePrice(price) {
        var match = String(price || '').match(/(\d{1,3}(?:\.\d{3})*,\d{2}|\d+,\d{2})/);
        if (!match) return null;
        return parseFloat(match[1].replace(/\./g, '').replace(',', '.'));
    }

    function formatMoney(value) {
        return value.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });
    }

    function buildWhatsappUrl(cart, estimatedTotal, hasStartingPrice) {
        var message = 'Olá! Tenho interesse nos itens do carrinho AserNet.';

        if (cart.length) {
            message += '\n\nItens selecionados:';
            cart.forEach(function (item, index) {
                message += '\n' + (index + 1) + '. ' + item.title;
                if (item.subtitle) message += '\n   ' + item.subtitle;
                if (item.price) message += '\n   Valor: ' + item.price;
            });
            message += '\n\nTotal estimado: ' + formatMoney(estimatedTotal);
            message += '\n\nObservação: este valor é uma prévia. O valor final real deve ser confirmado com o vendedor.';
            if (hasStartingPrice) message += ' Itens com valor "a partir de" foram considerados pelo menor valor exibido.';
        } else {
            message += '\n\nAinda não selecionei itens, quero ajuda para escolher.';
        }

        return 'https://wa.me/5508002225262?text=' + encodeURIComponent(message);
    }

    function render() {
        var cart = getCart();
        var count = cart.reduce(function (total, item) { return total + (item.qty || 1); }, 0);
        var estimatedTotal = 0;
        var hasStartingPrice = false;

        cart.forEach(function (item) {
            var price = parsePrice(item.price);
            if (price !== null) estimatedTotal += price * (item.qty || 1);
            if (/a partir/i.test(item.price || '')) hasStartingPrice = true;
        });

        totals.forEach(function (el) {
            el.textContent = count;
        });

        if (estimate) estimate.textContent = formatMoney(estimatedTotal);
        if (estimateNote) estimateNote.hidden = !hasStartingPrice;
        if (whatsappCart) whatsappCart.href = buildWhatsappUrl(cart, estimatedTotal, hasStartingPrice);

        optionCards.forEach(function (card) {
            var product = getProduct(card);
            var exists = cart.some(function (item) { return item.id === product.id; });
            var button = card.querySelector('[data-add-product]');

            card.classList.toggle('cart-page__option--selected', exists);
            if (button) button.textContent = exists ? 'Adicionado' : 'Adicionar';
        });

        if (!cart.length) {
            selectedList.innerHTML = '';
            emptyState.hidden = false;
            clearButton.disabled = true;
            return;
        }

        emptyState.hidden = true;
        clearButton.disabled = false;
        selectedList.innerHTML = cart.map(function (item) {
            return '<article class="cart-page__selected-item">' +
                '<i class="' + escapeHtml(item.icon) + '" aria-hidden="true"></i>' +
                '<div>' +
                    '<h3>' + escapeHtml(item.title) + '</h3>' +
                    '<p>' + escapeHtml(item.subtitle) + '</p>' +
                    '<strong>' + escapeHtml(item.price) + '</strong>' +
                    '<a href="' + escapeHtml(item.url) + '">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a>' +
                '</div>' +
                '<button type="button" data-remove-product="' + escapeHtml(item.id) + '">Remover</button>' +
            '</article>';
        }).join('');
    }

    groups.forEach(function (group) {
        var toggle = group.querySelector('.cart-page__group-toggle');
        if (!toggle) return;

        toggle.addEventListener('click', function () {
            var isOpen = group.classList.toggle('cart-page__group--open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    });

    optionCards.forEach(function (card) {
        var button = card.querySelector('[data-add-product]');
        if (!button) return;

        button.addEventListener('click', function () {
            var product = getProduct(card);
            var cart = getCart();
            var exists = cart.some(function (item) { return item.id === product.id; });

            if (!exists) {
                cart = cart.filter(function (item) {
                    return getItemGroup(item) !== product.group;
                });
                cart.push(product);
                saveCart(cart);
                render();
            }
        });
    });

    selectedList.addEventListener('click', function (event) {
        var button = event.target.closest('[data-remove-product]');
        if (!button) return;

        var id = button.getAttribute('data-remove-product');
        var cart = getCart().filter(function (item) { return item.id !== id; });
        saveCart(cart);
        render();
    });

    clearButton.addEventListener('click', function () {
        saveCart([]);
        render();
    });

    window.addEventListener('storage', render);
    window.addEventListener('asernetCartUpdated', render);
    render();
}());
