<!DOCTYPE html>
<html>
<head>
<title>AserNet - Link Dedicado</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<?php
// ── Banner (hero) ──────────────────────────────────────────────────────────
$_bn = [
    'titulo'             => 'Link dedicado',
    'titulo_destaque'    => 'para empresas que não podem parar.',
    'titulo_complemento' => '',
    'texto'              => 'Conexão exclusiva, estável e com alta performance para manter sua operação sempre conectada.',
    'bullets'            => ['Banda exclusiva', 'Baixa latência', 'Alta estabilidade', 'Atendimento prioritário'],
    'preco'              => '',
    'btn1_texto'         => 'Solicitar proposta',
    'btn2_texto'         => '0800 222 5262',
    'imagem'             => '',
];
try {
    require_once ROOT . '/config/database.php';
    $_s_bn = getDbConnection()->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'linkdedicado_banner' LIMIT 1");
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

$_ld = [
    'problem_titulo' => 'Sua opera&ccedil;&atilde;o n&atilde;o pode parar.',
    'problem_texto'  => 'Quando a internet falha, sua empresa perde produtividade, atendimento e faturamento.',
    'problem_items'  => ['Sistemas indispon&iacute;veis', 'Reuni&otilde;es travando', 'Lentid&atilde;o em hor&aacute;rios cr&iacute;ticos', 'Impacto na opera&ccedil;&atilde;o'],
    'problem_imagem' => 'imgSuaOperacaoNaoPodeParar.png',

    'exclusive_titulo' => 'Conex&atilde;o exclusiva para sua empresa.',
    'exclusive_texto'  => 'No link dedicado, a banda contratada &eacute; reservada para sua opera&ccedil;&atilde;o, garantindo mais estabilidade e previsibilidade.',
    'exclusive_cards'  => [
        ['titulo' => 'Conex&atilde;o exclusiva', 'texto' => 'Banda 100% dedicada para sua empresa.'],
        ['titulo' => 'Performance constante', 'texto' => 'Mais estabilidade e menos oscila&ccedil;&otilde;es.'],
        ['titulo' => 'Melhor estabilidade', 'texto' => 'Ideal para opera&ccedil;&otilde;es cr&iacute;ticas.'],
        ['titulo' => 'Monitoramento t&eacute;cnico', 'texto' => 'Acompanhamento cont&iacute;nuo da conex&atilde;o.'],
    ],

    'aud_titulo' => 'Para quem &eacute; indicado',
    'aud_texto'  => 'Ideal para empresas que dependem de conex&atilde;o constante.',
    'aud_items'  => ['Escrit&oacute;rios', 'Empresas com m&uacute;ltiplos usu&aacute;rios', 'Opera&ccedil;&otilde;es em nuvem', 'Videomonitoramento', 'Telefonia IP', 'ERPs e sistemas online', 'Hot&eacute;is e pousadas'],

    'feat_titulo' => 'Diferenciais AserNet',
    'feat_cards'  => [
        ['titulo' => 'Banda dedicada', 'texto' => 'Mais previsibilidade e estabilidade para sua opera&ccedil;&atilde;o.'],
        ['titulo' => 'Monitoramento cont&iacute;nuo', 'texto' => 'Acompanhamento 24/7 para garantir o melhor desempenho.'],
        ['titulo' => 'Suporte priorit&aacute;rio', 'texto' => 'Atendimento r&aacute;pido e especializado para reduzir o impacto operacional.'],
        ['titulo' => 'Projeto sob medida', 'texto' => 'Solu&ccedil;&otilde;es personalizadas conforme a necessidade da sua empresa.'],
    ],

    'integration_titulo' => 'Mais que conectividade. Integra&ccedil;&atilde;o que gera resultado.',
    'integration_texto'  => 'O link dedicado pode ser integrado com outras solu&ccedil;&otilde;es AserNet para potencializar seu neg&oacute;cio.',
    'integration_cards'  => [
        ['titulo' => 'Wi-Fi Profissional', 'texto' => 'Rede est&aacute;vel para todos os ambientes da empresa.', 'imagem' => 'imgWifiProfissional.png'],
        ['titulo' => 'Telefonia Empresarial', 'texto' => 'Mais comunica&ccedil;&atilde;o, mais produtividade.', 'imagem' => 'imgTelefoniaEmpresarial.png'],
        ['titulo' => 'C&acirc;meras de Seguran&ccedil;a', 'texto' => 'Monitoramento inteligente 24 horas por dia.', 'imagem' => 'imgCamerasDeSeguranca.png'],
        ['titulo' => 'Infraestrutura', 'texto' => 'Solu&ccedil;&otilde;es completas para sua empresa crescer.', 'imagem' => 'imgInfraestrutura.png'],
    ],

    'benefits_titulo' => 'Benef&iacute;cios para sua empresa',
    'benefit_cards'   => [
        ['titulo' => 'Mais estabilidade', 'texto' => 'Conex&atilde;o preparada para opera&ccedil;&otilde;es cr&iacute;ticas.'],
        ['titulo' => 'Melhor desempenho', 'texto' => 'Menos oscila&ccedil;&atilde;o, mais previsibilidade.'],
        ['titulo' => 'Mais seguran&ccedil;a', 'texto' => 'Infraestrutura profissional para proteger sua opera&ccedil;&atilde;o.'],
        ['titulo' => 'Escal&aacute;vel', 'texto' => 'Projetos personalizados conforme o crescimento da sua empresa.'],
    ],

    'trust_google' => '5,0 + de 3.000 avalia&ccedil;&otilde;es no Google',
    'trust_items'  => ['Atendimento local de verdade', 'Suporte t&eacute;cnico especializado', 'Instala&ccedil;&atilde;o profissional e acompanhamento'],
];

try {
    require_once ROOT . '/config/database.php';
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'linkdedicado_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['problem_titulo', 'problem_texto', 'problem_imagem',
                        'exclusive_titulo', 'exclusive_texto',
                        'aud_titulo', 'aud_texto', 'feat_titulo',
                        'integration_titulo', 'integration_texto',
                        'benefits_titulo', 'trust_google'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $_ld[$k] = $db[$k];
            }
            foreach (['problem_items', 'aud_items', 'trust_items'] as $k) {
                if (!empty($db[$k]) && is_array($db[$k])) $_ld[$k] = $db[$k];
            }
            foreach (['exclusive_cards', 'feat_cards', 'integration_cards', 'benefit_cards'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($_ld[$arr][$i]) || !is_array($item)) continue;
                        foreach (array_keys($_ld[$arr][$i]) as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $_ld[$arr][$i][$k] = $item[$k];
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

$_ldh = function ($value): string {
    return htmlspecialchars(html_entity_decode((string) $value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
};

$_ldExclusiveIcons = ['icon-servidor', 'icon-speed', 'icon-security', 'icon-dashboard'];
$_ldAudIcons = ['icon-office', 'icon-group', 'icon-cloud', 'icon-casino-cctv', 'icon-phone', 'icon-dashboard', 'icon-hotels'];
$_ldFeatIcons = ['icon-link', 'icon-dashboard', 'icon-customersupport', 'icon-puzzle'];
$_ldBenefitIcons = ['icon-cloud', 'icon-speed', 'icon-security', 'icon-group'];
$_ldTrustIcons = ['icon-group', 'icon-customersupport', 'icon-install'];
?>

<section class="link-dedicado-page">
    <div class="link-dedicado-page__hero"<?= !empty($_bn['imagem']) ? ' style="--hero-image:url(\'' . BASE_URL . '/images/banners/linkdedicado/' . htmlspecialchars($_bn['imagem']) . '\')"' : '' ?>>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="link-dedicado-page__hero-copy">
                        <h1 class="link-dedicado-page__hero-title">
                            <?= htmlspecialchars($_bn['titulo']) ?>
                            <?php if (!empty($_bn['titulo_destaque'])): ?><strong><?= htmlspecialchars($_bn['titulo_destaque']) ?></strong><?php endif; ?>
                            <?php if (!empty($_bn['titulo_complemento'])): ?><?= htmlspecialchars($_bn['titulo_complemento']) ?><?php endif; ?>
                        </h1>
                        <p class="link-dedicado-page__hero-text"><?= htmlspecialchars($_bn['texto']) ?></p>

                        <?php if (!empty($_bn['bullets'])): ?>
                        <ul class="link-dedicado-page__hero-list">
                            <?php foreach ($_bn['bullets'] as $_b): ?>
                            <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($_b) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php if (!empty($_bn['preco'])): ?>
                        <p class="link-dedicado-page__hero-price"><?= htmlspecialchars($_bn['preco']) ?></p>
                        <?php endif; ?>

                        <div class="link-dedicado-page__hero-actions">
                            <a class="link-dedicado-page__button link-dedicado-page__button--primary" href="https://wa.me/5508002225262?text=Ol%C3%A1!%20Tenho%20interesse%20em%20solicitar%20uma%20proposta%20de%20Link%20Dedicado." target="_blank" rel="noopener"><?= htmlspecialchars($_bn['btn1_texto']) ?> <i class="icon-arrowright" aria-hidden="true"></i></a>
                            <a class="link-dedicado-page__button link-dedicado-page__button--outline" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn2_texto']) ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="link-dedicado-page__body">
        <section class="link-dedicado-page__problem">
            <div class="container">
                <div class="link-dedicado-page__problem-grid">
                    <div>
                        <h2><?= $_ldh($_ld['problem_titulo']) ?></h2>
                        <p><?= $_ldh($_ld['problem_texto']) ?></p>
                        <ul class="link-dedicado-page__bad-list">
                            <?php foreach ($_ld['problem_items'] as $item): ?>
                            <li><i aria-hidden="true">&times;</i><?= $_ldh($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <img src="<?= BASE_URL ?>/images/linkdedicado/<?= htmlspecialchars($_ld['problem_imagem']) ?>" alt="Cidade conectada por rede corporativa de alta disponibilidade">
                </div>
            </div>
        </section>

        <section class="link-dedicado-page__exclusive">
            <div class="container">
                <div class="link-dedicado-page__exclusive-box">
                    <div class="link-dedicado-page__exclusive-copy">
                        <h2><?= $_ldh($_ld['exclusive_titulo']) ?></h2>
                        <p><?= $_ldh($_ld['exclusive_texto']) ?></p>
                    </div>

                    <?php foreach ($_ld['exclusive_cards'] as $i => $card): ?>
                    <article><i class="<?= $_ldExclusiveIcons[$i] ?? 'icon-link' ?>" aria-hidden="true"></i><h3><?= $_ldh($card['titulo']) ?></h3><p><?= $_ldh($card['texto']) ?></p></article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="link-dedicado-page__audience">
            <div class="container">
                <header class="link-dedicado-page__section-header">
                    <h2><?= $_ldh($_ld['aud_titulo']) ?></h2>
                    <p><?= $_ldh($_ld['aud_texto']) ?></p>
                </header>

                <div class="link-dedicado-page__audience-grid">
                    <?php foreach ($_ld['aud_items'] as $i => $item): ?>
                    <article><i class="<?= $_ldAudIcons[$i] ?? 'icon-office' ?>" aria-hidden="true"></i><span><?= $_ldh($item) ?></span></article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="link-dedicado-page__features">
            <div class="container">
                <h2 class="link-dedicado-page__center-title"><?= $_ldh($_ld['feat_titulo']) ?></h2>
                <div class="link-dedicado-page__features-grid">
                    <?php foreach ($_ld['feat_cards'] as $i => $card): ?>
                    <article><i class="<?= $_ldFeatIcons[$i] ?? 'icon-link' ?>" aria-hidden="true"></i><h3><?= $_ldh($card['titulo']) ?></h3><p><?= $_ldh($card['texto']) ?></p></article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="link-dedicado-page__integration">
            <div class="container">
                <header class="link-dedicado-page__section-header">
                    <h2><?= $_ldh($_ld['integration_titulo']) ?></h2>
                    <p><?= $_ldh($_ld['integration_texto']) ?></p>
                </header>

                <div class="link-dedicado-page__integration-grid">
                    <?php foreach ($_ld['integration_cards'] as $card): ?>
                    <article><img src="<?= BASE_URL ?>/images/linkdedicado/<?= htmlspecialchars($card['imagem']) ?>" alt="<?= $_ldh($card['titulo']) ?>"><div><h3><?= $_ldh($card['titulo']) ?></h3><p><?= $_ldh($card['texto']) ?></p></div></article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="link-dedicado-page__benefits">
            <div class="container">
                <div class="link-dedicado-page__benefits-box">
                    <h2><?= $_ldh($_ld['benefits_titulo']) ?></h2>
                    <div>
                        <?php foreach ($_ld['benefit_cards'] as $i => $card): ?>
                        <article><i class="<?= $_ldBenefitIcons[$i] ?? 'icon-cloud' ?>" aria-hidden="true"></i><strong><?= $_ldh($card['titulo']) ?></strong><span><?= $_ldh($card['texto']) ?></span></article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <?php include ROOT . '/includes/trust-google/trust-google.php'; ?>

        <section class="link-dedicado-page__cta">
            <div class="container">
                <div class="link-dedicado-page__cta-box">
                    <div>
                        <h2>Sua empresa precisa de uma conex&atilde;o que n&atilde;o pode falhar?</h2>
                        <p>Fale com um especialista e descubra a melhor solu&ccedil;&atilde;o para o seu neg&oacute;cio.</p>
                    </div>
                    <div class="link-dedicado-page__cta-actions">
                        <a class="link-dedicado-page__cta-button link-dedicado-page__cta-button--whatsapp" href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="link-dedicado-page__cta-button" href="https://wa.me/5508002225262?text=Ol%C3%A1!%20Gostaria%20de%20solicitar%20uma%20an%C3%A1lise%20t%C3%A9cnica%20de%20Link%20Dedicado." target="_blank" rel="noopener"><i class="icon-calendar" aria-hidden="true"></i><span>Solicitar an&aacute;lise t&eacute;cnica</span></a>
                    </div>
                </div>
            </div>
        </section>

        <img class="link-dedicado-page__mobile-bottom-image" src="<?= BASE_URL ?>/images/linkdedicado/<?= htmlspecialchars($_ld['problem_imagem']) ?>" alt="">
    </div>
</section>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/linkdedicado/linkdedicado.js?' . $version . '"></script>';
?>

</body>
</html>
