<?php
// APAGAR APÓS O USO
session_start();
$_SESSION['teste'] = 'funcionando';
header('Content-Type: application/json');
echo json_encode([
    'ok'          => true,
    'session_id'  => session_id(),
    'session_set' => $_SESSION['teste'],
    'save_path'   => session_save_path(),
    'cookie'      => session_get_cookie_params(),
]);
