<?php include ROOT . '/admin/includes/auth_check.php'; ?>
<?php
if (!in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor', 'leitor'], true)) {
    header('Location: ' . BASE_URL . '/admin/inicio');
    exit;
}
require_once ROOT . '/pages/cameradeseguranca/content.php';
$cameraV2Content = cameraV2Content();
$cameraV2Readonly = $_SESSION['usuario']['nivel_acesso'] === 'leitor';
$_SESSION['camera_v2_csrf'] ??= bin2hex(random_bytes(24));
$cameraV2Groups = [
    'hero'=>'Banner e oferta', 'intro'=>'Apresentação', 'alert'=>'Exemplo de alerta',
    'decision'=>'Decisão e notificação', 'platform'=>'AserControl', 'places'=>'Casa, chácara e empresa',
    'project'=>'Projeto para o imóvel', 'technology'=>'Tecnologia', 'resilience'=>'Continuidade',
    'reassurance'=>'Aproveitar câmeras e tranquilidade', 'closing'=>'Chamada final',
    'faq_header'=>'Título do FAQ', 'faq'=>'Perguntas frequentes', 'faq_cta'=>'Chamada do FAQ',
];
$cameraV2Labels = [
    'eyebrow'=>'Chamada superior', 'title'=>'Título', 'title_second'=>'Continuação do título',
    'title_third'=>'Fim do título', 'highlight'=>'Destaque do título', 'description'=>'Descrição',
    'text'=>'Texto', 'price'=>'Preço mensal', 'price_note'=>'Observação do preço',
    'price_intro'=>'Introdução do preço', 'price_suffix'=>'Período do preço', 'primary_button'=>'Botão principal',
    'secondary_button'=>'Botão secundário', 'button'=>'Texto do botão',
    'image'=>'Imagem', 'current_image'=>'Imagem das câmeras existentes',
    'calm_image'=>'Imagem de tranquilidade', 'current_title'=>'Título das câmeras existentes',
    'current_title_second'=>'Continuação do título', 'current_text'=>'Texto das câmeras existentes',
    'current_button'=>'Botão das câmeras existentes', 'calm_title'=>'Título de tranquilidade',
    'calm_title_second'=>'Continuação do título', 'calm_text'=>'Texto de tranquilidade',
    'statement'=>'Frase de destaque', 'statement_second'=>'Continuação da frase',
    'normal_title'=>'Título da situação normal', 'normal_text'=>'Texto da situação normal',
    'action_title'=>'Título da ação', 'action_text'=>'Texto da ação', 'event'=>'Evento',
    'time'=>'Horário', 'closing'=>'Texto final', 'signature'=>'Assinatura',
    'notification_title'=>'Aplicativo na notificação', 'notification_when'=>'Quando', 'notification_event'=>'Evento na notificação',
    'notification_place'=>'Local e horário na notificação', 'question'=>'Pergunta',
];
function cameraV2AdminFields(array $data, array $values, string $prefix, array $labels, bool $readonly): void {
    foreach ($data as $key => $default) {
        if ($key === 'icon') continue;
        $path = $prefix . '.' . $key;
        if (is_array($default)) {
            $heading = is_int($key) ? (strpos($prefix, 'answers') !== false ? 'Resposta ' : 'Item ') . ($key + 1) : ucfirst(str_replace('_', ' ', (string)$key));
            echo '<fieldset class="cameraV2Admin__group"><legend>' . htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') . '</legend>';
            cameraV2AdminFields($default, $values[$key] ?? [], $path, $labels, $readonly);
            echo '</fieldset>';
            continue;
        }
        $label = is_int($key) ? 'Resposta ' . ($key + 1) : ($labels[$key] ?? ucfirst(str_replace('_', ' ', (string)$key)));
        $value = htmlspecialchars((string)($values[$key] ?? $default), ENT_QUOTES, 'UTF-8');
        $id = 'cv2-' . str_replace('.', '-', $path);
        $safePath = htmlspecialchars($path, ENT_QUOTES, 'UTF-8');
        $disabled = $readonly ? ' disabled' : '';
        echo '<div class="formGroup__item cameraV2Admin__field"><label class="formGroup__label" for="' . $id . '">' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</label>';
        if ($key === 'image' || substr((string)$key, -6) === '_image') {
            $src = cameraV2Image($path);
            echo '<div class="adminConteudo__imgWrap"><img class="adminConteudo__imgPreview" src="' . $src . '" alt="Prévia da imagem" data-camera-preview="' . $safePath . '">';
            if (!$readonly) echo '<label class="adminConteudo__imgBtn" for="' . $id . '-upload">Trocar imagem</label>';
            echo '<input class="adminConteudo__fileInput" type="file" id="' . $id . '-upload" data-camera-upload="' . $safePath . '" accept="image/jpeg,image/png,image/webp"' . $disabled . '>';
            echo '</div><input type="hidden" id="' . $id . '" data-camera-field="' . $safePath . '" data-camera-image value="' . $value . '">';
        } elseif (cameraV2Length($default) > 100) {
            echo '<textarea class="formGroup__input cameraV2Admin__textarea" id="' . $id . '" data-camera-field="' . $safePath . '" maxlength="4000" rows="4"' . $disabled . '>' . $value . '</textarea>';
        } else {
            echo '<input class="formGroup__input" type="text" id="' . $id . '" data-camera-field="' . $safePath . '" maxlength="4000" value="' . $value . '"' . $disabled . '>';
        }
        echo '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<title>AserNet - Admin - Câmeras de Segurança</title>
<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.7/quill.snow.css">
<?php include ROOT . '/admin/includes/assets.php'; ?>
</head>
<body>
<?php include ROOT . '/admin/includes/header/header.php'; ?>
<div class="adminLayout">
    <?php include ROOT . '/admin/includes/sidebar/sidebar.php'; ?>
    <main class="adminLayout__content">
        <div class="adminConteudo cameraV2Admin">
            <div class="row adminConteudo__head">
                <div class="col-sm-8"><h2>Conteúdo <span>Câmeras de Segurança</span></h2><p class="adminConteudo__subtitle">Edite textos, preços, imagens e perguntas da página atual.</p><a href="<?= BASE_URL ?>/cameradeseguranca" target="_blank" rel="noopener noreferrer">Abrir página para conferir</a></div>
                <?php if (!$cameraV2Readonly): ?><div class="col-sm-4 adminConteudo__headActions"><button type="button" class="btn btn--primary" id="cameraV2Save">Salvar alterações</button></div><?php endif; ?>
            </div>
            <div id="cameraV2Message" class="adminConteudo__msg" role="status" aria-live="polite" style="display:none"></div>
            <?php foreach ($cameraV2Groups as $group => $heading): ?>
                <details class="formGroup adminConteudo__section cameraV2Admin__section"<?= $group === 'hero' ? ' open' : '' ?>>
                    <summary class="adminConteudo__sectionTitle"><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') ?></summary>
                    <?php if ($group === 'faq'): ?>
                    <div class="cameraV2Admin__faqIntro"><div><strong>Organize as dúvidas dos clientes</strong><p>Edite a pergunta e formate a resposta como em um editor de texto.</p></div><span>Até 50 perguntas</span></div>
                    <div class="cameraV2Admin__faqList" id="cameraV2FaqList">
                        <?php foreach ($cameraV2Content['faq'] as $faqIndex => $faqItem): ?>
                        <article class="cameraV2Admin__faqItem" data-camera-faq-item>
                            <div class="cameraV2Admin__faqItemHead"><span data-camera-faq-number>Pergunta <?= $faqIndex + 1 ?></span><?php if (!$cameraV2Readonly): ?><button class="cameraV2Admin__faqRemove" type="button" data-camera-faq-remove>Remover</button><?php endif; ?></div>
                            <label class="cameraV2Admin__faqLabel" for="camera-faq-question-<?= $faqIndex ?>">Pergunta</label>
                            <textarea class="cameraV2Admin__faqQuestion" id="camera-faq-question-<?= $faqIndex ?>" data-camera-faq-question rows="2" maxlength="4000"<?= $cameraV2Readonly ? ' disabled' : '' ?>><?= htmlspecialchars($faqItem['question'], ENT_QUOTES, 'UTF-8') ?></textarea>
                            <label class="cameraV2Admin__faqLabel" for="camera-faq-editor-<?= $faqIndex ?>">Resposta</label>
                            <div class="cameraV2Admin__faqEditor" id="camera-faq-editor-<?= $faqIndex ?>" data-camera-faq-editor><?= $faqItem['answer_html'] ?? implode('', array_map(static fn(string $answer): string => '<p>' . htmlspecialchars($answer, ENT_QUOTES, 'UTF-8') . '</p>', $faqItem['answers'])) ?></div>
                        </article>
                        <?php endforeach; ?>
                    </div>
                    <?php if (!$cameraV2Readonly): ?><button class="cameraV2Admin__faqAdd" id="cameraV2FaqAdd" type="button"><span aria-hidden="true">+</span> Adicionar pergunta</button><?php endif; ?>
                    <?php else: ?>
                    <div class="cameraV2Admin__fields">
                        <?php cameraV2AdminFields($cameraV2Content[$group], $cameraV2Content[$group], $group, $cameraV2Labels, $cameraV2Readonly); ?>
                    </div>
                    <?php endif; ?>
                </details>
            <?php endforeach; ?>
        </div>
    </main>
</div>
<?php include ROOT . '/admin/includes/footer/footer.php'; ?>
<?php include ROOT . '/admin/includes/scripts.php'; ?>
<script>window.CAMERA_V2_ADMIN_BASE = <?= json_encode(ADMIN_BASE_URL) ?>; window.CAMERA_V2_SITE_BASE = <?= json_encode(BASE_URL) ?>; window.CAMERA_V2_CSRF = <?= json_encode($_SESSION['camera_v2_csrf']) ?>;</script>
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script src="<?= ADMIN_BASE_URL ?>/pages/conteudocameras/conteudocamerasv2.js?v=<?= time() ?>"></script>
</body></html>
