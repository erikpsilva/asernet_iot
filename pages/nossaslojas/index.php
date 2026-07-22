<?php
$seoTitle='Nossas Lojas | AserNet IoT Services';
$seoDescription='Encontre a loja AserNet mais próxima e conte com atendimento presencial, consultores especializados e suporte local.';

$_bn = [
    'titulo'             => 'Encontre a',
    'titulo_destaque'    => 'AserNet',
    'titulo_complemento' => 'mais perto de você.',
    'texto'              => 'Atendimento presencial, consultores especializados e suporte local para sua casa ou empresa.',
    'bullets'            => ['Atendimento humano: nossa equipe está pronta para te receber.', 'Soluções completas: internet, Wi-Fi, móvel, câmeras, segurança e muito mais.'],
    'preco'              => '',
    'btn1_texto'         => 'Falar com um consultor',
    'btn2_texto'         => '0800 222 5262',
    'imagem'             => '',
];
try {
    require_once ROOT . '/config/database.php';
    $_s_bn = getDbConnection()->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'nossaslojas_banner' LIMIT 1");
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

$_ns = [
    'section_titulo' => 'Nossas lojas',
    'section_texto'  => 'Visite uma de nossas unidades e descubra a melhor solução para você.',

    'stores' => [
        ['titulo' => 'Loja Centro', 'endereco' => 'R. Coronel João Cândido, 123', 'cidade' => 'Centro - Três Corações/MG', 'maps_query' => 'R. Coronel Joao Candido 123 Tres Coracoes MG', 'horario1' => 'Seg a Sex: 8h às 18h', 'horario2' => 'Sáb: 8h às 12h', 'imagem' => ''],
        ['titulo' => 'Loja Nova Três Corações', 'endereco' => 'Av. Rei Pelé, 620', 'cidade' => 'Nova Três Corações - Três Corações/MG', 'maps_query' => 'Av. Rei Pele 620 Tres Coracoes MG', 'horario1' => 'Seg a Sex: 8h às 18h', 'horario2' => 'Sáb: 8h às 12h', 'imagem' => ''],
        ['titulo' => 'Loja Santa Rita', 'endereco' => 'Rua Deputado Renato Azeredo, 210', 'cidade' => 'Santa Rita do Sapucaí/MG', 'maps_query' => 'Rua Deputado Renato Azeredo 210 Santa Rita do Sapucai MG', 'horario1' => 'Seg a Sex: 8h às 18h', 'horario2' => 'Sáb: 8h às 12h', 'imagem' => ''],
        ['titulo' => 'Loja Cambuí', 'endereco' => 'Av. José Álvares Maciel, 96', 'cidade' => 'Cambuí/MG', 'maps_query' => 'Av. Jose Alvares Maciel 96 Cambui MG', 'horario1' => 'Seg a Sex: 8h às 18h', 'horario2' => 'Sáb: 8h às 12h', 'imagem' => ''],
        ['titulo' => 'Loja Pouso Alegre', 'endereco' => 'Av. Prefeito Sapucaí, 1099', 'cidade' => 'Pouso Alegre/MG', 'maps_query' => 'Av. Prefeito Sapucai 1099 Pouso Alegre MG', 'horario1' => 'Seg a Sex: 8h às 18h', 'horario2' => 'Sáb: 8h às 12h', 'imagem' => ''],
    ],

    'expansion_titulo'          => 'Hoje são 5 lojas.',
    'expansion_titulo_destaque' => 'Em breve, ainda mais perto de você.',
    'expansion_texto'           => 'Nosso projeto é chegar a 10 lojas nos próximos 2 anos, levando tecnologia, atendimento e confiança para ainda mais cidades.',

    'closing_titulo'          => 'A tecnologia evolui. O atendimento local continua sendo nosso',
    'closing_titulo_destaque' => 'diferencial.',
    'closing_texto'           => 'Conte com a AserNet para conectar, proteger e simplificar sua vida com soluções inteligentes e atendimento de verdade.',
    'closing_imagem'          => 'imgUnidades.png',
];

try {
    require_once ROOT . '/config/database.php';
    $row = getDbConnection()->query("SELECT setting_value FROM system_settings WHERE setting_key = 'nossaslojas_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['section_titulo', 'section_texto',
                        'expansion_titulo', 'expansion_titulo_destaque', 'expansion_texto',
                        'closing_titulo', 'closing_titulo_destaque', 'closing_texto', 'closing_imagem'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $_ns[$k] = $db[$k];
            }
            if (!empty($db['stores']) && is_array($db['stores'])) {
                $stores = [];
                foreach ($db['stores'] as $item) {
                    if (!is_array($item) || empty($item['titulo'])) continue;
                    $stores[] = array_merge(['titulo' => '', 'endereco' => '', 'cidade' => '', 'maps_query' => '', 'horario1' => '', 'horario2' => '', 'imagem' => ''], $item);
                }
                if (!empty($stores)) $_ns['stores'] = $stores;
            }
        }
    }
} catch (Throwable $e) {}

