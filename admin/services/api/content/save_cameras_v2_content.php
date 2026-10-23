<?php
declare(strict_types=1);
require_once dirname(__FILE__, 3) . '/_session.php';
require_once dirname(__FILE__, 3) . '/response.php';
if (empty($_SESSION['usuario'])) json_response(['ok'=>false, 'message'=>'Não autorizado.'], 401);
if ($_SERVER['REQUEST_METHOD'] !== 'POST') json_response(['ok'=>false, 'message'=>'Método não permitido.'], 405);
if (!in_array($_SESSION['usuario']['nivel_acesso'] ?? '', ['admin','editor'], true)) json_response(['ok'=>false, 'message'=>'Permissão negada.'], 403);
if (empty($_SESSION['camera_v2_csrf']) || !hash_equals($_SESSION['camera_v2_csrf'], $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '')) json_response(['ok'=>false, 'message'=>'Sessão expirada. Atualize a página.'], 403);

require_once dirname(__FILE__, 5) . '/pages/cameradeseguranca/content.php';
$body = read_json();
$submitted = $body['fields'] ?? null;
$submittedFaq = $body['faq'] ?? null;
if (!is_array($submitted) || !is_array($submittedFaq)) json_response(['ok'=>false, 'message'=>'Campos inválidos.'], 400);
$content = cameraV2Defaults();
unset($content['faq']);
$allowed = cameraV2Fields($content);
if (count($submitted) !== count($allowed) || array_diff_key($submitted, $allowed) || array_diff_key($allowed, $submitted)) {
    json_response(['ok'=>false, 'message'=>'A lista de campos está incompleta ou contém itens desconhecidos. Atualize a página e tente novamente.'], 400);
}
foreach ($allowed as $path => $default) {
    $value = $submitted[$path];
    if (!is_string($value) || cameraV2Length($value) > 4000) {
        json_response(['ok'=>false, 'message'=>'Valor inválido no campo ' . $path . '.'], 400);
    }
    $last = substr($path, strrpos($path, '.') + 1);
    if (($last === 'image' || substr($last, -6) === '_image') && !preg_match('/^[a-zA-Z0-9._-]+\.(?:png|jpe?g|webp)$/', $value)) {
        json_response(['ok'=>false, 'message'=>'Imagem inválida no campo ' . $path . '.'], 400);
    }
    if ($last === 'price' && !preg_match('/^\d{1,5},\d{2}$/', $value)) {
        json_response(['ok'=>false, 'message'=>'Informe o preço no formato 39,90.'], 400);
    }
    cameraV2SetField($content, $path, trim($value));
}
$faq = cameraV2NormalizeFaq($submittedFaq);
if ($faq === null) json_response(['ok'=>false, 'message'=>'Revise as perguntas e respostas do FAQ. O limite é de 50 perguntas.'], 400);
$content['faq'] = $faq;

require_once dirname(__FILE__, 5) . '/config/database.php';
try {
    $json = json_encode($content, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    getDbConnection(true)->prepare("INSERT INTO system_settings (setting_key, setting_value) VALUES ('cameras_v2_content', ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)")->execute([$json]);
    json_response(['ok'=>true, 'message'=>'Conteúdo da página salvo com sucesso.']);
} catch (Throwable $e) {
    error_log('CAMERA V2 SAVE ERROR: ' . $e->getMessage());
    json_response(['ok'=>false, 'message'=>'Não foi possível salvar o conteúdo.'], 500);
}
