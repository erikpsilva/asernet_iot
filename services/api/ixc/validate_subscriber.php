<?php
declare(strict_types=1);

require_once dirname(__FILE__, 4) . '/services/response.php';
require_once dirname(__FILE__) . '/ixc_client.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['ok' => false, 'message' => 'Método não permitido.'], 405);
}

$body = read_json();
$cpf  = preg_replace('/\D/', '', $body['cpf'] ?? '');

if (strlen($cpf) !== 11) {
    json_response(['ok' => false, 'message' => 'CPF inválido.'], 400);
}

$result = ixc_get_cliente_por_cpf($cpf);

if (!$result['ok']) {
    json_response(['ok' => false, 'message' => $result['error']], 502);
}

$registros = $result['data']['registros'] ?? [];

if (empty($registros)) {
    json_response(['ok' => true, 'isSubscriber' => false, 'client' => null]);
}

$cliente = $registros[0];

json_response([
    'ok'           => true,
    'isSubscriber' => true,
    'client'       => [
        'id'    => $cliente['id'] ?? null,
        'name'  => $cliente['razao'] ?? '',
        'email' => $cliente['email'] ?? '',
        'cpf'   => $cliente['cnpj_cpf'] ?? '',
    ],
]);
