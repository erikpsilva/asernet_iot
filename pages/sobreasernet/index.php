<!DOCTYPE html>
<html>
<head>
<title>AserNet - Sobre a AserNet</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<?php
// ── Banner (hero) ──────────────────────────────────────────────────────────
$_bn = [
    'titulo'             => 'Mais que internet. Conexões',
    'titulo_destaque'    => 'que cuidam.',
    'titulo_complemento' => '',
    'texto'              => 'A AserNet nasceu para conectar pessoas, empresas e histórias com tecnologia, proximidade e atendimento de verdade.',
    'bullets'            => ['Atendimento local', 'Equipe especializada', 'Estrutura profissional', 'Tecnologia para casa e empresa'],
    'preco'              => '',
    'btn1_texto'         => 'Falar com a AserNet',
    'btn2_texto'         => '0800 222 5262',
    'imagem'             => '',
];
try {
    require_once ROOT . '/config/database.php';
    $_s_bn = getDbConnection()->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'sobreasernet_banner' LIMIT 1");
    $_s_bn->execute(); $_r_bn = $_s_bn->fetch();
    if ($_r_bn && !empty($_r_bn['setting_value'])) {
        $_d_bn = json_decode($_r_bn['setting_value'], true);
        if (is_array($_d_bn)) {
            foreach (['titulo','titulo_destaque','titulo_complemento','texto','preco','btn1_texto','btn2_texto','imagem'] as $_k) {
                if (isset($_d_bn[$_k]) && strlen((string)$_d_bn[$_k]) > 0) $_bn[$_k] = $_d_bn[$_k];
            }
            if (!empty($_d_bn['bullets']) && is_array($_d_bn['bullets'])) $_bn['bullets'] = $_d_bn['bullets'];
        }
    }
    unset($_s_bn, $_r_bn, $_d_bn, $_k);
} catch (Throwable $e) {}

$_sa = [
    'history_label' => 'Nossa hist&oacute;ria',
    'history_titulo' => 'Crescendo junto com a nossa regi&atilde;o.',
    'history_textos' => [
        'A AserNet evoluiu com um prop&oacute;sito simples: entregar uma conex&atilde;o est&aacute;vel, humana e preparada para acompanhar a rotina das pessoas e empresas.',
        'Hoje, al&eacute;m da internet, oferecemos solu&ccedil;&otilde;es completas em conectividade, seguran&ccedil;a, mobilidade e tecnologia.',
    ],
    'history_imagem' => 'imgCrescendoJuntoComNossaRegiao.png',
    'belief_label' => 'O que acreditamos',
    'belief_titulo' => 'Tecnologia precisa facilitar a vida.',
    'belief_texto' => 'Por isso buscamos unir:',
    'belief_cards' => [
        ['titulo' => 'Estabilidade', 'texto' => 'Conex&otilde;es que n&atilde;o te deixam na m&atilde;o.'],
        ['titulo' => 'Atendimento pr&oacute;ximo', 'texto' => 'Estamos perto para resolver de verdade.'],
        ['titulo' => 'Solu&ccedil;&otilde;es inteligentes', 'texto' => 'Tecnologia que se adapta &agrave; sua necessidade.'],
        ['titulo' => 'Suporte humanizado', 'texto' => 'Pessoas que entendem e que se importam.'],
    ],
    'solutions_label' => 'O que fazemos',
    'solutions_titulo' => 'Solu&ccedil;&otilde;es completas para sua casa e empresa.',
    'solutions_cards' => [
        ['titulo' => 'Internet residencial', 'texto' => 'Conectividade preparada para o dia a dia da fam&iacute;lia.', 'imagem' => 'imgInternetResidencial.png'],
        ['titulo' => 'Solu&ccedil;&otilde;es empresariais', 'texto' => 'Estrutura profissional para empresas crescerem.', 'imagem' => 'imgSolucoesEmpresariais.png'],
        ['titulo' => 'Seguran&ccedil;a e monitoramento', 'texto' => 'Mais tranquilidade para sua rotina.', 'imagem' => 'imgSegurancaMonitoramento.png'],
        ['titulo' => 'Mobilidade e conectividade', 'texto' => 'Internet dentro e fora de casa.', 'imagem' => 'imgMobilidadeConectividade.png'],
    ],
    'trust_google' => '5.0 no Google + de 3.000 avalia&ccedil;&otilde;es',
    'trust_items' => ['Milhares de clientes conectados', 'Atendimento pr&oacute;ximo', 'Confian&ccedil;a constru&iacute;da diariamente'],
    'diff_label' => 'Nosso diferencial',
    'diff_titulo' => 'O que faz a AserNet ser diferente?',
    'diff_cards' => [
        ['titulo' => 'Atendimento de verdade', 'texto' => 'Pessoas preparadas para ajudar voc&ecirc;.'],
        ['titulo' => 'Estrutura profissional', 'texto' => 'Tecnologia preparada para crescer junto com sua necessidade.'],
        ['titulo' => 'Solu&ccedil;&otilde;es integradas', 'texto' => 'Internet, Wi-Fi, telefonia, seguran&ccedil;a e mobilidade conectados.'],
        ['titulo' => 'Presen&ccedil;a local', 'texto' => 'Estamos pr&oacute;ximos dos nossos clientes e da nossa comunidade.'],
    ],
    'team_label' => 'Nosso time e estrutura',
    'team_titulo' => 'Pessoas que conectam. Estrutura que entrega.',
    'team_images' => ['imgpessoasConectam01.png', 'imgpessoasConectam02.png', 'imgpessoasConectam03.png.png', 'imgpessoasConectam04.png.png', 'imgAquiVoceNaoContrataSoInternet.png'],
    'purpose_label' => 'Nosso prop&oacute;sito',
    'purpose_titulo' => 'Conectar bem &eacute; cuidar.',
    'purpose_texto' => 'Acreditamos que tecnologia tamb&eacute;m &eacute; presen&ccedil;a, suporte e confian&ccedil;a. &Eacute; estar junto sempre que voc&ecirc; precisar.',
    'purpose_items' => ['Conex&atilde;o', 'Confian&ccedil;a', 'Presen&ccedil;a', 'Cuidado'],
];

