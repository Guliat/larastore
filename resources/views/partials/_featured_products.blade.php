<div class="columns is-multiline has-text-centered is-mobile">
    <div class="column is-12"></div>
    <div class="column is-1 has-background-danger" style="box-shadow: #bbb 0px 0px 25px 0px;"></div>
    <div class="column is-11 has-background-dark has-text-white is-size-6 has-text-centered">ИЗБРАНИ ПРОДУКТИ</div>
    <div class="column is-12"></div>
    <?php $featured_products = App\Product::where('is_featured', 1)->paginate(10); ?>
    @foreach($featured_products as $fp)
        <div class="column is-half-mobile is-one-fifth-desktop">
            <div class="engagement is-size-4">
                <?php $promo = App\Promotion::where('product_id', '=', $fp->id)->where('is_active', '=', 1)->first(); ?>
                @if($promo)
                    {{ floatval($promo->price) }}<small class="is-size-7" style="font-family: Calibri;">лв.</small>
                    <span class="has-text-danger" style="text-decoration: line-through;">{{ floatval($fp->sell_price) }}<small class="is-size-7" style="font-family: Calibri;">лв.</small></span>
                @else
                    {{ floatval($fp->sell_price) }}<small class="is-size-7" style="font-family: Calibri;">лв.</small>
                @endif
            </div>
            <a href="{{route('slug', $fp->slug)}}">
                <div class="card is-shadowless has-ribbon">
                    <div class="ribbon is-dark engagement" style="border-radius: 15%;">
                        U3<span class="pacifico">б</span>PAH
                    </div>
                    <div>
                        <?php $firstPhoto = \App\Product::firstPhoto($fp->id); ?>
                        @if(!empty($firstPhoto))
                        <img src="{{asset('/images/half')}}/{{ $firstPhoto->photo }}" style="border-radius: 50%;border: 2px solid #fff; box-shadow: #aaa 0px 0px 25px 0px;" width="100%" height="100%" alt="{{ $fp->name }}" title="{{ $fp->name }}" />
                        @endif
                    </div>
                    <div class="card-content is-size-6 has-text-centered is-uppercase">
                        {{ mb_substr($fp->name, 0, 25) }} {{ mb_strlen($fp->name) > 25 ? '...' : "" }}
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
