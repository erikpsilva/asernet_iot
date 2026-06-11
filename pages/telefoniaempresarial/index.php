<!DOCTYPE html>
<html>
<head>
<title>AserNet - Telefonia Empresarial</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<?php
/* ---- defaults ---- */
$_te = [
    'pain_titulo' => 'Sua empresa ainda perde oportunidades por falhas no atendimento?',
    'pain_texto'  => 'Uma comunicação inadequada pode impactar diretamente seus resultados.',
    'pain_items'  => ['Chamadas perdidas', 'Atendimento desorganizado', 'Dificuldade de mobilidade', 'Estrutura limitada'],

    'sol_titulo' => 'Soluções que se adaptam ao seu negócio.',
    'sol_texto'  => 'Escolha a solução ideal para a comunicação da sua empresa.',
    'sol_cards'  => [
        ['titulo' => 'Linha empresarial', 'texto' => 'Ideal para empresas que precisam de comunicação estável e profissional.', 'imagem' => 'imgLinhaEmpresarial.png'],
        ['titulo' => 'Número 0800',       'texto' => 'Atendimento gratuito para seus clientes e fortalecimento da marca.',       'imagem' => ''],
        ['titulo' => 'Número 4000',       'texto' => 'Mais credibilidade e presença regional para sua empresa.',                  'imagem' => ''],
    ],

    'feat_titulo' => 'Diferenciais AserNet',
    'feat_texto'  => 'Tecnologia, suporte e soluções que fazem a diferença.',
    'feat_items'  => [
        ['titulo' => 'Flexibilidade',        'texto' => 'Estrutura adaptável para diferentes tamanhos de empresa.'],
        ['titulo' => 'Telefonia IP',          'texto' => 'Mais mobilidade, integração com sistemas e redução de custos.'],
        ['titulo' => 'Atendimento próximo',   'texto' => 'Equipe local para suporte rápido e acompanhamento da sua operação.'],
        ['titulo' => 'Projeto personalizado', 'texto' => 'Soluções sob medida conforme a necessidade do seu negócio.'],
    ],

    'res_aud_titulo' => 'Para quem é indicado',
    'res_aud_items'  => ['Escritórios', 'Comércios', 'Clínicas', 'Hotéis e pousadas', 'Atendimento comercial', 'Empresas com múltiplos setores', 'Equipes em diferentes localizações'],
    'res_imagem'     => 'imgRecursosQueGeramResultados.png',
    'res_rec_titulo' => 'Recursos que geram resultados',
    'res_rec_items'  => ['Ramais ilimitados', 'Desvio de chamadas', 'URA personalizada', 'Gravação de chamadas', 'Relatórios gerenciais', 'Aplicativo para celular'],

    'flow_titulo' => 'Integre a telefonia com outras soluções AserNet.',
    'flow_texto'  => 'Comunicação conectada com sua operação para mais eficiência e segurança.',
    'flow_items'  => ['Internet PME', 'Link Dedicado', 'Wi-Fi Profissional', 'Câmeras de Segurança', 'Estruturas corporativas'],

    'ben_titulo' => 'Benefícios que impulsionam sua empresa.',
    'ben_items'  => [
        ['titulo' => 'Mais profissionalismo', 'texto' => 'Transmita credibilidade e melhore a experiência do seu cliente.'],
        ['titulo' => 'Mais mobilidade',       'texto' => 'Atenda sua equipe de qualquer lugar com mais liberdade.'],
        ['titulo' => 'Mais produtividade',    'texto' => 'Comunicação organizada para processos mais rápidos e eficientes.'],
        ['titulo' => 'Escalável',             'texto' => 'Expanda ramais e recursos conforme o crescimento da sua empresa.'],
    ],

    'trust_google' => '5,0 + de 3.000 avaliações no Google',
    'trust_items'  => ['Atendimento local de verdade', 'Suporte técnico especializado', 'Instalação profissional e acompanhamento'],
];

