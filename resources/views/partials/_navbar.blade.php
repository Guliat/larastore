<nav class="navbar is-dark is-fixed-top" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a href="{{ route('home') }}" class="engagement has-text-white is-size-1 m-l-20 m-r-20">Poluchi.Me</a>
    <a href="{{ route('order.create') }}" class="button is-dark has-text-white m-t-15 m-l-30">
      <span class="badge is-medium is-danger is-left">{{ Cart::total() }}лв.</span>
      <i class="fa fa-shopping-bag is-size-3"></i>
    </a>
    <a role="button" class="navbar-burger burger mt-3 mr-4" aria-label="menu" aria-expanded="false" data-target="burger">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
    </a>
  </div>
  <div id="burger" class="navbar-menu">
    <div class="navbar-start caveat">
      <div>
        <form action="{{ route('search.post') }}" method="post">
          {{ csrf_field() }}
          <div class="navbar-item field has-addons">
            <p class="control has-icons-left">
              <input class="input is-rounded is-light" type="text" name="search" placeholder="бързо търсене" value="@if(!empty($query)){{ $query }} @endif" />
              <span class="icon is-small is-left">
                <i class="fa fa-hashtag"></i>
              </span>
            </p>
            <div class="control">
              <button type="submit" class="button is-danger has-text-light is-rounded" @click="openLoading">
                  <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
      <a href="{{ route('home') }}" class="navbar-item">НАЧАЛО</a>
      <a href="{{ route('products.all') }}" class="navbar-item">ВСИЧКИ</a>
      <a href="{{ route('products.new') }}" class="navbar-item">НОВИ</a>
      <a href="{{ route('products.promo') }}" class="navbar-item">ПРОМОЦИИ</a>
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">КАТЕГОРИИ</a>
        <div class="navbar-dropdown is-size-6 dropdown-content">
          <?php $data = new App\Category; $categories = $data->where('is_active', 1)->orderBy('name', 'asc')->get(); ?>
            @foreach($categories as $category)
              <a class="navbar-item" href="{{$category->slug}}">
                {{$category->name}}
              </a>
            @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="notification is-paddingless p-b-5 is-dark has-text-centered is-hidden-desktop is-hidden-tablet is-uppercase">
      <div style="height: 1px;" class="m-b-5 has-background-danger"></div>
      @yield('header')
  </div>
</nav>
