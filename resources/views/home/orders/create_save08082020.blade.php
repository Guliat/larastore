@extends('main')
@section('title', '| ПРЕГЛЕД И ПОРЪЧКА')
@section('header', 'ПРЕГЛЕД И ПОРЪЧКА')
@section('content')
{{-- MODAL FAST ORDER --}}
  <div class="column is-marginless is-12 has-text-centered" id="fast_order">
      <b-modal :active.sync="modal_fast_order">
      <div class="box">
        <form method="post" action="{{ route('order.fast.store') }}" >
          {{ csrf_field() }}
            @foreach(Cart::content() as $product)
                {{-- <input type="hidden" value="{{ $product->id }}" name="products[id][]" />
                <input type="hidden" value="{{ $product->options[0] }}" name="products[sizes][]" />
                <input type="hidden" value="{{ $product->qty }}" name="products[qty][]" /> --}}
                {{-- <input type="hidden" value="{{ $product->id }}_{{ $product->options[0] }}_{{ $product->qty }}" name="products[]" /> --}}
            @endforeach
            <span class="heading is-size-5">БЪРЗА И ЛЕСНА ПОРЪЧКА</span>
            <hr />
            <i class="is-size-6">Въведете телефонен номер и ние ще се свържем с вас.</i>
            <div class="field">
              <p class="control has-icons-left has-icons-right">
                <input type="input" name="phone" class="input is-success" placeholder=" телефонен номер" :class="{'input': true, 'is-danger': errors.has('ТЕЛЕФОНЕН НОМЕР') }" v-validate="'required|numeric|min:10|max:10'" data-vv-name="ТЕЛЕФОНЕН НОМЕР" />
                <span class="icon is-left has-text-success" :class="{'has-text-danger': errors.has('ТЕЛЕФОНЕН НОМЕР') }" data-vv-name="ТЕЛЕФОНЕН НОМЕР" />
                <i class="fa fa-phone"></i>
              </span>
            </p>
            <div v-show="errors.has('ТЕЛЕФОНЕН НОМЕР')" class="help is-danger">@{{ errors.first('ТЕЛЕФОНЕН НОМЕР') }}</div>
          </div>
          <p class="is-size-7 p-b-10">
            Изберете тази опция ако искате да се свържем с вас чрез <b>Viber</b>.
          </p>
          <input id="viber_switch" type="checkbox" name="viber" value="1" class="switch is-thin is-success">
          <label for="viber_switch"></label>
          <button type="submit" class="button is-success is-fullwidth m-t-20 m-b-20"> ПОРЪЧАЙ </button>
          <a class="button is-dark is-small" @click="modal_fast_order = false">ОТКАЗ</a>
        </form>
      </div>
    </b-modal>
    <a @click="modal_fast_order = true" class="button is-success is-outlined is-rounded is-small">
      <span class="icon"><i class="fa fa-phone"></i></span>
      <span>ЛЕСНА ПОРЪЧКА</span>
    </a>
    <span class="heading is-size-7">Ние ще се свържем с вас.</span>
  </div>
{{-- END FAST ORDER --}}
{{-- CART LIST --}}
  @if(Cart::count() >= 1)
    <div class="column is-marginless is-4" id="cart_products">
      <div class="columns is-multiline is-marginless">
        <div class="column is-12 p-b-10">ДОБАВЕНИ ПРОДУКТИ</div>
        <?php foreach(Cart::content() as $row) : $slug = App\Http\Controllers\HomeController::getProductSlug($row->id); ?>
        <div class="column is-12 box mx-3">
          <div class="columns is-mobile is-paddingless">
            <div class="column is-1">
              <div class="columns is-multiline">
                <div class="column is-12 p-t-20">
                  <b-modal :active.sync="cart_delete{{ $row->rowId }}" :width="350">
                    <div class="box">
                      <form method="post" action="{{ route('cart.delete') }}" >
                        {{ csrf_field() }}
                        <input type="hidden" value="{{$row->rowId}}" name="rowId" />
                        <span class="subtitle">Сигурни ли сте че искате да махнете този продукт от вашата кошница ?</span>
                        <hr />
                        <button type="submit" class="button is-danger">ПРЕМАХНИ</button>
                        <a class="button is-dark" @click="cart_delete{{ $row->rowId }} = false">ОТКАЗ</a>
                      </form>
                    </div>
                  </b-modal>
                  <a @click="cart_delete{{ $row->rowId }} = true">
                    <i class="fa fa-trash fa-lg has-text-danger"></i>
                  </a>
                </div>
                <div class="column is-12 is-paddingless m-t-5" style="height: 3px; width: 100%;background-color: #ccc"></div>
                <div class="column is-12 p-t-20">
                  <b-modal :active.sync="cart_update{{ $row->rowId }}" :width="350">
                    <div class="box">
                      <form method="post" action="{{ route('cart.update') }}" >
                        {{ csrf_field() }}
                        <input type="hidden" value="{{$row->rowId}}" name="rowId" />

                        <div class="field">
                          <span class="subtitle">РАЗМЕР</span>
                          <div class="control">
                            <div class="select is-danger">
                              <select>
                                <?php $p_options = App\Http\Controllers\HomeController::getProductOptions($row->id); ?>
                                @foreach($row->options as $option)
                                @foreach($p_options as $p_option)
                                  <option @if($p_option["name"] == $option) selected @endif>
                                    {{ $p_option["name"] }}
                                  </option>
                                @endforeach
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                        <span class="subtitle">КОЛИЧЕСТВО</span>
                        <b-numberinput type="is-danger" icon-pack="fa" min="1" max="5" v-model="number{{ $row->rowId }}"></b-numberinput>

                        <hr />
                        <button type="submit" href="#" class="button is-success">ОБНОВИ</button>
                        <a class="button is-dark" @click="cart_update{{ $row->rowId }} = false">ОТКАЗ</a>
                      </form>
                    </div>
                  </b-modal>
                  <a @click="cart_update{{ $row->rowId }} = true">
                    <i class="fa fa-edit fa-lg has-text-success"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="column is-4 is-paddingless p-t-15 p-l-20">
              <img src="{{asset('/images/thumbs')}}/{{ \App\Product::firstPhoto($row->id)->photo }}" style="border-radius: 50%;" width="100px" height="100px" alt="{{ $row->name }}" title="{{ $row->name }}" />
            </div>
            <div class="column is-7 has-text-centered is-size-7">
              <a href="{{ route('slug', $slug->slug) }}" target="_blank">
                <span class="is-uppercase">{{ $row->name }}</span>
              </a>
              <br />
              @foreach($row->options as $option)
                  @if(!empty($option))
                    <br /><span class="p-t-10">РАЗМЕР: {{ $option }}</span><br />
                  @endif
              @endforeach
              <span class="is-size-5">
                {{ $row->qty * $row->price }}лв.
                <span class="is-size-7">
                  ({{ $row->qty }}бр.)
                </span>
              </span>
              @if(strlen($row->name) < 50 )
                <div class="p-b-15"></div>
              @endif
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  @endif
{{-- END CART LIST --}}


