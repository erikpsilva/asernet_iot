<!DOCTYPE html>
<html>
<head>
<title>AserNet - Wi-Fi Mesh</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<?php
// ── Banner (hero) ──────────────────────────────────────────────────────────
$_bn = [
    'titulo'             => 'Wi-Fi forte em toda a casa,',
    'titulo_destaque'    => 'sem complicação.',
    'titulo_complemento' => '',
    'texto'              => 'Chega de sinal fraco, travamentos e ambientes sem conexão.',
    'bullets'            => ['Cobertura inteligente', 'Conexão contínua entre ambientes', 'Mais estabilidade para toda a família', 'Instalação e configuração inclusas'],
    'preco'              => 'A partir de R$ 139,90/mês',
    'btn1_texto'         => 'Quero Wi-Fi em toda a casa',
    'btn2_texto'         => '0800 222 5262',
    'imagem'             => '',
];
try {
    require_once ROOT . '/config/database.php';
    $_s_bn = getDbConnection()->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'wifimesh_banner' LIMIT 1");
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
$_wm = [
    'dor_titulo'  => 'Sua internet pode ser rápida...',
    'dor_titulo2' => 'mas o Wi-Fi não chega em todos os ambientes.',
    'dor_items'   => ['Sinal fraco no quarto', 'Vídeos travando', 'Quedas em chamadas', 'Travamentos na TV', 'Pontos sem cobertura'],

    'tech_titulo'  => 'Tecnologia Mesh: uma única rede inteligente para toda a casa.',
    'tech_texto'   => 'Os equipamentos trabalham juntos para distribuir o sinal de forma inteligente, mantendo você conectado em qualquer ambiente.',
    'tech_bullets' => ['Cobertura ampliada', 'Troca automática de ponto sem desconectar', 'Mais estabilidade', 'Melhor experiência para múltiplos dispositivos'],
    'tech_imagem'  => 'imgTecnologiaMesh.png',

    'como_titulo' => 'Como funciona',
    'como_texto'  => 'Simples e eficiente',
    'como_steps'  => ['Fazemos a análise da sua casa', 'Instalamos os equipamentos', 'Configuramos a rede Mesh', 'Você aproveita cobertura total'],

    'porque_titulo' => 'Por que escolher o Wi-Fi Mesh da AserNet?',
    'porque_items'  => [
        ['titulo' => 'Cobertura inteligente',     'texto' => 'Mais alcance e estabilidade para todos os ambientes.'],
        ['titulo' => 'Uma única rede',            'texto' => 'Seu celular troca automaticamente entre os pontos, sem você perceber.'],
        ['titulo' => 'Melhor para casas maiores', 'texto' => 'Mais desempenho em diversos andares e ambientes.'],
        ['titulo' => 'Suporte AserNet',           'texto' => 'Instalação e configuração inclusas com suporte especializado.'],
    ],

    'ideal_titulo' => 'Ideal para quem usa muitos dispositivos',
    'ideal_items'  => ['Smart TVs', 'Streaming', 'Home Office', 'Videogames', 'Casas grandes', 'Múltiplos dispositivos'],

    'perf_titulo'  => 'Equipamentos de alta performance',
    'perf_texto'   => 'Tecnologia mesh com antenas para mais alcance, estabilidade e conexão de verdade.',
    'perf_imagem'  => 'imgEquipamentoDeAltaPerformance.png',
    'perf_bullets' => ['Cobertura ampliada', 'Rede contínua em toda a casa', 'Mais estabilidade para sua conexão', 'Mais dispositivos conectados'],
];

try {
    require_once ROOT . '/config/database.php';
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'wifimesh_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['dor_titulo', 'dor_titulo2', 'tech_titulo', 'tech_texto', 'tech_imagem',
                        'como_titulo', 'como_texto', 'porque_titulo', 'ideal_titulo',
                        'perf_titulo', 'perf_texto', 'perf_imagem'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $_wm[$k] = $db[$k];
            }
            foreach (['dor_items', 'tech_bullets', 'como_steps', 'ideal_items', 'perf_bullets'] as $k) {
                if (!empty($db[$k]) && is_array($db[$k])) $_wm[$k] = $db[$k];
            }
            if (!empty($db['porque_items']) && is_array($db['porque_items'])) {
                foreach ($db['porque_items'] as $i => $item) {
                    if (isset($_wm['porque_items'][$i]) && is_array($item)) {
                        foreach (['titulo', 'texto'] as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $_wm['porque_items'][$i][$k] = $item[$k];
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

$_dorIcons   = ['icon-wifiruim', 'icon-loading', 'icon-wifiphone', 'icon-tv', 'icon-wifinot'];
$_comoIcons  = ['icon-home', 'icon-wifiestavel', 'icon-wifimesh', 'icon-wificobertura'];
$_porqueIcons= ['icon-wificobertura', 'icon-wifimesh', 'icon-bighouse', 'icon-customersupport'];
$_idealIcons = ['icon-tv', 'icon-streaming', 'icon-homeoffice', 'icon-videogame', 'icon-bighouse', 'icon-devices'];
$_perfIcons  = ['icon-wificobertura', 'icon-wifi', 'icon-wifiestavel', 'icon-devices'];
?>

<section class="wifi-mesh">
    <div class="wifi-mesh__hero"<?= !empty($_bn['imagem']) ? ' style="--hero-image:url(\'' . BASE_URL . '/images/banners/wifimesh/' . htmlspecialchars($_bn['imagem']) . '\')"' : '' ?>>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="wifi-mesh__hero-copy">
                        <h1 class="wifi-mesh__hero-title">
                            <?= htmlspecialchars($_bn['titulo']) ?>
                            <?php if (!empty($_bn['titulo_destaque'])): ?><strong><?= htmlspecialchars($_bn['titulo_destaque']) ?></strong><?php endif; ?>
                            <?php if (!empty($_bn['titulo_complemento'])): ?><?= htmlspecialchars($_bn['titulo_complemento']) ?><?php endif; ?>
                        </h1>
                        <p class="wifi-mesh__hero-text"><?= htmlspecialchars($_bn['texto']) ?></p>

                        <?php if (!empty($_bn['bullets'])): ?>
                        <ul class="wifi-mesh__hero-list">
                            <?php foreach ($_bn['bullets'] as $_b): ?>
                            <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($_b) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php if (!empty($_bn['preco'])): ?>
                        <p class="wifi-mesh__hero-price"><?= htmlspecialchars($_bn['preco']) ?></p>
                        <?php endif; ?>

                        <div class="wifi-mesh__hero-actions">
                            <a class="wifi-mesh__button wifi-mesh__button--primary" href="<?= BASE_URL ?>/carrinho" data-cart-add data-cart-id="wifi-mesh-kit" data-cart-group="wifi-mesh" data-cart-title="Wi-Fi Mesh" data-cart-subtitle="Cobertura inteligente residencial" data-cart-price="A partir de R$ 139,90/m&ecirc;s" data-cart-icon="icon-wifimesh" data-cart-url="<?= BASE_URL ?>/wifimesh"><i class="icon-wifi" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn1_texto']) ?></a>
                            <a class="wifi-mesh__button wifi-mesh__button--outline" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn2_texto']) ?></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-6" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="wifi-mesh__body">
        <section class="wifi-mesh__pain wifi-mesh__desktop-only">
            <div class="container">
                <h2><?= htmlspecialchars($_wm['dor_titulo']) ?><br><?= htmlspecialchars($_wm['dor_titulo2']) ?></h2>
                <div class="wifi-mesh__pain-grid">
                    <?php foreach ($_wm['dor_items'] as $i => $item): ?>
                    <article>
                        <i class="<?= $_dorIcons[$i] ?? 'icon-wifi' ?>" aria-hidden="true"></i>
                        <span><?= nl2br(htmlspecialchars($item)) ?></span>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="wifi-mesh__technology">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <h2 class="wifi-mesh__section-title"><?= htmlspecialchars($_wm['tech_titulo']) ?></h2>
                        <p class="wifi-mesh__section-text"><?= htmlspecialchars($_wm['tech_texto']) ?></p>
                        <ul class="wifi-mesh__checks">
                            <?php foreach ($_wm['tech_bullets'] as $b): ?>
                            <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($b) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="col-lg-8">
                        <img class="wifi-mesh__technology-image"
                             src="<?= BASE_URL ?>/images/wifimesh/<?= htmlspecialchars($_wm['tech_imagem']) ?>"
                             alt="Casa com cobertura Wi-Fi Mesh em todos os ambientes">
                    </div>
                </div>
            </div>
        </section>

        <section class="wifi-mesh__how">
            <div class="container">
                <div class="wifi-mesh__how-box">
                    <h2><?= htmlspecialchars($_wm['como_titulo']) ?></h2>
                    <p><?= htmlspecialchars($_wm['como_texto']) ?></p>
                    <div class="wifi-mesh__steps">
                        <?php foreach ($_wm['como_steps'] as $i => $step): ?>
                        <article>
                            <i class="<?= $_comoIcons[$i] ?? 'icon-wifi' ?>" aria-hidden="true"></i>
                            <b><?= $i + 1 ?></b>
                            <span><?= htmlspecialchars($step) ?></span>
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="wifi-mesh__why wifi-mesh__desktop-only">
            <div class="container">
                <h2 class="wifi-mesh__center-title"><?= htmlspecialchars($_wm['porque_titulo']) ?></h2>
                <div class="wifi-mesh__why-grid">
                    <?php foreach ($_wm['porque_items'] as $i => $item): ?>
                    <article>
                        <i class="<?= $_porqueIcons[$i] ?? 'icon-wifi' ?>" aria-hidden="true"></i>
                        <h3><?= htmlspecialchars($item['titulo']) ?></h3>
                        <p><?= htmlspecialchars($item['texto']) ?></p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="wifi-mesh__ideal">
            <div class="container">
                <h2 class="wifi-mesh__center-title"><?= htmlspecialchars($_wm['ideal_titulo']) ?></h2>
                <div class="wifi-mesh__ideal-grid">
                    <?php foreach ($_wm['ideal_items'] as $i => $item): ?>
                    <article>
                        <i class="<?= $_idealIcons[$i] ?? 'icon-wifi' ?>" aria-hidden="true"></i>
                        <span><?= htmlspecialchars($item) ?></span>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="wifi-mesh__performance wifi-mesh__desktop-only">
            <div class="container">
                <div class="wifi-mesh__performance-box">
                    <img src="<?= BASE_URL ?>/images/wifimesh/<?= htmlspecialchars($_wm['perf_imagem']) ?>" alt="Equipamentos Wi-Fi Mesh">
                    <div class="wifi-mesh__performance-copy">
                        <h2><?= htmlspecialchars($_wm['perf_titulo']) ?></h2>
                        <p><?= htmlspecialchars($_wm['perf_texto']) ?></p>
                    </div>
                    <ul>
                        <?php foreach ($_wm['perf_bullets'] as $i => $b): ?>
                        <li><i class="<?= $_perfIcons[$i] ?? 'icon-wifi' ?>" aria-hidden="true"></i><?= htmlspecialchars($b) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

        <section class="wifi-mesh__cta">
            <div class="container">
                <div class="wifi-mesh__cta-box">
                    <h2>Sua casa inteira conectada de verdade.</h2>
                    <div class="wifi-mesh__cta-actions">
                        <a class="wifi-mesh__cta-button wifi-mesh__cta-button--whatsapp" href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="wifi-mesh__cta-button" href="<?= BASE_URL ?>/carrinho" data-cart-add data-cart-id="wifi-mesh-kit" data-cart-group="wifi-mesh" data-cart-title="Wi-Fi Mesh" data-cart-subtitle="Cobertura inteligente residencial" data-cart-price="A partir de R$ 139,90/m&ecirc;s" data-cart-icon="icon-wifimesh" data-cart-url="<?= BASE_URL ?>/wifimesh"><i class="icon-calendar" aria-hidden="true"></i><span>Solicitar análise técnica</span></a>
                    </div>
                </div>
            </div>
        </section>

        <?php include ROOT . '/includes/trust-google/trust-google.php'; ?>
    </div>
</section>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/wifimesh/wifimesh.js?' . $version . '"></script>';
?>

</body>
</html>
