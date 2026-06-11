<!DOCTYPE html>
<html>
<head>
<title>AserNet - Plano Móvel</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<?php
// ── Banner (hero) ──────────────────────────────────────────────────────────
$_bn = [
    'titulo'             => 'Internet que vai com você,',
    'titulo_destaque'    => 'sem complicação.',
    'titulo_complemento' => '',
    'texto'              => 'Fale, navegue e continue conectado dentro e fora de casa com o Aser Mobile.',
    'bullets'            => ['Cobertura nacional', 'Mais internet com bônus de portabilidade', 'Atendimento AserNet', 'Planos sem burocracia'],
    'preco'              => 'Planos a partir de R$ 39,90/mês',
    'btn1_texto'         => 'Quero meu chip Aser Mobile',
    'btn2_texto'         => '0800 222 5262',
    'imagem'             => '',
];
try {
    require_once ROOT . '/config/database.php';
    $_s_bn = getDbConnection()->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'movel_banner' LIMIT 1");
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
$_mv = [
    'rotina_titulo' => 'Sua conexão não pode parar quando você sai de casa.',
    'rotina_items'  => ['Redes sociais e mensagens', 'Vídeos e streaming', 'Trabalho e reuniões', 'GPS e aplicativos', 'Games e muito mais'],

    'planos_titulo'        => 'Escolha o plano ideal para você',
    'planos_portabilidade' => 'Mantenha seu número com a portabilidade.',
    'planos' => [
        ['nome' => '20 GB', 'subtitulo' => '15GB + 5GB bônus portabilidade', 'preco' => '39,90',
         'bullets' => ['Minutos ilimitados para qualquer operadora', 'WhatsApp ilimitado', 'SMS ilimitado', 'Cobertura nacional'],
         'featured' => false],
        ['nome' => '25 GB', 'subtitulo' => '20GB + 5GB bônus portabilidade', 'preco' => '59,90',
         'bullets' => ['Minutos ilimitados para qualquer operadora', 'WhatsApp ilimitado', 'SMS ilimitado', 'Cobertura nacional'],
         'featured' => true],
        ['nome' => '30 GB', 'subtitulo' => '25GB + 5GB bônus portabilidade', 'preco' => '69,90',
         'bullets' => ['Minutos ilimitados para qualquer operadora', 'WhatsApp ilimitado', 'SMS ilimitado', 'Cobertura nacional'],
         'featured' => false],
    ],

    'beneficios_titulo' => 'Benefícios',
    'beneficios' => [
        ['titulo' => 'Cobertura nacional',        'texto' => 'Internet móvel onde você estiver.'],
        ['titulo' => 'Portabilidade simples',      'texto' => 'Mantenha seu número atual.'],
        ['titulo' => 'Atendimento local',          'texto' => 'Suporte próximo e sem enrolação.'],
        ['titulo' => 'Integração com sua AserNet', 'texto' => 'Conectividade dentro e fora de casa.'],
    ],

    'como_titulo' => 'Simples e rápido. Veja como funciona:',
    'como_steps'  => [
        ['titulo' => 'Escolha o plano',    'texto' => 'ideal para você.'],
        ['titulo' => 'Solicite o chip',    'texto' => 'e receba onde estiver.'],
        ['titulo' => 'Fazemos a ativação', 'texto' => 'de forma rápida.'],
        ['titulo' => 'Você continua',      'texto' => 'conectado!'],
    ],

    'eco_titulo'   => 'Mais que um plano móvel. Parte do ecossistema AserNet para manter você conectado sempre.',
    'eco_resultado'=> 'Conexão completa para sua vida.',
    'eco_items'    => [
        ['texto' => 'Internet residencial', 'imagem' => 'imgInternetResidencial.png'],
        ['texto' => 'Câmeras de segurança', 'imagem' => 'imgCameraDeSeguranca.png'],
        ['texto' => 'Aser Mobile',          'imagem' => 'imgAserMobile.png'],
    ],

    'trust_google' => '+ de 3.000 avaliações no Google',
    'trust_item1'  => 'Atendimento local de verdade',
    'trust_item2'  => 'Clientes satisfeitos',
];

try {
    require_once ROOT . '/config/database.php';
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'movel_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['rotina_titulo', 'planos_titulo', 'planos_portabilidade',
                        'beneficios_titulo', 'como_titulo', 'eco_titulo', 'eco_resultado',
                        'trust_google', 'trust_item1', 'trust_item2'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $_mv[$k] = $db[$k];
            }
            if (!empty($db['rotina_items']) && is_array($db['rotina_items'])) $_mv['rotina_items'] = $db['rotina_items'];
            if (!empty($db['planos']) && is_array($db['planos'])) {
                foreach ($db['planos'] as $i => $p) {
                    if (!isset($_mv['planos'][$i]) || !is_array($p)) continue;
                    foreach (['nome', 'subtitulo', 'preco'] as $k) {
                        if (isset($p[$k]) && strlen((string) $p[$k])) $_mv['planos'][$i][$k] = $p[$k];
                    }
                    if (!empty($p['bullets']) && is_array($p['bullets'])) $_mv['planos'][$i]['bullets'] = $p['bullets'];
                    if (isset($p['featured'])) $_mv['planos'][$i]['featured'] = (bool) $p['featured'];
                }
            }
            foreach (['beneficios', 'como_steps', 'eco_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($_mv[$arr][$i]) || !is_array($item)) continue;
                        foreach (array_keys($_mv[$arr][$i]) as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $_mv[$arr][$i][$k] = $item[$k];
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

$_rotinaIcons   = ['icon-socialmedia', 'icon-videostreaming', 'icon-paraempresa', 'icon-gps', 'icon-videogame'];
$_benefIcons    = ['icon-wificobertura', 'icon-mobile-phone', 'icon-customersupport', 'icon-equipamentocomodato'];
$_comoIcons     = ['icon-chip', 'icon-entrega', 'icon-ativacao', 'icon-conection'];
?>

<section class="mobile-plan">
    <div class="mobile-plan__hero"<?= !empty($_bn['imagem']) ? ' style="background-image:url(\'' . BASE_URL . '/images/banners/movel/' . htmlspecialchars($_bn['imagem']) . '\')"' : '' ?>>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="mobile-plan__hero-copy">
                        <h1 class="mobile-plan__hero-title">
                            <?= htmlspecialchars($_bn['titulo']) ?>
                            <?php if (!empty($_bn['titulo_destaque'])): ?><strong><?= htmlspecialchars($_bn['titulo_destaque']) ?></strong><?php endif; ?>
                            <?php if (!empty($_bn['titulo_complemento'])): ?><?= htmlspecialchars($_bn['titulo_complemento']) ?><?php endif; ?>
                        </h1>
                        <p class="mobile-plan__hero-text"><?= htmlspecialchars($_bn['texto']) ?></p>

                        <?php if (!empty($_bn['bullets'])): ?>
                        <ul class="mobile-plan__hero-list">
                            <?php foreach ($_bn['bullets'] as $_b): ?>
                            <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($_b) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php if (!empty($_bn['preco'])): ?>
                        <p class="mobile-plan__hero-price"><?= htmlspecialchars($_bn['preco']) ?></p>
                        <?php endif; ?>

                        <div class="mobile-plan__hero-actions">
                            <a class="mobile-plan__button mobile-plan__button--primary" href="<?= BASE_URL ?>/contato"><i class="icon-chip" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn1_texto']) ?></a>
                            <a class="mobile-plan__button mobile-plan__button--outline" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn2_texto']) ?></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-6" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="mobile-plan__body">
        <section class="mobile-plan__routine mobile-plan__desktop-only">
            <div class="container">
                <h2><?= htmlspecialchars($_mv['rotina_titulo']) ?></h2>
                <div class="mobile-plan__routine-grid">
                    <?php foreach ($_mv['rotina_items'] as $i => $item): ?>
                    <article>
                        <i class="<?= $_rotinaIcons[$i] ?? 'icon-wifi' ?>" aria-hidden="true"></i>
                        <span><?= htmlspecialchars($item) ?></span>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="mobile-plan__plans">
            <div class="container">
                <div class="mobile-plan__plans-box">
                    <h2 class="mobile-plan__center-title"><?= htmlspecialchars($_mv['planos_titulo']) ?></h2>

                    <div class="mobile-plan__plans-grid">
                        <?php foreach ($_mv['planos'] as $i => $plano):
                            $featuredClass = !empty($plano['featured']) ? ' mobile-plan__plan--featured' : '';
                            $cartId = 'mobile-plan-' . ($i + 1);
                        ?>
                        <article class="mobile-plan__plan<?= $featuredClass ?>">
                            <?php if (!empty($plano['featured'])): ?><span>Mais escolhido</span><?php endif; ?>
                            <div class="mobile-plan__plan-heading">
                                <h3><?= htmlspecialchars($plano['nome']) ?></h3>
                                <p><?= nl2br(htmlspecialchars($plano['subtitulo'])) ?></p>
                            </div>
                            <p class="mobile-plan__price"><span>R$</span> <?= htmlspecialchars($plano['preco']) ?><small>/mês</small></p>
                            <ul>
                                <?php foreach ($plano['bullets'] as $b): ?>
                                <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($b) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <a href="<?= BASE_URL ?>/carrinho"
                               data-cart-add
                               data-cart-id="<?= $cartId ?>"
                               data-cart-group="aser-mobile"
                               data-cart-title="Aser Mobile - <?= htmlspecialchars($plano['nome']) ?>"
                               data-cart-subtitle="<?= htmlspecialchars($plano['subtitulo']) ?>"
                               data-cart-price="R$ <?= htmlspecialchars($plano['preco']) ?>/m&ecirc;s"
                               data-cart-icon="icon-mobile-phone"
                               data-cart-url="<?= BASE_URL ?>/planomovel">Solicitar chip</a>
                        </article>
                        <?php endforeach; ?>
                    </div>

                    <p class="mobile-plan__portability"><i class="icon-mobile-phone" aria-hidden="true"></i><?= htmlspecialchars($_mv['planos_portabilidade']) ?></p>
                    <a class="mobile-plan__mobile-request" href="<?= BASE_URL ?>/contato">Solicitar meu chip</a>
                </div>
            </div>
        </section>

        <section class="mobile-plan__benefits">
            <div class="container">
                <h2 class="mobile-plan__mobile-title"><?= htmlspecialchars($_mv['beneficios_titulo']) ?></h2>
                <div class="mobile-plan__benefits-grid">
                    <?php foreach ($_mv['beneficios'] as $i => $b): ?>
                    <article>
                        <i class="<?= $_benefIcons[$i] ?? 'icon-wifi' ?>" aria-hidden="true"></i>
                        <div>
                            <h3><?= htmlspecialchars($b['titulo']) ?></h3>
                            <p><?= htmlspecialchars($b['texto']) ?></p>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="mobile-plan__how">
            <div class="container">
                <h2 class="mobile-plan__center-title"><?= htmlspecialchars($_mv['como_titulo']) ?></h2>
                <div class="mobile-plan__steps">
                    <?php foreach ($_mv['como_steps'] as $i => $step): ?>
                    <article>
                        <i class="<?= $_comoIcons[$i] ?? 'icon-wifi' ?>" aria-hidden="true"></i>
                        <b><?= $i + 1 ?></b>
                        <span><strong><?= htmlspecialchars($step['titulo']) ?></strong><?= htmlspecialchars($step['texto']) ?></span>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="mobile-plan__ecosystem">
            <div class="container">
                <div class="mobile-plan__ecosystem-box">
                    <h2><?= htmlspecialchars($_mv['eco_titulo']) ?></h2>
                    <?php foreach ($_mv['eco_items'] as $i => $eco): ?>
                    <?php if ($i > 0): ?><b>+</b><?php endif; ?>
                    <div class="mobile-plan__ecosystem-item">
                        <img src="<?= BASE_URL ?>/images/planomovel/<?= htmlspecialchars($eco['imagem']) ?>" alt="">
                        <span><?= htmlspecialchars($eco['texto']) ?></span>
                    </div>
                    <?php endforeach; ?>
                    <b>=</b>
                    <div class="mobile-plan__ecosystem-result">
                        <i class="icon-wifi" aria-hidden="true"></i>
                        <span><?= htmlspecialchars($_mv['eco_resultado']) ?></span>
                    </div>
                </div>
            </div>
        </section>

        <section class="mobile-plan__trust">
            <div class="container">
                <div class="mobile-plan__trust-grid">
                    <div class="mobile-plan__google">
                        <img src="<?= BASE_URL ?>/images/logoGoogle.png" alt="Google">
                        <p><strong><?= htmlspecialchars($_mv['trust_google']) ?></strong><br>no Google</p>
                    </div>
                    <article><i class="icon-group" aria-hidden="true"></i><h3><?= htmlspecialchars($_mv['trust_item1']) ?></h3></article>
                    <article><i class="icon-heart" aria-hidden="true"></i><h3><?= htmlspecialchars($_mv['trust_item2']) ?></h3></article>
                </div>
            </div>
        </section>

        <section class="mobile-plan__cta">
            <div class="container">
                <div class="mobile-plan__cta-box">
                    <div>
                        <h2>Sua conexão continua com você.</h2>
                        <p>Fale com um consultor e escolha o plano ideal.</p>
                    </div>
                    <div class="mobile-plan__cta-actions">
                        <a class="mobile-plan__cta-button mobile-plan__cta-button--whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="mobile-plan__cta-button" href="<?= BASE_URL ?>/contato"><i class="icon-phone" aria-hidden="true"></i><span>Solicitar meu chip <strong>0800 222 5262</strong></span></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="mobile-plan__footer-benefits mobile-plan__desktop-only">
            <div class="container">
                <span><i class="icon-ativacao" aria-hidden="true"></i>Ativação rápida</span>
                <span><i class="icon-checked" aria-hidden="true"></i>Sem fidelidade</span>
                <span><i class="icon-payment" aria-hidden="true"></i>Pagamento facilitado</span>
                <span><i class="icon-support" aria-hidden="true"></i>Suporte AserNet</span>
            </div>
        </section>
    </div>
</section>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/planomovel/planomovel.js?' . $version . '"></script>';
?>

</body>
</html>
