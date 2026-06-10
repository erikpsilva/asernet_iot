<?php
// ── Canonical URL (strip query string) ───────────────────────────────────────
$_seoProtocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$_seoHost     = $_SERVER['HTTP_HOST'] ?? 'asernet.com.br';
$_seoPath     = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
$_canonicalUrl = $_seoProtocol . '://' . $_seoHost . $_seoPath;

// ── Per-page overrides (pages can define these vars before including assets) ──
$_seoTitle       = $seoTitle       ?? 'AserNet IoT Services — Internet Fibra Óptica e Soluções IoT em Socorro-SP';
$_seoDescription = $seoDescription ?? 'AserNet: internet fibra óptica de alta velocidade + soluções IoT em Socorro-SP e região. Wi-Fi Mesh, câmeras de segurança, rastreamento veicular, plano móvel, telefonia e internet empresarial para residências e empresas.';
$_seoKeywords    = $seoKeywords    ?? 'AserNet, internet fibra óptica Socorro SP, provedor internet Socorro, internet fibra Pinhalzinho, internet Monte Alegre do Sul, internet Lindóia SP, soluções IoT, empresa IoT Socorro, câmeras de segurança, Wi-Fi Mesh, rastreamento veicular, internet residencial, internet empresarial, Internet PME, Wi-Fi profissional, link dedicado, telefonia empresarial, plano móvel, Aser Mobile, Skeelo, Wi-Fi rural, internet fibra óptica SP, AserNet IoT Services, conectividade inteligente';
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- ── SEO Primário ─────────────────────────────────────────────────────── -->
<meta name="title"       content="<?= htmlspecialchars($_seoTitle, ENT_QUOTES) ?>">
<meta name="description" content="<?= htmlspecialchars($_seoDescription, ENT_QUOTES) ?>">
<meta name="keywords"    content="<?= htmlspecialchars($_seoKeywords, ENT_QUOTES) ?>">
<meta name="author"      content="AserNet IoT Services">
<meta name="robots"      content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<link rel="canonical" href="<?= htmlspecialchars($_canonicalUrl, ENT_QUOTES) ?>">

<!-- ── Open Graph ───────────────────────────────────────────────────────── -->
<meta property="og:site_name"   content="AserNet IoT Services">
<meta property="og:type"        content="website">
<meta property="og:url"         content="<?= htmlspecialchars($_canonicalUrl, ENT_QUOTES) ?>">
<meta property="og:title"       content="<?= htmlspecialchars($_seoTitle, ENT_QUOTES) ?>">
<meta property="og:description" content="<?= htmlspecialchars($_seoDescription, ENT_QUOTES) ?>">
<meta property="og:image"       content="<?= BASE_URL ?>/images/seo/og-default.jpg">
<meta property="og:image:width"  content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt"    content="AserNet IoT Services — Internet e Soluções Inteligentes">
<meta property="og:locale"       content="pt_BR">

<!-- ── Twitter Card ─────────────────────────────────────────────────────── -->
<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:title"       content="<?= htmlspecialchars($_seoTitle, ENT_QUOTES) ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($_seoDescription, ENT_QUOTES) ?>">
<meta name="twitter:image"       content="<?= BASE_URL ?>/images/seo/og-default.jpg">

<!-- ── Favicon ──────────────────────────────────────────────────────────── -->
<link rel="icon"             href="<?= BASE_URL ?>/images/favicon.png" type="image/x-icon">
<link rel="shortcut icon"    href="<?= BASE_URL ?>/images/favicon.png" type="image/x-icon">
<link rel="apple-touch-icon" href="<?= BASE_URL ?>/images/favicon.png">

