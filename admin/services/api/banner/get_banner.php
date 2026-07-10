<?php
require_once dirname(__FILE__, 3) . '/_session.php';
header('Content-Type: application/json');

require_once dirname(__FILE__, 5) . '/config/api_security.php';
validateApiAccess($ALLOWED_ORIGINS);

if (empty($_SESSION['usuario']) || !in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor', 'leitor'])) {
    http_response_code(403);
    echo json_encode(['ok' => false, 'message' => 'Acesso não autorizado.']);
    exit;
}

require_once dirname(__FILE__, 5) . '/config/database.php';

$page = trim($_GET['page'] ?? '');

$allDefaults = [
    'inicio' => [
        'titulo'             => 'Mais que internet.',
        'titulo_destaque'    => 'Soluções completas',
        'titulo_complemento' => 'para sua vida.',
        'texto'              => 'Tecnologia, conectividade e segurança para sua casa ou empresa funcionarem melhor.',
        'bullets'            => ['Internet', 'Wi-Fi inteligente', 'Segurança', 'Mobilidade', 'Telefonia', 'Soluções empresariais'],
        'preco'              => '',
        'btn1_texto'         => 'Falar com um consultor',
        'btn2_texto'         => '0800 222 5262',
        'imagem'             => '',
    ],
    'residencial' => [
        'titulo'             => 'Internet de verdade,',
        'titulo_destaque'    => 'sem complicação.',
        'titulo_complemento' => '',
        'texto'              => '1 Giga de velocidade com estabilidade, cobertura e suporte para sua casa funcionar melhor.',
        'bullets'            => ['1 Giga em todos os planos', 'Wi-Fi estável em toda a casa', 'Suporte técnico AserNet', 'Instalação rápida e profissional'],
        'preco'              => '',
        'btn1_texto'         => 'Quero contratar agora',
        'btn2_texto'         => '0800 222 5262',
        'imagem'             => '',
    ],
    'cameras' => [
        'titulo'             => 'Segurança de verdade,',
        'titulo_destaque'    => 'sem complicação.',
        'titulo_complemento' => '',
        'texto'              => 'Monitore sua casa ou empresa em tempo real, direto pelo celular.',
        'bullets'            => ['Instalação inclusa', 'Acesso remoto pelo aplicativo', 'Equipamentos inclusos em comodato', 'Suporte AserNet'],
        'preco'              => 'Planos a partir de R$ 49,90/mês',
        'btn1_texto'         => 'Quero proteger meu imóvel',
        'btn2_texto'         => '0800 222 5262',
        'imagem'             => '',
    ],
    'wifimesh' => [
        'titulo'             => 'Wi-Fi forte em toda a casa,',
        'titulo_destaque'    => 'sem complicação.',
        'titulo_complemento' => '',
        'texto'              => 'Chega de sinal fraco, travamentos e ambientes sem conexão.',
        'bullets'            => ['Cobertura inteligente', 'Conexão contínua entre ambientes', 'Mais estabilidade para toda a família', 'Instalação e configuração inclusas'],
        'preco'              => 'A partir de R$ 139,90/mês',
        'btn1_texto'         => 'Quero Wi-Fi em toda a casa',
        'btn2_texto'         => '0800 222 5262',
        'imagem'             => '',
    ],
    'movel' => [
        'titulo'             => 'Internet que vai com você,',
        'titulo_destaque'    => 'sem complicação.',
        'titulo_complemento' => '',
        'texto'              => 'Fale, navegue e continue conectado dentro e fora de casa com o Aser Mobile.',
        'bullets'            => ['Cobertura nacional', 'Mais internet com bônus de portabilidade', 'Atendimento AserNet', 'Planos sem burocracia'],
        'preco'              => 'Planos a partir de R$ 39,90/mês',
        'btn1_texto'         => 'Quero meu chip Aser Mobile',
        'btn2_texto'         => '0800 222 5262',
        'imagem'             => '',
    ],
    'rastreamento' => [
        'titulo'             => 'Mais controle.',
        'titulo_destaque'    => 'Mais segurança.',
        'titulo_complemento' => 'Onde você estiver.',
        'texto'              => 'Rastreadores inteligentes para proteger o que importa e ter o controle total na palma da sua mão.',
        'bullets'            => ['Localização em tempo real', 'Bloqueio remoto', 'Histórico de rotas', 'Cerca eletrônica', 'Alerta de movimento'],
        'preco'              => '',
        'btn1_texto'         => 'Falar com um especialista',
        'btn2_texto'         => '0800 222 5262',
        'imagem'             => '',
    ],
    'skeelo' => [
        'titulo'             => 'Histórias que',
        'titulo_destaque'    => 'conectam.',
        'titulo_complemento' => '',
        'texto'              => 'Com a Skeelo, clientes AserNet têm acesso a uma experiência digital completa com ebooks, audiobooks e conteúdos para todos os momentos do seu dia.',
        'bullets'            => [],
        'preco'              => '',
        'btn1_texto'         => 'Ativar minha Skeelo',
        'btn2_texto'         => 'Saiba mais',
        'imagem'             => '',
    ],
    'paraempresas' => [
        'titulo'             => 'Tecnologia para empresas que',
        'titulo_destaque'    => 'não podem parar.',
        'titulo_complemento' => '',
        'texto'              => 'Conectividade, comunicação, Wi-Fi corporativo e soluções inteligentes para sua operação funcionar melhor.',
        'bullets'            => ['Internet empresarial', 'Wi-Fi profissional', 'Telefonia corporativa', 'Link dedicado', 'Segurança e monitoramento'],
        'preco'              => '',
        'btn1_texto'         => 'Falar com um especialista',
        'btn2_texto'         => '0800 222 5262',
        'imagem'             => '',
    ],
    'wifiprofissional' => [
        'titulo'             => 'Wi-Fi profissional,',
        'titulo_destaque'    => 'sem complicação.',
        'titulo_complemento' => '',
        'texto'              => 'Conecte múltiplos dispositivos com estabilidade, cobertura e desempenho de verdade para sua empresa.',
        'bullets'            => ['Cobertura completa', 'Alta capacidade de conexões simultâneas', 'Gestão inteligente da rede'],
        'preco'              => 'Planos a partir de R$ 159,90/mês',
        'btn1_texto'         => 'Quero um Wi-Fi profissional',
        'btn2_texto'         => '0800 222 5262',
        'imagem'             => '',
    ],
    'telefonia' => [
        'titulo'             => 'Comunicação profissional,',
        'titulo_destaque'    => 'sem complicação.',
        'titulo_complemento' => '',
        'texto'              => 'Telefonia empresarial para sua empresa atender melhor, ganhar produtividade e transmitir mais credibilidade.',
        'bullets'            => ['Linhas fixas empresariais', 'Telefonia SIP/IP', 'Soluções 0800 e 4000', 'Mais mobilidade e flexibilidade'],
        'preco'              => '',
        'btn1_texto'         => 'Solicitar proposta',
        'btn2_texto'         => '0800 222 5262',
        'imagem'             => '',
    ],
    'linkdedicado' => [
        'titulo'             => 'Link dedicado',
        'titulo_destaque'    => 'para empresas que não podem parar.',
        'titulo_complemento' => '',
        'texto'              => 'Conexão exclusiva, estável e com alta performance para manter sua operação sempre conectada.',
        'bullets'            => ['Banda exclusiva', 'Baixa latência', 'Alta estabilidade', 'Atendimento prioritário'],
        'preco'              => '',
        'btn1_texto'         => 'Solicitar proposta',
        'btn2_texto'         => '0800 222 5262',
        'imagem'             => '',
    ],
    'combo' => [
        'titulo'             => 'Mais que internet.',
        'titulo_destaque'    => 'Soluções completas',
        'titulo_complemento' => 'para você.',
        'texto'              => 'Conectividade, segurança e tecnologia trabalhando juntas para facilitar o seu dia a dia.',
        'bullets'            => ['Mais segurança para sua família e empresa', 'Conectividade estável e de alta performance', 'Suporte próximo e atendimento especializado'],
        'preco'              => '',
        'btn1_texto'         => 'Falar no WhatsApp',
        'btn2_texto'         => '0800 222 5262',
        'imagem'             => '',
    ],
    'sobreasernet' => [
        'titulo'             => 'Mais que internet. Conexões',
        'titulo_destaque'    => 'que cuidam.',
        'titulo_complemento' => '',
        'texto'              => 'A AserNet nasceu para conectar pessoas, empresas e histórias com tecnologia, proximidade e atendimento de verdade.',
        'bullets'            => ['Atendimento local', 'Equipe especializada', 'Estrutura profissional', 'Tecnologia para casa e empresa'],
        'preco'              => '',
        'btn1_texto'         => 'Falar com a AserNet',
        'btn2_texto'         => '0800 222 5262',
        'imagem'             => '',
    ],
];

