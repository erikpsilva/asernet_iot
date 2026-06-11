<!DOCTYPE html>
<html>
<head>
<title>AserNet - Skeelo</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<?php
/* ---- defaults ---- */
$_sk = [
    'moments_span'     => 'Tudo que você gosta de ler e ouvir',
    'moments_titulo'   => 'Conteúdo para todos os momentos.',
    'moments_features' => [
        ['titulo' => 'Ebooks',              'texto' => 'Milhares de títulos para ler onde e quando quiser.'],
        ['titulo' => 'Audiobooks',          'texto' => 'Ouça suas histórias preferidas enquanto faz outras coisas.'],
        ['titulo' => 'Para toda a família', 'texto' => 'Conteúdo para todas as idades, em um só lugar.'],
        ['titulo' => 'Leia offline',        'texto' => 'Baixe seus conteúdos e acesse mesmo sem internet.'],
        ['titulo' => 'Sincronização',       'texto' => 'Continue de onde parou em qualquer dispositivo.'],
        ['titulo' => 'Sua estante',         'texto' => 'Organize seus favoritos e crie sua biblioteca pessoal.'],
    ],

    'routine_span'  => 'Integrado ao seu dia',
    'routine_titulo'=> 'Leitura e conhecimento que se conectam com a sua rotina.',
    'routine_texto' => 'Aproveite ao máximo sua Skeelo com a conexão estável e inteligente da AserNet.',
    'routine_cards' => [
        ['titulo' => 'Ouça em qualquer lugar', 'texto' => 'Aproveite seus audiobooks enquanto dirige, treina ou trabalha.', 'imagem' => 'imgOucaEmQualquerLugar.png'],
        ['titulo' => 'Para todas as idades',   'texto' => 'Livros e conteúdos que incentivam o aprendizado e a imaginação.', 'imagem' => 'imgParaTodasAsIdades.png'],
        ['titulo' => 'Leitura que relaxa',     'texto' => 'Momentos de pausa com histórias que inspiram e conectam.', 'imagem' => 'imgLeituraQueRelaxa.png'],
        ['titulo' => 'Continue de onde parou', 'texto' => 'Sua leitura sincronizada entre celular, tablet e computador automaticamente.', 'imagem' => 'imgContineDeOndeParou.png'],
    ],

    'how_span'  => 'Como ativar sua Skeelo',
    'how_steps' => [
        ['titulo' => 'Baixe o app Skeelo', 'texto' => 'Disponível para Android e iOS.'],
        ['titulo' => 'Faça login',          'texto' => 'Use seu login AserNet para acessar.'],
        ['titulo' => 'Aproveite',           'texto' => 'Explore milhares de títulos e comece a ler ou ouvir.'],
    ],

    'benefits_titulo' => 'Um benefício exclusivo para você',
    'benefits' => [
        ['titulo' => 'Incluso no seu plano', 'texto' => 'Sem custo adicional.'],
        ['titulo' => 'Experiência premium',  'texto' => 'Plataforma completa e sem anúncios.'],
        ['titulo' => 'Sempre com você',      'texto' => 'Conteúdo na palma da sua mão.'],
        ['titulo' => 'Mais que internet',    'texto' => 'AserNet entrega experiências que conectam você ao que realmente importa.'],
    ],

    'trust_google' => '5.0 ★★★★★ + de 3.000 avaliações no Google',
    'trust_item1'  => 'Atendimento via WhatsApp',
    'trust_item2'  => 'Suporte rápido e especializado',
];

