@extends('manage.dashboard')
@section('title', '| СТАТУСИ КЪМ ПОРЪЧКИ')
@section('header', 'СТАТУСИ КЪМ ПОРЪЧКИ')
@section('manage.content')
<div class="columns">
	<!-- NEW STATUS BOX -->
	<div class="column is-one-third">
		<span class="is-size-4">НОВ СТАТУС</span>
		<div class="box">
			<form method="POST" action="{{route('manage.statuses.store')}}">
				{{ csrf_field() }}
				<input type="text" name="name" autocomplete="off" placeholder="статус" class="input" />
				<input type="submit" value="ДОБАВИ" class="button is-success is-fullwidth m-t-10" />
			</form>
		</div>
	</div>
	<!-- LIST ALL STATUSES BOX -->
	<div class="column">
		<span class="is-size-4">ВСИЧКИ СТАТУСИ</span>
		<div class="box">
			<table class="table is-fullwidth">
				<thead>
					<tr>
						<th>#</th>
						<th>ИМЕ</th>
						<th>БРОЙ</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($statuses as $status)
					<tr>
						<td>{{ $status->id }}</td>
						<td>{{ $status->name }}</td>
						<td>TODO</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div> {{ $statuses->render('partials._pagination') }} </div>
	</div>
</div>
@endsection
