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
    'dor_titulo'   => 'Você nem sempre consegue estar presente.',
    'dor_destaque' => 'Mas sua segurança pode.',
    'dor_items'    => ['Preocupação ao sair de casa', 'Empresa sem monitoramento', 'Dificuldade para acompanhar funcionários', 'Insegurança no dia a dia'],

    'monitor_titulo'         => 'Acompanhe tudo em tempo real pelo celular',
    'monitor_texto'          => 'Com a Aser Câmeras você monitora sua casa ou empresa de qualquer lugar.',
    'monitor_bullets'        => ['Visualização ao vivo', 'Acesso remoto pelo app', 'Notificações e alertas inteligentes', 'Armazenamento em nuvem', 'Equipamentos inclusos em comodato'],
    'monitor_imagem'         => 'imagAcompanheTudoEmTempoReal.png',
    'monitor_casa_titulo'    => 'Para sua casa',
    'monitor_casa_texto'     => 'Mais tranquilidade para sua família e controle do seu imóvel mesmo à distância.',
    'monitor_casa_imagem'    => 'imgParaSuaCasa.png',
    'monitor_empresa_titulo' => 'Para sua empresa',
    'monitor_empresa_texto'  => 'Mais segurança, monitoramento e acompanhamento da operação da sua empresa.',
    'monitor_empresa_imagem' => 'imgParaSuaEmpresa.png',

    'planos_titulo' => 'Escolha o plano ideal para você',
    'planos' => [
        ['nome' => 'Essencial', 'descricao' => 'Ideal para apartamentos e pequenas residências.',       'quantidade' => '02 câmeras', 'taxa' => '+ R$ 120,00 Taxa de Instalação e Configuração', 'imagem' => 'img2cameras.png', 'bullets' => ['Aplicativo exclusivo', 'Visualização ao vivo em tempo real', 'Detecção de pessoas com IA', 'Gravação em nuvem', 'Manutenção inclusa e troca garantida', 'Suporte 24 horas'], 'preco' => '79,90'],
        ['nome' => 'Plus',      'descricao' => 'Cobertura completa para residências médias.',          'quantidade' => '04 câmeras', 'taxa' => '+ R$ 240,00 Taxa de Instalação e Configuração', 'imagem' => 'img4cameras.png', 'bullets' => ['Aplicativo exclusivo', 'Visualização ao vivo em tempo real', 'Detecção de pessoas com IA', 'Gravação em nuvem', 'Manutenção inclusa e troca garantida', 'Suporte 24 horas'], 'preco' => '149,90'],
        ['nome' => 'Premium',   'descricao' => 'Proteção ampliada para imóveis maiores.',              'quantidade' => '06 câmeras', 'taxa' => '+ R$ 360,00 Taxa de Instalação e Configuração', 'imagem' => 'img6cameras.png', 'bullets' => ['Aplicativo exclusivo', 'Visualização ao vivo em tempo real', 'Detecção de pessoas com IA', 'Gravação em nuvem', 'Manutenção inclusa e troca garantida', 'Suporte 24 horas'], 'preco' => '219,90'],
        ['nome' => 'Total',     'descricao' => 'Proteção máxima para grandes residências e empresas.', 'quantidade' => '08 câmeras', 'taxa' => '+ R$ 480,00 Taxa de Instalação e Configuração', 'imagem' => 'img8cameras.png', 'bullets' => ['Aplicativo exclusivo', 'Visualização ao vivo em tempo real', 'Detecção de pessoas com IA', 'Gravação em nuvem', 'Manutenção inclusa e troca garantida', 'Suporte 24 horas'], 'preco' => '289,90'],
    ],

    'como_titulo'      => 'Como funciona',
    'como_texto'       => 'Simples e sem burocracia',
    'como_steps'       => ['Escolha o plano ideal para sua necessidade', 'Agendamos a instalação', 'Configuramos o aplicativo', 'Você acompanha tudo pelo celular'],
    'como_app_titulo'  => 'Sua segurança na palma da mão',
    'como_app_texto'   => 'Acompanhe suas câmeras em tempo real pelo aplicativo.',
    'como_app_bullets' => ['Android e iPhone', 'Visualização remota', 'Alertas inteligentes'],
    'como_app_imagem'  => 'imgSuaSegurancaNaPalmaDaMao.png',

    'diferenciais_titulo' => 'Diferenciais Aser Câmeras',
    'diferenciais' => [
        ['titulo' => 'Instalação inclusa',       'texto' => 'Nossa equipe cuida de tudo para você.'],
        ['titulo' => 'Equipamentos em comodato', 'texto' => 'Sem necessidade de compra.'],
        ['titulo' => 'Suporte local',            'texto' => 'Atendimento próximo e rápido quando você precisar.'],
        ['titulo' => 'Expansível',               'texto' => 'Adicione mais câmeras conforme sua necessidade.'],
    ],
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'cameras_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['dor_titulo', 'dor_destaque', 'monitor_titulo', 'monitor_texto', 'monitor_imagem',
                        'monitor_casa_titulo', 'monitor_casa_texto', 'monitor_casa_imagem',
                        'monitor_empresa_titulo', 'monitor_empresa_texto', 'monitor_empresa_imagem',
                        'planos_titulo', 'como_titulo', 'como_texto', 'como_app_titulo', 'como_app_texto',
                        'como_app_imagem', 'diferenciais_titulo'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            foreach (['dor_items', 'monitor_bullets', 'como_steps', 'como_app_bullets'] as $k) {
                if (!empty($db[$k]) && is_array($db[$k])) $defaults[$k] = $db[$k];
            }
            if (!empty($db['planos']) && is_array($db['planos']) && count($db['planos']) >= count($defaults['planos'])) {
                foreach ($db['planos'] as $i => $plano) {
                    if (isset($defaults['planos'][$i]) && is_array($plano)) {
                        foreach (['nome', 'descricao', 'preco', 'imagem', 'quantidade', 'taxa'] as $k) {
                            if (isset($plano[$k]) && strlen((string) $plano[$k])) $defaults['planos'][$i][$k] = $plano[$k];
                        }
                        if (!empty($plano['bullets']) && is_array($plano['bullets'])) $defaults['planos'][$i]['bullets'] = $plano['bullets'];
                    }
                }
            }
            if (!empty($db['diferenciais']) && is_array($db['diferenciais'])) {
                foreach ($db['diferenciais'] as $i => $item) {
                    if (isset($defaults['diferenciais'][$i]) && is_array($item)) {
                        foreach (['titulo', 'texto'] as $k) {
                            if (isset($item[$k]) && strlen((string) $item[$k])) $defaults['diferenciais'][$i][$k] = $item[$k];
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

json_response(['ok' => true, 'content' => $defaults]);
