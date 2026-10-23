<?php
$seoTitle = 'Câmeras e proteção inteligente | AserNet';
$seoDescription = 'Proteção inteligente para sua casa, chácara e empresa. Câmeras, alertas e automações em uma única plataforma.';
require_once ROOT . '/pages/cameradeseguranca/content.php';
$cameraV2Content = cameraV2Content();
$cameraContact = 'https://wa.me/5508002225262?text=';
function cameraCta($label, $message, $outline = false) {
    global $cameraContact;
    echo '<a class="security-v2__button' . ($outline ? ' security-v2__button--outline' : '') . '" href="' . htmlspecialchars($cameraContact . rawurlencode($message), ENT_QUOTES) . '" target="_blank" rel="noopener noreferrer">' . htmlspecialchars($label, ENT_QUOTES) . ' ';
    cameraIcon('arrow-right');
    echo '</a>';
}
function cameraIcon($name) {
    if (!preg_match('/^[a-z-]+$/', $name)) return;
    $iconPath = ROOT . '/images/camerasegurancav2/icons/' . $name . '.svg';
    if (is_file($iconPath)) echo file_get_contents($iconPath);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<title><?= $seoTitle ?></title>
<?php include ROOT . '/includes/assets.php'; ?>
<link rel="preload" as="image" href="<?= cameraV2Image('hero.image') ?>">
</head>
<body class="security-page">
<?php include ROOT . '/includes/header/header.php'; ?>
<main class="security-v2">
<?php include ROOT . "/pages/cameradeseguranca/body.php"; ?>
<?php include ROOT . '/pages/cameradeseguranca/faq.php'; ?>
</main>
<?php include ROOT . '/includes/footer/footer.php'; ?>
<?php include ROOT . '/includes/scripts.php'; ?>
</body></html>
