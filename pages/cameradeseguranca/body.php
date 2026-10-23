<section class="security-v2__hero" style="--camera-hero-image:url('<?= cameraV2Image('hero.image') ?>')">
    <div class="security-v2__container">
        <div class="security-v2__hero-copy">
            <span class="security-v2__eyebrow"><?= cameraV2Text('hero.eyebrow') ?></span>
            <h1><?= cameraV2Text('hero.title') ?><br><em><?= cameraV2Text('hero.highlight') ?></em></h1>
            <p><?= cameraV2Text('hero.description') ?></p>
            <div class="security-v2__offer">
                <div class="security-v2__price">
                    <span><?= cameraV2Text('hero.price_intro') ?></span>
                    <strong>R$ <b><?= cameraV2Text('hero.price') ?></b> <small><?= cameraV2Text('hero.price_suffix') ?></small></strong>
                    <small><?= cameraV2Text('hero.price_note') ?></small>
                </div>
                <div class="security-v2__actions">
                    <?php cameraCta(cameraV2Raw('hero.primary_button'), 'Olá! Quero proteger meu imóvel.'); ?>
                    <?php cameraCta(cameraV2Raw('hero.secondary_button'), 'Olá! Já tenho câmeras e quero melhorar meu sistema.', true); ?>
                </div>
            </div>
        </div>
        <ul class="security-v2__benefits">
            <?php foreach ($cameraV2Content['hero']['benefits'] as $i => $benefit): ?>
                <li><?php cameraIcon($benefit['icon']); ?><?= cameraV2Text("hero.benefits.$i.text") ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<section class="security-v2__intro">
    <div class="security-v2__container security-v2__intro-grid">
        <div><h2><?= cameraV2Text('intro.title') ?><br><?= cameraV2Text('intro.title_second') ?></h2><p><?= cameraV2Text('intro.description') ?></p></div>
        <div>
            <div class="security-v2__steps">
                <?php foreach ($cameraV2Content['intro']['steps'] as $i => $step): ?>
                    <div><?php cameraIcon($step['icon']); ?><h3><?= cameraV2Text("intro.steps.$i.title") ?></h3><p><?= cameraV2Text("intro.steps.$i.text") ?></p></div>
                <?php endforeach; ?>
            </div>
            <h3 class="security-v2__statement"><?= cameraV2Text('intro.statement') ?><br><?= cameraV2Text('intro.statement_second') ?></h3>
        </div>
    </div>
</section>

<section class="security-v2__alert" style="--camera-alert-image:url('<?= cameraV2Image('alert.image') ?>')">
    <div class="security-v2__container security-v2__alert-grid">
        <div><h2><?= cameraV2Text('alert.title') ?></h2><strong class="security-v2__time"><?= cameraV2Text('alert.time') ?></strong><h3><?= cameraV2Text('alert.event') ?></h3><p><?= cameraV2Text('alert.description') ?></p></div>
        <div class="security-v2__alert-cards">
            <article><?php cameraIcon('circle-check'); ?><div><h3><?= cameraV2Text('alert.normal_title') ?></h3><p><?= cameraV2Text('alert.normal_text') ?></p></div></article>
            <article><?php cameraIcon('bolt'); ?><div><h3><?= cameraV2Text('alert.action_title') ?></h3><p><?= cameraV2Text('alert.action_text') ?></p></div></article>
        </div>
    </div>
</section>

<section class="security-v2__decision" style="--camera-decision-image:url('<?= cameraV2Image('decision.image') ?>')">
    <div class="security-v2__container">
        <div class="security-v2__half">
            <h2><?= cameraV2Text('decision.title') ?><br><?= cameraV2Text('decision.title_second') ?></h2>
            <p><?= cameraV2Text('decision.description') ?></p>
            <div class="security-v2__steps security-v2__steps--compact">
                <?php foreach ($cameraV2Content['decision']['steps'] as $i => $step): ?>
                    <div><?php cameraIcon($step['icon']); ?><h3><?= cameraV2Text("decision.steps.$i.text") ?></h3></div>
                <?php endforeach; ?>
            </div>
            <p><?= cameraV2Text('decision.closing') ?></p><strong><?= cameraV2Text('decision.statement') ?></strong>
        </div>
        <div class="security-v2__notification"><?php cameraIcon('bell'); ?><div><strong><?= cameraV2Text('decision.notification_title') ?> <span><?= cameraV2Text('decision.notification_when') ?></span></strong><p><?= cameraV2Text('decision.notification_event') ?><br><?= cameraV2Text('decision.notification_place') ?></p></div></div>
    </div>
</section>

<section class="security-v2__platform" id="asercontrol">
    <div class="security-v2__container security-v2__platform-grid">
        <div><h2><?= cameraV2Text('platform.title') ?><br><?= cameraV2Text('platform.title_second') ?></h2><p><?= cameraV2Text('platform.description') ?></p><?php cameraCta(cameraV2Raw('platform.button'), 'Olá! Quero conhecer o AserControl.'); ?></div>
        <img src="<?= cameraV2Image('platform.image') ?>" alt="AserControl reunindo câmeras de casa, chácara e empresa" loading="lazy">
        <ul><?php foreach ($cameraV2Content['platform']['features'] as $i => $feature): ?><li><?php cameraIcon($feature['icon']); ?><?= cameraV2Text("platform.features.$i.text") ?></li><?php endforeach; ?></ul>
    </div>