try {
    require_once ROOT . '/config/database.php';
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'skeelo_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['moments_span', 'moments_titulo', 'routine_span', 'routine_titulo', 'routine_texto',
                        'how_span', 'benefits_titulo', 'trust_google', 'trust_item1', 'trust_item2'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $_sk[$k] = $db[$k];
            }
            foreach (['moments_features', 'routine_cards', 'how_steps', 'benefits'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($_sk[$arr][$i]) || !is_array($item)) continue;
                        foreach (array_keys($_sk[$arr][$i]) as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $_sk[$arr][$i][$k] = $item[$k];
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

$_featIcons    = ['icon-skeelo', 'icon-talk', 'icon-group', 'icon-cloud', 'icon-loading', 'icon-view'];
$_routineIcons = ['icon-talk', 'icon-group', 'icon-skeelo', 'icon-loading'];
$_benefIcons   = ['icon-group', 'icon-dashboard', 'icon-heart', 'icon-security'];
$_trustIcons   = ['icon-group', 'icon-cloud'];
?>

<main class="skeelo-page">
    <section class="skeelo-page__hero">
        <div class="container">
            <div class="skeelo-page__hero-content">
                <img class="skeelo-page__logo" src="<?= BASE_URL ?>/images/skeelo/logo-skeelo.svg" alt="Skeelo">
                <h1>Histórias que <strong>conectam.</strong><br>Conhecimento que <strong>acompanha você.</strong></h1>
                <p>Com a Skeelo, clientes AserNet têm acesso a uma experiência digital completa com ebooks, audiobooks e conteúdos para todos os momentos do seu dia.</p>
                <div class="skeelo-page__hero-actions">
                    <a class="skeelo-page__button skeelo-page__button--primary" href="<?= BASE_URL ?>/contato">Ativar minha Skeelo <i class="icon-arrowright" aria-hidden="true"></i></a>
                    <a class="skeelo-page__button skeelo-page__button--play" href="#conteudo"><span aria-hidden="true"></span>Saiba mais</a>
                </div>
            </div>
        </div>
    </section>

    <section class="skeelo-page__moments" id="conteudo">
        <div class="container">
            <header class="skeelo-page__section-head">
                <span><?= htmlspecialchars($_sk['moments_span']) ?></span>
                <h2><?= htmlspecialchars($_sk['moments_titulo']) ?></h2>
            </header>

            <div class="skeelo-page__features">
                <?php foreach ($_sk['moments_features'] as $i => $feat): ?>
                <article>
                    <i class="<?= $_featIcons[$i] ?? 'icon-skeelo' ?>" aria-hidden="true"></i>
                    <h3><?= htmlspecialchars($feat['titulo']) ?></h3>
                    <p><?= htmlspecialchars($feat['texto']) ?></p>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="skeelo-page__routine">
        <div class="container">
            <div class="skeelo-page__routine-grid">
                <aside class="skeelo-page__routine-copy">
                    <span><?= htmlspecialchars($_sk['routine_span']) ?></span>
                    <h2><?= htmlspecialchars($_sk['routine_titulo']) ?></h2>
                    <p><?= htmlspecialchars($_sk['routine_texto']) ?></p>
                </aside>

                <div class="skeelo-page__cards">
                    <?php foreach ($_sk['routine_cards'] as $i => $card): ?>
                    <article>
                        <img src="<?= BASE_URL ?>/images/skeelo/<?= htmlspecialchars($card['imagem']) ?>" alt="<?= htmlspecialchars($card['titulo']) ?>">
                        <div>
                            <i class="<?= $_routineIcons[$i] ?? 'icon-skeelo' ?>" aria-hidden="true"></i>
                            <h3><?= htmlspecialchars($card['titulo']) ?></h3>
                            <p><?= htmlspecialchars($card['texto']) ?></p>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="row skeelo-page__how-row">
                <div class="col-12">
                    <aside class="skeelo-page__how">
                        <span><?= htmlspecialchars($_sk['how_span']) ?></span>
                        <ol>
                            <?php foreach ($_sk['how_steps'] as $i => $step): ?>
                            <li>
                                <b><?= $i + 1 ?></b>
                                <strong><?= htmlspecialchars($step['titulo']) ?></strong>
                                <small><?= htmlspecialchars($step['texto']) ?></small>
                            </li>
                            <?php endforeach; ?>
                        </ol>
                        <a href="<?= BASE_URL ?>/contato">Quero acessar minha Skeelo <i class="icon-arrowright" aria-hidden="true"></i></a>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <section class="skeelo-page__benefits">
        <div class="container">
            <div class="skeelo-page__benefits-box">
                <h2><?= htmlspecialchars($_sk['benefits_titulo']) ?></h2>
                <?php foreach ($_sk['benefits'] as $i => $b): ?>
                <article>
                    <i class="<?= $_benefIcons[$i] ?? 'icon-group' ?>" aria-hidden="true"></i>
                    <div>
                        <h3><?= htmlspecialchars($b['titulo']) ?></h3>
                        <p><?= htmlspecialchars($b['texto']) ?></p>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="skeelo-page__trust">
        <div class="container">
            <div class="skeelo-page__trust-box">
                <div class="skeelo-page__google">
                    <img src="<?= BASE_URL ?>/images/skeelo/logoGoogle.png" alt="Google">
                    <p><strong><?= htmlspecialchars($_sk['trust_google']) ?></strong></p>
                </div>
                <article>
                    <i class="<?= $_trustIcons[0] ?>" aria-hidden="true"></i>
                    <span><?= htmlspecialchars($_sk['trust_item1']) ?></span>
                </article>
                <article>
                    <i class="<?= $_trustIcons[1] ?>" aria-hidden="true"></i>
                    <span><?= htmlspecialchars($_sk['trust_item2']) ?></span>
                </article>
            </div>
        </div>
    </section>
</main>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>

</body>
</html>
