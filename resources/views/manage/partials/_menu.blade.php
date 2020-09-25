<a href="{{route('manage.dashboard')}}" class="item @if(Route::current()->getName() == "manage.dashboard") active @endif">
  <span class="icon">
    <i class="fa fa-home"></i>
  </span>
  <span class="name">
    НАЧАЛО
  </span>
</a>
<a href="{{route('manage.orders.index')}}" class="item @if(Route::current()->getName() == "manage.orders.index") active @endif">
  <span class="icon">
    <i class="fa fa-archive"></i>
  </span>
  <span class="name">
    ПОРЪЧКИ
  </span>
</a>
<a href="{{route('manage.products.create')}}" class="item @if(Route::current()->getName() == "manage.products.create") active @endif">
  <span class="icon">
    <i class="fa fa-plus"></i>
  </span>
  <span class="name">
    ДОБАВИ ПРОДУКТ
  </span>
</a>
<a href="{{route('manage.products.index')}}" class="item @if(Route::current()->getName() == "manage.products.index") active @endif">
  <span class="icon">
    <i class="fa fa-list-ol"></i>
  </span>
  <span class="name">
    ВСИЧКИ ПРОДУКТИ
  </span>
</a>
<a href="{{route('manage.promotions.index')}}" class="item @if(Route::current()->getName() == "manage.promotions.index") active @endif">
  <span class="icon">
    <i class="fa fa-percent"></i>
  </span>
  <span class="name">
    ПРОМОЦИИ
  </span>
</a>
<a href="{{route('manage.categories.show')}}" class="item @if(Route::current()->getName() == "manage.categories.show") active @endif">
  <span class="icon">
    <i class="fa fa-th-list"></i>
  </span>
  <span class="name">
    КАТЕГОРИИ
  </span>
</a>
<a href="{{route('manage.subcategories.show')}}" class="item @if(Route::current()->getName() == "manage.subcategories.show") active @endif">
  <span class="icon">
    <i class="fa fa-list"></i>
  </span>
  <span class="name">
    ПОДКАТЕГОРИИ
  </span>
</a>
<a href="{{route('manage.zones.index')}}" class="item @if(Route::current()->getName() == "manage.zones.index") active @endif">
  <span class="icon">
    <i class="fa fa-globe"></i>
  </span>
  <span class="name">
    ГРАДОВЕ
  </span>
</a>
<a href="{{route('manage.shippings.index')}}" class="item @if(Route::current()->getName() == "manage.shippings.index") active @endif">
  <span class="icon">
    <i class="fa fa-truck"></i>
  </span>
  <span class="name">
    НАЧИНИ НА ДОСТАВКА
  </span>
</a>
<a href="{{route('manage.payments.index')}}" class="item @if(Route::current()->getName() == "manage.payments.index") active @endif">
  <span class="icon">
    <i class="fa fa-credit-card"></i>
  </span>
  <span class="name">
    НАЧИНИ НА ПЛАЩАНЕ
  </span>
</a>
<a href="{{route('manage.statuses.index')}}" class="item @if(Route::current()->getName() == "manage.statuses.index") active @endif">
  <span class="icon">
    <i class="fa fa-check"></i>
  </span>
  <span class="name">
    СТАТУСИ КЪМ ПОРЪЧКА
  </span>
</a>
<a href="{{route('manage.options.index')}}" class="item @if(Route::current()->getName() == "manage.options.index") active @endif">
  <span class="icon">
    <i class="fa fa-filter"></i>
  </span>
  <span class="name">
    ОПЦИИ
  </span>
</a>