try {
    require_once ROOT . '/config/database.php';
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'telefonia_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['pain_titulo', 'pain_texto',
                        'sol_titulo', 'sol_texto',
                        'feat_titulo', 'feat_texto',
                        'res_aud_titulo', 'res_imagem', 'res_rec_titulo',
                        'flow_titulo', 'flow_texto',
                        'ben_titulo', 'trust_google'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $_te[$k] = $db[$k];
            }
            foreach (['pain_items', 'res_aud_items', 'res_rec_items', 'flow_items', 'trust_items'] as $k) {
                if (!empty($db[$k]) && is_array($db[$k])) $_te[$k] = $db[$k];
            }
            foreach (['sol_cards', 'feat_items', 'ben_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($_te[$arr][$i]) || !is_array($item)) continue;
                        foreach (array_keys($_te[$arr][$i]) as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $_te[$arr][$i][$k] = $item[$k];
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

$_solIcons  = [null, 'icon-customersupport', 'icon-talk'];
$_featIcons = ['icon-setting', 'icon-cloud', 'icon-customersupport', 'icon-puzzle'];
$_audIcons  = ['icon-office', 'icon-market', 'icon-clinic', 'icon-hotels', 'icon-phone', 'icon-group', 'icon-empresapessoas'];
$_flowIcons = ['icon-office', 'icon-link', 'icon-wifi', 'icon-casino-cctv', 'icon-servidor'];
$_benIcons  = ['icon-phone', 'icon-mobile-phone', 'icon-group', 'icon-speed'];
$_trustIcons = ['icon-talk', 'icon-wifi', 'icon-install'];
?>

<section class="telefonia-page">
    <div class="telefonia-page__hero">
        <div class="container">
            <div class="telefonia-page__hero-copy">
                <span>Telefonia empresarial</span>
                <h1>Comunicação profissional, <strong>sem complicação.</strong></h1>
                <p>Telefonia empresarial para sua empresa atender melhor, ganhar produtividade e transmitir mais credibilidade.</p>

                <ul>
                    <li><i class="icon-checkmark" aria-hidden="true"></i>Linhas fixas empresariais</li>
                    <li><i class="icon-checkmark" aria-hidden="true"></i>Telefonia SIP/IP</li>
                    <li><i class="icon-checkmark" aria-hidden="true"></i>Soluções 0800 e 4000</li>
                    <li><i class="icon-checkmark" aria-hidden="true"></i>Mais mobilidade e flexibilidade</li>
                </ul>

                <div class="telefonia-page__hero-actions">
                    <a class="telefonia-page__button telefonia-page__button--primary" href="https://wa.me/5508002225262?text=Ol%C3%A1!%20Tenho%20interesse%20em%20solicitar%20uma%20proposta%20de%20Telefonia%20Empresarial." target="_blank" rel="noopener">Solicitar proposta <i class="icon-arrowright" aria-hidden="true"></i></a>
                    <a class="telefonia-page__button telefonia-page__button--outline" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i>0800 222 5262</a>
                </div>
            </div>
        </div>
    </div>

    <div class="telefonia-page__body">
        <section class="telefonia-page__pain">
            <div class="container">
                <div class="telefonia-page__pain-box">
                    <i class="icon-phoneerror" aria-hidden="true"></i>
                    <div>
                        <h2><?= htmlspecialchars($_te['pain_titulo']) ?></h2>
                        <p><?= htmlspecialchars($_te['pain_texto']) ?></p>
                    </div>
                    <ul class="telefonia-page__bad-list">
                        <?php foreach ($_te['pain_items'] as $item): ?>
                        <li><i aria-hidden="true">&times;</i><?= htmlspecialchars($item) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

        <section class="telefonia-page__solutions">
            <div class="container">
                <header class="telefonia-page__section-header">
                    <h2><?= htmlspecialchars($_te['sol_titulo']) ?></h2>
                    <p><?= htmlspecialchars($_te['sol_texto']) ?></p>
                </header>

                <div class="telefonia-page__solutions-grid">
                    <?php foreach ($_te['sol_cards'] as $i => $card): ?>
                    <article>
                        <?php if ($i === 0 && !empty($card['imagem'])): ?>
                        <img src="<?= BASE_URL ?>/images/telefoniaempresarial/<?= htmlspecialchars($card['imagem']) ?>" alt="<?= htmlspecialchars($card['titulo']) ?>">
                        <?php elseif ($i > 0): ?>
                        <i class="<?= $_solIcons[$i] ?>" aria-hidden="true"></i>
                        <?php endif; ?>
                        <div>
                            <h3><?= htmlspecialchars($card['titulo']) ?></h3>
                            <p><?= htmlspecialchars($card['texto']) ?></p>
                            <a href="https://wa.me/5508002225262" target="_blank" rel="noopener">Saiba mais <i class="icon-arrowright" aria-hidden="true"></i></a>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>

                <a class="telefonia-page__analysis" href="https://wa.me/5508002225262?text=Ol%C3%A1!%20Gostaria%20de%20solicitar%20uma%20an%C3%A1lise%20da%20melhor%20solu%C3%A7%C3%A3o%20de%20Telefonia%20Empresarial." target="_blank" rel="noopener">Solicitar análise da melhor solução <i class="icon-arrowright" aria-hidden="true"></i></a>
            </div>
        </section>

        <section class="telefonia-page__features">
            <div class="container">
                <header class="telefonia-page__section-header">
                    <h2><?= htmlspecialchars($_te['feat_titulo']) ?></h2>
                    <p><?= htmlspecialchars($_te['feat_texto']) ?></p>
                </header>

                <div class="telefonia-page__features-grid">
                    <?php foreach ($_te['feat_items'] as $i => $item): ?>
                    <article>
                        <i class="<?= $_featIcons[$i] ?? 'icon-setting' ?>" aria-hidden="true"></i>
                        <h3><?= htmlspecialchars($item['titulo']) ?></h3>
                        <p><?= htmlspecialchars($item['texto']) ?></p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="telefonia-page__resources">
            <div class="container">
                <div class="telefonia-page__resources-box">
                    <div>
                        <h2><?= htmlspecialchars($_te['res_aud_titulo']) ?></h2>
                        <ul>
                            <?php foreach ($_te['res_aud_items'] as $i => $item): ?>
                            <li><i class="<?= $_audIcons[$i] ?? 'icon-group' ?>" aria-hidden="true"></i><?= htmlspecialchars($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <img src="<?= BASE_URL ?>/images/telefoniaempresarial/<?= htmlspecialchars($_te['res_imagem']) ?>" alt="Telefone empresarial sobre mesa">

                    <div>
                        <h2><?= htmlspecialchars($_te['res_rec_titulo']) ?></h2>
                        <ul>
                            <?php foreach ($_te['res_rec_items'] as $item): ?>
                            <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="telefonia-page__flow">
            <div class="container">
                <header class="telefonia-page__section-header">
                    <h2><?= htmlspecialchars($_te['flow_titulo']) ?></h2>
                    <p><?= htmlspecialchars($_te['flow_texto']) ?></p>
                </header>

                <div class="telefonia-page__flow-grid">
                    <?php foreach ($_te['flow_items'] as $i => $item): ?>
                    <article><i class="<?= $_flowIcons[$i] ?? 'icon-office' ?>" aria-hidden="true"></i><?= htmlspecialchars($item) ?></article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="telefonia-page__benefits">
            <div class="container">
                <div class="telefonia-page__benefits-box">
                    <h2><?= htmlspecialchars($_te['ben_titulo']) ?></h2>
                    <div>
                        <?php foreach ($_te['ben_items'] as $i => $item): ?>
                        <article>
                            <i class="<?= $_benIcons[$i] ?? 'icon-phone' ?>" aria-hidden="true"></i>
                            <strong><?= htmlspecialchars($item['titulo']) ?></strong>
                            <span><?= htmlspecialchars($item['texto']) ?></span>
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="telefonia-page__trust">
            <div class="container">
                <div class="telefonia-page__trust-grid">
                    <div class="telefonia-page__google"><img src="<?= BASE_URL ?>/images/logoGoogle.png" alt="Google"><p><strong><?= htmlspecialchars($_te['trust_google']) ?></strong></p></div>
                    <?php foreach ($_te['trust_items'] as $i => $item): ?>
                    <article><i class="<?= $_trustIcons[$i] ?? 'icon-talk' ?>" aria-hidden="true"></i><?= htmlspecialchars($item) ?></article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="telefonia-page__cta">
            <div class="container">
                <div class="telefonia-page__cta-box">
                    <div>
                        <h2>Sua empresa merece uma comunicação mais profissional.</h2>
                        <p>Fale com um especialista e encontre a solução de telefonia ideal para o seu negócio.</p>
                    </div>
                    <div class="telefonia-page__cta-actions">
                        <a class="telefonia-page__cta-button telefonia-page__cta-button--whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="telefonia-page__cta-button" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><span>Ligar agora <strong>0800 222 5262</strong></span></a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/telefoniaempresarial/telefoniaempresarial.js?' . $version . '"></script>';
?>

</body>
</html>
