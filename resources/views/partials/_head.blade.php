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
<link href="{{ asset('css') }}/{{ config('app.theme') }}?_v25072020" rel="stylesheet">
@yield('stylesheets')
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '1782963871966907');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=1782963871966907&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
