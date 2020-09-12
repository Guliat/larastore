@extends('manage.dashboard')

@section('title', '| ПОДКАТЕГОРИИ')
@section('header', 'ПОДКАТЕГОРИИ')

@section('manage.content')
<div class="columns">
	<!-- NEW SUBCATEGORY BOX -->
	<div class="column is-one-third">
		<div class="columns is-multiline">
			<div class="column is-12">
				<span class="is-size-4">НОВА ПОДКАТЕГОРИЯ</span>
				<div class="box">
					<form method="POST" action="{{route('manage.subcategories.store')}}">
						{{ csrf_field() }}
						<input type="text" name="name" autocomplete="off" placeholder="подкатегория" class="input" />
						<input type="submit" value="ДОБАВИ" class="button is-success is-fullwidth m-t-10" />
					</form>
				</div>
			</div>
			<div class="column is-12">
				<span class="is-size-4">ИЗТРИТИ ПОДКАТЕГОРИИ</span>
				<div class="box">
					@foreach ($deletedsubcategories as $deletedsubcategory)
						<span class="subtitle">
							- {{ $deletedsubcategory->name }}
							<br />
						</span>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<!-- LIST ALL SUBCATEGORIES BOX -->
	<div class="column">
		<span class="is-size-4">ВСИЧКИ ПОДКАТЕГОРИИ</span>
		<div class="box">
			<table class="table is-fullwidth">
				<thead>
					<tr>
						<th></th>
						<th><b>#</b></th>
						<th><b>ИМЕ</b></th>
						<th>SLUG</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($subcategories as $subcategory)
					<tr>
						<td style="width: 70px;">
							<form method="post" action="{{ route('manage.subcategories.delete', $subcategory->id) }}" method="post">
									{{ csrf_field() }}
									{{ method_field('put') }}
									<button type="submit" class="button is-danger is-inverted">
										<i class="fa fa-trash fa-lg"></i>
									</button>
							</form>
						</td>
						<td>{{ $subcategory->id }}</td>
						<td>{{ $subcategory->name }}</td>
						<td><a href="{{route('slug', $subcategory->slug)}}">{{ $subcategory->slug }}</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div> {{ $subcategories->render('manage.partials._pagination') }} </div>
		</div>
	</div>
</div>
@endsection
