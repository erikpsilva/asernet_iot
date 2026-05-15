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
                $solutionActive = $activeRoute === 'solucoes' ? ' header__nav-link--active' : '';
                ?>

                <a class="header__nav-link<?= $activeRoute === 'residencial' ? ' header__nav-link--active' : '' ?>" href="<?= BASE_URL ?>/residencial">Residencial</a>
                <a class="header__nav-link<?= $activeRoute === 'empresas' ? ' header__nav-link--active' : '' ?>" href="<?= BASE_URL ?>/empresas">Empresas (PME)</a>

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
                                    <li><a href="<?= BASE_URL ?>/solucoes"><i class="icon-wifimesh" aria-hidden="true"></i><span><strong>Wi-Fi Mesh</strong><small>Cobertura total em todos os ambientes</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/residencial"><i class="icon-mobile-phone" aria-hidden="true"></i><span><strong>Plano móvel</strong><small>Internet para levar com você</small></span></a></li>
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
                                    <li><a href="<?= BASE_URL ?>/empresas"><i class="icon-construcao" aria-hidden="true"></i><span><strong>Internet PME</strong><small>Estabilidade para sua empresa</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/solucoes"><i class="icon-wifi" aria-hidden="true"></i><span><strong>Wi-Fi Profissional</strong><small>Rede de alta performance</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/solucoes"><i class="icon-phone" aria-hidden="true"></i><span><strong>Telefonia empresarial</strong><small>Comunicação profissional e ilimitada</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/solucoes"><i class="icon-servidor" aria-hidden="true"></i><span><strong>Link dedicado</strong><small>Máxima estabilidade para operações críticas</small></span></a></li>
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
                                    <li><a href="<?= BASE_URL ?>/solucoes"><i class="icon-camwifi" aria-hidden="true"></i><em>+</em><span><strong>Internet + Câmeras</strong><small>Segurança e conexão juntas</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/solucoes"><i class="icon-wifipro" aria-hidden="true"></i><em>+</em><span><strong>Internet + Wi-Fi Pro</strong><small>Cobertura e performance de verdade</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/solucoes"><i class="icon-wifiphone" aria-hidden="true"></i><em>+</em><span><strong>Internet + Telefonia</strong><small>Conectividade e comunicação profissional</small></span></a></li>
                                    <li><a href="<?= BASE_URL ?>/solucoes"><i class="icon-wificelphone" aria-hidden="true"></i><em>+</em><span><strong>Internet + Mobile</strong><small>Conexão dentro e fora de casa</small></span></a></li>
                                </ul>

                                <a class="header__mega-outline" href="<?= BASE_URL ?>/solucoes">Ver todos os combos <span aria-hidden="true">›</span></a>
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

                                <a href="<?= BASE_URL ?>/residencialcomofunciona">Entenda como funciona <span aria-hidden="true">›</span></a>
                            </aside>
                        </div>
                    </div>
                </div>

                <a class="header__nav-link<?= $activeRoute === 'sobre' ? ' header__nav-link--active' : '' ?>" href="<?= BASE_URL ?>/sobre">Sobre a AserNet</a>
                <a class="header__nav-link<?= $activeRoute === 'suporte' ? ' header__nav-link--active' : '' ?>" href="<?= BASE_URL ?>/suporte">Suporte</a>
            </nav>

            <div class="header__actions">
                <a class="header__whatsapp" href="https://wa.me/5508002225262">
                    <i class="icon-whatsapp" aria-hidden="true"></i>
                    <span>Falar no WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
</header>
