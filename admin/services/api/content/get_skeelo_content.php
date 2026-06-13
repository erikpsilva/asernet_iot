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
    'moments_span'     => 'Tudo que você gosta de ler e ouvir',
    'moments_titulo'   => 'Conteúdo para todos os momentos.',
    'moments_features' => [
        ['titulo' => 'Ebooks',              'texto' => 'Milhares de títulos para ler onde e quando quiser.'],
        ['titulo' => 'Audiobooks',          'texto' => 'Ouça suas histórias preferidas enquanto faz outras coisas.'],
        ['titulo' => 'Para toda a família', 'texto' => 'Conteúdo para todas as idades, em um só lugar.'],
        ['titulo' => 'Leia offline',        'texto' => 'Baixe seus conteúdos e acesse mesmo sem internet.'],
        ['titulo' => 'Sincronização',       'texto' => 'Continue de onde parou em qualquer dispositivo.'],
        ['titulo' => 'Sua estante',         'texto' => 'Organize seus favoritos e crie sua biblioteca pessoal.'],
    ],

    'routine_span'  => 'Integrado ao seu dia',
    'routine_titulo'=> 'Leitura e conhecimento que se conectam com a sua rotina.',
    'routine_texto' => 'Aproveite ao máximo sua Skeelo com a conexão estável e inteligente da AserNet.',
    'routine_cards' => [
        ['titulo' => 'Ouça em qualquer lugar', 'texto' => 'Aproveite seus audiobooks enquanto dirige, treina ou trabalha.', 'imagem' => 'imgOucaEmQualquerLugar.png'],
        ['titulo' => 'Para todas as idades',   'texto' => 'Livros e conteúdos que incentivam o aprendizado e a imaginação.', 'imagem' => 'imgParaTodasAsIdades.png'],
        ['titulo' => 'Leitura que relaxa',     'texto' => 'Momentos de pausa com histórias que inspiram e conectam.', 'imagem' => 'imgLeituraQueRelaxa.png'],
        ['titulo' => 'Continue de onde parou', 'texto' => 'Sua leitura sincronizada entre celular, tablet e computador automaticamente.', 'imagem' => 'imgContineDeOndeParou.png'],
    ],

    'how_span'  => 'Como ativar sua Skeelo',
    'how_steps' => [
        ['titulo' => 'Baixe o app Skeelo', 'texto' => 'Disponível para Android e iOS.'],
        ['titulo' => 'Faça login',          'texto' => 'Use seu login AserNet para acessar.'],
        ['titulo' => 'Aproveite',           'texto' => 'Explore milhares de títulos e comece a ler ou ouvir.'],
    ],

    'benefits_titulo' => 'Um benefício exclusivo para você',
    'benefits' => [
        ['titulo' => 'Incluso no seu plano', 'texto' => 'Sem custo adicional.'],
        ['titulo' => 'Experiência premium',  'texto' => 'Plataforma completa e sem anúncios.'],
        ['titulo' => 'Sempre com você',      'texto' => 'Conteúdo na palma da sua mão.'],
        ['titulo' => 'Mais que internet',    'texto' => 'AserNet entrega experiências que conectam você ao que realmente importa.'],
    ],

    'trust_google' => '5.0 ★★★★★ + de 3.000 avaliações no Google',
    'trust_item1'  => 'Atendimento via WhatsApp',
    'trust_item2'  => 'Suporte rápido e especializado',
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'skeelo_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['moments_span', 'moments_titulo', 'routine_span', 'routine_titulo', 'routine_texto',
                        'how_span', 'benefits_titulo', 'trust_google', 'trust_item1', 'trust_item2'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            foreach (['moments_features', 'routine_cards', 'how_steps', 'benefits'] as $arr) {
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
