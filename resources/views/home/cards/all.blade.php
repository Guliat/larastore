<a href="{{route('slug', $product->slug)}}">
  <div class="box is-paddingless" style="font-family: Caveat;position: relative;width: 100%;">

    <?php
      $firstPhoto = \App\Product::firstPhoto($product->id);
      $date = date("Y-m-d H:m:i", (strtotime("-3 months")));
      $created_at = App\Product::where('id', '=', $product->id)->select('created_at')->first();
      $promo = App\Promotion::where('product_id', '=', $product->id)->where('is_active', '=', 1)->first();

    ?>
    <img src="{{asset('/images')}}/{{ $firstPhoto->photo }}" width="100%" height="100%" alt="{{ $product->name }}" title="{{ $product->name }}" />

    <div class="is-size-4 has-text-centered">
        @if(!$promo)
          {{$product->sell_price}}лв.
        @else
          {{$promo->price}}лв.
          <span class="has-text-danger" style="text-decoration: line-through">{{$product->sell_price}}лв.</span>
        @endif
    </div>

    <div class="is-size-6 has-text-centered has-text-dark is-uppercase pb-1 px-1">
      {{ mb_substr($product->name, 0, 25) }} {{ mb_strlen($product->name) > 25 ? '...' : "" }}
    </div>

    @if(!empty($promo))
    <div style="position: absolute; top: 5px; right: 5px;">
      <span class="button is-danger is-rounded is-small">
        ПРОМОЦИЯ
      </span>
    </div>
    @elseif($created_at->created_at >= $date)
    <div style="position: absolute; top: 5px; right: 5px;">
      <span class="button is-success is-rounded is-small">
        НОВО
      </span>
    </div>
    @else
    @endif

  </div>
</a>
