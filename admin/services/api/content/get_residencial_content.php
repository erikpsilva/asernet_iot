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
    'diagnostico_titulo'  => 'A diferença não está na velocidade. Está na sua rede.',
    'diagnostico_texto'   => 'Mesmo com internet rápida, muitos problemas acontecem por falta de cobertura e estrutura adequada dentro da casa.',
    'diagnostico_imagem'  => 'imgADifrencaNaoEstaNaVelocidade.png',
    'solucao_titulo'      => 'Internet pensada para sua casa funcionar de verdade.',
    'solucao_texto'       => 'A AserNet entrega soluções com cobertura inteligente, pontos de rede e Wi-Fi preparado para múltiplos dispositivos.',
    'solucao_bullets'     => ['Mais estabilidade', 'Melhor cobertura', 'Melhor experiência para toda a família', 'Estrutura preparada para sua necessidade'],
    'planos_titulo'       => 'Escolha o nível ideal para sua casa',
    'planos' => [
        ['nome' => 'ASER CONECTA',      'descricao' => 'Ideal para uso básico e casas compactas',          'bullets' => ['1 Giga de velocidade', 'Wi-Fi estável', 'Suporte AserNet'],                                                                      'preco' => '109,90'],
        ['nome' => 'ASER CONECTA PLUS', 'descricao' => 'Mais estabilidade para famílias conectadas',       'bullets' => ['Tudo do plano anterior', 'Até 3 pontos de rede cabeados', 'Melhor desempenho para TVs, videogames e home office'],              'preco' => '119,90'],
        ['nome' => 'ASER CASA CONECTADA','descricao' => 'Cobertura inteligente para toda a casa',          'bullets' => ['Tudo do plano anterior', 'Sistema Wi-Fi Mesh', 'Cobertura ampliada', 'Melhor experiência em múltiplos ambientes'],              'preco' => '139,90'],
    ],
    'suporte' => [
        ['titulo' => 'Suporte local de verdade',        'texto' => 'Atendimento rápido e próximo sempre que precisar.'],
        ['titulo' => 'Estrutura inteligente',           'texto' => 'Mais estabilidade e desempenho para sua casa.'],
        ['titulo' => 'Instalação profissional',         'texto' => 'Configuração completa e orientação inclusas sem custo adicional.'],
        ['titulo' => 'Wi-Fi preparado para sua família','texto' => 'Ideal para cada dispositivo e para a rotina conectada da sua casa.'],
    ],
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'residencial_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            foreach (['diagnostico_titulo', 'diagnostico_texto', 'diagnostico_imagem', 'solucao_titulo', 'solucao_texto', 'planos_titulo'] as $k) {
                if (isset($db[$k]) && strlen((string)$db[$k])) $defaults[$k] = $db[$k];
            }
            if (!empty($db['solucao_bullets']) && is_array($db['solucao_bullets'])) {
                $defaults['solucao_bullets'] = $db['solucao_bullets'];
            }
            if (!empty($db['planos']) && is_array($db['planos'])) {
                foreach ($db['planos'] as $i => $plano) {
                    if (isset($defaults['planos'][$i]) && is_array($plano)) {
                        foreach (['nome', 'descricao', 'preco'] as $k) {
                            if (isset($plano[$k]) && strlen((string)$plano[$k])) $defaults['planos'][$i][$k] = $plano[$k];
                        }
                        if (!empty($plano['bullets']) && is_array($plano['bullets'])) {
                            $defaults['planos'][$i]['bullets'] = $plano['bullets'];
                        }
                    }
                }
            }
            if (!empty($db['suporte']) && is_array($db['suporte'])) {
                foreach ($db['suporte'] as $i => $item) {
                    if (isset($defaults['suporte'][$i]) && is_array($item)) {
                        foreach (['titulo', 'texto'] as $k) {
                            if (isset($item[$k]) && strlen((string)$item[$k])) $defaults['suporte'][$i][$k] = $item[$k];
                        }
                    }
                }
            }
        }
    }
} catch (Throwable $e) {}

json_response(['ok' => true, 'content' => $defaults]);
