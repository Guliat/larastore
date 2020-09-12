@extends('manage.dashboard')
@section('title', '| ВСИЧКИ ПРОДУКТИ')
@section('manage.content')
<div class="columns is-multiline" id="featured_products">
  @include('manage.products.header')
	<div class="column is-12 p-l-50 p-r-30" style="overflow-x: auto;">
		<table class="table is-hoverable is-fullwidth is-narrow is-bordered">
			<thead class="is-size-7">
				<th></th>
                <th>ИЗБРАН</th>
				<th>СНИМКА</th>
				<th>ИМЕ НА ПРОДУКТА</th>
                <th>ТАГОВЕ</th>
                <th>СЪСТАВ</th>
                <th>ОПИСАНИЕ</th>
				<th>МОДЕЛ</th>
				<th>СТАНДАРТНА ЦЕНА</th>
				<th>ПРОМО ЦЕНА</th>
			</thead>
			<tbody>
				@foreach($products as $product)
                    <?php $promo_price = App\Promotion::where('product_id', '=', $product->id)->where('is_active', '=', 1)->first(); ?>
					<tr>
						<td class="has-text-centered">
							@if($product->is_approved == 1 && $product->is_active == 1)
								<b-tooltip label="АКТИВЕН И ПУСНАТ" animated>
									<i class="fa fa-check fa-2x has-text-success"></i>
								</b-tooltip>
							@elseif($product->is_approved == 0)
						  		<b-tooltip label="РАЗГЛЕДАЙ И ПУСНИ" animated>
									<a href="{{ route('manage.products.show', $product->id) }}" class="button is-primary" target="_blank"><i class="fa faa-ring animated fa-check fa-lg"></i></a>
						  		</b-tooltip>
							@elseif($product->is_active == 0)
								<b-tooltip label="ИЗТРИТ" animated>
									<i class="fa fa-close fa-2x has-text-danger p-t-20"></i>
								</b-tooltip>
							@endif
                            <br />
                            @if($product->is_approved == 1)
                                @if($product->is_active == 1)
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
                                                    <a href="{{ route('manage.products.show', $product->id) }}" class="dropdown-item" target="_blank">РАЗГЛЕДАЙ</a>
                                                    <a href="{{ route('manage.products.edit', $product->id) }}" class="dropdown-item" target="_blank">РЕДАКТИРАЙ</a>
                                                    <a href="{{ route('manage.photos.show', $product->id) }}" class="dropdown-item" target="_blank">СНИМКИ</a>
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
                                                    <a class="dropdown-item" target="_blank" @click="mrp{{ $product->id }} = true">
                                                      <span class="icon has-text-danger"><i class="fa fa-trash fa-lg"></i></span>
                                                      <span>ИЗТРИЙ</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
						</td>
                        <td class="has-text-centered p-t-30">
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
                                <a @click="mrf{{ $product->id }} = true" class="button" data-tooltip="ПРЕМАХНИ ПРОДУКТА ОТ ИЗБРАНИ"><i class="fa fa-close fa-lg has-text-danger"></i></a>
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
                                    <a @click="maf{{ $product->id }} = true" class="button" data-tooltip="НАПРАВИ ПРОДУКТА ИЗБРАН"><i class="fa fa-check fa-lg has-text-success"></i></a>
                                @endif
                            @endif
                        </td>
						<td>
							<?php $firstPhoto = \App\Product::firstPhoto($product->id); ?>
							@if($firstPhoto)
								<img src="{{asset('/images/thumbs')}}/{{ $firstPhoto->photo }}" width="75" height="75" alt="{{ $product->name }}" title="{{ $product->name }}" />
							@endif
						</td>
						<td><span class="subtitle is-7"><a href="{{ url($product->slug) }}" target="_blank">{{ $product->name }}</a></span></td>
                        <td><span class="subtitle is-7">{{ $product->tags }}</span></td>
                        <td><span class="subtitle is-7">{{ $product->fabric }}</span></td>
                        <td><span class="subtitle is-7">{{ $product->description }}</span></td>
						<td class="has-text-centered p-t-30 subtitle is-7">{{ $product->model }}</td>
						<td class="has-text-centered p-t-30 subtitle is-7">{{ $product->sell_price }}лв.</td>
                        @if($promo_price)
    						<td class="has-text-centered p-t-30 subtitle is-7">
                                {{ $promo_price->price }}лв.
                            </td>
                        @else
                            <td class="has-text-centered p-t-20">
                                <a href="{{ url('manage/promotions/create')}}/{{ $product->id }}" class="button" data-tooltip="ПРОМОТИРАЙ"><i class="fa fa-calculator fa-lg has-text-primary"></i></a>
                            </td>
                        @endif
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
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
