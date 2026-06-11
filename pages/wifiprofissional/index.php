<!DOCTYPE html>
<html>
<head>
<title>AserNet - Wi-Fi Profissional</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<?php
// ── Banner (hero) ──────────────────────────────────────────────────────────
$_bn = [
    'titulo'             => 'Wi-Fi profissional,',
    'titulo_destaque'    => 'sem complicação.',
    'titulo_complemento' => '',
    'texto'              => 'Conecte múltiplos dispositivos com estabilidade, cobertura e desempenho de verdade para sua empresa.',
    'bullets'            => ['Cobertura completa', 'Alta capacidade de conexões simultâneas', 'Gestão inteligente da rede'],
    'preco'              => 'Planos a partir de R$ 159,90/mês',
    'btn1_texto'         => 'Quero um Wi-Fi profissional',
    'btn2_texto'         => '0800 222 5262',
    'imagem'             => '',
];
try {
    require_once ROOT . '/config/database.php';
    $_s_bn = getDbConnection()->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'wifiprofissional_banner' LIMIT 1");
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

/* ---- defaults ---- */
$_wp = [
    'cmp_prob_titulo' => 'Seu Wi-Fi não acompanha o ritmo da sua empresa?',
    'cmp_prob_texto'  => 'Quando a rede não é profissional, sua empresa sente:',
    'cmp_prob_items'  => ['Sinal fraco em alguns ambientes', 'Quedas em horários de pico', 'Lentidão com muitos dispositivos', 'Dificuldade para controlar a rede', 'Clientes e equipe insatisfeitos'],
    'cmp_imagem'      => 'imgSeuWifiNaoAcompanha.png',
    'cmp_sol_titulo'  => 'Rede Wi-Fi profissional, gerenciada e escalável',
    'cmp_sol_texto'   => 'Com o Wi-Fi Pro AserNet, sua empresa conta com uma estrutura preparada para ambientes com maior demanda de conexão.',
    'cmp_sol_items'   => ['Controladora centralizada', 'Ponto de acesso profissional', 'Expansão com APs adicionais', 'Monitoramento e gestão da rede', 'Suporte técnico AserNet'],

    'steps_titulo' => 'Como funciona',
    'steps_texto'  => 'Uma solução que cresce com sua empresa',
    'steps'        => [
        ['titulo' => 'Entendemos o ambiente',            'texto' => 'Analisamos o tamanho, layout e necessidade do seu negócio.'],
        ['titulo' => 'Dimensionamos a melhor estrutura', 'texto' => 'Definimos a quantidade ideal de equipamentos para seu ambiente.'],
        ['titulo' => 'Instalamos controladora e APs',    'texto' => 'Equipamentos profissionais instalados com segurança.'],
        ['titulo' => 'Configuramos a rede',              'texto' => 'Criamos redes seguras, separadas e otimizadas para cada uso.'],
        ['titulo' => 'Acompanhamos o desempenho',        'texto' => 'Monitoramento contínuo e suporte sempre que você precisar.'],
    ],

    'plan_titulo'    => 'Business Wi-Fi Pro',
    'plan_preco'     => 'R$ 159,90',
    'plan_items'     => ['Controladora', '1 Access Point profissional', 'Instalação e configuração', 'Gestão centralizada', 'Suporte AserNet'],
    'plan_adicional' => 'AP adicional: R$ 100,00/mês',
    'plan_imagem'    => 'imgBusinessWifiPro.png',

    'aud_titulo' => 'Para quem é indicado',
    'aud_texto'  => 'Ideal para empresas com muitos dispositivos conectados',
    'aud_items'  => ['Escritórios', 'Academias', 'Clínicas', 'Escolas', 'Restaurantes', 'Hotéis e pousadas', 'Lojas e comércios', 'Empresas com equipe conectada'],

    'feat_titulo' => 'Diferenciais AserNet',
    'feat_cards'  => [
        ['titulo' => 'Mais estabilidade para todos os ambientes', 'texto' => 'O Wi-Fi Pro distribui melhor o sinal e melhora a experiência de conexão em áreas maiores ou com muitos usuários.',                'imagem' => 'imgMaisEstabilidadeParaTodosAmbientes.png'],
        ['titulo' => 'Gestão inteligente',                        'texto' => 'A controladora permite acompanhar a rede, identificar falhas e melhorar o desempenho de forma prática.',                          'imagem' => 'imgGestaoInteligente.png'],
        ['titulo' => 'Escalável',                                  'texto' => 'Sua empresa pode começar com 1 AP e adicionar novos pontos conforme a necessidade.',                                              'imagem' => 'imgEscalavel.png'],
    ],
];

try {
    require_once ROOT . '/config/database.php';
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'wifiprofissional_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['cmp_prob_titulo', 'cmp_prob_texto', 'cmp_imagem',
                        'cmp_sol_titulo', 'cmp_sol_texto',
                        'steps_titulo', 'steps_texto',
                        'plan_titulo', 'plan_preco', 'plan_adicional', 'plan_imagem',
                        'aud_titulo', 'aud_texto', 'feat_titulo'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $_wp[$k] = $db[$k];
            }
            foreach (['cmp_prob_items', 'cmp_sol_items', 'plan_items', 'aud_items'] as $k) {
                if (!empty($db[$k]) && is_array($db[$k])) $_wp[$k] = $db[$k];
            }
            foreach (['steps', 'feat_cards'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($_wp[$arr][$i]) || !is_array($item)) continue;
                        foreach (array_keys($_wp[$arr][$i]) as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $_wp[$arr][$i][$k] = $item[$k];
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

$_stepIcons = ['icon-talk', 'icon-contrato', 'icon-setting', 'icon-gear', 'icon-bars'];
$_audIcons  = ['icon-paraempresa', 'icon-funcionarios', 'icon-clinic', 'icon-school', 'icon-restaurant', 'icon-hotels', 'icon-market', 'icon-empresapessoas'];
$_featIcons = ['icon-wifiestavel', 'icon-monitoramento', 'icon-wificobertura'];
?>

<section class="wifi-pro-page">
    <div class="wifi-pro-page__hero"<?= !empty($_bn['imagem']) ? ' style="background-image:url(\'' . BASE_URL . '/images/banners/wifiprofissional/' . htmlspecialchars($_bn['imagem']) . '\')"' : '' ?>>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="wifi-pro-page__hero-copy">
                        <h1 class="wifi-pro-page__hero-title">
                            <?= htmlspecialchars($_bn['titulo']) ?>
                            <?php if (!empty($_bn['titulo_destaque'])): ?><strong><?= htmlspecialchars($_bn['titulo_destaque']) ?></strong><?php endif; ?>
                            <?php if (!empty($_bn['titulo_complemento'])): ?><?= htmlspecialchars($_bn['titulo_complemento']) ?><?php endif; ?>
                        </h1>
                        <p class="wifi-pro-page__hero-text"><?= htmlspecialchars($_bn['texto']) ?></p>

                        <?php if (!empty($_bn['bullets'])): ?>
                        <ul class="wifi-pro-page__hero-list">
                            <?php foreach ($_bn['bullets'] as $_b): ?>
                            <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($_b) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php if (!empty($_bn['preco'])): ?>
                        <p class="wifi-pro-page__hero-price"><?= htmlspecialchars($_bn['preco']) ?></p>
                        <?php endif; ?>

                        <div class="wifi-pro-page__hero-actions">
                            <a class="wifi-pro-page__button wifi-pro-page__button--primary" href="https://wa.me/5508002225262?text=Ol%C3%A1!%20Tenho%20interesse%20em%20contratar%20o%20Wi-Fi%20Profissional%20para%20minha%20empresa." target="_blank" rel="noopener"><i class="icon-wifi" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn1_texto']) ?></a>
                            <a class="wifi-pro-page__button wifi-pro-page__button--outline" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn2_texto']) ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="wifi-pro-page__body">
        <section class="wifi-pro-page__compare">
            <div class="container">
                <div class="wifi-pro-page__compare-grid">
                    <div class="wifi-pro-page__problem">
                        <h2><?= htmlspecialchars($_wp['cmp_prob_titulo']) ?></h2>
                        <p><?= htmlspecialchars($_wp['cmp_prob_texto']) ?></p>
                        <ul class="wifi-pro-page__bad-list">
                            <?php foreach ($_wp['cmp_prob_items'] as $item): ?>
                            <li><i aria-hidden="true">&times;</i><?= htmlspecialchars($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <figure class="wifi-pro-page__compare-image">
                        <img src="<?= BASE_URL ?>/images/wifiprofissional/<?= htmlspecialchars($_wp['cmp_imagem']) ?>" alt="Planta baixa com pontos de acesso Wi-Fi distribuindo sinal">
                    </figure>

                    <div class="wifi-pro-page__solution">
                        <h2><?= htmlspecialchars($_wp['cmp_sol_titulo']) ?></h2>
                        <p><?= htmlspecialchars($_wp['cmp_sol_texto']) ?></p>
                        <ul class="wifi-pro-page__check-list">
                            <?php foreach ($_wp['cmp_sol_items'] as $item): ?>
                            <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="wifi-pro-page__steps">
            <div class="container">
                <header class="wifi-pro-page__section-header">
                    <h2><?= htmlspecialchars($_wp['steps_titulo']) ?></h2>
                    <p><?= htmlspecialchars($_wp['steps_texto']) ?></p>
                </header>

                <div class="wifi-pro-page__steps-grid">
                    <?php foreach ($_wp['steps'] as $i => $step): ?>
                    <article>
                        <i class="<?= $_stepIcons[$i] ?? 'icon-bars' ?>" aria-hidden="true"></i>
                        <b><?= $i + 1 ?></b>
                        <h3><?= htmlspecialchars($step['titulo']) ?></h3>
                        <p><?= htmlspecialchars($step['texto']) ?></p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="wifi-pro-page__plan">
            <div class="container">
                <div class="wifi-pro-page__plan-box">
                    <img src="<?= BASE_URL ?>/images/wifiprofissional/<?= htmlspecialchars($_wp['plan_imagem']) ?>" alt="Controladora e ponto de acesso Business Wi-Fi Pro">
                    <article>
                        <h2><?= htmlspecialchars($_wp['plan_titulo']) ?></h2>
                        <div class="wifi-pro-page__plan-content">
                            <div>
                                <strong class="wifi-pro-page__plan-price"><?= htmlspecialchars($_wp['plan_preco']) ?><small>/mês</small></strong>
                                <span>Inclui:</span>
                                <ul class="wifi-pro-page__check-list">
                                    <?php foreach ($_wp['plan_items'] as $item): ?>
                                    <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($item) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="wifi-pro-page__additional"><i class="icon-expansivel" aria-hidden="true"></i><span>AP adicional:<strong><?= htmlspecialchars($_wp['plan_adicional']) ?></strong></span></div>
                        </div>
                        <a href="https://wa.me/5508002225262?text=Ol%C3%A1!%20Tenho%20interesse%20em%20contratar%20o%20Wi-Fi%20Profissional%20para%20minha%20empresa." target="_blank" rel="noopener">Contratar Wi-Fi Pro</a>
                    </article>
                </div>
            </div>
        </section>

        <section class="wifi-pro-page__audience">
            <div class="container">
                <header class="wifi-pro-page__section-header">
                    <h2><?= htmlspecialchars($_wp['aud_titulo']) ?></h2>
                    <p><?= htmlspecialchars($_wp['aud_texto']) ?></p>
                </header>

                <div class="wifi-pro-page__audience-grid">
                    <?php foreach ($_wp['aud_items'] as $i => $item): ?>
                    <article><i class="<?= $_audIcons[$i] ?? 'icon-paraempresa' ?>" aria-hidden="true"></i><?= htmlspecialchars($item) ?></article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="wifi-pro-page__features">
            <div class="container">
                <h2 class="wifi-pro-page__center-title"><?= htmlspecialchars($_wp['feat_titulo']) ?></h2>
                <div class="wifi-pro-page__features-grid">
                    <?php foreach ($_wp['feat_cards'] as $i => $card): ?>
                    <article>
                        <div>
                            <i class="<?= $_featIcons[$i] ?? 'icon-wifiestavel' ?>" aria-hidden="true"></i>
                            <h3><?= htmlspecialchars($card['titulo']) ?></h3>
                            <p><?= htmlspecialchars($card['texto']) ?></p>
                        </div>
                        <img src="<?= BASE_URL ?>/images/wifiprofissional/<?= htmlspecialchars($card['imagem']) ?>" alt="<?= htmlspecialchars($card['titulo']) ?>">
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="wifi-pro-page__cta">
            <div class="container">
                <div class="wifi-pro-page__cta-box">
                    <div>
                        <h2>Sua empresa precisa de um Wi-Fi que funcione de verdade?</h2>
                        <p>Fale com um consultor e solicite uma análise técnica.</p>
                    </div>
                    <div class="wifi-pro-page__cta-actions">
                        <a class="wifi-pro-page__cta-button wifi-pro-page__cta-button--whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="wifi-pro-page__cta-button" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><span>Ligar gratuitamente <strong>0800 222 5262</strong></span></a>
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
echo '<script src="' . BASE_URL . '/pages/wifiprofissional/wifiprofissional.js?' . $version . '"></script>';
?>

</body>
</html>
