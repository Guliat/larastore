@extends('manage.dashboard')
@section('title', '| ПРОМО ПРОДУКТ')
@section('header', 'ПРОМО ПРОДУКТ')
@section('manage.content')
<div class="columns">
	<div class="column is-8 is-offset-2">
		<div class="has-text-centered">
			<a href="javascript:window.open('','_self').close();" class="button is-medium is-danger m-b-30">
				<i class="fa fa-times m-r-10"></i> ЗАТВОРИ
			</a>
		</div>
		<div class="box">
			<article class='media'>
				<div class="media-left">
					<?php $firstPhoto = \App\Product::firstPhoto($product->id); ?>
					<img src="{{asset('/images/half')}}/{{ $firstPhoto->photo }}" width="100%" height="100%" />
				</div>
				<div class="media-content">
					<div class="content is-size-5">
						<span class="is-size-3">{{ $product->name }}</span><br /><br />
						<strong>от</strong> {{$promotion->start}} <br>
						<strong>до</strong> {{$promotion->end}} <br>
						<span class="is-size-3 has-text-danger">{{ $promotion->price }}лв.</span>
						<hr />
						<small>СТАРА ЦЕНА:</small> {{ $product->sell_price }}лв.<br />
						<small>МОДЕЛ:</small> {{ $product->model }}
					</div>
				</div>
			</article>
		</div>
	</div>
</div>
@endsection
