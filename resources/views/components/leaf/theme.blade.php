<!DOCTYPE html>
<html lang="en">
@php
    $title = isset($title) ? $title : 'THUNGSONG :: ML Flood by KU';
    $author = isset($author) ? $author : 'KU Flood Research Team';
    $description = isset($description) ? $description : 'ระบบคาดการณ์อุทกภัยด้วย Machine Learning ของพื้นที่เทศบาลเมืองทุ่งสง “ML Flood by KU” เป็นส่วนหนึ่งของโครงการ: การพัฒนาระบบคาดการณ์อุทกภัยแบบเรียลไทม์ด้วย Machine Learning ในพื้นที่เทศบาลเมืองทุ่งสง อำเภอทุ่งสง จังหวัดนครศรีธรรมราช, “ML Flood by KU” ซึ่งได้รับทุนจากโครงการนวัตกรรมสู่สังคม ปี 2564-65 ของคณะวิศวกรรมศาสตร์ มหาวิทยาลัยเกษตรศาสตร์ โดยมี ผู้ช่วยศาสตราจารย์ สิตางศุ์ พิลัยหล้า สังกัดภาควิชาวิศวกรรมทรัพยากรน้ำ เป็นหัวหน้าโครงการ';
    $keywords = isset($keywords) ? $keywords : 'Machine Learning, Flood, วิจัย, คาดการณ์, ทุ่งสง, มหาวิทยาลัยเกษตรศาศตร์, ทุนวิจัย';
    $image = isset($image) ? $image : url('img/ground/LINE_ALBUM_Nakhon%20Sri%20_day%201_160222_220914_78.jpg');
    $url = isset($url) ? $url : url()->current();
    
@endphp

<head>
    <!-- Primary Meta Tags -->
    <title>{{ $title }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="title" content="{{ $title }}" />
    <meta name="author" content="{{ $author }}" />
    <meta name="description" content="{{ $description }}" />
    <meta name="keywords" content="{{ $keywords }}" />
    <link rel="canonical" href="{{ $url }}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $url }}" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="{{ $description }}" />
    <meta property="og:image" content="{{ $image }}" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ $url }}" />
    <meta property="twitter:title" content="{{ $title }}" />
    <meta property="twitter:description" content="{{ $description }}" />
    <meta property="twitter:image" content="{{ $image }}" />

    <!-- Favicon -->
    {{-- <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('leaf/assets/img/favicon/apple-touch-icon.png') }}" /> --}}
    {{-- <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('leaf/assets/img/favicon/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('leaf/assets/img/favicon/favicon-16x16.png') }}" /> --}}
    {{-- <link rel="icon" type="image/png" href="{{ asset('img/LOGO-icon.png') }}" /> --}}
    <link rel="icon" type="image/png" href="{{ asset('img/LOGO_KU_Flood.png') }}" />
    {{-- <link rel="manifest" href="{{ asset('leaf/assets/img/favicon/site.webmanifest') }}" /> --}}
    {{-- <link rel="mask-icon" href="{{ asset('leaf/assets/img/favicon/safari-pinned-tab.svg') }}" color="#ffffff" /> --}}
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="theme-color" content="#ffffff" />

    <!-- Fontawesome -->
    <link type="text/css" href="{{ asset('leaf/node_modules/@fortawesome/fontawesome-free/css/all.min.css') }}"
        rel="stylesheet" />

    {{-- bootstrap icon --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> --}}

    <!-- Prism -->
    <link type="text/css" href="{{ asset('leaf/node_modules/prismjs/themes/prism.css') }}" rel="stylesheet" />

    <!-- World Map -->
    <link type="text/css" href="{{ asset('leaf/node_modules/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />

    <!-- Leaf CSS -->
    <link type="text/css" href="{{ asset('leaf/css/leaf.css') }}" rel="stylesheet" />
    <link type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js",
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-THQTXJ7");
    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-141734189-6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "UA-141734189-6");
    </script>

    <!-- leaflet map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">

    <style>
        /* #map {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        } */

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        nav,
        .nav,
        .menu,
        button,
        .button,
        .btn,
        .price,
        ._heading,
        .wp-block-pullquote blockquote,
        blockquote,
        label,
        legend,
        a,
        .card-header,
        th,
        p,
        li {
            font-family: "Prompt", "Open Sans script=all rev=1" !important;
            font-weight: 400 !important;

        }

        #ofBar {
            display: none !important;
        }
    </style>
</head>

<body>

    <!-- Core -->
    <x-leaf.script></x-leaf.script>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-THQTXJ7" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <x-leaf.header mode="{{ $mode }}"></x-leaf.header>
    <main>
        {{ $slot }}
        {{-- <x-leaf.pre-footer></x-leaf.pre-footer> --}}
    </main>

    <!-- Footer -->
    <x-leaf.footer></x-leaf.footer>
    <!-- End of Footer -->

</body>

</html>
