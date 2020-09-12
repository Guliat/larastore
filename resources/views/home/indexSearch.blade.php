@extends('main')

@section('title', '| ТЪРСЕНЕ')
@section('header', 'ТЪРСЕНЕ')

@section('content')
	<div class="columns is-multiline">
		<div class="column is-12 p-t-30">
			@include('partials.buttons._back')
		</div>
		<div class="column is-12">
			<form action="{{route('search.post')}}" method="post">
	        {{csrf_field()}}
	            <div class="field has-addons">
	                <div class="control">
	                    <input type="text" name="search" placeholder="какво търсите ?" class="input is-medium" value="@if(!empty($query)){{$query}}@endif">
						<div class="tag is-small is-light">
							полето приема само кирилица и цифри
						</div>
	                </div>
	                <div class="control">
	                    <button type="submit" class="button is-success is-medium" @click="openLoading">ТЪРСИ</button>
	                </div>
	            </div>
	        </form>
		</div>
	</div>
	@if(isset($results))
		@if($results->isEmpty())
			<div class="column is-12 is-size-5 has-text-danger">
				<i class="fa fa-close"></i> НЯМА НАМЕРЕНИ СЪВПАДЕНИЯ
			</div>
		@else
			<hr>
			<div class="columns is-multiline">
				@foreach($results as $product)
			        <div class="column is-one-fifth">
						<span class="is-size-7">МОДЕЛ: {{ $product->model }}</span>
						@include('partials._cleanProductCard')
			        </div>
				@endforeach
			</div>
		@endif
	@endif
@endsection

@include('partials.buttons._backToTop')
