<?php
$_rc = [
    'diagnostico_titulo'  => 'A diferença não está na velocidade. Está na sua rede.',
    'diagnostico_texto'   => 'Mesmo com internet rápida, muitos problemas acontecem por falta de cobertura e estrutura adequada dentro da casa.',
    'diagnostico_imagem'  => 'imgADifrencaNaoEstaNaVelocidade.png',
    'solucao_titulo'      => 'Internet pensada para sua casa funcionar de verdade.',
    'solucao_texto'       => 'A AserNet entrega soluções com cobertura inteligente, pontos de rede e Wi-Fi preparado para múltiplos dispositivos.',
    'solucao_bullets'     => ['Mais estabilidade', 'Melhor cobertura', 'Melhor experiência para toda a família', 'Estrutura preparada para sua necessidade'],
    'planos_titulo'       => 'Escolha o nível ideal para sua casa',
    'planos' => [
        ['nome' => 'ASER CONECTA',       'descricao' => 'Ideal para uso básico e casas compactas',       'bullets' => ['1 Giga de velocidade', 'Wi-Fi estável', 'Suporte AserNet'],                                                                 'preco' => '109,90'],
        ['nome' => 'ASER CONECTA PLUS',  'descricao' => 'Mais estabilidade para famílias conectadas',    'bullets' => ['Tudo do plano anterior', 'Até 3 pontos de rede cabeados', 'Melhor desempenho para TVs, videogames e home office'],         'preco' => '119,90'],
        ['nome' => 'ASER CASA CONECTADA','descricao' => 'Cobertura inteligente para toda a casa',        'bullets' => ['Tudo do plano anterior', 'Sistema Wi-Fi Mesh', 'Cobertura ampliada', 'Melhor experiência em múltiplos ambientes'],         'preco' => '139,90'],
    ],
    'suporte' => [
        ['titulo' => 'Suporte local de verdade',         'texto' => 'Atendimento rápido e próximo sempre que precisar.'],
        ['titulo' => 'Estrutura inteligente',            'texto' => 'Mais estabilidade e desempenho para sua casa.'],
        ['titulo' => 'Instalação profissional',          'texto' => 'Configuração completa e orientação inclusas sem custo adicional.'],
        ['titulo' => 'Wi-Fi preparado para sua família', 'texto' => 'Ideal para cada dispositivo e para a rotina conectada da sua casa.'],
    ],
];

$_suporteIcons = ['icon-customersupport', 'icon-structure', 'icon-engineer', 'icon-wificobertura'];
$_planoIcons   = ['icon-wifiestavel', 'icon-star', 'icon-wifiestrutura'];
$_planoIds     = ['internet-start', 'internet-plus', 'internet-ultra'];
$_planoTitles  = ['Internet residencial - Start', 'Internet residencial - Plus', 'Internet residencial - Ultra'];

