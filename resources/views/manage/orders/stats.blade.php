@extends('manage.dashboard')
@section('title', '| СТАТИСТИКА')
@section('header', 'СТАТИСТИКА')
@section('manage.content')
<div class="columns is-multiline">
    <div class="column is-12 card">
        <nav class="level">
            {{-- @foreach($shippings as $shipping) --}}
            <div class="level-item has-text-centered">
                <div>
                    {{-- <p class="heading">{{ $shipping->name }}</p> --}}
                    <p class="title">
                    </p>
                </div>
            </div>
            {{-- @endforeach --}}
        </nav>
    </div>
    <div class="column box">
        <table class="table is-fullwidth is-hoverable is-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>#</th>
                    <th>#</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($orders as $order) --}}
                    {{-- @foreach($order->shipping as $ship) --}}
                    {{-- {{ $ship->shipping_id }} --}}
                    {{-- @endforeach --}}
                    <tr>
                        {{-- <td>{{ $order->id }}</td> --}}
                        {{-- <td>{{ $order->zone->name }}</td> --}}
                        {{-- <td>{{ $order->shipping->name }}</td> --}}
                        <td>
                            {{-- @foreach($order->products as $product) --}}
                                {{-- <span class="tag is-dark">МОДЕЛ: {{ $product->model }}</span><br /> --}}
                                {{-- @if($product->pivot->sold_price != $product->sell_price) --}}
                                    {{-- <b class="has-text-success">{{ $product->pivot->sold_price }}лв.</b> - --}}
                                    {{-- <i class="has-text-danger">{{ $product->sell_price }}лв.</i> --}}
                                {{-- @endif --}}
                                <br />
                            {{-- @endforeach --}}
                        </td>
                    </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
@endsection
