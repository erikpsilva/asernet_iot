<?php
// ── Banner (hero) ──────────────────────────────────────────────────────────
$_bn_inicio = [
    'titulo'             => 'Mais que internet.',
    'titulo_destaque'    => 'Soluções completas',
    'titulo_complemento' => 'para sua vida.',
    'texto'              => 'Tecnologia, conectividade e segurança para sua casa ou empresa funcionarem melhor.',
    'bullets'            => ['Internet', 'Wi-Fi inteligente', 'Segurança', 'Mobilidade', 'Telefonia', 'Soluções empresariais'],
    'preco'              => '',
    'btn1_texto'         => 'Falar com um consultor',
    'btn2_texto'         => '0800 222 5262',
    'imagem'             => '',
];
try {
    require_once ROOT . '/config/database.php';
    $_pdo_bn = getDbConnection();
    $_row_bn = $_pdo_bn->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'inicio_banner' LIMIT 1");
    $_row_bn->execute();
    $_row_bn = $_row_bn->fetch();
    if ($_row_bn && !empty($_row_bn['setting_value'])) {
        $_db_bn = json_decode($_row_bn['setting_value'], true);
        if (is_array($_db_bn)) {
            foreach (['titulo','titulo_destaque','titulo_complemento','texto','preco','btn1_texto','btn2_texto','imagem'] as $_k_bn) {
                if (isset($_db_bn[$_k_bn]) && strlen((string)$_db_bn[$_k_bn]) > 0) $_bn_inicio[$_k_bn] = $_db_bn[$_k_bn];
            }
            if (!empty($_db_bn['bullets']) && is_array($_db_bn['bullets'])) $_bn_inicio['bullets'] = $_db_bn['bullets'];
        }
    }
    unset($_pdo_bn, $_row_bn, $_db_bn, $_k_bn);
} catch (Throwable $_e_bn) { unset($_e_bn); }

