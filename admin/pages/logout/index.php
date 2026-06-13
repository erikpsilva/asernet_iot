<?php
if (session_status() === PHP_SESSION_NONE) {
    $__sessDir = dirname(__FILE__, 4) . '/sessions';
    if (!is_dir($__sessDir)) mkdir($__sessDir, 0755, true);
    ini_set('session.save_path', $__sessDir);
    session_start();
    unset($__sessDir);
}
session_destroy();
header('Location: ' . BASE_URL . '/admin/login');
exit;
