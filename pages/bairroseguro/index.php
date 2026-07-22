<?php
$seoTitle = 'Bairro Seguro | AserNet IoT Services';
$seoDescription = 'Segurança compartilhada com câmeras estrategicamente posicionadas, gravação em nuvem e acesso remoto para bairros, condomínios e comunidades.';

$_bn = [
    'titulo'             => 'Bairro',
    'titulo_destaque'    => 'Seguro',
    'titulo_complemento' => '',
    'texto'              => 'Tecnologia conectando comunidades.',
    'bullets'            => ['Mais segurança, colaboração e tranquilidade para ruas, bairros, condomínios e comunidades. Uma solução inteligente que protege o que mais importa: as pessoas.'],
    'preco'              => '',
    'btn1_texto'         => 'Solicitar apresentação',
    'btn2_texto'         => 'Fale com um especialista',
    'imagem'             => '',
];
try {
    require_once ROOT . '/config/database.php';
    $_s_bn = getDbConnection()->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'bairroseguro_banner' LIMIT 1");
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

$_bs = [
    'shared_titulo'             => 'Segurança compartilhada.',
    'shared_titulo_complemento' => 'Tranquilidade para todos.',
    'shared_texto1' => 'O Bairro Seguro é uma solução colaborativa que utiliza câmeras estrategicamente posicionadas para aumentar a segurança de ruas, bairros e comunidades.',
    'shared_texto2' => 'As imagens ficam disponíveis aos responsáveis autorizados, permitindo maior controle, monitoramento dos acessos e apoio na identificação de ocorrências.',
    'shared_texto3' => 'Quando a tecnologia trabalha em conjunto com a comunidade, todos ganham mais tranquilidade.',
    'shared_imagem' => 'imgSegurancaCompartilhada.png',

    'steps_titulo' => 'Como funciona',
    'steps_items' => [
        ['titulo' => 'Instalação das câmeras', 'texto' => 'Câmeras posicionadas em pontos estratégicos.', 'imagem' => 'imgInstalacaodeCameras.png'],
        ['titulo' => 'Gravação em nuvem', 'texto' => 'Imagens armazenadas de forma segura e confiável.', 'imagem' => 'imgGravacaoEmNuvem.png'],
        ['titulo' => 'Acesso remoto', 'texto' => 'Consulta das imagens por aplicativo, de onde você estiver.', 'imagem' => 'imgAcessoRemoto.png'],
        ['titulo' => 'Mais segurança', 'texto' => 'Maior controle, prevenção e sensação de proteção para todos.', 'imagem' => 'imgMaisSeguranca.png'],
    ],

    'audiences_titulo' => 'Ideal para',
    'audiences_items' => [
        ['label' => 'Bairros residenciais'], ['label' => 'Associações de moradores'], ['label' => 'Condomínios'],
        ['label' => 'Distritos industriais'], ['label' => 'Loteamentos'], ['label' => 'Áreas rurais'],
    ],

    'included_titulo' => 'O que está incluso',
    'included_items'  => ['Projeto e implantação personalizada', 'Câmeras de segurança de alta qualidade', 'Infraestrutura de rede dedicada', 'Gravação em nuvem com alta disponibilidade', 'Manutenção preventiva', 'Suporte especializado', 'Aplicativo de acesso remoto'],
    'included_imagem' => 'imgOqueEstaIncluso.png',

    'advantages_titulo' => 'Vantagens para a comunidade',
    'advantages_items' => [
        ['titulo' => 'Mais segurança', 'texto' => 'Maior controle dos acessos e prevenção de ocorrências.'],
        ['titulo' => 'Compartilhamento de custos', 'texto' => 'Investimento dividido entre os participantes.'],
        ['titulo' => 'Monitoramento remoto', 'texto' => 'Acesse as imagens de qualquer lugar, a qualquer momento.'],
        ['titulo' => 'Tecnologia profissional', 'texto' => 'Solução completa gerenciada pela AserNet IoT Services.'],
    ],

    'faq_titulo' => 'Perguntas frequentes',
    'faq_items' => [
        ['pergunta' => 'Quem pode acessar as imagens?', 'resposta' => 'O acesso é definido pelo projeto e liberado somente aos responsáveis autorizados pela comunidade.'],
        ['pergunta' => 'É necessário internet no local?', 'resposta' => 'Sim. A conectividade garante o envio seguro das imagens para a nuvem e o acesso remoto.'],
        ['pergunta' => 'Preciso comprar equipamentos?', 'resposta' => 'A composição dos equipamentos é definida na apresentação personalizada, conforme a necessidade do local.'],
        ['pergunta' => 'A solução funciona em condomínios?', 'resposta' => 'Sim. O projeto atende condomínios, bairros, associações, loteamentos, áreas rurais e distritos industriais.'],
    ],

    'cta_titulo'             => 'Vamos tornar',
    'cta_titulo_complemento' => 'seu bairro mais seguro?',
    'cta_texto'              => 'Nossa equipe está pronta para apresentar um projeto personalizado para sua comunidade.',
    'cta_btn1_texto'         => '0800 222 5262',
    'cta_btn2_texto'         => 'Solicitar apresentação',
];

try {
    require_once ROOT . '/config/database.php';
    $row = getDbConnection()->query("SELECT setting_value FROM system_settings WHERE setting_key = 'bairroseguro_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['shared_titulo', 'shared_titulo_complemento', 'shared_texto1', 'shared_texto2', 'shared_texto3', 'shared_imagem',
                        'steps_titulo', 'audiences_titulo', 'included_titulo', 'included_imagem',
                        'advantages_titulo', 'faq_titulo',
                        'cta_titulo', 'cta_titulo_complemento', 'cta_texto', 'cta_btn1_texto', 'cta_btn2_texto'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $_bs[$k] = $db[$k];
            }
            if (!empty($db['included_items']) && is_array($db['included_items'])) {
                $items = array_values(array_filter(array_map(function ($v) { return trim((string) $v); }, $db['included_items']), function ($v) { return $v !== ''; }));
                if (!empty($items)) $_bs['included_items'] = $items;
            }
            if (!empty($db['audiences_items']) && is_array($db['audiences_items'])) {
                foreach ($db['audiences_items'] as $i => $item) {
                    if (!isset($_bs['audiences_items'][$i]) || !is_array($item)) continue;
                    if (isset($item['label']) && strlen((string) $item['label'])) $_bs['audiences_items'][$i]['label'] = $item['label'];
                }
            }
            if (!empty($db['advantages_items']) && is_array($db['advantages_items'])) {
                foreach ($db['advantages_items'] as $i => $item) {
                    if (!isset($_bs['advantages_items'][$i]) || !is_array($item)) continue;
                    foreach (array_keys($_bs['advantages_items'][$i]) as $k) {
                        if (isset($item[$k]) && strlen((string) $item[$k])) $_bs['advantages_items'][$i][$k] = $item[$k];
                    }
                }
            }
            if (!empty($db['steps_items']) && is_array($db['steps_items'])) {
                foreach ($db['steps_items'] as $i => $item) {
                    if (!isset($_bs['steps_items'][$i]) || !is_array($item)) continue;
                    foreach (array_keys($_bs['steps_items'][$i]) as $k) {
                        if (isset($item[$k]) && strlen((string) $item[$k])) $_bs['steps_items'][$i][$k] = $item[$k];
                    }
                }
            }
            if (!empty($db['faq_items']) && is_array($db['faq_items'])) {
                foreach ($db['faq_items'] as $i => $item) {
                    if (!isset($_bs['faq_items'][$i]) || !is_array($item)) continue;
                    foreach (array_keys($_bs['faq_items'][$i]) as $k) {
                        if (isset($item[$k]) && strlen((string) $item[$k])) $_bs['faq_items'][$i][$k] = $item[$k];
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

$_audienceIcons = ['icon-home','icon-group','icon-office','icon-infrastructure','icon-construcao','icon-globe'];
$_advantageIcons = ['icon-security','icon-group','icon-mobile-phone','icon-cloud'];
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
    <section class="safe-neighborhood__hero"<?= !empty($_bn['imagem']) ? ' style="--hero-image:url(\'' . BASE_URL . '/images/banners/bairroseguro/' . htmlspecialchars($_bn['imagem']) . '\')"' : '' ?>>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-7">
                    <div class="safe-neighborhood__hero-copy">
                        <h1><?=htmlspecialchars($_bn['titulo'])?> <?php if(!empty($_bn['titulo_destaque'])):?><strong><?=htmlspecialchars($_bn['titulo_destaque'])?></strong><?php endif;?> <?=htmlspecialchars($_bn['titulo_complemento'])?></h1>
                        <h2><?=htmlspecialchars($_bn['texto'])?></h2>
                        <?php foreach($_bn['bullets'] as $_bv):?><p><?=htmlspecialchars($_bv)?></p><?php endforeach;?>
                        <a class="safe-neighborhood__button" href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-phone"></i><?=htmlspecialchars($_bn['btn1_texto'])?></a>
                        <a class="safe-neighborhood__specialist" href="https://wa.me/5508002225262" target="_blank" rel="noopener"><?=htmlspecialchars($_bn['btn2_texto'])?> <span>→</span></a>
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
                        <h2><strong><?=htmlspecialchars($_bs['shared_titulo'])?></strong><br><?=htmlspecialchars($_bs['shared_titulo_complemento'])?></h2>
                        <p><?=htmlspecialchars($_bs['shared_texto1'])?></p>
                        <p><?=htmlspecialchars($_bs['shared_texto2'])?></p>
                        <p><?=htmlspecialchars($_bs['shared_texto3'])?></p>
                    </div>
                    <div class="col-lg-8">
                        <img src="<?= BASE_URL ?>/images/bairroseguro/<?=htmlspecialchars($_bs['shared_imagem'])?>" alt="Bairro monitorado por câmeras de segurança conectadas">
                    </div>
                </div>
            </section>

            <section class="safe-neighborhood__section">
                <h2 class="safe-neighborhood__title"><?=htmlspecialchars($_bs['steps_titulo'])?></h2>
                <div class="safe-neighborhood__steps">
                    <?php foreach ($_bs['steps_items'] as $index => $step): ?>
                    <article>
                        <b><?= $index + 1 ?></b>
                        <img src="<?= BASE_URL ?>/images/bairroseguro/<?= htmlspecialchars($step['imagem']) ?>" alt="">
                        <h3><?= htmlspecialchars($step['titulo']) ?></h3>
                        <p><?= htmlspecialchars($step['texto']) ?></p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="safe-neighborhood__section">
                <h2 class="safe-neighborhood__title"><?=htmlspecialchars($_bs['audiences_titulo'])?></h2>
                <div class="safe-neighborhood__audiences">
                    <?php foreach ($_bs['audiences_items'] as $index => $audience): ?>
                    <article><i class="<?= $_audienceIcons[$index % count($_audienceIcons)] ?>"></i><h3><?= htmlspecialchars($audience['label']) ?></h3></article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="safe-neighborhood__details">
                <article class="safe-neighborhood__included">
                    <img src="<?= BASE_URL ?>/images/bairroseguro/<?=htmlspecialchars($_bs['included_imagem'])?>" alt="Aplicativo Bairro Seguro">
                    <div>
                        <h2><?=htmlspecialchars($_bs['included_titulo'])?></h2>
                        <ul><?php foreach ($_bs['included_items'] as $item): ?><li><i class="icon-checkmark"></i><?= htmlspecialchars($item) ?></li><?php endforeach; ?></ul>
                    </div>
                </article>
                <article class="safe-neighborhood__advantages">
                    <h2><?=htmlspecialchars($_bs['advantages_titulo'])?></h2>
                    <div><?php foreach ($_bs['advantages_items'] as $index => $advantage): ?><section><i class="<?= $_advantageIcons[$index % count($_advantageIcons)] ?>"></i><span><h3><?= htmlspecialchars($advantage['titulo']) ?></h3><p><?= htmlspecialchars($advantage['texto']) ?></p></span></section><?php endforeach; ?></div>
                </article>
            </section>

            <section class="safe-neighborhood__faq">
                <h2 class="safe-neighborhood__title"><?=htmlspecialchars($_bs['faq_titulo'])?></h2>
                <div class="safe-neighborhood__faq-grid">
                    <?php foreach ($_bs['faq_items'] as $index => $faq): ?>
                    <article>
                        <button type="button" aria-expanded="false" aria-controls="safe-faq-<?= $index ?>"><span><?= htmlspecialchars($faq['pergunta']) ?></span><b>+</b></button>
                        <div id="safe-faq-<?= $index ?>" hidden><p><?= htmlspecialchars($faq['resposta']) ?></p></div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="safe-neighborhood__cta">
                <div class="safe-neighborhood__cta-family"></div>
                <div class="safe-neighborhood__cta-copy">
                    <h2><?=htmlspecialchars($_bs['cta_titulo'])?><br><?=htmlspecialchars($_bs['cta_titulo_complemento'])?></h2>
                    <p><?=htmlspecialchars($_bs['cta_texto'])?></p>
                    <div><a href="tel:08002225262"><i class="icon-phone"></i><?=htmlspecialchars($_bs['cta_btn1_texto'])?></a><a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp"></i><?=htmlspecialchars($_bs['cta_btn2_texto'])?></a></div>
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
