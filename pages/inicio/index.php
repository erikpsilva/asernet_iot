<!DOCTYPE html>
<html>
<head>
<title>AserNet - Início</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<!-- BANNER INTRODUTÓRIO -->
<section class="home">
    <div class="home__hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-7">
                    <div class="home__content">
                        <h1 class="home__title">
                            Mais que internet.
                            <strong>Soluções completas</strong>
                            para sua vida.
                        </h1>

                        <p class="home__text">
                            Tecnologia, conectividade e segurança para sua casa ou empresa funcionarem melhor.
                        </p>

                        <ul class="home__features">
                            <li class="home__feature"><i class="iicon con-check" aria-hidden="true"></i>Internet</li>
                            <li class="home__feature"><i class="iicon con-check" aria-hidden="true"></i>Wi-Fi inteligente</li>
                            <li class="home__feature"><i class="iicon con-check" aria-hidden="true"></i>Segurança</li>
                            <li class="home__feature"><i class="iicon con-check" aria-hidden="true"></i>Mobilidade</li>
                            <li class="home__feature"><i class="iicon con-check" aria-hidden="true"></i>Telefonia</li>
                            <li class="home__feature"><i class="iicon con-check" aria-hidden="true"></i>Soluções empresariais</li>
                        </ul>

                        <div class="home__actions">
                            <a class="home__button home__button--primary" href="<?= BASE_URL ?>/contato">
                                <i class="iicon con-talk" aria-hidden="true"></i>
                                <span>Falar com um consultor</span>
                            </a>

                            <a class="home__button home__button--outline" href="tel:08002225262">
                                <i class="iicon con-phone" aria-hidden="true"></i>
                                <span>0800 222 5262</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-5" aria-hidden="true"></div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>
<?php
$version = time();
echo '<script src="' . BASE_URL . '/pages/inicio/home.js?' . $version . '"></script>';
?>

</body>
</html>
