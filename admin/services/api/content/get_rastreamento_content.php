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
    'quick_items' => [
        ['titulo' => 'Monitoramento 24h',          'texto' => 'Acompanhe em tempo real pelo app ou plataforma web.'],
        ['titulo' => 'Tecnologia 4G + GPS',         'texto' => 'Mais precisão na localização e mais estabilidade.'],
        ['titulo' => 'Plataforma completa',          'texto' => 'Relatórios, históricos e alertas personalizados.'],
        ['titulo' => 'Suporte local especializado',  'texto' => 'Atendimento próximo e rápido quando precisar.'],
    ],

    'cat_titulo'    => 'Muito mais que rastreamento tradicional.',
    'cat_subtitulo' => 'Além de carros, motos e caminhões, nossos rastreadores atendem várias necessidades do seu dia a dia.',
    'cat_cards' => [
        ['titulo' => 'Carros',               'texto' => 'Proteção contra roubo, furto e uso não autorizado.',     'imagem' => 'imgCarros.png',            'featured' => false],
        ['titulo' => 'Motos',                'texto' => 'Mais segurança para o seu dia a dia sobre duas rodas.',  'imagem' => 'imgMotos.png',             'featured' => false],
        ['titulo' => 'Caminhões',             'texto' => 'Gestão de frota, rotas e segurança da carga.',          'imagem' => 'imgCaminhoes.png',         'featured' => false],
        ['titulo' => 'Bicicletas Elétricas',  'texto' => 'Segurança contra roubo e controle completo para pais.', 'imagem' => 'imgBicicletaEletrica.png',  'featured' => true],
    ],
    'cat_more' => [
        ['texto' => 'Embarcações',            'imagem' => 'imgEmbarcacoes.png'],
        ['texto' => 'Ferramentas e máquinas', 'imagem' => 'imgFerramentasMaquinas.png'],
        ['texto' => 'Malas e equipamentos',   'imagem' => 'imgMalasEquipamentos.png'],
        ['texto' => 'Mochilas e bolsas',      'imagem' => 'imgMochilasBolsas.png'],
        ['texto' => 'Objetos de valor',       'imagem' => 'imgObjetosDeValor.png'],
        ['texto' => 'Muito mais',             'imagem' => 'imgMuitoMais.png'],
    ],

    'bike_titulo'  => 'Bicicletas elétricas: segurança e controle para toda a família.',
    'bike_texto'   => 'Além de proteger contra roubo, nossa solução permite que os pais acompanhem e controlem o uso da e-bike dos filhos.',
    'bike_imagem'  => 'imgBicicletaEletricasSegurancaControleParaTodaFamilia.png',
    'bike_bullets' => ['Localização em tempo real', 'Alerta de movimento', 'Controle de velocidade máxima', 'Histórico de rotas e paradas', 'Cerca eletrônica', 'Mais tranquilidade para pais e responsáveis'],

    'planos_titulo'    => 'Escolha o plano ideal para você',
    'planos_subtitulo' => 'Planos simples, com tudo que você precisa para ter mais segurança e tranquilidade.',
    'planos_nota'      => 'Sem fidelidade. Cancele quando quiser.',
    'planos' => [
        ['nome' => 'Rastreador Veicular',                   'descricao' => 'Monitoramento completo do seu veículo em tempo real.',                'preco' => '49,90',
         'bullets' => ['Localização em tempo real', 'Histórico de rotas', 'Alerta de movimento', 'Bloqueio remoto', 'Cerca eletrônica', 'Relatórios completos']],
        ['nome' => 'Rastreador Veicular + Tag Localizadora', 'descricao' => 'Proteção completa para seu veículo e seus objetos importantes.',      'preco' => '69,90',
         'bullets' => ['Tudo do plano Rastreador Veicular +', 'Tag localizadora inclusa', 'Localize objetos e pertences', 'Alerta de proximidade', 'Bateria de longa duração']],
        ['nome' => 'Tag Localizadora',                       'descricao' => 'Localize objetos, bolsas, mochilas, malas e muito mais.',             'preco' => '19,90',
         'bullets' => ['Localização em tempo real', 'Alerta de proximidade', 'Leve e discreta', 'Bateria de longa duração', 'Compatível com o app']],
    ],

    'why_titulo' => 'Por que escolher a AserNet?',
    'why_items'  => [
        ['titulo' => 'Tecnologia confiável',   'texto' => 'Equipamentos modernos e de alta qualidade.'],
        ['titulo' => 'Suporte local',           'texto' => 'Atendimento rápido e especializado.'],
        ['titulo' => 'Planos flexíveis',        'texto' => 'Opções que cabem na sua necessidade.'],
        ['titulo' => 'Privacidade e segurança', 'texto' => 'Seus dados protegidos com criptografia.'],
    ],

    'trust_google' => '5,0 + de 3.000 avaliações no Google',
    'trust_items'  => ['Instalação profissional', 'Atendimento local de verdade', 'Suporte especializado', 'Plataforma 100% online'],
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'rastreamento_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['cat_titulo', 'cat_subtitulo', 'bike_titulo', 'bike_texto', 'bike_imagem',
                        'planos_titulo', 'planos_subtitulo', 'planos_nota', 'why_titulo', 'trust_google'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            if (!empty($db['bike_bullets']) && is_array($db['bike_bullets'])) $defaults['bike_bullets'] = $db['bike_bullets'];
            if (!empty($db['trust_items']) && is_array($db['trust_items']))   $defaults['trust_items']  = $db['trust_items'];

            foreach (['quick_items', 'cat_cards', 'cat_more', 'why_items'] as $arr) {
                if (!empty($db[$arr]) && is_array($db[$arr])) {
                    foreach ($db[$arr] as $i => $item) {
                        if (!isset($defaults[$arr][$i]) || !is_array($item)) continue;
                        foreach (array_keys($defaults[$arr][$i]) as $k) {
                            if ($k === 'featured') {
                                if (isset($item[$k])) $defaults[$arr][$i][$k] = (bool) $item[$k];
                            } elseif (isset($item[$k]) && strlen((string) $item[$k])) {
                                $defaults[$arr][$i][$k] = $item[$k];
                            }
                        }
                    }
                }
            }
            if (!empty($db['planos']) && is_array($db['planos'])) {
                foreach ($db['planos'] as $i => $p) {
                    if (!isset($defaults['planos'][$i]) || !is_array($p)) continue;
                    foreach (['nome', 'descricao', 'preco'] as $k) {
                        if (isset($p[$k]) && strlen((string) $p[$k])) $defaults['planos'][$i][$k] = $p[$k];
                    }
                    if (!empty($p['bullets']) && is_array($p['bullets'])) $defaults['planos'][$i]['bullets'] = $p['bullets'];
                }
            }
        }
    }
} catch (Throwable $e) {}

json_response(['ok' => true, 'content' => $defaults]);
