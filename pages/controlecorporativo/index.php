<?php
$seoTitle = 'Controle de Acesso Corporativo | AserNet IoT Services';
$seoDescription = 'Controle colaboradores, visitantes e áreas restritas com reconhecimento facial, biometria, QR Code e gestão inteligente.';

$_bn = [
    'titulo'             => 'Controle de acesso',
    'titulo_destaque'    => 'corporativo',
    'titulo_complemento' => '',
    'texto'              => 'Controle colaboradores, visitantes e áreas restritas com tecnologia inteligente.',
    'bullets'            => ['Mais segurança, praticidade e eficiência para empresas, indústrias, hospitais, escolas e instituições.'],
    'preco'              => '',
    'btn1_texto'         => 'Solicitar apresentação',
    'btn2_texto'         => 'Falar com especialista',
    'imagem'             => '',
];
try {
    require_once ROOT . '/config/database.php';
    $_s_bn = getDbConnection()->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'controlecorporativo_banner' LIMIT 1");
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

$_cc = [
    'partner_label'  => 'Parceiro oficial',
    'partner_texto'  => 'Padrão de tecnologia em segurança, integração e gestão.',
    'partner_imagem' => 'logoControlID.png',

    'intro_titulo' => 'Quem entra. Quando entra. Onde entra.',
    'intro_texto'  => 'A AserNet IoT Services oferece soluções completas de controle de acesso corporativo utilizando tecnologia Control iD, permitindo gerenciar acessos, registrar movimentações e proteger áreas críticas da sua operação.',

    'audiences_titulo' => 'Ideal para',
    'audiences_items' => [
        ['label' => 'Indústrias'], ['label' => 'Hospitais'], ['label' => 'Hotéis e pousadas'],
        ['label' => 'Escolas e universidades'], ['label' => 'Escritórios'], ['label' => 'Clubes e associações'],
    ],

    'technologies_titulo' => 'Tecnologias disponíveis',
    'technologies_items' => [
        ['label' => 'Reconhecimento facial'], ['label' => 'Biometria'], ['label' => 'Cartão RFID'], ['label' => 'QR Code'],
        ['label' => 'Senhas'], ['label' => 'Catracas'], ['label' => 'Fechaduras eletrônicas'], ['label' => 'Gestão em nuvem'],
    ],

    'gains_titulo' => 'O que sua empresa ganha?',
    'gains_items' => [
        ['titulo' => 'Mais segurança', 'texto' => 'Controle total de acessos e proteção de pessoas e patrimônios.'],
        ['titulo' => 'Mais controle', 'texto' => 'Registro completo das movimentações e gestão em tempo real.'],
        ['titulo' => 'Mais produtividade', 'texto' => 'Automação dos processos de entrada e redução de tarefas manuais.'],
        ['titulo' => 'Mais auditoria', 'texto' => 'Histórico detalhado e relatórios para auditorias internas e externas.'],
    ],

    'applications_titulo' => 'Aplicações',
    'applications_items' => [
        ['titulo' => 'Controle de colaboradores', 'texto' => 'Gestão de entradas e saídas com mais eficiência.', 'imagem' => 'imgControleDeColaboradores.png'],
        ['titulo' => 'Controle de visitantes', 'texto' => 'Cadastro e autorização simplificados e seguros.', 'imagem' => 'imgControleDeVisitantes.png'],
        ['titulo' => 'Áreas restritas', 'texto' => 'Proteção de ambientes sensíveis e críticos.', 'imagem' => 'imgAreasRestritas.png'],
        ['titulo' => 'Prestadores de serviço', 'texto' => 'Controle temporário e rastreável de acessos.', 'imagem' => 'imgPrestadoresDeServicos.png'],
    ],

    'integration_titulo' => 'Integração com outros sistemas',
    'integration_texto'  => 'Uma infraestrutura integrada oferece mais segurança e gestão para sua empresa.',
    'integration_items' => [
        ['label' => 'Controle de acesso'], ['label' => 'Câmeras de segurança'], ['label' => 'Internet corporativa'],
        ['label' => 'Wi-Fi Pro'], ['label' => 'Telefonia empresarial'],
    ],

    'equipment_titulo'          => 'Equipamentos profissionais',
    'equipment_titulo_destaque' => 'Control iD',
    'equipment_texto'           => 'Utilizamos equipamentos Control iD, referência nacional em controle de acesso corporativo.',
    'equipment_btn_texto'       => 'Conheça os equipamentos',
    'equipment_imagem'          => 'imgEquipamentosProffisionais.png',

    'steps_titulo' => 'Como funciona',
    'steps_items' => [
        ['titulo' => 'Identificação', 'texto' => 'Usuário se identifica por biometria, cartão, QR Code, senha ou facial.'],
        ['titulo' => 'Validação', 'texto' => 'Sistema verifica as permissões em tempo real.'],
        ['titulo' => 'Liberação', 'texto' => 'Portas, catracas ou cancelas são liberadas automaticamente.'],
        ['titulo' => 'Registro', 'texto' => 'Todas as movimentações são registradas com data, hora e local.'],
        ['titulo' => 'Relatórios', 'texto' => 'Relatórios completos para gestão e tomada de decisões.'],
    ],

    'cta_titulo'          => 'Sua empresa mais segura,',
    'cta_titulo_destaque' => 'organizada e eficiente.',
    'cta_texto'           => 'Solicite um projeto personalizado com especialistas da AserNet IoT Services.',
    'cta_btn1_texto'      => '0800 222 5262',
    'cta_btn2_texto'      => 'Solicitar apresentação',
];

try {
    require_once ROOT . '/config/database.php';
    $row = getDbConnection()->query("SELECT setting_value FROM system_settings WHERE setting_key = 'controlecorporativo_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['partner_label', 'partner_texto', 'partner_imagem',
                        'intro_titulo', 'intro_texto',
                        'audiences_titulo', 'technologies_titulo', 'gains_titulo', 'applications_titulo',
                        'integration_titulo', 'integration_texto',
                        'equipment_titulo', 'equipment_titulo_destaque', 'equipment_texto', 'equipment_btn_texto', 'equipment_imagem',
                        'steps_titulo',
                        'cta_titulo', 'cta_titulo_destaque', 'cta_texto', 'cta_btn1_texto', 'cta_btn2_texto'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $_cc[$k] = $db[$k];
            }
            foreach (['audiences_items', 'technologies_items', 'integration_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($_cc[$arr][$i]) || !is_array($item)) continue;
                        if (isset($item['label']) && strlen((string) $item['label'])) $_cc[$arr][$i]['label'] = $item['label'];
                    }
                }
            }
            foreach (['gains_items', 'applications_items', 'steps_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($_cc[$arr][$i]) || !is_array($item)) continue;
                        foreach (array_keys($_cc[$arr][$i]) as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $_cc[$arr][$i][$k] = $item[$k];
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

$_audienceIcons = ['icon-infrastructure','icon-clinic','icon-hotels','icon-school','icon-office','icon-group'];
$_techIcons = ['icon-view','icon-checkmark','icon-payment','icon-app','icon-bars','icon-structure','icon-mobile-phone','icon-cloud'];
$_gainIcons = ['icon-security','icon-contrato','icon-diagram','icon-acompanhamento'];
$_appIcons = ['icon-group','icon-empresapessoas','icon-inseguranca','icon-contrato'];
$_integrationIcons = ['icon-view','icon-casino-cctv','icon-globe','icon-wifipro','icon-phone'];
$_stepIcons = ['icon-group','icon-security','icon-inseguranca','icon-contrato','icon-diagram'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><title>AserNet - Controle de Acesso Corporativo</title><?php include ROOT . '/includes/assets.php'; ?></head>
<body>
<?php include ROOT . '/includes/header/header.php'; ?>

<main class="corporate-access">
<section class="corporate-access__hero"<?= !empty($_bn['imagem']) ? ' style="--hero-image:url(\'' . BASE_URL . '/images/banners/controlecorporativo/' . htmlspecialchars($_bn['imagem']) . '\')"' : '' ?>><div class="container"><div class="row"><div class="col-lg-5 col-md-7"><div class="corporate-access__hero-copy">
<h1><?=htmlspecialchars($_bn['titulo'])?> <?php if(!empty($_bn['titulo_destaque'])):?><strong><?=htmlspecialchars($_bn['titulo_destaque'])?></strong><?php endif;?> <?=htmlspecialchars($_bn['titulo_complemento'])?></h1>
<h2><?=htmlspecialchars($_bn['texto'])?></h2>
<?php foreach($_bn['bullets'] as $_bv):?><p><?=htmlspecialchars($_bv)?></p><?php endforeach;?>
<div class="corporate-access__hero-actions"><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-group"></i><?=htmlspecialchars($_bn['btn1_texto'])?></a><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp"></i><?=htmlspecialchars($_bn['btn2_texto'])?></a></div>
<div class="corporate-access__partner"><span><?=htmlspecialchars($_cc['partner_label'])?></span><img src="<?= BASE_URL ?>/images/controleacessocorporativo/<?=htmlspecialchars($_cc['partner_imagem'])?>" alt="Control iD"><p><?=htmlspecialchars($_cc['partner_texto'])?></p></div>
</div></div></div></div></section>

<section class="corporate-access__body"><div class="container">
<header class="corporate-access__intro"><h2><?=htmlspecialchars($_cc['intro_titulo'])?></h2><p><?=htmlspecialchars($_cc['intro_texto'])?></p></header>

<section class="corporate-access__section"><h2 class="corporate-access__title"><?=htmlspecialchars($_cc['audiences_titulo'])?></h2><div class="corporate-access__audiences"><?php foreach($_cc['audiences_items'] as $i=>$item):?><article><i class="<?=$_audienceIcons[$i % count($_audienceIcons)]?>"></i><h3><?=htmlspecialchars($item['label'])?></h3></article><?php endforeach;?></div></section>
<section class="corporate-access__section"><h2 class="corporate-access__title"><?=htmlspecialchars($_cc['technologies_titulo'])?></h2><div class="corporate-access__technologies"><?php foreach($_cc['technologies_items'] as $i=>$item):?><article><i class="<?=$_techIcons[$i % count($_techIcons)]?>"></i><h3><?=htmlspecialchars($item['label'])?></h3></article><?php endforeach;?></div></section>
<section class="corporate-access__section"><h2 class="corporate-access__title"><?=htmlspecialchars($_cc['gains_titulo'])?></h2><div class="corporate-access__gains"><?php foreach($_cc['gains_items'] as $i=>$item):?><article><i class="<?=$_gainIcons[$i % count($_gainIcons)]?>"></i><h3><?=htmlspecialchars($item['titulo'])?></h3><p><?=htmlspecialchars($item['texto'])?></p></article><?php endforeach;?></div></section>

<section class="corporate-access__section"><h2 class="corporate-access__title"><?=htmlspecialchars($_cc['applications_titulo'])?></h2><div class="corporate-access__applications"><?php foreach($_cc['applications_items'] as $i=>$item):?><article><img src="<?= BASE_URL ?>/images/controleacessocorporativo/<?=htmlspecialchars($item['imagem'])?>" alt="<?=htmlspecialchars($item['titulo'])?>"><i class="<?=$_appIcons[$i % count($_appIcons)]?>"></i><h3><?=htmlspecialchars($item['titulo'])?></h3><p><?=htmlspecialchars($item['texto'])?></p></article><?php endforeach;?></div></section>

<section class="corporate-access__integration"><div><h2><?=htmlspecialchars($_cc['integration_titulo'])?></h2><p><?=htmlspecialchars($_cc['integration_texto'])?></p></div><section><?php foreach($_cc['integration_items'] as $index=>$item):?><article><i class="<?=$_integrationIcons[$index % count($_integrationIcons)]?>"></i><h3><?=htmlspecialchars($item['label'])?></h3></article><?php if($index<count($_cc['integration_items'])-1):?><b>→</b><?php endif;?><?php endforeach;?></section></section>

<section class="corporate-access__equipment"><div><h2><?=htmlspecialchars($_cc['equipment_titulo'])?> <strong><?=htmlspecialchars($_cc['equipment_titulo_destaque'])?></strong></h2><p><?=htmlspecialchars($_cc['equipment_texto'])?></p><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><?=htmlspecialchars($_cc['equipment_btn_texto'])?></a></div><img src="<?= BASE_URL ?>/images/controleacessocorporativo/<?=htmlspecialchars($_cc['equipment_imagem'])?>" alt="Equipamentos profissionais Control iD"></section>

<section class="corporate-access__section corporate-access__process"><h2 class="corporate-access__title"><?=htmlspecialchars($_cc['steps_titulo'])?></h2><div class="corporate-access__steps"><?php foreach($_cc['steps_items'] as $index=>$item):?><article><b><?=$index+1?></b><i class="<?=$_stepIcons[$index % count($_stepIcons)]?>"></i><h3><?=htmlspecialchars($item['titulo'])?></h3><p><?=htmlspecialchars($item['texto'])?></p></article><?php endforeach;?></div></section>

<section class="corporate-access__cta"><div><h2><?=htmlspecialchars($_cc['cta_titulo'])?><br><strong><?=htmlspecialchars($_cc['cta_titulo_destaque'])?></strong></h2><p><?=htmlspecialchars($_cc['cta_texto'])?></p><aside><a href="tel:08002225262"><i class="icon-phone"></i><?=htmlspecialchars($_cc['cta_btn1_texto'])?></a><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-mobile-phone"></i><?=htmlspecialchars($_cc['cta_btn2_texto'])?></a></aside></div><span></span></section>
</div></section>
</main>

<?php include ROOT . '/includes/footer/footer.php'; ?>
<?php include ROOT . '/includes/scripts.php'; ?>
</body></html>
