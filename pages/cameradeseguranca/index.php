<!DOCTYPE html>
<html>
<head>
<title>AserNet - Câmeras de segurança</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<section class="camera-security">
    <div class="camera-security__hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="camera-security__hero-copy">
                        <h1 class="camera-security__hero-title">Segurança de verdade, sem complicação.</h1>
                        <p class="camera-security__hero-text">Monitore sua casa ou empresa em tempo real, direto pelo celular.</p>

                        <ul class="camera-security__hero-list">
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Instalação inclusa</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Acesso remoto pelo aplicativo</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Equipamentos inclusos em comodato</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Suporte AserNet</li>
                        </ul>

                        <p class="camera-security__hero-price">Planos a partir de <strong>R$ 49,90<small>/mês</small></strong></p>

                        <div class="camera-security__hero-actions">
                            <a class="camera-security__button camera-security__button--primary" href="<?= BASE_URL ?>/contato"><i class="icon-security" aria-hidden="true"></i>Quero proteger meu imóvel</a>
                            <a class="camera-security__button camera-security__button--outline" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i>0800 222 5262</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-6" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="camera-security__body">
        <section class="camera-security__pain">
            <div class="container">
                <h2>Você nem sempre consegue estar presente. <strong>Mas sua segurança pode.</strong></h2>
                <div class="camera-security__pain-grid">
                    <article><i class="icon-home" aria-hidden="true"></i><span>Preocupação<br>ao sair de casa</span></article>
                    <article><i class="icon-monitoramento" aria-hidden="true"></i><span>Empresa sem<br>monitoramento</span></article>
                    <article><i class="icon-funcionarios" aria-hidden="true"></i><span>Dificuldade para<br>acompanhar funcionários</span></article>
                    <article><i class="icon-inseguranca" aria-hidden="true"></i><span>Insegurança<br>no dia a dia</span></article>
                </div>
            </div>
        </section>

        <section class="camera-security__monitor">
            <div class="container">
                <h2 class="camera-security__title">Acompanhe tudo em tempo real pelo celular</h2>
                <p class="camera-security__text">Com a Aser Câmeras você monitora sua casa ou empresa de qualquer lugar.</p>

                <div class="camera-security__monitor-grid">
                    <ul class="camera-security__checks">
                        <li><i class="icon-checkmark" aria-hidden="true"></i>Visualização ao vivo</li>
                        <li><i class="icon-checkmark" aria-hidden="true"></i>Acesso remoto pelo app</li>
                        <li><i class="icon-checkmark" aria-hidden="true"></i>Notificações e alertas inteligentes</li>
                        <li><i class="icon-checkmark" aria-hidden="true"></i>Armazenamento em nuvem</li>
                        <li><i class="icon-checkmark" aria-hidden="true"></i>Equipamentos inclusos em comodato</li>
                    </ul>

                    <div class="camera-security__monitor-visual">
                        <img class="camera-security__monitor-image" src="<?= BASE_URL ?>/images/cameraseguranca/imagAcompanheTudoEmTempoReal.png" alt="Aplicativo de câmeras com família em casa">
                    </div>
                </div>

                <div class="camera-security__audience">
                    <a href="<?= BASE_URL ?>/contato">
                        <i class="icon-home" aria-hidden="true"></i>
                        <span><strong>Para sua casa</strong>Mais tranquilidade para sua família e controle do seu imóvel mesmo à distância.</span>
                        <img src="<?= BASE_URL ?>/images/cameraseguranca/imgParaSuaCasa.png" alt="">
                    </a>

                    <a href="<?= BASE_URL ?>/contato">
                        <i class="icon-paraempresa" aria-hidden="true"></i>
                        <span><strong>Para sua empresa</strong>Mais segurança, monitoramento e acompanhamento da operação da sua empresa.</span>
                        <img src="<?= BASE_URL ?>/images/cameraseguranca/imgParaSuaEmpresa.png" alt="">
                    </a>
                </div>
            </div>
        </section>

        <section class="camera-security__plans-section">
            <div class="container">
                <h2 class="camera-security__title">Escolha o plano ideal para você</h2>

                <div class="camera-security__plans">
                    <article class="camera-security__plan">
                        <div class="camera-security__plan-copy">
                            <h3>1 CÂMERA</h3>
                            <p>Mais para entradas e monitoramento básico</p>
                        </div>
                        <img src="<?= BASE_URL ?>/images/cameraseguranca/img1Camera.png" alt="">
                        <p class="camera-security__price"><span>R$</span> 49,90<small>/mês</small></p>
                        <ul>
                            <li>1 câmera HD</li>
                            <li>Visão noturna</li>
                            <li>Acesso remoto pelo app</li>
                            <li>Armazenamento em nuvem</li>
                        </ul>
                        <a href="<?= BASE_URL ?>/carrinho" data-cart-add data-cart-id="camera-1" data-cart-group="cameras-seguranca" data-cart-title="C&acirc;meras - 1 ponto" data-cart-subtitle="Monitoramento inicial" data-cart-price="R$ 49,90/m&ecirc;s" data-cart-icon="icon-casino-cctv" data-cart-url="<?= BASE_URL ?>/cameradeseguranca">Contratar</a>
                    </article>

                    <article class="camera-security__plan camera-security__plan--featured">
                        <span>Mais contratado</span>
                        <div class="camera-security__plan-copy">
                            <h3>2 CÂMERAS</h3>
                            <p>Cobertura ampliada para ambientes maiores</p>
                        </div>
                        <img src="<?= BASE_URL ?>/images/cameraseguranca/imag2Cameras.png" alt="">
                        <p class="camera-security__price"><span>R$</span> 99,80<small>/mês</small></p>
                        <ul>
                            <li>2 câmeras HD</li>
                            <li>Visão noturna</li>
                            <li>Acesso remoto pelo app</li>
                            <li>Armazenamento em nuvem</li>
                        </ul>
                        <a href="<?= BASE_URL ?>/carrinho" data-cart-add data-cart-id="camera-2" data-cart-group="cameras-seguranca" data-cart-title="C&acirc;meras - 2 pontos" data-cart-subtitle="Mais cobertura para casa" data-cart-price="R$ 99,80/m&ecirc;s" data-cart-icon="icon-casino-cctv" data-cart-url="<?= BASE_URL ?>/cameradeseguranca">Contratar</a>
                    </article>

                    <article class="camera-security__plan camera-security__plan--orange">
                        <span>Mais proteção</span>
                        <div class="camera-security__plan-copy">
                            <h3>2 CÂMERAS + ALARME</h3>
                            <p>Mais proteção com monitoramento inteligente</p>
                        </div>
                        <img src="<?= BASE_URL ?>/images/cameraseguranca/img2CamerasAlarame.png" alt="">
                        <p class="camera-security__price"><span>R$</span> 119,70<small>/mês</small></p>
                        <ul>
                            <li>2 câmeras HD</li>
                            <li>Central de alarme</li>
                            <li>Visão noturna</li>
                            <li>Acesso remoto pelo app</li>
                            <li>Armazenamento em nuvem</li>
                        </ul>
                        <a href="<?= BASE_URL ?>/carrinho" data-cart-add data-cart-id="camera-3" data-cart-group="cameras-seguranca" data-cart-title="C&acirc;meras - 3 pontos" data-cart-subtitle="Cobertura ampliada" data-cart-price="R$ 119,70/m&ecirc;s" data-cart-icon="icon-casino-cctv" data-cart-url="<?= BASE_URL ?>/cameradeseguranca">Contratar</a>
                    </article>
                </div>

                <a class="camera-security__proposal" href="<?= BASE_URL ?>/contato">Solicitar proposta</a>
            </div>
        </section>

        <section class="camera-security__how">
            <div class="container">
                <div class="camera-security__how-grid">
                    <div>
                        <h2 class="camera-security__title">Como funciona</h2>
                        <p class="camera-security__text">Simples e sem burocracia</p>

                        <div class="camera-security__steps">
                            <article><i class="icon-escolherplano" aria-hidden="true"></i><b>1</b><span>Escolha o plano ideal para sua necessidade</span></article>
                            <article><i class="icon-calendar" aria-hidden="true"></i><b>2</b><span>Agendamos a instalação</span></article>
                            <article><i class="icon-app" aria-hidden="true"></i><b>3</b><span>Configuramos o aplicativo</span></article>
                            <article><i class="icon-view" aria-hidden="true"></i><b>4</b><span>Você acompanha tudo pelo celular</span></article>
                        </div>
                    </div>

                    <aside class="camera-security__app-card">
                        <div>
                            <h3>Sua segurança na palma da mão</h3>
                            <p>Acompanhe suas câmeras em tempo real pelo aplicativo.</p>
                            <ul>
                                <li><i class="icon-checkmark" aria-hidden="true"></i>Android e iPhone</li>
                                <li><i class="icon-checkmark" aria-hidden="true"></i>Visualização remota</li>
                                <li><i class="icon-checkmark" aria-hidden="true"></i>Alertas inteligentes</li>
                            </ul>
                        </div>
                        <img src="<?= BASE_URL ?>/images/cameraseguranca/imgSuaSegurancaNaPalmaDaMao.png" alt="Aplicativo de monitoramento no celular">
                    </aside>
                </div>
            </div>
        </section>

        <section class="camera-security__differentials">
            <div class="container">
                <h2 class="camera-security__title">Diferenciais Aser Câmeras</h2>
                <div class="camera-security__differentials-grid">
                    <article><i class="icon-engineer" aria-hidden="true"></i><h3>Instalação inclusa</h3><p>Nossa equipe cuida de tudo para você.</p></article>
                    <article><i class="icon-casino-cctv" aria-hidden="true"></i><h3>Equipamentos em comodato</h3><p>Sem necessidade de compra.</p></article>
                    <article><i class="icon-customersupport" aria-hidden="true"></i><h3>Suporte local</h3><p>Atendimento próximo e rápido quando você precisar.</p></article>
                    <article><i class="icon-expansivel" aria-hidden="true"></i><h3>Expansível</h3><p>Adicione mais câmeras conforme sua necessidade.</p></article>
                </div>

                <div class="camera-security__trust">
                    <img src="<?= BASE_URL ?>/images/cameraseguranca/logoGoogle.png" alt="Google">
                    <p><strong>★★★★★</strong><br>avaliações no Google</p>
                    <span><i class="icon-group" aria-hidden="true"></i>Atendimento local de verdade</span>
                </div>
            </div>
        </section>

        <section class="camera-security__cta">
            <div class="container">
                <div class="camera-security__cta-box">
                    <h2>Mais tranquilidade para sua casa ou empresa</h2>
                    <div class="camera-security__cta-actions">
                        <a class="camera-security__cta-button camera-security__cta-button--whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="camera-security__cta-button" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><span>Solicitar análise de segurança</span></a>
                    </div>
                    <img src="<?= BASE_URL ?>/images/cameraseguranca/img1Camera.png" alt="">
                </div>
            </div>
        </section>

        <section class="camera-security__footer-benefits">
            <div class="container">
                <span><i class="icon-engineer" aria-hidden="true"></i>Instalação inclusa</span>
                <span><i class="icon-equipamentocomodato" aria-hidden="true"></i>Equipamentos em comodato</span>
                <span><i class="icon-contrato" aria-hidden="true"></i>Contratos sem fidelidade</span>
                <span><i class="icon-payment" aria-hidden="true"></i>Pagamento facilitado</span>
                <span><i class="icon-support" aria-hidden="true"></i>Suporte local</span>
            </div>
        </section>
    </div>
</section>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/cameradeseguranca/cameradeseguranca.js?' . $version . '"></script>';
?>

</body>
</html>
