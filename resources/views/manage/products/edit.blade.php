@extends('manage.dashboard')
@section('title', '| РЕДАКТИРАНЕ НА ПРОДУТ')
@section('header', 'РЕДАКТИРАНЕ НА ПРОДУТ')
@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{asset('css/parsley.css')}}">
@endsection
@section('manage.content')
	<div class="columns">
		@foreach($photos as $photo)
			<div class="column is-one-fifth has-text-centered card">
				<a href="{{ asset('/images') }}/{{ $photo->photo }}" target="_blank">
					<img src="{{ asset('/images/thumbs') }}/{{ $photo->photo }}" class="p-t-5" />
				</a>
			</div>
		@endforeach
	</div>
	<div class="column notification is-dark"></div>
	<form action="{{route('manage.products.update', $product->id)}}" method="POST" data-parsley-validate="" >
	{{ csrf_field() }}
	{{ method_field('PUT') }}
		<div class="columns is-multiline">
			@if($product->is_active == 0)
				<div class="column is-12 has-text-centered">
					<span class="tag is-large is-danger is-outlined">
						<span class="icon"><i class="fa fa-exclamation-triangle"></i></span>
						<span>ИЗТРИТ ПРОДУКТ</span>
						<span class="icon"><i class="fa fa-exclamation-triangle"></i></span>
					</span>
				</div>
			@endif
			<div class="column is-half">
				<!-- CATEGORY -->
				<div class="field">
					<div class="control">
						<label class="label">КАТЕГОРИЯ</label>
						<div class="select is-fullwidth">
							<select name="category_id" required="" >
								@foreach($categories as $category)
									<option value='{{ $category->id }}' <?php if($category->id == $product->category_id) echo "selected"; ?> >{{ $category->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<!-- END CATEGORY -->
				<!-- SUBCATEGORY -->
				<div class="field">
					<div class="control">
						<label class="label">ПОДКАТЕГОРИЯ</label>
						<div class="select is-fullwidth">
							<select name="subcategory_id" required="" >
								@foreach($subcategories as $subcategory)
									<option value='{{ $subcategory->id }}' <?php if($subcategory->id == $product->subcategory_id) echo "selected"; ?> >{{ $subcategory->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<!-- END SUBCATEGORY -->
				<!-- PRODUCT NAME -->
				<div class="field">
					<div class="control">
						<label class="label">ИМЕ НА ПРОДУКТА</label>
						<input type="text" name="name" placeholder=" име на продукта" required="" minlength="3" class="input" autocomplete="off" value="{{$product->name}}"  />
						<small class="has-text-danger">Заглавието трябва да е подоно на URL адреса:
							<span class="has-text-dark">"{{$product->slug}}"</span>, ако не по-добре е да изтриете продукта и да добавите нов.
						</small>
					</div>
				</div>
				<!-- END PRODUCT NAME -->
				<!-- MODEL -->
				<div class="field">
					<div class="control">
						<label class="label">МОДЕЛ</label>
						<input type="text" name="model" placeholder="модел на продукта" class="input" required="" autocomplete="off" value="{{$product->model}}" />
					</div>
				</div>
				<!-- END MODEL -->
				<!-- PRICE -->
				<div class="field">
					<div class="control">
						<label class="label">ЦЕНА</label>
						<input type="number" name="sell_price" placeholder="цена на продукта" class="input" min="0" autocomplete="off" value="{{$product->sell_price}}" />
					</div>
				</div>
				<!-- END PRICE -->
				<!-- OPTIONS -->
					@if($product->options_groups->isEmpty())
						<div class="card-content">
							@foreach($optionsgroups as $option_group)
								<input class="is-checkbox has-background-color is-primary is-circle" id="{{$option_group->name}}" type="checkbox" name="option_group[]" value="{{$option_group->id}}" :checked="@foreach($option_group->options as $options)check{{$options->id}} || @endforeach checked">
								<label for="{{$option_group->name}}" class="is-size-5">{{$option_group->name}}</label>
								<!-- <span class="is-size-5">{{$option_group->name}}</span> -->
								<div class="box">
									<div class="control">
										@foreach($option_group->options as $options)
											<input class="is-checkbox has-background-color is-primary is-circle" id="{{$options->name}}" type="checkbox" name="options[]" value="{{$options->id}}" v-model="check{{$options->id}}">
											<label for="{{$options->name}}">{{$options->name}}</label>
										@endforeach
									</div>
								</div>
							@endforeach
						</div>
					@else
						<div class="card-content">
							@foreach($product->options_groups as $option_group)
								<input type="hidden" name="option_group[]" value="{{$option_group->id}}" />
								<span class="is-size-5">{{$option_group->name}}</span>
								<div class="box">
									<div class="control">
										<input type="hidden" name="options_groups[]" value="{{$option_group->id}}" />
										@foreach($option_group->options as $options)
											<input class="is-checkbox has-background-color is-danger is-circle" id="{{$options->name}}" type="checkbox"
											name="options[]"
											value="{{$options->id}}"
											<?php
											foreach($selectedoptions as $selected) {
												if($selected->option_id == $options->id) { echo "checked"; }
										 	}
											?>
											>
											<label for="{{$options->name}}">{{$options->name}}</label>
										@endforeach
									</div>
								</div>
							@endforeach
						</div>
					@endif
				<!-- END OPTIONS -->
			</div>
			<div class="column is-half">
				<div class="field">
					<div class="control">
						<label class="label">ТАГОВЕ</label>
						<textarea class="textarea" name="tags" placeholder=" черна, къса, рокля, ....">{{$product->tags}}</textarea>
					</div>
				</div>
				<div class="field">
					<div class="control">
						<label class="label">СЪСТАВ</label>
						<textarea class="textarea" name="fabric" placeholder=" състав на продукта">{{$product->fabric}}</textarea>
					</div>
				</div>
				<div class="field">
					<div class="control">
						<label class="label">ОПИСАНИЕ</label>
						<textarea class="textarea" name="description" placeholder=" описание на продукта">{{$product->description}}</textarea>
					</div>
				</div>
			</div>
			<div class="column">
			</div>
			<button type="submit" class="button is-success is-fullwidth" @click="danger">ЗАПИШИ</button>
		</div>
	</form>
	{{-- <div class="columns">
		<div class="column is-12">
			<form action="{{route('manage.products.update', $product->id)}}" method="POST">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<div class="m-t-30 has-text-centered">
					<input id="disable" type="checkbox" name="disable" class="switch is-thin is-primary is-medium">
	                <label for="disable"></label>
					<br />
					<button type="submit" class="button is-danger is-small">ИЗТРИЙ</button>
				</div>
			</form>
		</div>
	</div> --}}
@endsection
@section('scripts')
<script src="{{asset('js/parsley.min.js')}}"></script>
<script>
  app = new Vue({
		el: '#options',
		el: '#app',
		data: {
			checked: false,
			isLoading: false,
			<?php foreach($optionsgroups as $option_group) { foreach($option_group->options as $options) { echo 'check'.$options->id.': false, '; }} ?>
	  	},
		methods: {
			success() {
				this.$buefy.toast.open({
						duration: 2000,
						message: '<i class="fa fa-check fa-lg"></i> ЗАПИСАНО',
						position: 'is-top',
						type: 'is-success'
				})
  		}
		}
	});
</script>
<script>
$(document).ready(function(){
				document.getElementById("success_toast").click();
		});
</script>
@endsection