$icons=['icon-wifi','icon-mobile-phone','icon-phone','icon-casino-cctv','icon-office','icon-security'];
$_bnIcons = ['icon-group', 'icon-security', 'icon-checkmark', 'icon-checkmark', 'icon-checkmark'];
?>
<!DOCTYPE html><html lang="pt-BR"><head><title>AserNet - Nossas Lojas</title><?php include ROOT.'/includes/assets.php';?></head><body>
<?php include ROOT.'/includes/header/header.php';?>
<main class="stores"><section class="stores__hero"<?= !empty($_bn['imagem']) ? ' style="--hero-image:url(\'' . BASE_URL . '/images/banners/nossaslojas/' . htmlspecialchars($_bn['imagem']) . '\')"' : '' ?>><div class="container"><div class="row align-items-center"><div class="col-lg-5 col-md-7"><div class="stores__hero-copy"><h1><?=htmlspecialchars($_bn['titulo'])?> <?php if(!empty($_bn['titulo_destaque'])):?><strong><?=htmlspecialchars($_bn['titulo_destaque'])?></strong><?php endif;?> <?=htmlspecialchars($_bn['titulo_complemento'])?></h1><p><?=htmlspecialchars($_bn['texto'])?></p>
<?php if(!empty($_bn['bullets'])):?><ul class="stores__hero-benefits"><?php foreach($_bn['bullets'] as $_bi=>$_bv):?><li><i class="<?=$_bnIcons[$_bi % count($_bnIcons)]?>"></i><span><?=htmlspecialchars($_bv)?></span></li><?php endforeach;?></ul><?php endif;?>
<?php if(!empty($_bn['preco'])):?><p class="stores__hero-price"><?=htmlspecialchars($_bn['preco'])?></p><?php endif;?>
<div class="stores__hero-actions"><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp"></i><?=htmlspecialchars($_bn['btn1_texto'])?></a><a href="tel:08002225262"><i class="icon-phone"></i><?=htmlspecialchars($_bn['btn2_texto'])?></a></div>
</div></div><div class="col-lg-7 col-md-5"></div></div></div></section>
<section class="stores__locations"><div class="container"><header class="stores__heading"><h2><?=htmlspecialchars($_ns['section_titulo'])?></h2><p><?=htmlspecialchars($_ns['section_texto'])?></p></header><div class="row stores__grid">
<?php foreach($_ns['stores'] as $i=>$store):
    $posMod = ($i % 5) + 1;
    $cardStyle = '';
    if (!empty($store['imagem'])) {
        $cardStyle = ' style="background-image:linear-gradient(180deg,transparent,rgba(0,12,38,.22)),url(\'' . BASE_URL . '/images/nossaslojas/' . htmlspecialchars($store['imagem']) . '\');background-position:center;background-size:cover;background-repeat:no-repeat"';
    }
?><div class="col-lg-4 col-md-6 stores__column"><article class="stores__card"><div class="stores__card-image<?= empty($store['imagem']) && $posMod > 1 ? ' stores__card-image--' . $posMod : '' ?>" role="img" aria-label="Fachada da <?=htmlspecialchars($store['titulo'])?>"<?=$cardStyle?>></div><div class="stores__card-body"><div class="stores__card-title"><b><?=$i+1?></b><h3><?=htmlspecialchars($store['titulo'])?></h3></div><div class="stores__info"><i class="icon-pin"></i><p><?=htmlspecialchars($store['endereco'])?><br><?=htmlspecialchars($store['cidade'])?></p></div><div class="stores__info"><i class="icon-clock"></i><p><?=htmlspecialchars($store['horario1'])?><br><?=htmlspecialchars($store['horario2'])?></p></div><div class="stores__actions"><a href="https://www.google.com/maps/search/?api=1&amp;query=<?=urlencode($store['maps_query'])?>" target="_blank" rel="noopener"><i class="icon-carpin"></i>Como chegar</a><a class="stores__whatsapp" href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp"></i>WhatsApp</a></div><div class="stores__services"><span>Serviços disponíveis</span><div><?php foreach($icons as $icon):?><i class="<?=$icon?>"></i><?php endforeach;?></div></div></div></article></div><?php endforeach;?>
<div class="col-lg-4 col-md-6 stores__column"><aside class="stores__expansion"><i class="icon-office stores__expansion-icon"></i><h2><?=htmlspecialchars($_ns['expansion_titulo'])?><br><strong><?=htmlspecialchars($_ns['expansion_titulo_destaque'])?></strong></h2><p><?=htmlspecialchars($_ns['expansion_texto'])?></p><div class="stores__route"><i class="icon-pin"></i><span></span><i class="icon-pin"></i><span></span><i class="icon-pin"></i><i class="icon-office"></i></div></aside></div></div>
<section class="stores__closing"><div class="stores__closing-image"<?= !empty($_ns['closing_imagem']) ? ' style="--closing-image:url(\'' . BASE_URL . '/images/nossaslojas/' . htmlspecialchars($_ns['closing_imagem']) . '\')"' : '' ?> role="img" aria-label="Família conectada com soluções AserNet"></div><div class="stores__closing-copy"><h2><?=htmlspecialchars($_ns['closing_titulo'])?> <strong><?=htmlspecialchars($_ns['closing_titulo_destaque'])?></strong></h2><p><?=htmlspecialchars($_ns['closing_texto'])?></p></div><div class="stores__closing-map"><i class="icon-pin"></i><i class="icon-pin"></i><i class="icon-pin"></i><i class="icon-pin"></i><i class="icon-pin"></i></div></section></div></section></main>
<?php include ROOT.'/includes/footer/footer.php';?><?php include ROOT.'/includes/scripts.php';?></body></html>
