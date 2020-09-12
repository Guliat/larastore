@extends('main')

<?php
$header = htmlspecialchars($product->name);
$metaURL = urldecode(URL::current());
if($metaPhoto) {
	$metaImage = asset('/images/meta/'.$metaPhoto->photo);
} else {
	$metaImage = asset('/images/'.$firstPhoto->photo);
}
?>
@section('title', "| $header")
@section('header', "$header")
@section('meta-title', "$header")
@section('meta-description', "$header")
@section('meta-url', "$metaURL")
@section('meta-image', "$metaImage")

@section('quickMenu')
	{{-- @include('partials.buttons._back')
	@include('partials.buttons._home')
	@include('partials.buttons._cart')
	@include('partials._categoryDropDown') --}}
    <div id="random" class="has-text-centered">
        <a href="{{ route('random.product') }}" class="button is-success is-medium" @click="openLoading">ДРУГ ПРОДУКТ</a>
        <b-loading :active.sync="isLoading" :canCancel="true"></b-loading>
    </div>
@endsection

@section('content')
<div class="columns is-centered">
	<!-- LEFT SIDE / IMAGES -->
	<div class="column is-half has-text-centered" id="image-slider">
		@if($count > 1)
			<agile :arrows="true" :dots="true" :speed="500" :timing="'linear'" :autoplay="true" :infinite="true" :pauseOnHover="true" >
				@foreach($photos as $photo)
	                <a href="{{ asset('/images'.'/'.$photo->photo) }}" target="_blank">
						<img src="{{ asset('/images'.'/'.$photo->photo) }}" alt="{{ $product->name }}" />
					</a>
				@endforeach
			</agile>
		@else
			@foreach($photos as $photo)
				<a href="{{ asset('/images'.'/'.$photo->photo) }}" target="_blank">
					<img src="{{ asset('/images'.'/'.$photo->photo) }}" alt="{{ $product->name }}" />
				</a>
			@endforeach
		@endif
		<b-tooltip label="НАТИСНЕТЕ ВЪРХУ СНИМКАТА ЗА ЦЯЛ ЕКРАН">
				<i class="fa fa-search-plus fa-lg has-text-primary"></i>
		</b-tooltip>
	</div>
	<!-- END LEFT SIDE / IMAGES -->
	<div class="is-divider-vertical is-hidden-mobile" data-content="{{ config('app.name')}}"></div>
	<!-- RIGHT SIDE / CONTENT -->
	<div class="column">
		<div class="columns is-multiline" >
			<div class="column is-12">

				<div class="is-size-5 has-text-centered">
					{{$product->name}}<br />
					@if($promoprice)
						<div class="tag is-danger is-large">ПРОМОЦИЯ</div>
					@endif
				</div>

				<div class="is-divider" data-content="ОПИСАНИЕ"></div>

				{!! $product->description !!}

				@if(config('app.name') == "ПолучиМЕ")
					<br /><br />
					<a href="{{ route('info.info') }}#ws" target="_blank">НАШИТЕ РАЗМЕРИ</a>
				@endif

				<div class="is-divider" data-content="ЦЕНА"></div>

				<div class="has-text-centered">
					@if($promoprice)
					<div class="is-size-3">
						<span class="has-text-danger is-size-4" style="text-decoration: line-through">
							{{$product->sell_price}}лв.<br />
						</span>
							{{$promoprice->price}}лв.
					</div>
					@else
						<div class="is-size-3">{{$product->sell_price}}лв.</div>
					@endif
				</div>

			</div>

			<div class="column is-12" id="radioButtons">
				<form method="post" action="{{route('cart.store')}}">
					{{ csrf_field() }}

					@foreach($product->options_groups as $option_group)
						<div class="is-divider" data-content="ИЗБЕРЕТЕ"></div>
						<i class="fa fa-asterisk has-text-danger"></i>
						{{$option_group->name}}
						<b-field>
							@foreach($product->product_options($product->id, $option_group->id) as $options)
								@foreach($product->options($options->option_id) as $option)
								    <b-radio-button v-model="radioButton{{$option_group->id}}" native-value="{{$option->name}}" type="is-primary" name="option[{{$option_group->name}}][]">
										<span class="p-l-10 p-r-10">{{$option->name}}</span>
								    </b-radio-button>
								@endforeach
							@endforeach
						</b-field>
					@endforeach

					{{-- <div class="columns">
						<div class="column is-4">
							КОЛИЧЕСТВО
							<input type="number" class="input has-text-centered" name="quantity" min="1" value="1" required="">
						</div>
					</div> --}}

					<!-- VALUES TO STORE CART -->
					<input type="hidden" name="product_id" value="{{$product->id}}"  />
					<input type="hidden" name="name" value="{{$product->name}}"  />
					@if($promoprice)
					<input type="hidden" name="price" value="{{$promoprice->price}}"  />
					@else
					<input type="hidden" name="price" value="{{$product->sell_price}}"  />
					@endif
					<!-- END VALUES TO STORE CART -->

					<button type="submit" class="button is-primary is-large is-fullwidth">КУПИ</button>
				</form>

				<div class="is-divider" data-content="СПОДЕЛЕТЕ С ДРУГИТЕ"></div>
				<div class="has-text-centered">@include('partials.buttons._share')</div>

			</div>
		</div>
	</div>
	<!-- END RIGHT SIDE / CONTENT -->
</div>

@endsection
@section('scripts')
<script>
new Vue({
    el: '#image-slider',
    data: {}
});
new Vue ({
	el: '#radioButtons',
	data: {
		<?php foreach($product->options_groups as $option_group) { ?>
			radioButton<?php echo $option_group->id; ?>: '',
		<?php } ?>
	},
});
new Vue({
    el: '#random',
    data: {
     isLoading: false
    },
    methods: {
        openLoading() {
            const vm = this
            vm.isLoading = true
            setTimeout(() => {
                vm.isLoading = false
            }, 3 * 1000)
        }
    }
})
</script>
@endsection
