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
    'shared_titulo'             => 'Seguran&ccedil;a compartilhada.',
    'shared_titulo_complemento' => 'Tranquilidade para todos.',
    'shared_texto1' => 'O Bairro Seguro &eacute; uma solu&ccedil;&atilde;o colaborativa que utiliza c&acirc;meras estrategicamente posicionadas para aumentar a seguran&ccedil;a de ruas, bairros e comunidades.',
    'shared_texto2' => 'As imagens ficam dispon&iacute;veis aos respons&aacute;veis autorizados, permitindo maior controle, monitoramento dos acessos e apoio na identifica&ccedil;&atilde;o de ocorr&ecirc;ncias.',
    'shared_texto3' => 'Quando a tecnologia trabalha em conjunto com a comunidade, todos ganham mais tranquilidade.',
    'shared_imagem' => 'imgSegurancaCompartilhada.png',

    'steps_titulo' => 'Como funciona',
    'steps_items' => [
        ['titulo' => 'Instala&ccedil;&atilde;o das c&acirc;meras', 'texto' => 'C&acirc;meras posicionadas em pontos estrat&eacute;gicos.', 'imagem' => 'imgInstalacaodeCameras.png'],
        ['titulo' => 'Grava&ccedil;&atilde;o em nuvem', 'texto' => 'Imagens armazenadas de forma segura e confi&aacute;vel.', 'imagem' => 'imgGravacaoEmNuvem.png'],
        ['titulo' => 'Acesso remoto', 'texto' => 'Consulta das imagens por aplicativo, de onde voc&ecirc; estiver.', 'imagem' => 'imgAcessoRemoto.png'],
        ['titulo' => 'Mais seguran&ccedil;a', 'texto' => 'Maior controle, preven&ccedil;&atilde;o e sensa&ccedil;&atilde;o de prote&ccedil;&atilde;o para todos.', 'imagem' => 'imgMaisSeguranca.png'],
    ],

    'audiences_titulo' => 'Ideal para',
    'audiences_items' => [
        ['label' => 'Bairros residenciais'], ['label' => 'Associa&ccedil;&otilde;es de moradores'], ['label' => 'Condom&iacute;nios'],
        ['label' => 'Distritos industriais'], ['label' => 'Loteamentos'], ['label' => '&Aacute;reas rurais'],
    ],

    'included_titulo' => 'O que est&aacute; incluso',
    'included_items'  => ['Projeto e implanta&ccedil;&atilde;o personalizada', 'C&acirc;meras de seguran&ccedil;a de alta qualidade', 'Infraestrutura de rede dedicada', 'Grava&ccedil;&atilde;o em nuvem com alta disponibilidade', 'Manuten&ccedil;&atilde;o preventiva', 'Suporte especializado', 'Aplicativo de acesso remoto'],
    'included_imagem' => 'imgOqueEstaIncluso.png',

    'advantages_titulo' => 'Vantagens para a comunidade',
    'advantages_items' => [
        ['titulo' => 'Mais seguran&ccedil;a', 'texto' => 'Maior controle dos acessos e preven&ccedil;&atilde;o de ocorr&ecirc;ncias.'],
        ['titulo' => 'Compartilhamento de custos', 'texto' => 'Investimento dividido entre os participantes.'],
        ['titulo' => 'Monitoramento remoto', 'texto' => 'Acesse as imagens de qualquer lugar, a qualquer momento.'],
        ['titulo' => 'Tecnologia profissional', 'texto' => 'Solu&ccedil;&atilde;o completa gerenciada pela AserNet IoT Services.'],
    ],

    'faq_titulo' => 'Perguntas frequentes',
    'faq_items' => [
        ['pergunta' => 'Quem pode acessar as imagens?', 'resposta' => 'O acesso &eacute; definido pelo projeto e liberado somente aos respons&aacute;veis autorizados pela comunidade.'],
        ['pergunta' => '&Eacute; necess&aacute;rio internet no local?', 'resposta' => 'Sim. A conectividade garante o envio seguro das imagens para a nuvem e o acesso remoto.'],
        ['pergunta' => 'Preciso comprar equipamentos?', 'resposta' => 'A composi&ccedil;&atilde;o dos equipamentos &eacute; definida na apresenta&ccedil;&atilde;o personalizada, conforme a necessidade do local.'],
        ['pergunta' => 'A solu&ccedil;&atilde;o funciona em condom&iacute;nios?', 'resposta' => 'Sim. O projeto atende condom&iacute;nios, bairros, associa&ccedil;&otilde;es, loteamentos, &aacute;reas rurais e distritos industriais.'],
    ],

    'cta_titulo'             => 'Vamos tornar',
    'cta_titulo_complemento' => 'seu bairro mais seguro?',
    'cta_texto'              => 'Nossa equipe est&aacute; pronta para apresentar um projeto personalizado para sua comunidade.',
    'cta_btn1_texto'         => '0800 222 5262',
    'cta_btn2_texto'         => 'Solicitar apresenta&ccedil;&atilde;o',
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'bairroseguro_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['shared_titulo', 'shared_titulo_complemento', 'shared_texto1', 'shared_texto2', 'shared_texto3', 'shared_imagem',
                        'steps_titulo', 'audiences_titulo', 'included_titulo', 'included_imagem',
                        'advantages_titulo', 'faq_titulo',
                        'cta_titulo', 'cta_titulo_complemento', 'cta_texto', 'cta_btn1_texto', 'cta_btn2_texto'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            if (!empty($db['included_items']) && is_array($db['included_items'])) {
                $items = array_values(array_filter(array_map(function ($v) { return trim((string) $v); }, $db['included_items']), function ($v) { return $v !== ''; }));
                if (!empty($items)) $defaults['included_items'] = $items;
            }
            foreach (['audiences_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($defaults[$arr][$i]) || !is_array($item)) continue;
                        if (isset($item['label']) && strlen((string) $item['label'])) $defaults[$arr][$i]['label'] = $item['label'];
                    }
                }
            }
            foreach (['advantages_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($defaults[$arr][$i]) || !is_array($item)) continue;
                        foreach (array_keys($defaults[$arr][$i]) as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $defaults[$arr][$i][$k] = $item[$k];
                        }
                    }
                }
            }
            if (!empty($db['steps_items']) && is_array($db['steps_items'])) {
                foreach ($db['steps_items'] as $i => $item) {
                    if (!isset($defaults['steps_items'][$i]) || !is_array($item)) continue;
                    foreach (array_keys($defaults['steps_items'][$i]) as $k) {
                        if (isset($item[$k]) && strlen((string) $item[$k])) $defaults['steps_items'][$i][$k] = $item[$k];
                    }
                }
            }
            if (!empty($db['faq_items']) && is_array($db['faq_items'])) {
                foreach ($db['faq_items'] as $i => $item) {
                    if (!isset($defaults['faq_items'][$i]) || !is_array($item)) continue;
                    foreach (array_keys($defaults['faq_items'][$i]) as $k) {
                        if (isset($item[$k]) && strlen((string) $item[$k])) $defaults['faq_items'][$i][$k] = $item[$k];
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

$decode_entities_bs = function ($value) use (&$decode_entities_bs) {
    if (is_array($value)) return array_map($decode_entities_bs, $value);
    if (is_string($value)) return html_entity_decode($value, ENT_QUOTES, 'UTF-8');
    return $value;
};

json_response(['ok' => true, 'content' => $decode_entities_bs($defaults)]);
