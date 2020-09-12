@extends('main')

<?php
$header = config('app.name');
$metaURL = config('app.url');
?>

@section('header', "$header")
@section('meta-title', "$header")
@section('meta-url', "$metaURL")

@section('quickMenu')
    @include('partials.buttons._back')
    @include('partials.buttons._home')
    @include('partials.buttons._cart')
@endsection

@section('content')

<div class="columns is-centered is-multiline">
    {{-- @include('partials._categoryMenuBlock') --}}
    <div class="column has-text-centered is-size-4 m-t-50">
        ТЪРСЕНАТА СТРАНИЦА НЕ СЪЩЕСТВУВА.
    </div>
</div>

@endsection
