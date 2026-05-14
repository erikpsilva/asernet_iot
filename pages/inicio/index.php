<!DOCTYPE html>
<html>
<head>
<title>AserNet - Início</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<section class="home">
    <div class="home__hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-7">
                    <div class="home__content">
                        <h1 class="home__title">
                            Mais que internet.
                            <strong>Soluções completas</strong>
                            para sua vida.
                        </h1>

                        <p class="home__text">
                            Tecnologia, conectividade e segurança para sua casa ou empresa funcionarem melhor.
                        </p>

                        <ul class="home__features">
                            <li class="home__feature"><i class="icon icon-check" aria-hidden="true"></i>Internet</li>
                            <li class="home__feature"><i class="icon icon-check" aria-hidden="true"></i>Wi-Fi inteligente</li>
                            <li class="home__feature"><i class="icon icon-check" aria-hidden="true"></i>Segurança</li>
                            <li class="home__feature"><i class="icon icon-check" aria-hidden="true"></i>Mobilidade</li>
                            <li class="home__feature"><i class="icon icon-check" aria-hidden="true"></i>Telefonia</li>
                            <li class="home__feature"><i class="icon icon-check" aria-hidden="true"></i>Soluções empresariais</li>
                        </ul>

                        <div class="home__actions">
                            <a class="home__button home__button--primary" href="<?= BASE_URL ?>/contato">
                                <i class="icon icon-talk" aria-hidden="true"></i>
                                <span>Falar com um consultor</span>
                            </a>

                            <a class="home__button home__button--outline" href="tel:08002225262">
                                <i class="icon icon-phone" aria-hidden="true"></i>
                                <span>0800 222 5262</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-5" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="home__body">
        <div class="container">
            <div class="home__intro">
                <h2 class="home__intro-title">Uma empresa. Diversas soluções conectadas.</h2>
                <p class="home__intro-text">A AserNet integra internet, mobilidade, segurança e conectividade para simplificar sua rotina e melhorar sua experiência.</p>
            </div>

            <section class="home__section">
                <div class="home__section-heading">
                    <i class="icon icon-home" aria-hidden="true"></i>
                    <h2 class="home__section-title">Soluções para sua casa</h2>
                </div>

                <div class="home__cards home__cards--home">
                    <article class="home__card">
                        <div class="home__card-heading">
                            <i class="icon icon-home" aria-hidden="true"></i>
                            <h3 class="home__card-title">Internet Residencial</h3>
                        </div>
                        <p class="home__card-text">1 Giga com estabilidade e cobertura inteligente.</p>
                        <img class="home__card-image" src="<?= BASE_URL ?>/images/home/imgInternetResidencial.png" alt="Sala residencial conectada">
                        <a class="home__card-link" href="<?= BASE_URL ?>/residencial">Ver planos</a>
                    </article>

                    <article class="home__card">
                        <div class="home__card-heading">
                            <i class="icon icon-wifi" aria-hidden="true"></i>
                            <h3 class="home__card-title">Wi-Fi Mesh</h3>
                        </div>
                        <p class="home__card-text">Cobertura inteligente para toda a casa.</p>
                        <img class="home__card-image" src="<?= BASE_URL ?>/images/home/imgWifiMesh.png" alt="Roteadores Wi-Fi Mesh">
                        <a class="home__card-link" href="<?= BASE_URL ?>/solucoes">Conhecer solução</a>
                    </article>

                    <article class="home__card">
                        <div class="home__card-heading">
                            <i class="icon icon-security" aria-hidden="true"></i>
                            <h3 class="home__card-title">Câmeras de Segurança</h3>
                        </div>
                        <p class="home__card-text">Monitoramento em tempo real pelo celular.</p>
                        <img class="home__card-image" src="<?= BASE_URL ?>/images/home/imgCameraDeSeguranca.png" alt="Câmera de segurança">
                        <a class="home__card-link" href="<?= BASE_URL ?>/solucoes">Ver solução</a>
                    </article>

                    <article class="home__card">
                        <div class="home__card-heading">
                            <i class="icon icon-mobile-phone" aria-hidden="true"></i>
                            <h3 class="home__card-title">Aser Mobile</h3>
                        </div>
                        <p class="home__card-text">Conectividade dentro e fora de casa.</p>
                        <img class="home__card-image" src="<?= BASE_URL ?>/images/home/imgAserMobile.png" alt="Celular com Aser Mobile">
                        <a class="home__card-link" href="<?= BASE_URL ?>/residencial">Ver planos</a>
                    </article>
                </div>
            </section>

            <section class="home__section">
                <div class="home__section-heading">
                    <i class="icon icon-cloud" aria-hidden="true"></i>
                    <h2 class="home__section-title">Soluções para empresas</h2>
                </div>

                <div class="home__cards home__cards--business">
                    <article class="home__card">
                        <div class="home__card-heading">
                            <i class="icon icon-construcao" aria-hidden="true"></i>
                            <h3 class="home__card-title">Internet PME</h3>
                        </div>
                        <p class="home__card-text">Conectividade estável para empresas.</p>
                        <img class="home__card-image" src="<?= BASE_URL ?>/images/home/imgInternetPME.png" alt="Escritório conectado">
                        <a class="home__card-link" href="<?= BASE_URL ?>/empresas">Ver soluções</a>
                    </article>

                    <article class="home__card">
                        <div class="home__card-heading">
                            <i class="icon icon-wifi" aria-hidden="true"></i>
                            <h3 class="home__card-title">Wi-Fi Profissional</h3>
                        </div>
                        <p class="home__card-text">Rede preparada para múltiplos dispositivos.</p>
                        <img class="home__card-image" src="<?= BASE_URL ?>/images/home/imgWifiProfissional.png" alt="Access point profissional">
                        <a class="home__card-link" href="<?= BASE_URL ?>/solucoes">Ver solução</a>
                    </article>

                    <article class="home__card">
                        <div class="home__card-heading">
                            <i class="icon icon-phone" aria-hidden="true"></i>
                            <h3 class="home__card-title">Telefonia Empresarial</h3>
                        </div>
                        <p class="home__card-text">Mais comunicação e produtividade.</p>
                        <img class="home__card-image" src="<?= BASE_URL ?>/images/home/imgTelefoniaEmpresarial.png" alt="Telefone empresarial">
                        <a class="home__card-link" href="<?= BASE_URL ?>/solucoes">Ver solução</a>
                    </article>

                    <article class="home__card">
                        <div class="home__card-heading">
                            <i class="icon icon-servidor" aria-hidden="true"></i>
                            <h3 class="home__card-title">Link Dedicado</h3>
                        </div>
                        <p class="home__card-text">Conexão exclusiva para operações críticas.</p>
                        <img class="home__card-image" src="<?= BASE_URL ?>/images/home/imgLinkDEdicado.png" alt="Link dedicado de alta velocidade">
                        <a class="home__card-link" href="<?= BASE_URL ?>/solucoes">Ver solução</a>
                    </article>
                </div>

                <a class="home__wide-link" href="<?= BASE_URL ?>/empresas">Conhecer soluções empresariais</a>
            </section>

            <section class="home__section home__section--security">
                <div class="home__security-content">
                    <div class="home__section-heading">
                        <i class="icon icon-security" aria-hidden="true"></i>
                        <div>
                            <h2 class="home__section-title">Segurança e monitoramento</h2>
                            <p class="home__section-subtitle">Mais controle para sua rotina.</p>
                        </div>
                    </div>

                    <div class="home__security-list">
                        <article class="home__security-card">
                            <div>
                                <h3 class="home__security-title">Rastreamento Veicular</h3>
                                <p class="home__security-text">Acompanhe seu veículo em tempo real pelo celular.</p>
                                <a class="home__card-link home__security-link" href="<?= BASE_URL ?>/solucoes">Ver solução</a>
                            </div>
                            <img class="home__security-image" src="<?= BASE_URL ?>/images/home/imgRastreamentoVeicular.png" alt="Rastreamento veicular">
                        </article>

                        <article class="home__security-card">
                            <div>
                                <h3 class="home__security-title">Tag Localizadora</h3>
                                <p class="home__security-text">Mais praticidade e segurança para o que importa.</p>
                                <a class="home__card-link home__security-link" href="<?= BASE_URL ?>/solucoes">Ver solução</a>
                            </div>
                            <img class="home__security-image" src="<?= BASE_URL ?>/images/home/imgTagLocalizadora.png" alt="Tag localizadora">
                        </article>
                    </div>
                </div>

                <aside class="home__security-box">
                    <h3 class="home__security-box-title">Tecnologia que protege o que é importante.</h3>
                    <ul class="home__security-checks">
                        <li><i class="icon icon-check" aria-hidden="true"></i>Monitoramento em tempo real</li>
                        <li><i class="icon icon-check" aria-hidden="true"></i>Alertas e histórico de rotas</li>
                        <li><i class="icon icon-check" aria-hidden="true"></i>Mais segurança e tranquilidade</li>
                    </ul>
                    <a class="home__security-button" href="<?= BASE_URL ?>/solucoes">Ver soluções de rastreamento</a>
                </aside>
            </section>

            <section class="home__flow">
                <h2 class="home__flow-title">Soluções que funcionam juntas.</h2>
                <p class="home__flow-text">Internet, Wi-Fi, mobilidade, telefonia e segurança integrados para facilitar sua rotina.</p>

                <div class="home__flow-list">
                    <article class="home__flow-item">
                        <span class="home__flow-icon"><i class="icon icon-wifi" aria-hidden="true"></i></span>
                        <h3>Internet</h3>
                        <p>Conexão rápida e estável.</p>
                    </article>
                    <article class="home__flow-item">
                        <span class="home__flow-icon home__flow-icon--green"><i class="icon icon-casino-cctv" aria-hidden="true"></i></span>
                        <h3>Câmeras</h3>
                        <p>Proteção em tempo real para sua casa ou empresa.</p>
                    </article>
                    <article class="home__flow-item">
                        <span class="home__flow-icon home__flow-icon--purple"><i class="icon icon-phone" aria-hidden="true"></i></span>
                        <h3>Aser Mobile</h3>
                        <p>Conectividade dentro e fora de casa.</p>
                    </article>
                    <article class="home__flow-item">
                        <span class="home__flow-icon home__flow-icon--orange"><i class="icon icon-car" aria-hidden="true"></i></span>
                        <h3>Rastreamento</h3>
                        <p>Mais controle e segurança para seu veículo.</p>
                    </article>
                    <article class="home__flow-item">
                        <span class="home__flow-icon"><i class="icon icon-phone" aria-hidden="true"></i></span>
                        <h3>Telefonia</h3>
                        <p>Comunicação eficiente para sua família ou sua empresa.</p>
                    </article>
                </div>
            </section>

            <section class="home__trust">
                <div class="home__trust-item home__trust-item--google">
                    <img class="home__google" src="<?= BASE_URL ?>/images/home/logoGoogle.png" alt="Google">
                    <p><strong>5.0 <span class="home__stars">★★★★★</span></strong><br>+ de 3.000 avaliações no Google</p>
                </div>
                <div class="home__trust-item">
                    <i class="icon icon-group" aria-hidden="true"></i>
                    <p>Milhares de clientes satisfeitos</p>
                </div>
                <div class="home__trust-item">
                    <i class="icon icon-support" aria-hidden="true"></i>
                    <p>Suporte local de verdade</p>
                </div>
                <div class="home__trust-item">
                    <i class="icon icon-setting" aria-hidden="true"></i>
                    <p>Instalação profissional e equipe especializada</p>
                </div>
            </section>

            <section class="home__cta">
                <div class="home__cta-copy">
                    <h2 class="home__cta-title">Pronto para encontrar a solução ideal?</h2>
                    <p class="home__cta-text">Fale com um especialista e descubra o melhor para sua casa ou empresa.</p>
                </div>

                <div class="home__cta-actions">
                    <a class="home__cta-button home__cta-button--whatsapp" href="https://wa.me/5508002225262">
                        <i class="icon icon-whatsapp" aria-hidden="true"></i>
                        <span>Falar no WhatsApp <strong>0800 222 5262</strong></span>
                    </a>
                    <a class="home__cta-button" href="tel:08002225262">
                        <i class="icon icon-phone" aria-hidden="true"></i>
                        <span>Ligar agora <strong>0800 222 5262</strong></span>
                    </a>
                </div>
            </section>
        </div>
    </div>
</section>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/inicio/home.js?' . $version . '"></script>';
?>

</body>
</html>
