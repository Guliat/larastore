@extends('main')
<?php $header = "НАЧАЛО";
$metaTitle = config('app.name');
$metaDescription = config('app.description');
$metaURL = config('app.url');
$metaImage = asset('/').config('app.logo');
?>
@section('title', "")
@section('header', "$header")
@section('meta-title', "$metaTitle")
@section('meta-description', "$metaDescription")
@section('meta-url', "$metaURL")
@section('meta-image', "$metaImage")

<!-- QUICK MENU -->
@section('quickMenu')
	<a href="{{ route('search.index')}}" class="button is-dark is-medium m-b-5"><i class="fa fa-search"></i></a>
	@include('partials.buttons._cart')
	<div class="is-hidden-desktop">@include('partials._categoryDropDown')</div>
@endsection
<!-- CONTENT -->
@section('content')
<div class="container">
	<div class="columns">
		@include('partials._categoryMenuBlock')
		<div class="column">
			<!-- NEW PRODUCTS BLOCK -->
			{{-- <div class="is-divider" data-content="ПОСЛЕДНО ДОБАВЕНИ"></div> --}}
			<div class="columns is-multiline">
				<?php
				    $today = date('Y-m-d');
				    $products = App\Product::where('is_active', 1)->where('is_approved', 1)->orderBy('created_at', 'desc')->paginate(8);
				?>
				@foreach($products as $product)
			    	<div class="column is-one-quarter">
						@include('partials._newProductCard')
					</div>
				@endforeach
			</div>
			<!-- PROMOTIONS BLOCK -->
			<div class="is-divider" data-content="ПРОМОЦИИ"></div>
			<div class="columns is-multiline">
				<?php
				$today = date('Y-m-d');
				$promotions = App\Promotion::where('end', '>', $today)->orderBy('end', 'asc')->paginate(4);
				?>
				@foreach($promotions as $promotion)
					<div class="column is-one-quarter">
						@include('partials._promoProductCard')
					</div>
				@endforeach
			</div>
			<!-- FAST BUTTONS BLOCK -->
			<div class="is-divider" data-content="{{ config('app.name') }}"></div>
			<div class="columns is-centered">
				<div class="column has-text-centered"><a href="{{ route('products.all') }}" class="button is-outlined is-primary">ВСИЧКИ ПРОДУКТИ</a></div>
				<div class="column has-text-centered"><a href="{{ route('products.new') }}" class="button is-outlined is-primary">ВСИЧКИ НОВИ ПРОДУКТИ</a></div>
				<div class="column has-text-centered"><a href="{{ route('products.promo') }}" class="button is-outlined is-primary">ВСИЧКИ ПРОМОЦИИ</a></div>
			</div>
		</div>
	</div>
</div>
@endsection
<!-- BACK TO TOP BUTTON -->
@include('partials.buttons._backToTop')
