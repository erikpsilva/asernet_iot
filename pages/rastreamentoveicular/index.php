<!DOCTYPE html>
<html>
<head>
<title>AserNet - Rastreamento Veicular</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<?php
// ── Banner (hero) ──────────────────────────────────────────────────────────
$_bn = [
    'titulo'             => 'Mais controle.',
    'titulo_destaque'    => 'Mais segurança.',
    'titulo_complemento' => 'Onde você estiver.',
    'texto'              => 'Rastreadores inteligentes para proteger o que importa e ter o controle total na palma da sua mão.',
    'bullets'            => ['Localização em tempo real', 'Bloqueio remoto', 'Histórico de rotas', 'Cerca eletrônica', 'Alerta de movimento'],
    'preco'              => '',
    'btn1_texto'         => 'Falar com um especialista',
    'btn2_texto'         => '0800 222 5262',
    'imagem'             => '',
];
try {
    require_once ROOT . '/config/database.php';
    $_s_bn = getDbConnection()->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'rastreamento_banner' LIMIT 1");
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
$_tv = [
    'quick_items' => [
        ['titulo' => 'Monitoramento 24h',          'texto' => 'Acompanhe em tempo real pelo app ou plataforma web.'],
        ['titulo' => 'Tecnologia 4G + GPS',         'texto' => 'Mais precisão na localização e mais estabilidade.'],
        ['titulo' => 'Plataforma completa',          'texto' => 'Relatórios, históricos e alertas personalizados.'],
        ['titulo' => 'Suporte local especializado',  'texto' => 'Atendimento próximo e rápido quando precisar.'],
    ],

    'cat_titulo'    => 'Muito mais que rastreamento tradicional.',
    'cat_subtitulo' => 'Além de carros, motos e caminhões, nossos rastreadores atendem várias necessidades do seu dia a dia.',
    'cat_cards' => [
        ['titulo' => 'Carros',               'texto' => 'Proteção contra roubo, furto e uso não autorizado.',     'imagem' => 'imgCarros.png',            'featured' => false],
        ['titulo' => 'Motos',                'texto' => 'Mais segurança para o seu dia a dia sobre duas rodas.',  'imagem' => 'imgMotos.png',             'featured' => false],
        ['titulo' => 'Caminhões',             'texto' => 'Gestão de frota, rotas e segurança da carga.',          'imagem' => 'imgCaminhoes.png',         'featured' => false],
        ['titulo' => 'Bicicletas Elétricas',  'texto' => 'Segurança contra roubo e controle completo para pais.', 'imagem' => 'imgBicicletaEletrica.png',  'featured' => true],
    ],
    'cat_more' => [
        ['texto' => 'Embarcações',            'imagem' => 'imgEmbarcacoes.png'],
        ['texto' => 'Ferramentas e máquinas', 'imagem' => 'imgFerramentasMaquinas.png'],
        ['texto' => 'Malas e equipamentos',   'imagem' => 'imgMalasEquipamentos.png'],
        ['texto' => 'Mochilas e bolsas',      'imagem' => 'imgMochilasBolsas.png'],
        ['texto' => 'Objetos de valor',       'imagem' => 'imgObjetosDeValor.png'],
        ['texto' => 'Muito mais',             'imagem' => 'imgMuitoMais.png'],
    ],

    'bike_titulo'  => 'Bicicletas elétricas: segurança e controle para toda a família.',
    'bike_texto'   => 'Além de proteger contra roubo, nossa solução permite que os pais acompanhem e controlem o uso da e-bike dos filhos.',
    'bike_imagem'  => 'imgBicicletaEletricasSegurancaControleParaTodaFamilia.png',
    'bike_bullets' => ['Localização em tempo real', 'Alerta de movimento', 'Controle de velocidade máxima', 'Histórico de rotas e paradas', 'Cerca eletrônica', 'Mais tranquilidade para pais e responsáveis'],

    'planos_titulo'    => 'Escolha o plano ideal para você',
    'planos_subtitulo' => 'Planos simples, com tudo que você precisa para ter mais segurança e tranquilidade.',
    'planos_nota'      => 'Sem fidelidade. Cancele quando quiser.',
    'planos' => [
        ['nome' => 'Rastreador Veicular',                   'descricao' => 'Monitoramento completo do seu veículo em tempo real.',                'preco' => '49,90',
         'bullets' => ['Localização em tempo real', 'Histórico de rotas', 'Alerta de movimento', 'Bloqueio remoto', 'Cerca eletrônica', 'Relatórios completos']],
        ['nome' => 'Rastreador Veicular + Tag Localizadora', 'descricao' => 'Proteção completa para seu veículo e seus objetos importantes.',      'preco' => '69,90',
         'bullets' => ['Tudo do plano Rastreador Veicular +', 'Tag localizadora inclusa', 'Localize objetos e pertences', 'Alerta de proximidade', 'Bateria de longa duração']],
        ['nome' => 'Tag Localizadora',                       'descricao' => 'Localize objetos, bolsas, mochilas, malas e muito mais.',             'preco' => '19,90',
         'bullets' => ['Localização em tempo real', 'Alerta de proximidade', 'Leve e discreta', 'Bateria de longa duração', 'Compatível com o app']],
    ],

    'why_titulo' => 'Por que escolher a AserNet?',
    'why_items'  => [
        ['titulo' => 'Tecnologia confiável',   'texto' => 'Equipamentos modernos e de alta qualidade.'],
        ['titulo' => 'Suporte local',           'texto' => 'Atendimento rápido e especializado.'],
        ['titulo' => 'Planos flexíveis',        'texto' => 'Opções que cabem na sua necessidade.'],
        ['titulo' => 'Privacidade e segurança', 'texto' => 'Seus dados protegidos com criptografia.'],
    ],

    'trust_google' => '5,0 + de 3.000 avaliações no Google',
    'trust_items'  => ['Instalação profissional', 'Atendimento local de verdade', 'Suporte especializado', 'Plataforma 100% online'],
];

try {
    require_once ROOT . '/config/database.php';
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'rastreamento_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['cat_titulo', 'cat_subtitulo', 'bike_titulo', 'bike_texto', 'bike_imagem',
                        'planos_titulo', 'planos_subtitulo', 'planos_nota', 'why_titulo', 'trust_google'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $_tv[$k] = $db[$k];
            }
            if (!empty($db['bike_bullets']) && is_array($db['bike_bullets'])) $_tv['bike_bullets'] = $db['bike_bullets'];
            if (!empty($db['trust_items'])  && is_array($db['trust_items']))  $_tv['trust_items']  = $db['trust_items'];
            foreach (['quick_items', 'cat_cards', 'cat_more', 'why_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($_tv[$arr][$i]) || !is_array($item)) continue;
                        foreach (array_keys($_tv[$arr][$i]) as $k) {
                            if ($k === 'featured') {
                                if (isset($item[$k])) $_tv[$arr][$i][$k] = (bool) $item[$k];
                            } elseif (isset($item[$k]) && strlen((string) $item[$k])) {
                                $_tv[$arr][$i][$k] = $item[$k];
                            }
                        }
                    }
                }
            }
            if (!empty($db['planos']) && is_array($db['planos'])) {
                foreach ($db['planos'] as $i => $p) {
                    if (!isset($_tv['planos'][$i]) || !is_array($p)) continue;
                    foreach (['nome', 'descricao', 'preco'] as $k) {
                        if (isset($p[$k]) && strlen((string) $p[$k])) $_tv['planos'][$i][$k] = $p[$k];
                    }
                    if (!empty($p['bullets']) && is_array($p['bullets'])) $_tv['planos'][$i]['bullets'] = $p['bullets'];
                }
            }
        }
    }
} catch (Throwable $e) {}

