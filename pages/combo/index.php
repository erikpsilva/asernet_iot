<!DOCTYPE html>
<html>
<head>
<title>AserNet - Combos</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<?php
// ── Banner (hero) ──────────────────────────────────────────────────────────
$_bn = [
    'titulo'             => 'Mais que internet.',
    'titulo_destaque'    => 'Soluções completas',
    'titulo_complemento' => 'para você.',
    'texto'              => 'Conectividade, segurança e tecnologia trabalhando juntas para facilitar o seu dia a dia.',
    'bullets'            => ['Mais segurança para sua família e empresa', 'Conectividade estável e de alta performance', 'Suporte próximo e atendimento especializado'],
    'preco'              => '',
    'btn1_texto'         => 'Falar no WhatsApp',
    'btn2_texto'         => '0800 222 5262',
    'imagem'             => '',
];
try {
    require_once ROOT . '/config/database.php';
    $_s_bn = getDbConnection()->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'combo_banner' LIMIT 1");
    $_s_bn->execute(); $_r_bn = $_s_bn->fetch();
    if ($_r_bn && !empty($_r_bn['setting_value'])) {
        $_d_bn = json_decode($_r_bn['setting_value'], true);
        if (is_array($_d_bn)) {
            foreach (['titulo','titulo_destaque','titulo_complemento','texto','preco','btn1_texto','btn2_texto','imagem'] as $_k) {
                if (array_key_exists($_k, $_d_bn)) $_bn[$_k] = $_d_bn[$_k];
            }
            if (!empty($_d_bn['bullets']) && is_array($_d_bn['bullets'])) $_bn['bullets'] = $_d_bn['bullets'];
        }
    }
    unset($_s_bn, $_r_bn, $_d_bn, $_k);
} catch (Throwable $e) {}

$_cb = [
    'intro_titulo' => 'Escolha o combo ideal para voc&ecirc;',
    'intro_texto'  => 'Solu&ccedil;&otilde;es integradas que trabalham juntas para entregar mais seguran&ccedil;a, estabilidade e praticidade no seu dia a dia.',

    'res_titulo' => 'Combos Residenciais',
    'res_texto'  => 'Para sua casa funcionar de verdade.',
    'res_cards'  => [
        ['badge' => 'Mais vendido', 'titulo' => 'Internet + C&acirc;meras', 'texto' => 'Mais tranquilidade e controle da sua casa direto pelo celular.', 'imagem' => 'imgInternetMaisCamera.png', 'bullets' => ['Internet est&aacute;vel', 'C&acirc;meras de alta qualidade', 'Acesso remoto pelo app', 'Grava&ccedil;&atilde;o em nuvem opcional']],
        ['badge' => '', 'titulo' => 'Internet + Wi-Fi Mesh', 'texto' => 'Cobertura total e conex&atilde;o forte em todos os ambientes.', 'imagem' => 'imgInternetMaisWifiMEsh.png', 'bullets' => ['Internet de alta performance', 'Wi-Fi em todos os c&ocirc;modos', 'Sem pontos de sombra', 'Mais estabilidade para todos']],
    ],

    'biz_titulo' => 'Combos Empresariais',
    'biz_texto'  => 'Para sua empresa n&atilde;o parar.',
    'biz_cards'  => [
        ['titulo' => 'Internet + Wi-Fi Pro', 'texto' => 'Alta performance para equipes conectadas e produtivas.', 'imagem' => 'imgInternetMaisWifiPro.png', 'bullets' => ['Internet dedicada e est&aacute;vel', 'C&acirc;meras de acompanhamento', 'Mais desempenho para sua equipe', 'Ideal para m&uacute;ltiplos dispositivos']],
        ['titulo' => 'Internet + Telefonia', 'texto' => 'Atendimento profissional e economia para o seu neg&oacute;cio.', 'imagem' => 'imgInternetMaisTelefonia.png', 'bullets' => ['Internet de alta performance', 'Telefonia fixa com liga&ccedil;&otilde;es ilimitadas', 'Mais profissionalismo para sua empresa', 'Recursos avan&ccedil;ados']],
        ['titulo' => 'Internet + Link Dedicado', 'texto' => 'M&aacute;xima estabilidade para opera&ccedil;&otilde;es cr&iacute;ticas e sem interrup&ccedil;&otilde;es.', 'imagem' => 'imgInternetMaisLinkDireto.png', 'bullets' => ['Link dedicado 100% sim&eacute;trico', 'Alta disponibilidade', 'Ideal para sistemas e servidores', 'IP fixo incluso']],
    ],

    'conn_titulo' => 'Combos de Conectividade',
    'conn_texto'  => 'Conectado dentro e fora da sua casa ou empresa.',
    'conn_card'   => ['titulo' => 'Internet + Mobile', 'texto' => 'Sua conex&atilde;o vai com voc&ecirc; para onde for.', 'imagem' => 'imgInternetMaisMobile.png', 'bullets' => ['Internet fixa em casa ou empresa', 'Plano mobile com cobertura nacional', 'Mais dados e liberdade', 'Gest&atilde;o tudo em um s&oacute; lugar']],
    'custom_titulo' => 'Monte o combo ideal para voc&ecirc;!',
    'custom_texto'  => 'Fale com um consultor e descubra a melhor solu&ccedil;&atilde;o.',

    'trust_google' => '5.0 ★★★★★ + de 3.000 avalia&ccedil;&otilde;es no Google',
    'trust_items'  => ['+ de 3.000 clientes satisfeitos', 'Atendimento local de verdade', 'Suporte r&aacute;pido e especializado'],
];

