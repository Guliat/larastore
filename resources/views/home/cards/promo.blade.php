<a href="{{ route('slug', $promotion->product->slug) }}">
  <div class="box is-paddingless caveat" style="position: relative;width: 100%;">
    <?php
      $firstPhoto = \App\Product::firstPhoto($promotion->product->id);
      $percent = str_replace('%', '',floor(($promotion->price / $promotion->product->sell_price) * 100)-100);
    ?>
    <img src="{{asset('/images/half')}}/{{ $firstPhoto->photo }}" width="100%" height="100%" alt="{{ $promotion->product->name }}" title="{{ $promotion->product->name }}" />
    <div class="ribbon is-danger is-medium">
      {{ $percent }}%
    </div>
    <div style="position: absolute; bottom: 0; width:100%; text-align: center;background: rgba(255, 255, 255, 0.5);">
      <span class="is-size-4" style="color: #f00;">
        {{ floatval($promotion->price) }}лв.
      </span>
      от
      <span class="is-size-5 has-text-dark" >
        {{ $promotion->product->sell_price }}лв.
      </span>
    </div>
  </div>
</a>
