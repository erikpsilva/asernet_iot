<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) session_start();

require_once dirname(__FILE__, 3) . '/response.php';

if (empty($_SESSION['usuario'])) {
    json_response(['ok' => false, 'message' => 'Não autorizado.'], 401);
}
if (!in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor'])) {
    json_response(['ok' => false, 'message' => 'Permissão negada.'], 403);
}

require_once dirname(__FILE__, 5) . '/config/database.php';

$defaults = [
    'prob_titulo' => 'Sua empresa depende de tecnologia o tempo todo.',
    'prob_texto'  => 'Quando a estrutura não acompanha a operação, os problemas aparecem.',
    'prob_items'  => ['Internet instável', 'Wi-Fi congestionado', 'Atendimento falhando', 'Sistemas lentos', 'Impacto na produtividade'],

    'int_titulo'  => 'Soluções integradas para empresas modernas.',
    'int_texto'   => 'A AserNet conecta internet, Wi-Fi, telefonia e infraestrutura para entregar mais estabilidade e eficiência para sua operação.',
    'int_bullets' => ['Projetos personalizados', 'Estrutura escalável', 'Atendimento especializado', 'Suporte local'],

    'sol_titulo' => 'Soluções empresariais',
    'sol_cards'  => [
        ['titulo' => 'Internet PME',              'texto' => 'Internet estável para empresas que precisam de produtividade.',                 'imagem' => 'imgInternetPME.png'],
        ['titulo' => 'Wi-Fi Profissional',         'texto' => 'Rede preparada para múltiplos dispositivos e ambientes corporativos.',        'imagem' => 'imgWifiProfissional.png'],
        ['titulo' => 'Telefonia Empresarial',      'texto' => 'Mais comunicação e profissionalismo para seu atendimento.',                   'imagem' => 'imgTelefoniaEmpresarial.png'],
        ['titulo' => 'Link Dedicado',              'texto' => 'Conexão exclusiva para operações críticas.',                                  'imagem' => 'imgLinkDedicado.png'],
        ['titulo' => 'Segurança e Monitoramento',  'texto' => 'Mais controle para sua empresa.',                                            'imagem' => 'imgSegurancaMonitoramento.png'],
    ],

    'why_titulo' => 'Por que escolher a AserNet?',
    'why_items'  => [
        ['titulo' => 'Atendimento próximo',   'texto' => 'Equipe local preparada para atender sua empresa com agilidade.'],
        ['titulo' => 'Projetos sob medida',   'texto' => 'Soluções adaptadas à necessidade da sua operação.'],
        ['titulo' => 'Estrutura profissional', 'texto' => 'Mais estabilidade, desempenho e segurança para sua empresa.'],
        ['titulo' => 'Ecossistema integrado',  'texto' => 'Internet, comunicação e segurança trabalhando juntos.'],
    ],

    'aud_titulo' => 'Para quem é indicado',
    'aud_items'  => ['Escritórios', 'Hotéis e pousadas', 'Clínicas', 'Comércios', 'Escolas', 'Empresas com múltiplos usuários', 'Restaurantes'],

    'tech_titulo' => 'Tecnologia integrada para sua empresa crescer.',
    'tech_texto'  => 'Tudo conectado dentro da mesma estrutura, com gestão inteligente e suporte especializado.',

    'ben_titulo' => 'Benefícios para sua empresa',
    'ben_items'  => [
        ['titulo' => 'Mais estabilidade',    'texto' => 'Menos quedas e mais continuidade para sua operação.'],
        ['titulo' => 'Mais produtividade',   'texto' => 'Melhor desempenho da equipe e dos sistemas.'],
        ['titulo' => 'Mais profissionalismo','texto' => 'Estrutura preparada para dar mais credibilidade à sua empresa.'],
        ['titulo' => 'Mais controle',        'texto' => 'Monitoramento e gestão facilitados para tomar melhores decisões.'],
    ],

    'trust_google' => '5.0 ★★★★★ + de 3.000 avaliações no Google',
    'trust_items'  => ['Atendimento local de verdade', 'Suporte especializado', 'Instalação profissional', 'Acompanhamento contínuo'],
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'paraempresas_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['prob_titulo', 'prob_texto', 'int_titulo', 'int_texto',
                        'sol_titulo', 'why_titulo', 'aud_titulo', 'tech_titulo', 'tech_texto',
                        'ben_titulo', 'trust_google'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            foreach (['prob_items', 'int_bullets', 'aud_items', 'trust_items'] as $k) {
                if (!empty($db[$k]) && is_array($db[$k])) $defaults[$k] = $db[$k];
            }
            foreach (['sol_cards', 'why_items', 'ben_items'] as $arr) {
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

json_response(['ok' => true, 'content' => $defaults]);
