<?php
include ROOT . '/admin/includes/auth_check.php';
require_once ROOT . '/includes/header/menu-content.php';

$schema = headerMenuSchema();
$content = headerMenuContent();
$canEditMenu = in_array($_SESSION['usuario']['nivel_acesso'] ?? '', ['admin', 'editor'], true);
$message = '';
$messageType = '';
if (empty($_SESSION['menu_csrf'])) $_SESSION['menu_csrf'] = bin2hex(random_bytes(32));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$canEditMenu || !hash_equals($_SESSION['menu_csrf'], (string) ($_POST['csrf'] ?? ''))) {
        http_response_code(403);
        $message = 'Não foi possível salvar: sessão ou permissão inválida.';
        $messageType = 'error';
    } else {
        try {
            $submitted = is_array($_POST['content'] ?? null) ? $_POST['content'] : [];
            $updated = $content;
            $imageKeys = [];
            foreach ($schema as $fields) {
                foreach ($fields as $key => $field) {
                    if (($field[2] ?? '') === 'image') {
                        $imageKeys[] = $key;
                        continue;
                    }
                    if (!isset($submitted[$key]) || !is_string($submitted[$key])) {
                        throw new RuntimeException('Há campos de texto ausentes no formulário.');
                    }
                    $value = trim(str_replace(["\r\n", "\r"], "\n", $submitted[$key]));
                    if (headerMenuLength(str_replace('**', '', $value)) > 300 || headerMenuLength($value) > 1200) {
                        throw new RuntimeException('Um dos textos ultrapassou o limite de 300 caracteres.');
                    }
                    $updated[$key] = $value;
                }
            }

            $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
            $targetDir = ROOT . '/images/menu/';
            foreach ($imageKeys as $key) {
                $file = $_FILES['images']['error'][$key] ?? UPLOAD_ERR_NO_FILE;
                if ($file === UPLOAD_ERR_NO_FILE) continue;
                if ($file !== UPLOAD_ERR_OK) throw new RuntimeException('Falha no envio da imagem: ' . $key);
                $tmp = $_FILES['images']['tmp_name'][$key] ?? '';
                $size = (int) ($_FILES['images']['size'][$key] ?? 0);
                if ($size < 1 || $size > 3 * 1024 * 1024 || !is_uploaded_file($tmp)) {
                    throw new RuntimeException('Cada imagem deve ter no máximo 3 MB.');
                }
                $mime = (new finfo(FILEINFO_MIME_TYPE))->file($tmp);
                $imageInfo = getimagesize($tmp);
                if (!isset($allowed[$mime]) || $imageInfo === false) {
                    throw new RuntimeException('Use imagens JPG, PNG ou WebP válidas.');
                }
                [$expectedWidth, $expectedHeight] = headerMenuImageSizes()[$key];
                if ($imageInfo[0] !== $expectedWidth || $imageInfo[1] !== $expectedHeight) {
                    throw new RuntimeException("A imagem {$key} precisa ter {$expectedWidth} × {$expectedHeight} pixels. Use a máscara de recorte.");
                }
                $filename = 'menu_' . $key . '_' . bin2hex(random_bytes(8)) . '.' . $allowed[$mime];
                if (!move_uploaded_file($tmp, $targetDir . $filename)) {
                    throw new RuntimeException('Não foi possível gravar a imagem.');
                }
                $updated[$key] = $filename;
            }

            require_once ROOT . '/config/database.php';
            $pdo = getDbConnection(true);
            $pdo->prepare("INSERT INTO system_settings (setting_key, setting_value) VALUES ('header_menu_content', ?)
                ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)")
                ->execute([json_encode($updated, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR)]);
            $content = $updated;
            $message = 'Menu atualizado. As alterações já aparecem no site.';
            $messageType = 'success';
        } catch (Throwable $e) {
            $message = 'Não foi possível salvar: ' . $e->getMessage();
            $messageType = 'error';
        }
    }
}

$menuEscape = static fn (string $value): string => htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>AserNet - Admin - Menu</title>
    <?php include ROOT . '/admin/includes/assets.php'; ?>
