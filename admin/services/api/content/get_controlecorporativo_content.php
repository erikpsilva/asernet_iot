<?php
declare(strict_types=1);

require_once dirname(__FILE__, 3) . '/_session.php';

require_once dirname(__FILE__, 3) . '/response.php';

if (empty($_SESSION['usuario'])) {
    json_response(['ok' => false, 'message' => 'Nao autorizado.'], 401);
}
if (!in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor', 'leitor'])) {
    json_response(['ok' => false, 'message' => 'Permissao negada.'], 403);
}

require_once dirname(__FILE__, 5) . '/config/database.php';

$defaults = [
    'partner_label'  => 'Parceiro oficial',
    'partner_texto'  => 'Padr&atilde;o de tecnologia em seguran&ccedil;a, integra&ccedil;&atilde;o e gest&atilde;o.',
    'partner_imagem' => 'logoControlID.png',

    'intro_titulo' => 'Quem entra. Quando entra. Onde entra.',
    'intro_texto'  => 'A AserNet IoT Services oferece solu&ccedil;&otilde;es completas de controle de acesso corporativo utilizando tecnologia Control iD, permitindo gerenciar acessos, registrar movimenta&ccedil;&otilde;es e proteger &aacute;reas cr&iacute;ticas da sua opera&ccedil;&atilde;o.',

    'audiences_titulo' => 'Ideal para',
    'audiences_items' => [
        ['label' => 'Ind&uacute;strias'], ['label' => 'Hospitais'], ['label' => 'Hot&eacute;is e pousadas'],
        ['label' => 'Escolas e universidades'], ['label' => 'Escrit&oacute;rios'], ['label' => 'Clubes e associa&ccedil;&otilde;es'],
    ],

    'technologies_titulo' => 'Tecnologias dispon&iacute;veis',
    'technologies_items' => [
        ['label' => 'Reconhecimento facial'], ['label' => 'Biometria'], ['label' => 'Cart&atilde;o RFID'], ['label' => 'QR Code'],
        ['label' => 'Senhas'], ['label' => 'Catracas'], ['label' => 'Fechaduras eletr&ocirc;nicas'], ['label' => 'Gest&atilde;o em nuvem'],
    ],

    'gains_titulo' => 'O que sua empresa ganha?',
    'gains_items' => [
        ['titulo' => 'Mais seguran&ccedil;a', 'texto' => 'Controle total de acessos e prote&ccedil;&atilde;o de pessoas e patrim&ocirc;nios.'],
        ['titulo' => 'Mais controle', 'texto' => 'Registro completo das movimenta&ccedil;&otilde;es e gest&atilde;o em tempo real.'],
        ['titulo' => 'Mais produtividade', 'texto' => 'Automa&ccedil;&atilde;o dos processos de entrada e redu&ccedil;&atilde;o de tarefas manuais.'],
        ['titulo' => 'Mais auditoria', 'texto' => 'Hist&oacute;rico detalhado e relat&oacute;rios para auditorias internas e externas.'],
    ],

    'applications_titulo' => 'Aplica&ccedil;&otilde;es',
    'applications_items' => [
        ['titulo' => 'Controle de colaboradores', 'texto' => 'Gest&atilde;o de entradas e sa&iacute;das com mais efici&ecirc;ncia.', 'imagem' => 'imgControleDeColaboradores.png'],
        ['titulo' => 'Controle de visitantes', 'texto' => 'Cadastro e autoriza&ccedil;&atilde;o simplificados e seguros.', 'imagem' => 'imgControleDeVisitantes.png'],
        ['titulo' => '&Aacute;reas restritas', 'texto' => 'Prote&ccedil;&atilde;o de ambientes sens&iacute;veis e cr&iacute;ticos.', 'imagem' => 'imgAreasRestritas.png'],
        ['titulo' => 'Prestadores de servi&ccedil;o', 'texto' => 'Controle tempor&aacute;rio e rastre&aacute;vel de acessos.', 'imagem' => 'imgPrestadoresDeServicos.png'],
    ],

    'integration_titulo' => 'Integra&ccedil;&atilde;o com outros sistemas',
    'integration_texto'  => 'Uma infraestrutura integrada oferece mais seguran&ccedil;a e gest&atilde;o para sua empresa.',
    'integration_items' => [
        ['label' => 'Controle de acesso'], ['label' => 'C&acirc;meras de seguran&ccedil;a'], ['label' => 'Internet corporativa'],
        ['label' => 'Wi-Fi Pro'], ['label' => 'Telefonia empresarial'],
    ],

    'equipment_titulo'          => 'Equipamentos profissionais',
    'equipment_titulo_destaque' => 'Control iD',
    'equipment_texto'           => 'Utilizamos equipamentos Control iD, refer&ecirc;ncia nacional em controle de acesso corporativo.',
    'equipment_btn_texto'       => 'Conhe&ccedil;a os equipamentos',
    'equipment_imagem'          => 'imgEquipamentosProffisionais.png',

    'steps_titulo' => 'Como funciona',
    'steps_items' => [
        ['titulo' => 'Identifica&ccedil;&atilde;o', 'texto' => 'Usu&aacute;rio se identifica por biometria, cart&atilde;o, QR Code, senha ou facial.'],
        ['titulo' => 'Valida&ccedil;&atilde;o', 'texto' => 'Sistema verifica as permiss&otilde;es em tempo real.'],
        ['titulo' => 'Libera&ccedil;&atilde;o', 'texto' => 'Portas, catracas ou cancelas s&atilde;o liberadas automaticamente.'],
        ['titulo' => 'Registro', 'texto' => 'Todas as movimenta&ccedil;&otilde;es s&atilde;o registradas com data, hora e local.'],
        ['titulo' => 'Relat&oacute;rios', 'texto' => 'Relat&oacute;rios completos para gest&atilde;o e tomada de decis&otilde;es.'],
    ],

    'cta_titulo'          => 'Sua empresa mais segura,',
    'cta_titulo_destaque' => 'organizada e eficiente.',
    'cta_texto'           => 'Solicite um projeto personalizado com especialistas da AserNet IoT Services.',
    'cta_btn1_texto'      => '0800 222 5262',
    'cta_btn2_texto'      => 'Solicitar apresenta&ccedil;&atilde;o',
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'controlecorporativo_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['partner_label', 'partner_texto', 'partner_imagem',
                        'intro_titulo', 'intro_texto',
                        'audiences_titulo', 'technologies_titulo', 'gains_titulo', 'applications_titulo',
                        'integration_titulo', 'integration_texto',
                        'equipment_titulo', 'equipment_titulo_destaque', 'equipment_texto', 'equipment_btn_texto', 'equipment_imagem',
                        'steps_titulo',
                        'cta_titulo', 'cta_titulo_destaque', 'cta_texto', 'cta_btn1_texto', 'cta_btn2_texto'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            foreach (['audiences_items', 'technologies_items', 'integration_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($defaults[$arr][$i]) || !is_array($item)) continue;
                        if (isset($item['label']) && strlen((string) $item['label'])) $defaults[$arr][$i]['label'] = $item['label'];
                    }
                }
            }
            foreach (['gains_items', 'applications_items', 'steps_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($defaults[$arr][$i]) || !is_array($item)) continue;
                        foreach (array_keys($defaults[$arr][$i]) as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $defaults[$arr][$i][$k] = $item[$k];
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

$decode_entities_cc = function ($value) use (&$decode_entities_cc) {
    if (is_array($value)) return array_map($decode_entities_cc, $value);
    if (is_string($value)) return html_entity_decode($value, ENT_QUOTES, 'UTF-8');
    return $value;
};

json_response(['ok' => true, 'content' => $decode_entities_cc($defaults)]);
