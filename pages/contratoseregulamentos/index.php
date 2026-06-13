<?php
$_secoes = [];

try {
    require_once ROOT . '/config/database.php';
    $_pdo = getDbConnection();
    $_row = $_pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'contratos_regulamentos' LIMIT 1")->fetch();
    if ($_row && !empty($_row['setting_value'])) {
        $_db = json_decode($_row['setting_value'], true);
        if (is_array($_db) && !empty($_db['secoes'])) {
            $_secoes = $_db['secoes'];
        }
    }
    unset($_pdo, $_row, $_db);
} catch (Throwable $_e) {
    unset($_e);
}

// Fallback com dados padrão se o banco não tiver conteúdo
if (empty($_secoes)) {
    $_secoes = [
        [
            'titulo' => 'Contratos principais e termos gerais',
            'documentos' => [
                ['titulo' => 'Contrato de Prestação de Serviços (SCM e SVA)', 'subtitulo' => 'Registrado em 15/07/2025', 'arquivo' => 'pdf/Contrato_de_Prestacao_de_Servico_SCM_e_SVA_Registrado_em_15072025.pdf'],
                ['titulo' => 'Contrato de Comodato de Equipamentos', 'subtitulo' => 'Equipamentos cedidos em comodato', 'arquivo' => 'pdf/Contrato_de_Comodato_de_Equipamentos.pdf'],
                ['titulo' => 'Contrato de Permanência (Fidelidade)', 'subtitulo' => 'Condições de permanência mínima', 'arquivo' => 'pdf/Contrato_de_Permanencia_Fidelidade.pdf'],
                ['titulo' => 'Termo de Ciência Técnica', 'subtitulo' => 'Termo de ciência e orientações técnicas', 'arquivo' => 'pdf/Termo_de_Ciencia_Tecnica.pdf'],
            ],
        ],
        [
            'titulo' => 'Regulamentos dos planos de internet',
            'documentos' => [
                ['titulo' => 'Plano Aser Conecta 1 Giga AC', 'subtitulo' => 'Internet residencial', 'arquivo' => 'pdf/Plano_Aser_Conecta_1_Giga_AC.pdf'],
                ['titulo' => 'Plano Aser Ultra 1 Giga AX', 'subtitulo' => 'Internet residencial', 'arquivo' => 'pdf/Plano_Aser_Ultra_1_Giga_AX.pdf'],
                ['titulo' => 'Plano Aser Cobertura Total 1 Giga AC + Mesh', 'subtitulo' => 'Internet residencial com Mesh', 'arquivo' => 'pdf/Plano_Aser_Cobertura_Total_1_Giga_AC_Mesh.pdf'],
                ['titulo' => 'Plano Aser Casa Conectada 1 Giga AX + Mesh', 'subtitulo' => 'Internet residencial com Mesh', 'arquivo' => 'pdf/Plano_Aser_Casa_Conectada_1_Giga_AX_Mesh.pdf'],
                ['titulo' => 'Plano PME Aser Conecta 1 Giga AC', 'subtitulo' => 'Internet para empresas', 'arquivo' => 'pdf/Plano_PME_Aser_Conecta_1_Giga_AC.pdf'],
                ['titulo' => 'Plano PME Aser Ultra 1 Giga AX', 'subtitulo' => 'Internet para empresas', 'arquivo' => 'pdf/Plano_PME_Aser_Ultra_1_Giga_AX.pdf'],
                ['titulo' => 'Plano PME Aser Cobertura Total 1 Giga AC + Mesh', 'subtitulo' => 'Internet PME com Mesh', 'arquivo' => 'pdf/Plano_PME_Aser_Cobertura_Total_1_Giga_AC_Mesh.pdf'],
                ['titulo' => 'Plano PME Aser Empresa Conectada 1 Giga AX + Mesh', 'subtitulo' => 'Internet PME com Mesh', 'arquivo' => 'pdf/Plano_PME_Aser_Empresa_Conectada_1_Giga_AX_Mesh.pdf'],
            ],
        ],
        [
            'titulo' => 'Campanhas promocionais ativas',
            'documentos' => [
                ['titulo' => 'Campanha "Destrave. Vem ser Giga com a AserNet"', 'subtitulo' => 'Regulamento promocional', 'arquivo' => 'pdf/Campanha_Destrave_Vem_ser_Giga_com_a_Asernet.pdf'],
            ],
        ],
    ];
}
?>
<!DOCTYPE html>
<html>
<head>
<title>AserNet - Contratos e Regulamentos</title>

<?php include ROOT . '/includes/assets.php';?>

</head>

<body>

<?php include ROOT . '/includes/header/header.php';?>

<main class="contracts-page">
    <section class="contracts-page__hero">
        <div class="container">
            <div class="contracts-page__hero-copy">
                <span>Institucional</span>
                <h1>Contratos e <strong>regulamentos</strong></h1>
                <p>Consulte documentos contratuais, termos e regulamentos vigentes das ofertas AserNet sempre que precisar.</p>
                <div class="contracts-page__hero-actions">
                    <a href="#documentos"><i class="icon-contrato" aria-hidden="true"></i>Ver documentos</a>
                    <a href="<?= BASE_URL ?>/contato"><i class="icon-talk" aria-hidden="true"></i>Falar com atendimento</a>
                </div>
            </div>
        </div>
    </section>

    <section class="contracts-page__intro">
        <div class="container">
            <div class="contracts-page__intro-grid">
                <div>
                    <span>Transparência</span>
                    <h2>Documentos oficiais da AserNet em um só lugar.</h2>
                </div>
                <p>Prezamos pela clareza no relacionamento com você. Nesta página estão reunidos contratos, termos gerais, regulamentos de planos e campanhas promocionais para consulta e download.</p>
            </div>
        </div>
    </section>

    <section class="contracts-page__documents" id="documentos">
        <div class="container">
            <div class="contracts-page__documents-grid">
                <?php foreach ($_secoes as $_sec): ?>
                <?php if (empty($_sec['documentos'])) continue; ?>
                <article class="contracts-page__group">
                    <details open>
                        <summary>
                            <span>
                                <i class="icon-contrato" aria-hidden="true"></i>
                                <strong><?= htmlspecialchars($_sec['titulo'], ENT_QUOTES, 'UTF-8') ?></strong>
                            </span>
                        </summary>
                        <div class="contracts-page__downloads">
                            <?php foreach ($_sec['documentos'] as $_doc): ?>
                            <?php
                                $_parts  = explode('/', $_doc['arquivo'] ?? '');
                                $_href   = BASE_URL . '/' . implode('/', array_map('rawurlencode', $_parts));
                            ?>
                            <a class="contracts-page__download" href="<?= $_href ?>" target="_blank" rel="noopener">
                                <i class="icon-contrato" aria-hidden="true"></i>
                                <span>
                                    <strong><?= htmlspecialchars($_doc['titulo'],    ENT_QUOTES, 'UTF-8') ?></strong>
                                    <?php if (!empty($_doc['subtitulo'])): ?>
                                    <em><?= htmlspecialchars($_doc['subtitulo'], ENT_QUOTES, 'UTF-8') ?></em>
                                    <?php endif; ?>
                                </span>
                                <b>Baixar PDF</b>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </details>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php include ROOT . '/includes/footer/footer.php';?>
<?php include ROOT . '/includes/scripts.php';?>

</body>
</html>
