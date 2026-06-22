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

            <nav class="header__nav" aria-label="Menu principal"><div class="header__nav-inner">
                <?php
                $activeRoute = $mainRoute ?? '';
                $solutionActiveRoutes = ['solucoes', 'residencial', 'wifimesh', 'planomovel', 'skeelo', 'cruzeiro', 'internetpme', 'wifiprofissional', 'telefoniaempresarial', 'linkdedicado', 'controlecorporativo', 'condominiointeligente', 'controleconcominial', 'bairroseguro', 'cameradeseguranca', 'rastreamentoveicular', 'combo', 'paraempresas'];
                $solutionActive = in_array($activeRoute, $solutionActiveRoutes, true) ? ' header__nav-link--active' : '';
                ?>

                <a class="header__nav-link header__nav-link--desktop-hidden<?= $activeRoute === 'residencial' ? ' header__nav-link--active' : '' ?>" href="<?= BASE_URL ?>/residencial">Residencial</a>
                <a class="header__nav-link header__nav-link--desktop-hidden<?= $activeRoute === 'paraempresas' ? ' header__nav-link--active' : '' ?>" href="<?= BASE_URL ?>/paraempresas">Empresas (PME)</a>

                <div class="header__mega">
                    <a class="header__nav-link header__nav-link--mega<?= $solutionActive ?>" href="<?= BASE_URL ?>/combo" aria-haspopup="true" aria-expanded="false">
                        Soluções
                        <span class="header__nav-arrow" aria-hidden="true"></span>
                    </a>

                    <div class="header__mega-panel header__mega-panel--catalog" aria-label="Menu de soluções">
                        <div class="header__mega-columns">
                            <section class="header__mega-column header__mega-column--home">
                                <div class="header__mega-heading">
                                    <i class="icon-home" aria-hidden="true"></i>
                                    <div><h2>Para sua casa</h2><p>Conexão, mobilidade e entretenimento para toda a família.</p></div>
                                </div>
                                <ul class="header__mega-list">
                                    <li><a href="<?= BASE_URL ?>/residencial"><i class="icon-wifi"></i><span><strong>Internet Residencial</strong><small>Planos de alta velocidade e estabilidade</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/wifimesh"><i class="icon-wifimesh"></i><span><strong>Wi-Fi Mesh</strong><small>Cobertura completa em todos os ambientes</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/planomovel"><i class="icon-mobile-phone"></i><span><strong>Plano Móvel</strong><small>Internet para levar com você</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/skeelo"><i class="icon-skeelo"></i><span><strong>Skeelo</strong><small>Livros digitais e audiobooks no seu plano</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/cruzeiro"><i class="icon-cruise"></i><span><strong>Cruzeiro AserNet</strong><small>Conectividade exclusiva durante seu cruzeiro</small></span></a></li>
                                </ul>
                                <a class="header__mega-card header__mega-card--home" href="<?= BASE_URL ?>/combo">
                                    <span><i class="icon-star"></i><strong>Casa Conectada</strong><small>Internet + Wi-Fi<br>+ Mobile</small></span>
                                    <img src="<?= BASE_URL ?>/images/menu/imgCasaConectada.png" alt="">
                                </a>
                            </section>

                            <section class="header__mega-column header__mega-column--business">
                                <div class="header__mega-heading">
                                    <i class="icon-office" aria-hidden="true"></i>
                                    <div><h2>Para empresas</h2><p>Soluções completas para seu negócio não parar.</p></div>
                                </div>
                                <ul class="header__mega-list">
                                    <li><a href="<?= BASE_URL ?>/internetpme"><i class="icon-office"></i><span><strong>Internet PME</strong><small>Estabilidade e performance para sua empresa</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/wifiprofissional"><i class="icon-wifipro"></i><span><strong>Wi-Fi Profissional</strong><small>Rede de alta performance para seu negócio</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/telefoniaempresarial"><i class="icon-phone"></i><span><strong>Telefonia Empresarial</strong><small>Comunicação profissional e ilimitada</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/linkdedicado"><i class="icon-servidor"></i><span><strong>Link Dedicado</strong><small>Máxima estabilidade para operações críticas</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/controlecorporativo"><i class="icon-view"></i><span><strong>Controle de Acesso Corporativo</strong><small>Gestão de colaboradores, visitantes e áreas restritas</small></span></a></li>
                                </ul>
                                <a class="header__mega-card header__mega-card--business-new" href="<?= BASE_URL ?>/paraempresas">
                                    <span><i class="icon-star"></i><strong>Empresa Conectada</strong><small>Internet + Wi-Fi + Telefonia<br>+ Controle de Acesso</small></span>
                                    <img src="<?= BASE_URL ?>/images/menu/imgSolucaoCompletaParaEmpresas.png" alt="">
                                </a>
                            </section>

                            <section class="header__mega-column header__mega-column--condo">
                                <div class="header__mega-heading">
                                    <i class="icon-office" aria-hidden="true"></i>
                                    <div><h2>Condomínios</h2><p>Tecnologia e segurança para síndicos e moradores.</p></div>
                                </div>
                                <ul class="header__mega-list">
                                    <li><a href="<?= BASE_URL ?>/condominiointeligente"><i class="icon-office"></i><span><strong>Condomínio Inteligente</strong><small>Solução completa para gestão, segurança e conectividade</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/controleconcominial"><i class="icon-view"></i><span><strong>Controle de Acesso Condominial</strong><small>Mais segurança e praticidade para moradores e visitantes</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/bairroseguro"><i class="icon-security"></i><span><strong>Bairro Seguro</strong><small>Monitoramento colaborativo para comunidades mais protegidas</small></span></a></li>
                                </ul>
                                <a class="header__mega-card header__mega-card--condo" href="<?= BASE_URL ?>/condominiointeligente">
                                    <span><i class="icon-star"></i><strong>Condomínio Inteligente</strong><small>Segurança + Conectividade<br>+ Gestão integrada</small></span>
                                    <img src="<?= BASE_URL ?>/images/menu/imgConcominioIntelgiente.png" alt="">
                                </a>
                            </section>

                            <section class="header__mega-column header__mega-column--security">
                                <div class="header__mega-heading">
                                    <i class="icon-security" aria-hidden="true"></i>
                                    <div><h2>Segurança inteligente</h2><p>Proteção inteligente para pessoas, patrimônios e veículos.</p></div>
                                </div>
                                <ul class="header__mega-list">
                                    <li><a href="<?= BASE_URL ?>/cameradeseguranca"><i class="icon-casino-cctv"></i><span><strong>Câmeras de Segurança</strong><small>Monitore o que realmente importa com alta definição</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/rastreamentoveicular"><i class="icon-car"></i><span><strong>Rastreamento Veicular</strong><small>Localização em tempo real e histórico de rotas</small></span></a></li>
                                </ul>
                                <a class="header__mega-card header__mega-card--security" href="<?= BASE_URL ?>/cameradeseguranca">
                                    <span><i class="icon-star"></i><strong>Soluções de Segurança</strong><small>Monitoramento visual<br>+ Rastreamento<br>+ Tecnologia integrada</small></span>
                                    <img src="<?= BASE_URL ?>/images/menu/imgSolucoesdeSeguranca.png" alt="">
                                </a>
                            </section>

                            <aside class="header__mega-feature header__mega-feature--brand">
                                <h2>AserNet<br><strong>IoT Services</strong></h2>
                                <h3>Internet. Segurança. Tecnologia.</h3>
                                <p><b>Conectar bem<br><strong>é cuidar.</strong></b></p>
                                <small>Soluções inteligentes que simplificam sua rotina e protegem o que importa para você.</small>
                                <img src="<?= BASE_URL ?>/images/menu/imgConhecaAsernet.png" alt="Família conectada pela AserNet IoT Services">
                                <a href="<?= BASE_URL ?>/sobreasernet">Conheça a AserNet<br>IoT Services <i class="icon-arrowright"></i></a>
                            </aside>
                        </div>

                        <div class="header__mega-benefits">
                            <div><i class="icon-customersupport"></i><span><strong><a href="<?= BASE_URL ?>/nossaslojas">Atendimento local</a></strong><small>Equipe perto de você<br>quando precisar</small></span></div>
                            <div><i class="icon-gear"></i><span><strong>Instalação profissional</strong><small>Equipamentos e serviços<br>de qualidade</small></span></div>
                            <div><i class="icon-security"></i><span><strong>Suporte de verdade</strong><small>Rápido, humano<br>e eficiente</small></span></div>
                            <div><i class="icon-diagram"></i><span><strong>Soluções integradas</strong><small>Tudo conectado para<br>mais segurança</small></span></div>
                        </div>
                    </div>
                </div>

                <a class="header__nav-link<?= $activeRoute === 'sobreasernet' ? ' header__nav-link--active' : '' ?>" href="<?= BASE_URL ?>/sobreasernet">Sobre a AserNet</a>
                <a class="header__nav-link<?= $activeRoute === 'faq' ? ' header__nav-link--active' : '' ?>" href="<?= BASE_URL ?>/faq">Suporte</a>
            </div></nav>

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
        if (window.AserNetHeaderMenuReady) return;

        var header = document.querySelector('.header');
        if (!header) return;

        var toggle = header.querySelector('.header__toggle');
        var nav = header.querySelector('.header__nav');
        var mega = header.querySelector('.header__mega');
        var megaLink = header.querySelector('.header__nav-link--mega');
        var megaPanel = header.querySelector('.header__mega-panel');
        var mobileQuery = window.matchMedia ? window.matchMedia('(max-width: 991px)') : null;
        var closeTimer;
        var scrollY = 0;

        function isMobile() {
            return mobileQuery ? mobileQuery.matches : window.innerWidth <= 991;
        }

        function setViewportHeight() {
            document.documentElement.style.setProperty('--asernet-viewport-height', window.innerHeight + 'px');
        }

        function alignMegaArrow() {
            if (isMobile() || !megaLink || !megaPanel) return;

            var panelRect = megaPanel.getBoundingClientRect();
            var linkRect = megaLink.getBoundingClientRect();
            var arrowLeft = linkRect.left + (linkRect.width / 2) - panelRect.left - 8;

            megaPanel.style.setProperty('--arrow-left', arrowLeft + 'px');
        }

        function lockBodyScroll() {
            if (!isMobile()) return;

            scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
            document.body.style.overflow = 'hidden';
            document.body.style.position = 'fixed';
            document.body.style.top = '-' + scrollY + 'px';
            document.body.style.left = '0';
            document.body.style.right = '0';
            document.body.style.width = '100%';
        }

        function unlockBodyScroll() {
            var top = document.body.style.top;

            document.body.style.overflow = '';
            document.body.style.position = '';
            document.body.style.top = '';
            document.body.style.left = '';
            document.body.style.right = '';
            document.body.style.width = '';

            if (top) {
                window.scrollTo(0, Math.abs(parseInt(top, 10)) || scrollY);
            }
        }

        function closeMenu() {
            header.classList.remove('header--menu-open');
            if (toggle) {
                toggle.setAttribute('aria-expanded', 'false');
                toggle.setAttribute('aria-label', 'Abrir menu');
            }
            unlockBodyScroll();
        }

        function toggleMenu(event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            setViewportHeight();

            var isOpen = header.classList.toggle('header--menu-open');
            if (toggle) {
                toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                toggle.setAttribute('aria-label', isOpen ? 'Fechar menu' : 'Abrir menu');
            }

            if (isOpen) {
                if (nav) nav.scrollTop = 0;
                lockBodyScroll();
            } else {
                unlockBodyScroll();
            }
        }

        if (toggle) {
            toggle.addEventListener('click', toggleMenu, false);
        }

        if (nav) {
            nav.addEventListener('click', function (event) {
                var link = event.target.closest('a');
                if (link && isMobile()) closeMenu();
            }, false);
        }

        if (mega && megaLink) {
            mega.addEventListener('mouseenter', function () {
                if (isMobile()) return;
                clearTimeout(closeTimer);
                alignMegaArrow();
                mega.classList.add('header__mega--open');
                megaLink.setAttribute('aria-expanded', 'true');
            }, false);

            mega.addEventListener('mouseleave', function () {
                if (isMobile()) return;
                closeTimer = setTimeout(function () {
                    mega.classList.remove('header__mega--open');
                    megaLink.setAttribute('aria-expanded', 'false');
                }, 220);
            }, false);

            mega.addEventListener('focusin', function () {
                if (isMobile()) return;
                alignMegaArrow();
                mega.classList.add('header__mega--open');
                megaLink.setAttribute('aria-expanded', 'true');
            }, false);

            mega.addEventListener('focusout', function () {
                if (isMobile()) return;
                mega.classList.remove('header__mega--open');
                megaLink.setAttribute('aria-expanded', 'false');
            }, false);
        }

        document.addEventListener('keyup', function (event) {
            if (event.key === 'Escape') {
                closeMenu();
                if (mega && megaLink) {
                    mega.classList.remove('header__mega--open');
                    megaLink.setAttribute('aria-expanded', 'false');
                }
            }
        }, false);

        window.addEventListener('resize', function () {
            setViewportHeight();
            if (!isMobile()) closeMenu();
            alignMegaArrow();
        }, false);

        window.addEventListener('orientationchange', function () {
            setTimeout(function () {
                setViewportHeight();
                closeMenu();
                alignMegaArrow();
            }, 250);
        }, false);

        window.addEventListener('pageshow', function () {
            setViewportHeight();
            closeMenu();
            alignMegaArrow();
        }, false);

        if (window.visualViewport) {
            window.visualViewport.addEventListener('resize', setViewportHeight, false);
        }

        setViewportHeight();
        alignMegaArrow();

        window.AserNetHeaderMenuReady = {
            close: closeMenu,
            refresh: function () {
                setViewportHeight();
                alignMegaArrow();
            }
        };
    }());
</script>

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
