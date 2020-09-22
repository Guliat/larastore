@extends('main')
@section('title', '| ПРЕГЛЕД И ПОРЪЧКА')
@section('header', 'ПРЕГЛЕД И ПОРЪЧКА')
@section('content')

@if(Cart::count() >= 1)

<div class="columns is-multiline is-marginless" id="create_order">
  {{-- MODAL FAST ORDER --}}
    <div class="column is-12 has-text-centered">
      <b-modal :active.sync="modal_fast_order" :width="330">
        <div class="box">
          <form method="post" action="{{ route('order.fast.store') }}" >
            @csrf
              <span class="heading is-size-5">БЪРЗА И ЛЕСНА ПОРЪЧКА</span>
              <hr />
              <i class="is-size-6">Въведете телефонен номер и ние ще се свържем с вас.</i>
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input type="input" name="phone" class="input is-success" placeholder="телефонен номер" :class="{'input': true, 'is-danger': errors.has('ТЕЛЕФОНЕН НОМЕР') }" v-validate="'required|numeric|min:10|max:10'" data-vv-name="ТЕЛЕФОНЕН НОМЕР" />
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
            <a class="button is-light is-small" @click="modal_fast_order = false">ОТКАЗ</a>
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
    <div class="column is-12">
      <div class="columns is-multiline">
        <div class="column is-12">ДОБАВЕНИ ПРОДУКТИ</div>
        <?php foreach(Cart::content() as $row) : $slug = App\Http\Controllers\HomeController::getProductSlug($row->id); ?>
          <div class="column is-one-third box mx-3">
            <div class="columns is-mobile">
              <div class="column is-1">
                <div class="columns is-multiline">
                  <div class="column is-12 pt-4">
                    <b-modal :active.sync="cart_delete{{ $row->rowId }}" :width="330">
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
                      <i class="fa fa-close has-text-danger"></i>
                    </a>
                  </div>
                  <div class="column is-12 is-paddingless mt-2" style="height: 3px; width: 100%;background-color: #eee"></div>
                  <div class="column is-12 pt-4">
                    <b-modal :active.sync="cart_update{{ $row->rowId }}" :width="330">
                      <div class="box">
                        <form method="post" action="{{ route('cart.update') }}" >
                          @csrf
                          @method('put')
                          <input type="hidden" value="{{$row->rowId}}" name="rowId" />
                          <div class="field">
                            <span class="subtitle">РАЗМЕР</span>
                            <div class="control">
                              <div class="select is-danger">
                                <select name="option">
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
                          <b-numberinput type="is-danger" icon-pack="fa" min="1" max="5" name="quantity" v-model="number{{ $row->rowId }}"></b-numberinput>
                          <hr />
                          <button type="submit" href="#" class="button is-success">ОБНОВИ</button>
                          <a class="button is-dark" @click="cart_update{{ $row->rowId }} = false">ОТКАЗ</a>
                        </form>
                      </div>
                    </b-modal>
                    <a @click="cart_update{{ $row->rowId }} = true">
                      <i class="fa fa-refresh has-text-success"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="column is-4">
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
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  {{-- END CART LIST --}}

  {{-- CREATE ORDER FORM --}}
    <div class="column is-marginless is-12">
      <form method="post" action="{{route('order.store.session')}}">
        @csrf
        <ul class="steps has-gaps is-small">
          <!-- STEP 1 -->
          <li class="steps-segment" :class="{ 'is-active': active_1 }">
            <span class="steps-marker">
              <i class="fa fa-user"></i>
            </span>
            <div class="steps-content is-divider-content">
              <!-- NAMES -->
              <div class="has-text-left">ВАШИТЕ ИМЕНА</div>
              <div class="control has-icons-left">
                <input type="text" name="names" value="@if(!empty(session()->has('customer_names'))){{ session()->get('customer_names') }}@endif"
                placeholder="вашите имена"
                :class="{'input': true, 'is-danger': errors.has('ВАШИТЕ ИМЕНА') }"
                v-validate="'required|alpha_spaces|min:3|max:50'"
                data-vv-name="ВАШИТЕ ИМЕНА">
                <span class="icon is-left"><i class="fa fa-user"></i></span>
              </div>
              <div v-show="errors.has('ВАШИТЕ ИМЕНА')" class="help is-danger">@{{ errors.first('ВАШИТЕ ИМЕНА') }}</div>
              <!-- PHONE -->
              <div class="has-text-left m-t-10">ТЕЛЕФОН</div>
              <div class="control has-icons-left">
                <input type="text" name="phone" value="@if(!empty(session()->has('customer_phone'))){{ session()->get('customer_phone') }}@endif"
                placeholder="телефонен номер"
                :class="{'input': true, 'is-danger': errors.has('ТЕЛЕФОН') }"
                v-validate="'required|numeric|min:10|max:10'"
                data-vv-name="ТЕЛЕФОН" @blur="active_2 = true; active_1 = false">
                <span class="icon is-left"><i class="fa fa-phone"></i></span>
              </div>
              <div v-show="errors.has('ТЕЛЕФОН')" class="help is-danger">@{{ errors.first('ТЕЛЕФОН') }}</div>
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
              <b-field>
                <b-radio-button v-model="shipping_company" name="shipping_company" native-value="ЕКОНТ" type="is-info" @click="active_2 = true; active_1 = false">
                <span class="px-5">ЕКОНТ</span>
                </b-radio-button>
                <b-radio-button v-model="shipping_company" name="shipping_company" native-value="СПИДИ" type="is-warning" @click="active_2 = true; active_1 = false">
                <span class="px-5">СПИДИ</span>
                </b-radio-button>
              </b-field>
              <b-field>
                <b-radio-button v-model="shipping_type" name="shipping_type" native-value="ОФИС" type="is-dark" @click="active_2 = true; active_1 = false">
                <span class="px-5">ДО ОФИС</span>
                </b-radio-button>
                <b-radio-button v-model="shipping_type" name="shipping_type" native-value="АДРЕС" type="is-dark" @click="active_2 = true; active_1 = false">
                <span class="px-5">ДО АДРЕС</span>
                </b-radio-button>
              </b-field>
            </div>
          </li>
          <!-- STEP 3 -->
          <li class="steps-segment" :class="{ 'is-active': active_3 }">
            <span class="steps-marker">
              <span class="icon is-size-6">
                <i class="fa fa-home"></i>
              </span>
            </span>
            <div class="steps-content is-divider-content">
              <div class="has-text-left">ГРАД</div>
              <b-field>
                <b-autocomplete
                name="zone"
                v-model="zone_name"
                :data="filteredDataArray"
                placeholder="(на кирилица)"
                clearable="true"
                icon-right="globe"
                icon="globe"
                icon-pack="fa"
                open-on-focus="openOnFocus"
                clearable="clearable"
                @select="option => selected = option"
                @focus="active_3 = true; active_1 = false, active_2 = false">
                <template slot="empty">Няма такъв град в нашата база данни.</template>
                </b-autocomplete>
              </b-field>
              <!-- ADDRESS -->
              <div class="has-text-left">АДРЕС</div>
              <div class="field">
                <div class="control has-icons-left">
                <input type="text" name="address" value="@if(!empty(session()->has('address'))){{ session()->get('address') }}@endif"
                placeholder="адрес за доставка"
                :class="{'input': true, 'is-danger': errors.has('АДРЕС') }"
                v-validate="'required|min:5|max:100'"
                data-vv-name="АДРЕС" @focus="active_3 = true" @blur="active_3 = false; active_4 = true">
                <span class="icon is-left"><i class="fa fa-truck"></i></span>
                <div v-show="errors.has('АДРЕС')" class="help is-danger">@{{ errors.first('АДРЕС') }}</div>
                </div>
              </div>
            </div>
          </li>
          <!-- STEP 4 -->
          <li class="steps-segment" :class="{ 'is-active': active_4 }">
            <span class="steps-marker ">
              <span class="icon is-size-6">
                <i class="fa fa-comment"></i>
              </span>
            </span>
            <div class="steps-content is-divider-content has-text-left">
              <div>КОМЕНТАР</div>
              <textarea name="comment" class="textarea" rows="2"
              :class="{'input': true, 'is-danger': errors.has('КОМЕНТАР') }"
              v-validate="'max:1000'"
              data-vv-name="КОМЕНТАР" @focus="active_4 = true; active_3 = false" @blur="active_5 = true; active_4 = false">@if(!empty(session()->has('comment'))){{ session()->get('comment') }}@endif</textarea>
              <div v-show="errors.has('КОМЕНТАР')" class="help is-danger">@{{ errors.first('КОМЕНТАР') }}</div>
            </div>
          </li>
          <!-- STEP 5 -->
          <li class="steps-segment" :class="{ ' is-success': active_5 }">
            <span class="steps-marker ">
              <span class="icon is-size-6">
                <i class="fa fa-flag"></i>
              </span>
            </span>
          </li>
        </ul>
        <button type="submit" class="button is-success is-fullwidth py-5 my-6">
          <span>ПРЕГЛЕД И ПОРЪЧКА</span>
          <span class="icon"><i class="fa fa-arrow-right fa-lg"></i></span>
        </button>
      </form>
    </div>
  {{-- END CREATE ORDER FORM --}}
