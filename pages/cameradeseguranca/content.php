<?php
declare(strict_types=1);

function cameraV2Length(string $value): int {
    if (function_exists('mb_strlen')) return mb_strlen($value, 'UTF-8');
    $length = preg_match_all('/./us', $value);
    return $length === false ? strlen($value) : $length;
}

function cameraV2IsList(array $value): bool {
    if ($value === []) return true;
    return array_keys($value) === range(0, count($value) - 1);
}

function cameraV2Defaults(): array {
    $faq = require __DIR__ . '/faq_defaults.php';
    return [
        'hero' => [
            'eyebrow' => '• PROTEÇÃO INTELIGENTE ASERNET',
            'title' => 'E se algo acontecer,',
            'highlight' => 'como você vai perceber?',
            'description' => 'Câmeras inteligentes que ajudam você a perceber situações relevantes, receber notificações no celular e decidir como agir — esteja em casa, no trabalho ou a quilômetros de distância.',
            'price_intro' => 'Planos a partir de',
            'price' => '39,90',
            'price_suffix' => '/mês',
            'price_note' => 'Consulte condições e serviços incluídos.',
            'primary_button' => 'Quero proteger meu imóvel',
            'secondary_button' => 'Já tenho câmeras, quero melhorar meu sistema',
            'image' => 'bannerTopo.png',
            'benefits' => [
                ['icon'=>'microchip', 'text'=>'Inteligência Artificial'],
                ['icon'=>'bell', 'text'=>'AserControl'],
                ['icon'=>'cloud', 'text'=>'Nuvem'],
                ['icon'=>'user-shield', 'text'=>'Instalação profissional'],
                ['icon'=>'headset', 'text'=>'Suporte AserNet'],
            ],
        ],
        'intro' => [
            'title' => 'Ter câmeras é diferente',
            'title_second' => 'de ter proteção inteligente.',
            'description' => 'Muitos sistemas foram feitos para gravar. Isso é importante. Mas hoje podemos fazer muito mais. Uma solução inteligente pode perceber uma situação, avisar você e fornecer informação para decidir o que fazer.',
            'steps' => [
                ['icon'=>'eye', 'title'=>'PERCEBE', 'text'=>'A inteligência artificial identifica pessoas e eventos configurados.'],
                ['icon'=>'bell', 'title'=>'AVISA', 'text'=>'Você recebe uma notificação no celular.'],
                ['icon'=>'mobile-screen-button', 'title'=>'VOCÊ VERIFICA', 'text'=>'Abre o AserControl e vê o que está acontecendo.'],
                ['icon'=>'gear', 'title'=>'VOCÊ AGE', 'text'=>'Pode acionar luzes, sirene, portão ou outra automação.'],
            ],
            'statement' => 'Não é apenas uma câmera que grava.',
            'statement_second' => 'É um sistema que percebe, avisa e ajuda você a agir.',
        ],
        'alert' => [
            'title' => 'Imagine receber este alerta.',
            'time' => '22:47',
            'event' => 'Pessoa detectada — Área externa',
            'description' => 'Seu celular vibra. Você abre o AserControl. Em poucos segundos, consegue visualizar suas câmeras e entender o que está acontecendo.',
            'normal_title' => 'Era uma situação normal?',
            'normal_text' => 'Tudo certo. Você não precisa fazer nada.',
            'action_title' => 'Precisa tomar alguma ação?',
            'action_text' => 'Você pode acionar iluminação, sirene, portão ou outra ação configurada.',
            'image' => 'imgImagineReceberEsteAlerta.png',
        ],
        'decision' => [
            'title' => 'Nem todo alerta precisa',
            'title_second' => 'virar uma sirene.',
            'description' => 'Mesmo sistemas inteligentes podem gerar falsos positivos. Por isso, você pode configurar uma sequência mais inteligente:',
            'steps' => [
                ['icon'=>'person-walking', 'text'=>'DETECTOU'],
                ['icon'=>'bell', 'text'=>'AVISOU'],
                ['icon'=>'eye', 'text'=>'VOCÊ VERIFICOU'],
                ['icon'=>'circle-check', 'text'=>'VOCÊ DECIDIU'],
            ],
            'closing' => 'Assim, uma movimentação não precisa automaticamente incomodar sua família ou os vizinhos.',
            'statement' => 'A tecnologia percebe. Você continua no controle.',
            'notification_title' => 'AserControl',
            'notification_when' => 'Agora',
            'notification_event' => 'Pessoa detectada',
            'notification_place' => 'Área externa - 22:47',
            'image' => 'imgNemTodoAlertaPrecisaVirarUmaSirene.png',
        ],
        'platform' => [
            'title' => 'Sua casa. Sua chácara.',
            'title_second' => 'Sua empresa. Tudo no mesmo lugar.',
            'description' => 'Com o AserControl, câmeras e soluções compatíveis de diferentes locais podem ser reunidas em uma única plataforma.',
            'button' => 'Quero conhecer o AserControl',
            'image' => 'imgSuaCasaSuaChacara.png',
            'features' => [
                ['icon'=>'video', 'text'=>'Câmeras'], ['icon'=>'bell', 'text'=>'Alertas inteligentes'],
                ['icon'=>'cloud', 'text'=>'Armazenamento em nuvem'], ['icon'=>'lightbulb', 'text'=>'Iluminação'],
                ['icon'=>'bullhorn', 'text'=>'Sirene'], ['icon'=>'door-open', 'text'=>'Portões'],
                ['icon'=>'house-signal', 'text'=>'Automações'],
            ],
        ],
        'places' => [
            'title' => 'Proteção para diferentes momentos da sua vida.',
            'cards' => [
                ['title'=>'Casa', 'text'=>'Mais tranquilidade para sua família no dia a dia.', 'image'=>'imgCasa.png'],
                ['title'=>'Chácara', 'text'=>'Acompanhe seu imóvel mesmo estando longe.', 'image'=>'imgChacara.png'],
                ['title'=>'Empresa', 'text'=>'Veja o que acontece fora do horário de funcionamento.', 'image'=>'imgEmpresa.png'],
            ],
        ],
        'project' => [
            'title' => 'Um projeto pensado para o seu imóvel.',
            'description' => 'O melhor sistema não é o que tem mais câmeras. É o que foi pensado para o lugar certo. Entendemos seus acessos, áreas de atenção, infraestrutura e objetivo de proteção para recomendar uma solução proporcional.',
            'button' => 'Solicitar diagnóstico de proteção',
            'image' => 'imgUmProjetoPensadoaParaSeuImovel.png',
        ],
        'technology' => [
            'title' => 'Por trás da simplicidade,',
            'title_second' => 'existe tecnologia profissional.',
            'cards' => [
                ['icon'=>'video', 'title'=>'Câmeras com Inteligência Artificial', 'text'=>'Identificam e classificam eventos conforme configuração.'],
                ['icon'=>'network-wired', 'title'=>'Infraestrutura PoE', 'text'=>'Comunicação e alimentação da câmera por rede, sem depender do Wi-Fi.'],
                ['icon'=>'cloud', 'title'=>'Armazenamento em nuvem', 'text'=>'Seus registros não ficam apenas dentro do imóvel.'],
                ['icon'=>'gear', 'title'=>'Automação', 'text'=>'Iluminação, sirenes, portões e outras ações manuais ou automáticas.'],
            ],
        ],
        'resilience' => [
            'title' => 'E se faltar energia?',
            'title_second' => 'E se a internet cair?',
            'description' => 'Podemos avaliar diferentes níveis de resiliência conforme a necessidade do seu ambiente.',
            'cards' => [
                ['icon'=>'cloud', 'title'=>'Nuvem', 'text'=>'Registros remotos.'],
                ['icon'=>'microchip', 'title'=>'PoE + Nuvem', 'text'=>'Infraestrutura cabeada + nuvem.'],
                ['icon'=>'server', 'title'=>'NVR + Nuvem', 'text'=>'Gravação local e remota.'],
                ['icon'=>'car-battery', 'title'=>'UPS / Nobreak', 'text'=>'Autonomia temporária em caso de falta de energia.'],
            ],
        ],
        'reassurance' => [
            'current_title' => 'Já tem câmeras?',
            'current_title_second' => 'Talvez você não precise começar de novo.',
            'current_text' => 'Podemos avaliar seu sistema atual, verificar o que pode ser aproveitado e integrar ao AserControl ou otimizar a configuração.',
            'current_button' => 'Quero avaliar minhas câmeras',
            'current_image' => 'imgJaTemCamera.png',
            'calm_title' => 'Proteção não é viver preocupado.',
            'calm_title_second' => 'É poder viver com mais tranquilidade.',
            'calm_text' => 'A tecnologia existe para perceber quando algo merece sua atenção. Assim você pode trabalhar, descansar, viajar ou simplesmente aproveitar sua casa sabendo que existe uma estrutura ajudando a cuidar do que importa.',
            'calm_image' => 'imgProtecaoNaoeViver.png',
        ],
        'closing' => [
            'title' => 'Você não precisa esperar',
            'title_second' => 'algo acontecer para começar',
            'title_third' => 'a cuidar melhor.',
            'description' => 'Comece entendendo o que precisa ser protegido. O resto a gente projeta junto com você.',
            'button' => 'Solicitar meu diagnóstico de proteção',
            'signature' => 'Conectar bem é cuidar.',
            'price_intro' => 'Sua tranquilidade pode começar por',
            'price' => '39,90',
            'price_suffix' => '/mês',
            'price_note' => 'Planos relacionados. Consulte os serviços incluídos e as condições de contratação.',
            'image' => 'imgVoceNaoPrecisaEsperar.png',
            'options' => [
                ['icon'=>'house-shield', 'title'=>'Quero instalar câmeras', 'text'=>'Estou começando do zero.'],
                ['icon'=>'eye', 'title'=>'Já tenho câmeras', 'text'=>'Quero melhorar meu sistema atual.'],
                ['icon'=>'gear', 'title'=>'Projeto mais completo', 'text'=>'Quero uma solução feita para meu imóvel.'],
            ],
        ],
        'faq_header' => ['title' => 'Perguntas frequentes'],
        'faq' => array_map(static fn(array $item): array => ['question'=>$item[0], 'answers'=>$item[1]], $faq),
        'faq_cta' => [
            'title' => 'Ainda tem dúvidas? A gente cuida disso com você.',
            'description' => 'Cada imóvel tem suas particularidades. Converse com nossa equipe e descubra como a tecnologia pode trazer mais tranquilidade para sua rotina.',
            'button' => 'Solicite seu Diagnóstico de Proteção',
        ],
    ];
}