<div class="column is-marginless is-12" id="create_order">
  <ul class="steps has-gaps is-small">
    <!-- STEP 1 -->
    <li class="steps-segment" :class="{ 'is-active': active_1 }">
        <span class="steps-marker">
          <i class="fa fa-user"></i>
        </span>
        <div class="steps-content is-divider-content">
          <b-field label="ВАШИТЕ ИМЕНА" label-position="on-border" type="is-info">
            <b-input value="@if(!empty(session()->has('names'))){{ session()->get('names') }} @endif" maxlength="50"></b-input>
          </b-field>
          <b-field label="ТЕЛЕФОН" label-position="on-border" type="is-info" >
            <b-input value="@if(!empty(session()->has('phone'))){{ session()->get('phone') }} @endif" maxlength="50" @blur="active_2 = true; active_1 = false"></b-input>
          </b-field>
        </div>
    </li>
    <!-- STEP 2 -->
    <li class="steps-segment" :class="{ 'is-active': active_2 }">
        <span class="steps-marker">
            <span class="icon ">
                <i class="fa fa-truck"></i>
            </span>
        </span>
        <div class="steps-content is-divider-content">
        <div class="buttons has-addons">
          <button class="button" :class="{ 'is-info': econt }" @click="econt = true; speedy = false; active_2 = true; active_1 = false">ЕКОНТ</button>
          <button class="button" :class="{ 'is-warning': speedy }" @click="speedy = true; econt = false; active_2 = true; active_1 = false">СПИДИ</button>
        </div>
        <div class="buttons has-addons">
          <button class="button is-success">ДО ОФИС</button>
          <button class="button">ДО ДОМА</button>
        </div>
      </div>
    </li>
    <!-- STEP 3 -->
    <li class="steps-segment" :class="{ 'is-active': active_3 }">
        <span class="steps-marker ">
            <span class="icon is-size-6">
                <i class="fa fa-home"></i>
            </span>
        </span>
        <div class="steps-content is-divider-content">
          <b-field label="ГРАД" label-position="on-border" type="is-info">
            <b-autocomplete
            v-model="zone_name"
            :data="filteredDataArray"
            placeholder="(на кирилица)"
            clearable
            @select="option => selected = option" @focus="active_3 = true; active_1 = false, active_2 = false">
            <template slot="empty">No results found</template>
          </b-autocomplete>
          </b-field>
            <b-field :label="shipping_firm" label-position="on-border" type="is-info">
              <b-input :placeholder="shipping_type" value="" maxlength="50"  @focus="active_3 = true"></b-input>
            </b-field>
        </div>
    </li>
    <!-- STEP 4 -->
    <li class="steps-segment" :class="{ 'is-active': active_4 }">
        <span class="steps-marker ">
            <span class="icon is-size-6">
                <i class="fa fa-comment"></i>
            </span>
        </span>
        <div class="steps-content is-divider-content">
        <b-field label="КОМЕНТАР" label-position="on-border" type="is-info">
          <b-input maxlength="1000" type="textarea" @focus="active_4 = true; active_3 = false"></b-input>
        </b-field>
      </div>
    </li>
    <!-- STEP 5 -->
    <li class="steps-segment">
        <span class="steps-marker ">
            <span class="icon is-size-6">
                <i class="fa fa-flag"></i>
            </span>
        </span>
    </li>
  </ul>
