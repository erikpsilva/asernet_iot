<?php
declare(strict_types=1);

function ixc_get_cliente_por_cpf(string $cpfDigits): array
{
    $config = require dirname(__FILE__, 4) . '/config/ixc.php';

    $cpf = preg_replace('/\D/', '', $cpfDigits);
    $cpfFormatado = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);

    $payload = json_encode([
        'qtype'      => 'cliente.cnpj_cpf',
        'query'      => $cpfFormatado,
        'oper'       => '=',
        'page'       => '1',
        'grid_param' => '[{"TB":"cliente.ativo","OP":"=","P":"S"}]',
    ]);

    $auth = 'Basic ' . base64_encode($config['user'] . ':' . $config['pass']);

    $ch = curl_init($config['host'] . '/webservice/v1/cliente');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_TIMEOUT        => 20,
        CURLOPT_HTTPHEADER     => [
            'Authorization: ' . $auth,
            'Content-Type: application/json',
            'ixcsoft: listar',
        ],
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        return ['ok' => false, 'error' => 'Erro de conexão com o sistema: ' . $curlError];
    }

    if ($httpCode >= 300) {
        return ['ok' => false, 'error' => 'Sistema retornou status ' . $httpCode];
    }

    $data = json_decode($response, true);
    if (!is_array($data)) {
        return ['ok' => false, 'error' => 'Resposta inválida do sistema'];
    }

    return ['ok' => true, 'data' => $data];
}