</section>

<section class="security-v2__places">
    <div class="security-v2__container"><h2><?= cameraV2Text('places.title') ?></h2>
        <div class="security-v2__place-grid">
            <?php foreach ($cameraV2Content['places']['cards'] as $i => $card): ?>
                <article><img src="<?= cameraV2Image("places.cards.$i.image") ?>" alt="<?= cameraV2Text("places.cards.$i.title") ?> com proteção AserNet" loading="lazy"><div><h3><?= cameraV2Text("places.cards.$i.title") ?></h3><p><?= cameraV2Text("places.cards.$i.text") ?></p></div></article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="security-v2__project">
    <div class="security-v2__container security-v2__two-columns">
        <img src="<?= cameraV2Image('project.image') ?>" alt="Projeto de proteção com câmeras em diferentes áreas do imóvel" loading="lazy">
        <div><h2><?= cameraV2Text('project.title') ?></h2><p><?= cameraV2Text('project.description') ?></p><?php cameraCta(cameraV2Raw('project.button'), 'Olá! Quero solicitar um diagnóstico de proteção para meu imóvel.'); ?></div>
    </div>
</section>

<section class="security-v2__technology">
    <div class="security-v2__container security-v2__tech-grid">
        <h2><?= cameraV2Text('technology.title') ?><br><?= cameraV2Text('technology.title_second') ?></h2>
        <?php foreach ($cameraV2Content['technology']['cards'] as $i => $card): ?>
            <article><?php cameraIcon($card['icon']); ?><h3><?= cameraV2Text("technology.cards.$i.title") ?></h3><p><?= cameraV2Text("technology.cards.$i.text") ?></p></article>
        <?php endforeach; ?>
    </div>
</section>

<section class="security-v2__resilience">
    <div class="security-v2__container security-v2__resilience-grid">
        <div><h2><?= cameraV2Text('resilience.title') ?><br><?= cameraV2Text('resilience.title_second') ?></h2><p><?= cameraV2Text('resilience.description') ?></p></div>
        <?php foreach ($cameraV2Content['resilience']['cards'] as $i => $card): ?>
            <div class="security-v2__resilience-item"><?php cameraIcon($card['icon']); ?><h3><?= cameraV2Text("resilience.cards.$i.title") ?></h3><p><?= cameraV2Text("resilience.cards.$i.text") ?></p></div>
        <?php endforeach; ?>
    </div>
</section>

<section class="security-v2__reassurance">
    <div class="security-v2__container security-v2__two-columns">
        <article><img src="<?= cameraV2Image('reassurance.current_image') ?>" alt="Câmera de segurança instalada" loading="lazy"><div><h2><?= cameraV2Text('reassurance.current_title') ?><br><?= cameraV2Text('reassurance.current_title_second') ?></h2><p><?= cameraV2Text('reassurance.current_text') ?></p><?php cameraCta(cameraV2Raw('reassurance.current_button'), 'Olá! Quero avaliar minhas câmeras atuais.'); ?></div></article>
        <article><img src="<?= cameraV2Image('reassurance.calm_image') ?>" alt="Mãe e filha aproveitando um momento juntas" loading="lazy"><div><h2><?= cameraV2Text('reassurance.calm_title') ?><br><?= cameraV2Text('reassurance.calm_title_second') ?></h2><p><?= cameraV2Text('reassurance.calm_text') ?></p></div></article>
    </div>
</section>

<section class="security-v2__closing" style="--camera-closing-image:url('<?= cameraV2Image('closing.image') ?>')">
    <div class="security-v2__container security-v2__closing-grid">
        <div>
            <h2><?= cameraV2Text('closing.title') ?><br><?= cameraV2Text('closing.title_second') ?><br><?= cameraV2Text('closing.title_third') ?></h2>
            <p><?= cameraV2Text('closing.description') ?></p>
            <?php cameraCta(cameraV2Raw('closing.button'), 'Olá! Quero solicitar meu diagnóstico de proteção.'); ?>
            <div class="security-v2__signature"><a href="<?= BASE_URL ?>"><img src="<?= BASE_URL ?>/images/logo-transparent.png" alt="AserNet IoT Services" width="145" height="50"></a><span><?= cameraV2Text('closing.signature') ?></span></div>
        </div>
        <div class="security-v2__price"><p><?= cameraV2Text('closing.price_intro') ?></p><strong>R$ <b><?= cameraV2Text('closing.price') ?></b> <small><?= cameraV2Text('closing.price_suffix') ?></small></strong><small><?= cameraV2Text('closing.price_note') ?></small></div>
        <div class="security-v2__closing-options">
            <?php foreach ($cameraV2Content['closing']['options'] as $i => $option): ?>
                <a href="<?= htmlspecialchars($cameraContact . rawurlencode('Olá! ' . $option['title']), ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer"><?php cameraIcon($option['icon']); ?><div><h3><?= cameraV2Text("closing.options.$i.title") ?></h3><p><?= cameraV2Text("closing.options.$i.text") ?></p></div></a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
