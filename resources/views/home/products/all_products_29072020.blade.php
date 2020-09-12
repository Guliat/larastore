@extends('main')
<?php
	$header = "ВСИЧКИ ПРОДУКТИ";
	$metaTitle = config('app.name');
	$metaDescription = config('app.description');
	$metaURL = config('app.url');
	$metaImage = asset('/').config('app.prefix').('meta-logo.png');
?>
{{-- @section('title', '| ВСИЧКИ ПРОДУКТИ') --}}
@section('header', $header)
@section('meta-title', "$metaTitle")
@section('meta-description', "$metaDescription")
@section('meta-url', "$metaURL")
@section('meta-image', "$metaImage")
@section('title', '| ВСИЧКИ ПРОДУКТИ')

@section('content')
	<div class="columns is-multiline" id="orderPhone">
		<div class="column">
			<div class="columns is-multiline">
				@foreach($products as $product)
					<div class="column is-one-fifth">
						<?php
							$today = date('Y-m-d');
							$promo = App\Promotion::where('product_id', '=', $product->id)->where('is_active', '=', 1)->first();
							$date = date("Y-m-d H:m:i", (strtotime("-3 months")));
							$created_at = App\Product::where('id', '=', $product->id)->select('created_at')->first();
						?>
						<a href="{{route('slug', $product->slug)}}">
							<div class="card is-shadowless has-ribbon" style="border-bottom: 1px solid #ccc;">
								@if($promo)
									<div class="ribbon is-danger is-large caveat" >ПРОМОЦИЯ</div>
								@elseif($created_at->created_at >= $date)
									<div class="ribbon is-success is-large caveat" >НОВО</div>
								@endif
								<div class="card-image">
						            <?php $firstPhoto = \App\Product::firstPhoto($product->id); ?>
						            <img src="{{asset('/images')}}/{{ $firstPhoto->photo }}" style="border-radius: 50%;border: 3px solid #fff; box-shadow: #ddd 0px 0px 25px 5px;" width="100%" height="100%" alt="{{ $product->name }}" title="{{ $product->name }}" />
						        </div>
								<div class="card-content is-size-6 has-text-centered has-text-dark is-uppercase" style="min-height: 120px;">
			                        {{ mb_substr($product->name, 0, 35) }} {{ mb_strlen($product->name) > 35 ? '...' : "" }}
			                    </div>
								<footer class="card-footer" >
									<a href="{{ $product->slug }}" class="card-footer-item" data-tooltip="РАЗГЛЕДАЙ И ПОРЪЧАЙ">
										<i class="fa fa-shopping-basket fa-lg"></i>
									</a>
									<div class="card-footer-item engagement is-size-4">
										@if($promo)
											{{ floatval($promo->price) }}<small style="font-family: Calibri;">лв.</small>
										@else
											{{ floatval($product->sell_price) }}<small style="font-family: Calibri;">лв.</small>
										@endif
									</div>
									<b-modal :active.sync="modal{{ $product->id }}">
	                                    <div class="box">
	                                        <form method="post" action="{{ route('order.fast.store') }}" >
	                                            {{ csrf_field() }}
												<div class="columns is-multiline">
													<input type="hidden" value="{{ $product->id }}" name="product_id" />
													<div class="column is-12 has-text-centered is-size-4">
														БЪРЗА И ЛЕСНА ПОРЪЧКА
														<br />
													</div>
													<hr />
													<div class="column is-6">
														<img src="{{asset('/images')}}/{{ $firstPhoto->photo }}" />
													</div>
													<div class="column is-6 has-text-centered">
														<div class="notification is-danger has-text-left">
															<small>ЦЕНА:</small>
															@if($promo)
																{{$promo->price}}лв.
															@else
																{{ $product->sell_price }}лв.
															@endif
															<br />
															@foreach($product->options_groups as $option_group)
																<small>{{$option_group->name}}:</small>
																	@foreach($product->product_options($product->id, $option_group->id) as $options)
																		@foreach($product->options($options->option_id) as $option)
																			<span class="has-text-weight-semibold">{{$option->name}}</span> /
																		@endforeach
																	@endforeach
															@endforeach
														</div>
														<div class="notification has-text-centered is-light">
															<i class="is-size-6">Въведете телефонен номер и ние ще се свържем с вас.</i>
															<div class="field">
																<p class="control has-icons-left has-icons-right">
																	<input type="input" name="phone" class="input is-success" placeholder=" телефонен номер" :class="{'input': true, 'is-danger': errors.has('ТЕЛЕФОНЕН НОМЕР') }" v-validate="'required|numeric|min:10|max:13'" data-vv-name="ТЕЛЕФОНЕН НОМЕР" />
																	<span class="icon is-left has-text-success" :class="{'has-text-danger': errors.has('ТЕЛЕФОНЕН НОМЕР') }" data-vv-name="ТЕЛЕФОНЕН НОМЕР" />
																		<i class="fa fa-phone"></i>
																	</span>
																</p>
																<div v-show="errors.has('ТЕЛЕФОНЕН НОМЕР')" class="help is-danger">@{{ errors.first('ТЕЛЕФОНЕН НОМЕР') }}</div>
															</div>
															<p class="is-size-7 p-b-10">
																Изберете тази опция ако искате да се свържем с вас чрез <b>Viber</b>.
															</p>
															<input id="switchThinColorDanger" type="checkbox" name="viber" value="1" class="switch is-thin is-success">
															<label for="switchThinColorDanger"></label>
															<button type="submit" href="#" class="button is-success is-fullwidth m-t-20"> ПОРЪЧАЙ </button>
														</div>
														<a class="button is-danger" @click="modal{{ $product->id }} = false">ОТКАЗ</a>
													</div>
												</div>
	                                        </form>
	                                    </div>
	                                </b-modal>
                                	<a @click="modal{{ $product->id }} = true" class="card-footer-item" data-tooltip="ЛЕСНА ПОРЪЧКА">
										<i class="fa fa-mobile fa-2x"></i>
									</a>
								</footer>
							</div><!-- END FOR IF, ELSEIF and ELSE -->
						</a>
					</div><!-- END COLUMN -->
				@endforeach
				<!-- PAGINATION -->
				<div class="column is-12">{{ $products->render('partials._pagination') }}</div>
			</div>
		</div>
	</div><!-- END COLUMNS -->
@endsection

@section('scripts')
	<script>
	new Vue({
		el: '#orderPhone',
		data: {
			<?php foreach($products as $product) { echo 'modal'.$product->id.':false, '; } ?>
		},
	})
</script>
@endsection

@include('partials.buttons._backToTop')
