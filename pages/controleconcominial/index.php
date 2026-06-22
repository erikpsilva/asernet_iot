<?php
$seoTitle = 'Controle de Acesso Condominial | AserNet IoT Services';
$seoDescription = 'Controle de acesso condominial com reconhecimento facial, QR Code, placas veiculares, aplicativo e gestão em nuvem.';
$technologies = [
    ['icon'=>'icon-view','label'=>'Reconhecimento facial'], ['icon'=>'icon-app','label'=>'QR Code'],
    ['icon'=>'icon-car','label'=>'Placas veiculares'], ['icon'=>'icon-payment','label'=>'Cartões RFID'],
    ['icon'=>'icon-bars','label'=>'Códigos PIN'], ['icon'=>'icon-phone','label'=>'Interfone IP'],
    ['icon'=>'icon-mobile-phone','label'=>'Aplicativo'], ['icon'=>'icon-cloud','label'=>'Gestão em nuvem'],
];
$audiences = [
    ['image'=>'imgCondominiosVerticais.png','icon'=>'icon-office','label'=>'Condomínios verticais'],
    ['image'=>'imgCondominiosHorizontais.png','icon'=>'icon-home','label'=>'Condomínios horizontais'],
    ['image'=>'imgLoteamentoFechados.png','icon'=>'icon-office','label'=>'Loteamentos fechados'],
    ['image'=>'associacoesDeMoradores.png','icon'=>'icon-group','label'=>'Associações de moradores'],
    ['image'=>'imgEmpresasEscritorios.png','icon'=>'icon-infrastructure','label'=>'Empresas e escritórios'],
];
$benefits = [
    ['icon'=>'icon-rocket','title'=>'Entrada sem senha','text'=>'Acesso por biometria, QR Code ou aplicativo.'],
    ['icon'=>'icon-security','title'=>'Mais segurança','text'=>'Controle de entradas e saídas em tempo real.'],
    ['icon'=>'icon-mobile-phone','title'=>'Histórico completo','text'=>'Libere acessos de onde estiver.'],
    ['icon'=>'icon-quality','title'=>'Mais valorização','text'=>'Valorização do condomínio e patrimônio.'],
];
$appFeatures = [
    ['icon'=>'icon-group','title'=>'Visitas','text'=>'Autorize visitas de qualquer lugar.'],
    ['icon'=>'icon-app','title'=>'Reservas de áreas comuns','text'=>'Praticidade na palma da mão.'],
    ['icon'=>'icon-mobile-phone','title'=>'Abertura remota','text'=>'Libere acessos de onde estiver.'],
    ['icon'=>'icon-contrato','title'=>'Comunicados','text'=>'Envie avisos e informações importantes.'],
    ['icon'=>'icon-exclamation','title'=>'Notificações','text'=>'Receba alertas em tempo real.'],
];
$visitorFlow = [
    ['icon'=>'icon-group','title'=>'Solicitação da visita','text'=>'Pré-cadastro feito pelo morador ou síndico.'],
    ['icon'=>'icon-talk','title'=>'Envio do link ou QR Code','text'=>'O visitante recebe por e-mail ou WhatsApp.'],
    ['icon'=>'icon-app','title'=>'Chegada ao condomínio','text'=>'Acesso rápido e seguro na portaria.'],
    ['icon'=>'icon-security','title'=>'Acesso autorizado','text'=>'Liberação feita de onde estiver.'],
    ['icon'=>'icon-contrato','title'=>'Histórico e relatórios','text'=>'Acompanhamento completo e seguro.'],
];
$integrations = [
    ['icon'=>'icon-view','label'=>'Controle de acesso'], ['icon'=>'icon-casino-cctv','label'=>'Câmeras de segurança'],
    ['icon'=>'icon-wifi','label'=>'Wi-Fi para áreas comuns'], ['icon'=>'icon-globe','label'=>'Internet dedicada'],
    ['icon'=>'icon-diagram','label'=>'Gestão inteligente'], ['icon'=>'icon-office','label'=>'Condomínio inteligente'],
];
$how = [
    ['icon'=>'icon-group','title'=>'Cadastro','text'=>'Cadastre moradores, visitantes e veículos.'],
    ['icon'=>'icon-view','title'=>'Envio do link','text'=>'QR Code enviado por e-mail ou WhatsApp.'],
    ['icon'=>'icon-security','title'=>'Liberação','text'=>'Liberação de acesso pelo sistema ou aplicativo.'],
    ['icon'=>'icon-inseguranca','title'=>'Entrada','text'=>'Acesso autorizado com tecnologia segura.'],
    ['icon'=>'icon-contrato','title'=>'Registro','text'=>'Tudo registrado em tempo real na nuvem.'],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><title>AserNet - Controle de Acesso Condominial</title><?php include ROOT . '/includes/assets.php'; ?></head>
<body>
<?php include ROOT . '/includes/header/header.php'; ?>

<main class="condo-access">
<section class="condo-access__hero"><div class="container"><div class="row"><div class="col-lg-5 col-md-7"><div class="condo-access__hero-copy">
<h1>Controle de acesso <strong>condominial</strong></h1>
<h2>Mais segurança, praticidade e tecnologia para o seu condomínio, na palma da sua mão.</h2>
<p>Controle e reserve, registre e libere o acesso de moradores, visitantes e veículos de onde estiver.</p>
<div><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-mobile-phone"></i>Solicitar apresentação</a><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp"></i>Falar com um especialista</a></div>
</div></div></div></div></section>

<section class="condo-access__body"><div class="container">
<header class="condo-access__intro"><h2>Segurança e comodidade para todos</h2><p>Nosso sistema integra segurança, tecnologia e praticidade para gerenciar acessos e reservas,<br>valorizando o patrimônio e proporcionando tranquilidade para todos.</p></header>

<section class="condo-access__section"><h2 class="condo-access__title">Tecnologias disponíveis</h2><div class="condo-access__technologies"><?php foreach($technologies as $item):?><article><i class="<?= $item['icon'] ?>"></i><h3><?= htmlspecialchars($item['label']) ?></h3></article><?php endforeach;?></div></section>

<section class="condo-access__section"><h2 class="condo-access__title">Ideal para</h2><div class="condo-access__audiences"><?php foreach($audiences as $item):?><article><img src="<?= BASE_URL ?>/images/controleacessocondominial/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['label']) ?>"><i class="<?= $item['icon'] ?>"></i><h3><?= htmlspecialchars($item['label']) ?></h3></article><?php endforeach;?></div></section>

<section class="condo-access__section"><h2 class="condo-access__title">Benefícios para moradores</h2><div class="condo-access__benefits"><?php foreach($benefits as $item):?><article><i class="<?= $item['icon'] ?>"></i><div><h3><?= htmlspecialchars($item['title']) ?></h3><p><?= htmlspecialchars($item['text']) ?></p></div></article><?php endforeach;?></div></section>

<section class="condo-access__app">
<div class="condo-access__app-phone"><img src="<?= BASE_URL ?>/images/controleacessocondominial/imgAplicativoDoCondomino.png" alt="Aplicativo do condomínio AserNet"></div>
<div class="condo-access__app-content"><h2>Aplicativo do condomínio</h2><div class="condo-access__app-features"><?php foreach($appFeatures as $item):?><article><i class="<?= $item['icon'] ?>"></i><h3><?= htmlspecialchars($item['title']) ?></h3><p><?= htmlspecialchars($item['text']) ?></p></article><?php endforeach;?></div><div class="condo-access__stores"><img src="<?= BASE_URL ?>/images/controleacessocondominial/googleplay.png" alt="Disponível no Google Play"><img src="<?= BASE_URL ?>/images/controleacessocondominial/applestore.png" alt="Disponível na App Store"><p><i class="icon-inseguranca"></i>Baixe o aplicativo e tenha o seu condomínio na palma da mão.</p></div></div>
</section>

<section class="condo-access__section"><h2 class="condo-access__title">Controle completo de visitantes</h2><div class="condo-access__flow"><?php foreach($visitorFlow as $item):?><article><i class="<?= $item['icon'] ?>"></i><h3><?= htmlspecialchars($item['title']) ?></h3><p><?= htmlspecialchars($item['text']) ?></p></article><?php endforeach;?></div></section>

<section class="condo-access__section"><h2 class="condo-access__title">Integração com outras soluções</h2><div class="condo-access__integrations"><?php foreach($integrations as $index=>$item):?><article><i class="<?= $item['icon'] ?>"></i><h3><?= htmlspecialchars($item['label']) ?></h3></article><?php if($index<count($integrations)-2):?><b>+</b><?php elseif($index===count($integrations)-2):?><b>=</b><?php endif;?><?php endforeach;?></div></section>

<section class="condo-access__equipment"><div><h2>Soluções Control iD</h2><p>Soluções completas para todos os tipos de controle de acesso.</p><a href="https://wa.me/5508002225262" target="_blank" rel="noopener">Conheça os equipamentos</a></div><img src="<?= BASE_URL ?>/images/controleacessocondominial/imgSolucoes.png" alt="Equipamentos Control iD"><img class="condo-access__control-logo" src="<?= BASE_URL ?>/images/controleacessocondominial/logoControlID.png" alt="Control iD"></section>

<section class="condo-access__section"><h2 class="condo-access__title">Como funciona</h2><div class="condo-access__how"><?php foreach($how as $index=>$item):?><article><b>✓</b><i class="<?= $item['icon'] ?>"></i><h3><?= htmlspecialchars($item['title']) ?></h3><p><?= htmlspecialchars($item['text']) ?></p></article><?php endforeach;?></div></section>

<section class="condo-access__cta"><div><h2>Seu condomínio mais<br><strong>moderno, seguro e conectado.</strong></h2><p>Solicite uma apresentação e descubra como podemos transformar a gestão de acessos.</p></div><span></span><aside><a href="tel:08002225262"><i class="icon-phone"></i>0800 222 5262</a><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-mobile-phone"></i>Solicitar apresentação</a></aside></section>
</div></section>
</main>

<?php include ROOT . '/includes/footer/footer.php'; ?>
<?php include ROOT . '/includes/scripts.php'; ?>
</body></html>