</div>




<form method="post" action="{{route('order.store.session')}}">
  <div class="columns is-marginless is-multiline" id="create_order">
    {{csrf_field()}}



          <div class="column is-8">
            <div class="columns is-marginless">
              <div class="column is-6">
                    <b-field label="ВАШИТЕ ИМЕНА" label-position="on-border" type="is-info" message="ERRORS">
                      <b-input value="@if(!empty(session()->has('names'))){{ session()->get('names') }} @endif" maxlength="50"></b-input>
                    </b-field>
                    <b-field label="ТЕЛЕФОН" label-position="on-border" type="is-info" message="ERRORS" >
                      <b-input value="@if(!empty(session()->has('names'))){{ session()->get('names') }} @endif" maxlength="50"></b-input>
                    </b-field>
                    <p class="heading is-size-6">ДОСТАВЧИК</p>
                    <b-field position="is-left">
                      <b-radio-button v-model="shipping_firm" native-value="ЕКОНТ" type="is-info">
                        <b-icon icon="truck" pack="fa" ></b-icon>
                        <span>ЕКОНТ</span>
                      </b-radio-button>
                      <b-radio-button v-model="shipping_firm" native-value="СПИДИ" type="is-warning">
                        <b-icon icon="truck" pack="fa" ></b-icon>
                        <span>СПИДИ</span>
                      </b-radio-button>
                    </b-field>
                  <p class="heading is-size-6">ДОСТАВКА</p>
                  <b-field position="is-left">
                    <b-radio-button v-model="shipping_type" native-value="ДО ОФИС" type="is-dark">
                      <b-icon icon="signing" pack="fa" ></b-icon>
                      <span>ДО ОФИС</span>
                    </b-radio-button>
                    <b-radio-button v-model="shipping_type" native-value="ДО АДРЕС" type="is-dark">
                      <b-icon icon="home" pack="fa" ></b-icon>
                      <span>ДО АДРЕС</span>
                    </b-radio-button>
                  </b-field>
                  <br />
                  <b-field label="ГРАД" label-position="on-border" type="is-info" message="ERRORS">
                    <b-autocomplete
                    v-model="zone_name"
                    :data="filteredDataArray"
                    placeholder="(на кирилица)"
                    clearable
                    @select="option => selected = option">
                    <template slot="empty">No results found</template>
                  </b-autocomplete>
                </b-field>
                    <b-field :label="shipping_firm" label-position="on-border" type="is-info" message="ERRORS" >
                      <b-input :placeholder="shipping_type" value="" maxlength="50"></b-input>
                    </b-field>
                    <br />
                    <b-field label="КОМЕНТАР" label-position="on-border" type="is-info">
                        <b-input maxlength="1000" type="textarea"></b-input>
                    </b-field>





                      {{--
                      <div class="has-text-left is-size-6 m-b-55">КОМЕНТАР / ДОПЪЛНИТЕЛНИ ИЗИСКВАНИЯ (макс: 1000)</div>
                      <textarea name="comment" class="textarea" rows="2" :class="{'input': true, 'is-danger': errors.has('КОМЕНТАР') }" v-validate="'min:5|max:1000'" data-vv-name="КОМЕНТАР" @if(old('address')) @else autofocus @endif>
                      {{ old('comment') }}
                    </textarea>
                    <div v-show="errors.has('КОМЕНТАР')" class="help is-danger">@{{ errors.first('КОМЕНТАР') }}</div>
                      <div class="has-text-left">ВАШИТЕ ИМЕНА</div>
                        <div class="control has-icons-left">
                            <input type="text" name="names" value="{{old('names')}}" placeholder="вашите имена" :class="{'input': true, 'is-danger': errors.has('ВАШИТЕ ИМЕНА') }" v-validate="'required|alpha_spaces|min:3|max:255'" data-vv-name="ВАШИТЕ ИМЕНА" @if(old('names')) @else autofocus @endif>
                            <span class="icon is-left"><i class="fa fa-user"></i></span>
                        </div>
                        <div v-show="errors.has('ВАШИТЕ ИМЕНА')" class="help is-danger">@{{ errors.first('ВАШИТЕ ИМЕНА') }}</div>
                        <!-- PHONE -->
                        <div class="has-text-left m-t-10">ТЕЛЕФОН</div>
                        <div class="control has-icons-left">
                            <input type="text" name="phone" value="{{old('phone')}}" :class="{'input': true, 'is-danger': errors.has('ТЕЛЕФОН') }" v-validate="'required|numeric|min:10|max:10'" data-vv-name="ТЕЛЕФОН" @if(old('phone')) @else autofocus @endif>
                            <span class="icon is-left"><i class="fa fa-phone"></i></span>
                        </div>
                        <div v-show="errors.has('ТЕЛЕФОН')" class="help is-danger">@{{ errors.first('ТЕЛЕФОН') }}</div>
                        <!-- ZONES -->
                        <div class="field m-t-20">
                          <div class="has-text-left">АДРЕС</div>
                            <div class="control has-icons-left">
                                <div class="icon is-small is-left"><i class="fa fa-globe"></i></div>
                                <div class="select">
                                    <select v-model="zone" name="zone" @if(old('zone')) @else autofocus @endif>
                                        <option value="">- населено място -</option>
                                        @foreach($zones as $zone)
                                            <option value="{{$zone->id}}">{{$zone->name}}</option>
                                        @endforeach
                                    <select>
                                </div>
                            </div>
                        </div>
                        <!-- ADDRESS -->
                        <div class="field">
                            <div class="control has-icons-left">
                                <input type="text" name="address" value="{{old('address')}}" placeholder="aдрес/офис за доставка" :class="{'input': true, 'is-danger': errors.has('АДРЕС') }" v-validate="'required|min:5|max:255'" data-vv-name="АДРЕС" @if(old('address')) @else autofocus @endif>
                                <span class="icon is-left"><i class="fa fa-truck"></i></span>
                                <div v-show="errors.has('АДРЕС')" class="help is-danger">@{{ errors.first('АДРЕС') }}</div>
                            </div>
                        </div>
                        <small>Ако не виждате вашето населено място в списъка, молим допишете го в адреса.</small>
                        --}}
                    <!-- CARD CONTENT -->
                        {{-- @if($ct > 99.00)
                          <span class="tag is-success">0.00лв.</span>
                        @else
                          <span class="tag is-success">{{ $shipping->price }}лв.</span>
                        @endif --}}


                </div>
            </div>
          </div>



          <!-- TOTAL + TERMS -->
          <div class="column is-12 py-3 has-text-centered">
            <div class="has-text-centered caveat p-b-50">
              <span class="is-size-3">ЗА ПЛАЩАНЕ</span> <br />
              <span class="is-size-6">(плащане при доставка, куриерската такса не е включена)</span>
              <span class="is-size-1">{{ Cart::total() }}лв.</span>
            </div>
            <input class="is-checkbox has-background-color is-success is-medium" id="terms" type="checkbox" name="terms">
            <label for="terms" class="is-size-6">ПРИЕМАМ <a href="{{route('info.terms')}}" target="_blank" >ОБЩИТЕ УСЛОВИЯ</a></label>
          </div>
          <!-- BUTTON -->
          <div class="column is-12 px-5">
            <button type="submit" class="button is-success is-fullwidth m-b-50">
              <span>ПОРЪЧАЙ</span>
            </button>
          </div>
          <!-- END BUTTON -->



  </div>
</form>
@endsection
@section('scripts')
<script>
new Vue({
    el: '#fast_order',
    data: {
      modal_fast_order: false,
    },
  })
new Vue({
  el: '#cart_products',
  data:{
    <?php foreach(Cart::content() as $row) { echo "number$row->rowId: $row->qty, "; } ?>
    <?php foreach(Cart::content() as $row) { echo "cart_delete$row->rowId: false, "; } ?>
    <?php foreach(Cart::content() as $row) { echo "cart_update$row->rowId: false, "; } ?>
  }
})
new Vue({
    el: '#create_order',
    data: {
        active_1: true,
        active_2: false,
        active_3: false,
        active_4: false,
        econt: true,
        speedy: false,
        data: [<?php foreach($zones as $zone) { echo "'$zone->name'".', '; } ?>],
        zone_name: '',
        selected: null,
        shipping_type: 'до офис',
        shipping_firm: 'ЕКОНТ',
        payment: '{{ $defaultPayment }}',
    },
    computed: {
            filteredDataArray() {
                return this.data.filter((option) => {
                    return option
                        .toString()
                        .toLowerCase()
                        .indexOf(this.zone_name.toLowerCase()) >= 0
                })
            }
        },


})
</script>
@endsection
