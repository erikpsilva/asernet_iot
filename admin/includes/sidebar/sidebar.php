<?php
$_nivel      = $_SESSION['usuario']['nivel_acesso'];
$_isAdmin    = $_nivel === 'admin';
$_isEditorUp = in_array($_nivel, ['admin', 'editor']);

$_crzRoutes       = ['cruzeiroconfiguracao', 'cadastronumero', 'consultarnumero', 'relatorio', 'bilhetessorteio'];
$_plataformaRoutes = ['meusdados', 'administrarusuarios', 'cadastrarusuario', 'configuracoes'];
$_conteudoRoutes  = ['conteudoinicio', 'conteudosuporte'];

$_plataformaOpen = in_array($subRoute, $_plataformaRoutes) ? 'open' : '';
$_cruzeiroOpen   = in_array($subRoute, $_crzRoutes)        ? 'open' : '';
$_conteudoOpen   = in_array($subRoute, $_conteudoRoutes)   ? 'open' : '';
?>
<aside class="sidebar">
    <nav class="sidebar__nav">
        <ul class="sidebar__menu">

            <li class="sidebar__item">
                <a href="<?= BASE_URL ?>/admin/inicio"
                   class="sidebar__link <?= ($subRoute === 'inicio') ? 'sidebar__link--active' : '' ?>">
                    Início
                </a>
            </li>

            <!-- PLATAFORMA -->
            <li class="sidebar__section-accordion">
                <details <?= $_plataformaOpen ?>>
                    <summary class="sidebar__section-toggle">Plataforma</summary>
                    <ul class="sidebar__submenu">

                        <li>
                            <a href="<?= BASE_URL ?>/admin/meusdados"
                               class="sidebar__sublink <?= ($subRoute === 'meusdados') ? 'sidebar__sublink--active' : '' ?>">
                                Meus Dados
                            </a>
                        </li>

                        <?php if ($_isAdmin): ?>
                        <li>
                            <a href="<?= BASE_URL ?>/admin/administrarusuarios"
                               class="sidebar__sublink <?= ($subRoute === 'administrarusuarios') ? 'sidebar__sublink--active' : '' ?>">
                                Administrar Usuários
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/admin/cadastrarusuario"
                               class="sidebar__sublink <?= ($subRoute === 'cadastrarusuario') ? 'sidebar__sublink--active' : '' ?>">
                                Cadastrar Usuário
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/admin/configuracoes"
                               class="sidebar__sublink <?= ($subRoute === 'configuracoes') ? 'sidebar__sublink--active' : '' ?>">
                                Configurações
                            </a>
                        </li>
                        <?php endif; ?>

                    </ul>
                </details>
            </li>

            <!-- CRUZEIRO -->
            <?php if ($_isEditorUp): ?>
            <li class="sidebar__section-accordion">
                <details <?= $_cruzeiroOpen ?>>
                    <summary class="sidebar__section-toggle">Cruzeiro</summary>
                    <ul class="sidebar__submenu">

                        <?php if ($_isAdmin): ?>
                        <li>
                            <a href="<?= BASE_URL ?>/admin/cruzeiroconfiguracao"
                               class="sidebar__sublink <?= ($subRoute === 'cruzeiroconfiguracao') ? 'sidebar__sublink--active' : '' ?>">
                                Configurações
                            </a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?= BASE_URL ?>/admin/cadastronumero"
                               class="sidebar__sublink <?= ($subRoute === 'cadastronumero') ? 'sidebar__sublink--active' : '' ?>">
                                Cadastrar Número
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/admin/consultarnumero"
                               class="sidebar__sublink <?= ($subRoute === 'consultarnumero') ? 'sidebar__sublink--active' : '' ?>">
                                Consultar Número
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/admin/relatorio"
                               class="sidebar__sublink <?= ($subRoute === 'relatorio') ? 'sidebar__sublink--active' : '' ?>">
                                Relatório
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/admin/bilhetessorteio"
                               class="sidebar__sublink <?= ($subRoute === 'bilhetessorteio') ? 'sidebar__sublink--active' : '' ?>">
                                Bilhetes de Sorteio
                            </a>
                        </li>

                    </ul>
                </details>
            </li>
            <?php endif; ?>

            <!-- CONTEÚDO -->
            <?php if ($_isEditorUp): ?>
            <li class="sidebar__section-accordion">
                <details <?= $_conteudoOpen ?>>
                    <summary class="sidebar__section-toggle">Conteúdo</summary>
                    <ul class="sidebar__submenu">
                        <li>
                            <a href="<?= BASE_URL ?>/admin/conteudoinicio"
                               class="sidebar__sublink <?= ($subRoute === 'conteudoinicio') ? 'sidebar__sublink--active' : '' ?>">
                                Início
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/admin/conteudosuporte"
                               class="sidebar__sublink <?= ($subRoute === 'conteudosuporte') ? 'sidebar__sublink--active' : '' ?>">
                                Suporte / FAQ
                            </a>
                        </li>
                    </ul>
                </details>
            </li>
            <?php endif; ?>

        </ul>
    </nav>
</aside>

<div class="sidebar__overlay" id="sidebarOverlay"></div>
