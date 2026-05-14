<header class="header">
    <div class="container">
        <div class="header__content">
            <a class="header__brand" href="<?= BASE_URL ?>" aria-label="AserNet">
                <img class="header__logo" src="<?= BASE_URL ?>/images/logo-transparent.png" alt="AserNet">
            </a>

            <button class="header__toggle" type="button" aria-label="Abrir menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav class="header__nav" aria-label="Menu principal">
                <?php
                $activeRoute = $mainRoute ?? '';
                $navLinks = [
                    'residencial' => ['label' => 'Residencial',    'href' => BASE_URL . '/residencial'],
                    'empresas'    => ['label' => 'Empresas (PME)', 'href' => BASE_URL . '/empresas'],
                    'solucoes'    => ['label' => 'Soluções',       'href' => BASE_URL . '/solucoes'],
                    'sobre'       => ['label' => 'Sobre a AserNet','href' => BASE_URL . '/sobre'],
                    'suporte'     => ['label' => 'Suporte',        'href' => BASE_URL . '/suporte'],
                ];
                foreach ($navLinks as $route => $link):
                    $active = $activeRoute === $route ? ' header__nav-link--active' : '';
                ?>
                <a class="header__nav-link<?= $active ?>" href="<?= $link['href'] ?>"><?= $link['label'] ?></a>
                <?php endforeach; ?>
            </nav>

            <a class="header__phone" href="tel:08002225262">
                <i class="icon icon-phone" aria-hidden="true"></i>
                <span>0800 222 5262</span>
            </a>
        </div>
    </div>
</header>

