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
	@include('partials.banners.homeTop')
	@include('partials._collections')
	{{-- @include('partials._last_products') --}}
	{{-- @include('partials._featured_products') --}}
	{{-- @include('partials._last_promo_products') --}}
	{{-- @include('partials._expire_promo_products') --}}
@endsection
@include('partials.buttons._backToTop')
