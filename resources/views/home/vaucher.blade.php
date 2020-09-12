@extends('main')
@section('title', '| ВАУЧЕРИ')
@section('header', 'ВАУЧЕРИ')
@section('quickMenu')
	@include('partials.buttons._back')
	@include('partials.buttons._home')
	@include('partials.buttons._cart')
@endsection
@section('content')
	<div class="columns">
		<div class="column is-half has-text-centered">
			<div class="card">
                <div class="card-header">
                    <p class="card-header-title">ПРОВЕРКА НА ВАУЧЕР</p>
                </div>
                <div class="card-content">
                    <div class="field has-addons">
                        <input class="input" type="text" />
                        <a href="#" class="button is-success">ПРОВЕРИ</a>
                    </div>
                </div>
            </div>
		</div>
        <div class="column is-half has-text-centered" style="border: 1px solid #ccc;">
            <br /><br />
            БАНЕР
            <br /><br />
        </div>
	</div>
@endsection
