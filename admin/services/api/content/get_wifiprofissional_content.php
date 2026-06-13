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
    'cmp_prob_titulo' => 'Seu Wi-Fi não acompanha o ritmo da sua empresa?',
    'cmp_prob_texto'  => 'Quando a rede não é profissional, sua empresa sente:',
    'cmp_prob_items'  => ['Sinal fraco em alguns ambientes', 'Quedas em horários de pico', 'Lentidão com muitos dispositivos', 'Dificuldade para controlar a rede', 'Clientes e equipe insatisfeitos'],
    'cmp_imagem'      => 'imgSeuWifiNaoAcompanha.png',
    'cmp_sol_titulo'  => 'Rede Wi-Fi profissional, gerenciada e escalável',
    'cmp_sol_texto'   => 'Com o Wi-Fi Pro AserNet, sua empresa conta com uma estrutura preparada para ambientes com maior demanda de conexão.',
    'cmp_sol_items'   => ['Controladora centralizada', 'Ponto de acesso profissional', 'Expansão com APs adicionais', 'Monitoramento e gestão da rede', 'Suporte técnico AserNet'],

    'steps_titulo' => 'Como funciona',
    'steps_texto'  => 'Uma solução que cresce com sua empresa',
    'steps'        => [
        ['titulo' => 'Entendemos o ambiente',            'texto' => 'Analisamos o tamanho, layout e necessidade do seu negócio.'],
        ['titulo' => 'Dimensionamos a melhor estrutura', 'texto' => 'Definimos a quantidade ideal de equipamentos para seu ambiente.'],
        ['titulo' => 'Instalamos controladora e APs',    'texto' => 'Equipamentos profissionais instalados com segurança.'],
        ['titulo' => 'Configuramos a rede',              'texto' => 'Criamos redes seguras, separadas e otimizadas para cada uso.'],
        ['titulo' => 'Acompanhamos o desempenho',        'texto' => 'Monitoramento contínuo e suporte sempre que você precisar.'],
    ],

    'plan_titulo'    => 'Business Wi-Fi Pro',
    'plan_preco'     => 'R$ 159,90',
    'plan_items'     => ['Controladora', '1 Access Point profissional', 'Instalação e configuração', 'Gestão centralizada', 'Suporte AserNet'],
    'plan_adicional' => 'AP adicional: R$ 100,00/mês',
    'plan_imagem'    => 'imgBusinessWifiPro.png',

    'aud_titulo' => 'Para quem é indicado',
    'aud_texto'  => 'Ideal para empresas com muitos dispositivos conectados',
    'aud_items'  => ['Escritórios', 'Academias', 'Clínicas', 'Escolas', 'Restaurantes', 'Hotéis e pousadas', 'Lojas e comércios', 'Empresas com equipe conectada'],

    'feat_titulo' => 'Diferenciais AserNet',
    'feat_cards'  => [
        ['titulo' => 'Mais estabilidade para todos os ambientes', 'texto' => 'O Wi-Fi Pro distribui melhor o sinal e melhora a experiência de conexão em áreas maiores ou com muitos usuários.',                       'imagem' => 'imgMaisEstabilidadeParaTodosAmbientes.png'],
        ['titulo' => 'Gestão inteligente',                        'texto' => 'A controladora permite acompanhar a rede, identificar falhas e melhorar o desempenho de forma prática.',                                   'imagem' => 'imgGestaoInteligente.png'],
        ['titulo' => 'Escalável',                                  'texto' => 'Sua empresa pode começar com 1 AP e adicionar novos pontos conforme a necessidade.',                                                        'imagem' => 'imgEscalavel.png'],
    ],
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'wifiprofissional_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['cmp_prob_titulo', 'cmp_prob_texto', 'cmp_imagem',
                        'cmp_sol_titulo', 'cmp_sol_texto',
                        'steps_titulo', 'steps_texto',
                        'plan_titulo', 'plan_preco', 'plan_adicional', 'plan_imagem',
                        'aud_titulo', 'aud_texto', 'feat_titulo'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            foreach (['cmp_prob_items', 'cmp_sol_items', 'plan_items', 'aud_items'] as $k) {
                if (!empty($db[$k]) && is_array($db[$k])) $defaults[$k] = $db[$k];
            }
            foreach (['steps', 'feat_cards'] as $arr) {
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