function cameraV2Merge(array $defaults, array $stored): array {
    foreach ($defaults as $key => $value) {
        if (!array_key_exists($key, $stored)) continue;
        if (is_array($value) && is_array($stored[$key])) {
            $defaults[$key] = cameraV2Merge($value, $stored[$key]);
        } elseif (is_string($value) && is_string($stored[$key]) && $key !== 'icon') {
            $defaults[$key] = $stored[$key];
        }
    }
    return $defaults;
}

function cameraV2SanitizeFaqHtml(string $html): ?string {
    if (cameraV2Length($html) > 30000) return null;
    $document = new DOMDocument();
    $previousErrors = libxml_use_internal_errors(true);
    $loaded = $document->loadHTML('<!doctype html><html><head><meta charset="utf-8"></head><body><div id="camera-faq-content">' . $html . '</div></body></html>');
    libxml_clear_errors();
    libxml_use_internal_errors($previousErrors);
    $root = $loaded ? $document->getElementById('camera-faq-content') : null;
    if (!$root) return null;

    $render = static function (DOMNode $node) use (&$render): string {
        if ($node instanceof DOMText) return htmlspecialchars($node->nodeValue, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        if (!$node instanceof DOMElement) return '';
        $tag = strtolower($node->tagName);
        if (in_array($tag, ['script', 'style', 'iframe', 'object', 'svg', 'img', 'form'], true)) return '';
        if ($tag === 'br') return '<br>';
        $children = '';
        foreach ($node->childNodes as $child) $children .= $render($child);
        if ($tag === 'b') $tag = 'strong';
        if ($tag === 'i') $tag = 'em';
        if ($tag === 'a') {
            $url = trim($node->getAttribute('href'));
            if (!filter_var($url, FILTER_VALIDATE_URL) || !in_array(strtolower((string)parse_url($url, PHP_URL_SCHEME)), ['http', 'https'], true)) return $children;
            return '<a href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '" target="_blank" rel="noopener noreferrer">' . $children . '</a>';
        }
        if (in_array($tag, ['p', 'strong', 'em', 'u', 'ol', 'ul', 'li', 'h3'], true)) return '<' . $tag . '>' . $children . '</' . $tag . '>';
        return $children;
    };
    $safe = '';
    foreach ($root->childNodes as $child) $safe .= $render($child);
    return trim(strip_tags($safe)) === '' ? null : $safe;
}

function cameraV2NormalizeFaq(array $entries): ?array {
    if (!cameraV2IsList($entries) || count($entries) > 50) return null;
    $normalized = [];
    foreach ($entries as $entry) {
        if (!is_array($entry) || !is_string($entry['question'] ?? null) || !is_array($entry['answers'] ?? null)) return null;
        $question = trim($entry['question']);
        if ($question === '' || cameraV2Length($question) > 4000) return null;
        if (!cameraV2IsList($entry['answers']) || count($entry['answers']) < 1 || count($entry['answers']) > 10) return null;
        $answers = [];
        foreach ($entry['answers'] as $answer) {
            if (!is_string($answer)) return null;
            $answer = trim($answer);
            if ($answer === '' || cameraV2Length($answer) > 4000) return null;
            $answers[] = $answer;
        }
        $item = ['question' => $question, 'answers' => $answers];
        if (array_key_exists('answer_html', $entry)) {
            if (!is_string($entry['answer_html'])) return null;
            $html = cameraV2SanitizeFaqHtml($entry['answer_html']);
            if ($html === null) return null;
            $item['answer_html'] = $html;
        }
        $normalized[] = $item;
    }
    return $normalized;
}

function cameraV2Content(): array {
    $defaults = cameraV2Defaults();
    try {
        require_once dirname(__DIR__, 2) . '/config/database.php';
        $row = getDbConnection(true)->query("SELECT setting_value FROM system_settings WHERE setting_key = 'cameras_v2_content' LIMIT 1")->fetch();
        if ($row) {
            $stored = json_decode($row['setting_value'], true);
            if (is_array($stored)) {
                $content = cameraV2Merge($defaults, $stored);
                if (isset($stored['faq']) && is_array($stored['faq'])) {
                    $faq = cameraV2NormalizeFaq($stored['faq']);
                    if ($faq !== null) $content['faq'] = $faq;
                }
                return $content;
            }
        }
    } catch (Throwable $e) {
        error_log('CAMERA V2 CONTENT ERROR: ' . $e->getMessage());
    }
    return $defaults;
}

function cameraV2Raw(string $path): string {
    global $cameraV2Content;
    $value = $cameraV2Content;
    foreach (explode('.', $path) as $part) {
        if (!is_array($value) || !array_key_exists($part, $value)) return '';
        $value = $value[$part];
    }
    return is_string($value) ? $value : '';
}

function cameraV2Text(string $path): string {
    return htmlspecialchars(cameraV2Raw($path), ENT_QUOTES, 'UTF-8');
}

function cameraV2Image(string $path): string {
    $filename = cameraV2Raw($path);
    if (!preg_match('/^[a-zA-Z0-9._-]+\.(?:png|jpe?g|webp)$/', $filename)) return '';
    return htmlspecialchars(BASE_URL . '/images/camerasegurancav2/' . rawurlencode($filename), ENT_QUOTES, 'UTF-8');
}

function cameraV2Fields(array $data, string $prefix = ''): array {
    $fields = [];
    foreach ($data as $key => $value) {
        if ($key === 'icon') continue;
        $path = $prefix === '' ? (string)$key : $prefix . '.' . $key;
        if (is_array($value)) {
            $fields += cameraV2Fields($value, $path);
        } elseif (is_string($value)) {
            $fields[$path] = $value;
        }
    }
    return $fields;
}

function cameraV2SetField(array &$data, string $path, string $value): void {
    $parts = explode('.', $path);
    $last = array_pop($parts);
    $target =& $data;
    foreach ($parts as $part) {
        $target =& $target[$part];
    }
    $target[$last] = $value;
}
