@extends('manage.dashboard')

@section('title', '| ПОРЪЧКA')

@section('manage.content')
<div class="columns" id="orderShow">
    <div class="column">

        <div class="columns is-multiline">
            <div class="column is-3 has-text-centered">
                <div class="box">
                    <i class="fa fa-user fa-3x"></i> <br />
                    <span class="is-size-4">{{$order->names}}</span> <br />
                    <span class="is-size-5">{{$order->phone}}</span> <br />
                    <span class="is-size-5 has-text-primary">@if($order->viber == 1) <i class="fa fa-whatsapp fa-lg"></i>@endif</span>
                    @if($order->comment)
                        <hr /> <strong class="has-text-danger"> {{$order->comment}} </strong>
                    @endif
                </div>
            </div>
            <div class="column is-5">
                <div class="box">
                    <span class="is-size-4">#{{$order->id}} </span> <br />
                    <i class="fa fa-truck fa-lg"></i> {{$order->shipping->name}} <br />
                    <i class="fa fa-globe fa-lg"></i> @if(!empty($order->zone->name)){{$order->zone->name}}@endif<br />
                    <i class="fa fa-home fa-lg"></i> {{$order->address}} <br />
                    <i class="fa fa-calendar fa-lg"></i> {{date("d M Y # H:i", strtotime($order->created_at))}}
                </div>
            </div>
            <div class="column is-4">
                <div class="box">
                    <a href="#" class="button is-dark is-outlined is-fullwidth"><b-icon icon="edit"></b-icon><span>РЕДАКТИРАЙ</span></a>
                    <!-- SHOW STATUSES -->

                        @foreach($statuses as $status)
                            @if($status->id > 1)
                                <b-modal :active.sync="modal{{ $status->id }}">
                                    <div class="box">
                                        <form method="post" action="{{ route('manage.order.store.status') }}" >
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $status->id }}" name="status_id" />
                                            <input type="hidden" value="{{ $order->id }}" name="order_id" />
                                            <span class="is-size-4">КОМЕНТАР</span>
                                            <textarea name="comment" class="textarea m-t-20" /></textarea>
                                            <button type="submit" href="#" class="button is-success is-outlined is-fullwidth m-t-30"> ЗАПИШИ </button>
                                        </form>
                                    </div>
                                </b-modal>
                                <button class="button is-@if($status->id == 1)danger @elseif($status->id == 2)warning @elseif($status->id == 3)info @elseif($status->id == 4)success @elseif($status->id == 5)dark @endif is-small is-fullwidth m-t-10" @click="modal{{ $status->id }} = true">{{ $status->name }}</button>
                            @endif
                        @endforeach

                </div>
            </div>
        </div>

        <table class="table is-fullwidth is-bordered">
            <tr><td colspan="7" class="is-light"><div class="has-text-centered subtitle is-5 has-text-dark">ПРОДУКТИ</div></td></tr>
            <tr>
                <td></td>
                <th>ИМЕ</th>
                <th>МОДЕЛ</th>
                <th>ОПЦИИ</th>
                <th>КОЛИЧЕСТВО</th>
                <th>ЦЕНА</th>
                <th>ОБЩО</th>
            </tr>
            @foreach($order->products as $product)
            <tr>
                <td>
                    <div class="has-text-centered">
                        <a href="{{route('manage.products.show', $product->id)}}" class="button is-small is-success" target="_blank"> ОТВОРИ </a>
                    </div>
                </td>
                <td>{{$product->name}}</td>
                <td>{{$product->model}}</td>
                <td>{{$product->pivot->options}}</td>
                <td>{{$product->pivot->quantity}}</td>
                <td>{{$product->pivot->sold_price}}лв.</td>
                <td>{{$product->pivot->quantity * $product->pivot->sold_price}}лв.</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5"><div class="has-text-right">{{$order->shipping->name}}</div></td>
                <td>
                    @if($order->total_price > 100.00)
                        0.00лв.
                    @else
                        {{$order->shipping_price}}лв.
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="5"><div class="has-text-right subtitle is-4">КРАЙНА ЦЕНА</div></td>
                <td><div class="subtitle is-4">{{$order->total_price}}лв.</div></td>
            </tr>
        </table>
        <table class="table is-fullwidth is-bordered">
            <tr><td colspan="3" class="is-light"><div class="has-text-centered subtitle is-5 has-text-dark">ДВИЖЕНИЕ</div></td></tr>
            <tr>
                <th>СТАТУС</th>
                <th>ДАТА</th>
                <th>КОМЕНТАР</th>
            </tr>
            @foreach($usedstatuses as $status)
            <tr>
                <td>
                    <span class="has-text-@if($status->id == 1)danger @elseif($status->id == 2)warning @elseif($status->id == 3)info @elseif($status->id == 4)success @else dark @endif">{{$status->name}}</span>
                </td>
                <td>{{date("d M Y # H:i", strtotime($status->pivot->created_at))}}</td>
                <td class="has-text-danger is-size-5">{{ $status->pivot->comment }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection


@section('scripts')
<script>
new Vue({
    el: '#orderShow',
    data: {
        <?php foreach($statuses as $status) { echo 'modal'.$status->id.':false, '; } ?>
    },
})
</script>
@endsection
