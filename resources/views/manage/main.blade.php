<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- HEAD -->
<head>
    @include('manage.partials._head')
</head>
<!-- END HEAD -->
<!-- BODY -->
<body>
    @if(Auth::check())
        <div class="columns" style="min-height: 100%;">
            <div class="column is-2 manage-menu">
                <div class="colums is-multiline">
                    <div class="column is-12 has-text-centered">
                        <span class="has-text-white is-size-5">
                            <i class="fa fa-user fa-3x"></i>
                            <br>
                            <?php $admin = App\User::where('id', Auth::id())->first(); ?>
                            {{ $admin->name }}
                        </span>
                    </div>
                    <div class="column is-12">
                        @include('manage.partials._menu')
                    </div>
                    <div class="column is-12 has-text-centered">
                        <hr />
                        <a class="button is-danger" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            ИЗХОД
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }} </form>
                    </div>
                </div>
            </div>
            <div class="column is-10 m-t-50">
                <section class="section">
                    <div class="container" id="app">
                        @include('partials._messages')
                        @yield('manage.content')
                    </div>
                    @include('../partials._javascript')
                    @yield('scripts')
                </section>
            </div>
        </div>
    @else
        @include('auth.login')
    @endif
</body>
<!-- END BODY -->
</html>
