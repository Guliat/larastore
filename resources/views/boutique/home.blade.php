@extends('main_boutique')
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

@endsection
@include('partials.buttons._backToTop')