<!-- ── JSON-LD: Organização + WebSite + Catálogo de Serviços ────────────── -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": ["Organization", "LocalBusiness"],
      "@id": "<?= BASE_URL ?>/#organization",
      "name": "AserNet IoT Services",
      "alternateName": "AserNet",
      "description": "Empresa de internet fibra óptica e soluções IoT em Socorro-SP e região. Oferece conectividade residencial e empresarial, câmeras de segurança, Wi-Fi Mesh, rastreamento veicular, plano móvel e muito mais.",
      "url": "<?= BASE_URL ?>",
      "logo": {
        "@type": "ImageObject",
        "url": "<?= BASE_URL ?>/images/logo.svg",
        "width": 160,
        "height": 40
      },
      "image": "<?= BASE_URL ?>/images/seo/og-default.jpg",
      "telephone": "+55-0800-222-5262",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Socorro",
        "addressRegion": "SP",
        "addressCountry": "BR"
      },
      "areaServed": [
        { "@type": "City", "name": "Socorro", "addressRegion": "SP" },
        { "@type": "City", "name": "Pinhalzinho", "addressRegion": "SP" },
        { "@type": "City", "name": "Monte Alegre do Sul", "addressRegion": "SP" },
        { "@type": "City", "name": "Lindóia", "addressRegion": "SP" },
        { "@type": "City", "name": "Águas de Lindóia", "addressRegion": "SP" }
      ],
      "sameAs": [
        "https://www.facebook.com/CurtaAsernet/",
        "https://www.instagram.com/asernet.internet/",
        "https://www.youtube.com/channel/UC20ArMDyEkkJkZysRCJ9mPA"
      ],
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Produtos e Serviços AserNet",
        "itemListElement": [
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Internet Fibra Óptica Residencial",
              "description": "Internet de alta velocidade via fibra óptica para residências em Socorro-SP e região.",
              "url": "<?= BASE_URL ?>/residencial"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Wi-Fi Mesh Residencial",
              "description": "Sistema Wi-Fi Mesh para cobertura total em todos os ambientes da sua casa.",
              "url": "<?= BASE_URL ?>/wifimesh"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Câmeras de Segurança IoT",
              "description": "Monitoramento inteligente com câmeras de segurança conectadas. Acesse de qualquer lugar.",
              "url": "<?= BASE_URL ?>/cameradeseguranca"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Rastreamento Veicular IoT",
              "description": "Rastreamento veicular em tempo real via internet. Segurança e controle do seu veículo.",
              "url": "<?= BASE_URL ?>/rastreamentoveicular"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Plano Móvel Aser Mobile",
              "description": "Plano de dados móveis AserNet para você se manter conectado dentro e fora de casa.",
              "url": "<?= BASE_URL ?>/planomovel"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Internet PME — Empresarial",
              "description": "Internet fibra óptica para pequenas e médias empresas com suporte especializado.",
              "url": "<?= BASE_URL ?>/internetpme"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Wi-Fi Profissional Empresarial",
              "description": "Infraestrutura Wi-Fi gerenciada para empresas com múltiplos dispositivos e alta demanda.",
              "url": "<?= BASE_URL ?>/wifiprofissional"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Link Dedicado Empresarial",
              "description": "Conexão dedicada e simétrica de alta disponibilidade para operações críticas.",
              "url": "<?= BASE_URL ?>/linkdedicado"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Telefonia Empresarial",
              "description": "Soluções de telefonia fixa, Número 0800 e Número 4000 para empresas.",
              "url": "<?= BASE_URL ?>/telefoniaempresarial"
            }
          }
        ]
      }
    },
    {
      "@type": "WebSite",
      "@id": "<?= BASE_URL ?>/#website",
      "url": "<?= BASE_URL ?>",
      "name": "AserNet IoT Services",
      "description": "Internet fibra óptica e soluções IoT em Socorro-SP e região.",
      "inLanguage": "pt-BR",
      "publisher": { "@id": "<?= BASE_URL ?>/#organization" }
    }
  ]
}
</script>

<!-- ── Google Analytics 4 ────────────────────────────────────────────────── -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XVJQM81YF4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-XVJQM81YF4');
</script>

<!-- ── Meta Pixel (Facebook) ────────────────────────────────────────────── -->
<script>
  !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
  n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
  document,'script','https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '162068196676258');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=162068196676258&ev=PageView&noscript=1"/></noscript>

<?php
$version = time();
echo '<link rel="stylesheet" type="text/css" href="' . BASE_URL . '/styles/style.min.css?v=' . $version . '">';
unset($_seoProtocol, $_seoHost, $_seoPath, $_canonicalUrl, $_seoTitle, $_seoDescription, $_seoKeywords);
?>
