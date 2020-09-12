@extends('manage.dashboard')
@section('title', '| АКТИВНИ ПРОМОЦИИ')
@section('header', 'АКТИВНИ ПРОМОЦИИ')
@section('manage.content')
<div class="columns is-multiline box">
	<div class="column is-12">
		<div class="tag is-warning is-medium">
			ОБЩО ПРОМОЦИИ
		</div>
		<div class="tag is-danger is-large">
			{{ $total }}
		</div>
	</div>
	<div class="column is-12">
		<a href="{{route('manage.promotions.create.to.category')}}" type="submit" class="button is-info" >ДОБАВИ ОТСЪПКА (лв.) КЪМ КАТЕГОРИЯ</a>
		<a href="{{route('manage.promotions.create.with.percent.all')}}" type="submit" class="button is-info" >ДОБАВИ ОТСЪПКА (%) ЗА ВСИЧКИ ПРОДУКТИ</a>
	</div>
	@foreach($promotions as $promotion)
	<div class="column is-one-fifth">
		<a href="{{route('manage.promotions.show', $promotion->id)}}">
			<div class="card">
				<div class="card-image">
					<?php $firstPhoto = \App\Product::firstPhoto($promotion->product->id); ?>
					<img src="{{asset('/images/half')}}/{{ $firstPhoto->photo }}" width="100%" height="100%" />
				</div>
				<div class="card-content is-size-6">
					<div class="has-text-centered">
						ЦЕНА: <span class="is-size-4 has-text-danger">{{ $promotion->price }}лв.</span><br>
						от {{date('d M Y', strtotime($promotion->start))}} до {{date('d M Y', strtotime($promotion->end))}}
					</div>
					<hr>
					СТАРА ЦЕНА: <span class="is-size-4 has-text-danger">{{ $promotion->product->sell_price }}лв.</span><br>
					ПРОДУКТ: {{ $promotion->product->name }}<br>
					МОДЕЛ: {{ $promotion->product->model }}<br>
				</div>
			</div>
		</a>
	</div>
	@endforeach
	<div class="column is-12"> {{ $promotions->render('manage.partials._pagination') }} </div>
</div>
@endsection
