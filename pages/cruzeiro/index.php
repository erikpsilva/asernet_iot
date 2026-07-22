<?php
$sorteioDateJs     = '2027-01-31T00:00:00-03:00';
$regulamentoTitulo = 'Regulamento da Promo&ccedil;&atilde;o';
$regulamentoPdfUrl = '';

try {
    require_once ROOT . '/config/database.php';
    $_pdo  = getDbConnection();
    $_stmt = $_pdo->query("SELECT setting_key, setting_value FROM system_settings WHERE setting_key IN ('sorteio_date','regulamento_titulo','regulamento_pdf')");
    $_cfg  = [];
    foreach ($_stmt->fetchAll() as $r) { $_cfg[$r['setting_key']] = $r['setting_value']; }

    if (!empty($_cfg['sorteio_date']))       $sorteioDateJs     = addslashes($_cfg['sorteio_date']) . '-03:00';
    if (!empty($_cfg['regulamento_titulo']))  $regulamentoTitulo = htmlspecialchars($_cfg['regulamento_titulo'], ENT_QUOTES, 'UTF-8');
    if (!empty($_cfg['regulamento_pdf']))     $regulamentoPdfUrl = BASE_URL . '/uploads/regulamento/' . rawurlencode($_cfg['regulamento_pdf']);

    unset($_pdo, $_stmt, $_cfg);
} catch (Throwable $_e) {
    unset($_e);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Conex&atilde;o em Alto Mar</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<main class="cruise-page">
    <section class="cruise-page__hero">
        <div class="container">
            <div class="cruise-page__hero-grid">
                <div class="cruise-page__hero-copy">
                    <h1>Conex&atilde;o <strong>em alto mar</strong></h1>
                    <h2>V&aacute; mais longe com a AserNet e concorra a uma experi&ecirc;ncia inesquec&iacute;vel.</h2>
                    <p>Clientes AserNet podem participar do sorteio de um cruzeiro internacional a bordo do <strong>MSC Divina</strong>, com sa&iacute;da de Santos em 31/01/2027.</p>

                    <div class="cruise-page__hero-actions">
                        <button class="cruise-page__button cruise-page__button--primary" id="btnQueroParticipar" type="button">Quero participar <i class="icon-arrowright" aria-hidden="true"></i></button>
                        <button class="cruise-page__button cruise-page__button--outline" id="btnVerRegulamento" type="button"><i class="icon-calendar" aria-hidden="true"></i>Ver regulamento</button>
                    </div>

                    <div class="cruise-page__partners">
                        <span>Uma experi&ecirc;ncia inesquec&iacute;vel em parceria com</span>
                        <div>
                            <img src="<?= BASE_URL ?>/images/logo-transparent.png" alt="AserNet IoT Services">
                            <b aria-hidden="true">&times;</b>
                            <img src="<?= BASE_URL ?>/images/cruzeiro/logoBeFly.webp" alt="BeFly">
                        </div>
                    </div>
                </div>

                <div class="cruise-page__countdown" aria-label="Contagem regressiva para o sorteio">
                    <span>Sorteio em:</span>
                    <div><strong>182</strong><small>Dias</small></div>
                    <div><strong>14</strong><small>Horas</small></div>
                    <div><strong>32</strong><small>Minutos</small></div>
                    <div><strong>27</strong><small>Segundos</small></div>
                </div>
            </div>
        </div>
    </section>

    <section class="cruise-page__check">
        <div class="container">
            <div class="cruise-page__check-box">
                <div class="cruise-page__check-text">
                    <i class="icon-star" aria-hidden="true"></i>
                    <div>
                        <h2>J&aacute; participou da promo&ccedil;&atilde;o?</h2>
                        <p>Consulte seus n&uacute;meros da sorte e veja suas indica&ccedil;&otilde;es cadastradas.</p>
                    </div>
                </div>
                <button class="cruise-page__button cruise-page__button--primary" id="btnConsultarNumeros" type="button">
                    Ver meus n&uacute;meros
                </button>
            </div>
        </div>
    </section>

    <section class="cruise-page__steps">
        <div class="container">
            <h2>Como funciona</h2>
            <div class="cruise-page__steps-grid">
                <article><i class="icon-group" aria-hidden="true"></i><div><b>1</b><h3>Seja cliente AserNet</h3><p>Tenha qualquer plano ativo de internet, mobilidade ou solu&ccedil;&otilde;es AserNet.</p></div></article>
                <article><i class="icon-team" aria-hidden="true"></i><div><b>2</b><h3>Indique amigos</h3><p>Cada amigo que se tornar cliente gera n&uacute;meros da sorte para voc&ecirc;.</p></div></article>
                <article><i class="icon-star" aria-hidden="true"></i><div><b>3</b><h3>Concorra ao cruzeiro</h3><p>Quanto mais amigos indicados, mais chances de ganhar.</p></div></article>
            </div>
        </div>
    </section>

    <section class="cruise-page__prize">
        <div class="container">
            <div class="cruise-page__prize-grid">
                <div class="cruise-page__prize-copy">
                    <h2>O pr&ecirc;mio</h2>
                    <p>Um cruzeiro internacional com sa&iacute;da de Santos a bordo do <strong>MSC Divina.</strong></p>
                    <ul>
                        <li><i class="icon-checkmark" aria-hidden="true"></i>7 noites de viagem</li>
                        <li><i class="icon-checkmark" aria-hidden="true"></i>Destinos incr&iacute;veis</li>
                        <li><i class="icon-checkmark" aria-hidden="true"></i>Experi&ecirc;ncia completa para 2 pessoas</li>
                    </ul>
                    <a href="#msc-divina">Conhe&ccedil;a o MSC Divina <i class="icon-arrowright" aria-hidden="true"></i></a>
                </div>

                <div class="cruise-page__prize-gallery">
                    <img src="<?= BASE_URL ?>/images/cruzeiro/imgOPremioi01.png" alt="Piscina do cruzeiro MSC Divina">
                    <img src="<?= BASE_URL ?>/images/cruzeiro/imgOPremioi02.png" alt="Restaurante do cruzeiro">
                    <img src="<?= BASE_URL ?>/images/cruzeiro/imgOPremioi03.png" alt="Teatro do cruzeiro">
                    <img src="<?= BASE_URL ?>/images/cruzeiro/imgOPremioi04.png" alt="Cabine do cruzeiro">
                </div>
            </div>
        </div>
    </section>

    <section class="cruise-page__solutions">
        <div class="container">
            <header>
                <h2>Uma empresa. Diversas solu&ccedil;&otilde;es conectadas.</h2>
                <p>Tecnologia, conectividade e seguran&ccedil;a para sua casa ou empresa funcionarem melhor.</p>
            </header>

            <div class="cruise-page__solutions-grid">
                <article><i class="icon-wifi" aria-hidden="true"></i><h3>Internet Fibra</h3><p>Ultravelocidade e estabilidade</p></article>
                <article><i class="icon-wifipro" aria-hidden="true"></i><h3>Wi-Fi Inteligente</h3><p>Cobertura completa em todos os ambientes</p></article>
                <article><i class="icon-security" aria-hidden="true"></i><h3>C&acirc;meras Inteligentes</h3><p>Seguran&ccedil;a em tempo real pelo celular</p></article>
                <article><i class="icon-pin" aria-hidden="true"></i><h3>Rastreamento Veicular</h3><p>Prote&ccedil;&atilde;o e controle onde estiver</p></article>
                <article><i class="icon-mobile-phone" aria-hidden="true"></i><h3>Aser Mobile</h3><p>Conectividade dentro e fora de casa</p></article>
                <article><i class="icon-office" aria-hidden="true"></i><h3>Solu&ccedil;&otilde;es Empresariais</h3><p>Conectividade e produtividade para sua empresa</p></article>
            </div>
        </div>
    </section>

    <section class="cruise-page__referral">
        <div class="container">
            <div class="cruise-page__referral-box">
                <div><i class="icon-star" aria-hidden="true"></i><h2>Indique amigos e aumente suas chances de ganhar!</h2></div>
                <p>Cada novo cliente indicado = mais n&uacute;meros da sorte para voc&ecirc;.</p>
                <a href="https://wa.me/5508002225262" target="_blank" rel="noopener"><i class="icon-whatsapp" aria-hidden="true"></i>Quero indicar amigos</a>
            </div>
            <p class="cruise-page__rule" id="regulamento"><i class="icon-security" aria-hidden="true"></i>Promo&ccedil;&atilde;o v&aacute;lida de 01/06/2024 a 31/12/2026. Consulte o regulamento completo.</p>
        </div>
    </section>
</main>

<!-- Modal: Regulamento -->
<div class="cruise-modal" id="modalRegulamento" role="dialog" aria-modal="true" aria-labelledby="modalRegTitle">
    <div class="cruise-modal__box cruise-modal__box--wide">
        <button class="cruise-modal__close" id="btnFecharRegulamento" type="button" aria-label="Fechar">&times;</button>
        <div class="cruise-modal__header">
            <i class="icon-calendar" aria-hidden="true"></i>
            <h2 id="modalRegTitle"><?= $regulamentoTitulo ?></h2>
        </div>
        <div class="cruise-modal__regulamento-body" id="regulamentoBody">
            <?php if ($regulamentoPdfUrl): ?>
            <div class="cruise-modal__pdf-wrap">
                <iframe src="<?= $regulamentoPdfUrl ?>" title="Regulamento PDF" class="cruise-modal__pdf-iframe"></iframe>
                <a href="<?= $regulamentoPdfUrl ?>" target="_blank" rel="noopener" class="cruise-modal__pdf-link">
                    <i class="icon-calendar" aria-hidden="true"></i> Abrir PDF em nova aba
                </a>
            </div>
            <?php else: ?>
            <p>O regulamento ainda n&atilde;o foi cadastrado.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal: Consultar números -->
<div class="cruise-modal" id="modalConsultarNumeros" role="dialog" aria-modal="true" aria-labelledby="modalConsultarTitle">
    <div class="cruise-modal__box">
        <button class="cruise-modal__close" id="btnFecharConsultar" type="button" aria-label="Fechar">&times;</button>

        <!-- Step: CPF -->
        <div class="cruise-modal__step" id="consultStep1">
            <div class="cruise-modal__header">
                <i class="icon-star" aria-hidden="true"></i>
                <h2 id="modalConsultarTitle">Meus n&uacute;meros da sorte</h2>
            </div>
            <p>Informe seu CPF para consultar seus n&uacute;meros e indica&ccedil;&otilde;es cadastradas.</p>
            <div class="cruise-modal__field" id="fieldCpfConsultar">
                <label for="inputCpfConsultar">CPF</label>
                <input type="text" id="inputCpfConsultar" placeholder="000.000.000-00" maxlength="14" autocomplete="off">
                <span class="cruise-modal__error" id="erroCpfConsultar"></span>
            </div>
            <button class="cruise-modal__btn" id="btnBuscarNumeros" type="button">
                <span id="btnBuscarTexto">Consultar</span>
                <span id="btnBuscarLoading" style="display:none">Buscando...</span>
            </button>
        </div>

        <!-- Step: Resultados -->
        <div class="cruise-modal__step" id="consultStep2" style="display:none">
            <div class="cruise-modal__header">
                <i class="icon-star" aria-hidden="true"></i>
                <h2>Ol&aacute;, <span id="consultNome"></span>!</h2>
            </div>
            <p id="consultTotal"></p>
            <div class="cruise-modal__numbers" id="consultList"></div>
            <button class="cruise-modal__back" id="btnVoltarConsultar" type="button">Consultar outro CPF</button>
        </div>
    </div>
</div>

<!-- Modal: Quero participar -->
<div class="cruise-modal" id="modalParticipar" role="dialog" aria-modal="true" aria-labelledby="modalParticiparTitle">
    <div class="cruise-modal__box">
        <button class="cruise-modal__close" id="btnFecharModal" type="button" aria-label="Fechar">&times;</button>

        <!-- Step 1: Verificar CPF -->
        <div class="cruise-modal__step" id="stepCpf">
            <div class="cruise-modal__header">
                <i class="icon-star" aria-hidden="true"></i>
                <h2 id="modalParticiparTitle">Verificar participa&ccedil;&atilde;o</h2>
            </div>
            <p>Informe seu CPF para verificar se voc&ecirc; j&aacute; &eacute; cliente AserNet e pode participar do sorteio.</p>
            <div class="cruise-modal__field" id="fieldCpfModal">
                <label for="inputCpfModal">CPF</label>
                <input type="text" id="inputCpfModal" placeholder="000.000.000-00" maxlength="14" autocomplete="off">
                <span class="cruise-modal__error" id="erroCpf"></span>
            </div>
            <button class="cruise-modal__btn" id="btnVerificarCpf" type="button">
                <span id="btnVerificarTexto">Verificar</span>
                <span id="btnVerificarLoading" style="display:none">Verificando...</span>
            </button>
        </div>

        <!-- Step 2a: Cliente confirmado -->
        <div class="cruise-modal__step" id="stepSubscriber" style="display:none">
            <span class="cruise-modal__badge">Cliente AserNet ✓</span>
            <h2>Ol&aacute;, <span id="nomeCliente"></span>!</h2>
            <p>Indique um amigo e ganhe mais n&uacute;meros da sorte para concorrer ao cruzeiro.</p>
            <div class="cruise-modal__field" id="fieldNomeIndicado">
                <label for="inputNomeIndicado">Nome do amigo</label>
                <input type="text" id="inputNomeIndicado" placeholder="Nome completo" autocomplete="off">
                <span class="cruise-modal__error" id="erroNomeIndicado"></span>
            </div>
            <div class="cruise-modal__field" id="fieldEmailIndicado">
                <label for="inputEmailIndicado">E-mail</label>
                <input type="email" id="inputEmailIndicado" placeholder="email@exemplo.com" autocomplete="off">
                <span class="cruise-modal__error" id="erroEmailIndicado"></span>
            </div>
            <div class="cruise-modal__field" id="fieldTelIndicado">
                <label for="inputTelIndicado">Telefone</label>
                <input type="text" id="inputTelIndicado" placeholder="(00) 00000-0000" maxlength="15" autocomplete="off">
                <span class="cruise-modal__error" id="erroTelIndicado"></span>
            </div>
            <button class="cruise-modal__btn cruise-modal__btn--whatsapp" id="btnIndicarWhatsApp" type="button">
                <i class="icon-whatsapp" aria-hidden="true"></i> Indicar via WhatsApp
            </button>
            <button class="cruise-modal__back" id="btnVoltarStep1" type="button">Verificar outro CPF</button>
        </div>

        <!-- Step 2b: Não é cliente -->
        <div class="cruise-modal__step" id="stepNotSubscriber" style="display:none">
            <div class="cruise-modal__icon-info">
                <i class="icon-group" aria-hidden="true"></i>
            </div>
            <h2>Voc&ecirc; ainda n&atilde;o &eacute; cliente AserNet</h2>
            <p>Para participar do sorteio do cruzeiro, &eacute; necess&aacute;rio ter um plano AserNet ativo.</p>
            <a class="cruise-modal__btn" href="<?= BASE_URL ?>/residencial">Conhecer planos</a>
            <button class="cruise-modal__back" id="btnVoltarStep1b" type="button">Verificar outro CPF</button>
        </div>
    </div>
</div>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<script>
    var SORTEIO_DATE = "<?= $sorteioDateJs ?>";
</script>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/cruzeiro/cruzeiro.js?' . $version . '"></script>';
?>

</body>
</html>
