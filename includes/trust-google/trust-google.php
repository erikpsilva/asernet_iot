<?php
$_tg_google = $_trustData['google_text'] ?? '5.0 ★★★★★ + de 3.000 avaliações no Google';
$_tg_items  = $_trustData['items']       ?? ['+ de 3.000 clientes satisfeitos', 'Atendimento local de verdade', 'Suporte rápido e especializado'];
$_tg_icons  = $_trustData['icons']       ?? ['icon-group', 'icon-pin', 'icon-security'];
unset($_trustData);
?>
<section class="trustStrip">
    <div class="container">
        <div class="trustStrip__grid">
            <div class="trustStrip__google">
                <img src="<?= BASE_URL ?>/images/logoGoogle.png" alt="Google">
                <p><?= htmlspecialchars($_tg_google) ?></p>
            </div>
            <?php foreach ($_tg_items as $_i => $_tg_item): ?>
            <article>
                <i class="<?= htmlspecialchars($_tg_icons[$_i] ?? 'icon-group') ?>" aria-hidden="true"></i>
                <h3><?= htmlspecialchars($_tg_item) ?></h3>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php unset($_tg_google, $_tg_items, $_tg_icons, $_tg_item, $_i); ?>
