<ul class="menu-list has-text-centered">
    <li>
        <ul>
            <li>
                <a href="{{route('manage.dashboard')}}" class="@if(Route::current()->getName() == "manage.dashboard") is-active @endif">
                    НАЧАЛО
                </a>
            </li>
            <li>
                <a href="{{ route('manage.orders.index')}}" class="@if(Route::current()->getName() == "manage.orders.index") is-active @endif">
                    ПОРЪЧКИ
                </a>
            </li>
            <li>
                <a href="{{route('manage.products.create')}}">
                    ДОБАВИ ПРОДУКТ
                </a>
            </li>
            <li>
                <a href="{{ route('manage.products.index') }}" class="@if(Route::current()->getName() == "manage.products.index") is-active @endif">
                    ВСИЧКИ ПРОДУКТИ
                </a>
            </li>
            <li>
                <a href="{{ route('manage.promotions.index')}}">
                    ПРОМОЦИИ
                </a>
            </li>
            <li>
                <a href="{{ route('manage.orders.stats') }}">
                    СТАТИСТИКА
                </a>
            </li>
            <li>
                <a href="{{ route('manage.categories.show')}}">
                    КАТЕГОРИИ
                </a>
            </li>
            <li>
                <a href="{{ route('manage.subcategories.show')}}">
                    ПОДКАТЕГОРИИ
                </a>
            </li>
            <li>
                <a href="{{ route('manage.zones.index')}}">
                    ГРАДОВЕ
                </a>
            </li>
            <li>
                <a href="{{ route('manage.shippings.index')}}">
                    НАЧИНИ НА ДОСТАВКА
                </a>
            </li>
            <li>
                <a href="{{ route('manage.payments.index')}}">
                    НАЧИНИ НА ПЛАЩАНЕ
                </a>
            </li>
            <li>
                <a href="{{ route('manage.statuses.index')}}">
                    СТАТУСИ КЪМ ПОРЪЧКА
                </a>
            </li>
            <li>
                <a href="{{ route('manage.options.index')}}">
                    ОПЦИИ
                </a>
            </li>
        </ul>
    </li>
</ul>
