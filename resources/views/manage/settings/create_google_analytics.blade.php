@extends('manage.dashboard')
@section('title', '| GoogleAnalytics')
@section('header', 'GoogleAnalytics')
@section('manage.content')

	<div class="columns">
		<div class="column">
		<span class="is-size-5">Google Analytics Code</span>
		<hr>
			<form action="{{route('store.google_analytics')}}" method="post">
				{{csrf_field()}}
				<div class="field">
					<textarea class="textarea" autofocus name="code"></textarea>
				</div>
				<button class="button is-success" type="submit">ЗАПИШИ</button>
			</form>
		</div>
	</div>

@endsection
