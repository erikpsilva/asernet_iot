<?php
$seoTitle = 'Condomínio Inteligente | AserNet IoT Services';
$seoDescription = 'Tecnologia, segurança e conectividade integradas para transformar a gestão e a rotina do seu condomínio.';
$solutions = [
    ['icon' => 'icon-casino-cctv', 'title' => 'Câmeras de segurança', 'text' => 'Monitoramento 24h com acesso remoto e gravação em nuvem.'],
    ['icon' => 'icon-view', 'title' => 'Controle de acesso', 'text' => 'Reconhecimento facial, biometria, tags e QR Code para moradores e visitantes.'],
    ['icon' => 'icon-wifi', 'title' => 'Wi-Fi para áreas comuns', 'text' => 'Internet rápida e estável para áreas comuns e ambientes do condomínio.'],
    ['icon' => 'icon-globe', 'title' => 'Internet dedicada', 'text' => 'Conexão de alta performance para todos os sistemas do condomínio.'],
    ['icon' => 'icon-mobile-phone', 'title' => 'Aplicativo do condomínio', 'text' => 'Acesso a reservas, avisos, ocorrências, visitantes e muito mais.'],
    ['icon' => 'icon-cloud', 'title' => 'Gestão inteligente', 'text' => 'Relatórios, históricos e informações na palma da mão.'],
];
$benefits = [
    ['icon' => 'icon-security', 'title' => 'Mais segurança', 'text' => 'Tecnologia integrada para monitorar acessos, áreas comuns e visitantes.', 'image' => 'imgMaisSeguraca.png'],
    ['icon' => 'icon-group', 'title' => 'Mais comodidade', 'text' => 'Moradores com acesso facilitado e serviços na palma da mão.', 'image' => 'imgMaisComodidade.png'],
    ['icon' => 'icon-diagram', 'title' => 'Mais gestão e controle', 'text' => 'Síndico com relatórios históricos e gestão centralizada.', 'image' => 'imgMaisGestaoControle.png'],
    ['icon' => 'icon-payment', 'title' => 'Valorização do patrimônio', 'text' => 'Mais tecnologia e estrutura aumentam o valor do seu condomínio.', 'image' => 'imgValorizacaoDoPadtrimonio.png'],
];
$integrations = [
    ['icon' => 'icon-casino-cctv', 'label' => 'Câmeras de segurança'],
    ['icon' => 'icon-view', 'label' => 'Controle de acesso'],
    ['icon' => 'icon-wifi', 'label' => 'Wi-Fi profissional'],
    ['icon' => 'icon-globe', 'label' => 'Internet dedicada'],
    ['icon' => 'icon-mobile-phone', 'label' => 'Aplicativo'],
    ['icon' => 'icon-office', 'label' => 'Condomínio inteligente'],
];
$steps = [
    ['icon' => 'icon-install', 'title' => 'Tecnologia instalada', 'text' => 'Instalamos todos os equipamentos e integramos as soluções.'],
    ['icon' => 'icon-cloud', 'title' => 'Dados na nuvem', 'text' => 'Informações armazenadas com segurança e alta disponibilidade.'],
    ['icon' => 'icon-mobile-phone', 'title' => 'Acesso remoto', 'text' => 'Gestão e monitoramento de qualquer lugar, pelo aplicativo ou web.'],
    ['icon' => 'icon-security', 'title' => 'Mais tranquilidade', 'text' => 'Mais segurança, agilidade e qualidade de vida para todos.'],
];
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
    <section class="smart-condo__hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-7">
                    <div class="smart-condo__hero-copy">
                        <h1>Condomínio <strong>Inteligente</strong></h1>
                        <h2>Mais segurança, praticidade e conectividade para o seu condomínio.</h2>
                        <p>Soluções integradas que conectam tecnologia, segurança e gestão para facilitar a rotina do síndico, valorizar o patrimônio e proporcionar mais tranquilidade para todos.</p>
                        <div class="smart-condo__hero-actions">
                            <a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-phone"></i>Solicitar apresentação</a>
                            <a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp"></i>Falar com um especialista</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="smart-condo__body">
        <div class="container">
            <section class="smart-condo__section smart-condo__complete">
                <h2 class="smart-condo__title">Uma solução completa e integrada</h2>
                <p class="smart-condo__subtitle">Tecnologias que se conectam para oferecer mais segurança, eficiência e comodidade<br>para síndicos, moradores, visitantes e prestadores de serviço.</p>
                <div class="smart-condo__solutions">
                    <?php foreach ($solutions as $solution): ?>
                    <article><i class="<?= $solution['icon'] ?>"></i><h3><?= htmlspecialchars($solution['title']) ?></h3><p><?= htmlspecialchars($solution['text']) ?></p></article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="smart-condo__section">
                <h2 class="smart-condo__title">Benefícios para todos</h2>
                <div class="smart-condo__benefits">
                    <?php foreach ($benefits as $benefit): ?>
                    <article style="--benefit-image:url('<?= BASE_URL ?>/images/condominiointeligente/<?= htmlspecialchars($benefit['image']) ?>')">
                        <div><i class="<?= $benefit['icon'] ?>"></i><h3><?= htmlspecialchars($benefit['title']) ?></h3><p><?= htmlspecialchars($benefit['text']) ?></p></div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="smart-condo__section">
                <h2 class="smart-condo__title">Soluções integradas</h2>
                <div class="smart-condo__integrations">
                    <?php foreach ($integrations as $index => $integration): ?>
                    <article><i class="<?= $integration['icon'] ?>"></i><h3><?= htmlspecialchars($integration['label']) ?></h3></article>
                    <?php if ($index < count($integrations) - 2): ?><b>+</b><?php elseif ($index === count($integrations) - 2): ?><b>=</b><?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="smart-condo__section">
                <h2 class="smart-condo__title">Como funciona na prática</h2>
                <div class="smart-condo__steps">
                    <?php foreach ($steps as $index => $step): ?>
                    <article><b><?= $index + 1 ?></b><i class="<?= $step['icon'] ?>"></i><h3><?= htmlspecialchars($step['title']) ?></h3><p><?= htmlspecialchars($step['text']) ?></p></article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="smart-condo__cta">
                <div class="smart-condo__cta-copy">
                    <h2>O futuro do seu condomínio<br><strong>começa agora.</strong></h2>
                    <p>Fale com nossa equipe e descubra como podemos transformar seu condomínio com tecnologia e segurança.</p>
                </div>
                <div class="smart-condo__cta-phone"></div>
                <div class="smart-condo__cta-actions">
                    <a href="tel:08002225262"><i class="icon-phone"></i>0800 222 5262</a>
                    <a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp"></i>Solicitar apresentação</a>
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