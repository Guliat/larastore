@extends('manage.dashboard')

@section('title', '| КАТЕГОРИИ')
@section('header', 'КАТЕГОРИИ')

@section('manage.content')
<div class="columns">
	<!-- NEW CATEGORY BOX -->
	<div class="column is-one-third">
		<div class="columns is-multiline">
			<div class="column is-12">
				<span class="is-size-4">НОВА КАТЕГОРИЯ</span>
				<div class="box">
					<form method="POST" action="{{route('manage.categories.store')}}">
						{{ csrf_field() }}
						<input type="text" name="name" autocomplete="off" placeholder="категория" class="input" />
						<input type="submit" value="ДОБАВИ" class="button is-success is-fullwidth m-t-10" />
					</form>
				</div>
			</div>
			<div class="column is-12">
				<span class="is-size-4">ИЗТРИТИ КАТЕГОРИИ</span>
				<div class="box">
					@foreach ($deletedcategories as $deletedcategory)
						<span class="subtitle">
							- {{ $deletedcategory->name }}
							<br />
						</span>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<!-- LIST ALL CATEGORIES BOX -->
	<div class="column">
		<span class="is-size-4">ВСИЧКИ КАТЕГОРИИ</span>
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
					@foreach ($categories as $category)
					<tr>
						<td style="width: 70px;">
							<form method="post" action="{{ route('manage.categories.delete', $category->id) }}" method="post">
									{{ csrf_field() }}
									{{ method_field('put') }}
									<button type="submit" class="button is-danger is-inverted">
										<i class="fa fa-trash fa-lg"></i>
									</button>
							</form>
						</td>
						<td>{{ $category->id }}</td>
						<td>{{ $category->name }}</td>
						<td><a href="{{route('slug', $category->slug)}}">{{ $category->slug }}</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div> {{ $categories->render('manage.partials._pagination') }} </div>
		</div>
	</div>
</div>
@endsection
