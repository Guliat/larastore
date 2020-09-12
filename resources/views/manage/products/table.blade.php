@extends('manage.dashboard')
@section('title', '| ВСИЧКИ ПРОДУКТИ')
@section('manage.content')
<div class="columns is-multiline" id="featured_products">
  @include('manage.products.header')
	@foreach($products as $product)
    <?php
    $promo_price = App\Promotion::where('product_id', '=', $product->id)->where('is_active', '=', 1)->first();
    $firstPhoto = \App\Product::firstPhoto($product->id);
    ?>
    <div class="column is-12 box exo">
      <div class="columns">
        <div class="column is-2">
          <div class="columns is-multiline has-text-centered">
            <div class="column is-12">
              @if($firstPhoto)
                <a href="{{ url('/images') }}/{{ $firstPhoto->photo }}" target="_blank">
                  <img style="border-radius: 50%;" src="{{asset('/images/half')}}/{{ $firstPhoto->photo }}" alt="{{ $product->name }}" title="{{ $product->name }}" />
                </a>
              @endif
            </div>
            <div class="column is-2"></div>
            <div class="column is-8 tag is-info">
              {{ $product->model }}
            </div>
            <div class="column is-2"></div>
            <div class="column is-12">
              <div class="dropdown is-hoverable">
                <div class="dropdown-trigger">
                  <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                    <span class="has-text-dark"><i class="fa fa-cog fa-lg"></i></span>
                    <span class="icon is-small">
                      <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </span>
                  </button>
                </div>
                  <div class="dropdown-menu" id="dropdown-menu" role="menu">
                    <div class="dropdown-content">
                      <div class="dropdown-item">
                        <a href="{{ route('manage.products.edit', $product->id) }}" class="dropdown-item p-l-20" target="_blank">
                          <span class="icon has-text-dark"><i class="fa fa-pencil fa-lg"></i></span>
                          <span>РЕДАКТИРАЙ</span>
                        </a>
                        <a href="{{ route('manage.photos.show', $product->id) }}" class="dropdown-item p-l-20" target="_blank">
                          <span class="icon has-text-dark"><i class="fa fa-photo fa-lg"></i></span>
                          <span>СНИМКИ</span>
                        </a>
                        @if($product->is_featured)
                        <b-modal :active.sync="mrf{{ $product->id }}">
                          <div class="box">
                            <form method="post" action="{{ route('manage.products.not.featured', $product->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                              <input type="hidden" name="product_id" value="{{ $product->id }}" />
                              <span class="is-size-5"> Искате ли да премахнете този продукт от "избрани" ?</span>
                              <hr />
                              <button type="submit" class="button is-success">ДА</button>
                              <a class="button is-danger" @click="mrf{{ $product->id }} = false">ОТКАЗ</a>
                            </form>
                          </div>
                        </b-modal>
                        <a class="dropdown-item p-l-20" @click="mrf{{ $product->id }} = true">
                          <span class="icon has-text-dark"><i class="fa fa-close fa-lg"></i></span>
                          <span>МАХНИ ОТ ИЗБРАНИ</span>
                        </a>
                        @elseif(!$product->is_featured)
                        @if($countfeatured < 10)
                        <b-modal :active.sync="maf{{ $product->id }}">
                          <div class="box">
                            <form method="post" action="{{ route('manage.products.is.featured', $product->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                              <input type="hidden" name="product_id" value="{{ $product->id }}" />
                              <span class="is-size-5"> Искате ли да направите този продукт "избран" ?</span>
                              <hr />
                              <button type="submit" class="button is-success">ДА</button>
                              <a class="button is-danger" @click="maf{{ $product->id }} = false">ОТКАЗ</a>
                            </form>
                          </div>
                        </b-modal>
                        <a class="dropdown-item p-l-20" @click="maf{{ $product->id }} = true">
                          <span class="icon has-text-dark"><i class="fa fa-check fa-lg"></i></span>
                          <span>ДОБАВИ КЪМ ИЗБРАНИ</span>
                        </a>
                        @endif
                        @endif
                        <a href="{{ url('manage/promotions/create')}}/{{ $product->id }}" class="dropdown-item p-l-20">
                          <span class="icon has-text-dark"><i class="fa fa-calculator fa-lg"></i></span>
                          <span>ПРОМОТИРАЙ</span>
                        </a>
                        <b-modal :active.sync="mrp{{ $product->id }}">
                          <div class="box">
                            <form method="post" action="{{ route('manage.products.destroy', $product->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                              <input type="hidden" name="product_id" value="{{ $product->id }}" />
                              <span class="is-size-5"> Искате ли да премахнете този продукт ?</span>
                              <hr />
                              <button type="submit" class="button is-success">ДА</button>
                              <a class="button is-danger" @click="mrp{{ $product->id }} = false">ОТКАЗ</a>
                            </form>
                          </div>
                        </b-modal>
                        <hr />
                        <a class="dropdown-item p-l-20" @click="mrp{{ $product->id }} = true">
                          <span class="icon has-text-danger"><i class="fa fa-trash fa-lg"></i></span>
                          <span>ИЗТРИЙ</span>
                        </a>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="column is-5 p-t-20">
          <span class="title is-size-5">
            <a href="{{ url($product->slug) }}" target="_blank" class="has-text-dark">
              {{ $product->name }}
            </a>
          </span>
          <br  />
          <span class="subtitle is-6">
            <b>СЪСТАВ: </b>{{ $product->fabric }}
          </span>
          <hr />
          @if($promo_price)
            <span class="tag is-large is-light has-text-danger has-text-weight-light">
              {{ $promo_price->price }}лв. /&nbsp;
              <span style="text-decoration: line-through;">{{ $product->sell_price }}лв.</span>
            </span>
          @else
            <span class="tag is-large is-light has-text-weight-light">
              {{ $product->sell_price }}лв.
            </span>
          @endif
          <hr />
          @if(!$product->is_active)
            <span class="tag is-medium is-danger">
              ИЗТРИТ
            </span>
          @endif
          @if($product->is_featured)
            <span class="tag is-success">
              ИЗБРАН
            </span>
          @endif
          @if(!$product->is_approved)
            <span class="tag is-warning">
              НЕОДОБРЕН
            </span>
          @endif
        </div>
        <div class="column is-5">
          ТАГОВЕ
          <span class="subtitle is-7 box">{{ $product->tags }}</span>
          ОПИСАНИЕ
          <span class="subtitle is-7 box">{{ $product->description }}</span>
        </div>
      </div>
    </div>
	@endforeach
</div>
<div class="columns">
	<div class="column">{{ $products->render('partials._pagination') }}</div>
</div>
@endsection
<!-- JAVASCRIPTS -->
@section('scripts')
<script>
new Vue({
	el: '#featured_products',
	data: {
		<?php
    foreach($products as $product) { echo 'maf'.$product->id.':false, '; }
    foreach($products as $product) { echo 'mrf'.$product->id.':false, '; }
    foreach($products as $product) { echo 'mrp'.$product->id.':false, '; }
    ?>
    }
})
</script>
@endsection
