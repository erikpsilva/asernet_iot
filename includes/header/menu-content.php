<?php
declare(strict_types=1);

function headerMenuLength(string $value): int {
    if (function_exists('mb_strlen')) return mb_strlen($value, 'UTF-8');
    $length = preg_match_all('/./us', $value);
    return $length === false ? strlen($value) : $length;
}

/** Campos editáveis do menu; links e ícones permanecem definidos no layout. */
function headerMenuSchema(): array {
    return [
        'Navegação' => [
            'nav_solutions' => ['Soluções', 'Soluções'],
            'nav_about' => ['Sobre a AserNet', 'Sobre a AserNet'],
            'nav_support' => ['Suporte', 'Suporte'],
            'nav_home' => ['Residencial', 'Residencial'],
            'nav_business' => ['Empresas (PME)', 'Empresas (PME)'],
            'nav_whatsapp' => ['Falar no WhatsApp', 'Falar no WhatsApp'],
        ],
        'Para sua casa' => [
            'home_title' => ['Título', 'Para sua casa'],
            'home_intro' => ['Descrição', 'Conexão, mobilidade e entretenimento para toda a família.'],
            'home_residential_title' => ['Internet Residencial — título', 'Internet Residencial'],
            'home_residential_text' => ['Internet Residencial — descrição', 'Planos de alta velocidade e estabilidade'],
            'home_mesh_title' => ['Wi-Fi Mesh — título', 'Wi-Fi Mesh'],
            'home_mesh_text' => ['Wi-Fi Mesh — descrição', 'Cobertura completa em todos os ambientes'],
            'home_mobile_title' => ['Plano Móvel — título', 'Plano Móvel'],
            'home_mobile_text' => ['Plano Móvel — descrição', 'Internet para levar com você'],
            'home_skeelo_title' => ['Skeelo — título', 'Skeelo'],
            'home_skeelo_text' => ['Skeelo — descrição', 'Livros digitais e audiobooks no seu plano'],
            'home_cruise_title' => ['Cruzeiro AserNet — título', 'Cruzeiro AserNet'],
            'home_cruise_text' => ['Cruzeiro AserNet — descrição', 'Concorra a uma viagem de cruzeiro para duas pessoas.'],
            'home_card_title' => ['Card — título', 'Casa Conectada'],
            'home_card_text' => ['Card — descrição', "Internet + Wi-Fi\n+ Mobile"],
            'home_card_image' => ['Card — imagem', 'imgCasaConectada.png', 'image'],
        ],
        'Para empresas' => [
            'business_title' => ['Título', 'Para empresas'],
            'business_intro' => ['Descrição', 'Soluções completas para seu negócio não parar.'],
            'business_pme_title' => ['Internet PME — título', 'Internet PME'],
            'business_pme_text' => ['Internet PME — descrição', 'Estabilidade e performance para sua empresa'],
            'business_wifi_title' => ['Wi-Fi Profissional — título', 'Wi-Fi Profissional'],
            'business_wifi_text' => ['Wi-Fi Profissional — descrição', 'Rede de alta performance para seu negócio'],
            'business_phone_title' => ['Telefonia Empresarial — título', 'Telefonia Empresarial'],
            'business_phone_text' => ['Telefonia Empresarial — descrição', 'Comunicação profissional e ilimitada'],
            'business_link_title' => ['Link Dedicado — título', 'Link Dedicado'],
            'business_link_text' => ['Link Dedicado — descrição', 'Máxima estabilidade para operações críticas'],
            'business_access_title' => ['Controle de Acesso — título', 'Controle de Acesso Corporativo'],
            'business_access_text' => ['Controle de Acesso — descrição', 'Gestão de colaboradores, visitantes e áreas restritas'],
            'business_card_title' => ['Card — título', 'Empresa Conectada'],
            'business_card_text' => ['Card — descrição', "Internet + Wi-Fi + Telefonia\n+ Controle de Acesso"],
            'business_card_image' => ['Card — imagem', 'imgSolucaoCompletaParaEmpresas.png', 'image'],
        ],
        'Condomínios' => [
            'condo_title' => ['Título', 'Condomínios'],
            'condo_intro' => ['Descrição', 'Tecnologia e segurança para síndicos e moradores.'],
            'condo_smart_title' => ['Condomínio Inteligente — título', 'Condomínio Inteligente'],
            'condo_smart_text' => ['Condomínio Inteligente — descrição', 'Solução completa para gestão, segurança e conectividade'],
            'condo_access_title' => ['Controle de Acesso — título', 'Controle de Acesso Condominial'],
            'condo_access_text' => ['Controle de Acesso — descrição', 'Mais segurança e praticidade para moradores e visitantes'],
            'condo_neighborhood_title' => ['Bairro Seguro — título', 'Bairro Seguro'],
            'condo_neighborhood_text' => ['Bairro Seguro — descrição', 'Monitoramento colaborativo para comunidades mais protegidas'],
            'condo_card_title' => ['Card — título', 'Condomínio Inteligente'],
            'condo_card_text' => ['Card — descrição', "Segurança + Conectividade\n+ Gestão integrada"],
            'condo_card_image' => ['Card — imagem', 'imgConcominioIntelgiente.png', 'image'],
        ],
        'Segurança inteligente' => [
            'security_title' => ['Título', 'Segurança inteligente'],
            'security_intro' => ['Descrição', 'Proteção inteligente para pessoas, patrimônios e veículos.'],
            'security_camera_title' => ['Câmeras — título', 'Câmeras de Segurança'],
            'security_camera_text' => ['Câmeras — descrição', 'Monitore o que realmente importa com alta definição'],
            'security_tracking_title' => ['Rastreamento — título', 'Rastreamento Veicular'],
            'security_tracking_text' => ['Rastreamento — descrição', 'Localização em tempo real e histórico de rotas'],
            'security_card_title' => ['Card — título', 'Soluções de Segurança'],
            'security_card_text' => ['Card — descrição', "Monitoramento visual\n+ Rastreamento\n+ Tecnologia integrada"],
            'security_card_image' => ['Card — imagem', 'imgSolucoesdeSeguranca.png', 'image'],
        ],
        'Bloco AserNet IoT Services' => [
            'brand_name' => ['Marca — primeira linha', 'AserNet'],
            'brand_service' => ['Marca — segunda linha', 'IoT Services'],
            'brand_tagline' => ['Linha de apoio', 'Internet. Segurança. Tecnologia.'],
            'brand_callout' => ['Chamada — primeira linha', 'Conectar bem'],
            'brand_callout_emphasis' => ['Chamada — destaque', 'é cuidar.'],
            'brand_text' => ['Descrição', 'Soluções inteligentes que simplificam sua rotina e protegem o que importa para você.'],
            'brand_button' => ['Botão', "Conheça a AserNet\nIoT Services"],
            'brand_image' => ['Imagem', 'imgConhecaAsernet.png', 'image'],
        ],
        'Faixa inferior' => [
            'benefit_local_title' => ['Atendimento local — título', 'Atendimento local'],
            'benefit_local_text' => ['Atendimento local — texto', "Equipe perto de você\nquando precisar"],
            'benefit_install_title' => ['Instalação — título', 'Instalação profissional'],
            'benefit_install_text' => ['Instalação — texto', "Equipamentos e serviços\nde qualidade"],
            'benefit_support_title' => ['Suporte — título', 'Suporte de verdade'],
            'benefit_support_text' => ['Suporte — texto', "Rápido, humano\ne eficiente"],
            'benefit_integrated_title' => ['Soluções — título', 'Soluções integradas'],
            'benefit_integrated_text' => ['Soluções — texto', "Tudo conectado para\nmais segurança"],
        ],
        'Textos específicos do celular' => [
            'mobile_home_card_text' => ['Casa Conectada — descrição', 'Internet + Wi-Fi + Mobile'],
            'mobile_business_card_text' => ['Empresa Conectada — descrição', 'Internet + Wi-Fi + Telefonia + Controle de Acesso'],
            'mobile_condo_card_text' => ['Condomínio Inteligente — descrição', 'Segurança + Conectividade + Gestão integrada'],
            'mobile_security_card_text' => ['Soluções de Segurança — descrição', 'Monitoramento + Rastreamento + Tecnologia'],
        ],
    ];
}

