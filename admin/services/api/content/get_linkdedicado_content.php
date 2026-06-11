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
    'problem_titulo' => 'Sua opera&ccedil;&atilde;o n&atilde;o pode parar.',
    'problem_texto'  => 'Quando a internet falha, sua empresa perde produtividade, atendimento e faturamento.',
    'problem_items'  => ['Sistemas indispon&iacute;veis', 'Reuni&otilde;es travando', 'Lentid&atilde;o em hor&aacute;rios cr&iacute;ticos', 'Impacto na opera&ccedil;&atilde;o'],
    'problem_imagem' => 'imgSuaOperacaoNaoPodeParar.png',

    'exclusive_titulo' => 'Conex&atilde;o exclusiva para sua empresa.',
    'exclusive_texto'  => 'No link dedicado, a banda contratada &eacute; reservada para sua opera&ccedil;&atilde;o, garantindo mais estabilidade e previsibilidade.',
    'exclusive_cards'  => [
        ['titulo' => 'Conex&atilde;o exclusiva',    'texto' => 'Banda 100% dedicada para sua empresa.'],
        ['titulo' => 'Performance constante',      'texto' => 'Mais estabilidade e menos oscila&ccedil;&otilde;es.'],
        ['titulo' => 'Melhor estabilidade',        'texto' => 'Ideal para opera&ccedil;&otilde;es cr&iacute;ticas.'],
        ['titulo' => 'Monitoramento t&eacute;cnico', 'texto' => 'Acompanhamento cont&iacute;nuo da conex&atilde;o.'],
    ],

    'aud_titulo' => 'Para quem &eacute; indicado',
    'aud_texto'  => 'Ideal para empresas que dependem de conex&atilde;o constante.',
    'aud_items'  => ['Escrit&oacute;rios', 'Empresas com m&uacute;ltiplos usu&aacute;rios', 'Opera&ccedil;&otilde;es em nuvem', 'Videomonitoramento', 'Telefonia IP', 'ERPs e sistemas online', 'Hot&eacute;is e pousadas'],

    'feat_titulo' => 'Diferenciais AserNet',
    'feat_cards'  => [
        ['titulo' => 'Banda dedicada',              'texto' => 'Mais previsibilidade e estabilidade para sua opera&ccedil;&atilde;o.'],
        ['titulo' => 'Monitoramento cont&iacute;nuo', 'texto' => 'Acompanhamento 24/7 para garantir o melhor desempenho.'],
        ['titulo' => 'Suporte priorit&aacute;rio',    'texto' => 'Atendimento r&aacute;pido e especializado para reduzir o impacto operacional.'],
        ['titulo' => 'Projeto sob medida',          'texto' => 'Solu&ccedil;&otilde;es personalizadas conforme a necessidade da sua empresa.'],
    ],

    'integration_titulo' => 'Mais que conectividade. Integra&ccedil;&atilde;o que gera resultado.',
    'integration_texto'  => 'O link dedicado pode ser integrado com outras solu&ccedil;&otilde;es AserNet para potencializar seu neg&oacute;cio.',
    'integration_cards'  => [
        ['titulo' => 'Wi-Fi Profissional',       'texto' => 'Rede est&aacute;vel para todos os ambientes da empresa.', 'imagem' => 'imgWifiProfissional.png'],
        ['titulo' => 'Telefonia Empresarial',    'texto' => 'Mais comunica&ccedil;&atilde;o, mais produtividade.',         'imagem' => 'imgTelefoniaEmpresarial.png'],
        ['titulo' => 'C&acirc;meras de Seguran&ccedil;a', 'texto' => 'Monitoramento inteligente 24 horas por dia.',          'imagem' => 'imgCamerasDeSeguranca.png'],
        ['titulo' => 'Infraestrutura',           'texto' => 'Solu&ccedil;&otilde;es completas para sua empresa crescer.',  'imagem' => 'imgInfraestrutura.png'],
    ],

    'benefits_titulo' => 'Benef&iacute;cios para sua empresa',
    'benefit_cards'   => [
        ['titulo' => 'Mais estabilidade',    'texto' => 'Conex&atilde;o preparada para opera&ccedil;&otilde;es cr&iacute;ticas.'],
        ['titulo' => 'Melhor desempenho',    'texto' => 'Menos oscila&ccedil;&atilde;o, mais previsibilidade.'],
        ['titulo' => 'Mais seguran&ccedil;a',  'texto' => 'Infraestrutura profissional para proteger sua opera&ccedil;&atilde;o.'],
        ['titulo' => 'Escal&aacute;vel',       'texto' => 'Projetos personalizados conforme o crescimento da sua empresa.'],
    ],

    'trust_google' => '5,0 + de 3.000 avalia&ccedil;&otilde;es no Google',
    'trust_items'  => ['Atendimento local de verdade', 'Suporte t&eacute;cnico especializado', 'Instala&ccedil;&atilde;o profissional e acompanhamento'],
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'linkdedicado_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['problem_titulo', 'problem_texto', 'problem_imagem',
                        'exclusive_titulo', 'exclusive_texto',
                        'aud_titulo', 'aud_texto',
                        'feat_titulo',
                        'integration_titulo', 'integration_texto',
                        'benefits_titulo', 'trust_google'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            foreach (['problem_items', 'aud_items', 'trust_items'] as $k) {
                if (!empty($db[$k]) && is_array($db[$k])) $defaults[$k] = $db[$k];
            }
            foreach (['exclusive_cards', 'feat_cards', 'integration_cards', 'benefit_cards'] as $arr) {
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

$decode_entities_ld = function ($value) use (&$decode_entities_ld) {
    if (is_array($value)) {
        return array_map($decode_entities_ld, $value);
    }
    if (is_string($value)) {
        return html_entity_decode($value, ENT_QUOTES, 'UTF-8');
    }
    return $value;
};

json_response(['ok' => true, 'content' => $decode_entities_ld($defaults)]);
