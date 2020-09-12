@extends('manage.dashboard')
@section('title', '| ПРОМОТИРАНЕ')
@section('header', 'ПРОМОТИРАНЕ')
@section('quickMenu')
	@include('partials.buttons._home')
	@include('partials.buttons._back')
@endsection
@section('manage.content')
	<div class="columns">
		<div class="column is-4 is-offset-4">
			<form action="{{route('manage.promotions.store.to.category')}}" method="post">
				{{csrf_field()}}
				<input type="hidden" name="product_id" value="" />
				<div class="columns">
					<div class="column is-12">
						<div class="box">
							<div class="field">
								<labe class="label">КАТЕГОРИЯ</labe>
								<div class="control has-icons-left">
									<div class="select is-fullwidth">
										<select name="category_id">
											<option value="">
												-- изберете --
											</option>
											@foreach($categories as $category)
												<option value="{{$category->id}}">
													{{$category->name}}
												</option>
											@endforeach
										</select>
										<span class="icon is-left">
											<i class="fa fa-list-ol"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="field">
								<labe class="label">ЦЕНА</labe>
								<div class="control has-icons-left">
									<input type="number" class="input" autocomplete="off" autofocus name="price" value="{{ old('price') }}" placeholder="ПРОМО ЦЕНА">
									<span class="icon is-left"><i class="fa fa-money"></i></span>
								</div>
							</div>
							<div class="field">
								<labe class="label">СРОК</labe>
								<div class="control has-icons-left">
									<div class="select is-fullwidth">
										<select name="promo_days">
											<option value="">
												-- срок --
											</option>
											<option value="7">
												1 СЕДМИЦА
											</option>
											<option value="14">
												2 СЕДМИЦИ
											</option>
											<option value="30">
												1 МЕСЕЦ
											</option>
											<option value="60">
												2 МЕСЕЦА
											</option>
										</select>
										<span class="icon is-left">
											<i class="fa fa-list-ol"></i>
										</span>
									</div>
								</div>
							</div>
							<button type="submit" class="button is-success is-fullwidth m-b-20 m-t-100" >ЗАПИШИ</button>
							<a href="{{route('manage.promotions.index')}}" class="button is-danger is-fullwidth is-outlined"> ОТКАЗ </a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
