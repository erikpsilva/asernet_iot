<header class="header">
    <div class="container">
        <div class="header__content">
            <a class="header__brand" href="<?= BASE_URL ?>" aria-label="AserNet">
                <img class="header__logo" src="<?= BASE_URL ?>/images/logo-transparent.png" alt="AserNet">
            </a>

            <button class="header__toggle" type="button" aria-label="Abrir menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav class="header__nav" aria-label="Menu principal">
                <?php
                $activeRoute = $mainRoute ?? '';
                $solutionActiveRoutes = ['solucoes', 'internetpme', 'wifiprofissional', 'telefoniaempresarial', 'linkdedicado', 'rastreamentoveicular', 'cruzeiro', 'skeelo'];
                $solutionActive = in_array($activeRoute, $solutionActiveRoutes, true) ? ' header__nav-link--active' : '';
                ?>

                <a class="header__nav-link<?= $activeRoute === 'residencial' ? ' header__nav-link--active' : '' ?>" href="<?= BASE_URL ?>/residencial">Residencial</a>
                <a class="header__nav-link<?= $activeRoute === 'empresas' ? ' header__nav-link--active' : '' ?>" href="<?= BASE_URL ?>/paraempresas">Empresas (PME)</a>

                <div class="header__mega">
                    <a class="header__nav-link header__nav-link--mega<?= $solutionActive ?>" href="<?= BASE_URL ?>/solucoes" aria-haspopup="true" aria-expanded="false">
                        Soluções
                        <span class="header__nav-arrow" aria-hidden="true"></span>
                    </a>

                    <div class="header__mega-panel" aria-label="Menu de soluções">
                        <div class="header__mega-columns">
                            <section class="header__mega-column">
                                <div class="header__mega-heading">
                                    <i class="icon-home" aria-hidden="true"></i>
                                    <div>
                                        <h2>Para sua casa</h2>
                                        <p>Conexão, segurança e cobertura para toda a família.</p>
                                    </div>
                                </div>

                                <ul class="header__mega-list">
                                    <li><a href="<?= BASE_URL ?>/residencial"><i class="icon-wifi" aria-hidden="true"></i><span><strong>Internet residencial</strong><small>Planos de alta velocidade</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/cameradeseguranca"><i class="icon-casino-cctv" aria-hidden="true"></i><span><strong>Câmeras de segurança</strong><small>Monitore de onde estiver</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/wifimesh"><i class="icon-wifimesh" aria-hidden="true"></i><span><strong>Wi-Fi Mesh</strong><small>Cobertura total em todos os ambientes</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/planomovel"><i class="icon-mobile-phone" aria-hidden="true"></i><span><strong>Plano móvel</strong><small>Internet para levar com você</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/rastreamentoveicular"><i class="icon-carpin" aria-hidden="true"></i><span><strong>Rastreamento veicular</strong><small>Segurança e controle em tempo real</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/cruzeiro"><i class="icon-cruise" aria-hidden="true"></i><span><strong>Cruzeiro AserNet</strong><small>Concorra a uma experiência inesquecível</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/skeelo"><i class="icon-skeelo" aria-hidden="true"></i><span><strong>Skeelo</strong><small>Livros digitais e audiobooks no seu plano</small></span></a></li>
                                </ul>

                                <a class="header__mega-card header__mega-card--best" href="<?= BASE_URL ?>/solucoes">
                                    <span><i class="icon-star" aria-hidden="true"></i><strong>Mais vendido</strong><b>Internet + Câmeras</b><small>Mais segurança e tranquilidade para sua família</small></span>
                                    <img src="<?= BASE_URL ?>/images/menu/imgMaisQueVendido.png" alt="">
                                </a>
                            </section>

                            <section class="header__mega-column">
                                <div class="header__mega-heading">
                                    <i class="icon-construcao" aria-hidden="true"></i>
                                    <div>
                                        <h2>Para empresas</h2>
                                        <p>Soluções completas para seu negócio não parar.</p>
                                    </div>
                                </div>

                                <ul class="header__mega-list">
                                    <li><a href="<?= BASE_URL ?>/internetpme"><i class="icon-construcao" aria-hidden="true"></i><span><strong>Internet PME</strong><small>Estabilidade para sua empresa</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/wifiprofissional"><i class="icon-wifi" aria-hidden="true"></i><span><strong>Wi-Fi Profissional</strong><small>Rede de alta performance</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/telefoniaempresarial"><i class="icon-phone" aria-hidden="true"></i><span><strong>Telefonia empresarial</strong><small>Comunicação profissional e ilimitada</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/linkdedicado"><i class="icon-servidor" aria-hidden="true"></i><span><strong>Link dedicado</strong><small>Máxima estabilidade para operações críticas</small></span></a></li>
                                </ul>

                                <a class="header__mega-card header__mega-card--business" href="<?= BASE_URL ?>/empresas">
                                    <span><i class="icon-fire" aria-hidden="true"></i><strong>Solução completa para empresas</strong><small>Conectividade, comunicação e desempenho</small></span>
                                    <img src="<?= BASE_URL ?>/images/menu/imgSolucaoCompletaParaEmpresas.png" alt="">
                                </a>
                            </section>

                            <section class="header__mega-column header__mega-column--combos">
                                <div class="header__mega-heading">
                                    <i class="icon-setting" aria-hidden="true"></i>
                                    <div>
                                        <h2>Soluções completas</h2>
                                        <p>Combinações que conectam tudo o que você precisa.</p>
                                    </div>
                                </div>

                                <ul class="header__mega-list header__mega-list--combo">
                                    <li><a href="<?= BASE_URL ?>/combo"><i class="icon-camwifi" aria-hidden="true"></i><em>+</em><span><strong>Internet + Câmeras</strong><small>Segurança e conexão juntas</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/combo"><i class="icon-wifipro" aria-hidden="true"></i><em>+</em><span><strong>Internet + Wi-Fi Pro</strong><small>Cobertura e performance de verdade</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/combo"><i class="icon-wifiphone" aria-hidden="true"></i><em>+</em><span><strong>Internet + Telefonia</strong><small>Conectividade e comunicação profissional</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/combo"><i class="icon-wificelphone" aria-hidden="true"></i><em>+</em><span><strong>Internet + Mobile</strong><small>Conexão dentro e fora de casa</small></span></a></li>
                                </ul>

                                <a class="header__mega-outline" href="<?= BASE_URL ?>/combo">Ver todos os combos <i class="icon-arrowright" aria-hidden="true"></i></a>
                            </section>

                            <aside class="header__mega-feature">
                                <h2>Mais que internet.</h2>
                                <p>Soluções completas para sua casa ou empresa funcionarem de verdade.</p>
                                <img src="<?= BASE_URL ?>/images/menu/imgMaisQue Internet.png" alt="">

                                <ul>
                                    <li><i class="icon-security" aria-hidden="true"></i><span><strong>Estabilidade</strong><small>Conexão estável e confiável</small></span></li>
                                    <li><i class="icon-wificobertura" aria-hidden="true"></i><span><strong>Cobertura</strong><small>Wi-Fi forte em todos os ambientes</small></span></li>
                                    <li><i class="icon-customersupport" aria-hidden="true"></i><span><strong>Suporte local</strong><small>Atendimento rápido e especializado</small></span></li>
                                </ul>

                                <a href="<?= BASE_URL ?>/residencialcomofunciona">Saiba como funciona <i class="icon-arrowright" aria-hidden="true"></i></a>
                            </aside>
                        </div>
                    </div>
                </div>

                <a class="header__nav-link<?= $activeRoute === 'sobreasernet' ? ' header__nav-link--active' : '' ?>" href="<?= BASE_URL ?>/sobreasernet">Sobre a AserNet</a>
                <a class="header__nav-link<?= $activeRoute === 'faq' ? ' header__nav-link--active' : '' ?>" href="<?= BASE_URL ?>/faq">Suporte</a>
            </nav>

            <div class="header__actions">
                <a class="header__whatsapp" href="https://wa.me/5508002225262" target="_blank" rel="noopener">
                    <i class="icon-whatsapp" aria-hidden="true"></i>
                    <span>Falar no WhatsApp</span>
                </a>
            </div>

            <div class="header__cart" data-header-cart>
                <button class="header__cart-button" type="button" aria-label="Abrir carrinho" aria-expanded="false" aria-controls="headerCartPanel">
                    <i class="icon-cart" aria-hidden="true"></i>
                    <span class="header__cart-count" data-cart-count>0</span>
                </button>

                <div class="header__cart-panel" id="headerCartPanel" role="dialog" aria-label="Carrinho">
                    <div class="header__cart-head">
                        <strong>Meu carrinho</strong>
                        <span><b data-cart-count>0</b> itens</span>
                    </div>

                    <div class="header__cart-empty" data-header-cart-empty>
                        <i class="icon-cart" aria-hidden="true"></i>
                        <p>Seu carrinho est&aacute; vazio.</p>
                        <small>Adicione planos ou solu&ccedil;&otilde;es para continuar.</small>
                    </div>

                    <div class="header__cart-list" data-header-cart-list></div>

                    <a class="header__cart-cta" href="<?= BASE_URL ?>/carrinho">
                        Abrir carrinho
                        <i class="icon-arrowright" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    (function () {
        var cart = document.querySelector('[data-header-cart]');
        if (!cart) return;

        var button = cart.querySelector('.header__cart-button');
        var storageKey = 'asernet_cart';
        var counters = cart.querySelectorAll('[data-cart-count]');
        var empty = cart.querySelector('[data-header-cart-empty]');
        var list = cart.querySelector('[data-header-cart-list]');

        function getCartItems() {
            try {
                return JSON.parse(localStorage.getItem(storageKey)) || [];
            } catch (e) {
                return [];
            }
        }

        function saveCartItems(items) {
            localStorage.setItem(storageKey, JSON.stringify(items));
            window.dispatchEvent(new CustomEvent('asernetCartUpdated'));
        }

        function escapeHtml(value) {
            return String(value || '').replace(/[&<>"']/g, function (char) {
                return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[char];
            });
        }

        function renderCart() {
            var items = getCartItems();
            var total = items.reduce(function (sum, item) {
                return sum + (item.qty || 1);
            }, 0);

            counters.forEach(function (counter) {
                counter.textContent = total;
            });

            if (!list || !empty) return;

            empty.hidden = items.length > 0;
            list.hidden = items.length === 0;
            list.innerHTML = items.map(function (item) {
                var price = item.price ? '<small>' + escapeHtml(item.price) + '</small>' : '';
                var subtitle = item.subtitle ? '<em>' + escapeHtml(item.subtitle) + '</em>' : '';

                return '<article class="header__cart-item">' +
                    '<a class="header__cart-item-link" href="' + escapeHtml(item.url) + '">' +
                        '<i class="' + escapeHtml(item.icon) + '" aria-hidden="true"></i>' +
                        '<span><strong>' + escapeHtml(item.title) + '</strong>' + price + subtitle + '</span>' +
                    '</a>' +
                    '<button class="header__cart-remove" type="button" data-header-cart-remove="' + escapeHtml(item.id) + '" aria-label="Remover ' + escapeHtml(item.title) + '">&times;</button>' +
                '</article>';
            }).join('');
        }

        function closeCart() {
            cart.classList.remove('header__cart--open');
            button.setAttribute('aria-expanded', 'false');
        }

        button.addEventListener('click', function () {
            var isOpen = cart.classList.toggle('header__cart--open');
            button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        document.addEventListener('click', function (event) {
            if (!cart.contains(event.target)) closeCart();
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') closeCart();
        });

        if (list) {
            list.addEventListener('click', function (event) {
                var removeButton = event.target.closest('[data-header-cart-remove]');
                if (!removeButton) return;

                event.preventDefault();
                event.stopPropagation();

                var id = removeButton.getAttribute('data-header-cart-remove');
                var items = getCartItems().filter(function (item) {
                    return item.id !== id;
                });

                saveCartItems(items);
                renderCart();
            });
        }

        window.addEventListener('storage', renderCart);
        window.addEventListener('asernetCartUpdated', renderCart);
        renderCart();
    }());
</script>