$homeSorteioDate = '2027-01-31T00:00:00-03:00';
$homeRegTitulo   = 'Regulamento da Promo&ccedil;&atilde;o';
$homeRegTexto    = '<p>O regulamento ainda n&atilde;o foi cadastrado.</p>';
$_homeContent = [
    'intro_titulo'    => 'Uma empresa. Diversas soluções conectadas.',
    'intro_subtitulo' => 'A AserNet integra internet, mobilidade, segurança e conectividade para simplificar sua rotina e melhorar sua experiência.',
    'cards_casa' => [
        ['titulo'=>'Internet Residencial', 'descricao'=>'1 Giga com estabilidade e cobertura inteligente.',     'imagem'=>'imgInternetResidencial.png', 'link_texto'=>'Ver planos',       'link_href'=>'/residencial'],
        ['titulo'=>'Wi-Fi Mesh',           'descricao'=>'Cobertura inteligente para toda a casa.',              'imagem'=>'imgWifiMesh.png',             'link_texto'=>'Conhecer solução', 'link_href'=>'/solucoes'],
        ['titulo'=>'Câmeras de Segurança', 'descricao'=>'Monitoramento em tempo real pelo celular.',            'imagem'=>'imgCameraDeSeguranca.png',    'link_texto'=>'Ver solução',      'link_href'=>'/solucoes'],
        ['titulo'=>'Aser Mobile',          'descricao'=>'Conectividade dentro e fora de casa.',                 'imagem'=>'imgAserMobile.png',           'link_texto'=>'Ver planos',       'link_href'=>'/residencial'],
    ],
    'cards_empresa' => [
        ['titulo'=>'Internet PME',         'descricao'=>'Conectividade estável para empresas.',                 'imagem'=>'imgInternetPME.png',          'link_texto'=>'Ver soluções',     'link_href'=>'/empresas'],
        ['titulo'=>'Wi-Fi Profissional',   'descricao'=>'Rede preparada para múltiplos dispositivos.',          'imagem'=>'imgWifiProfissional.png',     'link_texto'=>'Ver solução',      'link_href'=>'/solucoes'],
        ['titulo'=>'Telefonia Empresarial','descricao'=>'Mais comunicação e produtividade.',                    'imagem'=>'imgTelefoniaEmpresarial.png', 'link_texto'=>'Ver solução',      'link_href'=>'/solucoes'],
        ['titulo'=>'Link Dedicado',        'descricao'=>'Conexão exclusiva para operações críticas.',           'imagem'=>'imgLinkDEdicado.png',         'link_texto'=>'Ver solução',      'link_href'=>'/solucoes'],
    ],
    'cards_seguranca' => [
        ['titulo'=>'Rastreamento Veicular','descricao'=>'Acompanhe seu veículo em tempo real pelo celular.',    'imagem'=>'imgRastreamentoVeicular.png', 'link_texto'=>'Ver solução',      'link_href'=>'/solucoes'],
        ['titulo'=>'Tag Localizadora',     'descricao'=>'Mais praticidade e segurança para o que importa.',     'imagem'=>'imgTagLocalizadora.png',      'link_texto'=>'Ver solução',      'link_href'=>'/solucoes'],
    ],
];
try {
    require_once ROOT . '/config/database.php';
    $_pdo  = getDbConnection();
    $_stmt = $_pdo->query("SELECT setting_key, setting_value FROM system_settings WHERE setting_key IN ('sorteio_date','regulamento_titulo','regulamento_texto','home_content')");
    $_cfg  = [];
    foreach ($_stmt->fetchAll() as $r) { $_cfg[$r['setting_key']] = $r['setting_value']; }
    if (!empty($_cfg['sorteio_date']))       $homeSorteioDate = addslashes($_cfg['sorteio_date']) . '-03:00';
    if (!empty($_cfg['regulamento_titulo'])) $homeRegTitulo   = htmlspecialchars($_cfg['regulamento_titulo'], ENT_QUOTES, 'UTF-8');
    if (!empty($_cfg['regulamento_texto']))  $homeRegTexto    = $_cfg['regulamento_texto'];
    if (!empty($_cfg['home_content'])) {
        $_db = json_decode($_cfg['home_content'], true);
        if (is_array($_db)) {
            if (!empty($_db['intro_titulo']))    $_homeContent['intro_titulo']    = $_db['intro_titulo'];
            if (!empty($_db['intro_subtitulo'])) $_homeContent['intro_subtitulo'] = $_db['intro_subtitulo'];
            foreach (['cards_casa','cards_empresa','cards_seguranca'] as $_k) {
                if (!empty($_db[$_k]) && is_array($_db[$_k])) {
                    foreach ($_db[$_k] as $_i => $_c) {
                        if (isset($_homeContent[$_k][$_i]) && is_array($_c)) {
                            $_homeContent[$_k][$_i] = array_merge($_homeContent[$_k][$_i], array_filter($_c, 'strlen'));
                        }
                    }
                }
            }
        }
    }
    unset($_pdo, $_stmt, $_cfg, $_db, $_k, $_i, $_c);
} catch (Throwable $_e) { unset($_e); }
?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Início</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<section class="home">
    <div class="home__hero"<?= !empty($_bn_inicio['imagem']) ? ' style="background-image:url(\'' . BASE_URL . '/images/banners/inicio/' . htmlspecialchars($_bn_inicio['imagem']) . '\')"' : '' ?>>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-7">
                    <div class="home__content">
                        <h1 class="home__title">
                            <?= htmlspecialchars($_bn_inicio['titulo']) ?>
                            <?php if (!empty($_bn_inicio['titulo_destaque'])): ?><strong><?= htmlspecialchars($_bn_inicio['titulo_destaque']) ?></strong><?php endif; ?>
                            <?php if (!empty($_bn_inicio['titulo_complemento'])): ?><?= htmlspecialchars($_bn_inicio['titulo_complemento']) ?><?php endif; ?>
                        </h1>

                        <p class="home__text"><?= htmlspecialchars($_bn_inicio['texto']) ?></p>

                        <?php if (!empty($_bn_inicio['bullets'])): ?>
                        <ul class="home__features">
                            <?php foreach ($_bn_inicio['bullets'] as $_b): ?>
                            <li class="home__feature"><i class="icon icon-check" aria-hidden="true"></i><?= htmlspecialchars($_b) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <div class="home__actions">
                            <a class="home__button home__button--primary" href="<?= BASE_URL ?>/contato">
                                <i class="icon icon-talk" aria-hidden="true"></i>
                                <span><?= htmlspecialchars($_bn_inicio['btn1_texto']) ?></span>
                            </a>
                            <a class="home__button home__button--outline" href="tel:08002225262">
                                <i class="icon icon-phone" aria-hidden="true"></i>
                                <span><?= htmlspecialchars($_bn_inicio['btn2_texto']) ?></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-5" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <div class="home__cruise">
        <div class="container">
            <section class="home__cruise-banner" aria-label="Conex&atilde;o em alto mar">
                <div class="home__cruise-copy">
                    <h2>Conex&atilde;o <strong>em alto mar</strong></h2>
                    <p>Concorra a um cruzeiro internacional a bordo do <strong>MSC Divina.</strong></p>
                    <ul>
                        <li><i class="icon-checkmark" aria-hidden="true"></i>7 noites de viagem</li>
                        <li><i class="icon-pin" aria-hidden="true"></i>Destinos incr&iacute;veis</li>
                        <li><i class="icon-group" aria-hidden="true"></i>Experi&ecirc;ncia completa para 2 pessoas</li>
                    </ul>
                </div>

                <div class="home__cruise-info">
                    <div class="home__cruise-partners">
                        <span>Uma experi&ecirc;ncia inesquec&iacute;vel em parceria com</span>
                        <div>
                            <img src="<?= BASE_URL ?>/images/cruzeiro/logo.png" alt="AserNet IoT Services">
                            <b aria-hidden="true">&times;</b>
                            <img src="<?= BASE_URL ?>/images/cruzeiro/logoBeFly.webp" alt="BeFly">
                        </div>
                    </div>

                    <div class="home__cruise-countdown" aria-label="Contagem regressiva para o sorteio">
                        <span>Sorteio em:</span>
                        <div><strong>182</strong><small>Dias</small></div>
                        <div><strong>14</strong><small>Horas</small></div>
                        <div><strong>32</strong><small>Minutos</small></div>
                        <div><strong>27</strong><small>Segundos</small></div>
                    </div>

                    <div class="home__cruise-actions">
                        <a class="home__cruise-button home__cruise-button--primary" href="<?= BASE_URL ?>/cruzeiro">Quero participar <i class="icon-arrowright" aria-hidden="true"></i></a>
                        <a class="home__cruise-button" id="btnVerRegulamentoHome" href="#">Ver regulamento</a>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="home__body">
        <div class="container">
            <div class="home__intro">
                <h2 class="home__intro-title"><?= htmlspecialchars($_homeContent['intro_titulo']) ?></h2>
                <p class="home__intro-text"><?= htmlspecialchars($_homeContent['intro_subtitulo']) ?></p>
            </div>

            <section class="home__section">
                <div class="home__section-heading">
                    <i class="icon icon-home" aria-hidden="true"></i>
                    <h2 class="home__section-title">Soluções para sua casa</h2>
                </div>

                <div class="home__cards home__cards--home">
                    <?php $_iconesCasa = ['icon-home','icon-wifi','icon-security','icon-mobile-phone']; ?>
                    <?php foreach ($_homeContent['cards_casa'] as $_i => $_c): ?>
                    <article class="home__card">
                        <div class="home__card-heading">
                            <i class="icon <?= $_iconesCasa[$_i] ?? 'icon-home' ?>" aria-hidden="true"></i>
                            <h3 class="home__card-title"><?= htmlspecialchars($_c['titulo']) ?></h3>
                        </div>
                        <p class="home__card-text"><?= htmlspecialchars($_c['descricao']) ?></p>
                        <img class="home__card-image" src="<?= BASE_URL ?>/images/home/<?= htmlspecialchars($_c['imagem']) ?>" alt="<?= htmlspecialchars($_c['titulo']) ?>">
                        <a class="home__card-link" href="<?= BASE_URL ?><?= htmlspecialchars($_c['link_href']) ?>"><?= htmlspecialchars($_c['link_texto']) ?></a>
                    </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="home__section">
                <div class="home__section-heading">
                    <i class="icon icon-cloud" aria-hidden="true"></i>
                    <h2 class="home__section-title">Soluções para empresas</h2>
                </div>

                <div class="home__cards home__cards--business">
                    <?php $_iconesEmpresa = ['icon-construcao','icon-wifi','icon-phone','icon-servidor']; ?>
                    <?php foreach ($_homeContent['cards_empresa'] as $_i => $_c): ?>
                    <article class="home__card">
                        <div class="home__card-heading">
                            <i class="icon <?= $_iconesEmpresa[$_i] ?? 'icon-wifi' ?>" aria-hidden="true"></i>
                            <h3 class="home__card-title"><?= htmlspecialchars($_c['titulo']) ?></h3>
                        </div>
                        <p class="home__card-text"><?= htmlspecialchars($_c['descricao']) ?></p>
                        <img class="home__card-image" src="<?= BASE_URL ?>/images/home/<?= htmlspecialchars($_c['imagem']) ?>" alt="<?= htmlspecialchars($_c['titulo']) ?>">
                        <a class="home__card-link" href="<?= BASE_URL ?><?= htmlspecialchars($_c['link_href']) ?>"><?= htmlspecialchars($_c['link_texto']) ?></a>
                    </article>
                    <?php endforeach; ?>
                </div>

                <a class="home__wide-link" href="<?= BASE_URL ?>/empresas">Conhecer soluções empresariais</a>
            </section>

            <section class="home__section home__section--security">
                <div class="home__security-content">
                    <div class="home__section-heading">
                        <i class="icon icon-security" aria-hidden="true"></i>
                        <div>
                            <h2 class="home__section-title">Segurança e monitoramento</h2>
                            <p class="home__section-subtitle">Mais controle para sua rotina.</p>
                        </div>
                    </div>

                    <div class="home__security-list">
                        <?php foreach ($_homeContent['cards_seguranca'] as $_c): ?>
                        <article class="home__security-card">
                            <div>
                                <h3 class="home__security-title"><?= htmlspecialchars($_c['titulo']) ?></h3>
                                <p class="home__security-text"><?= htmlspecialchars($_c['descricao']) ?></p>
                                <a class="home__card-link home__security-link" href="<?= BASE_URL ?><?= htmlspecialchars($_c['link_href']) ?>"><?= htmlspecialchars($_c['link_texto']) ?></a>
                            </div>
                            <img class="home__security-image" src="<?= BASE_URL ?>/images/home/<?= htmlspecialchars($_c['imagem']) ?>" alt="<?= htmlspecialchars($_c['titulo']) ?>">
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>

                <aside class="home__security-box">
                    <h3 class="home__security-box-title">Tecnologia que protege o que é importante.</h3>
                    <ul class="home__security-checks">
                        <li><i class="icon icon-check" aria-hidden="true"></i>Monitoramento em tempo real</li>
                        <li><i class="icon icon-check" aria-hidden="true"></i>Alertas e histórico de rotas</li>
                        <li><i class="icon icon-check" aria-hidden="true"></i>Mais segurança e tranquilidade</li>
                    </ul>
                    <a class="home__security-button" href="<?= BASE_URL ?>/solucoes">Ver soluções de rastreamento</a>
                </aside>
            </section>

            <section class="home__flow">
                <h2 class="home__flow-title">Soluções que funcionam juntas.</h2>
                <p class="home__flow-text">Internet, Wi-Fi, mobilidade, telefonia e segurança integrados para facilitar sua rotina.</p>

                <div class="home__flow-list">
                    <article class="home__flow-item">
                        <span class="home__flow-icon"><i class="icon icon-wifi" aria-hidden="true"></i></span>
                        <h3>Internet</h3>
                        <p>Conexão rápida e estável.</p>
                    </article>
                    <article class="home__flow-item">
                        <span class="home__flow-icon home__flow-icon--green"><i class="icon icon-casino-cctv" aria-hidden="true"></i></span>
                        <h3>Câmeras</h3>
                        <p>Proteção em tempo real para sua casa ou empresa.</p>
                    </article>
                    <article class="home__flow-item">
                        <span class="home__flow-icon home__flow-icon--purple"><i class="icon icon-phone" aria-hidden="true"></i></span>
                        <h3>Aser Mobile</h3>
                        <p>Conectividade dentro e fora de casa.</p>
                    </article>
                    <article class="home__flow-item">
                        <span class="home__flow-icon home__flow-icon--orange"><i class="icon icon-car" aria-hidden="true"></i></span>
                        <h3>Rastreamento</h3>
                        <p>Mais controle e segurança para seu veículo.</p>
                    </article>
                    <article class="home__flow-item">
                        <span class="home__flow-icon"><i class="icon icon-phone" aria-hidden="true"></i></span>
                        <h3>Telefonia</h3>
                        <p>Comunicação eficiente para sua família ou sua empresa.</p>
                    </article>
                </div>
            </section>

            <section class="home__trust">
                <div class="home__trust-item home__trust-item--google">
                    <img class="home__google" src="<?= BASE_URL ?>/images/home/logoGoogle.png" alt="Google">
                    <p><strong>5.0 <span class="home__stars">★★★★★</span></strong><br>+ de 3.000 avaliações no Google</p>
                </div>
                <div class="home__trust-item">
                    <i class="icon icon-group" aria-hidden="true"></i>
                    <p>Milhares de clientes satisfeitos</p>
                </div>
                <div class="home__trust-item">
                    <i class="icon icon-support" aria-hidden="true"></i>
                    <p>Suporte local de verdade</p>
                </div>
                <div class="home__trust-item">
                    <i class="icon icon-setting" aria-hidden="true"></i>
                    <p>Instalação profissional e equipe especializada</p>
                </div>
            </section>

            <section class="home__cta">
                <div class="home__cta-copy">
                    <h2 class="home__cta-title">Pronto para encontrar a solução ideal?</h2>
                    <p class="home__cta-text">Fale com um especialista e descubra o melhor para sua casa ou empresa.</p>
                </div>

                <div class="home__cta-actions">
                    <a class="home__cta-button home__cta-button--whatsapp" href="https://wa.me/5508002225262">
                        <i class="icon icon-whatsapp" aria-hidden="true"></i>
                        <span>Falar no WhatsApp <strong>0800 222 5262</strong></span>
                    </a>
                    <a class="home__cta-button" href="tel:08002225262">
                        <i class="icon icon-phone" aria-hidden="true"></i>
                        <span>Ligar agora <strong>0800 222 5262</strong></span>
                    </a>
                </div>
            </section>
        </div>
    </div>
</section>

<!-- Modal: Regulamento -->
<div class="cruise-modal" id="modalRegulamentoHome" role="dialog" aria-modal="true" aria-labelledby="modalRegHomeTitle">
    <div class="cruise-modal__box cruise-modal__box--wide">
        <button class="cruise-modal__close" id="btnFecharRegulamentoHome" type="button" aria-label="Fechar">&times;</button>
        <div class="cruise-modal__header">
            <i class="icon-calendar" aria-hidden="true"></i>
            <h2 id="modalRegHomeTitle"><?= $homeRegTitulo ?></h2>
        </div>
        <div class="cruise-modal__regulamento-body">
            <?= $homeRegTexto ?>
        </div>
    </div>
</div>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<script>var SORTEIO_DATE = "<?= $homeSorteioDate ?>";</script>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/inicio/home.js?' . $version . '"></script>';
?>

</body>
</html>
