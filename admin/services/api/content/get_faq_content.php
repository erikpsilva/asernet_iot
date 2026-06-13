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

$defaults = [
    'categorias' => [
        [
            'id'             => 'internet',
            'icone'          => 'icon-home',
            'card_modifiers' => '',
            'titulo'         => 'Internet Residencial',
            'descricao'      => 'Planos, instalação, cobertura e mais.',
            'perguntas'      => [
                ['q' => 'Todos os planos possuem 1 Giga?',    'a' => 'Consulte a disponibilidade para seu endereço. Nossa equipe indica o plano ideal para sua região.'],
                ['q' => 'Qual a diferença entre os planos?',  'a' => 'Os planos variam por velocidade, serviços inclusos e soluções adicionais.'],
                ['q' => 'A instalação está inclusa?',          'a' => 'A instalação pode variar conforme campanha e viabilidade técnica.'],
                ['q' => 'Posso usar meu próprio roteador?',   'a' => 'Sim, desde que o equipamento seja compatível e configurado corretamente.'],
            ],
        ],
        [
            'id'             => 'wifi',
            'icone'          => 'icon-wifi',
            'card_modifiers' => 'purple',
            'titulo'         => 'Wi-Fi e Cobertura',
            'descricao'      => 'Tudo sobre Wi-Fi, Mesh e sinal.',
            'perguntas'      => [
                ['q' => 'O que é Wi-Fi Mesh?',                          'a' => 'É uma tecnologia que amplia a cobertura usando pontos integrados para melhorar o sinal.'],
                ['q' => 'O Wi-Fi chega em toda a casa?',                'a' => 'Depende do tamanho e das paredes do ambiente. Podemos dimensionar a melhor solução.'],
                ['q' => 'Muitos dispositivos podem deixar o Wi-Fi lento?', 'a' => 'Sim. Para muitos dispositivos, recomendamos soluções como Mesh ou Wi-Fi Profissional.'],
            ],
        ],
        [
            'id'             => 'mobile',
            'icone'          => 'icon-mobile-phone',
            'card_modifiers' => 'compact purple',
            'titulo'         => 'Mobile',
            'descricao'      => 'Planos, portabilidade, cobertura e bônus.',
            'perguntas'      => [
                ['q' => 'Posso manter meu número atual?',           'a' => 'Sim, fazemos portabilidade conforme regras da operadora.'],
                ['q' => 'O plano possui cobertura nacional?',        'a' => 'Sim, conforme área de cobertura móvel disponível.'],
                ['q' => 'Como funciona o bônus de portabilidade?',   'a' => 'O bônus é aplicado em planos elegíveis após a portabilidade.'],
            ],
        ],
        [
            'id'             => 'empresarial',
            'icone'          => 'icon-office',
            'card_modifiers' => 'compact green',
            'titulo'         => 'Empresarial',
            'descricao'      => 'Soluções para empresas, PME e Link Dedicado.',
            'perguntas'      => [
                ['q' => 'Qual a diferença entre internet PME e Link Dedicado?', 'a' => 'Internet PME atende empresas do dia a dia; Link Dedicado oferece banda exclusiva para operações críticas.'],
                ['q' => 'O Wi-Fi Pro é indicado para muitos dispositivos?',     'a' => 'Sim, ele foi pensado para ambientes com alta demanda de conexão.'],
                ['q' => 'Vocês atendem hotéis, clínicas e empresas?',           'a' => 'Sim. Projetamos soluções conforme o tamanho e necessidade do negócio.'],
            ],
        ],
        [
            'id'             => 'seguranca',
            'icone'          => 'icon-security',
            'card_modifiers' => 'compact orange',
            'titulo'         => 'Câmeras e Rastreamento',
            'descricao'      => 'Segurança, câmeras, rastreadores e tags.',
            'perguntas'      => [
                ['q' => 'Posso acessar as câmeras pelo celular?',                    'a' => 'Sim, o acesso pode ser feito por aplicativo compatível.'],
                ['q' => 'O rastreador funciona para motos e bicicletas elétricas?',  'a' => 'Sim, temos soluções para carros, motos, caminhões, bicicletas elétricas e tags.'],
                ['q' => 'A Tag Localizadora serve para quê?',                        'a' => 'Serve para acompanhar objetos, bolsas, mochilas, malas e outros pertences.'],
            ],
        ],
        [
            'id'             => 'financeiro',
            'icone'          => 'icon-payment',
            'card_modifiers' => 'wide cyan',
            'titulo'         => 'Financeiro e Suporte',
            'descricao'      => 'Pagamentos, faturas, suporte e atendimento.',
            'perguntas'      => [
                ['q' => 'Como emitir segunda via?',             'a' => 'A segunda via pode ser solicitada pela central do cliente ou canais de atendimento.'],
                ['q' => 'Como falar com o suporte?',            'a' => 'Você pode falar pelo WhatsApp, telefone ou canais oficiais da AserNet.'],
                ['q' => 'Posso alterar a data de vencimento?',  'a' => 'Consulte nossa equipe para verificar disponibilidade de alteração.'],
            ],
        ],
    ],
];

try {
    require_once dirname(__FILE__, 5) . '/config/database.php';
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'faq_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db) && !empty($db['categorias'])) {
            $defaults = $db;
        }
    }
} catch (Throwable $e) {}

json_response(['ok' => true, 'content' => $defaults]);
