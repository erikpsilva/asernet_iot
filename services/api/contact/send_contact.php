<?php
declare(strict_types=1);

require_once dirname(__FILE__, 4) . '/config/database.php';
require_once dirname(__FILE__, 3) . '/response.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['ok' => false, 'message' => 'Método não permitido.'], 405);
}

$body    = read_json();
$nome    = trim($body['nome']    ?? '');
$tel     = trim($body['telefone'] ?? '');
$cidade  = trim($body['cidade']   ?? '');
$ints    = $body['interesses']    ?? [];

if (strlen($nome) < 2) {
    json_response(['ok' => false, 'message' => 'Nome é obrigatório.'], 400);
}
if (strlen(preg_replace('/\D/', '', $tel)) < 10) {
    json_response(['ok' => false, 'message' => 'Telefone inválido.'], 400);
}

$pdo  = getDbConnection();
$stmt = $pdo->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'contact_emails' LIMIT 1");
$stmt->execute();
$row  = $stmt->fetch();

$emails = [];
if ($row && $row['setting_value']) {
    $emails = array_filter(array_map('trim', explode("\n", $row['setting_value'])));
    $emails = array_values(array_filter($emails, fn($e) => filter_var($e, FILTER_VALIDATE_EMAIL)));
}

if (empty($emails)) {
    json_response(['ok' => true, 'message' => 'Formulário recebido (nenhum e-mail configurado).']);
}

$interessesStr = !empty($ints) ? implode(', ', array_map('htmlspecialchars', $ints)) : 'Nenhum';
$nomeSafe      = htmlspecialchars($nome,   ENT_QUOTES, 'UTF-8');
$telSafe       = htmlspecialchars($tel,    ENT_QUOTES, 'UTF-8');
$cidadeSafe    = htmlspecialchars($cidade, ENT_QUOTES, 'UTF-8');

$subject = '=?UTF-8?B?' . base64_encode('Novo contato pelo site - AserNet') . '?=';

$body_html = <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"></head>
<body style="margin:0;padding:0;font-family:Montserrat,Arial,sans-serif;background:#f4f8ff;">
  <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;margin:32px auto;background:#ffffff;border-radius:10px;overflow:hidden;border:1px solid #dce7f4;">
    <tr><td style="background:#075fff;padding:22px 36px;">
      <p style="margin:0;color:#ffffff;font-size:13px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;">Novo Contato pelo Site</p>
    </td></tr>
    <tr><td style="padding:32px 36px;">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td style="padding:10px 0;border-bottom:1px solid #dce7f4;">
            <p style="margin:0 0 3px;color:#8a9ab8;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;">Nome</p>
            <p style="margin:0;color:#06133c;font-size:15px;font-weight:600;">{$nomeSafe}</p>
          </td>
        </tr>
        <tr>
          <td style="padding:10px 0;border-bottom:1px solid #dce7f4;">
            <p style="margin:0 0 3px;color:#8a9ab8;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;">Telefone (WhatsApp)</p>
            <p style="margin:0;color:#06133c;font-size:15px;font-weight:600;">{$telSafe}</p>
          </td>
        </tr>
        <tr>
          <td style="padding:10px 0;border-bottom:1px solid #dce7f4;">
            <p style="margin:0 0 3px;color:#8a9ab8;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;">Cidade / Bairro</p>
            <p style="margin:0;color:#06133c;font-size:15px;">{$cidadeSafe}</p>
          </td>
        </tr>
        <tr>
          <td style="padding:10px 0;">
            <p style="margin:0 0 3px;color:#8a9ab8;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;">O que precisa</p>
            <p style="margin:0;color:#06133c;font-size:15px;">{$interessesStr}</p>
          </td>
        </tr>
      </table>
      <div style="margin-top:24px;text-align:center;">
        <a href="https://wa.me/55{$telSafe}" style="display:inline-block;padding:12px 28px;background:#25d366;border-radius:6px;color:#fff;font-size:14px;font-weight:600;text-decoration:none;">
          Responder no WhatsApp
        </a>
      </div>
    </td></tr>
    <tr><td style="background:#06133c;padding:16px 36px;text-align:center;">
      <p style="margin:0;color:#ffffff;font-size:12px;">© AserNet · formulario@asernet.com.br</p>
    </td></tr>
  </table>
</body>
</html>
HTML;

$headers  = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: formulario@asernet.com.br\r\n";
$headers .= "Return-Path: formulario@asernet.com.br\r\n";

$sent = 0;
foreach ($emails as $to) {
    if (@mail($to, $subject, $body_html, $headers)) {
        $sent++;
    }
}

json_response(['ok' => true, 'message' => 'Formulário enviado.', 'sent' => $sent]);
