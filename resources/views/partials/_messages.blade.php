@if (Session::has('success'))

{{--
<b-notification type="is-success" id="successnotify">
	{!! Session::get('success') !!}
</b-notification>
--}}
<div id="success_toast" @click="success"></div>

@endif

@if (Session::has('notsuccess'))

	<b-notification type="is-danger" id="dangernotify">
		{{ Session::get('notsuccess') }}
	</b-notification>

@endif

@if (count($errors) > 0)
	<b-notification type="is-danger" id="dangernotify">
		{{-- <ul> --}}
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		{{-- </ul> --}}
	</b-notification>
@endif
