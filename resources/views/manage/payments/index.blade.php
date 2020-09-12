@extends('manage.dashboard')
@section('title', '| НАЧИНИ НА ПЛАЩАНЕ')
@section('header', 'НАЧИНИ НА ПЛАЩАНЕ')
@section('manage.content')
<div class="columns">
	<!-- NEW PAYMENT METHOD BOX -->
	<div class="column is-one-third" id="payments">
		<span class="subtitle is-size-5">НОВ НАЧИН НА ПЛАЩАНЕ</span>
		<div class="box m-t-20">
			<form method="POST" action="{{route('manage.payments.store')}}">
				{{ csrf_field() }}
				<input type="text" name="name" autocomplete="off" placeholder="начин на плащане" class="input" />
				<button type="submit" class="button is-success is-fullwidth m-t-10" :class="{'is-loading': loading}" @click="loading = true"/>
					ДОБАВИ
				</button>
			</form>
		</div>
	</div>
	<!-- LIST ALL PAYMENT METHODS BOX -->
	<div class="column">
		<span class="subtitle is-size-5">ВСИЧКИ НАЧИНИ НА ПЛАЩАНЕ</span>
		<div class="box m-t-20">
			<table class="table is-fullwidth">
				<thead>
					<tr>
						<th>#</th>
						<th>ИМЕ</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($payments as $payment)
					<tr>
						<td>{{ $payment->id }}</td>
						<td>{{ $payment->name }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div> {{ $payments->render('partials._pagination') }} </div>
	</div>
</div>
@endsection
@section('scripts')
<script>
new Vue({
    el: '#payments',
    data: {
			loading: false,
    },
})
</script>
@endsection