try {
    require_once ROOT . '/config/database.php';
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'residencial_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            foreach (['diagnostico_titulo', 'diagnostico_texto', 'diagnostico_imagem', 'solucao_titulo', 'solucao_texto', 'planos_titulo'] as $k) {
                if (!empty($db[$k])) $_rc[$k] = $db[$k];
            }
            if (!empty($db['solucao_bullets']) && is_array($db['solucao_bullets'])) {
                $_rc['solucao_bullets'] = $db['solucao_bullets'];
            }
            if (!empty($db['planos']) && is_array($db['planos'])) {
                foreach ($db['planos'] as $i => $plano) {
                    if (isset($_rc['planos'][$i]) && is_array($plano)) {
                        foreach (['nome', 'descricao', 'preco'] as $k) {
                            if (!empty($plano[$k])) $_rc['planos'][$i][$k] = $plano[$k];
                        }
                        if (!empty($plano['bullets']) && is_array($plano['bullets'])) {
                            $_rc['planos'][$i]['bullets'] = $plano['bullets'];
                        }
                    }
                }
            }
            if (!empty($db['suporte']) && is_array($db['suporte'])) {
                foreach ($db['suporte'] as $i => $item) {
                    if (isset($_rc['suporte'][$i]) && is_array($item)) {
                        foreach (['titulo', 'texto'] as $k) {
                            if (!empty($item[$k])) $_rc['suporte'][$i][$k] = $item[$k];
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}
?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Residencial</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<section class="residential">
    <div class="residential__hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="residential__hero-copy">
                        <h1 class="residential__hero-title">Internet de verdade, <strong>sem complicação.</strong></h1>
                        <p class="residential__hero-text">1 Giga de velocidade com estabilidade, cobertura e suporte para sua casa funcionar melhor.</p>

                        <ul class="residential__hero-list">
                            <li><i class="icon-checkmark" aria-hidden="true"></i>1 Giga em todos os planos</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Wi-Fi estável em toda a casa</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Suporte técnico AserNet</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Instalação rápida e profissional</li>
                        </ul>

                        <div class="residential__hero-actions">
                            <a class="residential__button residential__button--primary" href="<?= BASE_URL ?>/contato"><span>Quero contratar agora</span></a>
                            <a class="residential__button residential__button--outline" href="tel:08002225262">
                                <i class="icon-phone" aria-hidden="true"></i>
                                <span>0800 222 5262</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-6" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="residential__body">
        <section class="residential__diagnosis residential__desktop-only">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <h2 class="residential__section-title"><?= htmlspecialchars($_rc['diagnostico_titulo']) ?></h2>
                        <p class="residential__section-text"><?= htmlspecialchars($_rc['diagnostico_texto']) ?></p>

                        <div class="residential__problems">
                            <article><i class="icon-wifi" aria-hidden="true"></i><span>Sinal fraco<br>no quarto</span></article>
                            <article><i class="icon-tv" aria-hidden="true"></i><span>Travamentos<br>na TV</span></article>
                            <article><i class="icon-phone" aria-hidden="true"></i><span>Chamadas<br>caindo</span></article>
                            <article><i class="icon-wifiruim" aria-hidden="true"></i><span>Wi-Fi ruim em<br>alguns ambientes</span></article>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <img class="residential__diagnosis-image" src="<?= BASE_URL ?>/images/residencial/<?= htmlspecialchars($_rc['diagnostico_imagem']) ?>" alt="Casa com cobertura Wi-Fi inteligente">
                    </div>
                </div>
            </div>
        </section>

        <section class="residential__truth residential__desktop-only">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <h2 class="residential__section-title"><?= htmlspecialchars($_rc['solucao_titulo']) ?></h2>
                        <p class="residential__section-text"><?= htmlspecialchars($_rc['solucao_texto']) ?></p>
                        <ul class="residential__checks">
                            <?php foreach ($_rc['solucao_bullets'] as $bullet): ?>
                            <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($bullet) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="col-lg-7">
                        <div class="residential__benefits">
                            <article><i class="icon-wifiestavel" aria-hidden="true"></i><span>Conexão<br>estável</span></article>
                            <article><i class="icon-wificobertura" aria-hidden="true"></i><span>Cobertura<br>inteligente</span></article>
                            <article><i class="icon-family" aria-hidden="true"></i><span>Para toda<br>a família</span></article>
                            <article><i class="icon-structure" aria-hidden="true"></i><span>Estrutura que<br>a sua casa precisa</span></article>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="residential__plans">
            <div class="container">
                <h2 class="residential__center-title"><?= htmlspecialchars($_rc['planos_titulo']) ?></h2>

                <div class="residential__plans-grid">
                    <?php foreach ($_rc['planos'] as $i => $plano):
                        $isFeatured = ($i === 1);
                        $icon       = $_planoIcons[$i]   ?? 'icon-wifiestavel';
                        $cartId     = $_planoIds[$i]     ?? 'internet-plan-' . $i;
                        $cartTitle  = $_planoTitles[$i]  ?? htmlspecialchars($plano['nome']);
                    ?>
                    <article class="residential__plan<?= $isFeatured ? ' residential__plan--featured' : '' ?>">
                        <?php if ($isFeatured): ?><span class="residential__badge">MAIS ESCOLHIDO</span><?php endif; ?>
                        <div class="residential__plan-heading">
                            <i class="<?= $icon ?>" aria-hidden="true"></i>
                            <h3><?= htmlspecialchars($plano['nome']) ?></h3>
                        </div>
                        <p class="residential__plan-description"><?= htmlspecialchars($plano['descricao']) ?></p>
                        <ul class="residential__plan-list">
                            <?php foreach ($plano['bullets'] as $b): ?>
                            <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($b) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php if ($isFeatured): ?><span class="residential__plan-note">até 10 metros por ponto</span><?php endif; ?>
                        <p class="residential__price"><span>R$</span> <?= htmlspecialchars($plano['preco']) ?><small>/mês</small></p>
                        <a class="residential__plan-button" href="<?= BASE_URL ?>/carrinho"
                           data-cart-add
                           data-cart-id="<?= $cartId ?>"
                           data-cart-group="internet-residencial"
                           data-cart-title="<?= htmlspecialchars($cartTitle) ?>"
                           data-cart-subtitle="<?= htmlspecialchars($plano['descricao']) ?>"
                           data-cart-price="R$ <?= htmlspecialchars($plano['preco']) ?>/mês"
                           data-cart-icon="icon-wifi"
                           data-cart-url="<?= BASE_URL ?>/residencial">Contratar agora</a>
                    </article>
                    <?php endforeach; ?>
                </div>

                <p class="residential__plans-note"><i class="icon-checkmark" aria-hidden="true"></i>Todos os planos incluem 1 Giga de velocidade.</p>
            </div>
        </section>

        <section class="residential__routine">
            <div class="container">
                <h2 class="residential__center-title">Ideal para tudo que faz parte da sua rotina</h2>
                <div class="residential__routine-grid">
                    <article><i class="icon-streaming" aria-hidden="true"></i><span>Streaming<br>e filmes</span></article>
                    <article><i class="icon-homeoffice" aria-hidden="true"></i><span>Home Office<br>e estudos</span></article>
                    <article><i class="icon-videochamada" aria-hidden="true"></i><span>Videochamadas<br>e reuniões</span></article>
                    <article><i class="icon-videogame" aria-hidden="true"></i><span>Videogames<br>online</span></article>
                    <article><i class="icon-devices" aria-hidden="true"></i><span>Múltiplos<br>dispositivos</span></article>
                    <article><i class="icon-bighouse" aria-hidden="true"></i><span>Casas com<br>muitos ambientes</span></article>
                </div>
            </div>
        </section>

        <section class="residential__support">
            <div class="container">
                <div class="residential__support-grid">
                    <?php foreach ($_rc['suporte'] as $i => $item): ?>
                    <article>
                        <i class="<?= $_suporteIcons[$i] ?? 'icon-customersupport' ?>" aria-hidden="true"></i>
                        <h3><?= htmlspecialchars($item['titulo']) ?></h3>
                        <p><?= htmlspecialchars($item['texto']) ?></p>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="residential__trust">
            <div class="container">
                <div class="residential__trust-box">
                    <div class="residential__trust-heading">
                        <h2>A confiança de quem já é AserNet.</h2>
                        <div class="residential__google">
                            <img src="<?= BASE_URL ?>/images/logoGoogle.png" alt="Google">
                            <p><strong>+ de 3.000</strong> avaliações<br>no Google</p>
                        </div>
                    </div>
                    <div class="residential__reviews residential__desktop-only">
                        <article><p>"Internet estável de verdade! Cobertura em toda a casa."</p><div><span></span><strong>Juliana M.</strong></div></article>
                        <article><p>"Suporte rápido e atendimento excelente. Recomendo!"</p><div><span></span><strong>Carlos A.</strong></div></article>
                        <article><p>"Agora consigo trabalhar, assistir e jogar sem travamentos."</p><div><span></span><strong>Mariana S.</strong></div></article>
                    </div>
                </div>
            </div>
        </section>

        <section class="residential__mobile-local">
            <div class="container">
                <article><i class="icon-customersupport" aria-hidden="true"></i><h3>Atendimento local de verdade</h3></article>
            </div>
        </section>

        <section class="residential__cta">
            <div class="container">
                <div class="residential__cta-box">
                    <h2>Sua casa inteira conectada de verdade.</h2>
                    <div class="residential__cta-actions">
                        <a class="residential__cta-button residential__cta-button--whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="residential__cta-button" href="<?= BASE_URL ?>/contato"><i class="icon-calendar" aria-hidden="true"></i><span>Solicitar instalação</span></a>
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
echo '<script src="' . BASE_URL . '/pages/residencial/residencial.js?' . $version . '"></script>';
?>

</body>
</html>
