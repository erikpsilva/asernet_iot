<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) session_start();

require_once dirname(__FILE__, 3) . '/response.php';

if (empty($_SESSION['usuario'])) {
    json_response(['ok' => false, 'message' => 'Nao autorizado.'], 401);
}
if (!in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor'])) {
    json_response(['ok' => false, 'message' => 'Permissao negada.'], 403);
}

require_once dirname(__FILE__, 5) . '/config/database.php';

$defaults = [
    'intro_titulo' => 'Escolha o combo ideal para voc&ecirc;',
    'intro_texto'  => 'Solu&ccedil;&otilde;es integradas que trabalham juntas para entregar mais seguran&ccedil;a, estabilidade e praticidade no seu dia a dia.',

    'res_titulo' => 'Combos Residenciais',
    'res_texto'  => 'Para sua casa funcionar de verdade.',
    'res_cards'  => [
        ['badge' => 'Mais vendido', 'titulo' => 'Internet + C&acirc;meras', 'texto' => 'Mais tranquilidade e controle da sua casa direto pelo celular.', 'imagem' => 'imgInternetMaisCamera.png', 'bullets' => ['Internet est&aacute;vel', 'C&acirc;meras de alta qualidade', 'Acesso remoto pelo app', 'Grava&ccedil;&atilde;o em nuvem opcional']],
        ['badge' => '', 'titulo' => 'Internet + Wi-Fi Mesh', 'texto' => 'Cobertura total e conex&atilde;o forte em todos os ambientes.', 'imagem' => 'imgInternetMaisWifiMEsh.png', 'bullets' => ['Internet de alta performance', 'Wi-Fi em todos os c&ocirc;modos', 'Sem pontos de sombra', 'Mais estabilidade para todos']],
    ],

    'biz_titulo' => 'Combos Empresariais',
    'biz_texto'  => 'Para sua empresa n&atilde;o parar.',
    'biz_cards'  => [
        ['titulo' => 'Internet + Wi-Fi Pro', 'texto' => 'Alta performance para equipes conectadas e produtivas.', 'imagem' => 'imgInternetMaisWifiPro.png', 'bullets' => ['Internet dedicada e est&aacute;vel', 'C&acirc;meras de acompanhamento', 'Mais desempenho para sua equipe', 'Ideal para m&uacute;ltiplos dispositivos']],
        ['titulo' => 'Internet + Telefonia', 'texto' => 'Atendimento profissional e economia para o seu neg&oacute;cio.', 'imagem' => 'imgInternetMaisTelefonia.png', 'bullets' => ['Internet de alta performance', 'Telefonia fixa com liga&ccedil;&otilde;es ilimitadas', 'Mais profissionalismo para sua empresa', 'Recursos avan&ccedil;ados']],
        ['titulo' => 'Internet + Link Dedicado', 'texto' => 'M&aacute;xima estabilidade para opera&ccedil;&otilde;es cr&iacute;ticas e sem interrup&ccedil;&otilde;es.', 'imagem' => 'imgInternetMaisLinkDireto.png', 'bullets' => ['Link dedicado 100% sim&eacute;trico', 'Alta disponibilidade', 'Ideal para sistemas e servidores', 'IP fixo incluso']],
    ],

    'conn_titulo' => 'Combos de Conectividade',
    'conn_texto'  => 'Conectado dentro e fora da sua casa ou empresa.',
    'conn_card'   => ['titulo' => 'Internet + Mobile', 'texto' => 'Sua conex&atilde;o vai com voc&ecirc; para onde for.', 'imagem' => 'imgInternetMaisMobile.png', 'bullets' => ['Internet fixa em casa ou empresa', 'Plano mobile com cobertura nacional', 'Mais dados e liberdade', 'Gest&atilde;o tudo em um s&oacute; lugar']],
    'custom_titulo' => 'Monte o combo ideal para voc&ecirc;!',
    'custom_texto'  => 'Fale com um consultor e descubra a melhor solu&ccedil;&atilde;o.',

    'trust_google' => '5.0 ★★★★★ + de 3.000 avalia&ccedil;&otilde;es no Google',
    'trust_items'  => ['+ de 3.000 clientes satisfeitos', 'Atendimento local de verdade', 'Suporte r&aacute;pido e especializado'],
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'combo_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['intro_titulo', 'intro_texto', 'res_titulo', 'res_texto', 'biz_titulo', 'biz_texto',
                        'conn_titulo', 'conn_texto', 'custom_titulo', 'custom_texto', 'trust_google'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            if (!empty($db['trust_items']) && is_array($db['trust_items'])) $defaults['trust_items'] = $db['trust_items'];
            foreach (['res_cards', 'biz_cards'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($defaults[$arr][$i]) || !is_array($item)) continue;
                        foreach (['badge', 'titulo', 'texto', 'imagem'] as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $defaults[$arr][$i][$k] = $item[$k];
                        }
                        if (!empty($item['bullets']) && is_array($item['bullets'])) $defaults[$arr][$i]['bullets'] = $item['bullets'];
                    }
                }
            }
            if (!empty($db['conn_card']) && is_array($db['conn_card'])) {
                foreach (['titulo', 'texto', 'imagem'] as $k) {
                    if (isset($db['conn_card'][$k]) && strlen((string) $db['conn_card'][$k])) $defaults['conn_card'][$k] = $db['conn_card'][$k];
                }
                if (!empty($db['conn_card']['bullets']) && is_array($db['conn_card']['bullets'])) $defaults['conn_card']['bullets'] = $db['conn_card']['bullets'];
            }
        }
    }
} catch (Throwable $e) {}

$decode_entities_cb = function ($value) use (&$decode_entities_cb) {
    if (is_array($value)) return array_map($decode_entities_cb, $value);
    if (is_string($value)) return html_entity_decode($value, ENT_QUOTES, 'UTF-8');
    return $value;
};

json_response(['ok' => true, 'content' => $decode_entities_cb($defaults)]);
