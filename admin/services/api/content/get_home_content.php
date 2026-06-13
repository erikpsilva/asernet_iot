<?php
declare(strict_types=1);

require_once dirname(__FILE__, 3) . '/_session.php';

require_once dirname(__FILE__, 3) . '/response.php';

if (empty($_SESSION['usuario'])) {
    json_response(['ok' => false, 'message' => 'Não autorizado.'], 401);
}
if (!in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor', 'leitor'])) {
    json_response(['ok' => false, 'message' => 'Permissão negada.'], 403);
}

require_once dirname(__FILE__, 5) . '/config/database.php';

$defaults = [
    'intro_titulo'    => 'Uma empresa. Diversas soluções conectadas.',
    'intro_subtitulo' => 'A AserNet integra internet, mobilidade, segurança e conectividade para simplificar sua rotina e melhorar sua experiência.',
    'cards_casa' => [
        ['titulo' => 'Internet Residencial', 'descricao' => '1 Giga com estabilidade e cobertura inteligente.', 'imagem' => 'imgInternetResidencial.png', 'link_texto' => 'Ver planos', 'link_href' => '/residencial'],
        ['titulo' => 'Wi-Fi Mesh', 'descricao' => 'Cobertura inteligente para toda a casa.', 'imagem' => 'imgWifiMesh.png', 'link_texto' => 'Conhecer solução', 'link_href' => '/solucoes'],
        ['titulo' => 'Câmeras de Segurança', 'descricao' => 'Monitoramento em tempo real pelo celular.', 'imagem' => 'imgCameraDeSeguranca.png', 'link_texto' => 'Ver solução', 'link_href' => '/solucoes'],
        ['titulo' => 'Aser Mobile', 'descricao' => 'Conectividade dentro e fora de casa.', 'imagem' => 'imgAserMobile.png', 'link_texto' => 'Ver planos', 'link_href' => '/residencial'],
    ],
    'cards_empresa' => [
        ['titulo' => 'Internet PME', 'descricao' => 'Conectividade estável para empresas.', 'imagem' => 'imgInternetPME.png', 'link_texto' => 'Ver soluções', 'link_href' => '/empresas'],
        ['titulo' => 'Wi-Fi Profissional', 'descricao' => 'Rede preparada para múltiplos dispositivos.', 'imagem' => 'imgWifiProfissional.png', 'link_texto' => 'Ver solução', 'link_href' => '/solucoes'],
        ['titulo' => 'Telefonia Empresarial', 'descricao' => 'Mais comunicação e produtividade.', 'imagem' => 'imgTelefoniaEmpresarial.png', 'link_texto' => 'Ver solução', 'link_href' => '/solucoes'],
        ['titulo' => 'Link Dedicado', 'descricao' => 'Conexão exclusiva para operações críticas.', 'imagem' => 'imgLinkDEdicado.png', 'link_texto' => 'Ver solução', 'link_href' => '/solucoes'],
    ],
    'cards_seguranca' => [
        ['titulo' => 'Rastreamento Veicular', 'descricao' => 'Acompanhe seu veículo em tempo real pelo celular.', 'imagem' => 'imgRastreamentoVeicular.png', 'link_texto' => 'Ver solução', 'link_href' => '/solucoes'],
        ['titulo' => 'Tag Localizadora', 'descricao' => 'Mais praticidade e segurança para o que importa.', 'imagem' => 'imgTagLocalizadora.png', 'link_texto' => 'Ver solução', 'link_href' => '/solucoes'],
    ],
];

try {
    $pdo  = getDbConnection();
    $row  = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'home_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            if (!empty($db['intro_titulo']))    $defaults['intro_titulo']    = $db['intro_titulo'];
            if (!empty($db['intro_subtitulo'])) $defaults['intro_subtitulo'] = $db['intro_subtitulo'];
            foreach (['cards_casa', 'cards_empresa', 'cards_seguranca'] as $k) {
                if (!empty($db[$k]) && is_array($db[$k])) {
                    foreach ($db[$k] as $i => $c) {
                        if (isset($defaults[$k][$i]) && is_array($c)) {
                            $defaults[$k][$i] = array_merge($defaults[$k][$i], array_filter($c, 'strlen'));
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

json_response(['ok' => true, 'content' => $defaults]);
