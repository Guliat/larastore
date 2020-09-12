<nav class="navbar is-light has-text-centered p-t-30">
    <div class="navbar-brand">
        <span class="navbar-item">
            <a class="button is-danger" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ИЗХОД</a>
        </span>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }} </form>
        <div class="navbar-burger burger" data-target="navMenuTransparentExample">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div id="navMenuTransparentExample" class="navbar-menu">
		<a class="navbar-item" href="{{route('manage.products.create')}}">
			ДОБАВИ ПРОДУКТ
	  	</a>
		<a class="navbar-item" href="{{ route('manage.products.index') }}">
			ВСИЧКИ ПРОДУКТИ
		</a>
        <a class="navbar-item" href="{{ route('manage.promotions.index')}}">
            ПРОМОЦИИ
        </a>
        <a class="navbar-item" href="{{ route('manage.orders.index')}}">
            ПОРЪЧКИ
        </a>
		<a class="navbar-item" href="{{ route('manage.categories.index')}}">
			КАТЕГОРИИ
		</a>
		<a class="navbar-item" href="{{ route('manage.zones.index')}}">
			ГРАДОВЕ
		</a>
		<a class="navbar-item" href="{{ route('manage.shippings.index')}}">
			НАЧИНИ НА ДОСТАВКА
		</a>
		<a class="navbar-item" href="{{ route('manage.payments.index')}}">
			НАЧИНИ НА ПЛАЩАНЕ
		</a>
		<a class="navbar-item" href="{{ route('manage.statuses.index')}}">
			СТАТУСИ КЪМ ПОРЪЧКА
		</a>
		<a class="navbar-item" href="{{ route('manage.options.index')}}">
			ОПЦИИ
		</a>
    </div>
</nav>
