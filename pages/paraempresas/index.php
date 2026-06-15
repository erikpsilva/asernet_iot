<!DOCTYPE html>
<html>
<head>
<title>AserNet - Para Empresas</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<?php
// ── Banner (hero) ──────────────────────────────────────────────────────────
$_bn = [
    'titulo'             => 'Tecnologia para empresas que',
    'titulo_destaque'    => 'não podem parar.',
    'titulo_complemento' => '',
    'texto'              => 'Conectividade, comunicação, Wi-Fi corporativo e soluções inteligentes para sua operação funcionar melhor.',
    'bullets'            => ['Internet empresarial', 'Wi-Fi profissional', 'Telefonia corporativa', 'Link dedicado', 'Segurança e monitoramento'],
    'preco'              => '',
    'btn1_texto'         => 'Falar com um especialista',
    'btn2_texto'         => '0800 222 5262',
    'imagem'             => '',
];
try {
    require_once ROOT . '/config/database.php';
    $_s_bn = getDbConnection()->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'paraempresas_banner' LIMIT 1");
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

/* ---- defaults ---- */
$_pe = [
    'prob_titulo' => 'Sua empresa depende de tecnologia o tempo todo.',
    'prob_texto'  => 'Quando a estrutura não acompanha a operação, os problemas aparecem.',
    'prob_items'  => ['Internet instável', 'Wi-Fi congestionado', 'Atendimento falhando', 'Sistemas lentos', 'Impacto na produtividade'],

    'int_titulo'  => 'Soluções integradas para empresas modernas.',
    'int_texto'   => 'A AserNet conecta internet, Wi-Fi, telefonia e infraestrutura para entregar mais estabilidade e eficiência para sua operação.',
    'int_bullets' => ['Projetos personalizados', 'Estrutura escalável', 'Atendimento especializado', 'Suporte local'],

    'sol_titulo' => 'Soluções empresariais',
    'sol_cards'  => [
        ['titulo' => 'Internet PME',              'texto' => 'Internet estável para empresas que precisam de produtividade.',                'imagem' => 'imgInternetPME.png'],
        ['titulo' => 'Wi-Fi Profissional',         'texto' => 'Rede preparada para múltiplos dispositivos e ambientes corporativos.',       'imagem' => 'imgWifiProfissional.png'],
        ['titulo' => 'Telefonia Empresarial',      'texto' => 'Mais comunicação e profissionalismo para seu atendimento.',                  'imagem' => 'imgTelefoniaEmpresarial.png'],
        ['titulo' => 'Link Dedicado',              'texto' => 'Conexão exclusiva para operações críticas.',                                 'imagem' => 'imgLinkDedicado.png'],
        ['titulo' => 'Segurança e Monitoramento',  'texto' => 'Mais controle para sua empresa.',                                           'imagem' => 'imgSegurancaMonitoramento.png'],
    ],

    'why_titulo' => 'Por que escolher a AserNet?',
    'why_items'  => [
        ['titulo' => 'Atendimento próximo',    'texto' => 'Equipe local preparada para atender sua empresa com agilidade.'],
        ['titulo' => 'Projetos sob medida',    'texto' => 'Soluções adaptadas à necessidade da sua operação.'],
        ['titulo' => 'Estrutura profissional', 'texto' => 'Mais estabilidade, desempenho e segurança para sua empresa.'],
        ['titulo' => 'Ecossistema integrado',  'texto' => 'Internet, comunicação e segurança trabalhando juntos.'],
    ],

    'aud_titulo' => 'Para quem é indicado',
    'aud_items'  => ['Escritórios', 'Hotéis e pousadas', 'Clínicas', 'Comércios', 'Escolas', 'Empresas com múltiplos usuários', 'Restaurantes'],

    'tech_titulo' => 'Tecnologia integrada para sua empresa crescer.',
    'tech_texto'  => 'Tudo conectado dentro da mesma estrutura, com gestão inteligente e suporte especializado.',

    'ben_titulo' => 'Benefícios para sua empresa',
    'ben_items'  => [
        ['titulo' => 'Mais estabilidade',    'texto' => 'Menos quedas e mais continuidade para sua operação.'],
        ['titulo' => 'Mais produtividade',   'texto' => 'Melhor desempenho da equipe e dos sistemas.'],
        ['titulo' => 'Mais profissionalismo','texto' => 'Estrutura preparada para dar mais credibilidade à sua empresa.'],
        ['titulo' => 'Mais controle',        'texto' => 'Monitoramento e gestão facilitados para tomar melhores decisões.'],
    ],

    'trust_google' => '5.0 ★★★★★ + de 3.000 avaliações no Google',
    'trust_items'  => ['Atendimento local de verdade', 'Suporte especializado', 'Instalação profissional', 'Acompanhamento contínuo'],
];

try {
    require_once ROOT . '/config/database.php';
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'paraempresas_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['prob_titulo', 'prob_texto', 'int_titulo', 'int_texto',
                        'sol_titulo', 'why_titulo', 'aud_titulo', 'tech_titulo', 'tech_texto',
                        'ben_titulo', 'trust_google'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $_pe[$k] = $db[$k];
            }
            foreach (['prob_items', 'int_bullets', 'aud_items', 'trust_items'] as $k) {
                if (!empty($db[$k]) && is_array($db[$k])) $_pe[$k] = $db[$k];
            }
            foreach (['sol_cards', 'why_items', 'ben_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($_pe[$arr][$i]) || !is_array($item)) continue;
                        foreach (array_keys($_pe[$arr][$i]) as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $_pe[$arr][$i][$k] = $item[$k];
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

$_solIcons  = ['icon-paraempresa', 'icon-wifipro', 'icon-phone', 'icon-link', 'icon-security'];
$_solLinks  = ['/internetpme', '/wifiprofissional', '/telefoniaempresarial', '/linkdedicado', '/cameradeseguranca'];
$_audIcons  = ['icon-paraempresa', 'icon-hotels', 'icon-clinic', 'icon-home', 'icon-school', 'icon-empresapessoas', 'icon-restaurant'];
$_whyIcons  = ['icon-group', 'icon-puzzle', 'icon-infrastructure', 'icon-diagram'];
$_benIcons  = ['icon-rocket', 'icon-group', 'icon-star', 'icon-dashboard'];
$_trustIcons = ['icon-group', 'icon-customersupport', 'icon-install', 'icon-acompanhamento'];
$_probIcons  = ['icon-wifierror', 'icon-wifinot', 'icon-phoneerror', 'icon-slow', 'icon-bars'];
?>

<section class="business-page">
    <div class="business-page__hero"<?= !empty($_bn['imagem']) ? ' style="--hero-image:url(\'' . BASE_URL . '/images/banners/paraempresas/' . htmlspecialchars($_bn['imagem']) . '\')"' : '' ?>>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="business-page__hero-copy">
                        <h1 class="business-page__hero-title">
                            <?= htmlspecialchars($_bn['titulo']) ?>
                            <?php if (!empty($_bn['titulo_destaque'])): ?><strong><?= htmlspecialchars($_bn['titulo_destaque']) ?></strong><?php endif; ?>
                            <?php if (!empty($_bn['titulo_complemento'])): ?><?= htmlspecialchars($_bn['titulo_complemento']) ?><?php endif; ?>
                        </h1>
                        <p class="business-page__hero-text"><?= htmlspecialchars($_bn['texto']) ?></p>

                        <?php if (!empty($_bn['bullets'])): ?>
                        <ul class="business-page__hero-list">
                            <?php foreach ($_bn['bullets'] as $_b): ?>
                            <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($_b) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php if (!empty($_bn['preco'])): ?>
                        <p class="business-page__hero-price"><?= htmlspecialchars($_bn['preco']) ?></p>
                        <?php endif; ?>

                        <div class="business-page__hero-actions">
                            <a class="business-page__button business-page__button--primary" href="<?= BASE_URL ?>/contato"><i class="icon-talk" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn1_texto']) ?></a>
                            <a class="business-page__button business-page__button--outline" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn2_texto']) ?></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-6" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="business-page__body">
        <section class="business-page__problems">
            <div class="container">
                <div class="business-page__problems-grid">
                    <div class="business-page__problems-copy">
                        <h2><?= htmlspecialchars($_pe['prob_titulo']) ?></h2>
                        <p><?= htmlspecialchars($_pe['prob_texto']) ?></p>
                    </div>
                    <?php foreach ($_pe['prob_items'] as $i => $item): ?>
                    <article><i class="<?= $_probIcons[$i] ?? 'icon-wifierror' ?>" aria-hidden="true"></i><span><?= htmlspecialchars($item) ?></span></article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="business-page__integrated">
            <div class="container">
                <div class="business-page__integrated-box">
                    <i class="icon-paraempresa" aria-hidden="true"></i>
                    <h2><?= htmlspecialchars($_pe['int_titulo']) ?></h2>
                    <p><?= htmlspecialchars($_pe['int_texto']) ?></p>
                    <ul>
                        <?php foreach ($_pe['int_bullets'] as $bullet): ?>
                        <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($bullet) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

        <section class="business-page__solutions">
            <div class="container">
                <h2 class="business-page__center-title"><?= htmlspecialchars($_pe['sol_titulo']) ?></h2>
                <div class="business-page__solutions-grid">
                    <?php foreach ($_pe['sol_cards'] as $i => $card): ?>
                    <article class="business-page__solution-card">
                        <div><i class="<?= $_solIcons[$i] ?? 'icon-paraempresa' ?>" aria-hidden="true"></i><h3><?= htmlspecialchars($card['titulo']) ?></h3></div>
                        <p><?= htmlspecialchars($card['texto']) ?></p>
                        <img src="<?= BASE_URL ?>/images/paraempresas/<?= htmlspecialchars($card['imagem']) ?>" alt="<?= htmlspecialchars($card['titulo']) ?>">
                        <a href="<?= BASE_URL ?><?= $_solLinks[$i] ?? '/contato' ?>">Ver solução <i class="icon-arrowright" aria-hidden="true"></i></a>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="business-page__why">
            <div class="container">
                <h2 class="business-page__center-title"><?= htmlspecialchars($_pe['why_titulo']) ?></h2>
                <div class="business-page__why-grid">
                    <?php foreach ($_pe['why_items'] as $i => $item): ?>
                    <article>
                        <i class="<?= $_whyIcons[$i] ?? 'icon-group' ?>" aria-hidden="true"></i>
                        <h3><?= htmlspecialchars($item['titulo']) ?></h3>
                        <p><?= htmlspecialchars($item['texto']) ?></p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="business-page__audience-tech">
            <div class="container">
                <div class="business-page__audience-tech-grid">
                    <div class="business-page__audience">
                        <h2><?= htmlspecialchars($_pe['aud_titulo']) ?></h2>
                        <ul>
                            <?php foreach ($_pe['aud_items'] as $i => $item): ?>
                            <li><i class="<?= $_audIcons[$i] ?? 'icon-paraempresa' ?>" aria-hidden="true"></i><?= htmlspecialchars($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="business-page__tech">
                        <h2><?= htmlspecialchars($_pe['tech_titulo']) ?></h2>
                        <div class="business-page__tech-flow">
                            <span><i class="icon-globe" aria-hidden="true"></i>Internet</span>
                            <i class="icon-arrowright" aria-hidden="true"></i>
                            <span><i class="icon-wifi" aria-hidden="true"></i>Wi-Fi Pro</span>
                            <i class="icon-arrowright" aria-hidden="true"></i>
                            <span><i class="icon-phone" aria-hidden="true"></i>Telefonia</span>
                            <i class="icon-arrowright" aria-hidden="true"></i>
                            <span><i class="icon-link" aria-hidden="true"></i>Link dedicado</span>
                            <i class="icon-arrowright" aria-hidden="true"></i>
                            <span><i class="icon-security" aria-hidden="true"></i>Segurança</span>
                        </div>
                        <p><?= htmlspecialchars($_pe['tech_texto']) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="business-page__benefits">
            <div class="container">
                <h2 class="business-page__center-title"><?= htmlspecialchars($_pe['ben_titulo']) ?></h2>
                <div class="business-page__benefits-grid">
                    <?php foreach ($_pe['ben_items'] as $i => $item): ?>
                    <article>
                        <i class="<?= $_benIcons[$i] ?? 'icon-rocket' ?>" aria-hidden="true"></i>
                        <h3><?= htmlspecialchars($item['titulo']) ?></h3>
                        <p><?= htmlspecialchars($item['texto']) ?></p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <?php include ROOT . '/includes/trust-google/trust-google.php'; ?>

        <section class="business-page__cta">
            <div class="container">
                <div class="business-page__cta-box">
                    <div>
                        <h2>Sua empresa merece uma estrutura preparada para crescer.</h2>
                        <p>Fale com um especialista e descubra a melhor solução para o seu negócio.</p>
                    </div>
                    <div class="business-page__cta-actions">
                        <a class="business-page__cta-button business-page__cta-button--whatsapp" href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="business-page__cta-button" href="<?= BASE_URL ?>/contato"><i class="icon-calendar" aria-hidden="true"></i><span>Solicitar análise técnica</span></a>
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
echo '<script src="' . BASE_URL . '/pages/paraempresas/paraempresas.js?' . $version . '"></script>';
?>

</body>
</html>
