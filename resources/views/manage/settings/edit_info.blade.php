@extends('manage.dashboard')
@section('title', '| ПОЛЕЗНА ИНФОРМАЦИЯ')
@section('header', 'ПОЛЕЗНА ИНФОРМАЦИЯ')
@section('manage.content')
	<div class="columns">
		<div class="column">
		<span class="is-size-5">ПОЛЕЗНА ИНФОРМАЦИЯ</span>
		<hr>
			<form action="{{route('update.info')}}" method="post">
				{{csrf_field()}}
				{{method_field('put')}}
				<div class="field">
					<input type="hidden" name="id" value="{{$info->id}}" />
					<textarea class="textarea" autofocus name="information" rows="15">{{$info->information}}</textarea>
				</div>
				<button class="button is-success" type="submit">ОБНОВИ</button>
			</form>
		</div>
	</div>
@endsection
