<?php
$_faqDefaults = ['categorias' => [
    ['id'=>'internet',   'icone'=>'icon-home',         'card_modifiers'=>'',             'titulo'=>'Internet Residencial',    'descricao'=>'Planos, instalação, cobertura e mais.',             'perguntas'=>[['q'=>'Todos os planos possuem 1 Giga?','a'=>'Consulte a disponibilidade para seu endereço. Nossa equipe indica o plano ideal para sua região.'],['q'=>'Qual a diferença entre os planos?','a'=>'Os planos variam por velocidade, serviços inclusos e soluções adicionais.'],['q'=>'A instalação está inclusa?','a'=>'A instalação pode variar conforme campanha e viabilidade técnica.'],['q'=>'Posso usar meu próprio roteador?','a'=>'Sim, desde que o equipamento seja compatível e configurado corretamente.']]],
    ['id'=>'wifi',       'icone'=>'icon-wifi',          'card_modifiers'=>'purple',       'titulo'=>'Wi-Fi e Cobertura',        'descricao'=>'Tudo sobre Wi-Fi, Mesh e sinal.',                   'perguntas'=>[['q'=>'O que é Wi-Fi Mesh?','a'=>'É uma tecnologia que amplia a cobertura usando pontos integrados para melhorar o sinal.'],['q'=>'O Wi-Fi chega em toda a casa?','a'=>'Depende do tamanho e das paredes do ambiente. Podemos dimensionar a melhor solução.'],['q'=>'Muitos dispositivos podem deixar o Wi-Fi lento?','a'=>'Sim. Para muitos dispositivos, recomendamos soluções como Mesh ou Wi-Fi Profissional.']]],
    ['id'=>'mobile',     'icone'=>'icon-mobile-phone',  'card_modifiers'=>'compact purple','titulo'=>'Mobile',                  'descricao'=>'Planos, portabilidade, cobertura e bônus.',         'perguntas'=>[['q'=>'Posso manter meu número atual?','a'=>'Sim, fazemos portabilidade conforme regras da operadora.'],['q'=>'O plano possui cobertura nacional?','a'=>'Sim, conforme área de cobertura móvel disponível.'],['q'=>'Como funciona o bônus de portabilidade?','a'=>'O bônus é aplicado em planos elegíveis após a portabilidade.']]],
    ['id'=>'empresarial','icone'=>'icon-office',         'card_modifiers'=>'compact green', 'titulo'=>'Empresarial',             'descricao'=>'Soluções para empresas, PME e Link Dedicado.',       'perguntas'=>[['q'=>'Qual a diferença entre internet PME e Link Dedicado?','a'=>'Internet PME atende empresas do dia a dia; Link Dedicado oferece banda exclusiva para operações críticas.'],['q'=>'O Wi-Fi Pro é indicado para muitos dispositivos?','a'=>'Sim, ele foi pensado para ambientes com alta demanda de conexão.'],['q'=>'Vocês atendem hotéis, clínicas e empresas?','a'=>'Sim. Projetamos soluções conforme o tamanho e necessidade do negócio.']]],
    ['id'=>'seguranca',  'icone'=>'icon-security',       'card_modifiers'=>'compact orange','titulo'=>'Câmeras e Rastreamento',  'descricao'=>'Segurança, câmeras, rastreadores e tags.',           'perguntas'=>[['q'=>'Posso acessar as câmeras pelo celular?','a'=>'Sim, o acesso pode ser feito por aplicativo compatível.'],['q'=>'O rastreador funciona para motos e bicicletas elétricas?','a'=>'Sim, temos soluções para carros, motos, caminhões, bicicletas elétricas e tags.'],['q'=>'A Tag Localizadora serve para quê?','a'=>'Serve para acompanhar objetos, bolsas, mochilas, malas e outros pertences.']]],
    ['id'=>'financeiro', 'icone'=>'icon-payment',        'card_modifiers'=>'wide cyan',    'titulo'=>'Financeiro e Suporte',    'descricao'=>'Pagamentos, faturas, suporte e atendimento.',        'perguntas'=>[['q'=>'Como emitir segunda via?','a'=>'A segunda via pode ser solicitada pela central do cliente ou canais de atendimento.'],['q'=>'Como falar com o suporte?','a'=>'Você pode falar pelo WhatsApp, telefone ou canais oficiais da AserNet.'],['q'=>'Posso alterar a data de vencimento?','a'=>'Consulte nossa equipe para verificar disponibilidade de alteração.']]],
]];
$_faqContent = $_faqDefaults;
try {
    require_once ROOT . '/config/database.php';
    $_pdo = getDbConnection();
    $_row = $_pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'faq_content' LIMIT 1")->fetch();
    if ($_row && !empty($_row['setting_value'])) {
        $_db = json_decode($_row['setting_value'], true);
        if (is_array($_db) && !empty($_db['categorias'])) { $_faqContent = $_db; }
    }
    unset($_pdo, $_row, $_db);
} catch (Throwable $_e) { unset($_e); }
function _faqCardClass(string $m): string {
    $cls = ['faq-page__question-card'];
    foreach (array_filter(explode(' ', trim($m))) as $p) { $cls[] = 'faq-page__question-card--' . $p; }
    return implode(' ', $cls);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Perguntas Frequentes</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<section class="faq-page">
    <div class="faq-page__hero">
        <div class="container">
            <div class="faq-page__hero-copy">
                <span>Perguntas frequentes</span>
                <h1>Como podemos <strong>ajudar?</strong></h1>
                <p>Encontre respostas r&aacute;pidas sobre internet, suporte, pagamentos, equipamentos e solu&ccedil;&otilde;es AserNet.</p>

                <form class="faq-page__search" action="<?= BASE_URL ?>/faq" method="get">
                    <label for="faq-search">Digite sua d&uacute;vida</label>
                    <input id="faq-search" type="search" name="q" placeholder="Digite sua d&uacute;vida...">
                    <button type="submit" aria-label="Buscar"><i class="icon-view" aria-hidden="true"></i></button>
                </form>

                <div class="faq-page__hero-info">
                    <article><i class="icon-pin" aria-hidden="true"></i><span><strong>Atendimento local</strong>Perto de voc&ecirc;, sempre que precisar.</span></article>
                    <article><i class="icon-clock" aria-hidden="true"></i><span><strong>Suporte r&aacute;pido</strong>Respostas &aacute;geis para o que voc&ecirc; precisa.</span></article>
                    <article><i class="icon-customersupport" aria-hidden="true"></i><span><strong>Equipe especializada</strong>Profissionais preparados para ajudar voc&ecirc;.</span></article>
                </div>

                <a class="faq-page__hero-whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
            </div>
        </div>
    </div>

    <div class="faq-page__body">
        <section class="faq-page__categories">
            <div class="container">
                <div class="faq-page__category-grid">
                    <?php foreach ($_faqContent['categorias'] as $_cat): ?>
                    <article>
                        <i class="<?= htmlspecialchars($_cat['icone']) ?>" aria-hidden="true"></i>
                        <h2><?= htmlspecialchars($_cat['titulo']) ?></h2>
                        <p><?= htmlspecialchars($_cat['descricao']) ?></p>
                        <a href="#<?= htmlspecialchars($_cat['id']) ?>">Ver perguntas <i class="icon-arrowright" aria-hidden="true"></i></a>
                    </article>
                    <?php endforeach; ?>
                </div>
                <button class="faq-page__all-categories" type="button">Ver todas as categorias <span aria-hidden="true">⌄</span></button>
            </div>
        </section>

        <section class="faq-page__questions">
            <div class="container">
                <div class="faq-page__question-grid">
                    <?php foreach ($_faqContent['categorias'] as $_cat): ?>
                    <article class="<?= _faqCardClass($_cat['card_modifiers'] ?? '') ?>" id="<?= htmlspecialchars($_cat['id']) ?>">
                        <h2><i class="<?= htmlspecialchars($_cat['icone']) ?>" aria-hidden="true"></i><?= htmlspecialchars($_cat['titulo']) ?></h2>
                        <?php foreach ($_cat['perguntas'] as $_pq): ?>
                        <details>
                            <summary><?= htmlspecialchars($_pq['q']) ?></summary>
                            <p><?= htmlspecialchars($_pq['a']) ?></p>
                        </details>
                        <?php endforeach; ?>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="faq-page__trust">
            <div class="container">
                <div class="faq-page__trust-grid">
                    <div class="faq-page__google"><img src="<?= BASE_URL ?>/images/logoGoogle.png" alt="Google"><p><strong>+ de 3.000 avalia&ccedil;&otilde;es</strong><br>no Google</p></div>
                    <article><i class="icon-pin" aria-hidden="true"></i>Atendimento local de verdade</article>
                    <article><i class="icon-setting" aria-hidden="true"></i>Instala&ccedil;&atilde;o profissional</article>
                    <article><i class="icon-group" aria-hidden="true"></i>Equipe especializada</article>
                    <article><i class="icon-gear" aria-hidden="true"></i>Solu&ccedil;&otilde;es completas para voc&ecirc;</article>
                </div>
            </div>
        </section>

        <section class="faq-page__cta">
            <div class="container">
                <div class="faq-page__cta-box">
                    <img src="<?= BASE_URL ?>/images/faq/imgNaoEncontrouSuaDuvida.png" alt="Atendente AserNet">
                    <div>
                        <h2>N&atilde;o encontrou sua d&uacute;vida?</h2>
                        <p>Fale com a nossa equipe. Estamos prontos para ajudar!</p>
                    </div>
                    <div class="faq-page__cta-actions">
                        <a class="faq-page__cta-button faq-page__cta-button--whatsapp" href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i><span>Falar no WhatsApp <strong>0800 222 5262</strong></span></a>
                        <a class="faq-page__cta-button" href="<?= BASE_URL ?>/contato"><i class="icon-talk" aria-hidden="true"></i><span>Abrir atendimento</span></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-page__footer">
            <div class="container">
                <div class="faq-page__footer-grid">
                    <div>
                        <img src="<?= BASE_URL ?>/images/logo-transparent.png" alt="AserNet">
                        <p>Mais que internet. Solu&ccedil;&otilde;es completas em conectividade, seguran&ccedil;a, mobilidade e tecnologia para sua casa ou empresa.</p>
                    </div>
                    <nav><h2>Solu&ccedil;&otilde;es</h2><a href="<?= BASE_URL ?>/residencial">Internet Residencial</a><a href="<?= BASE_URL ?>/paraempresas">Empresas (PME)</a><a href="<?= BASE_URL ?>/wifiprofissional">Wi-Fi Profissional</a><a href="<?= BASE_URL ?>/cameradeseguranca">C&acirc;meras de Seguran&ccedil;a</a><a href="<?= BASE_URL ?>/rastreamentoveicular">Rastreamento Veicular</a><a href="<?= BASE_URL ?>/planomovel">Aser Mobile</a></nav>
                    <nav><h2>Institucional</h2><a href="<?= BASE_URL ?>/sobre">Sobre a AserNet</a><a href="<?= BASE_URL ?>/contato">Trabalhe Conosco</a><a href="<?= BASE_URL ?>/politica-de-privacidade">Pol&iacute;tica de Privacidade</a><a href="<?= BASE_URL ?>/termos-de-uso">Termos de Uso</a></nav>
                    <nav><h2>Suporte</h2><a href="<?= BASE_URL ?>/faq">Perguntas Frequentes</a><a href="<?= BASE_URL ?>/contato">Central do Cliente</a><a href="<?= BASE_URL ?>/contato">Abrir Atendimento</a><a href="<?= BASE_URL ?>/contato">Canais de Atendimento</a></nav>
                    <address><h2>Atendimento</h2><a href="tel:08002225262"><i class="icon-phone" aria-hidden="true"></i>0800 222 5262</a><a href="https://wa.me/5508002225262"><i class="icon-whatsapp" aria-hidden="true"></i>0800 222 5262</a><a href="mailto:atendimento@asernet.com.br"><i class="icon-talk" aria-hidden="true"></i>atendimento@asernet.com.br</a></address>
                </div>
                <p class="faq-page__copyright">&copy; 2024 AserNet. Todos os direitos reservados.</p>
            </div>
        </section>
    </div>
</section>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/faq/faq.js?' . $version . '"></script>';
?>

</body>
</html>
