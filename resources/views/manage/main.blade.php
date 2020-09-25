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
  <div class="columns is-marginless">
    <aside class="column is-2 aside hero is-fullheight">
      <div>
          <div class="compose has-text-centered">
            <a class="button is-danger is-block has-tooltip has-tooltip-bottom" data-tooltip='ИЗХОД' href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }} </form>
              <?php $admin = App\Models\User::where('id', Auth::id())->first(); ?>
              {{ $admin->name }}
            </a>
          </div>
          <div class="main">
            @include('manage.partials._menu')
          </div>
      </div>
    </aside>
    <div class="column is-10" id="app">
      {{-- @include('partials._messages') --}}
      @include('../partials._toasts')
      @yield('manage.content')
      @include('../partials._javascript')
      @yield('scripts')
    </div>
  </div>
  @else
    @include('auth.login')
  @endif
</body>
<!-- END BODY -->
</html>
