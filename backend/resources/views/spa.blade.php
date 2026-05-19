<!DOCTYPE html>
<html lang="id">
    <head>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16762703567"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'AW-16762703567');
        </script>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        @if(isset($seo))
            <title>{{ $seo['title'] }}</title>
            <meta name="description" content="{{ $seo['description'] }}" />
            <meta name="robots" content="index, follow" />
            <link rel="canonical" href="{{ $seo['canonical'] }}" />
            
            <!-- Open Graph -->
            <meta property="og:title" content="{{ $seo['title'] }}" />
            <meta property="og:description" content="{{ $seo['description'] }}" />
            <meta property="og:type" content="{{ $seo['og_type'] ?? 'article' }}" />
            <meta property="og:url" content="{{ $seo['canonical'] }}" />
            <meta property="og:image" content="{{ $seo['image'] }}" />
            <meta property="og:site_name" content="Gunz Travel" />
            <meta property="og:locale" content="id_ID" />
            
            <!-- Twitter -->
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:title" content="{{ $seo['title'] }}" />
            <meta name="twitter:description" content="{{ $seo['description'] }}" />
            <meta name="twitter:image" content="{{ $seo['image'] }}" />

            @if(!empty($seo['schema']))
                <script type="application/ld+json">
                    {!! json_encode($seo['schema'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
                </script>
            @endif
        @else
            <title>Travel Malang Juanda 24 Jam, Travel Malang Surabaya & Sewa Mobil Malang | Gunz Travel</title>
            <meta name="description" content="Gunz Travel melayani travel Malang Juanda 24 jam, travel Malang Surabaya door to door mulai Rp150.000/orang. Sewa mobil Malang dengan driver. Booking via WhatsApp." />
            <meta name="robots" content="index, follow" />
        @endif
        
        @vite(['../src/main.js'])
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WD6MWJCQ"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
        <div id="app"></div>
    </body>
</html>
