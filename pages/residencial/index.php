<!DOCTYPE html>
<html>
<head>
<title>AserNet - Residencial</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<section class="residential">
    <div class="residential__hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="residential__hero-copy">
                        <h1 class="residential__hero-title">Internet de verdade, <strong>sem complicação.</strong></h1>
                        <p class="residential__hero-text">1 Giga de velocidade com estabilidade, cobertura e suporte para sua casa funcionar melhor.</p>

                        <ul class="residential__hero-list">
                            <li><i class="icon-checkmark" aria-hidden="true"></i>1 Giga em todos os planos</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Wi-Fi estável em toda a casa</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Suporte técnico AserNet</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Instalação rápida e profissional</li>
                        </ul>

                        <div class="residential__hero-actions">
                            <a class="residential__button residential__button--primary" href="<?= BASE_URL ?>/contato"><span>Quero contratar agora</span></a>
                            <a class="residential__button residential__button--outline" href="tel:08002225262">
                                <i class="icon-phone" aria-hidden="true"></i>
                                <span>0800 222 5262</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-6" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="residential__body">
        <section class="residential__diagnosis residential__desktop-only">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <h2 class="residential__section-title">A diferença não está na velocidade. Está na sua rede.</h2>
                        <p class="residential__section-text">Mesmo com internet rápida, muitos problemas acontecem por falta de cobertura e estrutura adequada dentro da casa.</p>

                        <div class="residential__problems">
                            <article><i class="icon-wifi" aria-hidden="true"></i><span>Sinal fraco<br>no quarto</span></article>
                            <article><i class="icon-tv" aria-hidden="true"></i><span>Travamentos<br>na TV</span></article>
                            <article><i class="icon-phone" aria-hidden="true"></i><span>Chamadas<br>caindo</span></article>
                            <article><i class="icon-wifiruim" aria-hidden="true"></i><span>Wi-Fi ruim em<br>alguns ambientes</span></article>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <img class="residential__diagnosis-image" src="<?= BASE_URL ?>/images/residencial/imgADifrencaNaoEstaNaVelocidade.png" alt="Casa com cobertura Wi-Fi inteligente">
                    </div>
                </div>
            </div>
        </section>

        <section class="residential__truth residential__desktop-only">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <h2 class="residential__section-title">Internet pensada para sua casa funcionar de verdade.</h2>
                        <p class="residential__section-text">A AserNet entrega soluções com cobertura inteligente, pontos de rede e Wi-Fi preparado para múltiplos dispositivos.</p>
                        <ul class="residential__checks">
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Mais estabilidade</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Melhor cobertura</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Melhor experiência para toda a família</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Estrutura preparada para sua necessidade</li>
                        </ul>
                    </div>

                    <div class="col-lg-7">
                        <div class="residential__benefits">
                            <article><i class="icon-wifiestavel" aria-hidden="true"></i><span>Conexão<br>estável</span></article>
                            <article><i class="icon-wificobertura" aria-hidden="true"></i><span>Cobertura<br>inteligente</span></article>
                            <article><i class="icon-family" aria-hidden="true"></i><span>Para toda<br>a família</span></article>
                            <article><i class="icon-structure" aria-hidden="true"></i><span>Estrutura que<br>a sua casa precisa</span></article>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="residential__plans">
            <div class="container">
                <h2 class="residential__center-title">Escolha o nível ideal para sua casa</h2>

                <div class="residential__plans-grid">
                    <article class="residential__plan">
                        <div class="residential__plan-heading"><i class="icon-wifiestavel" aria-hidden="true"></i><h3>ASER<br>CONECTA</h3></div>
                        <p class="residential__plan-description">Ideal para uso básico e casas compactas</p>
                        <ul class="residential__plan-list">
                            <li><i class="icon-checkmark" aria-hidden="true"></i>1 Giga de velocidade</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Wi-Fi estável</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Suporte AserNet</li>
                        </ul>
                        <p class="residential__price"><span>R$</span> 109,90<small>/mês</small></p>
                        <a class="residential__plan-button" href="<?= BASE_URL ?>/contato">Contratar agora</a>
                    </article>

                    <article class="residential__plan residential__plan--featured">
                        <span class="residential__badge">MAIS ESCOLHIDO</span>
                        <div class="residential__plan-heading"><i class="icon-star" aria-hidden="true"></i><h3>ASER<br>CONECTA PLUS</h3></div>
                        <p class="residential__plan-description">Mais estabilidade para famílias conectadas</p>
                        <ul class="residential__plan-list">
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Tudo do plano anterior</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Até 3 pontos de rede cabeados</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Melhor desempenho para TVs, videogames e home office</li>
                        </ul>
                        <span class="residential__plan-note">até 10 metros por ponto</span>
                        <p class="residential__price"><span>R$</span> 119,90<small>/mês</small></p>
                        <a class="residential__plan-button" href="<?= BASE_URL ?>/contato">Contratar agora</a>
                    </article>

                    <article class="residential__plan">
                        <div class="residential__plan-heading"><i class="icon-wifiestrutura" aria-hidden="true"></i><h3>ASER CASA<br>CONECTADA</h3></div>
                        <p class="residential__plan-description">Cobertura inteligente para toda a casa</p>
                        <ul class="residential__plan-list">
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Tudo do plano anterior</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Sistema Wi-Fi Mesh</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Cobertura ampliada</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Melhor experiência em múltiplos ambientes</li>
                        </ul>
                        <p class="residential__price"><span>R$</span> 139,90<small>/mês</small></p>
                        <a class="residential__plan-button" href="<?= BASE_URL ?>/contato">Contratar agora</a>
                    </article>
                </div>

                <p class="residential__plans-note"><i class="icon-checkmark" aria-hidden="true"></i>Todos os planos incluem 1 Giga de velocidade.</p>
            </div>
        </section>

        <section class="residential__routine">
            <div class="container">
                <h2 class="residential__center-title">Ideal para tudo que faz parte da sua rotina</h2>
                <div class="residential__routine-grid">
                    <article><i class="icon-streaming" aria-hidden="true"></i><span>Streaming<br>e filmes</span></article>
                    <article><i class="icon-homeoffice" aria-hidden="true"></i><span>Home Office<br>e estudos</span></article>
                    <article><i class="icon-videochamada" aria-hidden="true"></i><span>Videochamadas<br>e reuniões</span></article>
                    <article><i class="icon-videogame" aria-hidden="true"></i><span>Videogames<br>online</span></article>
                    <article><i class="icon-devices" aria-hidden="true"></i><span>Múltiplos<br>dispositivos</span></article>
                    <article><i class="icon-bighouse" aria-hidden="true"></i><span>Casas com<br>muitos ambientes</span></article>
                </div>
            </div>
        </section>

        <section class="residential__support">
            <div class="container">
                <div class="residential__support-grid">
                    <article><i class="icon-customersupport" aria-hidden="true"></i><h3>Suporte local de verdade</h3><p>Atendimento rápido e próximo sempre que precisar.</p></article>
                    <article><i class="icon-structure" aria-hidden="true"></i><h3>Estrutura inteligente</h3><p>Mais estabilidade e desempenho para sua casa.</p></article>
                    <article><i class="icon-engineer" aria-hidden="true"></i><h3>Instalação profissional</h3><p>Configuração completa e orientação inclusas sem custo adicional.</p></article>
                    <article><i class="icon-wificobertura" aria-hidden="true"></i><h3>Wi-Fi preparado para sua família</h3><p>Ideal para cada dispositivo e para a rotina conectada da sua casa.</p></article>
                </div>
            </div>
        </section>

        <section class="residential__trust">
            <div class="container">
                <div class="residential__trust-box">
                    <div class="residential__trust-heading">
                        <h2>A confiança de quem já é AserNet.</h2>
                        <div class="residential__google">
                            <img src="<?= BASE_URL ?>/images/logoGoogle.png" alt="Google">
                            <p><strong>+ de 3.000</strong> avaliações<br>no Google</p>
                        </div>
                    </div>
                    <div class="residential__reviews residential__desktop-only">
                        <article><p>"Internet estável de verdade! Cobertura em toda a casa."</p><div><span></span><strong>Juliana M.</strong></div></article>
                        <article><p>"Suporte rápido e atendimento excelente. Recomendo!"</p><div><span></span><strong>Carlos A.</strong></div></article>
                        <article><p>"Agora consigo trabalhar, assistir e jogar sem travamentos."</p><div><span></span><strong>Mariana S.</strong></div></article>
                    </div>
                </div>
            </div>
        </section>

        <section class="residential__mobile-local">
            <div class="container">
                <article><i class="icon-customersupport" aria-hidden="true"></i><h3>Atendimento local de verdade</h3></article>
            </div>
        </section>

        <section class="residential__cta">
            <div class="container">
                <div class="residential__cta-box">
                    <h2>Sua casa inteira conectada de verdade.</h2>
                    <div class="residential__cta-actions">
                        <a class="residential__cta-button residential__cta-button--whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="residential__cta-button" href="<?= BASE_URL ?>/contato"><i class="icon-calendar" aria-hidden="true"></i><span>Solicitar instalação</span></a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/residencial/residencial.js?' . $version . '"></script>';
?>

</body>
</html>
