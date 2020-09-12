@extends('manage.dashboard')
@section('title', '| ИЗТРИТИ ПРОДУКТИ')
@section('manage.content')
<div class="columns is-multiline" id="featured_products">
	<div class="column is-12 p-l-50 p-r-30" style="overflow-x: auto;">
		<table class="table is-hoverable is-fullwidth is-narrow is-bordered">
			<thead class="is-size-7">
        <th></th>
				<th>СНИМКА</th>
        <th>МОДЕЛ</th>
				<th>ИМЕ НА ПРОДУКТА</th>
        <th>СЪСТАВ</th>
				<th>ЦЕНА</th>
			</thead>
			<tbody>
				@foreach($products as $product)
					<tr>
            <td class="has-text-centered p-t-40">
              <a href="{{ route('manage.products.edit', $product->id) }}" class="button is-success is-small is-rounded">РЕДАКТИРАЙ</a>
            </td>
						<td>
							<?php $firstPhoto = \App\Product::firstPhoto($product->id); ?>
							@if($firstPhoto)
								<img src="{{asset('/images/thumbs')}}/{{ $firstPhoto->photo }}" width="100" height="100" alt="{{ $product->name }}" title="{{ $product->name }}" />
							@endif
						</td>
            <td class="has-text-centered subtitle is-7 p-t-50">{{ $product->model }}</td>
						<td class="subtitle is-7">{{ $product->name }}</td>
            <td class="subtitle is-7">{{ $product->fabric }}</td>
						<td class="has-text-centered subtitle is-7">{{ $product->sell_price }}лв.</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
  <div class="column">{{ $products->render('partials._pagination') }}</div>
</div>
@endsection
