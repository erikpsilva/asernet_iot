<?php
declare(strict_types=1);
require_once dirname(__FILE__, 3) . '/_session.php';
require_once dirname(__FILE__, 3) . '/response.php';
if (empty($_SESSION['usuario'])) json_response(['ok'=>false, 'message'=>'Não autorizado.'], 401);
if (!in_array($_SESSION['usuario']['nivel_acesso'] ?? '', ['admin','editor','leitor'], true)) json_response(['ok'=>false, 'message'=>'Permissão negada.'], 403);
require_once dirname(__FILE__, 5) . '/pages/cameradeseguranca/content.php';
json_response(['ok'=>true, 'content'=>cameraV2Content()]);
