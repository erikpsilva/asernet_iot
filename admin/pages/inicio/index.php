<?php include ROOT . '/admin/includes/auth_check.php'; ?>
<?php
require_once ROOT . '/config/database.php';

$dash = [
    'participantes' => 0,
    'bilhetes'      => 0,
    'usuarios'      => 0,
    'sorteioFmt'    => '—',
];
$dashRecentes = [];

try {
    $_pdo = getDbConnection();

    $dash['participantes'] = (int) $_pdo->query("SELECT COUNT(*) FROM campaign_people")->fetchColumn();
    $dash['bilhetes']      = (int) $_pdo->query("SELECT COUNT(*) FROM lucky_numbers_registry")->fetchColumn();
    $dash['usuarios']      = (int) $_pdo->query("SELECT COUNT(*) FROM admin_usuarios")->fetchColumn();

    $_row = $_pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'sorteio_date' LIMIT 1")->fetch();
    if ($_row && !empty($_row['setting_value'])) {
        try { $dash['sorteioFmt'] = (new DateTime($_row['setting_value']))->format('d/m/Y'); } catch (Exception $_e) {}
    }

    $dashRecentes = $_pdo->query(
        "SELECT name, cpf, created_at, numbersLucky FROM campaign_people ORDER BY created_at DESC LIMIT 5"
    )->fetchAll(PDO::FETCH_ASSOC);

    foreach ($dashRecentes as &$_p) {
        $_nums = json_decode($_p['numbersLucky'] ?? '[]', true);
        $_p['totalNumeros'] = is_array($_nums) ? count($_nums) : 0;
        $_raw = preg_replace('/\D/', '', $_p['cpf']);
        $_p['cpfMask'] = strlen($_raw) === 11
            ? substr($_raw, 0, 3) . '.***.' . substr($_raw, 6, 3) . '-' . substr($_raw, 9, 2)
            : $_p['cpf'];
    }
    unset($_p, $_pdo, $_row, $_nums, $_raw);

} catch (Throwable $_e) { unset($_e); }

$_firstName = explode(' ', trim($_SESSION['usuario']['nome_completo']))[0];
$_nivel     = $_SESSION['usuario']['nivel_acesso'];
$_nivelMap  = ['admin' => 'Admin', 'editor' => 'Editor', 'cruzeiro' => 'Cruzeiro', 'leitor' => 'Leitor'];
?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Admin - Início</title>
<?php include ROOT . '/admin/includes/assets.php'; ?>
</head>
<body>

<?php include ROOT . '/admin/includes/header/header.php'; ?>

<div class="adminLayout">
    <?php include ROOT . '/admin/includes/sidebar/sidebar.php'; ?>
    <main class="adminLayout__content">

        <section class="adminInicio">

            <!-- Boas-vindas -->
            <div class="adminInicio__welcome">
                <div>
                    <h2>Olá, <span><?= htmlspecialchars($_firstName) ?></span>!</h2>
                    <p>Aqui está um resumo do painel e da campanha.</p>
                </div>
            </div>

            <!-- Stats -->
            <?php if (in_array($_nivel, ['admin', 'editor', 'cruzeiro'])): ?>
            <div class="row adminInicio__stats">
                <div class="col-md-3 col-6">
                    <div class="dashStat dashStat--blue">
                        <span class="dashStat__value"><?= number_format($dash['participantes']) ?></span>
                        <span class="dashStat__label">Participantes</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="dashStat dashStat--green">
                        <span class="dashStat__value"><?= number_format($dash['bilhetes']) ?></span>
                        <span class="dashStat__label">Bilhetes gerados</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="dashStat dashStat--orange">
                        <span class="dashStat__value"><?= number_format($dash['usuarios']) ?></span>
                        <span class="dashStat__label">Usuários do painel</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="dashStat dashStat--purple">
                        <span class="dashStat__value dashStat__value--date"><?= htmlspecialchars($dash['sorteioFmt']) ?></span>
                        <span class="dashStat__label">Data do sorteio</span>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Perfil + Últimos participantes -->
            <div class="row adminInicio__body">

                <!-- Perfil -->
                <div class="col-md-4">
                    <div class="dashPerfil formGroup">
                        <h3 class="dashPerfil__title">Meu Perfil</h3>
                        <ul class="dashPerfil__list">
                            <li>
                                <span class="dashPerfil__key">Nome</span>
                                <span class="dashPerfil__val"><?= htmlspecialchars($_SESSION['usuario']['nome_completo']) ?></span>
                            </li>
                            <li>
                                <span class="dashPerfil__key">E-mail</span>
                                <span class="dashPerfil__val"><?= htmlspecialchars($_SESSION['usuario']['email']) ?></span>
                            </li>
                            <li>
                                <span class="dashPerfil__key">Nível</span>
                                <span class="dashPerfil__val">
                                    <span class="dashNivel dashNivel--<?= $_nivel ?>"><?= $_nivelMap[$_nivel] ?? $_nivel ?></span>
                                </span>
                            </li>
                        </ul>
                        <a class="btn btn--primary" href="<?= BASE_URL ?>/admin/meusdados">Editar perfil</a>
                    </div>
                </div>

                <!-- Últimos participantes -->
                <?php if (in_array($_nivel, ['admin', 'editor', 'cruzeiro'])): ?>
                <div class="col-md-8">
                    <div class="dashRecentes formGroup">
                        <h3 class="dashRecentes__title">Últimos participantes cadastrados</h3>
                        <?php if (empty($dashRecentes)): ?>
                            <p class="dashRecentes__empty">Nenhum participante cadastrado ainda.</p>
                        <?php else: ?>
                        <div class="dashRecentes__wrap">
                            <table class="dashTable">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Bilhetes</th>
                                        <th>Cadastrado em</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dashRecentes as $_p): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($_p['name']) ?></td>
                                        <td><?= htmlspecialchars($_p['cpfMask']) ?></td>
                                        <td><span class="dashTable__badge"><?= $_p['totalNumeros'] ?></span></td>
                                        <td><?= $_p['created_at'] ? date('d/m/Y', strtotime($_p['created_at'])) : '—' ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

            </div>

            <!-- Acesso rápido à campanha -->
            <?php if (in_array($_nivel, ['admin', 'editor', 'cruzeiro'])): ?>
            <div class="adminInicio__section">
                <h2 class="adminInicio__sectionTitle">Campanha Cruzeiro</h2>
                <div class="adminInicio__grid">
                    <a href="<?= BASE_URL ?>/admin/cadastronumero" class="adminInicio__card">
                        <span class="adminInicio__card__label">Cadastrar Número</span>
                    </a>
                    <a href="<?= BASE_URL ?>/admin/consultarnumero" class="adminInicio__card">
                        <span class="adminInicio__card__label">Consultar Número</span>
                    </a>
                    <a href="<?= BASE_URL ?>/admin/relatorio" class="adminInicio__card">
                        <span class="adminInicio__card__label">Relatório</span>
                    </a>
                    <a href="<?= BASE_URL ?>/admin/bilhetessorteio" class="adminInicio__card">
                        <span class="adminInicio__card__label">Bilhetes de Sorteio</span>
                    </a>
                </div>
            </div>
            <?php endif; ?>

        </section>

    </main>
</div>

<?php include ROOT . '/admin/includes/footer/footer.php'; ?>
<?php include ROOT . '/admin/includes/scripts.php'; ?>

</body>
</html>