try {
    require_once ROOT . '/config/database.php';
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'sobreasernet_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['history_label', 'history_titulo', 'history_imagem', 'belief_label', 'belief_titulo', 'belief_texto',
                        'solutions_label', 'solutions_titulo', 'trust_google', 'diff_label', 'diff_titulo',
                        'team_label', 'team_titulo', 'purpose_label', 'purpose_titulo', 'purpose_texto'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $_sa[$k] = $db[$k];
            }
            foreach (['history_textos', 'trust_items', 'team_images', 'purpose_items'] as $k) {
                if (!empty($db[$k]) && is_array($db[$k])) $_sa[$k] = $db[$k];
            }
            foreach (['belief_cards', 'solutions_cards', 'diff_cards'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($_sa[$arr][$i]) || !is_array($item)) continue;
                        foreach (array_keys($_sa[$arr][$i]) as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $_sa[$arr][$i][$k] = $item[$k];
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

$_sah = function ($value): string {
    return htmlspecialchars(html_entity_decode((string) $value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
};

$_saBeliefIcons = ['icon-wifi', 'icon-group', 'icon-gear', 'icon-heart'];
$_saSolutionIcons = ['icon-wifi', 'icon-office', 'icon-security', 'icon-mobile-phone'];
$_saSolutionLinks = ['/residencial', '/paraempresas', '/cameradeseguranca', '/planomovel'];
$_saTrustIcons = ['icon-group', 'icon-talk', 'icon-security'];
$_saDiffIcons = ['icon-customersupport', 'icon-dashboard', 'icon-link', 'icon-pin'];
$_saPurposeIcons = ['icon-wifi', 'icon-gear', 'icon-pin', 'icon-heart'];
?>

<section class="about-page">
    <div class="about-page__hero"<?= !empty($_bn['imagem']) ? ' style="background-image:url(\'' . BASE_URL . '/images/banners/sobreasernet/' . htmlspecialchars($_bn['imagem']) . '\')"' : '' ?>>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="about-page__hero-copy">
                        <h1 class="about-page__hero-title">
                            <?= htmlspecialchars($_bn['titulo']) ?>
                            <?php if (!empty($_bn['titulo_destaque'])): ?><strong><?= htmlspecialchars($_bn['titulo_destaque']) ?></strong><?php endif; ?>
                            <?php if (!empty($_bn['titulo_complemento'])): ?><?= htmlspecialchars($_bn['titulo_complemento']) ?><?php endif; ?>
                        </h1>
                        <p class="about-page__hero-text"><?= htmlspecialchars($_bn['texto']) ?></p>

                        <?php if (!empty($_bn['bullets'])): ?>
                        <ul class="about-page__hero-list">
                            <?php foreach ($_bn['bullets'] as $_b): ?>
                            <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($_b) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php if (!empty($_bn['preco'])): ?>
                        <p class="about-page__hero-price"><?= htmlspecialchars($_bn['preco']) ?></p>
                        <?php endif; ?>

                        <div class="about-page__hero-actions">
                            <a class="about-page__button about-page__button--primary" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn1_texto']) ?></a>
                            <a class="about-page__button about-page__button--outline" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn2_texto']) ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="about-page__body">
        <section class="about-page__history">
            <div class="container">
                <div class="about-page__history-grid">
                    <div>
                        <span><?= $_sah($_sa['history_label']) ?></span>
                        <h2><?= $_sah($_sa['history_titulo']) ?></h2>
                        <?php foreach ($_sa['history_textos'] as $texto): ?><p><?= $_sah($texto) ?></p><?php endforeach; ?>
                    </div>
                    <img src="<?= BASE_URL ?>/images/sobre/<?= htmlspecialchars($_sa['history_imagem']) ?>" alt="Fachada da AserNet">
                </div>
            </div>
        </section>

        <section class="about-page__belief">
            <div class="container">
                <div class="about-page__belief-box">
                    <div>
                        <span><?= $_sah($_sa['belief_label']) ?></span>
                        <h2><?= $_sah($_sa['belief_titulo']) ?></h2>
                        <p><?= $_sah($_sa['belief_texto']) ?></p>
                    </div>
                    <?php foreach ($_sa['belief_cards'] as $i => $card): ?>
                    <article><i class="<?= $_saBeliefIcons[$i] ?? 'icon-wifi' ?>" aria-hidden="true"></i><h3><?= $_sah($card['titulo']) ?></h3><p><?= $_sah($card['texto']) ?></p></article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="about-page__solutions">
            <div class="container">
                <header class="about-page__section-header">
                    <span><?= $_sah($_sa['solutions_label']) ?></span>
                    <h2><?= $_sah($_sa['solutions_titulo']) ?></h2>
                </header>

                <div class="about-page__solutions-grid">
                    <?php foreach ($_sa['solutions_cards'] as $i => $card): ?>
                    <article><img src="<?= BASE_URL ?>/images/sobre/<?= htmlspecialchars($card['imagem']) ?>" alt="<?= $_sah($card['titulo']) ?>"><i class="<?= $_saSolutionIcons[$i] ?? 'icon-wifi' ?>" aria-hidden="true"></i><h3><?= $_sah($card['titulo']) ?></h3><p><?= $_sah($card['texto']) ?></p><a href="<?= BASE_URL ?><?= $_saSolutionLinks[$i] ?? '/paraempresas' ?>">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a></article>
                    <?php endforeach; ?>
                </div>

                <a class="about-page__mobile-more" href="<?= BASE_URL ?>/paraempresas">Ver todas as solu&ccedil;&otilde;es <i class="icon-arrowright" aria-hidden="true"></i></a>
            </div>
        </section>

        <section class="about-page__trust">
            <div class="container">
                <div class="about-page__trust-grid">
                    <div class="about-page__google"><img src="<?= BASE_URL ?>/images/logoGoogle.png" alt="Google"><p><?= $_sah($_sa['trust_google']) ?></p></div>
                    <?php foreach ($_sa['trust_items'] as $i => $item): ?>
                    <article><i class="<?= $_saTrustIcons[$i] ?? 'icon-group' ?>" aria-hidden="true"></i><?= $_sah($item) ?></article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="about-page__difference">
            <div class="container">
                <header class="about-page__section-header">
                    <span><?= $_sah($_sa['diff_label']) ?></span>
                    <h2><?= $_sah($_sa['diff_titulo']) ?></h2>
                </header>

                <div class="about-page__difference-grid">
                    <?php foreach ($_sa['diff_cards'] as $i => $card): ?>
                    <article><i class="<?= $_saDiffIcons[$i] ?? 'icon-customersupport' ?>" aria-hidden="true"></i><h3><?= $_sah($card['titulo']) ?></h3><p><?= $_sah($card['texto']) ?></p></article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="about-page__team">
            <div class="container">
                <header class="about-page__section-header">
                    <span><?= $_sah($_sa['team_label']) ?></span>
                    <h2><?= $_sah($_sa['team_titulo']) ?></h2>
                </header>

                <div class="about-page__team-grid">
                    <?php foreach ($_sa['team_images'] as $i => $image): ?>
                    <img src="<?= BASE_URL ?>/images/sobre/<?= htmlspecialchars($image) ?>" alt="AserNet imagem <?= $i + 1 ?>">
                    <?php endforeach; ?>
                </div>

                <a class="about-page__mobile-photos" href="<?= BASE_URL ?>/contato">Ver mais fotos</a>
            </div>
        </section>

        <section class="about-page__purpose">
            <div class="container">
                <div class="about-page__purpose-box">
                    <div>
                        <span><?= $_sah($_sa['purpose_label']) ?></span>
                        <h2><?= $_sah($_sa['purpose_titulo']) ?></h2>
                        <p><?= $_sah($_sa['purpose_texto']) ?></p>
                    </div>
                    <?php foreach ($_sa['purpose_items'] as $i => $item): ?>
                    <article><i class="<?= $_saPurposeIcons[$i] ?? 'icon-heart' ?>" aria-hidden="true"></i><?= $_sah($item) ?></article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="about-page__cta">
            <div class="container">
                <div class="about-page__cta-box">
                    <div>
                        <h2>Quer conhecer a AserNet de perto?</h2>
                    </div>
                    <div class="about-page__cta-actions">
                        <a class="about-page__cta-button about-page__cta-button--whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="about-page__cta-button" href="<?= BASE_URL ?>/paraempresas">Conhecer solu&ccedil;&otilde;es <i class="icon-arrowright" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-page__footer">
            <div class="container">
                <div class="about-page__footer-grid">
                    <div><img src="<?= BASE_URL ?>/images/logo-transparent.png" alt="AserNet"><p>Mais que internet. Conex&otilde;es que cuidam da sua casa e da sua empresa.</p></div>
                    <nav><h2>Solu&ccedil;&otilde;es</h2><a href="<?= BASE_URL ?>/residencial">Internet Residencial</a><a href="<?= BASE_URL ?>/paraempresas">Empresas (PME)</a><a href="<?= BASE_URL ?>/wifiprofissional">Wi-Fi Profissional</a><a href="<?= BASE_URL ?>/telefoniaempresarial">Telefonia Empresarial</a><a href="<?= BASE_URL ?>/cameradeseguranca">Seguran&ccedil;a</a><a href="<?= BASE_URL ?>/rastreamentoveicular">Rastreamento Veicular</a></nav>
                    <nav><h2>Institucional</h2><a href="<?= BASE_URL ?>/sobreasernet">Sobre a AserNet</a><a href="<?= BASE_URL ?>/contato">Trabalhe Conosco</a><a href="<?= BASE_URL ?>/politica-de-privacidade">Pol&iacute;tica de Privacidade</a><a href="<?= BASE_URL ?>/termos-de-uso">Termos de Uso</a></nav>
                    <nav><h2>Suporte</h2><a href="<?= BASE_URL ?>/contato">Central do Cliente</a><a href="<?= BASE_URL ?>/contato">Abrir Chamado</a><a href="<?= BASE_URL ?>/faq">Perguntas Frequentes</a></nav>
                    <address><h2>Atendimento</h2><a href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i>0800 222 5262</a><a href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i>0800 222 5262</a><a href="mailto:atendimento@asernet.com.br"><i class="icon-talk" aria-hidden="true"></i>atendimento@asernet.com.br</a></address>
                </div>
            </div>
        </section>
    </div>
</section>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/sobreasernet/sobreasernet.js?' . $version . '"></script>';
?>

</body>
</html>
