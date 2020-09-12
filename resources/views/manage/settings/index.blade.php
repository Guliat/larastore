@extends('manage.main')
@section('title', '| НАСТРОЙКИ')
@section('manage.content')
<div class="columns">
	<!--    -->
	<div class="column is-one-third">
		<span class="subtitle is-3"> ### </span>
		<div class="box">
			<form method="POST" action="{{route('zones.store')}}">
				{{ csrf_field() }}
				<input type="text" name="name" autocomplete="off" placeholder="град" class="input" />
				<input type="submit" value="ДОБАВИ" class="button is-success is-fullwidth mt10" />
			</form>
		</div>
	</div>
	<!--  -->
	<div class="column">
		<span class="subtitle is-3"> ### </span>
		<div class="box">
			<table class="table is-fullwidth">
				<thead>
					<tr>
						<th>#</th>
						<th>ИМЕ</th>
						<th>ПОРЪЧКИ</th>
						<th width="7%"></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($zones as $zone)
					<tr>
						<td>{{ $zone->id }}</td>
						<td>{{ $zone->name }}</td>
						<td>TODO</td>
						<td class="has-text-centered">
							<a href="{{ route('zones.edit', $zone->id) }}" class="button is-small is-success"><i class="fa fa-pencil"></i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
