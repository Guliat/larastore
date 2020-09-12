@extends('main')
@section('title', '| ПОРЪЧКА #'. $order->id)
@section('header', 'ПОРЪЧКА #'. $order->id)
@section('content')
<div class="columns is-multiline p-t-20">
    <div class="column is-12 has-text-centered is-size-3">
        <div class="is-size-5 notification is-success">Благодарим ви за направената поръчка, за потвърждение наш служител ще се свърже с вас в рамките на един работен ден.</div>
        <small>СУМА ЗА ПЛАЩАНЕ</small> {{ $order->total_price }}лв.
        <br />
        <small class="is-size-6">
            <small>ПРОДУКТИ:</small> {{ $order->total_price -  $order->shipping_price }}лв. |
            <small>ДОСТАВКА:</small>
            @if($order->total_price > 100.00)
                0.00лв.
            @else
                {{ $order->shipping_price }}лв.
            @endif
        </small>
        {{-- <div class="notification is-dark is-large">
            <small class="is-size-6">УНИКАЛЕН КОД</small>
            <span class="has-tooltip-multiline has-tooltip-danger is-size-5" data-tooltip="Уникален код за проверка и управление на поръчката.">
                <i class="fa fa-question-circle"></i>
            </span>
            <br />
            {{ str_random(10) }}
        </div> --}}
    </div>
    <!-- STEPS -->
    <div class="column is-12">
        <ul class="steps is-medium">
            <!-- STEP 1 -->
            <li class="steps-segment">
                <span class="steps-marker is-hollow">
                    <span class="icon is-size-6 has-text-success">
                        <i class="fa fa-check"></i>
                    </span>
                </span>
                <div class="steps-content is-divider-content">
                    <p class="is-size-7">Вашата поръчка е регистрирана в системата ни и изпратена за обработка.</p></p>
                </div>
            </li>
            <!-- STEP 2 -->
            <li class="steps-segment is-active">
                <span class="steps-marker is-hollow is-success">
                    <span class="icon is-size-6 has-text-success">
                        <i class="fa fa-archive"></i>
                    </span>
                </span>
                <div class="steps-content is-divider-content">
                    <p class="is-size-7">Вашата поръчка е обработена и предадена на куриер за доставка.</p>
                </div>
            </li>
            <!-- STEP 3 -->
            <li class="steps-segment">
                <span class="steps-marker ">
                    <span class="icon is-size-6">
                        <i class="fa fa-truck"></i>
                    </span>
                </span>
                <div class="steps-content is-divider-content">
                    <p class="is-size-7">Пратката пътува към посочения от вас адрес.</p>
                </div>
            </li>
            <!-- STEP 4 -->
            <li class="steps-segment">
                <span class="steps-marker ">
                    <span class="icon is-size-6">
                        <i class="fa fa-flag"></i>
                    </span>
                </span>
            </li>
        </ul>
    </div>
    <!-- INFO -->
    <div class="column is-12">
        <div class="columns is-multiline">
            <!-- CUSTOMER INFO -->
            <div class="column is-4 is-size-5 has-text-centered">
                <div class="box">
                    <i class="fa fa-user fa-2x"></i><br />
                    {{$order->names}} <br />
                    <i class="fa fa-phone fa-2x"></i><br />
                    {{$order->phone}} <br />
                    {{-- <b class="is-size-7">Нямате профил ?</b> <u class="is-size-7">Нужен ли ми е ? (modal)</u> <br />
                    <a href="#" class="button is-success is-small">СЪЗДАЙТЕ ПРОФИЛ</a> <br /> --}}
                </div>
            </div>
            <!-- ORDER INFO -->
            <div class="column is-4 has-text-left">
                <div class="box">
                    <span class="is-size-5"><i class="fa fa-shopping-basket"></i> #{{$order->id}} </span> <br />
                    <i class="fa fa-truck fa-lg"></i> {{$order->shipping->name}} <br />
                    <i class="fa fa-globe fa-lg"></i> {{$order->zone->name}} <br />
                    <i class="fa fa-home fa-lg"></i> {{$order->address}} <br />
                    <i class="fa fa-calendar fa-lg"></i> {{date("d M Y # H:i", strtotime($order->created_at))}} <br />
                    @if($order->comment)
                        <hr />
                        <i class="fa fa-comment fa-lg"></i>
                        {{$order->comment}}
                    @endif
                </div>
            </div>
            <div class="column is-4">
            </div>

            <!-- PRODUCTS -->
            <div class="column is-12 has-text-centered">
                <span class="subtitle">ПРОДУКТИ</span>
                <hr />
                <div class="columns is-multiline">
                    @foreach($order->products as $product)
                        <div class="column is-one-quarter">
                        <div class="card" style="min-height: 510px;">
                            <div class="card-image">
                                <a href="{{route('slug', $product->slug)}}" target="_blank">
                                    <img src="{{asset('/images/half')}}/{{ \App\Product::firstPhoto($product->id)->photo }}" width="100%" height="100%" alt="{{ $product->name }}" title="{{ $product->name }}" />
                                </a>
                            </div>
                            <div class="card-content">
                                <strong>{{ $product->name }}</strong><br />
                                МОДЕЛ: {{ $product->model }}<br />
                                ОПЦИИ: {{ $product->pivot->options }}<br />
                                @if($product->pivot->quantity > 1)
                                    КОЛИЧЕСТВО: {{ $product->pivot->quantity }}бр. <br />
                                    ЦЕНА: {{ $product->pivot->sold_price }}лв. <br />
                                @endif
                                КРАЙНА ЦЕНА: <b>{{ $product->pivot->quantity * $product->pivot->sold_price }}лв.</b>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection
