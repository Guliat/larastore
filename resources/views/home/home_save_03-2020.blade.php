@extends('main')
<?php
	$header = "НАЧАЛО";
	$metaTitle = config('app.name');
	$metaDescription = config('app.description');
	$metaURL = config('app.url');
	$metaImage = asset('/').config('app.prefix').('meta-logo.png');
?>
@section('header', $header)
@section('meta-title', "$metaTitle")
@section('meta-description', "$metaDescription")
@section('meta-url', "$metaURL")
@section('meta-image', "$metaImage")
@section('content')
	<div class="columns is-multiline"><!-- HOME COLUMNS START -->
		<!-- BANNER -->
			{{-- <div class="column is-2"></div> --}}
			<div class="column is-12 has-text-centered">
				@include('partials.banners.home-top')
			</div>
			{{-- <div class="column is-2"></div> --}}
		<!-- BANNER END -->
		<div class="column is-12"><!-- LAST PRODUCTS -->
			@include('partials._last_products')
		</div><!-- LAST PRODUCTS END -->
		<div class="column is-12 has-text-centered">
		  <div class="notification is-light hero-body">
		    <span class="is-size-4">БЕЗПЛАТНА ДОСТАВКА</span> <br />
		    <span class="is-size-6">за поръчки над 100лв.</span>
		  </div>
		{{-- <section class="hero is-light">
		  <div class="hero-body">
		    <div class="container">
		      <h1 class="title">
		        Hero title
		      </h1>
		      <h2 class="subtitle">
		        Hero subtitle
		      </h2>
		    </div>
		  </div>
		</section> --}}

		</div>
		<div class="column is-12"><!-- FEATURED PRODUCTS -->
			@include('partials._featured_products')
		</div><!-- FEATURED PRODUCTS END -->
		<div class="column is-12"><!-- LAST PROMO PRODUCTS -->
			@include('partials._last_promo_products')
		</div><!-- LAST PROMO PRODUCTS END -->
		<div class="column is-12"><!-- EXPIRE PROMO PRODUCTS -->
			@include('partials._expire_promo_products')
		</div><!-- EXPIRE PROMO PRODUCTS END -->
	</div><!-- HOME COLUMNS END -->
@endsection
@include('partials.buttons._backToTop')
