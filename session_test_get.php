<?php
// APAGAR APÓS O USO
session_start();
header('Content-Type: application/json');
echo json_encode([
    'ok'             => true,
    'session_id'     => session_id(),
    'session_value'  => $_SESSION['teste'] ?? '(VAZIO — sessão não persistiu)',
    'session_exists' => isset($_SESSION['teste']),
]);
