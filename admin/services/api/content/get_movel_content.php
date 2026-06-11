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
    'rotina_titulo' => 'Sua conexão não pode parar quando você sai de casa.',
    'rotina_items'  => ['Redes sociais e mensagens', 'Vídeos e streaming', 'Trabalho e reuniões', 'GPS e aplicativos', 'Games e muito mais'],

    'planos_titulo'        => 'Escolha o plano ideal para você',
    'planos_portabilidade' => 'Mantenha seu número com a portabilidade.',
    'planos' => [
        ['nome' => '20 GB', 'subtitulo' => '15GB + 5GB bônus portabilidade', 'preco' => '39,90',
         'bullets' => ['Minutos ilimitados para qualquer operadora', 'WhatsApp ilimitado', 'SMS ilimitado', 'Cobertura nacional'],
         'featured' => false],
        ['nome' => '25 GB', 'subtitulo' => '20GB + 5GB bônus portabilidade', 'preco' => '59,90',
         'bullets' => ['Minutos ilimitados para qualquer operadora', 'WhatsApp ilimitado', 'SMS ilimitado', 'Cobertura nacional'],
         'featured' => true],
        ['nome' => '30 GB', 'subtitulo' => '25GB + 5GB bônus portabilidade', 'preco' => '69,90',
         'bullets' => ['Minutos ilimitados para qualquer operadora', 'WhatsApp ilimitado', 'SMS ilimitado', 'Cobertura nacional'],
         'featured' => false],
    ],

    'beneficios_titulo' => 'Benefícios',
    'beneficios' => [
        ['titulo' => 'Cobertura nacional',         'texto' => 'Internet móvel onde você estiver.'],
        ['titulo' => 'Portabilidade simples',       'texto' => 'Mantenha seu número atual.'],
        ['titulo' => 'Atendimento local',           'texto' => 'Suporte próximo e sem enrolação.'],
        ['titulo' => 'Integração com sua AserNet',  'texto' => 'Conectividade dentro e fora de casa.'],
    ],

    'como_titulo' => 'Simples e rápido. Veja como funciona:',
    'como_steps'  => [
        ['titulo' => 'Escolha o plano',   'texto' => 'ideal para você.'],
        ['titulo' => 'Solicite o chip',   'texto' => 'e receba onde estiver.'],
        ['titulo' => 'Fazemos a ativação','texto' => 'de forma rápida.'],
        ['titulo' => 'Você continua',     'texto' => 'conectado!'],
    ],

    'eco_titulo'   => 'Mais que um plano móvel. Parte do ecossistema AserNet para manter você conectado sempre.',
    'eco_resultado'=> 'Conexão completa para sua vida.',
    'eco_items'    => [
        ['texto' => 'Internet residencial', 'imagem' => 'imgInternetResidencial.png'],
        ['texto' => 'Câmeras de segurança', 'imagem' => 'imgCameraDeSeguranca.png'],
        ['texto' => 'Aser Mobile',          'imagem' => 'imgAserMobile.png'],
    ],

    'trust_google' => '+ de 3.000 avaliações no Google',
    'trust_item1'  => 'Atendimento local de verdade',
    'trust_item2'  => 'Clientes satisfeitos',
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'movel_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['rotina_titulo', 'planos_titulo', 'planos_portabilidade',
                        'beneficios_titulo', 'como_titulo', 'eco_titulo', 'eco_resultado',
                        'trust_google', 'trust_item1', 'trust_item2'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            if (!empty($db['rotina_items']) && is_array($db['rotina_items'])) {
                $defaults['rotina_items'] = $db['rotina_items'];
            }
            if (!empty($db['planos']) && is_array($db['planos'])) {
                foreach ($db['planos'] as $i => $p) {
                    if (!isset($defaults['planos'][$i]) || !is_array($p)) continue;
                    foreach (['nome', 'subtitulo', 'preco'] as $k) {
                        if (isset($p[$k]) && strlen((string) $p[$k])) $defaults['planos'][$i][$k] = $p[$k];
                    }
                    if (!empty($p['bullets']) && is_array($p['bullets'])) $defaults['planos'][$i]['bullets'] = $p['bullets'];
                    if (isset($p['featured'])) $defaults['planos'][$i]['featured'] = (bool) $p['featured'];
                }
            }
            foreach (['beneficios', 'como_steps', 'eco_items'] as $arr) {
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