function headerMenuImageSizes(): array {
    return [
        'home_card_image' => [500, 427],
        'business_card_image' => [250, 388],
        'condo_card_image' => [500, 372],
        'security_card_image' => [500, 343],
        'brand_image' => [1054, 1564],
    ];
}

function headerMenuContent(): array {
    static $content = null;
    if ($content !== null) return $content;
    $schema = headerMenuSchema();
    $content = [];
    foreach ($schema as $fields) foreach ($fields as $key => $field) $content[$key] = $field[1];
    try {
        require_once dirname(__FILE__, 3) . '/config/database.php';
        $statement = getDbConnection(true)->prepare("SELECT setting_value FROM system_settings WHERE setting_key = 'header_menu_content' LIMIT 1");
        $statement->execute();
        $saved = json_decode((string) $statement->fetchColumn(), true);
        if (is_array($saved)) {
            foreach ($content as $key => $default) {
                if (isset($saved[$key]) && is_string($saved[$key])) {
                    $field = headerMenuField($key);
                    $content[$key] = ($field[2] ?? '') === 'image'
                        ? (preg_match('/^[a-zA-Z0-9_.-]+\.(?:png|jpe?g|webp)$/', $saved[$key]) ? $saved[$key] : $default)
                        : $saved[$key];
                }
            }
        }
    } catch (Throwable $e) {
        // O menu público continua com os textos e imagens originais sem o banco.
    }
    return $content;
}

function headerMenuField(string $key): ?array {
    foreach (headerMenuSchema() as $fields) if (isset($fields[$key])) return $fields[$key];
    return null;
}

function hm(string $key): string {
    return nl2br(htmlspecialchars(headerMenuContent()[$key] ?? '', ENT_QUOTES, 'UTF-8'), false);
}

function hmi(string $key): string {
    return htmlspecialchars(BASE_URL . '/images/menu/' . (headerMenuContent()[$key] ?? ''), ENT_QUOTES, 'UTF-8');
}
