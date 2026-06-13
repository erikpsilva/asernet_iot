<?php
declare(strict_types=1);

require_once dirname(__FILE__, 3) . '/_session.php';

require_once dirname(__FILE__, 3) . '/response.php';

if (empty($_SESSION['usuario'])) {
    json_response(['ok' => false, 'message' => 'Não autorizado.'], 401);
}
if (!in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor', 'leitor'])) {
    json_response(['ok' => false, 'message' => 'Permissão negada.'], 403);
}

require_once dirname(__FILE__, 5) . '/config/database.php';

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'contratos_regulamentos' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db) && !empty($db['secoes'])) {
            json_response(['ok' => true, 'data' => $db]);
        }
    }
} catch (Throwable $e) {}

json_response(['ok' => true, 'data' => defaultContratos()]);

function defaultContratos(): array {
    return ['secoes' => [
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
    ]];
}
