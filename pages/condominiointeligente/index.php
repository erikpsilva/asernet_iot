<?php
$seoTitle = 'Condomínio Inteligente | AserNet IoT Services';
$seoDescription = 'Tecnologia, segurança e conectividade integradas para transformar a gestão e a rotina do seu condomínio.';

$_bn = [
    'titulo'             => 'Condomínio',
    'titulo_destaque'    => 'Inteligente',
    'titulo_complemento' => '',
    'texto'              => 'Mais segurança, praticidade e conectividade para o seu condomínio.',
    'bullets'            => ['Soluções integradas que conectam tecnologia, segurança e gestão para facilitar a rotina do síndico, valorizar o patrimônio e proporcionar mais tranquilidade para todos.'],
    'preco'              => '',
    'btn1_texto'         => 'Solicitar apresentação',
    'btn2_texto'         => 'Falar com um especialista',
    'imagem'             => '',
];
try {
    require_once ROOT . '/config/database.php';
    $_s_bn = getDbConnection()->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'condominiointeligente_banner' LIMIT 1");
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

$_ci = [
    'complete_titulo'  => 'Uma solução completa e integrada',
    'complete_texto'   => 'Tecnologias que se conectam para oferecer mais segurança, eficiência e comodidade para síndicos, moradores, visitantes e prestadores de serviço.',
    'complete_items' => [
        ['titulo' => 'Câmeras de segurança', 'texto' => 'Monitoramento 24h com acesso remoto e gravação em nuvem.'],
        ['titulo' => 'Controle de acesso', 'texto' => 'Reconhecimento facial, biometria, tags e QR Code para moradores e visitantes.'],
        ['titulo' => 'Wi-Fi para áreas comuns', 'texto' => 'Internet rápida e estável para áreas comuns e ambientes do condomínio.'],
        ['titulo' => 'Internet dedicada', 'texto' => 'Conexão de alta performance para todos os sistemas do condomínio.'],
        ['titulo' => 'Aplicativo do condomínio', 'texto' => 'Acesso a reservas, avisos, ocorrências, visitantes e muito mais.'],
        ['titulo' => 'Gestão inteligente', 'texto' => 'Relatórios, históricos e informações na palma da mão.'],
    ],

    'benefits_titulo' => 'Benefícios para todos',
    'benefits_items' => [
        ['titulo' => 'Mais segurança', 'texto' => 'Tecnologia integrada para monitorar acessos, áreas comuns e visitantes.', 'imagem' => 'imgMaisSeguraca.png'],
        ['titulo' => 'Mais comodidade', 'texto' => 'Moradores com acesso facilitado e serviços na palma da mão.', 'imagem' => 'imgMaisComodidade.png'],
        ['titulo' => 'Mais gestão e controle', 'texto' => 'Síndico com relatórios históricos e gestão centralizada.', 'imagem' => 'imgMaisGestaoControle.png'],
        ['titulo' => 'Valorização do patrimônio', 'texto' => 'Mais tecnologia e estrutura aumentam o valor do seu condomínio.', 'imagem' => 'imgValorizacaoDoPadtrimonio.png'],
    ],

    'integrations_titulo' => 'Soluções integradas',
    'integrations_items' => [
        ['label' => 'Câmeras de segurança'], ['label' => 'Controle de acesso'], ['label' => 'Wi-Fi profissional'],
        ['label' => 'Internet dedicada'], ['label' => 'Aplicativo'], ['label' => 'Condomínio inteligente'],
    ],

    'steps_titulo' => 'Como funciona na prática',
    'steps_items' => [
        ['titulo' => 'Tecnologia instalada', 'texto' => 'Instalamos todos os equipamentos e integramos as soluções.'],
        ['titulo' => 'Dados na nuvem', 'texto' => 'Informações armazenadas com segurança e alta disponibilidade.'],
        ['titulo' => 'Acesso remoto', 'texto' => 'Gestão e monitoramento de qualquer lugar, pelo aplicativo ou web.'],
        ['titulo' => 'Mais tranquilidade', 'texto' => 'Mais segurança, agilidade e qualidade de vida para todos.'],
    ],

    'cta_titulo'          => 'O futuro do seu condomínio',
    'cta_titulo_destaque' => 'começa agora.',
    'cta_texto'           => 'Fale com nossa equipe e descubra como podemos transformar seu condomínio com tecnologia e segurança.',
    'cta_btn1_texto'      => '0800 222 5262',
    'cta_btn2_texto'      => 'Solicitar apresentação',
];

try {
    require_once ROOT . '/config/database.php';
    $row = getDbConnection()->query("SELECT setting_value FROM system_settings WHERE setting_key = 'condominiointeligente_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['complete_titulo', 'complete_texto', 'benefits_titulo', 'integrations_titulo', 'steps_titulo',
                        'cta_titulo', 'cta_titulo_destaque', 'cta_texto', 'cta_btn1_texto', 'cta_btn2_texto'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $_ci[$k] = $db[$k];
            }
            if (!empty($db['integrations_items']) && is_array($db['integrations_items'])) {
                foreach ($db['integrations_items'] as $i => $item) {
                    if (!isset($_ci['integrations_items'][$i]) || !is_array($item)) continue;
                    if (isset($item['label']) && strlen((string) $item['label'])) $_ci['integrations_items'][$i]['label'] = $item['label'];
                }
            }
            foreach (['complete_items', 'steps_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($_ci[$arr][$i]) || !is_array($item)) continue;
                        foreach (array_keys($_ci[$arr][$i]) as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $_ci[$arr][$i][$k] = $item[$k];
                        }
                    }
                }
            }
            if (!empty($db['benefits_items']) && is_array($db['benefits_items'])) {
                foreach ($db['benefits_items'] as $i => $item) {
                    if (!isset($_ci['benefits_items'][$i]) || !is_array($item)) continue;
                    foreach (array_keys($_ci['benefits_items'][$i]) as $k) {
                        if (isset($item[$k]) && strlen((string) $item[$k])) $_ci['benefits_items'][$i][$k] = $item[$k];
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

$_solutionsIcons = ['icon-casino-cctv','icon-view','icon-wifi','icon-globe','icon-mobile-phone','icon-cloud'];
$_benefitsIcons = ['icon-security','icon-group','icon-diagram','icon-payment'];
$_integrationsIcons = ['icon-casino-cctv','icon-view','icon-wifi','icon-globe','icon-mobile-phone','icon-office'];
$_stepsIcons = ['icon-install','icon-cloud','icon-mobile-phone','icon-security'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>AserNet - Condomínio Inteligente</title>
    <?php include ROOT . '/includes/assets.php'; ?>
</head>
<body>
<?php include ROOT . '/includes/header/header.php'; ?>

<main class="smart-condo">
    <section class="smart-condo__hero"<?= !empty($_bn['imagem']) ? ' style="--hero-image:url(\'' . BASE_URL . '/images/banners/condominiointeligente/' . htmlspecialchars($_bn['imagem']) . '\')"' : '' ?>>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-7">
                    <div class="smart-condo__hero-copy">
                        <h1><?=htmlspecialchars($_bn['titulo'])?> <?php if(!empty($_bn['titulo_destaque'])):?><strong><?=htmlspecialchars($_bn['titulo_destaque'])?></strong><?php endif;?> <?=htmlspecialchars($_bn['titulo_complemento'])?></h1>
                        <h2><?=htmlspecialchars($_bn['texto'])?></h2>
                        <?php foreach($_bn['bullets'] as $_bv):?><p><?=htmlspecialchars($_bv)?></p><?php endforeach;?>
                        <div class="smart-condo__hero-actions">
                            <a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-phone"></i><?=htmlspecialchars($_bn['btn1_texto'])?></a>
                            <a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp"></i><?=htmlspecialchars($_bn['btn2_texto'])?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="smart-condo__body">
        <div class="container">
            <section class="smart-condo__section smart-condo__complete">
                <h2 class="smart-condo__title"><?=htmlspecialchars($_ci['complete_titulo'])?></h2>
                <p class="smart-condo__subtitle"><?=htmlspecialchars($_ci['complete_texto'])?></p>
                <div class="smart-condo__solutions">
                    <?php foreach ($_ci['complete_items'] as $i => $solution): ?>
                    <article><i class="<?= $_solutionsIcons[$i % count($_solutionsIcons)] ?>"></i><h3><?= htmlspecialchars($solution['titulo']) ?></h3><p><?= htmlspecialchars($solution['texto']) ?></p></article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="smart-condo__section">
                <h2 class="smart-condo__title"><?=htmlspecialchars($_ci['benefits_titulo'])?></h2>
                <div class="smart-condo__benefits">
                    <?php foreach ($_ci['benefits_items'] as $i => $benefit): ?>
                    <article style="--benefit-image:url('<?= BASE_URL ?>/images/condominiointeligente/<?= htmlspecialchars($benefit['imagem']) ?>')">
                        <div><i class="<?= $_benefitsIcons[$i % count($_benefitsIcons)] ?>"></i><h3><?= htmlspecialchars($benefit['titulo']) ?></h3><p><?= htmlspecialchars($benefit['texto']) ?></p></div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="smart-condo__section">
                <h2 class="smart-condo__title"><?=htmlspecialchars($_ci['integrations_titulo'])?></h2>
                <div class="smart-condo__integrations">
                    <?php $_n = count($_ci['integrations_items']); foreach ($_ci['integrations_items'] as $index => $integration): ?>
                    <article><i class="<?= $_integrationsIcons[$index % count($_integrationsIcons)] ?>"></i><h3><?= htmlspecialchars($integration['label']) ?></h3></article>
                    <?php if ($index < $_n - 2): ?><b>+</b><?php elseif ($index === $_n - 2): ?><b>=</b><?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="smart-condo__section">
                <h2 class="smart-condo__title"><?=htmlspecialchars($_ci['steps_titulo'])?></h2>
                <div class="smart-condo__steps">
                    <?php foreach ($_ci['steps_items'] as $index => $step): ?>
                    <article><b><?= $index + 1 ?></b><i class="<?= $_stepsIcons[$index % count($_stepsIcons)] ?>"></i><h3><?= htmlspecialchars($step['titulo']) ?></h3><p><?= htmlspecialchars($step['texto']) ?></p></article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="smart-condo__cta">
                <div class="smart-condo__cta-copy">
                    <h2><?=htmlspecialchars($_ci['cta_titulo'])?><br><strong><?=htmlspecialchars($_ci['cta_titulo_destaque'])?></strong></h2>
                    <p><?=htmlspecialchars($_ci['cta_texto'])?></p>
                </div>
                <div class="smart-condo__cta-phone"></div>
                <div class="smart-condo__cta-actions">
                    <a href="tel:08002225262"><i class="icon-phone"></i><?=htmlspecialchars($_ci['cta_btn1_texto'])?></a>
                    <a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp"></i><?=htmlspecialchars($_ci['cta_btn2_texto'])?></a>
                </div>
                <div class="smart-condo__cta-building"></div>
            </section>
        </div>
    </section>
</main>

<?php include ROOT . '/includes/footer/footer.php'; ?>
<?php include ROOT . '/includes/scripts.php'; ?>
</body>
</html>
