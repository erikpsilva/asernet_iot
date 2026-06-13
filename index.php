<?php

define('ROOT', __DIR__);

// Sessão inicializada aqui uma vez para todas as páginas roteadas.
// Serviços servidos diretamente pelo Apache (admin/services/*.php)
// têm seu próprio session_start com o mesmo path.
if (session_status() === PHP_SESSION_NONE) {
    $__sessDir = __DIR__ . '/sessions';
    if (!is_dir($__sessDir)) @mkdir($__sessDir, 0755, true);
    if (is_dir($__sessDir) && is_writable($__sessDir)) {
        ini_set('session.save_path', $__sessDir);
    }
    session_start();
    unset($__sessDir);
}

$_https    = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
          || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
$_scheme   = $_https ? 'https' : 'http';
$_host     = $_SERVER['HTTP_HOST'];  // já inclui porta se não-padrão (ex: localhost:3000)
$_basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
define('BASE_URL', $_scheme . '://' . $_host . $_basePath);
unset($_https, $_scheme, $_host, $_basePath);

define('ADMIN_BASE_URL', BASE_URL . '/admin');

$route     = explode('/', $_GET['url'] ?? 'inicio');
$mainRoute = preg_replace('/[^a-zA-Z0-9_-]/', '', $route[0]);

// ── Admin ──────────────────────────────────────────────────────────────────
if ($mainRoute === 'admin') {

    $subRoute = (isset($route[1]) && $route[1] !== '')
        ? preg_replace('/[^a-zA-Z0-9_-]/', '', $route[1])
        : 'login';

    // admin/services/... → inclui o arquivo de serviço diretamente
    if ($subRoute === 'services') {
        $segments = array_map(function ($s) {
            return preg_replace('/[^a-zA-Z0-9_.\-]/', '', $s);
        }, array_slice($route, 1));

        $svcPath = ROOT . '/admin/' . implode('/', $segments);

        if (substr($svcPath, -4) === '.php' && file_exists($svcPath)) {
            include $svcPath;
        } else {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['ok' => false, 'message' => 'Serviço não encontrado.']);
        }
        exit;
    }

    // admin/{page} → página do admin
    $adminPage = ROOT . '/admin/pages/' . $subRoute . '/index.php';
    include file_exists($adminPage) ? $adminPage : ROOT . '/admin/pages/login/index.php';

// ── Serviços públicos ──────────────────────────────────────────────────────
} elseif ($mainRoute === 'services') {

    $segments = array_map(function ($s) {
        return preg_replace('/[^a-zA-Z0-9_.\-]/', '', $s);
    }, $route);

    $svcPath = ROOT . '/' . implode('/', $segments);

    if (substr($svcPath, -4) === '.php' && file_exists($svcPath)) {
        include $svcPath;
    } else {
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['ok' => false, 'message' => 'Serviço não encontrado.']);
    }
    exit;

// ── Redirecionamentos externos ─────────────────────────────────────────────
} elseif ($mainRoute === 'vagas') {

    header('Location: https://asernet.vagas.solides.com.br/', true, 301);
    exit;

// ── Páginas públicas ───────────────────────────────────────────────────────
} else {

    $publicPage = ROOT . '/pages/' . $mainRoute . '/index.php';
    include file_exists($publicPage) ? $publicPage : ROOT . '/pages/inicio/index.php';

}
?>
