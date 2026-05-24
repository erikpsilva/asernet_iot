<!DOCTYPE html>
<html>
<head>
<title>AserNet - Contato</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<section class="contact-page">
    <div class="contact-page__hero">
        <div class="container">
            <div class="contact-page__hero-copy">
                <h1>Fale com um consultor AserNet</h1>
                <p>Descubra a melhor solu&ccedil;&atilde;o de internet e tecnologia para sua casa ou empresa.</p>

                <ul>
                    <li><i class="icon-checkmark" aria-hidden="true"></i>Atendimento r&aacute;pido</li>
                    <li><i class="icon-checkmark" aria-hidden="true"></i>Especialista da sua regi&atilde;o</li>
                    <li><i class="icon-checkmark" aria-hidden="true"></i>Sem compromisso</li>
                </ul>

                <div class="contact-page__hero-actions">
                    <a class="contact-page__button contact-page__button--whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i>Falar no WhatsApp</a>
                    <a class="contact-page__button contact-page__button--outline" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i>0800 222 5262</a>
                </div>

                <span class="contact-page__response"><i class="icon-clock" aria-hidden="true"></i>Resposta r&aacute;pida em poucos minutos</span>
            </div>
        </div>
    </div>

    <div class="contact-page__body">
        <section class="contact-page__form-section">
            <div class="container">
                <form class="contact-page__form" action="<?= BASE_URL ?>/contato" method="post">
                    <h2>Prefere que a gente te chame?</h2>
                    <p>Preencha abaixo que um consultor entra em contato com voc&ecirc;.</p>

                    <label>Nome completo<input type="text" name="nome" placeholder="Digite seu nome"></label>
                    <label>Telefone (WhatsApp)<input type="tel" name="telefone" placeholder="(47) 99999-9999"></label>
                    <label>Cidade / Bairro<input type="text" name="cidade" placeholder="Ex.: Jaragu&aacute; do Sul / Centro"></label>

                    <fieldset>
                        <legend>O que voc&ecirc; precisa?</legend>
                        <label><i class="icon-home" aria-hidden="true"></i><span>Internet residencial</span><input type="checkbox" name="interesse[]" value="internet-residencial" checked></label>
                        <label><i class="icon-office" aria-hidden="true"></i><span>Internet para empresa</span><input type="checkbox" name="interesse[]" value="internet-empresa"></label>
                        <label><i class="icon-casino-cctv" aria-hidden="true"></i><span>C&acirc;meras de seguran&ccedil;a</span><input type="checkbox" name="interesse[]" value="cameras"></label>
                        <label><i class="icon-wifi" aria-hidden="true"></i><span>Wi-Fi profissional</span><input type="checkbox" name="interesse[]" value="wifi-profissional"></label>
                        <label><i class="icon-pin" aria-hidden="true"></i><span>Rastreamento</span><input type="checkbox" name="interesse[]" value="rastreamento"></label>
                        <label><i class="icon-phone" aria-hidden="true"></i><span>Telefonia</span><input type="checkbox" name="interesse[]" value="telefonia"></label>
                        <label><i class="icon-talk" aria-hidden="true"></i><span>Outros</span><input type="checkbox" name="interesse[]" value="outros"></label>
                    </fieldset>

                    <button type="submit">Quero falar com um consultor</button>
                    <small><i class="icon-security" aria-hidden="true"></i>Seus dados est&atilde;o seguros. N&atilde;o enviamos spam.</small>
                </form>
            </div>
        </section>

        <section class="contact-page__trust">
            <div class="container">
                <div class="contact-page__trust-grid">
                    <div class="contact-page__google"><img src="<?= BASE_URL ?>/images/logoGoogle.png" alt="Google"><p><strong>5.0</strong> + de 3.000 avalia&ccedil;&otilde;es no Google</p></div>
                    <article><i class="icon-link" aria-hidden="true"></i>+ de 3.000 clientes satisfeitos</article>
                    <article><i class="icon-security" aria-hidden="true"></i>Atendimento local de verdade</article>
                </div>
            </div>
        </section>

        <section class="contact-page__why">
            <div class="container">
                <div class="contact-page__why-grid">
                    <div>
                        <h2>Aqui voc&ecirc; n&atilde;o contrata s&oacute; <strong>internet.</strong></h2>
                        <p>Voc&ecirc; recebe uma solu&ccedil;&atilde;o completa, com tecnologia, estabilidade e suporte pr&oacute;ximo para sua casa ou empresa funcionar de verdade.</p>
                        <a href="<?= BASE_URL ?>/sobreasernet">Saiba mais <span aria-hidden="true">-&gt;</span></a>
                        <ul>
                            <li><i class="icon-pin" aria-hidden="true"></i>Tecnologia de ponta</li>
                            <li><i class="icon-customersupport" aria-hidden="true"></i>Suporte local e r&aacute;pido</li>
                            <li><i class="icon-gear" aria-hidden="true"></i>Solu&ccedil;&otilde;es completas</li>
                            <li><i class="icon-security" aria-hidden="true"></i>Satisfa&ccedil;&atilde;o garantida</li>
                        </ul>
                    </div>
                    <img src="<?= BASE_URL ?>/images/contato/imgAquiVoceNaoContrataSoInternet.png" alt="Fam&iacute;lia conectada com solu&ccedil;&otilde;es AserNet">
                </div>
            </div>
        </section>

        <section class="contact-page__cta">
            <div class="container">
                <div class="contact-page__cta-box">
                    <h2>Quer resolver isso agora?</h2>
                    <p>Fale com um consultor e tenha a melhor solu&ccedil;&atilde;o da AserNet para voc&ecirc;.</p>
                    <div class="contact-page__cta-actions">
                        <a class="contact-page__cta-button contact-page__cta-button--whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="contact-page__cta-button" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><span>Ligar gratuitamente <strong>0800 222 5262</strong></span></a>
                    </div>
                    <div class="contact-page__cta-benefits">
                        <span><i class="icon-rocket" aria-hidden="true"></i>Instala&ccedil;&atilde;o r&aacute;pida e sem burocracia</span>
                        <span><i class="icon-payment" aria-hidden="true"></i>Sem custo de visita</span>
                        <span><i class="icon-calendar" aria-hidden="true"></i>Instala&ccedil;&atilde;o ainda essa semana*</span>
                    </div>
                    <small>*Consulte disponibilidade para sua regi&atilde;o.</small>
                </div>
            </div>
        </section>
    </div>
</section>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/contato/contato.js?' . $version . '"></script>';
?>

</body>
</html>