</head>
<body>
<?php include ROOT . '/admin/includes/header/header.php'; ?>
<div class="adminLayout">
    <?php include ROOT . '/admin/includes/sidebar/sidebar.php'; ?>
    <main class="adminLayout__content">
        <div class="adminMenu">
            <header class="adminMenu__head">
                <div>
                    <span class="adminMenu__eyebrow">Navegação do site</span>
                    <h1>Menu</h1>
                    <p>Edite os textos e troque as imagens do menu principal. Os links e ícones continuam ligados às páginas atuais.</p>
                </div>
                <?php if ($canEditMenu): ?><button class="btn btn--primary" type="submit" form="menuForm">Salvar alterações</button><?php endif; ?>
            </header>

            <?php if ($message): ?><div class="adminMenu__message adminMenu__message--<?= $messageType ?>" role="status"><?= $menuEscape($message) ?></div><?php endif; ?>
            <?php if (!$canEditMenu): ?><div class="adminMenu__message">Você pode consultar o conteúdo. A edição está disponível para administradores e editores.</div><?php endif; ?>

            <form id="menuForm" action="<?= BASE_URL ?>/admin/menu" method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf" value="<?= $menuEscape($_SESSION['menu_csrf']) ?>">
                <?php foreach ($schema as $section => $fields): ?>
                    <section class="adminMenu__section">
                        <h2><?= $menuEscape($section) ?></h2>
                        <div class="adminMenu__grid">
                            <?php foreach ($fields as $key => $field): ?>
                                <?php $value = (string) ($content[$key] ?? $field[1]); ?>
                                <div class="adminMenu__field<?= ($field[2] ?? '') === 'image' ? ' adminMenu__field--image' : '' ?>">
                                    <label for="menu-<?= $menuEscape($key) ?>"><?= $menuEscape($field[0]) ?></label>
                                    <?php if (($field[2] ?? '') === 'image'): ?>
                                        <?php [$imageWidth, $imageHeight] = headerMenuImageSizes()[$key]; ?>
                                        <div class="adminMenu__image"><img src="<?= $menuEscape(BASE_URL . '/images/menu/' . $value) ?>" alt="Prévia de <?= $menuEscape($field[0]) ?>"></div>
                                        <input id="menu-<?= $menuEscape($key) ?>" type="file" name="images[<?= $menuEscape($key) ?>]" accept="image/jpeg,image/png,image/webp" data-crop-width="<?= $imageWidth ?>" data-crop-height="<?= $imageHeight ?>" data-crop-label="<?= $menuEscape($section . ' — ' . $field[0]) ?>" <?= $canEditMenu ? '' : 'disabled' ?>>
                                        <small>Ao selecionar, ajuste na máscara de <?= $imageWidth ?> × <?= $imageHeight ?> px. O recorte será usado no desktop e no celular; arquivo final até 3 MB.</small>
                                    <?php elseif (strpos($key, 'text') !== false || strpos($key, 'intro') !== false || $key === 'brand_button'): ?>
                                        <textarea id="menu-<?= $menuEscape($key) ?>" name="content[<?= $menuEscape($key) ?>]" maxlength="300" rows="3" <?= $canEditMenu ? '' : 'disabled' ?>><?= $menuEscape($value) ?></textarea>
                                    <?php else: ?>
                                        <input id="menu-<?= $menuEscape($key) ?>" type="text" name="content[<?= $menuEscape($key) ?>]" maxlength="300" value="<?= $menuEscape($value) ?>" <?= $canEditMenu ? '' : 'disabled' ?>>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endforeach; ?>
                <?php if ($canEditMenu): ?><div class="adminMenu__actions"><button class="btn btn--primary" type="submit">Salvar alterações</button></div><?php endif; ?>
            </form>
        </div>
    </main>
</div>
<div class="adminMenuCrop" id="menuCrop" role="dialog" aria-modal="true" aria-labelledby="menuCropTitle" hidden>
    <div class="adminMenuCrop__backdrop" data-crop-cancel></div>
    <div class="adminMenuCrop__panel">
        <div class="adminMenuCrop__head"><div><h2 id="menuCropTitle">Ajustar imagem</h2><p id="menuCropHint"></p></div><button type="button" class="adminMenuCrop__close" data-crop-cancel aria-label="Fechar recorte">×</button></div>
        <canvas id="menuCropCanvas" width="800" height="540" tabindex="0" aria-label="Arraste a imagem para posicionar o recorte. Use as setas do teclado para mover."></canvas>
        <div class="adminMenuCrop__controls"><label for="menuCropZoom">Zoom</label><input id="menuCropZoom" type="range" min="100" max="300" value="100" aria-label="Zoom da imagem"><span id="menuCropZoomValue">100%</span></div>
        <p class="adminMenuCrop__help">Arraste a imagem ou use as setas do teclado para posicionar o conteúdo dentro da máscara.</p>
        <div class="adminMenuCrop__actions"><button type="button" class="btn" data-crop-cancel>Cancelar</button><button type="button" class="btn btn--primary" id="menuCropApply">Aplicar recorte</button></div>
    </div>
</div>
<script src="<?= ADMIN_BASE_URL ?>/pages/menu/menu.js?v=<?= filemtime(__DIR__ . '/menu.js') ?>"></script>
<?php include ROOT . '/admin/includes/scripts.php'; ?>
</body>
</html>
