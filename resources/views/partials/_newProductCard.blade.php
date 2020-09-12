<a href="{{ route('slug', $product->slug) }}">
    <div class="card">
        <?php $promo = App\Promotion::where('product_id', '=', $product->id)->where('is_active', '=', 1)->first(); ?>
        <div class="card has-ribbon">
            <div class="ribbon is-danger is-large">НОВО</div>
            <div class="card-image">
                <?php $firstPhoto = \App\Product::firstPhoto($product->id); ?>
                <img src="{{asset('/images')}}/{{ $firstPhoto->photo }}" width="100%" height="100%" alt="{{ $product->name }}" title="{{ $product->name }}" />
            </div>
            <div class="card-content is-size-6 has-text-centered is-uppercase" style="min-height: 100px;">
                {{ mb_substr($product->name, 0, 40) }} {{ mb_strlen($product->name) > 40 ? '...' : "" }}
            </div>
            <div class="has-text-centered subtitle is-4 p-b-15">
                @if(!$promo)
                    {{ $product->sell_price }}лв.
                @else
                    <span class="is-size-5 tag is-danger">{{ $promo->price }}лв.</span>
                    <span class="is-size-6" style="text-decoration: line-through">{{ $product->sell_price }}лв.</span>
                @endif
            </div>
        </div>
    </div>
</a>
