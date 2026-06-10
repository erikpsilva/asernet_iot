<?php
declare(strict_types=1);

function send_lucky_email(string $to, string $nameClient, string $numberLucky, string $reasonText): bool
{
    $subject    = '=?UTF-8?B?' . base64_encode('Seu número da sorte - Cruzeiro AserNet') . '?=';
    $nameSafe   = htmlspecialchars($nameClient,  ENT_QUOTES, 'UTF-8');
    $numberSafe = htmlspecialchars($numberLucky, ENT_QUOTES, 'UTF-8');
    $reasonSafe = htmlspecialchars($reasonText,  ENT_QUOTES, 'UTF-8');

    $body = <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"></head>
<body style="margin:0;padding:0;font-family:Montserrat,Arial,sans-serif;background:#f4f8ff;">
  <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;margin:32px auto;background:#ffffff;border-radius:10px;overflow:hidden;border:1px solid #dce7f4;">
    <tr><td style="background:#075fff;padding:24px 36px;text-align:center;">
      <p style="margin:0;color:#ffffff;font-size:13px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;">Cruzeiro AserNet — Número da Sorte</p>
    </td></tr>
    <tr><td style="padding:36px;text-align:center;">
      <p style="margin:0 0 8px;color:#06133c;font-size:16px;font-weight:600;">Olá, {$nameSafe}!</p>
      <p style="margin:0 0 28px;color:#4a5a7a;font-size:14px;line-height:1.5;">Você recebeu um número da sorte para concorrer ao cruzeiro internacional a bordo do <strong>MSC Divina</strong>.</p>
      <div style="display:inline-block;padding:20px 52px;background:#f4f8ff;border:2px solid #075fff;border-radius:12px;">
        <p style="margin:0 0 4px;color:#075fff;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Seu número da sorte</p>
        <p style="margin:0;color:#075fff;font-size:56px;font-weight:700;letter-spacing:6px;line-height:1.1;">{$numberSafe}</p>
      </div>
      <p style="margin:24px 0 0;color:#4a5a7a;font-size:13px;">{$reasonSafe}</p>
    </td></tr>
    <tr><td style="background:#06133c;padding:16px 36px;text-align:center;">
      <p style="margin:0;color:#ffffff;font-size:12px;">© 2025 AserNet. Todos os direitos reservados.</p>
    </td></tr>
  </table>
</body>
</html>
HTML;

    $headers  = "MIME-Version: 1.1\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: formulario@asernet.com.br\r\n";
    $headers .= "Return-Path: indica@asernet.com.br\r\n";

    return @mail($to, $subject, $body, $headers);
}
