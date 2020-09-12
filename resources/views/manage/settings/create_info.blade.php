@extends('manage.dashboard')
@section('title', '| ПОЛЕЗНА ИНФОРМАЦИЯ')
@section('header', 'ПОЛЕЗНА ИНФОРМАЦИЯ')
@section('manage.content')
	<div class="columns">
		<div class="column">
		<span class="is-size-5">ПОЛЕЗНА ИНФОРМАЦИЯ</span>
		<hr>
			<form action="{{route('store.info')}}" method="post">
				{{csrf_field()}}
				<div class="field">
					<textarea class="textarea" autofocus name="information"></textarea>
				</div>
				<button class="button is-success" type="submit">ЗАПИШИ</button>
			</form>
		</div>
	</div>
@endsection
