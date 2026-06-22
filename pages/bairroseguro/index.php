<?php
$seoTitle = 'Bairro Seguro | AserNet IoT Services';
$seoDescription = 'Segurança compartilhada com câmeras estrategicamente posicionadas, gravação em nuvem e acesso remoto para bairros, condomínios e comunidades.';
$steps = [
    ['image' => 'imgInstalacaodeCameras.png', 'title' => 'Instalação das câmeras', 'text' => 'Câmeras posicionadas em pontos estratégicos.'],
    ['image' => 'imgGravacaoEmNuvem.png', 'title' => 'Gravação em nuvem', 'text' => 'Imagens armazenadas de forma segura e confiável.'],
    ['image' => 'imgAcessoRemoto.png', 'title' => 'Acesso remoto', 'text' => 'Consulta das imagens por aplicativo, de onde você estiver.'],
    ['image' => 'imgMaisSeguranca.png', 'title' => 'Mais segurança', 'text' => 'Maior controle, prevenção e sensação de proteção para todos.'],
];
$audiences = [
    ['icon' => 'icon-home', 'label' => 'Bairros residenciais'],
    ['icon' => 'icon-group', 'label' => 'Associações de moradores'],
    ['icon' => 'icon-office', 'label' => 'Condomínios'],
    ['icon' => 'icon-infrastructure', 'label' => 'Distritos industriais'],
    ['icon' => 'icon-construcao', 'label' => 'Loteamentos'],
    ['icon' => 'icon-globe', 'label' => 'Áreas rurais'],
];
$included = ['Projeto e implantação personalizada', 'Câmeras de segurança de alta qualidade', 'Infraestrutura de rede dedicada', 'Gravação em nuvem com alta disponibilidade', 'Manutenção preventiva', 'Suporte especializado', 'Aplicativo de acesso remoto'];
$advantages = [
    ['icon' => 'icon-security', 'title' => 'Mais segurança', 'text' => 'Maior controle dos acessos e prevenção de ocorrências.'],
    ['icon' => 'icon-group', 'title' => 'Compartilhamento de custos', 'text' => 'Investimento dividido entre os participantes.'],
    ['icon' => 'icon-mobile-phone', 'title' => 'Monitoramento remoto', 'text' => 'Acesse as imagens de qualquer lugar, a qualquer momento.'],
    ['icon' => 'icon-cloud', 'title' => 'Tecnologia profissional', 'text' => 'Solução completa gerenciada pela AserNet IoT Services.'],
];
$faqs = [
    ['question' => 'Quem pode acessar as imagens?', 'answer' => 'O acesso é definido pelo projeto e liberado somente aos responsáveis autorizados pela comunidade.'],
    ['question' => 'É necessário internet no local?', 'answer' => 'Sim. A conectividade garante o envio seguro das imagens para a nuvem e o acesso remoto.'],
    ['question' => 'Preciso comprar equipamentos?', 'answer' => 'A composição dos equipamentos é definida na apresentação personalizada, conforme a necessidade do local.'],
    ['question' => 'A solução funciona em condomínios?', 'answer' => 'Sim. O projeto atende condomínios, bairros, associações, loteamentos, áreas rurais e distritos industriais.'],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>AserNet - Bairro Seguro</title>
    <?php include ROOT . '/includes/assets.php'; ?>
</head>
<body>
<?php include ROOT . '/includes/header/header.php'; ?>

<main class="safe-neighborhood">
    <section class="safe-neighborhood__hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-7">
                    <div class="safe-neighborhood__hero-copy">
                        <h1>Bairro <strong>Seguro</strong></h1>
                        <h2>Tecnologia conectando comunidades.</h2>
                        <p>Mais segurança, colaboração e tranquilidade para ruas, bairros, condomínios e comunidades. Uma solução inteligente que protege o que mais importa: as pessoas.</p>
                        <a class="safe-neighborhood__button" href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-phone"></i>Solicitar apresentação</a>
                        <a class="safe-neighborhood__specialist" href="https://wa.me/5508002225262" target="_blank" rel="noopener">Fale com um especialista <span>→</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="safe-neighborhood__body">
        <div class="container">
            <section class="safe-neighborhood__shared">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <h2><strong>Segurança compartilhada.</strong><br>Tranquilidade para todos.</h2>
                        <p>O Bairro Seguro é uma solução colaborativa que utiliza câmeras estrategicamente posicionadas para aumentar a segurança de ruas, bairros e comunidades.</p>
                        <p>As imagens ficam disponíveis aos responsáveis autorizados, permitindo maior controle, monitoramento dos acessos e apoio na identificação de ocorrências.</p>
                        <p>Quando a tecnologia trabalha em conjunto com a comunidade, todos ganham mais tranquilidade.</p>
                    </div>
                    <div class="col-lg-8">
                        <img src="<?= BASE_URL ?>/images/bairroseguro/imgSegurancaCompartilhada.png" alt="Bairro monitorado por câmeras de segurança conectadas">
                    </div>
                </div>
            </section>

            <section class="safe-neighborhood__section">
                <h2 class="safe-neighborhood__title">Como funciona</h2>
                <div class="safe-neighborhood__steps">
                    <?php foreach ($steps as $index => $step): ?>
                    <article>
                        <b><?= $index + 1 ?></b>
                        <img src="<?= BASE_URL ?>/images/bairroseguro/<?= htmlspecialchars($step['image']) ?>" alt="">
                        <h3><?= htmlspecialchars($step['title']) ?></h3>
                        <p><?= htmlspecialchars($step['text']) ?></p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="safe-neighborhood__section">
                <h2 class="safe-neighborhood__title">Ideal para</h2>
                <div class="safe-neighborhood__audiences">
                    <?php foreach ($audiences as $audience): ?>
                    <article><i class="<?= $audience['icon'] ?>"></i><h3><?= htmlspecialchars($audience['label']) ?></h3></article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="safe-neighborhood__details">
                <article class="safe-neighborhood__included">
                    <img src="<?= BASE_URL ?>/images/bairroseguro/imgOqueEstaIncluso.png" alt="Aplicativo Bairro Seguro">
                    <div>
                        <h2>O que está incluso</h2>
                        <ul><?php foreach ($included as $item): ?><li><i class="icon-checkmark"></i><?= htmlspecialchars($item) ?></li><?php endforeach; ?></ul>
                    </div>
                </article>
                <article class="safe-neighborhood__advantages">
                    <h2>Vantagens para a comunidade</h2>
                    <div><?php foreach ($advantages as $advantage): ?><section><i class="<?= $advantage['icon'] ?>"></i><span><h3><?= htmlspecialchars($advantage['title']) ?></h3><p><?= htmlspecialchars($advantage['text']) ?></p></span></section><?php endforeach; ?></div>
                </article>
            </section>

            <section class="safe-neighborhood__faq">
                <h2 class="safe-neighborhood__title">Perguntas frequentes</h2>
                <div class="safe-neighborhood__faq-grid">
                    <?php foreach ($faqs as $index => $faq): ?>
                    <article>
                        <button type="button" aria-expanded="false" aria-controls="safe-faq-<?= $index ?>"><span><?= htmlspecialchars($faq['question']) ?></span><b>+</b></button>
                        <div id="safe-faq-<?= $index ?>" hidden><p><?= htmlspecialchars($faq['answer']) ?></p></div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="safe-neighborhood__cta">
                <div class="safe-neighborhood__cta-family"></div>
                <div class="safe-neighborhood__cta-copy">
                    <h2>Vamos tornar<br>seu bairro mais seguro?</h2>
                    <p>Nossa equipe está pronta para apresentar um projeto personalizado para sua comunidade.</p>
                    <div><a href="tel:08002225262"><i class="icon-phone"></i>0800 222 5262</a><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp"></i>Solicitar apresentação</a></div>
                </div>
                <div class="safe-neighborhood__cta-art"></div>
            </section>
        </div>
    </section>
</main>

<?php include ROOT . '/includes/footer/footer.php'; ?>
<?php include ROOT . '/includes/scripts.php'; ?>
<?php $version = time(); ?>
<script src="<?= BASE_URL ?>/pages/bairroseguro/bairroseguro.js?v=<?= $version ?>"></script>
</body>
</html>