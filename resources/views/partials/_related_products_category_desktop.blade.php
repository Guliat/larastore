<div class="columns is-multiline is-hidden-mobile">
    @foreach($rpc as $rel_prd_cat)
        <div class="column is-one-fifth has-text-centered">
            <a href="{{route('slug', $rel_prd_cat->slug)}}" target="_blank">
                <div class="card is-shadowless has-ribbon">
                    <?php $promo = App\Promotion::where('product_id', '=', $rel_prd_cat->id)->where('is_active', '=', 1)->first(); ?>
                    <div class="ribbon is-danger is-large" style="@if($promo) background-color: #57EA8B @endif; border-radius: 17%;">
                        @if(!$promo)
                            {{$rel_prd_cat->sell_price}}лв.
                        @else
                            ПРОМОЦИЯ
                        @endif
                    </div>
                    <div>
                        <?php $firstPhoto = \App\Product::firstPhoto($rel_prd_cat->id); ?>
                        @if(!empty($firstPhoto))
                        <img src="{{asset('/images')}}/{{ $firstPhoto->photo }}"
                        style="border-radius: 50%;border: 5px solid #FFF;box-shadow: @if(!$promo) #CCC @else #57EA8B @endif 0px 0px 25px 5px;" width="100%" height="100%" alt="{{ $rel_prd_cat->name }}" title="{{ $rel_prd_cat->name }}" />
                        @endif
                    </div>
                    <div class="card-content is-size-6 has-text-centered">
                        {{ mb_substr($rel_prd_cat->name, 0, 35) }} {{ mb_strlen($rel_prd_cat->name) > 35 ? '...' : "" }}
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
