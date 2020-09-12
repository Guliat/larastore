@extends('manage.dashboard')

@section('title', '| ГРАДОВЕ')
@section('header', 'ГРАДОВЕ')

@section('manage.content')
<div class="columns">
	<!-- NEW ZONE BOX -->
	<div class="column is-one-third">
		<span class="is-size-4">НОВ ГРАД</span>
		<div class="box">
			<form method="POST" action="{{route('manage.zones.store')}}">
				{{ csrf_field() }}
				<input type="text" name="name" autocomplete="off" placeholder="град" class="input" />
				<input type="submit" value="ДОБАВИ" class="button is-success is-fullwidth m-t-10" />
			</form>
		</div>
	</div>
	<!-- LIST ALL ZONES BOX -->
	<div class="column">
		<span class="is-size-4">ВСИЧКИ ГРАДОВЕ</span>
		<div class="box">
			<table class="table is-fullwidth">
				<thead>
					<tr>
						<th>#</th>
						<th>ИМЕ</th>
						<th>ПОРЪЧКИ</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($zones as $zone)
					<tr>
						<td>{{ $zone->id }}</td>
						<td>{{ $zone->name }}</td>
						<td>TODO</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div> {{ $zones->render('partials._pagination') }} </div>
	</div>
</div>
@endsection