$_quickIcons = ['icon-pin', 'icon-gps', 'icon-office', 'icon-quality'];
$_whyIcons   = ['icon-gear', 'icon-pin', 'icon-quality', 'icon-security'];
$_trustIcons = ['icon-gear', 'icon-talk', 'icon-customersupport', 'icon-clock'];
$_cartIds    = ['rastreador-veicular', 'rastreador-premium', 'tag-localizadora'];
$_planMods   = ['', ' tracking-page__plan--featured', ' tracking-page__plan--tag'];
?>

<section class="tracking-page">
    <div class="tracking-page__hero"<?= !empty($_bn['imagem']) ? ' style="background-image:url(\'' . BASE_URL . '/images/banners/rastreamento/' . htmlspecialchars($_bn['imagem']) . '\')"' : '' ?>>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="tracking-page__hero-copy">
                        <h1 class="tracking-page__hero-title">
                            <?= htmlspecialchars($_bn['titulo']) ?>
                            <?php if (!empty($_bn['titulo_destaque'])): ?><strong><?= htmlspecialchars($_bn['titulo_destaque']) ?></strong><?php endif; ?>
                            <?php if (!empty($_bn['titulo_complemento'])): ?><?= htmlspecialchars($_bn['titulo_complemento']) ?><?php endif; ?>
                        </h1>
                        <p class="tracking-page__hero-text"><?= htmlspecialchars($_bn['texto']) ?></p>

                        <?php if (!empty($_bn['bullets'])): ?>
                        <ul class="tracking-page__hero-list">
                            <?php foreach ($_bn['bullets'] as $_b): ?>
                            <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($_b) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php if (!empty($_bn['preco'])): ?>
                        <p class="tracking-page__hero-price"><?= htmlspecialchars($_bn['preco']) ?></p>
                        <?php endif; ?>

                        <div class="tracking-page__hero-actions">
                            <a class="tracking-page__button tracking-page__button--whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn1_texto']) ?></a>
                            <a class="tracking-page__button tracking-page__button--outline" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn2_texto']) ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="tracking-page__body">
        <section class="tracking-page__quick">
            <div class="container">
                <div class="tracking-page__quick-grid">
                    <?php foreach ($_tv['quick_items'] as $i => $item): ?>
                    <article>
                        <i class="<?= $_quickIcons[$i] ?? 'icon-pin' ?>" aria-hidden="true"></i>
                        <div>
                            <h3><?= htmlspecialchars($item['titulo']) ?></h3>
                            <p><?= htmlspecialchars($item['texto']) ?></p>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="tracking-page__categories">
            <div class="container">
                <header class="tracking-page__section-header">
                    <h2><?= htmlspecialchars($_tv['cat_titulo']) ?></h2>
                    <p><?= htmlspecialchars($_tv['cat_subtitulo']) ?></p>
                </header>

                <div class="tracking-page__category-grid">
                    <?php foreach ($_tv['cat_cards'] as $card):
                        $featuredClass = !empty($card['featured']) ? ' tracking-page__category-featured' : '';
                    ?>
                    <article class="<?= ltrim($featuredClass) ?>">
                        <?php if (!empty($card['featured'])): ?><span>Destaque</span><?php endif; ?>
                        <img src="<?= BASE_URL ?>/images/rastreamentoveicular/<?= htmlspecialchars($card['imagem']) ?>" alt="<?= htmlspecialchars($card['titulo']) ?> com rastreador">
                        <div>
                            <h3><?= htmlspecialchars($card['titulo']) ?></h3>
                            <p><?= htmlspecialchars($card['texto']) ?></p>
                            <a href="<?= BASE_URL ?>/contato">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>

                <div class="tracking-page__more-grid">
                    <?php foreach ($_tv['cat_more'] as $more): ?>
                    <article>
                        <img src="<?= BASE_URL ?>/images/rastreamentoveicular/<?= htmlspecialchars($more['imagem']) ?>" alt="">
                        <span><?= htmlspecialchars($more['texto']) ?></span>
                    </article>
                    <?php endforeach; ?>
                </div>

                <a class="tracking-page__mobile-more" href="<?= BASE_URL ?>/contato">Ver todos</a>
            </div>
        </section>

        <section class="tracking-page__bike">
            <div class="container">
                <div class="tracking-page__bike-grid">
                    <div class="tracking-page__bike-copy">
                        <h2><?= htmlspecialchars($_tv['bike_titulo']) ?></h2>
                        <p><?= htmlspecialchars($_tv['bike_texto']) ?></p>
                    </div>
                    <img src="<?= BASE_URL ?>/images/rastreamentoveicular/<?= htmlspecialchars($_tv['bike_imagem']) ?>" alt="Bicicleta elétrica e celular com mapa">
                    <ul>
                        <?php foreach ($_tv['bike_bullets'] as $b): ?>
                        <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($b) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

        <section class="tracking-page__plans">
            <div class="container">
                <header class="tracking-page__section-header">
                    <h2><?= htmlspecialchars($_tv['planos_titulo']) ?></h2>
                    <p><?= htmlspecialchars($_tv['planos_subtitulo']) ?></p>
                </header>

                <div class="tracking-page__plans-grid">
                    <?php foreach ($_tv['planos'] as $i => $plano): ?>
                    <article class="tracking-page__plan<?= $_planMods[$i] ?? '' ?>">
                        <?php if ($i === 1): ?><span>Mais escolhido</span><?php endif; ?>
                        <?php if ($i === 1): ?>
                            <div><i class="icon-car" aria-hidden="true"></i><i class="icon-pin" aria-hidden="true"></i></div>
                        <?php elseif ($i === 2): ?>
                            <i class="icon-mobile-phone" aria-hidden="true"></i>
                        <?php else: ?>
                            <i class="icon-car" aria-hidden="true"></i>
                        <?php endif; ?>
                        <h3><?= htmlspecialchars($plano['nome']) ?></h3>
                        <p><?= htmlspecialchars($plano['descricao']) ?></p>
                        <strong>R$ <?= htmlspecialchars($plano['preco']) ?><small>/mês</small></strong>
                        <ul>
                            <?php foreach ($plano['bullets'] as $b): ?>
                            <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($b) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="<?= BASE_URL ?>/carrinho"
                           data-cart-add
                           data-cart-id="<?= $_cartIds[$i] ?? 'rastreador-' . ($i + 1) ?>"
                           data-cart-group="rastreamento"
                           data-cart-title="<?= htmlspecialchars($plano['nome']) ?>"
                           data-cart-subtitle="<?= htmlspecialchars($plano['descricao']) ?>"
                           data-cart-price="R$ <?= htmlspecialchars($plano['preco']) ?>/m&ecirc;s"
                           data-cart-icon="icon-carpin"
                           data-cart-url="<?= BASE_URL ?>/rastreamentoveicular">Assinar plano</a>
                    </article>
                    <?php endforeach; ?>
                </div>

                <p class="tracking-page__note"><i class="icon-checked" aria-hidden="true"></i><?= htmlspecialchars($_tv['planos_nota']) ?></p>
            </div>
        </section>

        <section class="tracking-page__why">
            <div class="container">
                <h2><?= htmlspecialchars($_tv['why_titulo']) ?></h2>
                <div class="tracking-page__why-grid">
                    <?php foreach ($_tv['why_items'] as $i => $item): ?>
                    <article>
                        <i class="<?= $_whyIcons[$i] ?? 'icon-gear' ?>" aria-hidden="true"></i>
                        <div>
                            <h3><?= htmlspecialchars($item['titulo']) ?></h3>
                            <p><?= htmlspecialchars($item['texto']) ?></p>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="tracking-page__trust">
            <div class="container">
                <div class="tracking-page__trust-grid">
                    <div class="tracking-page__google">
                        <img src="<?= BASE_URL ?>/images/logoGoogle.png" alt="Google">
                        <p><strong><?= htmlspecialchars($_tv['trust_google']) ?></strong></p>
                    </div>
                    <?php foreach ($_tv['trust_items'] as $i => $item): ?>
                    <article>
                        <i class="<?= $_trustIcons[$i] ?? 'icon-gear' ?>" aria-hidden="true"></i>
                        <?= htmlspecialchars($item) ?>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="tracking-page__cta">
            <div class="container">
                <div class="tracking-page__cta-box">
                    <div>
                        <h2>Pronto para ter mais segurança e controle?</h2>
                        <p>Fale com um especialista e encontre o plano ideal para você.</p>
                    </div>
                    <div class="tracking-page__cta-actions">
                        <a class="tracking-page__cta-button tracking-page__cta-button--whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="tracking-page__cta-button" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><span>Ligar gratuitamente <strong>0800 222 5262</strong></span></a>
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
echo '<script src="' . BASE_URL . '/pages/rastreamentoveicular/rastreamentoveicular.js?' . $version . '"></script>';
?>

</body>
</html>
