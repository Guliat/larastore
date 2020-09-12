@extends('manage.dashboard')
@section('title', '| ОБЩИ УСЛОВИЯ')
@section('header', 'ОБЩИ УСЛОВИЯ')
@section('manage.content')
	<div class="columns">
		<div class="column">
		<span class="is-size-5">ОБЩИ УСЛОВИЯ</span>
		<hr>
			<form action="{{route('update.terms')}}" method="post">
				{{csrf_field()}}
				{{method_field('put')}}
				<div class="field">
					<input type="hidden" name="id" value="{{$terms->id}}" />
					<textarea class="textarea" autofocus name="terms" rows="15">{{$terms->terms}}</textarea>
				</div>
				<button class="button is-success" type="submit">ОБНОВИ</button>
			</form>
		</div>
	</div>
@endsection
