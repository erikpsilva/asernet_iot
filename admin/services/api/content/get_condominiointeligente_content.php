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
    'complete_titulo'  => 'Uma solu&ccedil;&atilde;o completa e integrada',
    'complete_texto'   => 'Tecnologias que se conectam para oferecer mais seguran&ccedil;a, efici&ecirc;ncia e comodidade para s&iacute;ndicos, moradores, visitantes e prestadores de servi&ccedil;o.',
    'complete_items' => [
        ['titulo' => 'C&acirc;meras de seguran&ccedil;a', 'texto' => 'Monitoramento 24h com acesso remoto e grava&ccedil;&atilde;o em nuvem.'],
        ['titulo' => 'Controle de acesso', 'texto' => 'Reconhecimento facial, biometria, tags e QR Code para moradores e visitantes.'],
        ['titulo' => 'Wi-Fi para &aacute;reas comuns', 'texto' => 'Internet r&aacute;pida e est&aacute;vel para &aacute;reas comuns e ambientes do condom&iacute;nio.'],
        ['titulo' => 'Internet dedicada', 'texto' => 'Conex&atilde;o de alta performance para todos os sistemas do condom&iacute;nio.'],
        ['titulo' => 'Aplicativo do condom&iacute;nio', 'texto' => 'Acesso a reservas, avisos, ocorr&ecirc;ncias, visitantes e muito mais.'],
        ['titulo' => 'Gest&atilde;o inteligente', 'texto' => 'Relat&oacute;rios, hist&oacute;ricos e informa&ccedil;&otilde;es na palma da m&atilde;o.'],
    ],

    'benefits_titulo' => 'Benef&iacute;cios para todos',
    'benefits_items' => [
        ['titulo' => 'Mais seguran&ccedil;a', 'texto' => 'Tecnologia integrada para monitorar acessos, &aacute;reas comuns e visitantes.', 'imagem' => 'imgMaisSeguraca.png'],
        ['titulo' => 'Mais comodidade', 'texto' => 'Moradores com acesso facilitado e servi&ccedil;os na palma da m&atilde;o.', 'imagem' => 'imgMaisComodidade.png'],
        ['titulo' => 'Mais gest&atilde;o e controle', 'texto' => 'S&iacute;ndico com relat&oacute;rios hist&oacute;ricos e gest&atilde;o centralizada.', 'imagem' => 'imgMaisGestaoControle.png'],
        ['titulo' => 'Valoriza&ccedil;&atilde;o do patrim&ocirc;nio', 'texto' => 'Mais tecnologia e estrutura aumentam o valor do seu condom&iacute;nio.', 'imagem' => 'imgValorizacaoDoPadtrimonio.png'],
    ],

    'integrations_titulo' => 'Solu&ccedil;&otilde;es integradas',
    'integrations_items' => [
        ['label' => 'C&acirc;meras de seguran&ccedil;a'], ['label' => 'Controle de acesso'], ['label' => 'Wi-Fi profissional'],
        ['label' => 'Internet dedicada'], ['label' => 'Aplicativo'], ['label' => 'Condom&iacute;nio inteligente'],
    ],

    'steps_titulo' => 'Como funciona na pr&aacute;tica',
    'steps_items' => [
        ['titulo' => 'Tecnologia instalada', 'texto' => 'Instalamos todos os equipamentos e integramos as solu&ccedil;&otilde;es.'],
        ['titulo' => 'Dados na nuvem', 'texto' => 'Informa&ccedil;&otilde;es armazenadas com seguran&ccedil;a e alta disponibilidade.'],
        ['titulo' => 'Acesso remoto', 'texto' => 'Gest&atilde;o e monitoramento de qualquer lugar, pelo aplicativo ou web.'],
        ['titulo' => 'Mais tranquilidade', 'texto' => 'Mais seguran&ccedil;a, agilidade e qualidade de vida para todos.'],
    ],

    'cta_titulo'          => 'O futuro do seu condom&iacute;nio',
    'cta_titulo_destaque' => 'come&ccedil;a agora.',
    'cta_texto'           => 'Fale com nossa equipe e descubra como podemos transformar seu condom&iacute;nio com tecnologia e seguran&ccedil;a.',
    'cta_btn1_texto'      => '0800 222 5262',
    'cta_btn2_texto'      => 'Solicitar apresenta&ccedil;&atilde;o',
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'condominiointeligente_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['complete_titulo', 'complete_texto', 'benefits_titulo', 'integrations_titulo', 'steps_titulo',
                        'cta_titulo', 'cta_titulo_destaque', 'cta_texto', 'cta_btn1_texto', 'cta_btn2_texto'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            if (!empty($db['integrations_items']) && is_array($db['integrations_items'])) {
                foreach ($db['integrations_items'] as $i => $item) {
                    if (!isset($defaults['integrations_items'][$i]) || !is_array($item)) continue;
                    if (isset($item['label']) && strlen((string) $item['label'])) $defaults['integrations_items'][$i]['label'] = $item['label'];
                }
            }
            foreach (['complete_items', 'steps_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($defaults[$arr][$i]) || !is_array($item)) continue;
                        foreach (array_keys($defaults[$arr][$i]) as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $defaults[$arr][$i][$k] = $item[$k];
                        }
                    }
                }
            }
            if (!empty($db['benefits_items']) && is_array($db['benefits_items'])) {
                foreach ($db['benefits_items'] as $i => $item) {
                    if (!isset($defaults['benefits_items'][$i]) || !is_array($item)) continue;
                    foreach (array_keys($defaults['benefits_items'][$i]) as $k) {
                        if (isset($item[$k]) && strlen((string) $item[$k])) $defaults['benefits_items'][$i][$k] = $item[$k];
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

$decode_entities_ci = function ($value) use (&$decode_entities_ci) {
    if (is_array($value)) return array_map($decode_entities_ci, $value);
    if (is_string($value)) return html_entity_decode($value, ENT_QUOTES, 'UTF-8');
    return $value;
};

json_response(['ok' => true, 'content' => $decode_entities_ci($defaults)]);
