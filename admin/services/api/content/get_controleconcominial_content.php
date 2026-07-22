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
    'intro_titulo' => 'Seguran&ccedil;a e comodidade para todos',
    'intro_texto'  => 'Nosso sistema integra seguran&ccedil;a, tecnologia e praticidade para gerenciar acessos e reservas, valorizando o patrim&ocirc;nio e proporcionando tranquilidade para todos.',

    'technologies_titulo' => 'Tecnologias dispon&iacute;veis',
    'technologies_items' => [
        ['label' => 'Reconhecimento facial'], ['label' => 'QR Code'], ['label' => 'Placas veiculares'], ['label' => 'Cart&otilde;es RFID'],
        ['label' => 'C&oacute;digos PIN'], ['label' => 'Interfone IP'], ['label' => 'Aplicativo'], ['label' => 'Gest&atilde;o em nuvem'],
    ],

    'audiences_titulo' => 'Ideal para',
    'audiences_items' => [
        ['label' => 'Condom&iacute;nios verticais', 'imagem' => 'imgCondominiosVerticais.png'],
        ['label' => 'Condom&iacute;nios horizontais', 'imagem' => 'imgCondominiosHorizontais.png'],
        ['label' => 'Loteamentos fechados', 'imagem' => 'imgLoteamentoFechados.png'],
        ['label' => 'Associa&ccedil;&otilde;es de moradores', 'imagem' => 'associacoesDeMoradores.png'],
        ['label' => 'Empresas e escrit&oacute;rios', 'imagem' => 'imgEmpresasEscritorios.png'],
    ],

    'benefits_titulo' => 'Benef&iacute;cios para moradores',
    'benefits_items' => [
        ['titulo' => 'Entrada sem senha', 'texto' => 'Acesso por biometria, QR Code ou aplicativo.'],
        ['titulo' => 'Mais seguran&ccedil;a', 'texto' => 'Controle de entradas e sa&iacute;das em tempo real.'],
        ['titulo' => 'Hist&oacute;rico completo', 'texto' => 'Libere acessos de onde estiver.'],
        ['titulo' => 'Mais valoriza&ccedil;&atilde;o', 'texto' => 'Valoriza&ccedil;&atilde;o do condom&iacute;nio e patrim&ocirc;nio.'],
    ],

    'app_titulo'  => 'Aplicativo do condom&iacute;nio',
    'app_imagem'  => 'imgAplicativoDoCondomino.png',
    'app_texto'   => 'Baixe o aplicativo e tenha o seu condom&iacute;nio na palma da m&atilde;o.',
    'app_features_items' => [
        ['titulo' => 'Visitas', 'texto' => 'Autorize visitas de qualquer lugar.'],
        ['titulo' => 'Reservas de &aacute;reas comuns', 'texto' => 'Praticidade na palma da m&atilde;o.'],
        ['titulo' => 'Abertura remota', 'texto' => 'Libere acessos de onde estiver.'],
        ['titulo' => 'Comunicados', 'texto' => 'Envie avisos e informa&ccedil;&otilde;es importantes.'],
        ['titulo' => 'Notifica&ccedil;&otilde;es', 'texto' => 'Receba alertas em tempo real.'],
    ],

    'flow_titulo' => 'Controle completo de visitantes',
    'flow_items' => [
        ['titulo' => 'Solicita&ccedil;&atilde;o da visita', 'texto' => 'Pr&eacute;-cadastro feito pelo morador ou s&iacute;ndico.'],
        ['titulo' => 'Envio do link ou QR Code', 'texto' => 'O visitante recebe por e-mail ou WhatsApp.'],
        ['titulo' => 'Chegada ao condom&iacute;nio', 'texto' => 'Acesso r&aacute;pido e seguro na portaria.'],
        ['titulo' => 'Acesso autorizado', 'texto' => 'Libera&ccedil;&atilde;o feita de onde estiver.'],
        ['titulo' => 'Hist&oacute;rico e relat&oacute;rios', 'texto' => 'Acompanhamento completo e seguro.'],
    ],

    'integrations_titulo' => 'Integra&ccedil;&atilde;o com outras solu&ccedil;&otilde;es',
    'integrations_items' => [
        ['label' => 'Controle de acesso'], ['label' => 'C&acirc;meras de seguran&ccedil;a'], ['label' => 'Wi-Fi para &aacute;reas comuns'],
        ['label' => 'Internet dedicada'], ['label' => 'Gest&atilde;o inteligente'], ['label' => 'Condom&iacute;nio inteligente'],
    ],

    'equipment_titulo'    => 'Solu&ccedil;&otilde;es Control iD',
    'equipment_texto'     => 'Solu&ccedil;&otilde;es completas para todos os tipos de controle de acesso.',
    'equipment_btn_texto' => 'Conhe&ccedil;a os equipamentos',
    'equipment_imagem'    => 'imgSolucoes.png',
    'equipment_logo'      => 'logoControlID.png',

    'how_titulo' => 'Como funciona',
    'how_items' => [
        ['titulo' => 'Cadastro', 'texto' => 'Cadastre moradores, visitantes e ve&iacute;culos.'],
        ['titulo' => 'Envio do link', 'texto' => 'QR Code enviado por e-mail ou WhatsApp.'],
        ['titulo' => 'Libera&ccedil;&atilde;o', 'texto' => 'Libera&ccedil;&atilde;o de acesso pelo sistema ou aplicativo.'],
        ['titulo' => 'Entrada', 'texto' => 'Acesso autorizado com tecnologia segura.'],
        ['titulo' => 'Registro', 'texto' => 'Tudo registrado em tempo real na nuvem.'],
    ],

    'cta_titulo'          => 'Seu condom&iacute;nio mais',
    'cta_titulo_destaque' => 'moderno, seguro e conectado.',
    'cta_texto'           => 'Solicite uma apresenta&ccedil;&atilde;o e descubra como podemos transformar a gest&atilde;o de acessos.',
    'cta_btn1_texto'      => '0800 222 5262',
    'cta_btn2_texto'      => 'Solicitar apresenta&ccedil;&atilde;o',
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'controleconcominial_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['intro_titulo', 'intro_texto', 'technologies_titulo', 'audiences_titulo', 'benefits_titulo',
                        'app_titulo', 'app_imagem', 'app_texto', 'flow_titulo', 'integrations_titulo',
                        'equipment_titulo', 'equipment_texto', 'equipment_btn_texto', 'equipment_imagem', 'equipment_logo',
                        'how_titulo', 'cta_titulo', 'cta_titulo_destaque', 'cta_texto', 'cta_btn1_texto', 'cta_btn2_texto'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            foreach (['technologies_items', 'integrations_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($defaults[$arr][$i]) || !is_array($item)) continue;
                        if (isset($item['label']) && strlen((string) $item['label'])) $defaults[$arr][$i]['label'] = $item['label'];
                    }
                }
            }
            if (!empty($db['audiences_items']) && is_array($db['audiences_items'])) {
                foreach ($db['audiences_items'] as $i => $item) {
                    if (!isset($defaults['audiences_items'][$i]) || !is_array($item)) continue;
                    foreach (array_keys($defaults['audiences_items'][$i]) as $k) {
                        if (isset($item[$k]) && strlen((string) $item[$k])) $defaults['audiences_items'][$i][$k] = $item[$k];
                    }
                }
            }
            foreach (['benefits_items', 'app_features_items', 'flow_items', 'how_items'] as $arr) {
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

$decode_entities_cd = function ($value) use (&$decode_entities_cd) {
    if (is_array($value)) return array_map($decode_entities_cd, $value);
    if (is_string($value)) return html_entity_decode($value, ENT_QUOTES, 'UTF-8');
    return $value;
};

json_response(['ok' => true, 'content' => $decode_entities_cd($defaults)]);
