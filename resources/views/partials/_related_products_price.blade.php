<div class="columns is-multiline">
    @foreach($rpp as $rel_prd_price)
        <div class="column is-one-fifth has-text-centered">
            <a href="{{route('slug', $rel_prd_price->slug)}}" target="_blank">
                <div class="card is-shadowless has-ribbon">
                    <?php $promo = App\Promotion::where('product_id', '=', $rel_prd_price->id)->where('is_active', '=', 1)->first(); ?>
                    <div class="ribbon is-danger is-large" style="@if($promo) background-color: #57EA8B @endif; border-radius: 17%;">
                        @if(!$promo)
                            {{$rel_prd_price->sell_price}}лв.
                        @else
                            ПРОМОЦИЯ
                        @endif
                    </div>
                    <div>
                        <?php $firstPhoto = \App\Product::firstPhoto($rel_prd_price->id); ?>
                        @if(!empty($firstPhoto))
                        <img src="{{asset('/images')}}/{{ $firstPhoto->photo }}"
                        style="border-radius: 50%;border: 5px solid #FFF;box-shadow: @if(!$promo) #CCC @else #57EA8B @endif 0px 0px 25px 5px;" width="100%" height="100%" alt="{{ $rel_prd_price->name }}" title="{{ $rel_prd_price->name }}" />
                        @endif
                    </div>
                    <div class="card-content is-size-6 has-text-centered">
                        {{ mb_substr($rel_prd_price->name, 0, 35) }} {{ mb_strlen($rel_prd_price->name) > 35 ? '...' : "" }}
                    </div>
                </div>
            </a>
            <hr class="is-hidden-desktop" />
        </div>
    @endforeach
</div>
