<div class="column is-one-fifth is-hidden-mobile">
    <aside class="menu" id="categoryMenuBlock">
        <p class="menu-label is-size-5 has-text-primary">ПРОДУКТИ</p>
        <?php $data = new App\Category; $categories = $data->orderBy('name', 'asc')->get();?>
        <ul class="menu-list has-text-centered">
            <li>
                <ul>
                    {{-- <li>
                        <a href="{{route('home')}}" class="is-size-5 @if($header == "НАЧАЛО") is-active @endif">НАЧАЛО</a>
                    </li> --}}
                    <li>
                        <a href="{{route('search.index')}}" class="is-size-5"><i class="fa fa-search"></i> ТЪРСЕНЕ</a>
                    </li>
                    <li>
                        <a href="{{route('cart.show')}}" class="is-size-5"><i class="fa fa-shopping-bag"></i> КОШНИЦА</a>
                    </li>
                    <li>
                        <a href="{{route('products.all')}}" class="is-size-5 @if($header == "ВСИЧКИ") is-active @endif">ВСИЧКИ</a>
                    </li>
                    <li>
                        <a href="{{route('products.new')}}" class="is-size-5 @if($header == "НОВИ") is-active @endif">НОВИ</a>
                    </li>
                    <li>
                        <a href="{{route('products.promo')}}" class="is-size-5  @if($header == "ПРОМОЦИИ") is-active @endif">ПРОМОЦИИ</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{$category->slug}}" class="is-size-5 @if($category->name == $header) is-active @endif">{{$category->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </aside>
</div>
