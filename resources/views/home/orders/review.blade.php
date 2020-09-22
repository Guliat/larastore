@extends('main')
@section('title', '| ПРЕГЛЕД ПРЕДИ ПОРЪЧКА')
@section('header', 'ПРЕГЛЕД ПРЕДИ ПОРЪЧКА')
@section('content')
<div class="columns is-multiline is-marginless is-centered" id="create_review">
  <div class="column is-4">
    <form method="post" action="{{ route('order.store') }}">
      @csrf
      <div class="box has-text-centered">
        <div class="p-b-5">
          <input class="is-checkbox has-background-color is-success is-medium" id="terms" type="checkbox" name="terms">
          <label for="terms" class="is-size-6">ПРИЕМАМ <a href="{{route('info.terms')}}" target="_blank" >ОБЩИТЕ УСЛОВИЯ</a></label>
        </div>
      </div>
      <button type="submit" class="button is-success is-medium is-fullwidth m-t-20 m-b-50">ПОРЪЧАЙ</button>
    </form>
    <div class="box has-text-centered is-size-5 has-text-grey">
      <div class="has-text-centered pt-3">
        <span class="is-size-3 caveat">ЗА ПЛАЩАНЕ</span> <br />
        <span class="is-size-3">{{ Cart::total() }}лв.</span> <br />
        <span class="is-size-7">(<i>плащане при доставка, куриерската такса не е включена</i>)</span>
      </div>
      <hr />
      <u class="is-size-6 has-text-dark heading">Получател</u>
      {{ session()->get('customer_names') }} <br /><br />
      <u class="is-size-6 has-text-dark heading">Телефон</u>
      {{ session()->get('customer_phone') }} <br /><br />
      <u class="is-size-6 has-text-dark heading">фирма и начин на доставка</u>
      {{ session()->get('shipping_company') }} - {{ session()->get('shipping_type') }} <br /><br />
      <u class="is-size-6 has-text-dark heading">град и адрес за доставка</u>
      <b>{{ session()->get('shipping_zone') }}</b> <br />
      {{ session()->get('address') }}
      @if(session()->has('comment'))
        <hr /><strong class="has-text-danger"> {{session()->get('comment')}} </strong>
      @endif
    </div>
  </div>
</div>
@endsection