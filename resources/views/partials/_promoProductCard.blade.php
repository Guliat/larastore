<a href="{{route('slug', $promotion->product->slug)}}">
  <div class="card is-shadowless has-ribbon">
    <div class="ribbon is-danger is-medium pacifico">
      <span class="is-size-5">{{ floatval($promotion->price) }}<small class="is-size-7" style="font-family: Calibri;">лв.</small></span>
    </div>
    <div class="card-image">
      <?php $firstPhoto = \App\Product::firstPhoto($promotion->product->id); ?>
      <img src="{{asset('/images/half')}}/{{ $firstPhoto->photo }}" width="100%" height="100%" alt="{{ $promotion->product->name }}" title="{{ $promotion->product->name }}" />
    </div>
  </div>
</a>
