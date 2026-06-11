<?php
$_cc = [
    'dor_titulo'   => 'Você nem sempre consegue estar presente.',
    'dor_destaque' => 'Mas sua segurança pode.',
    'dor_items'    => ['Preocupação ao sair de casa', 'Empresa sem monitoramento', 'Dificuldade para acompanhar funcionários', 'Insegurança no dia a dia'],

    'monitor_titulo'         => 'Acompanhe tudo em tempo real pelo celular',
    'monitor_texto'          => 'Com a Aser Câmeras você monitora sua casa ou empresa de qualquer lugar.',
    'monitor_bullets'        => ['Visualização ao vivo', 'Acesso remoto pelo app', 'Notificações e alertas inteligentes', 'Armazenamento em nuvem', 'Equipamentos inclusos em comodato'],
    'monitor_imagem'         => 'imagAcompanheTudoEmTempoReal.png',
    'monitor_casa_titulo'    => 'Para sua casa',
    'monitor_casa_texto'     => 'Mais tranquilidade para sua família e controle do seu imóvel mesmo à distância.',
    'monitor_casa_imagem'    => 'imgParaSuaCasa.png',
    'monitor_empresa_titulo' => 'Para sua empresa',
    'monitor_empresa_texto'  => 'Mais segurança, monitoramento e acompanhamento da operação da sua empresa.',
    'monitor_empresa_imagem' => 'imgParaSuaEmpresa.png',

    'planos_titulo' => 'Escolha o plano ideal para você',
    'planos' => [
        ['nome' => '1 CÂMERA',           'descricao' => 'Mais para entradas e monitoramento básico',    'imagem' => 'img1Camera.png',        'bullets' => ['1 câmera HD', 'Visão noturna', 'Acesso remoto pelo app', 'Armazenamento em nuvem'],                                    'preco' => '49,90'],
        ['nome' => '2 CÂMERAS',          'descricao' => 'Cobertura ampliada para ambientes maiores',   'imagem' => 'imag2Cameras.png',      'bullets' => ['2 câmeras HD', 'Visão noturna', 'Acesso remoto pelo app', 'Armazenamento em nuvem'],                                   'preco' => '99,80'],
        ['nome' => '2 CÂMERAS + ALARME', 'descricao' => 'Mais proteção com monitoramento inteligente', 'imagem' => 'img2CamerasAlarame.png','bullets' => ['2 câmeras HD', 'Central de alarme', 'Visão noturna', 'Acesso remoto pelo app', 'Armazenamento em nuvem'],             'preco' => '119,70'],
    ],

    'como_titulo'      => 'Como funciona',
    'como_texto'       => 'Simples e sem burocracia',
    'como_steps'       => ['Escolha o plano ideal para sua necessidade', 'Agendamos a instalação', 'Configuramos o aplicativo', 'Você acompanha tudo pelo celular'],
    'como_app_titulo'  => 'Sua segurança na palma da mão',
    'como_app_texto'   => 'Acompanhe suas câmeras em tempo real pelo aplicativo.',
    'como_app_bullets' => ['Android e iPhone', 'Visualização remota', 'Alertas inteligentes'],
    'como_app_imagem'  => 'imgSuaSegurancaNaPalmaDaMao.png',

    'diferenciais_titulo' => 'Diferenciais Aser Câmeras',
    'diferenciais' => [
        ['titulo' => 'Instalação inclusa',       'texto' => 'Nossa equipe cuida de tudo para você.'],
        ['titulo' => 'Equipamentos em comodato', 'texto' => 'Sem necessidade de compra.'],
        ['titulo' => 'Suporte local',            'texto' => 'Atendimento próximo e rápido quando você precisar.'],
        ['titulo' => 'Expansível',               'texto' => 'Adicione mais câmeras conforme sua necessidade.'],
    ],
];

