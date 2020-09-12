@extends('main')
@section('title', '| ПОЛЕЗНА ИНФОРМАЦИЯ')
@section('header', 'ПОЛЕЗНА ИНФОРМАЦИЯ')
@section('content')
	<div class="columns is-marginless">
		<div class="column is-12">
			{!! $info->information !!}
		</div>
	</div>
@endsection