try {
    require_once ROOT . '/config/database.php';
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'combo_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['intro_titulo', 'intro_texto', 'res_titulo', 'res_texto', 'biz_titulo', 'biz_texto',
                        'conn_titulo', 'conn_texto', 'custom_titulo', 'custom_texto', 'trust_google'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $_cb[$k] = $db[$k];
            }
            if (!empty($db['trust_items']) && is_array($db['trust_items'])) $_cb['trust_items'] = $db['trust_items'];
            foreach (['res_cards', 'biz_cards'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($_cb[$arr][$i]) || !is_array($item)) continue;
                        foreach (['badge', 'titulo', 'texto', 'imagem'] as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $_cb[$arr][$i][$k] = $item[$k];
                        }
                        if (!empty($item['bullets']) && is_array($item['bullets'])) $_cb[$arr][$i]['bullets'] = $item['bullets'];
                    }
                }
            }
            if (!empty($db['conn_card']) && is_array($db['conn_card'])) {
                foreach (['titulo', 'texto', 'imagem'] as $k) {
                    if (isset($db['conn_card'][$k]) && strlen((string) $db['conn_card'][$k])) $_cb['conn_card'][$k] = $db['conn_card'][$k];
                }
                if (!empty($db['conn_card']['bullets']) && is_array($db['conn_card']['bullets'])) $_cb['conn_card']['bullets'] = $db['conn_card']['bullets'];
            }
        }
    }
} catch (Throwable $e) {}

