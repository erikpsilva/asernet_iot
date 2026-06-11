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
    'dor_titulo'  => 'Sua internet pode ser rápida...',
    'dor_titulo2' => 'mas o Wi-Fi não chega em todos os ambientes.',
    'dor_items'   => ['Sinal fraco no quarto', 'Vídeos travando', 'Quedas em chamadas', 'Travamentos na TV', 'Pontos sem cobertura'],

    'tech_titulo'  => 'Tecnologia Mesh: uma única rede inteligente para toda a casa.',
    'tech_texto'   => 'Os equipamentos trabalham juntos para distribuir o sinal de forma inteligente, mantendo você conectado em qualquer ambiente.',
    'tech_bullets' => ['Cobertura ampliada', 'Troca automática de ponto sem desconectar', 'Mais estabilidade', 'Melhor experiência para múltiplos dispositivos'],
    'tech_imagem'  => 'imgTecnologiaMesh.png',

    'como_titulo' => 'Como funciona',
    'como_texto'  => 'Simples e eficiente',
    'como_steps'  => ['Fazemos a análise da sua casa', 'Instalamos os equipamentos', 'Configuramos a rede Mesh', 'Você aproveita cobertura total'],

    'porque_titulo' => 'Por que escolher o Wi-Fi Mesh da AserNet?',
    'porque_items'  => [
        ['titulo' => 'Cobertura inteligente',    'texto' => 'Mais alcance e estabilidade para todos os ambientes.'],
        ['titulo' => 'Uma única rede',           'texto' => 'Seu celular troca automaticamente entre os pontos, sem você perceber.'],
        ['titulo' => 'Melhor para casas maiores','texto' => 'Mais desempenho em diversos andares e ambientes.'],
        ['titulo' => 'Suporte AserNet',          'texto' => 'Instalação e configuração inclusas com suporte especializado.'],
    ],

    'ideal_titulo' => 'Ideal para quem usa muitos dispositivos',
    'ideal_items'  => ['Smart TVs', 'Streaming', 'Home Office', 'Videogames', 'Casas grandes', 'Múltiplos dispositivos'],

    'perf_titulo'   => 'Equipamentos de alta performance',
    'perf_texto'    => 'Tecnologia mesh com antenas para mais alcance, estabilidade e conexão de verdade.',
    'perf_imagem'   => 'imgEquipamentoDeAltaPerformance.png',
    'perf_bullets'  => ['Cobertura ampliada', 'Rede contínua em toda a casa', 'Mais estabilidade para sua conexão', 'Mais dispositivos conectados'],
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'wifimesh_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['dor_titulo', 'dor_titulo2', 'tech_titulo', 'tech_texto', 'tech_imagem',
                        'como_titulo', 'como_texto', 'porque_titulo', 'ideal_titulo',
                        'perf_titulo', 'perf_texto', 'perf_imagem'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            foreach (['dor_items', 'tech_bullets', 'como_steps', 'ideal_items', 'perf_bullets'] as $k) {
                if (!empty($db[$k]) && is_array($db[$k])) $defaults[$k] = $db[$k];
            }
            if (!empty($db['porque_items']) && is_array($db['porque_items'])) {
                foreach ($db['porque_items'] as $i => $item) {
                    if (isset($defaults['porque_items'][$i]) && is_array($item)) {
                        foreach (['titulo', 'texto'] as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $defaults['porque_items'][$i][$k] = $item[$k];
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

json_response(['ok' => true, 'content' => $defaults]);
