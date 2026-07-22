<?php
declare(strict_types=1);

require_once dirname(__FILE__, 3) . '/_session.php';

require_once dirname(__FILE__, 3) . '/response.php';

if (empty($_SESSION['usuario'])) {
    json_response(['ok' => false, 'message' => 'Nao autorizado.'], 401);
}
if (!in_array($_SESSION['usuario']['nivel_acesso'], ['admin', 'editor', 'leitor'])) {
    json_response(['ok' => false, 'message' => 'Permissao negada.'], 403);
}

require_once dirname(__FILE__, 5) . '/config/database.php';

$defaults = [
    'section_titulo' => 'Nossas lojas',
    'section_texto'  => 'Visite uma de nossas unidades e descubra a melhor solu&ccedil;&atilde;o para voc&ecirc;.',

    'stores' => [
        ['titulo' => 'Loja Centro', 'endereco' => 'R. Coronel Jo&atilde;o C&acirc;ndido, 123', 'cidade' => 'Centro - Tr&ecirc;s Cora&ccedil;&otilde;es/MG', 'maps_query' => 'R. Coronel Joao Candido 123 Tres Coracoes MG', 'horario1' => 'Seg a Sex: 8h &agrave;s 18h', 'horario2' => 'S&aacute;b: 8h &agrave;s 12h', 'imagem' => ''],
        ['titulo' => 'Loja Nova Tr&ecirc;s Cora&ccedil;&otilde;es', 'endereco' => 'Av. Rei Pel&eacute;, 620', 'cidade' => 'Nova Tr&ecirc;s Cora&ccedil;&otilde;es - Tr&ecirc;s Cora&ccedil;&otilde;es/MG', 'maps_query' => 'Av. Rei Pele 620 Tres Coracoes MG', 'horario1' => 'Seg a Sex: 8h &agrave;s 18h', 'horario2' => 'S&aacute;b: 8h &agrave;s 12h', 'imagem' => ''],
        ['titulo' => 'Loja Santa Rita', 'endereco' => 'Rua Deputado Renato Azeredo, 210', 'cidade' => 'Santa Rita do Sapuca&iacute;/MG', 'maps_query' => 'Rua Deputado Renato Azeredo 210 Santa Rita do Sapucai MG', 'horario1' => 'Seg a Sex: 8h &agrave;s 18h', 'horario2' => 'S&aacute;b: 8h &agrave;s 12h', 'imagem' => ''],
        ['titulo' => 'Loja Cambu&iacute;', 'endereco' => 'Av. Jos&eacute; &Aacute;lvares Maciel, 96', 'cidade' => 'Cambu&iacute;/MG', 'maps_query' => 'Av. Jose Alvares Maciel 96 Cambui MG', 'horario1' => 'Seg a Sex: 8h &agrave;s 18h', 'horario2' => 'S&aacute;b: 8h &agrave;s 12h', 'imagem' => ''],
        ['titulo' => 'Loja Pouso Alegre', 'endereco' => 'Av. Prefeito Sapuca&iacute;, 1099', 'cidade' => 'Pouso Alegre/MG', 'maps_query' => 'Av. Prefeito Sapucai 1099 Pouso Alegre MG', 'horario1' => 'Seg a Sex: 8h &agrave;s 18h', 'horario2' => 'S&aacute;b: 8h &agrave;s 12h', 'imagem' => ''],
    ],

    'expansion_titulo'          => 'Hoje s&atilde;o 5 lojas.',
    'expansion_titulo_destaque' => 'Em breve, ainda mais perto de voc&ecirc;.',
    'expansion_texto'           => 'Nosso projeto &eacute; chegar a 10 lojas nos pr&oacute;ximos 2 anos, levando tecnologia, atendimento e confian&ccedil;a para ainda mais cidades.',

    'closing_titulo'          => 'A tecnologia evolui. O atendimento local continua sendo nosso',
    'closing_titulo_destaque' => 'diferencial.',
    'closing_texto'           => 'Conte com a AserNet para conectar, proteger e simplificar sua vida com solu&ccedil;&otilde;es inteligentes e atendimento de verdade.',
    'closing_imagem'          => 'imgUnidades.png',
];

try {
    $pdo = getDbConnection();
    $row = $pdo->query("SELECT setting_value FROM system_settings WHERE setting_key = 'nossaslojas_content' LIMIT 1")->fetch();
    if ($row && !empty($row['setting_value'])) {
        $db = json_decode($row['setting_value'], true);
        if (is_array($db)) {
            $scalars = ['section_titulo', 'section_texto',
                        'expansion_titulo', 'expansion_titulo_destaque', 'expansion_texto',
                        'closing_titulo', 'closing_titulo_destaque', 'closing_texto', 'closing_imagem'];
            foreach ($scalars as $k) {
                if (isset($db[$k]) && strlen((string) $db[$k])) $defaults[$k] = $db[$k];
            }
            if (!empty($db['stores']) && is_array($db['stores'])) {
                $stores = [];
                foreach ($db['stores'] as $item) {
                    if (!is_array($item)) continue;
                    $store = ['titulo' => '', 'endereco' => '', 'cidade' => '', 'maps_query' => '', 'horario1' => '', 'horario2' => '', 'imagem' => ''];
                    foreach ($store as $k => $v) {
                        if (isset($item[$k])) $store[$k] = (string) $item[$k];
                    }
                    $stores[] = $store;
                }
                if (!empty($stores)) $defaults['stores'] = $stores;
            }
        }
    }
} catch (Throwable $e) {}

$decode_entities_cb = function ($value) use (&$decode_entities_cb) {
    if (is_array($value)) return array_map($decode_entities_cb, $value);
    if (is_string($value)) return html_entity_decode($value, ENT_QUOTES, 'UTF-8');
    return $value;
};

json_response(['ok' => true, 'content' => $decode_entities_cb($defaults)]);
