<?php
$seoTitle = 'Controle de Acesso Corporativo | AserNet IoT Services';
$seoDescription = 'Controle colaboradores, visitantes e áreas restritas com reconhecimento facial, biometria, QR Code e gestão inteligente.';
$audiences = [
    ['icon'=>'icon-infrastructure','label'=>'Indústrias'], ['icon'=>'icon-clinic','label'=>'Hospitais'],
    ['icon'=>'icon-hotels','label'=>'Hotéis e pousadas'], ['icon'=>'icon-school','label'=>'Escolas e universidades'],
    ['icon'=>'icon-office','label'=>'Escritórios'], ['icon'=>'icon-group','label'=>'Clubes e associações'],
];
$technologies = [
    ['icon'=>'icon-view','label'=>'Reconhecimento facial'], ['icon'=>'icon-checkmark','label'=>'Biometria'],
    ['icon'=>'icon-payment','label'=>'Cartão RFID'], ['icon'=>'icon-app','label'=>'QR Code'],
    ['icon'=>'icon-bars','label'=>'Senhas'], ['icon'=>'icon-structure','label'=>'Catracas'],
    ['icon'=>'icon-mobile-phone','label'=>'Fechaduras eletrônicas'], ['icon'=>'icon-cloud','label'=>'Gestão em nuvem'],
];
$gains = [
    ['icon'=>'icon-security','title'=>'Mais segurança','text'=>'Controle total de acessos e proteção de pessoas e patrimônios.'],
    ['icon'=>'icon-contrato','title'=>'Mais controle','text'=>'Registro completo das movimentações e gestão em tempo real.'],
    ['icon'=>'icon-diagram','title'=>'Mais produtividade','text'=>'Automação dos processos de entrada e redução de tarefas manuais.'],
    ['icon'=>'icon-acompanhamento','title'=>'Mais auditoria','text'=>'Histórico detalhado e relatórios para auditorias internas e externas.'],
];
$applications = [
    ['image'=>'imgControleDeColaboradores.png','icon'=>'icon-group','title'=>'Controle de colaboradores','text'=>'Gestão de entradas e saídas com mais eficiência.'],
    ['image'=>'imgControleDeVisitantes.png','icon'=>'icon-empresapessoas','title'=>'Controle de visitantes','text'=>'Cadastro e autorização simplificados e seguros.'],
    ['image'=>'imgAreasRestritas.png','icon'=>'icon-inseguranca','title'=>'Áreas restritas','text'=>'Proteção de ambientes sensíveis e críticos.'],
    ['image'=>'imgPrestadoresDeServicos.png','icon'=>'icon-contrato','title'=>'Prestadores de serviço','text'=>'Controle temporário e rastreável de acessos.'],
];
$integrations = [
    ['icon'=>'icon-view','label'=>'Controle de acesso'], ['icon'=>'icon-casino-cctv','label'=>'Câmeras de segurança'],
    ['icon'=>'icon-globe','label'=>'Internet corporativa'], ['icon'=>'icon-wifipro','label'=>'Wi-Fi Pro'],
    ['icon'=>'icon-phone','label'=>'Telefonia empresarial'],
];
$steps = [
    ['icon'=>'icon-group','title'=>'Identificação','text'=>'Usuário se identifica por biometria, cartão, QR Code, senha ou facial.'],
    ['icon'=>'icon-security','title'=>'Validação','text'=>'Sistema verifica as permissões em tempo real.'],
    ['icon'=>'icon-inseguranca','title'=>'Liberação','text'=>'Portas, catracas ou cancelas são liberadas automaticamente.'],
    ['icon'=>'icon-contrato','title'=>'Registro','text'=>'Todas as movimentações são registradas com data, hora e local.'],
    ['icon'=>'icon-diagram','title'=>'Relatórios','text'=>'Relatórios completos para gestão e tomada de decisões.'],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><title>AserNet - Controle de Acesso Corporativo</title><?php include ROOT . '/includes/assets.php'; ?></head>
<body>
<?php include ROOT . '/includes/header/header.php'; ?>

<main class="corporate-access">
<section class="corporate-access__hero"><div class="container"><div class="row"><div class="col-lg-5 col-md-7"><div class="corporate-access__hero-copy">
<h1>Controle de acesso <strong>corporativo</strong></h1>
<h2>Controle colaboradores, visitantes e áreas restritas com tecnologia inteligente.</h2>
<p>Mais segurança, praticidade e eficiência para empresas, indústrias, hospitais, escolas e instituições.</p>
<div class="corporate-access__hero-actions"><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-group"></i>Solicitar apresentação</a><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp"></i>Falar com especialista</a></div>
<div class="corporate-access__partner"><span>Parceiro oficial</span><img src="<?= BASE_URL ?>/images/controleacessocorporativo/logoControlID.png" alt="Control iD"><p>Padrão de tecnologia em segurança, integração e gestão.</p></div>
</div></div></div></div></section>

<section class="corporate-access__body"><div class="container">
<header class="corporate-access__intro"><h2>Quem entra. Quando entra. Onde entra.</h2><p>A AserNet IoT Services oferece soluções completas de controle de acesso corporativo utilizando<br>tecnologia Control iD, permitindo gerenciar acessos, registrar movimentações e proteger áreas críticas da sua operação.</p></header>

<section class="corporate-access__section"><h2 class="corporate-access__title">Ideal para</h2><div class="corporate-access__audiences"><?php foreach($audiences as $item):?><article><i class="<?= $item['icon'] ?>"></i><h3><?= htmlspecialchars($item['label']) ?></h3></article><?php endforeach;?></div></section>
<section class="corporate-access__section"><h2 class="corporate-access__title">Tecnologias disponíveis</h2><div class="corporate-access__technologies"><?php foreach($technologies as $item):?><article><i class="<?= $item['icon'] ?>"></i><h3><?= htmlspecialchars($item['label']) ?></h3></article><?php endforeach;?></div></section>
<section class="corporate-access__section"><h2 class="corporate-access__title">O que sua empresa ganha?</h2><div class="corporate-access__gains"><?php foreach($gains as $item):?><article><i class="<?= $item['icon'] ?>"></i><h3><?= htmlspecialchars($item['title']) ?></h3><p><?= htmlspecialchars($item['text']) ?></p></article><?php endforeach;?></div></section>

<section class="corporate-access__section"><h2 class="corporate-access__title">Aplicações</h2><div class="corporate-access__applications"><?php foreach($applications as $item):?><article><img src="<?= BASE_URL ?>/images/controleacessocorporativo/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>"><i class="<?= $item['icon'] ?>"></i><h3><?= htmlspecialchars($item['title']) ?></h3><p><?= htmlspecialchars($item['text']) ?></p></article><?php endforeach;?></div></section>

<section class="corporate-access__integration"><div><h2>Integração com<br>outros sistemas</h2><p>Uma infraestrutura integrada oferece mais segurança e gestão para sua empresa.</p></div><section><?php foreach($integrations as $index=>$item):?><article><i class="<?= $item['icon'] ?>"></i><h3><?= htmlspecialchars($item['label']) ?></h3></article><?php if($index<count($integrations)-1):?><b>→</b><?php endif;?><?php endforeach;?></section></section>

<section class="corporate-access__equipment"><div><h2>Equipamentos profissionais <strong>Control iD</strong></h2><p>Utilizamos equipamentos Control iD, referência nacional em controle de acesso corporativo.</p><a href="https://wa.me/5508002225262" target="_blank" rel="noopener">Conheça os equipamentos</a></div><img src="<?= BASE_URL ?>/images/controleacessocorporativo/imgEquipamentosProffisionais.png" alt="Equipamentos profissionais Control iD"></section>

<section class="corporate-access__section corporate-access__process"><h2 class="corporate-access__title">Como funciona</h2><div class="corporate-access__steps"><?php foreach($steps as $index=>$item):?><article><b><?= $index+1 ?></b><i class="<?= $item['icon'] ?>"></i><h3><?= htmlspecialchars($item['title']) ?></h3><p><?= htmlspecialchars($item['text']) ?></p></article><?php endforeach;?></div></section>

<section class="corporate-access__cta"><div><h2>Sua empresa mais segura,<br><strong>organizada e eficiente.</strong></h2><p>Solicite um projeto personalizado com especialistas da AserNet IoT Services.</p><aside><a href="tel:08002225262"><i class="icon-phone"></i>0800 222 5262</a><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-mobile-phone"></i>Solicitar apresentação</a></aside></div><span></span></section>
</div></section>
</main>

<?php include ROOT . '/includes/footer/footer.php'; ?>
<?php include ROOT . '/includes/scripts.php'; ?>
</body></html>