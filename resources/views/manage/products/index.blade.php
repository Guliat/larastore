@extends('manage.dashboard')

@section('title', '| ВСИЧКИ ПРОДУКТИ')

@section('manage.content')
<div class="columns is-multiline">

	<form method="post" action="{{ route('manage.products.filtered') }}">
		{{ csrf_field() }}
		<div class="select">
			<select name="category_id">
				<option value='all'>ВСИЧКИ ПРОДУКТИ</option>
				@foreach($categories as $category)
					<option value='{{ $category->id }}' @if(!empty($selected)) @if($category->id == $selected) selected @endif @endif>{{ $category->name }}</option>
				@endforeach
			</select>
		</div>
		<button type="submit" class="button is-success" @click="openLoading">ФИЛТРИРАЙ</button>
	</form>

	<div class="column is-12">
		<div class="tag is-dark">
			ОБЩО: {{ $count }}
		</div>
		<div class="tag is-dark">
			АКТИВНИ: {{ $countactive }}
		</div>
		<div class="tag is-dark">
			НЕОДОБРЕНИ: {{ $countnotapproved }}
		</div>
	</div>

	<div class="column is-12">
		<table class="table is-hoverable is-fullwidth">
			<thead>
				<th></th>
				<th>СНИМКА</th>
				<th>ИМЕ НА ПРОДУКТА</th>
				<th>МОДЕЛ</th>
				<th>ЦЕНА</th>
				<th>ПРОМО ЦЕНА</th>
				<th></th>
			</thead>
			<tbody>
				@foreach($products as $product)
					<tr>
						<td>
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
									<i class="fa fa-close fa-2x has-text-danger"></i>
								</b-tooltip>
							@endif
						</td>
						<td>
							<?php $firstPhoto = \App\Product::firstPhoto($product->id); ?>
							@if($firstPhoto)
								<img src="{{asset('/images/thumbs')}}/{{ $firstPhoto->photo }}" width="75" height="75" alt="{{ $product->name }}" title="{{ $product->name }}" />
							@endif
						</td>
						<td>
							<span class="subtitle is-5">
								<a href="{{ url($product->slug) }}" target="_blank">{{ $product->name }}</a>
							</span>
						</td>
						<td>
							<span class="subtitle is-5">{{ $product->model }}</span>
						</td>
						<td>
							<span class="subtitle is-5">{{ $product->sell_price }}лв.</span>
						</td>
						<td>
							<?php $promo_price = App\Promotion::where('product_id', '=', $product->id)->where('is_active', '=', 1)->first(); ?>
							<span class="subtitle is-5">@if($promo_price) {{ $promo_price->price }}лв. @endif</span>
						</td>
						<td>
							@if($product->is_approved == 1)
								<div class="is-pulled-right">
									@if($product->is_active == 1)
										@if(!$promo_price)
											<b-tooltip label="ПРОМОТИРАЙ" animated>
												<a href="{{ url('manage/promotions/create')}}/{{ $product->id }}" class="button is-primary is-outlined is-medium" target="_blank">
													<i class="fa fa-percent"></i>
												</a>
											</b-tooltip>
										@endif
										<b-tooltip label="РАЗГЛЕДАЙ" animated>
											<a href="{{ route('manage.products.show', $product->id) }}" class="button is-primary is-outlined is-medium" target="_blank">
												<i class="fa fa-folder-open-o"></i>
											</a>
										</b-tooltip>
										<b-tooltip label="ТЕКСТ" animated>
											<a href="{{ route('manage.products.edit', $product->id) }}" class="button is-primary is-outlined is-medium" target="_blank">
												<i class="fa fa-pencil"></i>
											</a>
										</b-tooltip>
									@endif
									<b-tooltip label="СНИМКИ" animated>
										<a href="{{ route('manage.photos.show', $product->id) }}" class="button is-primary is-outlined is-medium" target="_blank">
											<i class="fa fa-photo"></i>
										</a>
									</b-tooltip>
								</div>
							@endif
						</td>
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
@section('scripts')
<script>
    var App = new Vue({
        el: '#app',
        data: {
		 isLoading: false
	 	},
		methods: {
			openLoading() {
                const vm = this
                vm.isLoading = true
                setTimeout(() => {
                    vm.isLoading = false
                }, 3 * 1000)
            }
		}
    })
</script>
@endsection
