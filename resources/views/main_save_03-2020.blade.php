<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- HEAD -->
<head>
@include('partials._googleAnalytics')
@include('partials._head')
</head>
<!-- END HEAD -->
<!-- BODY -->
<body>
    <div id="load">
        <div class="load_text">
            Poluchi.Me
        </div>
    </div>
    @if(Session::get('cookies') != 'accepted')
        @include('partials.buttons._cookies')
    @endif
    @include('partials._navbar')
    <!-- CONTENT -->
    <section id="section" class="section">
        <div class="container p-t-100" id="app">
            <div class="has-text-left m-l-20 m-b-20">
                <!--
                @if(date('H:m:i') > '18:00')
                    @if(Session::get('nightLight') != 'confirmed')
                        @include('partials.buttons._nightLight')
                    @endif
                @endif
                -->
                @yield('quickMenu')
            </div>
            @include('partials._messages')
            @yield('content')
            <div class="is-hidden-desktop p-b-75"></div>
        </div>
            @include('partials._javascript')
            @yield('scripts')
    </section>
    <!-- END CONTENT -->
    @include('partials._footer')
</body>
<!-- END BODY -->
</html>