$_cbh = function ($value): string {
    return htmlspecialchars(html_entity_decode((string) $value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
};

$_cbResIconPairs = [
    ['icon-wifi', 'icon-casino-cctv'],
    ['icon-wifi', 'icon-wifimesh'],
];
$_cbBizIcons = ['icon-wifipro', 'icon-phone', 'icon-cloud'];
$_cbTrustIcons = ['icon-group', 'icon-pin', 'icon-security'];
?>

<section class="combo-page">
    <div class="combo-page__hero"<?= !empty($_bn['imagem']) ? ' style="--hero-image:url(\'' . BASE_URL . '/images/banners/combo/' . htmlspecialchars($_bn['imagem']) . '\')"' : '' ?>>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="combo-page__hero-copy">
                        <h1 class="combo-page__hero-title">
                            <?= htmlspecialchars($_bn['titulo']) ?>
                            <?php if (!empty($_bn['titulo_destaque'])): ?><strong><?= htmlspecialchars($_bn['titulo_destaque']) ?></strong><?php endif; ?>
                            <?php if (!empty($_bn['titulo_complemento'])): ?><?= htmlspecialchars($_bn['titulo_complemento']) ?><?php endif; ?>
                        </h1>
                        <p class="combo-page__hero-text"><?= htmlspecialchars($_bn['texto']) ?></p>

                        <?php if (!empty($_bn['bullets'])): ?>
                        <ul class="combo-page__hero-list">
                            <?php foreach ($_bn['bullets'] as $_b): ?>
                            <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($_b) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php if (!empty($_bn['preco'])): ?>
                        <p class="combo-page__hero-price"><?= htmlspecialchars($_bn['preco']) ?></p>
                        <?php endif; ?>

                        <div class="combo-page__hero-actions">
                            <a class="combo-page__button combo-page__button--whatsapp" href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn1_texto']) ?></a>
                            <a class="combo-page__button combo-page__button--outline" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn2_texto']) ?></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-6" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="combo-page__body">
        <section class="combo-page__intro">
            <div class="container">
                <h2><?= $_cbh($_cb['intro_titulo']) ?></h2>
                <p><?= $_cbh($_cb['intro_texto']) ?></p>
            </div>
        </section>

        <section class="combo-page__catalog">
            <div class="container">
                <div class="combo-page__catalog-box">
                    <section class="combo-page__group combo-page__group--residential">
                        <header class="combo-page__group-heading">
                            <i class="icon-home" aria-hidden="true"></i>
                            <div>
                                <h2><?= $_cbh($_cb['res_titulo']) ?></h2>
                                <p><?= $_cbh($_cb['res_texto']) ?></p>
                            </div>
                        </header>

                        <div class="combo-page__residential-grid">
                            <article class="combo-page__combo combo-page__combo--wide">
                                <figure>
                                    <?php if (!empty($_cb['res_cards'][0]['badge'])): ?><span><?= $_cbh($_cb['res_cards'][0]['badge']) ?></span><?php endif; ?>
                                    <img src="<?= BASE_URL ?>/images/combos/<?= htmlspecialchars($_cb['res_cards'][0]['imagem']) ?>" alt="<?= $_cbh($_cb['res_cards'][0]['titulo']) ?>">
                                </figure>
                                <div class="combo-page__combo-copy">
                                    <div class="combo-page__combo-icons"><i class="icon-wifi" aria-hidden="true"></i><b>+</b><i class="icon-casino-cctv" aria-hidden="true"></i></div>
                                    <h3><?= $_cbh($_cb['res_cards'][0]['titulo']) ?></h3>
                                    <p><?= $_cbh($_cb['res_cards'][0]['texto']) ?></p>
                                    <ul>
                                        <?php foreach ($_cb['res_cards'][0]['bullets'] as $bullet): ?><li><?= $_cbh($bullet) ?></li><?php endforeach; ?>
                                    </ul>
                                    <a href="<?= BASE_URL ?>/contato">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a>
                                </div>
                            </article>

                            <article class="combo-page__combo combo-page__combo--wide">
                                <figure>
                                    <img src="<?= BASE_URL ?>/images/combos/<?= htmlspecialchars($_cb['res_cards'][1]['imagem']) ?>" alt="<?= $_cbh($_cb['res_cards'][1]['titulo']) ?>">
                                </figure>
                                <div class="combo-page__combo-copy">
                                    <div class="combo-page__combo-icons"><i class="icon-wifi" aria-hidden="true"></i><b>+</b><i class="icon-wifimesh" aria-hidden="true"></i></div>
                                    <h3><?= $_cbh($_cb['res_cards'][1]['titulo']) ?></h3>
                                    <p><?= $_cbh($_cb['res_cards'][1]['texto']) ?></p>
                                    <ul>
                                        <?php foreach ($_cb['res_cards'][1]['bullets'] as $bullet): ?><li><?= $_cbh($bullet) ?></li><?php endforeach; ?>
                                    </ul>
                                    <a href="<?= BASE_URL ?>/contato">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a>
                                </div>
                            </article>
                        </div>
                    </section>

                    <section class="combo-page__group">
                        <header class="combo-page__group-heading">
                            <i class="icon-paraempresa" aria-hidden="true"></i>
                            <div>
                                <h2><?= $_cbh($_cb['biz_titulo']) ?></h2>
                                <p><?= $_cbh($_cb['biz_texto']) ?></p>
                            </div>
                        </header>

                        <div class="combo-page__business-grid">
                            <article class="combo-page__combo-card">
                                <img src="<?= BASE_URL ?>/images/combos/<?= htmlspecialchars($_cb['biz_cards'][0]['imagem']) ?>" alt="<?= $_cbh($_cb['biz_cards'][0]['titulo']) ?>">
                                <div>
                                    <h3><i class="icon-wifipro" aria-hidden="true"></i><?= $_cbh($_cb['biz_cards'][0]['titulo']) ?></h3>
                                    <p><?= $_cbh($_cb['biz_cards'][0]['texto']) ?></p>
                                    <ul>
                                        <?php foreach ($_cb['biz_cards'][0]['bullets'] as $bullet): ?><li><?= $_cbh($bullet) ?></li><?php endforeach; ?>
                                    </ul>
                                    <a href="<?= BASE_URL ?>/contato">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a>
                                </div>
                            </article>

                            <article class="combo-page__combo-card">
                                <img src="<?= BASE_URL ?>/images/combos/<?= htmlspecialchars($_cb['biz_cards'][1]['imagem']) ?>" alt="<?= $_cbh($_cb['biz_cards'][1]['titulo']) ?>">
                                <div>
                                    <h3><i class="icon-phone" aria-hidden="true"></i><?= $_cbh($_cb['biz_cards'][1]['titulo']) ?></h3>
                                    <p><?= $_cbh($_cb['biz_cards'][1]['texto']) ?></p>
                                    <ul>
                                        <?php foreach ($_cb['biz_cards'][1]['bullets'] as $bullet): ?><li><?= $_cbh($bullet) ?></li><?php endforeach; ?>
                                    </ul>
                                    <a href="<?= BASE_URL ?>/contato">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a>
                                </div>
                            </article>

                            <article class="combo-page__combo-card">
                                <img src="<?= BASE_URL ?>/images/combos/<?= htmlspecialchars($_cb['biz_cards'][2]['imagem']) ?>" alt="<?= $_cbh($_cb['biz_cards'][2]['titulo']) ?>">
                                <div>
                                    <h3><i class="icon-cloud" aria-hidden="true"></i><?= $_cbh($_cb['biz_cards'][2]['titulo']) ?></h3>
                                    <p><?= $_cbh($_cb['biz_cards'][2]['texto']) ?></p>
                                    <ul>
                                        <?php foreach ($_cb['biz_cards'][2]['bullets'] as $bullet): ?><li><?= $_cbh($bullet) ?></li><?php endforeach; ?>
                                    </ul>
                                    <a href="<?= BASE_URL ?>/contato">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a>
                                </div>
                            </article>
                        </div>
                    </section>

                    <section class="combo-page__group combo-page__group--connectivity">
                        <header class="combo-page__group-heading">
                            <i class="icon-phone" aria-hidden="true"></i>
                            <div>
                                <h2><?= $_cbh($_cb['conn_titulo']) ?></h2>
                                <p><?= $_cbh($_cb['conn_texto']) ?></p>
                            </div>
                        </header>

                        <div class="combo-page__connectivity-grid">
                            <article class="combo-page__combo combo-page__combo--connectivity">
                                <figure>
                                    <img src="<?= BASE_URL ?>/images/combos/<?= htmlspecialchars($_cb['conn_card']['imagem']) ?>" alt="<?= $_cbh($_cb['conn_card']['titulo']) ?>">
                                </figure>
                                <div class="combo-page__combo-copy">
                                    <div class="combo-page__combo-icons combo-page__combo-icons--stack"><i class="icon-wifi" aria-hidden="true"></i><b>+</b><i class="icon-mobile-phone" aria-hidden="true"></i></div>
                                    <h3><?= $_cbh($_cb['conn_card']['titulo']) ?></h3>
                                    <p><?= $_cbh($_cb['conn_card']['texto']) ?></p>
                                    <ul>
                                        <?php foreach ($_cb['conn_card']['bullets'] as $bullet): ?><li><?= $_cbh($bullet) ?></li><?php endforeach; ?>
                                    </ul>
                                    <a href="<?= BASE_URL ?>/contato">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a>
                                </div>
                            </article>

                            <aside class="combo-page__custom-card">
                                <h2><?= $_cbh($_cb['custom_titulo']) ?></h2>
                                <p><i class="icon-customersupport" aria-hidden="true"></i><?= $_cbh($_cb['custom_texto']) ?></p>
                            </aside>
                        </div>
                    </section>
                </div>
            </div>
        </section>

        <?php include ROOT . '/includes/trust-google/trust-google.php'; ?>

        <section class="combo-page__cta">
            <div class="container">
                <div class="combo-page__cta-box">
                    <div class="combo-page__cta-copy">
                        <h2>Quer montar a solução ideal para você?</h2>
                        <p>Fale com um consultor e tenha a combinação perfeita de serviços para sua casa ou empresa.</p>
                    </div>
                    <div class="combo-page__cta-actions">
                        <a class="combo-page__cta-button combo-page__cta-button--whatsapp" href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="combo-page__cta-button" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><span>Ligar gratuitamente <strong>0800 222 5262</strong></span></a>
                    </div>
                    <div class="combo-page__cta-notes">
                        <span><i class="icon-rocket" aria-hidden="true"></i>Atendimento rápido</span>
                        <span><i class="icon-checked" aria-hidden="true"></i>Sem compromisso</span>
                        <span><i class="icon-wifimesh" aria-hidden="true"></i>Solução personalizada</span>
                        <span><i class="icon-calendar" aria-hidden="true"></i>Instalação com qualidade</span>
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
echo '<script src="' . BASE_URL . '/pages/combo/combo.js?' . $version . '"></script>';
?>

</body>
</html>
