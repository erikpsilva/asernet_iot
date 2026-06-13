<?php
if (session_status() === PHP_SESSION_NONE) {
    $__sessDir = dirname(__FILE__, 3) . '/sessions';
    if (!is_dir($__sessDir)) @mkdir($__sessDir, 0755, true);
    if (is_dir($__sessDir) && is_writable($__sessDir)) {
        ini_set('session.save_path', $__sessDir);
    }
    session_start();
    unset($__sessDir);
}
