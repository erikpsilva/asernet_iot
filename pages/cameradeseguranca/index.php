<?php
// ── Banner (hero) ──────────────────────────────────────────────────────────
$_bn = [
    'titulo'             => 'AserNet',
    'titulo_destaque'    => 'Segurança Inteligente',
    'titulo_complemento' => '',
    'texto'              => 'Proteção completa para o que realmente importa.',
    'bullets'            => ['Gravação em nuvem', 'Detecção de pessoas com IA', 'Acesso ao vivo onde estiver', 'Manutenção e troca de equipamentos', 'Suporte 24 horas'],
    'preco'              => '',
    'btn1_texto'         => 'Quero proteger meu imóvel',
    'btn2_texto'         => '0800 222 5262',
    'imagem'             => '',
];
try {
    require_once ROOT . '/config/database.php';
    $_s_bn = getDbConnection()->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'cameras_banner' LIMIT 1");
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
if ($_bn['titulo'] === 'Segurança de verdade,' && $_bn['titulo_destaque'] === 'sem complicação.') {
    $_bn['titulo'] = 'AserNet';
    $_bn['titulo_destaque'] = 'Segurança Inteligente';
    $_bn['texto'] = 'Proteção completa para o que realmente importa.';
    $_bn['bullets'] = ['Gravação em nuvem', 'Detecção de pessoas com IA', 'Acesso ao vivo onde estiver', 'Manutenção e troca de equipamentos', 'Suporte 24 horas'];
    $_bn['preco'] = '';
}

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
        ['nome' => 'Essencial', 'descricao' => 'Ideal para apartamentos e pequenas residências.',       'quantidade' => '02 câmeras', 'taxa' => '+ R$ 120,00 Taxa de Instalação e Configuração', 'imagem' => 'img2cameras.png', 'bullets' => ['Aplicativo exclusivo', 'Visualização ao vivo em tempo real', 'Detecção de pessoas com IA', 'Gravação em nuvem', 'Manutenção inclusa e troca garantida', 'Suporte 24 horas'], 'preco' => '79,90'],
        ['nome' => 'Plus',      'descricao' => 'Cobertura completa para residências médias.',          'quantidade' => '04 câmeras', 'taxa' => '+ R$ 240,00 Taxa de Instalação e Configuração', 'imagem' => 'img4cameras.png', 'bullets' => ['Aplicativo exclusivo', 'Visualização ao vivo em tempo real', 'Detecção de pessoas com IA', 'Gravação em nuvem', 'Manutenção inclusa e troca garantida', 'Suporte 24 horas'], 'preco' => '149,90'],
        ['nome' => 'Premium',   'descricao' => 'Proteção ampliada para imóveis maiores.',              'quantidade' => '06 câmeras', 'taxa' => '+ R$ 360,00 Taxa de Instalação e Configuração', 'imagem' => 'img6cameras.png', 'bullets' => ['Aplicativo exclusivo', 'Visualização ao vivo em tempo real', 'Detecção de pessoas com IA', 'Gravação em nuvem', 'Manutenção inclusa e troca garantida', 'Suporte 24 horas'], 'preco' => '219,90'],
        ['nome' => 'Total',     'descricao' => 'Proteção máxima para grandes residências e empresas.', 'quantidade' => '08 câmeras', 'taxa' => '+ R$ 480,00 Taxa de Instalação e Configuração', 'imagem' => 'img8cameras.png', 'bullets' => ['Aplicativo exclusivo', 'Visualização ao vivo em tempo real', 'Detecção de pessoas com IA', 'Gravação em nuvem', 'Manutenção inclusa e troca garantida', 'Suporte 24 horas'], 'preco' => '289,90'],
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
$_planoIds    = ['camera-2', 'camera-4', 'camera-6', 'camera-8'];
$_planoBadges = [null, 'Mais contratado', null, null];
$_planoMods   = ['', 'camera-security__plan--featured', '', ''];
$_comoIcons   = ['icon-escolherplano', 'icon-calendar', 'icon-app', 'icon-view'];
$_bnIcons      = ['icon-cloud', 'icon-security', 'icon-mobile-phone', 'icon-equipamentocomodato', 'icon-customersupport'];

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
            if (!empty($db['planos']) && is_array($db['planos']) && count($db['planos']) >= count($_cc['planos'])) {
                foreach ($db['planos'] as $i => $plano) {
                    if (isset($_cc['planos'][$i]) && is_array($plano)) {
                        foreach (['nome', 'descricao', 'preco', 'imagem', 'quantidade', 'taxa'] as $k) {
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
    <div class="camera-security__hero"<?= !empty($_bn['imagem']) ? ' style="--hero-image:url(\'' . BASE_URL . '/images/banners/cameras/' . htmlspecialchars($_bn['imagem']) . '\')"' : '' ?>>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="camera-security__hero-copy">
                        <h1 class="camera-security__hero-title">
                            <?= htmlspecialchars($_bn['titulo']) ?>
                            <?php if (!empty($_bn['titulo_destaque'])): ?><strong><?= htmlspecialchars($_bn['titulo_destaque']) ?></strong><?php endif; ?>
                            <?php if (!empty($_bn['titulo_complemento'])): ?><?= htmlspecialchars($_bn['titulo_complemento']) ?><?php endif; ?>
                        </h1>
                        <p class="camera-security__hero-text"><?= htmlspecialchars($_bn['texto']) ?></p>

                        <?php if (!empty($_bn['bullets'])): ?>
                        <ul class="camera-security__hero-list">
                            <?php foreach ($_bn['bullets'] as $_i => $_b): ?>
                            <li><i class="<?= $_bnIcons[$_i] ?? 'icon-checkmark' ?>" aria-hidden="true"></i><?= htmlspecialchars($_b) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php if (!empty($_bn['preco'])): ?>
                        <p class="camera-security__hero-price"><?= htmlspecialchars($_bn['preco']) ?></p>
                        <?php endif; ?>

                        <?php if (!empty($_bn['btn1_texto']) || !empty($_bn['btn2_texto'])): ?>
                        <div class="camera-security__hero-actions">
                            <?php if (!empty($_bn['btn1_texto'])): ?>
                            <a class="camera-security__button camera-security__button--primary" href="<?= BASE_URL ?>/contato"><i class="icon-security" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn1_texto']) ?></a>
                            <?php endif; ?>
                            <?php if (!empty($_bn['btn2_texto'])): ?>
                            <a class="camera-security__button camera-security__button--outline" href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i><?= htmlspecialchars($_bn['btn2_texto']) ?></a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
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
                        <div class="camera-security__plan-head">
                            <i class="icon-security" aria-hidden="true"></i>
                            <div class="camera-security__plan-copy">
                                <strong>Proteção</strong>
                                <h3><?= htmlspecialchars($plano['nome']) ?></h3>
                                <p><?= htmlspecialchars($plano['descricao']) ?></p>
                            </div>
                        </div>
                        <img src="<?= BASE_URL ?>/images/cameraseguranca/<?= htmlspecialchars($plano['imagem']) ?>" alt="">
                        <?php if (!empty($plano['quantidade'])): ?>
                        <p class="camera-security__plan-quantity"><?= htmlspecialchars($plano['quantidade']) ?></p>
                        <?php endif; ?>
                        <p class="camera-security__price"><span>R$</span> <?= htmlspecialchars($plano['preco']) ?><small>/mês</small></p>
                        <?php if (!empty($plano['taxa'])): ?>
                        <p class="camera-security__plan-fee"><?= htmlspecialchars($plano['taxa']) ?></p>
                        <?php endif; ?>
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
                           data-cart-subtitle="<?= htmlspecialchars(trim(($plano['quantidade'] ?? '') . ' - ' . $plano['descricao'], ' -')) ?>"
                           data-cart-price="R$ <?= htmlspecialchars($plano['preco']) ?>/mês"
                           data-cart-icon="icon-casino-cctv"
                           data-cart-url="<?= BASE_URL ?>/cameradeseguranca">Contratar agora</a>
                    </article>
                    <?php endforeach; ?>
                </div>

                <a class="camera-security__proposal" href="<?= BASE_URL ?>/contato">Solicitar proposta</a>
            </div>
        </section>

        <section class="camera-security__comparison">
            <div class="container">
                <h2>Comprar c&acirc;meras ou assinar um sistema completo?</h2>
                <p class="camera-security__comparison-subtitle">Mais economia, mais seguran&ccedil;a e zero preocupa&ccedil;&atilde;o com a AserNet.</p>

                <div class="camera-security__comparison-grid">
                    <article class="camera-security__comparison-card camera-security__comparison-card--buy">
                        <div class="camera-security__comparison-head">
                            <span class="camera-security__comparison-icon camera-security__comparison-icon--bad" aria-hidden="true">&times;</span>
                            <div>
                                <h3>Comprar por conta pr&oacute;pria</h3>
                                <p>Investimento inicial aproximado para 2 c&acirc;meras:</p>
                                <strong>R$ 1.200 a R$ 1.500</strong>
                            </div>
                        </div>

                        <div class="camera-security__comparison-body">
                            <ul class="camera-security__comparison-list camera-security__comparison-list--bad">
                                <li>Comprar c&acirc;meras</li>
                                <li>Comprar cabos, canaletas e conectores</li>
                                <li>Comprar switch PoE e r&eacute;gua de energia</li>
                                <li>Contratar instalador por fora</li>
                                <li>Configurar aplicativo sozinho</li>
                                <li>Sem manuten&ccedil;&atilde;o inclusa</li>
                                <li>Sem troca garantida dos equipamentos</li>
                                <li>Sem suporte AserNet</li>
                            </ul>
                            <img src="<?= BASE_URL ?>/images/cameraseguranca/imgComparPorContaPropria.png" alt="Equipamentos necess&aacute;rios para comprar c&acirc;meras por conta pr&oacute;pria">
                        </div>

                        <div class="camera-security__comparison-note camera-security__comparison-note--bad">
                            <i class="icon-diagram" aria-hidden="true"></i>
                            <span>Alto investimento, sem garantia de suporte e manuten&ccedil;&atilde;o.</span>
                        </div>
                    </article>

                    <div class="camera-security__comparison-vs" aria-hidden="true">VS</div>

                    <article class="camera-security__comparison-card camera-security__comparison-card--aser">
                        <div class="camera-security__comparison-head">
                            <span class="camera-security__comparison-icon" aria-hidden="true"><i class="icon-security"></i></span>
                            <div>
                                <h3>Assinar AserNet <strong>Seguran&ccedil;a Inteligente</strong></h3>
                                <p>Implanta&ccedil;&atilde;o a partir de <b>R$ 120,00</b> + mensalidade</p>
                            </div>
                        </div>

                        <div class="camera-security__comparison-body">
                            <ul class="camera-security__comparison-list camera-security__comparison-list--good">
                                <li>C&acirc;meras inclusas</li>
                                <li>Cabo de rede de qualidade</li>
                                <li>Canaletas e conectores inclusos</li>
                                <li>Switch PoE incluso quando necess&aacute;rio</li>
                                <li>R&eacute;gua de energia inclusa</li>
                                <li>Instala&ccedil;&atilde;o profissional</li>
                                <li>Aplicativo exclusivo</li>
                                <li>Detec&ccedil;&atilde;o de pessoas com IA</li>
                                <li>Grava&ccedil;&atilde;o em nuvem</li>
                                <li>Manuten&ccedil;&atilde;o inclusa</li>
                                <li>Suporte AserNet</li>
                                <li>Troca de equipamentos em caso de defeito</li>
                            </ul>
                            <img src="<?= BASE_URL ?>/images/cameraseguranca/imgAssinarAsernetSegurancaInteligente.png" alt="Sistema AserNet Seguran&ccedil;a Inteligente com aplicativo e grava&ccedil;&atilde;o em nuvem">
                        </div>

                        <div class="camera-security__comparison-note">
                            <i class="icon-security" aria-hidden="true"></i>
                            <span>Tudo incluso, suporte local e tranquilidade todos os dias para voc&ecirc; e sua fam&iacute;lia.</span>
                        </div>
                    </article>
                </div>

                <div class="camera-security__comparison-benefits">
                    <article><i class="icon-engineer" aria-hidden="true"></i><strong>Instala&ccedil;&atilde;o profissional</strong><span>Equipe especializada AserNet.</span></article>
                    <article><i class="icon-customersupport" aria-hidden="true"></i><strong>Suporte local 24 horas</strong><span>Atendimento r&aacute;pido e humanizado.</span></article>
                    <article><i class="icon-cloud" aria-hidden="true"></i><strong>Grava&ccedil;&atilde;o em nuvem segura</strong><span>Seus v&iacute;deos protegidos 24 horas por dia.</span></article>
                    <article><b>IA</b><strong>Intelig&ecirc;ncia Artificial</strong><span>Detec&ccedil;&atilde;o de pessoas e alertas inteligentes.</span></article>
                    <article><i class="icon-gear" aria-hidden="true"></i><strong>Troca garantida de equipamentos</strong><span>Em caso de defeito, furto ou danos naturais.</span></article>
                    <article><b>$</b><strong>Economia de verdade</strong><span>Sem gastos extras com manuten&ccedil;&atilde;o.</span></article>
                </div>
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

                <?php include ROOT . '/includes/trust-google/trust-google.php'; ?>
            </div>
        </section>

        <section class="camera-security__cta">
            <div class="container">
                <div class="camera-security__cta-box">
                    <h2>Mais tranquilidade para sua casa ou empresa</h2>
                    <div class="camera-security__cta-actions">
                        <a class="camera-security__cta-button camera-security__cta-button--whatsapp" href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
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
