@extends('manage.dashboard')

@section('title', '| НАЧИНИ НА ДОСТАВКА')
@section('header', 'НАЧИНИ НА ДОСТАВКА')

@section('manage.content')
<div class="columns">
	<!-- NEW SHIPPING METHOD BOX -->
	<div class="column is-one-third">
		<span class="is-size-4">НОВ НАЧИН НА ДОСТАВКА</span>
		<div class="box">
			<form method="POST" action="{{route('manage.shippings.store')}}">
				{{ csrf_field() }}
				<input type="text" name="name" autocomplete="off" placeholder="начин на доставка" class="input" />
				<input type="text" name="price" autocomplete="off" placeholder="цена" class="input m-t-10" />
				<input type="submit" value="ДОБАВИ" class="button is-success is-fullwidth m-t-10" />
			</form>
		</div>
	</div>
	<!-- LIST ALL SHIPPING METHODS BOX -->
	<div class="column">
		<span class="is-size-4">ВСИЧКИ НАЧИНИ НА ДОСТАВКА</span>
		<div class="box">
			<table class="table is-fullwidth">
				<thead>
					<tr>
						<th>#</th>
						<th>ИМЕ</th>
						<th>ЦЕНА</th>
						<th>ПРАТКИ</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($shippings as $shipping)
					<tr>
						<td>{{ $shipping->id }}</td>
						<td>{{ $shipping->name }}</td>
						<th>{{ $shipping->price }} лв.</th>
						<td>TODO</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div> {{ $shippings->render('partials._pagination') }} </div>
	</div>
</div>
@endsection