$_difIcons    = ['icon-engineer', 'icon-casino-cctv', 'icon-customersupport', 'icon-expansivel'];
$_dorIcons    = ['icon-home', 'icon-monitoramento', 'icon-funcionarios', 'icon-inseguranca'];
$_planoIds    = ['camera-1', 'camera-2', 'camera-3'];
$_planoBadges = [null, 'Mais contratado', 'Mais proteção'];
$_planoMods   = ['', 'camera-security__plan--featured', 'camera-security__plan--orange'];
$_comoIcons   = ['icon-escolherplano', 'icon-calendar', 'icon-app', 'icon-view'];

try {
    require_once ROOT . '/config/database.php';
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'cameras_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['dor_titulo', 'dor_destaque', 'monitor_titulo', 'monitor_texto', 'monitor_imagem',
                        'monitor_casa_titulo', 'monitor_casa_texto', 'monitor_casa_imagem',
                        'monitor_empresa_titulo', 'monitor_empresa_texto', 'monitor_empresa_imagem',
                        'planos_titulo', 'como_titulo', 'como_texto', 'como_app_titulo', 'como_app_texto',
                        'como_app_imagem', 'diferenciais_titulo'];
            foreach ($scalars as $k) {
                if (!empty($db[$k])) $_cc[$k] = $db[$k];
            }
            foreach (['dor_items', 'monitor_bullets', 'como_steps', 'como_app_bullets'] as $k) {
                if (!empty($db[$k]) && is_array($db[$k])) $_cc[$k] = $db[$k];
            }
            if (!empty($db['planos']) && is_array($db['planos'])) {
                foreach ($db['planos'] as $i => $plano) {
                    if (isset($_cc['planos'][$i]) && is_array($plano)) {
                        foreach (['nome', 'descricao', 'preco', 'imagem'] as $k) {
                            if (!empty($plano[$k])) $_cc['planos'][$i][$k] = $plano[$k];
                        }
                        if (!empty($plano['bullets']) && is_array($plano['bullets'])) $_cc['planos'][$i]['bullets'] = $plano['bullets'];
                    }
                }
            }
            if (!empty($db['diferenciais']) && is_array($db['diferenciais'])) {
                foreach ($db['diferenciais'] as $i => $item) {
                    if (isset($_cc['diferenciais'][$i]) && is_array($item)) {
                        foreach (['titulo', 'texto'] as $k) {
                            if (!empty($item[$k])) $_cc['diferenciais'][$i][$k] = $item[$k];
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
<title>AserNet - Câmeras de segurança</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<section class="camera-security">
    <div class="camera-security__hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="camera-security__hero-copy">
                        <h1 class="camera-security__hero-title">Segurança de verdade, sem complicação.</h1>
                        <p class="camera-security__hero-text">Monitore sua casa ou empresa em tempo real, direto pelo celular.</p>

                        <ul class="camera-security__hero-list">
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Instalação inclusa</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Acesso remoto pelo aplicativo</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Equipamentos inclusos em comodato</li>
                            <li><i class="icon-checkmark" aria-hidden="true"></i>Suporte AserNet</li>
                        </ul>

                        <p class="camera-security__hero-price">Planos a partir de <strong>R$ 49,90<small>/mês</small></strong></p>

                        <div class="camera-security__hero-actions">
                            <a class="camera-security__button camera-security__button--primary" href="<?= BASE_URL ?>/contato"><i class="icon-security" aria-hidden="true"></i>Quero proteger meu imóvel</a>
                            <a class="camera-security__button camera-security__button--outline" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i>0800 222 5262</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-6" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="camera-security__body">
        <section class="camera-security__pain">
            <div class="container">
                <h2><?= htmlspecialchars($_cc['dor_titulo']) ?> <strong><?= htmlspecialchars($_cc['dor_destaque']) ?></strong></h2>
                <div class="camera-security__pain-grid">
                    <?php foreach ($_cc['dor_items'] as $i => $item): ?>
                    <article>
                        <i class="<?= $_dorIcons[$i] ?? 'icon-home' ?>" aria-hidden="true"></i>
                        <span><?= htmlspecialchars($item) ?></span>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="camera-security__monitor">
            <div class="container">
                <h2 class="camera-security__title"><?= htmlspecialchars($_cc['monitor_titulo']) ?></h2>
                <p class="camera-security__text"><?= htmlspecialchars($_cc['monitor_texto']) ?></p>

                <div class="camera-security__monitor-grid">
                    <ul class="camera-security__checks">
                        <?php foreach ($_cc['monitor_bullets'] as $bullet): ?>
                        <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($bullet) ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="camera-security__monitor-visual">
                        <img class="camera-security__monitor-image" src="<?= BASE_URL ?>/images/cameraseguranca/<?= htmlspecialchars($_cc['monitor_imagem']) ?>" alt="Aplicativo de câmeras com família em casa">
                    </div>
                </div>

                <div class="camera-security__audience">
                    <a href="<?= BASE_URL ?>/contato">
                        <i class="icon-home" aria-hidden="true"></i>
                        <span><strong><?= htmlspecialchars($_cc['monitor_casa_titulo']) ?></strong><?= htmlspecialchars($_cc['monitor_casa_texto']) ?></span>
                        <img src="<?= BASE_URL ?>/images/cameraseguranca/<?= htmlspecialchars($_cc['monitor_casa_imagem']) ?>" alt="">
                    </a>

                    <a href="<?= BASE_URL ?>/contato">
                        <i class="icon-paraempresa" aria-hidden="true"></i>
                        <span><strong><?= htmlspecialchars($_cc['monitor_empresa_titulo']) ?></strong><?= htmlspecialchars($_cc['monitor_empresa_texto']) ?></span>
                        <img src="<?= BASE_URL ?>/images/cameraseguranca/<?= htmlspecialchars($_cc['monitor_empresa_imagem']) ?>" alt="">
                    </a>
                </div>
            </div>
        </section>

        <section class="camera-security__plans-section">
            <div class="container">
                <h2 class="camera-security__title"><?= htmlspecialchars($_cc['planos_titulo']) ?></h2>

                <div class="camera-security__plans">
                    <?php foreach ($_cc['planos'] as $i => $plano):
                        $mod   = $_planoMods[$i]    ?? '';
                        $badge = $_planoBadges[$i]  ?? null;
                        $cid   = $_planoIds[$i]     ?? 'camera-' . ($i + 1);
                    ?>
                    <article class="camera-security__plan<?= $mod ? ' ' . $mod : '' ?>">
                        <?php if ($badge): ?><span><?= htmlspecialchars($badge) ?></span><?php endif; ?>
                        <div class="camera-security__plan-copy">
                            <h3><?= htmlspecialchars($plano['nome']) ?></h3>
                            <p><?= htmlspecialchars($plano['descricao']) ?></p>
                        </div>
                        <img src="<?= BASE_URL ?>/images/cameraseguranca/<?= htmlspecialchars($plano['imagem']) ?>" alt="">
                        <p class="camera-security__price"><span>R$</span> <?= htmlspecialchars($plano['preco']) ?><small>/mês</small></p>
                        <ul>
                            <?php foreach ($plano['bullets'] as $b): ?>
                            <li><?= htmlspecialchars($b) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="<?= BASE_URL ?>/carrinho"
                           data-cart-add
                           data-cart-id="<?= $cid ?>"
                           data-cart-group="cameras-seguranca"
                           data-cart-title="<?= htmlspecialchars($plano['nome']) ?>"
                           data-cart-subtitle="<?= htmlspecialchars($plano['descricao']) ?>"
                           data-cart-price="R$ <?= htmlspecialchars($plano['preco']) ?>/mês"
                           data-cart-icon="icon-casino-cctv"
                           data-cart-url="<?= BASE_URL ?>/cameradeseguranca">Contratar</a>
                    </article>
                    <?php endforeach; ?>
                </div>

                <a class="camera-security__proposal" href="<?= BASE_URL ?>/contato">Solicitar proposta</a>
            </div>
        </section>

        <section class="camera-security__how">
            <div class="container">
                <div class="camera-security__how-grid">
                    <div>
                        <h2 class="camera-security__title"><?= htmlspecialchars($_cc['como_titulo']) ?></h2>
                        <p class="camera-security__text"><?= htmlspecialchars($_cc['como_texto']) ?></p>

                        <div class="camera-security__steps">
                            <?php foreach ($_cc['como_steps'] as $i => $step): ?>
                            <article>
                                <i class="<?= $_comoIcons[$i] ?? 'icon-escolherplano' ?>" aria-hidden="true"></i>
                                <b><?= $i + 1 ?></b>
                                <span><?= htmlspecialchars($step) ?></span>
                            </article>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <aside class="camera-security__app-card">
                        <div>
                            <h3><?= htmlspecialchars($_cc['como_app_titulo']) ?></h3>
                            <p><?= htmlspecialchars($_cc['como_app_texto']) ?></p>
                            <ul>
                                <?php foreach ($_cc['como_app_bullets'] as $b): ?>
                                <li><i class="icon-checkmark" aria-hidden="true"></i><?= htmlspecialchars($b) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <img src="<?= BASE_URL ?>/images/cameraseguranca/<?= htmlspecialchars($_cc['como_app_imagem']) ?>" alt="Aplicativo de monitoramento no celular">
                    </aside>
                </div>
            </div>
        </section>

        <section class="camera-security__differentials">
            <div class="container">
                <h2 class="camera-security__title"><?= htmlspecialchars($_cc['diferenciais_titulo']) ?></h2>
                <div class="camera-security__differentials-grid">
                    <?php foreach ($_cc['diferenciais'] as $i => $dif): ?>
                    <article>
                        <i class="<?= $_difIcons[$i] ?? 'icon-engineer' ?>" aria-hidden="true"></i>
                        <h3><?= htmlspecialchars($dif['titulo']) ?></h3>
                        <p><?= htmlspecialchars($dif['texto']) ?></p>
                    </article>
                    <?php endforeach; ?>
                </div>

                <div class="camera-security__trust">
                    <img src="<?= BASE_URL ?>/images/cameraseguranca/logoGoogle.png" alt="Google">
                    <p><strong>★★★★★</strong><br>avaliações no Google</p>
                    <span><i class="icon-group" aria-hidden="true"></i>Atendimento local de verdade</span>
                </div>
            </div>
        </section>

        <section class="camera-security__cta">
            <div class="container">
                <div class="camera-security__cta-box">
                    <h2>Mais tranquilidade para sua casa ou empresa</h2>
                    <div class="camera-security__cta-actions">
                        <a class="camera-security__cta-button camera-security__cta-button--whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="camera-security__cta-button" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><span>Solicitar análise de segurança</span></a>
                    </div>
                    <img src="<?= BASE_URL ?>/images/cameraseguranca/img1Camera.png" alt="">
                </div>
            </div>
        </section>

        <section class="camera-security__footer-benefits">
            <div class="container">
                <span><i class="icon-engineer" aria-hidden="true"></i>Instalação inclusa</span>
                <span><i class="icon-equipamentocomodato" aria-hidden="true"></i>Equipamentos em comodato</span>
                <span><i class="icon-contrato" aria-hidden="true"></i>Contratos sem fidelidade</span>
                <span><i class="icon-payment" aria-hidden="true"></i>Pagamento facilitado</span>
                <span><i class="icon-support" aria-hidden="true"></i>Suporte local</span>
            </div>
        </section>
    </div>
</section>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/cameradeseguranca/cameradeseguranca.js?' . $version . '"></script>';
?>

</body>
</html>
