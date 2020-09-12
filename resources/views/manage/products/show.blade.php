@extends('manage.dashboard')

@section('title', '| ПРЕГЛЕД НА ПРОДУКТ')
@section('header', 'ПРЕГЛЕД НА ПРОДУКТ')

@section('manage.content')
<div class="columns is-multiline">

    <div class="column is-12 has-text-centered">
        @foreach($photos as $photo)
            <a href="{{ url('') }}/images/{{ $photo->photo }}" target="_blank">
                <img src="{{ asset('/images/half') }}/{{ $photo->photo }}" width="225" height="225"  />
            </a>
        @endforeach
    <hr />
    </div>
    <div class="column is-4 is-size-5">
        <strong>ИМЕ:</strong> {{$product->name}} <br />
		<strong>URL:</strong> {{$product->slug}} <br />
        <strong>КАТЕГОРИЯ:</strong> {{ $category->name }} <br />
        <strong>ТАГОВЕ:</strong> {{ $product->tags }} <br />
        <strong>МОДЕЛ:</strong> {{ $product->model }} <br />
        <strong>ЦЕНА:</strong> {{ $product->sell_price }}
        <hr />
        <strong>ОПЦИИ</strong>
        @foreach($product->options_groups as $option_group)
            <br  />{{ $option_group->name }}:
            @foreach($product->product_options($product->id, $option_group->id) as $options)
                @foreach($product->options($options->option_id) as $option)
                    <div class="tag is-success">{{ $option->name }}</div>
                @endforeach
            @endforeach
        @endforeach
    </div>
    <div class="column is-4 is-size-5">
        <strong>ОПИСАНИЕ:</strong> <br />
        <pre>{!! $product->description !!}</pre>
        <strong>СЪСТАВ:</strong> <br />
        <pre>{!! $product->fabric !!}</pre>
    </div>
    <div class="column is-4">
        <a href="{{ route('manage.products.edit', $product->id) }}" class="button is-primary is-fullwidth">РЕДАКТИРАЙ ТЕКСТА</a>
        <a href="{{ route('manage.photos.show', $product->id) }}" class="button is-primary is-fullwidth m-t-10">РЕДАКТИРАЙ СНИМКИТЕ</a>
        @if($product->is_approved == 0)
            <form action="{{ route('manage.products.approve.update', $product->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('put') }}
                <button type="submit" class="button is-success is-medium is-fullwidth m-t-10">ПУСНИ ПРОДУКТА</button>
            </form>
        @endif
    </div>

</div>
@endsection
