<div class="columns is-multiline has-text-centered is-mobile is-marginless">
    <div class="column is-12"></div>
    <div class="column is-1 has-background-danger" style="box-shadow: #bbb 0px 0px 25px 0px;"></div>
    <div class="column is-11 has-background-dark has-text-white is-size-6 has-text-centered">ПОСЛЕДНО ДОБАВЕНИ ПРОДУКТИ</div>
    <div class="column is-12"></div>
    <?php $last_products = App\Product::where('is_active', 1)->where('is_approved', 1)->orderBy('created_at', 'DESC')->paginate(6); ?>
    @foreach($last_products as $lp)
        <div class="column is-half-mobile">
            <div class="engagement is-size-4">
                <?php $promo = App\Promotion::where('product_id', '=', $lp->id)->where('is_active', '=', 1)->first(); ?>
                @if($promo)
                    {{ floatval($promo->price) }}<small class="is-size-7" style="font-family: Calibri;">лв.</small>
                    <span class="has-text-danger" style="text-decoration: line-through;">{{ floatval($lp->sell_price) }}<small class="is-size-7" style="font-family: Calibri;">лв.</small></span>
                @else
                    {{ floatval($lp->sell_price) }}<small class="is-size-7" style="font-family: Calibri;">лв.</small>
                @endif
            </div>
            <a href="{{route('slug', $lp->slug)}}">
                <div class="card is-shadowless has-ribbon">
                    <div class="ribbon is-dark engagement" style="border-radius: 15%;">
                        HOBO
                    </div>
                    <div>
                        <?php $firstPhoto = \App\Product::firstPhoto($lp->id); ?>
                        @if(!empty($firstPhoto))
                        <img src="{{asset('/images/half')}}/{{ $firstPhoto->photo }}" style="border-radius: 50%;border: 2px solid #fff; box-shadow: #aaa 0px 0px 25px 0px;" width="100%" height="100%" alt="{{ $lp->name }}" title="{{ $lp->name }}" />
                        @endif
                    </div>
                    <div class="card-content is-size-6 has-text-centered is-uppercase">
                        {{ mb_substr($lp->name, 0, 25) }} {{ mb_strlen($lp->name) > 25 ? '...' : "" }}
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