if (!isset($allDefaults[$page])) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'message' => 'Página inválida.']);
    exit;
}

$defaults = $allDefaults[$page];

try {
    $pdo  = getDbConnection();
    $stmt = $pdo->prepare("SELECT setting_value FROM system_settings WHERE setting_key = ? LIMIT 1");
    $stmt->execute([$page . '_banner']);
    $row = $stmt->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            foreach (['titulo', 'titulo_destaque', 'titulo_complemento', 'texto', 'preco', 'btn1_texto', 'btn2_texto', 'imagem'] as $k) {
                if (array_key_exists($k, $db)) $defaults[$k] = $db[$k];
            }
            if (isset($db['bullets']) && is_array($db['bullets'])) $defaults['bullets'] = $db['bullets'];
        }
    }
} catch (Throwable $e) {}

if ($page === 'cameras' && strpos((string) $defaults['titulo'], 'Seguran') === 0 && strpos((string) $defaults['titulo_destaque'], 'sem complica') === 0) {
    $defaults['titulo'] = 'AserNet';
    $defaults['titulo_destaque'] = 'Segurança Inteligente';
    $defaults['texto'] = 'Proteção completa para o que realmente importa.';
    $defaults['bullets'] = ['Gravação em nuvem', 'Detecção de pessoas com IA', 'Acesso ao vivo onde estiver', 'Manutenção e troca de equipamentos', 'Suporte 24 horas'];
    $defaults['preco'] = '';
}

echo json_encode(['ok' => true, 'content' => $defaults]);
