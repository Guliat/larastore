@extends('manage.dashboard')
@section('title', '| ОБЩИ УСЛОВИЯ')
@section('header', 'ОБЩИ УСЛОВИЯ')
@section('manage.content')

	<div class="columns">
		<div class="column">
		<span class="is-size-5">ОБЩИ УСЛОВИЯ</span>
		<hr>
			<form action="{{route('store.terms')}}" method="post">
				{{csrf_field()}}
				<div class="field">
					<textarea class="textarea" autofocus name="terms"></textarea>
				</div>
				<button class="button is-success" type="submit">ЗАПИШИ</button>
			</form>
		</div>
	</div>

@endsection
