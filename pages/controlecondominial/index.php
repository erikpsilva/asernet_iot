<?php
$seoTitle = 'Controle de Acesso Condominial | AserNet IoT Services';
$seoDescription = 'Controle de acesso condominial com reconhecimento facial, QR Code, placas veiculares, aplicativo e gestão em nuvem.';

$_bn = [
    'titulo'             => 'Controle de acesso',
    'titulo_destaque'    => 'condominial',
    'titulo_complemento' => '',
    'texto'              => 'Mais segurança, praticidade e tecnologia para o seu condomínio, na palma da sua mão.',
    'bullets'            => ['Controle e reserve, registre e libere o acesso de moradores, visitantes e veículos de onde estiver.'],
    'preco'              => '',
    'btn1_texto'         => 'Solicitar apresentação',
    'btn2_texto'         => 'Falar com um especialista',
    'imagem'             => '',
];
try {
    require_once ROOT . '/config/database.php';
    $_s_bn = getDbConnection()->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'controleconcominial_banner' LIMIT 1");
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

$_cd = [
    'intro_titulo' => 'Segurança e comodidade para todos',
    'intro_texto'  => 'Nosso sistema integra segurança, tecnologia e praticidade para gerenciar acessos e reservas, valorizando o patrimônio e proporcionando tranquilidade para todos.',

    'technologies_titulo' => 'Tecnologias disponíveis',
    'technologies_items' => [
        ['label' => 'Reconhecimento facial'], ['label' => 'QR Code'], ['label' => 'Placas veiculares'], ['label' => 'Cartões RFID'],
        ['label' => 'Códigos PIN'], ['label' => 'Interfone IP'], ['label' => 'Aplicativo'], ['label' => 'Gestão em nuvem'],
    ],

    'audiences_titulo' => 'Ideal para',
    'audiences_items' => [
        ['label' => 'Condomínios verticais', 'imagem' => 'imgCondominiosVerticais.png'],
        ['label' => 'Condomínios horizontais', 'imagem' => 'imgCondominiosHorizontais.png'],
        ['label' => 'Loteamentos fechados', 'imagem' => 'imgLoteamentoFechados.png'],
        ['label' => 'Associações de moradores', 'imagem' => 'associacoesDeMoradores.png'],
        ['label' => 'Empresas e escritórios', 'imagem' => 'imgEmpresasEscritorios.png'],
    ],

    'benefits_titulo' => 'Benefícios para moradores',
    'benefits_items' => [
        ['titulo' => 'Entrada sem senha', 'texto' => 'Acesso por biometria, QR Code ou aplicativo.'],
        ['titulo' => 'Mais segurança', 'texto' => 'Controle de entradas e saídas em tempo real.'],
        ['titulo' => 'Histórico completo', 'texto' => 'Libere acessos de onde estiver.'],
        ['titulo' => 'Mais valorização', 'texto' => 'Valorização do condomínio e patrimônio.'],
    ],

    'app_titulo'  => 'Aplicativo do condomínio',
    'app_imagem'  => 'imgAplicativoDoCondomino.png',
    'app_texto'   => 'Baixe o aplicativo e tenha o seu condomínio na palma da mão.',
    'app_features_items' => [
        ['titulo' => 'Visitas', 'texto' => 'Autorize visitas de qualquer lugar.'],
        ['titulo' => 'Reservas de áreas comuns', 'texto' => 'Praticidade na palma da mão.'],
        ['titulo' => 'Abertura remota', 'texto' => 'Libere acessos de onde estiver.'],
        ['titulo' => 'Comunicados', 'texto' => 'Envie avisos e informações importantes.'],
        ['titulo' => 'Notificações', 'texto' => 'Receba alertas em tempo real.'],
    ],

    'flow_titulo' => 'Controle completo de visitantes',
    'flow_items' => [
        ['titulo' => 'Solicitação da visita', 'texto' => 'Pré-cadastro feito pelo morador ou síndico.'],
        ['titulo' => 'Envio do link ou QR Code', 'texto' => 'O visitante recebe por e-mail ou WhatsApp.'],
        ['titulo' => 'Chegada ao condomínio', 'texto' => 'Acesso rápido e seguro na portaria.'],
        ['titulo' => 'Acesso autorizado', 'texto' => 'Liberação feita de onde estiver.'],
        ['titulo' => 'Histórico e relatórios', 'texto' => 'Acompanhamento completo e seguro.'],
    ],

    'integrations_titulo' => 'Integração com outras soluções',
    'integrations_items' => [
        ['label' => 'Controle de acesso'], ['label' => 'Câmeras de segurança'], ['label' => 'Wi-Fi para áreas comuns'],
        ['label' => 'Internet dedicada'], ['label' => 'Gestão inteligente'], ['label' => 'Condomínio inteligente'],
    ],

    'equipment_titulo'    => 'Soluções Control iD',
    'equipment_texto'     => 'Soluções completas para todos os tipos de controle de acesso.',
    'equipment_btn_texto' => 'Conheça os equipamentos',
    'equipment_imagem'    => 'imgSolucoes.png',
    'equipment_logo'      => 'logoControlID.png',

    'how_titulo' => 'Como funciona',
    'how_items' => [
        ['titulo' => 'Cadastro', 'texto' => 'Cadastre moradores, visitantes e veículos.'],
        ['titulo' => 'Envio do link', 'texto' => 'QR Code enviado por e-mail ou WhatsApp.'],
        ['titulo' => 'Liberação', 'texto' => 'Liberação de acesso pelo sistema ou aplicativo.'],
        ['titulo' => 'Entrada', 'texto' => 'Acesso autorizado com tecnologia segura.'],
        ['titulo' => 'Registro', 'texto' => 'Tudo registrado em tempo real na nuvem.'],
    ],

    'cta_titulo'          => 'Seu condomínio mais',
    'cta_titulo_destaque' => 'moderno, seguro e conectado.',
    'cta_texto'           => 'Solicite uma apresentação e descubra como podemos transformar a gestão de acessos.',
    'cta_btn1_texto'      => '0800 222 5262',
    'cta_btn2_texto'      => 'Solicitar apresentação',
];

try {
    require_once ROOT . '/config/database.php';
    $row = getDbConnection()->query("SELECT setting_value FROM system_settings WHERE setting_key = 'controleconcominial_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['intro_titulo', 'intro_texto', 'technologies_titulo', 'audiences_titulo', 'benefits_titulo',
                        'app_titulo', 'app_imagem', 'app_texto', 'flow_titulo', 'integrations_titulo',
                        'equipment_titulo', 'equipment_texto', 'equipment_btn_texto', 'equipment_imagem', 'equipment_logo',
                        'how_titulo', 'cta_titulo', 'cta_titulo_destaque', 'cta_texto', 'cta_btn1_texto', 'cta_btn2_texto'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $_cd[$k] = $db[$k];
            }
            foreach (['technologies_items', 'integrations_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($_cd[$arr][$i]) || !is_array($item)) continue;
                        if (isset($item['label']) && strlen((string) $item['label'])) $_cd[$arr][$i]['label'] = $item['label'];
                    }
                }
            }
            if (!empty($db['audiences_items']) && is_array($db['audiences_items'])) {
                foreach ($db['audiences_items'] as $i => $item) {
                    if (!isset($_cd['audiences_items'][$i]) || !is_array($item)) continue;
                    foreach (array_keys($_cd['audiences_items'][$i]) as $k) {
                        if (isset($item[$k]) && strlen((string) $item[$k])) $_cd['audiences_items'][$i][$k] = $item[$k];
                    }
                }
            }
            foreach (['benefits_items', 'app_features_items', 'flow_items', 'how_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($_cd[$arr][$i]) || !is_array($item)) continue;
                        foreach (array_keys($_cd[$arr][$i]) as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $_cd[$arr][$i][$k] = $item[$k];
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

$_technologiesIcons = ['icon-view','icon-app','icon-car','icon-payment','icon-bars','icon-phone','icon-mobile-phone','icon-cloud'];
$_audiencesIcons = ['icon-office','icon-home','icon-office','icon-group','icon-infrastructure'];
$_benefitsIcons = ['icon-rocket','icon-security','icon-mobile-phone','icon-quality'];
$_appFeaturesIcons = ['icon-group','icon-app','icon-mobile-phone','icon-contrato','icon-exclamation'];
$_flowIcons = ['icon-group','icon-talk','icon-app','icon-security','icon-contrato'];
$_integrationsIcons = ['icon-view','icon-casino-cctv','icon-wifi','icon-globe','icon-diagram','icon-office'];
$_howIcons = ['icon-group','icon-view','icon-security','icon-inseguranca','icon-contrato'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><title>AserNet - Controle de Acesso Condominial</title><?php include ROOT . '/includes/assets.php'; ?></head>
<body>
<?php include ROOT . '/includes/header/header.php'; ?>

<main class="condo-access">
<section class="condo-access__hero"<?= !empty($_bn['imagem']) ? ' style="--hero-image:url(\'' . BASE_URL . '/images/banners/controleconcominial/' . htmlspecialchars($_bn['imagem']) . '\')"' : '' ?>><div class="container"><div class="row"><div class="col-lg-5 col-md-7"><div class="condo-access__hero-copy">
<h1><?=htmlspecialchars($_bn['titulo'])?> <?php if(!empty($_bn['titulo_destaque'])):?><strong><?=htmlspecialchars($_bn['titulo_destaque'])?></strong><?php endif;?> <?=htmlspecialchars($_bn['titulo_complemento'])?></h1>
<h2><?=htmlspecialchars($_bn['texto'])?></h2>
<?php foreach($_bn['bullets'] as $_bv):?><p><?=htmlspecialchars($_bv)?></p><?php endforeach;?>
<div><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-mobile-phone"></i><?=htmlspecialchars($_bn['btn1_texto'])?></a><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp"></i><?=htmlspecialchars($_bn['btn2_texto'])?></a></div>
</div></div></div></div></section>

<section class="condo-access__body"><div class="container">
<header class="condo-access__intro"><h2><?=htmlspecialchars($_cd['intro_titulo'])?></h2><p><?=htmlspecialchars($_cd['intro_texto'])?></p></header>

<section class="condo-access__section"><h2 class="condo-access__title"><?=htmlspecialchars($_cd['technologies_titulo'])?></h2><div class="condo-access__technologies"><?php foreach($_cd['technologies_items'] as $i=>$item):?><article><i class="<?= $_technologiesIcons[$i % count($_technologiesIcons)] ?>"></i><h3><?= htmlspecialchars($item['label']) ?></h3></article><?php endforeach;?></div></section>

<section class="condo-access__section"><h2 class="condo-access__title"><?=htmlspecialchars($_cd['audiences_titulo'])?></h2><div class="condo-access__audiences"><?php foreach($_cd['audiences_items'] as $i=>$item):?><article><img src="<?= BASE_URL ?>/images/controleacessocondominial/<?= htmlspecialchars($item['imagem']) ?>" alt="<?= htmlspecialchars($item['label']) ?>"><i class="<?= $_audiencesIcons[$i % count($_audiencesIcons)] ?>"></i><h3><?= htmlspecialchars($item['label']) ?></h3></article><?php endforeach;?></div></section>

<section class="condo-access__section"><h2 class="condo-access__title"><?=htmlspecialchars($_cd['benefits_titulo'])?></h2><div class="condo-access__benefits"><?php foreach($_cd['benefits_items'] as $i=>$item):?><article><i class="<?= $_benefitsIcons[$i % count($_benefitsIcons)] ?>"></i><div><h3><?= htmlspecialchars($item['titulo']) ?></h3><p><?= htmlspecialchars($item['texto']) ?></p></div></article><?php endforeach;?></div></section>

<section class="condo-access__app">
<div class="condo-access__app-phone"><img src="<?= BASE_URL ?>/images/controleacessocondominial/<?=htmlspecialchars($_cd['app_imagem'])?>" alt="Aplicativo do condomínio AserNet"></div>
<div class="condo-access__app-content"><h2><?=htmlspecialchars($_cd['app_titulo'])?></h2><div class="condo-access__app-features"><?php foreach($_cd['app_features_items'] as $i=>$item):?><article><i class="<?= $_appFeaturesIcons[$i % count($_appFeaturesIcons)] ?>"></i><h3><?= htmlspecialchars($item['titulo']) ?></h3><p><?= htmlspecialchars($item['texto']) ?></p></article><?php endforeach;?></div><div class="condo-access__stores"><a href="https://play.google.com/store/apps/details?id=br.com.asernet" target="_blank" rel="noopener"><img src="<?= BASE_URL ?>/images/controleacessocondominial/googleplay.png" alt="Disponível no Google Play"></a><a href="https://apps.apple.com/br/app/asernet/id6780853661" target="_blank" rel="noopener"><img src="<?= BASE_URL ?>/images/controleacessocondominial/applestore.png" alt="Disponível na App Store"></a><p><i class="icon-inseguranca"></i><?=htmlspecialchars($_cd['app_texto'])?></p></div></div>
</section>

<section class="condo-access__section"><h2 class="condo-access__title"><?=htmlspecialchars($_cd['flow_titulo'])?></h2><div class="condo-access__flow"><?php foreach($_cd['flow_items'] as $i=>$item):?><article><i class="<?= $_flowIcons[$i % count($_flowIcons)] ?>"></i><h3><?= htmlspecialchars($item['titulo']) ?></h3><p><?= htmlspecialchars($item['texto']) ?></p></article><?php endforeach;?></div></section>

<section class="condo-access__section"><h2 class="condo-access__title"><?=htmlspecialchars($_cd['integrations_titulo'])?></h2><div class="condo-access__integrations"><?php $_n = count($_cd['integrations_items']); foreach($_cd['integrations_items'] as $index=>$item):?><article><i class="<?= $_integrationsIcons[$index % count($_integrationsIcons)] ?>"></i><h3><?= htmlspecialchars($item['label']) ?></h3></article><?php if($index<$_n-2):?><b>+</b><?php elseif($index===$_n-2):?><b>=</b><?php endif;?><?php endforeach;?></div></section>

<section class="condo-access__equipment"><div><h2><?=htmlspecialchars($_cd['equipment_titulo'])?></h2><p><?=htmlspecialchars($_cd['equipment_texto'])?></p><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><?=htmlspecialchars($_cd['equipment_btn_texto'])?></a></div><img src="<?= BASE_URL ?>/images/controleacessocondominial/<?=htmlspecialchars($_cd['equipment_imagem'])?>" alt="Equipamentos Control iD"><img class="condo-access__control-logo" src="<?= BASE_URL ?>/images/controleacessocondominial/<?=htmlspecialchars($_cd['equipment_logo'])?>" alt="Control iD"></section>

<section class="condo-access__section"><h2 class="condo-access__title"><?=htmlspecialchars($_cd['how_titulo'])?></h2><div class="condo-access__how"><?php foreach($_cd['how_items'] as $i=>$item):?><article><b>✓</b><i class="<?= $_howIcons[$i % count($_howIcons)] ?>"></i><h3><?= htmlspecialchars($item['titulo']) ?></h3><p><?= htmlspecialchars($item['texto']) ?></p></article><?php endforeach;?></div></section>

<section class="condo-access__cta"><div><h2><?=htmlspecialchars($_cd['cta_titulo'])?><br><strong><?=htmlspecialchars($_cd['cta_titulo_destaque'])?></strong></h2><p><?=htmlspecialchars($_cd['cta_texto'])?></p></div><span></span><aside><a href="tel:08002225262"><i class="icon-phone"></i><?=htmlspecialchars($_cd['cta_btn1_texto'])?></a><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-mobile-phone"></i><?=htmlspecialchars($_cd['cta_btn2_texto'])?></a></aside></section>
</div></section>
</main>

<?php include ROOT . '/includes/footer/footer.php'; ?>
<?php include ROOT . '/includes/scripts.php'; ?>
</body></html>
