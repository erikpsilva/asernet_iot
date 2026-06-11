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
    'history_label' => 'Nossa hist&oacute;ria',
    'history_titulo' => 'Crescendo junto com a nossa regi&atilde;o.',
    'history_textos' => [
        'A AserNet evoluiu com um prop&oacute;sito simples: entregar uma conex&atilde;o est&aacute;vel, humana e preparada para acompanhar a rotina das pessoas e empresas.',
        'Hoje, al&eacute;m da internet, oferecemos solu&ccedil;&otilde;es completas em conectividade, seguran&ccedil;a, mobilidade e tecnologia.',
    ],
    'history_imagem' => 'imgCrescendoJuntoComNossaRegiao.png',

    'belief_label' => 'O que acreditamos',
    'belief_titulo' => 'Tecnologia precisa facilitar a vida.',
    'belief_texto' => 'Por isso buscamos unir:',
    'belief_cards' => [
        ['titulo' => 'Estabilidade', 'texto' => 'Conex&otilde;es que n&atilde;o te deixam na m&atilde;o.'],
        ['titulo' => 'Atendimento pr&oacute;ximo', 'texto' => 'Estamos perto para resolver de verdade.'],
        ['titulo' => 'Solu&ccedil;&otilde;es inteligentes', 'texto' => 'Tecnologia que se adapta &agrave; sua necessidade.'],
        ['titulo' => 'Suporte humanizado', 'texto' => 'Pessoas que entendem e que se importam.'],
    ],

    'solutions_label' => 'O que fazemos',
    'solutions_titulo' => 'Solu&ccedil;&otilde;es completas para sua casa e empresa.',
    'solutions_cards' => [
        ['titulo' => 'Internet residencial', 'texto' => 'Conectividade preparada para o dia a dia da fam&iacute;lia.', 'imagem' => 'imgInternetResidencial.png'],
        ['titulo' => 'Solu&ccedil;&otilde;es empresariais', 'texto' => 'Estrutura profissional para empresas crescerem.', 'imagem' => 'imgSolucoesEmpresariais.png'],
        ['titulo' => 'Seguran&ccedil;a e monitoramento', 'texto' => 'Mais tranquilidade para sua rotina.', 'imagem' => 'imgSegurancaMonitoramento.png'],
        ['titulo' => 'Mobilidade e conectividade', 'texto' => 'Internet dentro e fora de casa.', 'imagem' => 'imgMobilidadeConectividade.png'],
    ],

    'trust_google' => '5.0 no Google + de 3.000 avalia&ccedil;&otilde;es',
    'trust_items' => ['Milhares de clientes conectados', 'Atendimento pr&oacute;ximo', 'Confian&ccedil;a constru&iacute;da diariamente'],

    'diff_label' => 'Nosso diferencial',
    'diff_titulo' => 'O que faz a AserNet ser diferente?',
    'diff_cards' => [
        ['titulo' => 'Atendimento de verdade', 'texto' => 'Pessoas preparadas para ajudar voc&ecirc;.'],
        ['titulo' => 'Estrutura profissional', 'texto' => 'Tecnologia preparada para crescer junto com sua necessidade.'],
        ['titulo' => 'Solu&ccedil;&otilde;es integradas', 'texto' => 'Internet, Wi-Fi, telefonia, seguran&ccedil;a e mobilidade conectados.'],
        ['titulo' => 'Presen&ccedil;a local', 'texto' => 'Estamos pr&oacute;ximos dos nossos clientes e da nossa comunidade.'],
    ],

    'team_label' => 'Nosso time e estrutura',
    'team_titulo' => 'Pessoas que conectam. Estrutura que entrega.',
    'team_images' => ['imgpessoasConectam01.png', 'imgpessoasConectam02.png', 'imgpessoasConectam03.png.png', 'imgpessoasConectam04.png.png', 'imgAquiVoceNaoContrataSoInternet.png'],

    'purpose_label' => 'Nosso prop&oacute;sito',
    'purpose_titulo' => 'Conectar bem &eacute; cuidar.',
    'purpose_texto' => 'Acreditamos que tecnologia tamb&eacute;m &eacute; presen&ccedil;a, suporte e confian&ccedil;a. &Eacute; estar junto sempre que voc&ecirc; precisar.',
    'purpose_items' => ['Conex&atilde;o', 'Confian&ccedil;a', 'Presen&ccedil;a', 'Cuidado'],
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'sobreasernet_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['history_label', 'history_titulo', 'history_imagem', 'belief_label', 'belief_titulo', 'belief_texto',
                        'solutions_label', 'solutions_titulo', 'trust_google', 'diff_label', 'diff_titulo',
                        'team_label', 'team_titulo', 'purpose_label', 'purpose_titulo', 'purpose_texto'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            foreach (['history_textos', 'trust_items', 'team_images', 'purpose_items'] as $k) {
                if (!empty($db[$k]) && is_array($db[$k])) $defaults[$k] = $db[$k];
            }
            foreach (['belief_cards', 'solutions_cards', 'diff_cards'] as $arr) {
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

$decode_entities_sa = function ($value) use (&$decode_entities_sa) {
    if (is_array($value)) return array_map($decode_entities_sa, $value);
    if (is_string($value)) return html_entity_decode($value, ENT_QUOTES, 'UTF-8');
    return $value;
};

json_response(['ok' => true, 'content' => $decode_entities_sa($defaults)]);
