<nav class="navbar is-dark is-size-6 is-fixed-top" role="navigation" aria-label="main navigation">



    <div class="navbar-brand">
        <a href="{{ route('home') }}" style="font-family: Engagement;" class="has-text-white is-size-1 m-l-20 m-r-20">Poluchi.Me</a>
        <a href="{{ route('order.create') }}" class="has-text-white m-t-15 m-l-20 has-text-centered">
            <i class="fa fa-shopping-basket is-size-4"></i>
            <br />
            <span class="is-size-6 has-text-warning">{{ Cart::total() }}лв.</span>
        </a>
        <a role="button" class="navbar-burger burger m-t-10 m-r-10" aria-label="menu" aria-expanded="false" data-target="burger">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>




  <div id="burger" class="navbar-menu">
    <div class="navbar-start">

        <div class="p-t-10">
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

            <a href="{{ route('home') }}" class="navbar-item">
                НАЧАЛО
            </a>
            <a href="{{ route('products.all') }}" class="navbar-item">
                ВСИЧКИ
            </a>
            <a href="{{ route('products.new') }}" class="navbar-item">
                НОВИ
            </a>

            <a href="{{ route('products.promo') }}" class="navbar-item">
                ПРОМОЦИИ
            </a>

    {{-- <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
            КОЛЕКЦИИ
        </a>
        <div class="navbar-dropdown is-size-6">
            <a class="navbar-item" href="#">
                ЛЯТО 2019
            </a>
            <a class="navbar-item" href="#">
                ЕСЕН 2019
            </a>
            <a class="navbar-item" href="#">
                ЗИМА 2019
            </a>
        </div>
    </div> --}}

    <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
            КАТЕГОРИИ
        </a>
        <div class="navbar-dropdown is-size-6 dropdown-content">
            <?php $data = new App\Category; $categories = $data->orderBy('name', 'asc')->get(); ?>
            @foreach($categories as $category)
                <a class="navbar-item" href="{{$category->slug}}">
                    {{$category->name}}
                </a>
            @endforeach
        </div>
    </div>




    </div>




    <div class="navbar-end">
              {{-- <div class="buttons">
              <a class="button is-light is-small">
              РЕГИСТРАЦИЯ
          </a>
          <a class="button is-success is-small">
          ВХОД
        </a>
        </div> --}}
    </div>

  </div>

    <div class="notification is-dark has-text-centered is-hidden-desktop is-hidden-tablet is-uppercase">
        <div style="height: 1px;" class="m-b-10 has-background-danger"></div>
        @yield('header')
    </div>


</nav>
