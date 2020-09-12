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
    <!-- CONTENT -->
    {{-- <section id="section" class="section">
        <div class="container p-t-100" id="app">
            <div class="has-text-left m-l-20 m-b-20">
                @yield('quickMenu')
            </div>
            @include('partials._messages') --}}
            @yield('content')
            {{-- <div class="is-hidden-desktop p-b-75"></div>
        </div>
            @include('partials._javascript')
            @yield('scripts')
    </section> --}}
    <!-- END CONTENT -->
</body>
<!-- END BODY -->
</html>
