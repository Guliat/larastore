@extends('manage.dashboard')
@section('title', '| GoogleAnalytics')
@section('header', 'GoogleAnalytics')
@section('manage.content')
	<div class="columns">
		<div class="column">
		<span class="is-size-5">Google Analytics Code</span>
		<hr>
			<form action="{{route('update.google_analytics')}}" method="post">
				{{csrf_field()}}
				{{method_field('put')}}
				<div class="field">
					<input type="hidden" name="id" value="{{$code->id}}" />
					<textarea class="textarea" autofocus name="code" rows="15">{{$code->google_analytics_code}}</textarea>
				</div>
				<button class="button is-success" type="submit">ОБНОВИ</button>
			</form>
		</div>
	</div>
@endsection
