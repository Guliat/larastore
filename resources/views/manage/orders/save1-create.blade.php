@extends('manage.dashboard')

@section('title', '| ПОСЛЕДНИ СТЪПКИ')

@section('header', 'ПОСЛЕДНИ СТЪПКИ')

@section('quickMenu')
<a href="{{ route('home') }}" class="button is-dark is-medium"><i class="fa fa-home"></i></a>
<a href="{{ route('cart.show') }}" class="button is-dark is-medium"><i class="fa fa-shopping-cart"></i></a>
@endsection

@section('manage.content')
<div class="columns" id="create_order">
    <div class="column" v-cloak>
        <form method="post" action="{{route('order.store')}}">
            {{csrf_field()}}
            <span class="tag is-rounded is-success" v-if="userNames"><b-icon icon="check"></b-icon> @{{userNames }}</span>
            <span class="tag is-rounded is-success" v-if="userPhone"><b-icon icon="check"></b-icon> @{{userPhone }}</span>
            <b-collapse class="panel" :open.sync="userPanel" v-model="autoCloseUserPanel">
                <div slot="trigger" class="panel-heading">
                    ВАШИТЕ ДАННИ
                    <b-icon class="is-pulled-right" :icon="userPanel ? 'expand_less' : 'expand_more'"></b-icon>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="has-text-left">ВАШИТЕ ИМЕНА</div>

                        <input type="text" name="names" v-model="userNames" placeholder="вашите имена" :class="{'input': true, 'is-danger': errors.has('ВАШИТЕ ИМЕНА') }" v-validate="'required|min:3|max:255'" data-vv-name="ВАШИТЕ ИМЕНА">
                        <div v-show="errors.has('ВАШИТЕ ИМЕНА')" class="help is-danger">@{{ errors.first('ВАШИТЕ ИМЕНА') }}</div>

                        <div class="has-text-left m-t-20">ТЕЛЕФОН</div>
                        <input type="text" name="phone" v-model="userPhone" placeholder="вашият телефонен номер" :class="{'input': true, 'is-danger': errors.has('ТЕЛЕФОН') }" v-validate="'required|numeric|min:5|max:255'" data-vv-name="ТЕЛЕФОН">
                        <div v-show="errors.has('ТЕЛЕФОН')" class="help is-danger">@{{ errors.first('ТЕЛЕФОН') }}</div>

                        <div class="m-t-20">
                            <a class="button is-success is-outlined" @click="goToShipping">НАПРЕД</a>
                        </div>
                    </div>
                </div>
            </b-collapse>
            <!-- SHIPPING METHOD -->
            <span class="tag is-rounded is-success"><b-icon icon="check"></b-icon> @{{shipping}} </span>
            <span class="tag is-rounded is-success" v-if="zone"><b-icon icon="check"></b-icon> @{{zone}}</span>
            <span class="tag is-rounded is-success" v-if="address"><b-icon icon="check"></b-icon> @{{address}}</span>
            <b-collapse class="panel" :open.sync="shippingPanel" v-model="autoCloseShippingPanel">
                <div slot="trigger" class="panel-heading">
                    ДОСТАВКА И АДРЕС
                    <b-icon class="is-pulled-right" :icon="shippingPanel ? 'expand_less' : 'expand_more'"></b-icon>
                </div>
                <div class="card">
                    <div class="card-content">
                        @foreach($shippings as $shipping)
                                <b-field>
                                    <b-radio v-model="shipping" native-value="{{$shipping->name}}" type="is-success" name="shipping">
                                        <span>
                                            <?php $ct = null; foreach(Cart::content() as $ctRow) { $ct += $ctRow->total; } ?>
                                            @if($ct > 100.00)
                                                <span class="tag is-success">0.00лв.</span>
                                            @else
                                                <span class="tag is-success">{{$shipping->price}}лв.</span>
                                            @endif
                                            {{$shipping->name}}
                                        </span>
                                    </b-radio>
                                </b-field>
                        @endforeach
                        <hr>
                        <div class="field">
                            <div class="control">
                                <div class="select">
                                    <select v-model="zone" name="zone">
                                        <option disabled value="">- населено място -</option>
                                        @foreach($zones as $zone)
                                            <option value="{{$zone->name}}" >{{$zone->name}}</option>
                                        @endforeach
                                    <select>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input type="text" name="address" v-model="address" placeholder="aдрес за доставка" :class="{'input': true, 'is-danger': errors.has('АДРЕС') }" v-validate="'required|min:5|max:255'" data-vv-name="АДРЕС">
                                <div v-show="errors.has('АДРЕС')" class="help is-danger">@{{ errors.first('АДРЕС') }}</div>
                            </div>
                        </div>
                        <small>Ако не виждате вашето населено място в списъка, молим допишете го в адреса.</small>
                        <div class="m-t-20">
                            <a class="button is-success is-outlined" @click="goToPayment">НАПРЕД</a>
                        </div>
                    </div>
                </div>
            </b-collapse>
            <!-- PAYMENT METHOD -->
            <span class="tag is-rounded is-success"><b-icon icon="check"></b-icon> @{{payment}} </span>
            <b-collapse class="panel" :open.sync="paymentPanel" v-model="autoClosePaymentPanel">
                <div slot="trigger" class="panel-heading">
                    ПЛАЩАНЕ / КОМЕНТАР
                    <b-icon class="is-pulled-right" :icon="paymentPanel ? 'expand_less' : 'expand_more'"></b-icon>
                </div>
                <div class="card">
                    <div class="card-content">
                        @foreach($payments as $payment)
                            <b-field>
                                <b-radio v-model="payment" native-value="{{$payment->name}}" type="is-success" name="payment" >
                                    <span>{{$payment->name}}</span>
                                </b-radio>
                            </b-field>
                        @endforeach
                        <hr>
                        <div class="has-text-left m-t-10">КОМЕНТАР / ДОПЪЛНИТЕЛНИ ИЗИСКВАНИЯ</div>
                        <textarea name="comment" class="textarea"></textarea>
                        <hr>
                        <div class="m-t-40 m-b-40">
                            <input class="is-checkbox has-background-color is-success" id="terms" type="checkbox" name="terms" >
						    <label for="terms" class="is-size-6">ПРОЧЕТОХ И ПРИЕМАМ ТЕЗИ <a href="#">ОБЩИ УСЛОВИЯ</a></label>
                        </div>
                        <!-- <input type="hidden" name="total_price" value="{{ Cart::total() }}"> -->
                        <button type="submit" class="button is-success is-fullwidth">ПОРЪЧАЙ</button>
                    </div>
                </div>
            </b-collapse>
            <!-- CONFIRM -->
            <!-- <b-collapse class="panel" :open.sync="confirmPanel" v-model="autoCloseConfirmPanel"> -->
                <!-- <div slot="trigger" class="panel-heading"> -->
                    <!-- ОТСТЪПКА / -->
                     <!-- ПОТВЪРЖДЕНИЕ -->
                    <!-- <b-icon class="is-pulled-right" :icon="confirmPanel ? 'expand_less' : 'expand_more'"></b-icon> -->
                <!-- </div> -->
                <!-- <div class="card"> -->
                    <!-- <div class="card-content"> -->
                            <!-- <div class="has-text-left">ВАУЧЕР / ТАЛОН ЗА ОТСТЪПКА</div>
                            <div class="field has-addons">
                                <div class="control">
                                    <button type="submit" class="button is-success">ДОБАВИ</button>
                                </div>
                                <div class="control is-expanded">
                                    <input type="text" name="vaucher" placeholder="въведете кода тук" class="input">
                                </div>
                            </div>
                            <div class="has-text-left">
                                <div class="tag is-danger">-10.00лв.</div>
                                <div class="tag is-danger">-14.00лв.</div>
                            </div> -->
                        <!-- <div class="columns is-centered">
                            <div class="column is-6">
                                <div class="has-text-centered notification is-white p-l-40">
                                    <span class="subtitle is-4">ЗА ПЛАЩАНЕ</span><hr>
                                </div>
                            </div>
                        </div> -->
                    <!-- </div> -->
                <!-- </div> -->
            <!-- </b-collapse> -->


        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var App = new Vue({
        el: '#dangernotify',
        data: {},
    })

    var App = new Vue({
        el: '#create_order',
        data: {
            userNames: '{{old("names")}}',
            userPhone: '{{old("names")}}',
            zone: '',
            address: '',
            shipping: '{{$defaultShipping}}',
            payment: '{{$defaultPayment}}',
            userPanel: true,
            shippingPanel: false,
            paymentPanel: false,
            confirmPanel: false
        },
        computed: {
            autoCloseUserPanel: function() {
                if(this.shippingPanel == true || this.paymentPanel == true || this.confirmPanel == true) {
                    return this.userPanel = false
                }
            },
            autoCloseShippingPanel: function() {
                if(this.userPanel == true || this.paymentPanel == true || this.confirmPanel == true) {
                    return this.shippingPanel = false
                }
            },
            autoClosePaymentPanel: function() {
                if(this.userPanel == true || this.shippingPanel == true || this.confirmPanel == true) {
                    return this.paymentPanel = false
                }
            },
            autoCloseConfirmPanel: function() {
                if(this.userPanel == true || this.shippingPanel == true || this.paymentPanel == true) {
                    return this.confirmPanel = false
                }
            }

        },
        methods: {
            goToShipping() {
                this.shippingPanel = true
            },
            goToPayment() {
                this.paymentPanel = true
            },
            goToConfirm() {
                this.confirmPanel = true
            }
        },
    })
</script>
@endsection
