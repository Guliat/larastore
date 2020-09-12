<div class="columns is-multiline has-text-centered is-mobile">
    <div class="column is-12"></div>
    <div class="column is-1 has-background-danger" style="box-shadow: #bbb 0px 0px 25px 0px;"></div>
    <div class="column is-11 has-background-dark has-text-white is-size-6 has-text-centered">НАЙ-НОВИТЕ НИ ПРОМОЦИИ</div>
    <div class="column is-12"></div>
    <?php $promo_products = App\Promotion::where('is_active', '=', 1)->orderBy('created_at', 'desc')->paginate(6); ?>
    @foreach($promo_products as $pp)
        <div class="column is-half-mobile">
            <div class="engagement is-size-4">
                {{ floatval($pp->price) }}<small class="is-size-7" style="font-family: Calibri;">лв.</small>
                <span class="has-text-danger" style="text-decoration: line-through;">{{ floatval($pp->product->sell_price) }}<small class="is-size-7" style="font-family: Calibri;">лв.</small></span>
            </div>
            <a href="{{route('slug', $pp->product->slug)}}">
                <div class="card is-shadowless has-ribbon">
                    <div class="ribbon is-dark engagement" style="border-radius: 15%;">
                        <div class="p-t-5">NPOMO</div>
                    </div>
                    <div>
                        <?php $firstPhoto = \App\Product::firstPhoto($pp->product->id); ?>
                        @if(!empty($firstPhoto))
                        <img src="{{asset('/images/half')}}/{{ $firstPhoto->photo }}" style="border-radius: 50%;border: 2px solid #fff; box-shadow: #aaa 0px 0px 25px 0px;" width="100%" height="100%" alt="{{ $pp->name }}" title="{{ $pp->name }}" />
                        @endif
                    </div>
                    <div class="card-content is-size-6 has-text-centered is-uppercase">
                        {{ mb_substr($pp->product->name, 0, 25) }} {{ mb_strlen($pp->product->name) > 25 ? '...' : "" }}
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
