<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- HEAD -->
<head>
{{-- @include('partials._googleAnalytics') --}}
@include('partials._head')
</head>
<!-- END HEAD -->
<!-- BODY -->
<body class="has-navbar-fixed-top">
  <div id="load">
    <div class="load_text">
      Poluchi.Me
    </div>
  </div>
  @if(Session::get('cookies') != 'accepted')
    @include('partials.buttons._cookies')
  @endif
  @include('partials._navbar')
  <div style="display: block; height: 70px; width: 100%;" class="is-hidden-desktop"></div>
  <div style="display: block; height: 30px; width: 100%;" class="is-hidden-mobile"></div>
  <!-- CONTENT -->
  <div>
    @include('partials._messages')
    @yield('content')
  </div>
  <!-- END CONTENT -->
  @include('partials._javascript')
  @yield('scripts')
  @include('partials._footer')
  @include('partials.buttons._backToTop')
</body>
<!-- END BODY -->
</html>
