<?php

if (session_status() === PHP_SESSION_NONE) {
    $__sessDir = dirname(__FILE__, 3) . '/sessions';
    if (!is_dir($__sessDir)) mkdir($__sessDir, 0755, true);
    ini_set('session.save_path', $__sessDir);
    session_start();
    unset($__sessDir);
}

if (empty($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . '/admin/login');
    exit;
}

$_nivel        = $_SESSION['usuario']['nivel_acesso'] ?? '';
$_isAdmin      = $_nivel === 'admin';
$_isEditorUp   = in_array($_nivel, ['admin', 'editor']);
$_isCruzeiroUp = in_array($_nivel, ['admin', 'editor', 'cruzeiro']);
$_canEdit      = $_isEditorUp;

$_route = $subRoute ?? '';

$_adminOnlyRoutes = ['administrarusuarios', 'cadastrarusuario', 'configuracoes'];
$_cruzeiroRoutes  = ['cruzeiroconfiguracao', 'cadastronumero', 'consultarnumero', 'relatorio', 'bilhetessorteio'];
$_conteudoRoutes  = [
    'banner',
    'conteudoinicio', 'conteudoresidencial', 'conteudocameras', 'conteudowifimesh',
    'conteudomovel', 'conteudorastreamento', 'conteudoskeelo', 'conteudoparaempresas',
    'conteudowifiprofissional', 'conteudotelefoniaempresarial', 'conteudolinkdedicado',
    'conteudocombo', 'conteudosobreasernet', 'conteudosuporte', 'conteudocontratoseregulamentos',
];

if (in_array($_route, $_adminOnlyRoutes) && !$_isAdmin) {
    header('Location: ' . BASE_URL . '/admin/inicio');
    exit;
}
if (in_array($_route, $_cruzeiroRoutes) && !$_isCruzeiroUp) {
    header('Location: ' . BASE_URL . '/admin/inicio');
    exit;
}
if (in_array($_route, $_conteudoRoutes) && !in_array($_nivel, ['admin', 'editor', 'leitor'])) {
    header('Location: ' . BASE_URL . '/admin/inicio');
    exit;
}

$_isReadonlyPage = in_array($_route, $_conteudoRoutes) && !$_canEdit;
