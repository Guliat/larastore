@extends('main')
<?php $header = htmlspecialchars($category); ?>
@section('title', "| $header")
@section('header', "$header")
@section('content')
<div class="columns is-multiline is-marginless is-mobile">
	<div class="column is-6 has-text-left">
		{{-- @include('partials.buttons._back') --}}
		<div class="dropdown is-hoverable">
		  <div class="dropdown-trigger">
		    <button class="button is-danger is-outlined is-rounded" aria-haspopup="true" aria-controls="dropdown-menu4">
					<span class="icon">
						<i class="fa fa-sort-amount-desc"></i>
					</span>
		      <span class="icon">
		        <i class="fa fa-angle-down" aria-hidden="true"></i>
		      </span>
		    </button>
		  </div>
		  <div class="dropdown-menu" id="dropdown-menu4" role="menu">
		    <div class="dropdown-content">
					<form method="post" action="{{ route('filter.category.newest') }}">
						{{ csrf_field() }}
						{{ method_field('put') }}
						<button type="submit" class="dropdown-item button @if(Session::get('category_sort') == 'newest') is-danger is-outlined @else is-white @endif" >
							нови > стари
						</button>
					</form>
					<hr class="dropdown-divider">
					<form method="post" action="{{ route('filter.category.oldest') }}">
						{{ csrf_field() }}
						{{ method_field('put') }}
						<button type="submit" class="dropdown-item button @if(Session::get('category_sort') == 'oldest') is-danger is-outlined @else is-white @endif" >
							стари > нови
						</button>
					</form>
					<hr class="dropdown-divider">
					<form method="post" action="{{ route('filter.category.low') }}">
						{{ csrf_field() }}
						{{ method_field('put') }}
						<button type="submit" class="dropdown-item button @if(Session::get('category_sort') == 'hightolow') is-danger is-outlined @else is-white @endif" >
							скъпи > евтини
						</button>
					</form>
					<hr class="dropdown-divider">
						<form method="post" action="{{ route('filter.category.high') }}">
	            {{ csrf_field() }}
	            {{ method_field('put') }}
	            <button type="submit" class="dropdown-item button @if(Session::get('category_sort') == 'lowtohigh') is-danger is-outlined @else is-white @endif" >
								евтини > скъпи
	            </button>
	        	</form>
		    </div>
		  </div>
		</div>
	</div>
	<div class="column is-6 has-text-right is-hidden-desktop">
		@if(Session::get('category_view') == 'block')
			<form method="post" action="{{ route('category.view.grid') }}">
				{{ csrf_field() }}
				{{ method_field('put') }}
				<button type="submit" class="button is-danger is-outlined is-rounded" >
					<i class="fa fa-th-large"></i>
				</button>
			</form>
		@else
			<form method="post" action="{{ route('category.view.block') }}">
				{{ csrf_field() }}
				{{ method_field('put') }}
				<button type="submit" class="button is-danger is-outlined is-rounded" >
					<i class="fa fa-square"></i>
				</button>
			</form>
		@endif
	</div>
	<div class="column is-12">
		<div class="columns is-multiline is-mobile">
			<!-- LIST PRODUCTS -->
			@if($products->isEmpty())
				<div class="column is-12 has-text-centered is-size-4 m-t-50">НЯМА ДОБАВЕНИ ПРОДУКТИ В ТАЗИ КАТЕГОРИЯ</div>
			@endif
			@foreach($products as $product)
				<div class="column @if(Session::get('category_view') == 'grid') is-half-mobile is-one-fifth-desktop @else is-one-fifth-desktop is-12-mobile @endif">
					@include('home.cards.category')
				</div>
			@endforeach
			<!-- PAGINATION -->
			<div class="column is-12">{{ $products->render('partials._pagination') }}</div>
		</div>
	</div>
</div>
@endsection
<!-- BACK TO TOP BUTTON -->
@include('partials.buttons._backToTop')
