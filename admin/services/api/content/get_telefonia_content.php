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
    'pain_titulo' => 'Sua empresa ainda perde oportunidades por falhas no atendimento?',
    'pain_texto'  => 'Uma comunicação inadequada pode impactar diretamente seus resultados.',
    'pain_items'  => ['Chamadas perdidas', 'Atendimento desorganizado', 'Dificuldade de mobilidade', 'Estrutura limitada'],

    'sol_titulo' => 'Soluções que se adaptam ao seu negócio.',
    'sol_texto'  => 'Escolha a solução ideal para a comunicação da sua empresa.',
    'sol_cards'  => [
        ['titulo' => 'Linha empresarial', 'texto' => 'Ideal para empresas que precisam de comunicação estável e profissional.', 'imagem' => 'imgLinhaEmpresarial.png'],
        ['titulo' => 'Número 0800',       'texto' => 'Atendimento gratuito para seus clientes e fortalecimento da marca.',       'imagem' => ''],
        ['titulo' => 'Número 4000',       'texto' => 'Mais credibilidade e presença regional para sua empresa.',                  'imagem' => ''],
    ],

    'feat_titulo' => 'Diferenciais AserNet',
    'feat_texto'  => 'Tecnologia, suporte e soluções que fazem a diferença.',
    'feat_items'  => [
        ['titulo' => 'Flexibilidade',        'texto' => 'Estrutura adaptável para diferentes tamanhos de empresa.'],
        ['titulo' => 'Telefonia IP',          'texto' => 'Mais mobilidade, integração com sistemas e redução de custos.'],
        ['titulo' => 'Atendimento próximo',   'texto' => 'Equipe local para suporte rápido e acompanhamento da sua operação.'],
        ['titulo' => 'Projeto personalizado', 'texto' => 'Soluções sob medida conforme a necessidade do seu negócio.'],
    ],

    'res_aud_titulo' => 'Para quem é indicado',
    'res_aud_items'  => ['Escritórios', 'Comércios', 'Clínicas', 'Hotéis e pousadas', 'Atendimento comercial', 'Empresas com múltiplos setores', 'Equipes em diferentes localizações'],
    'res_imagem'     => 'imgRecursosQueGeramResultados.png',
    'res_rec_titulo' => 'Recursos que geram resultados',
    'res_rec_items'  => ['Ramais ilimitados', 'Desvio de chamadas', 'URA personalizada', 'Gravação de chamadas', 'Relatórios gerenciais', 'Aplicativo para celular'],

    'flow_titulo' => 'Integre a telefonia com outras soluções AserNet.',
    'flow_texto'  => 'Comunicação conectada com sua operação para mais eficiência e segurança.',
    'flow_items'  => ['Internet PME', 'Link Dedicado', 'Wi-Fi Profissional', 'Câmeras de Segurança', 'Estruturas corporativas'],

    'ben_titulo' => 'Benefícios que impulsionam sua empresa.',
    'ben_items'  => [
        ['titulo' => 'Mais profissionalismo', 'texto' => 'Transmita credibilidade e melhore a experiência do seu cliente.'],
        ['titulo' => 'Mais mobilidade',       'texto' => 'Atenda sua equipe de qualquer lugar com mais liberdade.'],
        ['titulo' => 'Mais produtividade',    'texto' => 'Comunicação organizada para processos mais rápidos e eficientes.'],
        ['titulo' => 'Escalável',             'texto' => 'Expanda ramais e recursos conforme o crescimento da sua empresa.'],
    ],

    'trust_google' => '5,0 + de 3.000 avaliações no Google',
    'trust_items'  => ['Atendimento local de verdade', 'Suporte técnico especializado', 'Instalação profissional e acompanhamento'],
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'telefonia_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['pain_titulo', 'pain_texto',
                        'sol_titulo', 'sol_texto',
                        'feat_titulo', 'feat_texto',
                        'res_aud_titulo', 'res_imagem', 'res_rec_titulo',
                        'flow_titulo', 'flow_texto',
                        'ben_titulo', 'trust_google'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            foreach (['pain_items', 'res_aud_items', 'res_rec_items', 'flow_items', 'trust_items'] as $k) {
                if (!empty($db[$k]) && is_array($db[$k])) $defaults[$k] = $db[$k];
            }
            foreach (['sol_cards', 'feat_items', 'ben_items'] as $arr) {
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
