<?php
header('Content-Type: application/json');
echo json_encode([
    'ok'         => true,
    'method'     => $_SERVER['REQUEST_METHOD'],
    'get_url'    => $_GET['url'] ?? '(não definido — arquivo servido diretamente)',
    'post_email' => $_POST['email'] ?? '(vazio)',
    'script'     => $_SERVER['SCRIPT_FILENAME'] ?? '',
]);
