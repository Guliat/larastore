@extends('main')
@section('content')
<div class="columns is-centered">
	<div class="column is-3 my-6">
		<div class="box">
			<form method="POST" action="{{ route('login') }}">
				@csrf
				<label class="label">Email</label>
				<input class="input" type="email" name="email" :value="old('email')" required autofocus />
				<label class="label mt-3">Password</label>
				<input class="input" type="password" name="password" required autocomplete="current-password" />
				<input type="checkbox" class="mt-5" name="remember">
				<span>Remember Me</span>
				<br />
				<button type="submit" class="button is-success">Login</button>
			</form>
		</div>
	</div>
</div>
@endsection