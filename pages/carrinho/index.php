<!DOCTYPE html>
<html>
<head>
<title>AserNet - Carrinho</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<main class="cart-page" data-cart-page>
    <section class="cart-page__hero">
        <div class="container">
            <div class="cart-page__hero-grid">
                <div class="cart-page__hero-copy">
                    <span>Seu carrinho AserNet</span>
                    <h1>Monte sua combina&ccedil;&atilde;o de internet, mobilidade e seguran&ccedil;a.</h1>
                    <p>Veja o que voc&ecirc; j&aacute; selecionou e escolha planos ou op&ccedil;&otilde;es de cada produto para sua casa.</p>
                </div>

                <aside class="cart-page__hero-card">
                    <i class="icon-cart" aria-hidden="true"></i>
                    <strong><span data-cart-total>0</span> itens selecionados</strong>
                    <p>Depois de montar seu carrinho, fale com a AserNet para confirmar disponibilidade e condi&ccedil;&otilde;es.</p>
                </aside>
            </div>
        </div>
    </section>

    <section class="cart-page__content">
        <div class="container">
            <div class="cart-page__grid">
                <section class="cart-page__selected">
                    <header class="cart-page__section-head">
                        <div>
                            <span>Selecionados</span>
                            <h2>O que est&aacute; no seu carrinho</h2>
                        </div>
                        <button class="cart-page__clear" type="button" data-clear-cart>Limpar carrinho</button>
                    </header>

                    <div class="cart-page__selected-list" data-selected-list></div>

                    <div class="cart-page__empty" data-empty-cart>
                        <i class="icon-cart" aria-hidden="true"></i>
                        <h3>Seu carrinho est&aacute; vazio.</h3>
                        <p>Abra um produto abaixo e adicione uma op&ccedil;&atilde;o para come&ccedil;ar.</p>
                    </div>

                    <footer class="cart-page__summary">
                        <div>
                            <strong>Total selecionado</strong>
                            <span><b data-cart-total>0</b> itens</span>
                        </div>
                        <a href="https://wa.me/5508002225262" target="_blank" rel="noopener" data-whatsapp-cart>
                            Enviar para consultor
                            <i class="icon-whatsapp" aria-hidden="true"></i>
                        </a>
                    </footer>
                </section>

                <aside class="cart-page__estimate">
                    <span>Pr&eacute;via do carrinho</span>
                    <h2>Total estimado</h2>
                    <strong data-cart-estimate>R$ 0,00</strong>
                    <small><b data-cart-total>0</b> itens selecionados</small>
                    <p>Este valor &eacute; apenas uma pr&eacute;via. O valor final real ser&aacute; confirmado ao fechar com o vendedor, considerando disponibilidade, condi&ccedil;&otilde;es e combina&ccedil;&otilde;es do atendimento.</p>
                    <em data-cart-estimate-note hidden>Itens com valor “a partir de” entram na pr&eacute;via pelo menor valor exibido.</em>
                </aside>
            </div>

            <section class="cart-page__catalog">
                <header class="cart-page__catalog-head">
                    <span>Adicione ao carrinho</span>
                    <h2>Escolha um produto e veja as op&ccedil;&otilde;es</h2>
                </header>

                <div class="cart-page__accordion" data-cart-accordion>
                    <article class="cart-page__group cart-page__group--open" data-cart-group>
                        <button class="cart-page__group-toggle" type="button" aria-expanded="true">
                            <span><i class="icon-wifi" aria-hidden="true"></i><strong>Internet residencial</strong><small>Planos com 1 Giga de velocidade.</small></span>
                            <b>3 op&ccedil;&otilde;es</b>
                        </button>
                        <div class="cart-page__group-body">
                            <div class="cart-page__options">
                                <article class="cart-page__option" data-product-option data-product-id="internet-start" data-product-group="internet-residencial" data-product-title="Internet residencial - Start" data-product-subtitle="1 Giga em todos os planos" data-product-price="R$ 109,90/m&ecirc;s" data-product-icon="icon-wifi" data-product-url="<?= BASE_URL ?>/residencial">
                                    <h3>Plano Start</h3><p>Internet residencial para a rotina da casa.</p><strong>R$ 109,90<small>/m&ecirc;s</small></strong>
                                    <div><button type="button" data-add-product>Adicionar</button><a href="<?= BASE_URL ?>/residencial">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a></div>
                                </article>
                                <article class="cart-page__option" data-product-option data-product-id="internet-plus" data-product-group="internet-residencial" data-product-title="Internet residencial - Plus" data-product-subtitle="Tudo do plano anterior" data-product-price="R$ 119,90/m&ecirc;s" data-product-icon="icon-wifi" data-product-url="<?= BASE_URL ?>/residencial">
                                    <h3>Plano Plus</h3><p>Mais recursos para casas com mais dispositivos.</p><strong>R$ 119,90<small>/m&ecirc;s</small></strong>
                                    <div><button type="button" data-add-product>Adicionar</button><a href="<?= BASE_URL ?>/residencial">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a></div>
                                </article>
                                <article class="cart-page__option" data-product-option data-product-id="internet-ultra" data-product-group="internet-residencial" data-product-title="Internet residencial - Ultra" data-product-subtitle="Plano residencial mais completo" data-product-price="R$ 139,90/m&ecirc;s" data-product-icon="icon-wifi" data-product-url="<?= BASE_URL ?>/residencial">
                                    <h3>Plano Ultra</h3><p>Performance para streaming, jogos e home office.</p><strong>R$ 139,90<small>/m&ecirc;s</small></strong>
                                    <div><button type="button" data-add-product>Adicionar</button><a href="<?= BASE_URL ?>/residencial">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a></div>
                                </article>
                            </div>
                        </div>
                    </article>

                    <article class="cart-page__group" data-cart-group>
                        <button class="cart-page__group-toggle" type="button" aria-expanded="false">
                            <span><i class="icon-casino-cctv" aria-hidden="true"></i><strong>C&acirc;meras de seguran&ccedil;a</strong><small>Monitoramento residencial por quantidade de pontos.</small></span>
                            <b>3 op&ccedil;&otilde;es</b>
                        </button>
                        <div class="cart-page__group-body">
                            <div class="cart-page__options">
                                <article class="cart-page__option" data-product-option data-product-id="camera-1" data-product-group="cameras-seguranca" data-product-title="C&acirc;meras - 1 ponto" data-product-subtitle="Monitoramento inicial" data-product-price="R$ 49,90/m&ecirc;s" data-product-icon="icon-casino-cctv" data-product-url="<?= BASE_URL ?>/cameradeseguranca">
                                    <h3>1 c&acirc;mera</h3><p>Ideal para come&ccedil;ar a proteger um ambiente.</p><strong>R$ 49,90<small>/m&ecirc;s</small></strong>
                                    <div><button type="button" data-add-product>Adicionar</button><a href="<?= BASE_URL ?>/cameradeseguranca">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a></div>
                                </article>
                                <article class="cart-page__option" data-product-option data-product-id="camera-2" data-product-group="cameras-seguranca" data-product-title="C&acirc;meras - 2 pontos" data-product-subtitle="Mais cobertura para casa" data-product-price="R$ 99,80/m&ecirc;s" data-product-icon="icon-casino-cctv" data-product-url="<?= BASE_URL ?>/cameradeseguranca">
                                    <h3>2 c&acirc;meras</h3><p>Mais &aacute;reas monitoradas com acesso remoto.</p><strong>R$ 99,80<small>/m&ecirc;s</small></strong>
                                    <div><button type="button" data-add-product>Adicionar</button><a href="<?= BASE_URL ?>/cameradeseguranca">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a></div>
                                </article>
                                <article class="cart-page__option" data-product-option data-product-id="camera-3" data-product-group="cameras-seguranca" data-product-title="C&acirc;meras - 3 pontos" data-product-subtitle="Cobertura ampliada" data-product-price="R$ 119,70/m&ecirc;s" data-product-icon="icon-casino-cctv" data-product-url="<?= BASE_URL ?>/cameradeseguranca">
                                    <h3>3 c&acirc;meras</h3><p>Para quem quer monitorar v&aacute;rios pontos da casa.</p><strong>R$ 119,70<small>/m&ecirc;s</small></strong>
                                    <div><button type="button" data-add-product>Adicionar</button><a href="<?= BASE_URL ?>/cameradeseguranca">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a></div>
                                </article>
                            </div>
                        </div>
                    </article>

                    <article class="cart-page__group" data-cart-group>
                        <button class="cart-page__group-toggle" type="button" aria-expanded="false">
                            <span><i class="icon-mobile-phone" aria-hidden="true"></i><strong>Aser Mobile</strong><small>Planos m&oacute;veis com b&ocirc;nus de portabilidade.</small></span>
                            <b>3 op&ccedil;&otilde;es</b>
                        </button>
                        <div class="cart-page__group-body">
                            <div class="cart-page__options">
                                <article class="cart-page__option" data-product-option data-product-id="mobile-20gb" data-product-group="aser-mobile" data-product-title="Aser Mobile - 20 GB" data-product-subtitle="15 GB + 5 GB b&ocirc;nus portabilidade" data-product-price="R$ 39,90/m&ecirc;s" data-product-icon="icon-mobile-phone" data-product-url="<?= BASE_URL ?>/planomovel">
                                    <h3>20 GB</h3><p>15GB + 5GB b&ocirc;nus portabilidade.</p><strong>R$ 39,90<small>/m&ecirc;s</small></strong>
                                    <div><button type="button" data-add-product>Adicionar</button><a href="<?= BASE_URL ?>/planomovel">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a></div>
                                </article>
                                <article class="cart-page__option" data-product-option data-product-id="mobile-25gb" data-product-group="aser-mobile" data-product-title="Aser Mobile - 25 GB" data-product-subtitle="20 GB + 5 GB b&ocirc;nus portabilidade" data-product-price="R$ 59,90/m&ecirc;s" data-product-icon="icon-mobile-phone" data-product-url="<?= BASE_URL ?>/planomovel">
                                    <h3>25 GB</h3><p>20GB + 5GB b&ocirc;nus portabilidade.</p><strong>R$ 59,90<small>/m&ecirc;s</small></strong>
                                    <div><button type="button" data-add-product>Adicionar</button><a href="<?= BASE_URL ?>/planomovel">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a></div>
                                </article>
                                <article class="cart-page__option" data-product-option data-product-id="mobile-30gb" data-product-group="aser-mobile" data-product-title="Aser Mobile - 30 GB" data-product-subtitle="25 GB + 5 GB b&ocirc;nus portabilidade" data-product-price="R$ 69,90/m&ecirc;s" data-product-icon="icon-mobile-phone" data-product-url="<?= BASE_URL ?>/planomovel">
                                    <h3>30 GB</h3><p>25GB + 5GB b&ocirc;nus portabilidade.</p><strong>R$ 69,90<small>/m&ecirc;s</small></strong>
                                    <div><button type="button" data-add-product>Adicionar</button><a href="<?= BASE_URL ?>/planomovel">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a></div>
                                </article>
                            </div>
                        </div>
                    </article>

                    <article class="cart-page__group" data-cart-group>
                        <button class="cart-page__group-toggle" type="button" aria-expanded="false">
                            <span><i class="icon-carpin" aria-hidden="true"></i><strong>Rastreamento</strong><small>Prote&ccedil;&atilde;o para ve&iacute;culos, objetos e equipamentos.</small></span>
                            <b>3 op&ccedil;&otilde;es</b>
                        </button>
                        <div class="cart-page__group-body">
                            <div class="cart-page__options">
                                <article class="cart-page__option" data-product-option data-product-id="rastreador-veicular" data-product-group="rastreamento" data-product-title="Rastreamento veicular" data-product-subtitle="Plano para carro ou moto" data-product-price="R$ 49,90/m&ecirc;s" data-product-icon="icon-carpin" data-product-url="<?= BASE_URL ?>/rastreamentoveicular">
                                    <h3>Rastreador veicular</h3><p>Localiza&ccedil;&atilde;o e controle para carro ou moto.</p><strong>R$ 49,90<small>/m&ecirc;s</small></strong>
                                    <div><button type="button" data-add-product>Adicionar</button><a href="<?= BASE_URL ?>/rastreamentoveicular">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a></div>
                                </article>
                                <article class="cart-page__option" data-product-option data-product-id="rastreador-premium" data-product-group="rastreamento" data-product-title="Rastreamento premium" data-product-subtitle="Plano veicular completo" data-product-price="R$ 69,90/m&ecirc;s" data-product-icon="icon-carpin" data-product-url="<?= BASE_URL ?>/rastreamentoveicular">
                                    <h3>Rastreamento premium</h3><p>Mais recursos para acompanhar seu ve&iacute;culo.</p><strong>R$ 69,90<small>/m&ecirc;s</small></strong>
                                    <div><button type="button" data-add-product>Adicionar</button><a href="<?= BASE_URL ?>/rastreamentoveicular">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a></div>
                                </article>
                                <article class="cart-page__option" data-product-option data-product-id="tag-localizadora" data-product-group="rastreamento" data-product-title="Tag localizadora" data-product-subtitle="Objetos, bolsas, malas e equipamentos" data-product-price="R$ 19,90/m&ecirc;s" data-product-icon="icon-pin" data-product-url="<?= BASE_URL ?>/rastreamentoveicular">
                                    <h3>Tag localizadora</h3><p>Para objetos de valor, bolsas e equipamentos.</p><strong>R$ 19,90<small>/m&ecirc;s</small></strong>
                                    <div><button type="button" data-add-product>Adicionar</button><a href="<?= BASE_URL ?>/rastreamentoveicular">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a></div>
                                </article>
                            </div>
                        </div>
                    </article>

                    <article class="cart-page__group" data-cart-group>
                        <button class="cart-page__group-toggle" type="button" aria-expanded="false">
                            <span><i class="icon-wifimesh" aria-hidden="true"></i><strong>Wi-Fi Mesh</strong><small>Cobertura inteligente para todos os ambientes.</small></span>
                            <b>1 op&ccedil;&atilde;o</b>
                        </button>
                        <div class="cart-page__group-body">
                            <div class="cart-page__options">
                                <article class="cart-page__option" data-product-option data-product-id="wifi-mesh-kit" data-product-group="wifi-mesh" data-product-title="Wi-Fi Mesh" data-product-subtitle="Cobertura inteligente residencial" data-product-price="A partir de R$ 139,90/m&ecirc;s" data-product-icon="icon-wifimesh" data-product-url="<?= BASE_URL ?>/wifimesh">
                                    <h3>Wi-Fi Mesh</h3><p>Cobertura forte para todos os c&ocirc;modos.</p><strong>A partir de R$ 139,90<small>/m&ecirc;s</small></strong>
                                    <div><button type="button" data-add-product>Adicionar</button><a href="<?= BASE_URL ?>/wifimesh">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a></div>
                                </article>
                            </div>
                        </div>
                    </article>

                </div>
            </section>
        </div>
    </section>
</main>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/carrinho/carrinho.js?' . $version . '"></script>';
?>

</body>
</html>
