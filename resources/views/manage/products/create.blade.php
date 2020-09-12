@extends('manage.dashboard')
@section('title', '| ДОБАВЯНЕ НА ПРОДУКТ')
@section('header', 'ДОБАВЯНЕ НА ПРОДУКТ')
@section('stylesheets')
	<link media="all" type="text/css" rel="stylesheet" href="{{asset('css/parsley.css')}}">
@endsection
@section('manage.content')
<form method="post" action="{{route('manage.products.store')}}" data-parsley-validate="" >
{{ csrf_field() }}
	<div class="columns is-multiline">
		<div class="column is-half">
			<!-- CATEGORY -->
			<div class="field">
				<div class="control">
					<i class="fa fa-asterisk has-text-danger"></i>
					<div class="select">
						<select name="category_id" required="" >
							<option value=''>- ИЗБЕРЕТЕ КАТЕГОРИЯ -</option>
							@foreach($categories as $category)
								<option value='{{ $category->id }}'>{{ $category->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<!-- END CATEGORY -->
			<!-- PRODUCT NAME -->
			<div class="field">
				<div class="control">
					<label class="label"><i class="fa fa-asterisk has-text-danger"></i> ИМЕ НА ПРОДУКТА</label>
					<input type="text" name="name" placeholder=" име на продукта" required="" minlength="3" class="input" autocomplete="off" />
				</div>
			</div>
			<!-- END PRODUCT NAME -->
			<!-- MODEL -->
			<div class="field">
				<div class="control">
					<label class="label"><i class="fa fa-asterisk has-text-danger"></i> МОДЕЛ</label>
					<input type="text" name="model" placeholder="модел на продукта" class="input" required="" autocomplete="off" />
				</div>
			</div>
			<!-- END MODEL -->
			<!-- PRICE -->
			<div class="field">
				<div class="control">
					<label class="label"><i class="fa fa-asterisk has-text-danger"></i> ЦЕНА</label>
					<input type="number" name="sell_price" placeholder="цена на продукта" class="input" min="0" value="0" autocomplete="off" />
				</div>
			</div>
			<!-- END PRICE -->
			<!-- OPTIONS -->
			<label class="label">ОПЦИИ</label>
			<div class="card">
				@foreach($optionsgroups as $option_group)
					{{-- <input class="is-checkbox has-background-color is-primary is-circle" id="{{$option_group->name}}" type="checkbox" name="option_group[]" value="{{$option_group->id}}" :checked="@foreach($option_group->options as $options)check{{$options->id}} || @endforeach checked"> --}}
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
			<!-- END OPTIONS -->
		</div>
		<div class="column is-half">
			<div class="field">
				<div class="control">
					<label class="label"><i class="fa fa-asterisk has-text-danger"></i> ТАГОВЕ</label>
					<textarea class="textarea" name="tags" placeholder=" рокля, рокли, roklq, rokli, roklya"></textarea>
				</div>
			</div>
			<div class="field">
				<div class="control">
					<label class="label"><i class="fa fa-asterisk has-text-danger"></i> СЪСТАВ</label>
					<textarea class="textarea" name="fabric" placeholder=" състав на продукта"></textarea>
				</div>
			</div>
			<div class="field">
				<div class="control">
					<label class="label">ОПИСАНИЕ</label>
					<textarea class="textarea" name="description" placeholder=" описание на продукта"></textarea>
				</div>
			</div>
		</div>
		<div class="column">
			<button type="submit" class="button is-success is-fullwidth" @click="openLoading">ЗАПИШИ И ПРОДЪЛЖИ</button>
		</div>
	</div>
</form>
@endsection
@section('scripts')
	<script src="{{asset('js/parsley.min.js')}}"></script>
	<script>
	  app = new Vue({
		el: '#options',
		data: {
			checked: false,
			<?php foreach($optionsgroups as $option_group) { foreach($option_group->options as $options) { echo 'check'.$options->id.': false, '; }} ?>
	  	}
	  });
	</script>
@endsection
