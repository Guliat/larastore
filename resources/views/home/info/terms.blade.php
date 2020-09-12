@extends('main')
@section('title', '| ОБЩИ УСЛОВИЯ')
@section('header', 'ОБЩИ УСЛОВИЯ')
@section('content')
	<div class="columns is-multiline is-marginless">
		<div class="column">
			{!! $terms->terms !!}
		</div>
	</div>
@endsection
