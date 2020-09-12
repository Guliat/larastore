<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- THEME COLOR -->
<meta name="theme-color" content="{{ config('app.theme_color') }}" />
<!-- WEB APP CAPABLE -->
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- OPEN GRAPH -->
<meta property="og:type" content="product" />
<meta property="og:locale" content="bg_BG" />
<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:title" content="@yield('meta-title')" />
<meta property="og:description" content="@yield('meta-description')" />
<meta property="og:image" content="@yield('meta-image')" />
<meta property="og:url" content="@yield('meta-url')" />
<meta property="fb:app_id" content="312970125760719" />
<!-- TITLE -->
<title> {{ config('app.name') }} @yield('title') </title>
<!-- FAVICONS -->
<link rel="shortcut icon" href="{{ asset('/') }}{{ config('app.favicon') }}">
<link rel="shortcut icon" href="{{ asset('/') }}{{ config('app.favicon196') }}">
<!-- FONTS -->
<link href="https://fonts.googleapis.com/css?family=Engagement&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
<!-- STYLES -->
<link href="{{ asset('css') }}/{{ config('app.theme') }}" rel="stylesheet">
@yield('stylesheets')
<!-- Facebook Pixel Code -->

<!-- End Facebook Pixel Code -->