</div>
@else
<div class="column is-12 has-text-centered">
  <div class="m-t-50 m-b-100"><span class="is-size-4">КОШНИЦАТА ВИ Е ПРАЗНА</span></div>
  <div class="is-divider" data-content="{{ config('app.name') }}"></div>
  <div class="columns is-centered">
    <div class="column has-text-centered"><a href="{{ route('products.all') }}" class="button is-outlined is-primary">ВСИЧКИ ПРОДУКТИ</a></div>
    <div class="column has-text-centered"><a href="{{ route('products.new') }}" class="button is-outlined is-primary">ВСИЧКИ НОВИ ПРОДУКТИ</a></div>
    <div class="column has-text-centered"><a href="{{ route('products.promo') }}" class="button is-outlined is-primary">ВСИЧКИ ПРОМОЦИИ</a></div>
  </div>
</div>
@endif
@endsection
@section('scripts')
  <?php
  $zonesA = null;
  foreach($zones as $zone) { $zonesA .= "'$zone->name'".', '; }
  $zonesS = "[".$zonesA."]";
  ?>
  <script>
  new Vue ({
    el: '#create_order',
    data: {
      modal_fast_order: false,
      <?php foreach(Cart::content() as $row) { echo "number$row->rowId: $row->qty, "; } ?>
      <?php foreach(Cart::content() as $row) { echo "cart_delete$row->rowId: false, "; } ?>
      <?php foreach(Cart::content() as $row) { echo "cart_update$row->rowId: false, "; } ?>
      active_1: true,
      active_2: false,
      active_3: false,
      active_4: false,
      active_5: false,
      shipping_company: 'СПИДИ',
      shipping_type: 'ОФИС',
      zone_name: '',
      data: <?php echo $zonesS; ?>,
      selected: null,
      payment: '{{ $defaultPayment }}',
    },
    computed:{
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