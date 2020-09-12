@extends('manage.dashboard')

@section('title', '| ПОРЪЧКИ')
@section('header', 'ПОРЪЧКИ')

@section('manage.content')

<div class="columns">
    <div class="column box">
        <button class="button is-warning is-medium" onClick="window.location.reload();"><i class="fa fa-refresh"></i></button>
        <table class="table is-fullwidth is-hoverable is-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>СТАТУС</th>
                    <th>КЛИЕНТ</th>
                    <th>ГРАД / АДРЕС</th>
                    <th>ЦЕНА</th>
                    <th>РЕГИСТРИРАНА</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('manage.orders.show', $order->id) }}" class="button is-black m-t-5">{{ $order->id }}</a>
                        </td>
                        <td>
                            <?php $last_status = $order->statuses()->orderBy('id', 'desc')->first(); ?>
                            @if($last_status->id == 1)
                                <span class="tag m-t-10 is-danger">{{ $last_status->name }}</span>
                            @elseif($last_status->id == 2)
                                <span class="tag m-t-10 is-warning">{{ $last_status->name }}</span>
                            @elseif($last_status->id == 3)
                                <span class="tag m-t-10 is-info">{{ $last_status->name }}</span>
                            @elseif($last_status->id == 4)
                                <span class="tag m-t-10 is-success">{{ $last_status->name }}</span>
                            @else
                                <span class="tag m-t-10 is-dark">{{ $last_status->name }}</span>
                            @endif
                        </td>
                        <td>
                            <b>@if($order->phone){{ $order->phone }}@endif</b>
                                <br />
                            <span class="tag is-primary">@if($order->names){{ $order->names }}@endif</span>
                        </td>
                        <td>
                            <span>@if($order->address) {{ $order->zone->name }}@endif, @if($order->address){{ $order->address }}@endif</span>
                            <br />
                            <div class="tag is-light">@if($order->shipping->name){{ $order->shipping->name }}@endif</div>
                        </td>
                        <td>
                            @if($order->total_price) {{ $order->total_price - $order->shipping_price }}лв. @endif
                        </td>
                        <td> {{ date("d M Y # H:i", strtotime($order->created_at)) }} </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        <div> {{ $orders->render('partials._pagination') }} </div>



    </div>
</div>
@endsection
