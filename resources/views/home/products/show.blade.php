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

@section('content')
<div class="columns is-multiline is-marginless">
	<div class="column is-12">
		<div class="columns">
			<!-- LEFT SIDE / IMAGES -->
			<div class="column is-6 has-text-centered" id="image-slider">
				@if($count > 1)
					<agile :arrows="true" :dots="true" :speed="500" :timing="'linear'" :autoplay="true" :infinite="true" :pauseOnHover="true" >
						@foreach($photos as $photo)
			                <a href="{{ asset('/images'.'/'.$photo->photo) }}" target="_blank">
								<img src="{{ asset('/images'.'/'.$photo->photo) }}" alt="{{ $product->name }}" title="{{ $product->name }}" />
							</a>
						@endforeach
					</agile>
				@else
					@foreach($photos as $photo)
						<a href="{{ asset('/images'.'/'.$photo->photo) }}" target="_blank">
							<img src="{{ asset('/images'.'/'.$photo->photo) }}" alt="{{ $product->name }}" title="{{ $product->name }}" />
						</a>
					@endforeach
				@endif
			</div>
			<!-- END LEFT SIDE / IMAGES -->
			<div class="is-divider-vertical is-hidden-mobile" data-content="{{ config('app.name')}}"></div>
			<!-- RIGHT SIDE / CONTENT -->
			<div class="column is-5">
				<div class="columns is-multiline" >
					<div class="column is-12">
						<div class="is-size-5 has-text-centered">
							@if($promoprice)
								<div class="tag is-danger is-large">ПРОМОЦИЯ</div><br />
							@endif
							<?php
								$date = date("Y-m-d H:m:i", (strtotime("-3 months")));
								$created_at = App\Product::where('id', '=', $product->id)->select('created_at')->first();
							?>
							@if($created_at->created_at >= $date)
								<div class="tag is-danger is-large">НОВО </div><br /> 
							@endif
							<span class="is-uppercase is-hidden-mobile">{{ $product->name }}</span>
						</div>
						<!-- PRICE -->
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
						<!-- END PRICE -->
						<!-- FABRIC -->
						@if(!empty($product->fabric))
							<div class="is-divider" data-content="СЪСТАВ"></div>
							<div class="has-text-centered has-text-weight-semibold has-text-dark is-uppercase">
								{!! $product->fabric !!}
							</div>
						@endif
						<!-- END FABRIC -->
						<!-- DESCRIPTION -->
						@if(!empty($product->description))
							<div class="is-divider" data-content="ОПИСАНИЕ"></div>
							{!! $product->description !!}
						@endif
						<!-- END DESCRIPTION -->
						<!-- SIZES TABLE -->
						<div>
							@if($product->category_id == 15
							or $product->category_id == 16
							or $product->category_id == 17
							or $product->category_id == 18
							or $product->category_id == 20
							or $product->category_id == 22)
						@elseif($product->category_id == 24)
							<div class="is-divider" data-content="РАЗМЕРИ - ЖЕНИ"></div>
							<table class="table is-bordered is-narrow is-fullwidth is-size-7">
								<tr>
									<td class="has-text-centered">РАЗМЕР</td>
									<td class="has-text-centered">ГРЪДНА ОБИКОЛКА (см)</td>
									<td class="has-text-centered">ТАЛИЯ (см)</td>
									<td class="has-text-centered">ХАНШ (см)</td>
								</tr>
								<tr>
									<td class="has-text-centered has-text-weight-bold">XS</td>
									<td class="has-text-centered">78</td>
									<td class="has-text-centered">60</td>
									<td class="has-text-centered">86</td>
								</tr>
								<tr>
									<td class="has-text-centered has-text-weight-bold">S</td>
									<td class="has-text-centered">82</td>
									<td class="has-text-centered">64</td>
									<td class="has-text-centered">90</td>
								</tr>
								<tr>
									<td class="has-text-centered has-text-weight-bold">M</td>
									<td class="has-text-centered">86</td>
									<td class="has-text-centered">68</td>
									<td class="has-text-centered">94</td>
								</tr>
								<tr>
									<td class="has-text-centered has-text-weight-bold">L</td>
									<td class="has-text-centered">90</td>
									<td class="has-text-centered">72</td>
									<td class="has-text-centered">98</td>
								</tr>
								<tr>
									<td class="has-text-centered has-text-weight-bold">XL</td>
									<td class="has-text-centered">94</td>
									<td class="has-text-centered">76</td>
									<td class="has-text-centered">102</td>
								</tr>
							</table>
							<div class="is-divider" data-content="РАЗМЕРИ - МЪЖЕ"></div>
							<table class="table is-bordered is-narrow is-fullwidth is-size-7">
								<tr>
									<td class="has-text-centered">РАЗМЕР</td>
									<td class="has-text-centered">ГРЪДНА ОБИКОЛКА (см)</td>
									<td class="has-text-centered">ТАЛИЯ (см)</td>
									<td class="has-text-centered">ХАНШ (см)</td>
								</tr>
								<tr>
									<td class="has-text-centered has-text-weight-bold">XS</td>
									<td class="has-text-centered">88-90</td>
									<td class="has-text-centered">76-78</td>
									<td class="has-text-centered">92-94</td>
								</tr>
								<tr>
									<td class="has-text-centered has-text-weight-bold">S</td>
									<td class="has-text-centered"> 92-94</td>
									<td class="has-text-centered">80-82</td>
									<td class="has-text-centered">96-98</td>
								</tr>
								<tr>
									<td class="has-text-centered has-text-weight-bold">M</td>
									<td class="has-text-centered"> 96-98</td>
									<td class="has-text-centered">84-86</td>
									<td class="has-text-centered">100-102</td>
								</tr>
								<tr>
									<td class="has-text-centered has-text-weight-bold">L</td>
									<td class="has-text-centered">104-106</td>
									<td class="has-text-centered">92-94</td>
									<td class="has-text-centered">108-110</td>
								</tr>
								<tr>
									<td class="has-text-centered has-text-weight-bold">XL</td>
									<td class="has-text-centered"> 108-110</td>
									<td class="has-text-centered">96-98</td>
									<td class="has-text-centered">112-114</td>
								</tr>
							</table>
							<b class="is-size-7" id="sizes_image">
								<b-modal :active.sync="modal_sizes">
									<img src="{{ asset('/') }}/sizes_2.jpg" />
								</b-modal>
								Изработваме и по индивидуални размери. При нужда свържете се с нас или оставете размерите като коментар към поръчката.
								Как да се измерите може да видите
								<a @click="modal_sizes = true">ТУК.</a>
							</b>
							@else
							<div class="is-divider" data-content="РАЗМЕРИ"></div>
							<table class="table is-bordered is-narrow is-fullwidth is-size-7">
								<tr>
									<td class="has-text-centered">РАЗМЕР</td>
									<td class="has-text-centered">ГРЪДНА ОБИКОЛКА (см)</td>
									<td class="has-text-centered">ТАЛИЯ (см)</td>
									<td class="has-text-centered">ХАНШ (см)</td>
								</tr>
								<tr>
									<td class="has-text-centered has-text-weight-bold">XS</td>
									<td class="has-text-centered">78</td>
									<td class="has-text-centered">60</td>
									<td class="has-text-centered">86</td>
								</tr>
								<tr>
									<td class="has-text-centered has-text-weight-bold">S</td>
									<td class="has-text-centered">82</td>
									<td class="has-text-centered">64</td>
									<td class="has-text-centered">90</td>
								</tr>
								<tr>
									<td class="has-text-centered has-text-weight-bold">M</td>
									<td class="has-text-centered">86</td>
									<td class="has-text-centered">68</td>
									<td class="has-text-centered">94</td>
								</tr>
								<tr>
									<td class="has-text-centered has-text-weight-bold">L</td>
									<td class="has-text-centered">90</td>
									<td class="has-text-centered">72</td>
									<td class="has-text-centered">98</td>
								</tr>
								<tr>
									<td class="has-text-centered has-text-weight-bold">XL</td>
									<td class="has-text-centered">94</td>
									<td class="has-text-centered">76</td>
									<td class="has-text-centered">102</td>
								</tr>
							</table>
							<b class="is-size-7" id="sizes_image">
								<b-modal :active.sync="modal_sizes">
									<img src="{{ asset('/') }}/sizes_2.jpg" />
								</b-modal>
								Изработваме и по индивидуални размери. При нужда свържете се с нас или оставете размерите като коментар към поръчката.
								Как да се измерите може да видите
								<a @click="modal_sizes = true">ТУК.</a>
							</b>
							@endif
						</div>
						<!-- END SIZES TABLE -->
					</div>

					<div class="column is-12" id="radioButtons">
						<form method="post" action="{{route('cart.store')}}">
							{{ csrf_field() }}
							<input type="hidden" value="{{ url()->previous() }}" name="previous_page" />
							@foreach($product->options_groups as $option_group)
								<i class="fa fa-asterisk has-text-danger"></i>
								<b>ИЗБЕРЕТЕ {{$option_group->name}}</b>
								<b-field>
									@foreach($product->product_options($product->id, $option_group->id) as $options)
										@foreach($product->options($options->option_id) as $option)
										    <b-radio-button v-model="radioButton{{$option_group->id}}" native-value="{{$option->name}}" type="is-warning" name="option[{{$option_group->name}}][]">
												<span class="p-l-10 p-r-10 has-text-danger has-text-weight-semibold">{{$option->name}}</span>
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
							<div class="buttons is-centered">
								<button type="submit" class="button is-success is-rounded is-medium">
									<span class="icon">
										<i class="fa fa-shopping-basket"></i>
									</span>
									<span>ДОБАВИ В КОШНИЦАТА</span>
								</button>
								{{-- <button type="submit" class="button is-success is-rounded is-medium">
									<span class="icon">
										<i class="fa fa-mobile fa-lg"></i>
									</span>
									<span>БЪРЗА ПОРЪЧКА</span>
								</button> --}}
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- END RIGHT SIDE / CONTENT -->
		</div>
	</div>
	<div class="column is-12 has-text-centered is-size-6 has-text-danger">
		<hr />
		ДРУГИ ПРОДУКТИ ОТ ТАЗИ КАТЕГОРИЯ
		<hr />
	</div>
	<div class="column is-12">
		@include('partials._related_products_category')
		@include('partials._related_products_category_desktop')
	</div>
	<div class="column is-12 has-text-centered is-size-6 has-text-danger">
		<hr />
		ДРУГИ ПРОДУКТИ ОКОЛО ТАЗИ ЦЕНА
		<hr />
	</div>
	<div class="column is-12">
		@include('partials._related_products_price')
	</div>
</div>

@endsection
@section('scripts')
<script>
new Vue({
    el: '#image-slider',
    data: {}
});

new Vue({
    el: '#rpc-slider',
    data: {}
});

new Vue ({
	el: '#radioButtons',
	data: {
		isLoading: false,
		<?php foreach($product->options_groups as $option_group) { ?>
			radioButton<?php echo $option_group->id; ?>: '',
		<?php } ?>
	},
});
new Vue({
	el: '#sizes_image',
	data: {
		modal_sizes: false,
	},
})
</script>
@endsection
