@extends('main')
@section('title', "| КОШНИЦА")
@section('header', "КОШНИЦА")

@section('content')
<div class="columns is-multiline has-text-centered">
    <div class="column is-12 p-t-30 has-text-left">
        @include('partials.buttons._back')
        @if(Cart::count() > 0)
            @include('partials.buttons._sendOrder')
        @endif
    </div>
    @if(Cart::count() >= 1)
    <?php foreach(Cart::content() as $row) :
         // $photo = App\Http\Controllers\HomeController::getProductImage($row->id);
         $slug = App\Http\Controllers\HomeController::getProductSlug($row->id);
         ?>
    <div class="column is-one-quarter">
        <div class="card has-ribbon">
            <div class="ribbon is-large is-primary">{{ $row->price }}лв.</div>

            <div class="card-image">
                <a href="{{ route('slug', $slug->slug) }}" target="_blank">
                    <img src="{{asset('/images/half')}}/{{ \App\Product::firstPhoto($row->id)->photo }}" width="100%" height="100%" alt="{{ $row->name }}" title="{{ $row->name }}" />
                </a>
            </div>

            <div class="is-size-6 m-t-20 m-l-10 m-r-10">
                {{ $row->name }}
            </div>

            @foreach($row->options as $option)
                @if(!empty($option))
                    {{-- <span class="tag is-dark is-medium m-t-20 badge is-badge-primary is-badge-medium" data-badge="{{ $option }}">РАЗМЕР</span> --}}
                @endif
            @endforeach

            <div class="buttons is-centered m-t-30">
                <form method="post" action="{{ route('cart.update.up') }}">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <input type="hidden" value="{{ $row->rowId }}" name="rowId" />
                    <input type="hidden" value="{{ $row->qty }}" name="quantity" />
                    <button type="submit" class="button is-success"><i class="fa fa-arrow-up fa-lg"></i></button>
                </form>
                <a class="button is-dark  m-r-5 m-l-5"> {{ $row->qty }}бр. / {{ $row->total }}лв.</a>
                <form method="post" action="{{ route('cart.update.down') }}">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <input type="hidden" value="{{ $row->rowId }}" name="rowId" />
                    <input type="hidden" value="{{ $row->qty }}" name="quantity" />
                    <button type="submit" class="button is-danger" @if($row->qty <= 1) disabled @endif><i class="fa fa-arrow-down fa-lg"></i></button>
                </form>
            </div>

            <form method="post" action="{{route('cart.delete')}}">
                {{csrf_field()}}
                <input type="hidden" value="{{$row->rowId}}" name="rowId" />
                <button type="submit" class="button is-light is-fullwidth is-outlined m-t-20"><i class="fa fa-trash has-text-danger fa-lg"></i></button>
            </form>

        </div>
    </div>
   	<?php endforeach; ?>

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
</div>
@endsection
