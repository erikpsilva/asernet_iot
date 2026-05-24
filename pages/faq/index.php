<!DOCTYPE html>
<html>
<head>
<title>AserNet - Perguntas Frequentes</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<section class="faq-page">
    <div class="faq-page__hero">
        <div class="container">
            <div class="faq-page__hero-copy">
                <span>Perguntas frequentes</span>
                <h1>Como podemos <strong>ajudar?</strong></h1>
                <p>Encontre respostas r&aacute;pidas sobre internet, suporte, pagamentos, equipamentos e solu&ccedil;&otilde;es AserNet.</p>

                <form class="faq-page__search" action="<?= BASE_URL ?>/faq" method="get">
                    <label for="faq-search">Digite sua d&uacute;vida</label>
                    <input id="faq-search" type="search" name="q" placeholder="Digite sua d&uacute;vida...">
                    <button type="submit" aria-label="Buscar"><i class="icon-view" aria-hidden="true"></i></button>
                </form>

                <div class="faq-page__hero-info">
                    <article><i class="icon-pin" aria-hidden="true"></i><span><strong>Atendimento local</strong>Perto de voc&ecirc;, sempre que precisar.</span></article>
                    <article><i class="icon-clock" aria-hidden="true"></i><span><strong>Suporte r&aacute;pido</strong>Respostas &aacute;geis para o que voc&ecirc; precisa.</span></article>
                    <article><i class="icon-customersupport" aria-hidden="true"></i><span><strong>Equipe especializada</strong>Profissionais preparados para ajudar voc&ecirc;.</span></article>
                </div>

                <a class="faq-page__hero-whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
            </div>
        </div>
    </div>

    <div class="faq-page__body">
        <section class="faq-page__categories">
            <div class="container">
                <div class="faq-page__category-grid">
                    <article><i class="icon-home" aria-hidden="true"></i><h2>Internet Residencial</h2><p>Planos, instala&ccedil;&atilde;o, cobertura e mais.</p><a href="#internet">Ver perguntas <span aria-hidden="true">-&gt;</span></a></article>
                    <article><i class="icon-wifi" aria-hidden="true"></i><h2>Wi-Fi e Cobertura</h2><p>Tudo sobre Wi-Fi, Mesh e sinal.</p><a href="#wifi">Ver perguntas <span aria-hidden="true">-&gt;</span></a></article>
                    <article><i class="icon-mobile-phone" aria-hidden="true"></i><h2>Mobile</h2><p>Planos, portabilidade, cobertura e b&ocirc;nus.</p><a href="#mobile">Ver perguntas <span aria-hidden="true">-&gt;</span></a></article>
                    <article><i class="icon-office" aria-hidden="true"></i><h2>Empresarial</h2><p>Solu&ccedil;&otilde;es para empresas, PME e Link Dedicado.</p><a href="#empresarial">Ver perguntas <span aria-hidden="true">-&gt;</span></a></article>
                    <article><i class="icon-security" aria-hidden="true"></i><h2>C&acirc;meras e Rastreamento</h2><p>Seguran&ccedil;a, c&acirc;meras, rastreadores e tags.</p><a href="#seguranca">Ver perguntas <span aria-hidden="true">-&gt;</span></a></article>
                    <article><i class="icon-payment" aria-hidden="true"></i><h2>Financeiro e Suporte</h2><p>Pagamentos, faturas, suporte e atendimento.</p><a href="#financeiro">Ver perguntas <span aria-hidden="true">-&gt;</span></a></article>
                </div>
                <button class="faq-page__all-categories" type="button">Ver todas as categorias <span aria-hidden="true">⌄</span></button>
            </div>
        </section>

        <section class="faq-page__questions">
            <div class="container">
                <div class="faq-page__question-grid">
                    <article class="faq-page__question-card" id="internet">
                        <h2><i class="icon-home" aria-hidden="true"></i>Internet Residencial</h2>
                        <details><summary>Todos os planos possuem 1 Giga?</summary><p>Consulte a disponibilidade para seu endere&ccedil;o. Nossa equipe indica o plano ideal para sua regi&atilde;o.</p></details>
                        <details><summary>Qual a diferen&ccedil;a entre os planos?</summary><p>Os planos variam por velocidade, servi&ccedil;os inclusos e solu&ccedil;&otilde;es adicionais.</p></details>
                        <details><summary>A instala&ccedil;&atilde;o est&aacute; inclusa?</summary><p>A instala&ccedil;&atilde;o pode variar conforme campanha e viabilidade t&eacute;cnica.</p></details>
                        <details><summary>Posso usar meu pr&oacute;prio roteador?</summary><p>Sim, desde que o equipamento seja compat&iacute;vel e configurado corretamente.</p></details>
                    </article>

                    <article class="faq-page__question-card faq-page__question-card--purple" id="wifi">
                        <h2><i class="icon-wifi" aria-hidden="true"></i>Wi-Fi e Cobertura</h2>
                        <details><summary>O que &eacute; Wi-Fi Mesh?</summary><p>&Eacute; uma tecnologia que amplia a cobertura usando pontos integrados para melhorar o sinal.</p></details>
                        <details><summary>O Wi-Fi chega em toda a casa?</summary><p>Depende do tamanho e das paredes do ambiente. Podemos dimensionar a melhor solu&ccedil;&atilde;o.</p></details>
                        <details><summary>Muitos dispositivos podem deixar o Wi-Fi lento?</summary><p>Sim. Para muitos dispositivos, recomendamos solu&ccedil;&otilde;es como Mesh ou Wi-Fi Profissional.</p></details>
                    </article>

                    <article class="faq-page__question-card faq-page__question-card--compact faq-page__question-card--purple" id="mobile">
                        <h2><i class="icon-mobile-phone" aria-hidden="true"></i>Mobile</h2>
                        <details><summary>Posso manter meu n&uacute;mero atual?</summary><p>Sim, fazemos portabilidade conforme regras da operadora.</p></details>
                        <details><summary>O plano possui cobertura nacional?</summary><p>Sim, conforme &aacute;rea de cobertura m&oacute;vel dispon&iacute;vel.</p></details>
                        <details><summary>Como funciona o b&ocirc;nus de portabilidade?</summary><p>O b&ocirc;nus &eacute; aplicado em planos eleg&iacute;veis ap&oacute;s a portabilidade.</p></details>
                    </article>

                    <article class="faq-page__question-card faq-page__question-card--compact faq-page__question-card--green" id="empresarial">
                        <h2><i class="icon-office" aria-hidden="true"></i>Empresarial</h2>
                        <details><summary>Qual a diferen&ccedil;a entre internet PME e Link Dedicado?</summary><p>Internet PME atende empresas do dia a dia; Link Dedicado oferece banda exclusiva para opera&ccedil;&otilde;es cr&iacute;ticas.</p></details>
                        <details><summary>O Wi-Fi Pro &eacute; indicado para muitos dispositivos?</summary><p>Sim, ele foi pensado para ambientes com alta demanda de conex&atilde;o.</p></details>
                        <details><summary>Voc&ecirc;s atendem hot&eacute;is, cl&iacute;nicas e empresas?</summary><p>Sim. Projetamos solu&ccedil;&otilde;es conforme o tamanho e necessidade do neg&oacute;cio.</p></details>
                    </article>

                    <article class="faq-page__question-card faq-page__question-card--compact faq-page__question-card--orange" id="seguranca">
                        <h2><i class="icon-security" aria-hidden="true"></i>C&acirc;meras e Rastreamento</h2>
                        <details><summary>Posso acessar as c&acirc;meras pelo celular?</summary><p>Sim, o acesso pode ser feito por aplicativo compat&iacute;vel.</p></details>
                        <details><summary>O rastreador funciona para motos e bicicletas el&eacute;tricas?</summary><p>Sim, temos solu&ccedil;&otilde;es para carros, motos, caminh&otilde;es, bicicletas el&eacute;tricas e tags.</p></details>
                        <details><summary>A Tag Localizadora serve para qu&ecirc;?</summary><p>Serve para acompanhar objetos, bolsas, mochilas, malas e outros pertences.</p></details>
                    </article>

                    <article class="faq-page__question-card faq-page__question-card--wide faq-page__question-card--cyan" id="financeiro">
                        <h2><i class="icon-payment" aria-hidden="true"></i>Financeiro e Suporte</h2>
                        <details><summary>Como emitir segunda via?</summary><p>A segunda via pode ser solicitada pela central do cliente ou canais de atendimento.</p></details>
                        <details><summary>Como falar com o suporte?</summary><p>Voc&ecirc; pode falar pelo WhatsApp, telefone ou canais oficiais da AserNet.</p></details>
                        <details><summary>Posso alterar a data de vencimento?</summary><p>Consulte nossa equipe para verificar disponibilidade de altera&ccedil;&atilde;o.</p></details>
                    </article>
                </div>
            </div>
        </section>

        <section class="faq-page__trust">
            <div class="container">
                <div class="faq-page__trust-grid">
                    <div class="faq-page__google"><img src="<?= BASE_URL ?>/images/logoGoogle.png" alt="Google"><p><strong>+ de 3.000 avalia&ccedil;&otilde;es</strong><br>no Google</p></div>
                    <article><i class="icon-pin" aria-hidden="true"></i>Atendimento local de verdade</article>
                    <article><i class="icon-setting" aria-hidden="true"></i>Instala&ccedil;&atilde;o profissional</article>
                    <article><i class="icon-group" aria-hidden="true"></i>Equipe especializada</article>
                    <article><i class="icon-gear" aria-hidden="true"></i>Solu&ccedil;&otilde;es completas para voc&ecirc;</article>
                </div>
            </div>
        </section>

        <section class="faq-page__cta">
            <div class="container">
                <div class="faq-page__cta-box">
                    <img src="<?= BASE_URL ?>/images/faq/imgNaoEncontrouSuaDuvida.png" alt="Atendente AserNet">
                    <div>
                        <h2>N&atilde;o encontrou sua d&uacute;vida?</h2>
                        <p>Fale com a nossa equipe. Estamos prontos para ajudar!</p>
                    </div>
                    <div class="faq-page__cta-actions">
                        <a class="faq-page__cta-button faq-page__cta-button--whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="faq-page__cta-button" href="<?= BASE_URL ?>/contato"><i class="icon-talk" aria-hidden="true"></i><span>Abrir atendimento</span></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-page__footer">
            <div class="container">
                <div class="faq-page__footer-grid">
                    <div>
                        <img src="<?= BASE_URL ?>/images/logo-transparent.png" alt="AserNet">
                        <p>Mais que internet. Solu&ccedil;&otilde;es completas em conectividade, seguran&ccedil;a, mobilidade e tecnologia para sua casa ou empresa.</p>
                    </div>
                    <nav><h2>Solu&ccedil;&otilde;es</h2><a href="<?= BASE_URL ?>/residencial">Internet Residencial</a><a href="<?= BASE_URL ?>/paraempresas">Empresas (PME)</a><a href="<?= BASE_URL ?>/wifiprofissional">Wi-Fi Profissional</a><a href="<?= BASE_URL ?>/cameradeseguranca">C&acirc;meras de Seguran&ccedil;a</a><a href="<?= BASE_URL ?>/rastreamentoveicular">Rastreamento Veicular</a><a href="<?= BASE_URL ?>/planomovel">Aser Mobile</a></nav>
                    <nav><h2>Institucional</h2><a href="<?= BASE_URL ?>/sobre">Sobre a AserNet</a><a href="<?= BASE_URL ?>/contato">Trabalhe Conosco</a><a href="<?= BASE_URL ?>/politica-de-privacidade">Pol&iacute;tica de Privacidade</a><a href="<?= BASE_URL ?>/termos-de-uso">Termos de Uso</a></nav>
                    <nav><h2>Suporte</h2><a href="<?= BASE_URL ?>/faq">Perguntas Frequentes</a><a href="<?= BASE_URL ?>/contato">Central do Cliente</a><a href="<?= BASE_URL ?>/contato">Abrir Atendimento</a><a href="<?= BASE_URL ?>/contato">Canais de Atendimento</a></nav>
                    <address><h2>Atendimento</h2><a href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i>0800 222 5262</a><a href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i>0800 222 5262</a><a href="mailto:atendimento@asernet.com.br"><i class="icon-talk" aria-hidden="true"></i>atendimento@asernet.com.br</a></address>
                </div>
                <p class="faq-page__copyright">&copy; 2024 AserNet. Todos os direitos reservados.</p>
            </div>
        </section>
    </div>
</section>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/faq/faq.js?' . $version . '"></script>';
?>

</body>
</html>
