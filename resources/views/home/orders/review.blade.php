@extends('main')
@section('title', '| ПРЕГЛЕД ПРЕДИ ПОРЪЧКА')
@section('header', 'ПРЕГЛЕД ПРЕДИ ПОРЪЧКА')
@section('content')
<form method="post" action="#">
{{csrf_field()}}
<div class="columns is-multiline caveat">
  <div class="column is-4">
    <div class="box">
      <div class="has-text-centered is-size-4">
        ЗА ПЛАЩАНЕ<br />
        <span class="is-size-2">{{ Cart::total() + session()->get('shipping_price') }}лв.</span>
      </div>
      <span class="icon has-text-dark"><i class="fa fa-user fa-lg"></i></span> {{session()->get('customer_names')}} <br />
      <span class="icon has-text-dark"><i class="fa fa-phone fa-lg"></i></span> {{session()->get('customer_phone')}} <br />
      <span class="icon has-text-dark"><i class="fa fa-truck fa-lg"></i></span> {{session()->get('shipping_name')}} <br />
      <span class="icon has-text-dark"><i class="fa fa-globe fa-lg"></i></span> {{session()->get('shipping_zone')}} <br />
      <span class="icon has-text-dark"><i class="fa fa-home fa-lg"></i></span> {{session()->get('address')}} <br />
      @if(session()->has('comment'))
        <hr /> <strong class="has-text-danger"> {{session()->get('comment')}} </strong>
      @endif
    </div>
  </div>
  <div class="column is-12 m-t-30 has-text-centered">
    <div class="box">
      <div class="p-b-5">
        <input class="is-checkbox has-background-color is-success is-medium" id="terms" type="checkbox" name="terms">
        <label for="terms" class="is-size-6">ПРИЕМАМ <a href="{{route('info.terms')}}" target="_blank" >ОБЩИТЕ УСЛОВИЯ</a></label>
      </div>
    </div>
    <button type="submit" class="button is-success is-medium is-fullwidth m-t-20 m-b-50">ПОРЪЧАЙ</button>
</div>
</div>
</form>
@endsection

@section('scripts')
<script>
var App = new Vue({
})
</script>
@endsection


<div class="columns is-marginless is-multiline">
  {{csrf_field()}}
  <!-- TOTAL + TERMS -->
  <div class="column is-12 py-3 has-text-centered">
    <div class="has-text-centered p-b-50">
      <span class="is-size-3 caveat">ЗА ПЛАЩАНЕ</span> <br />
      <span class="is-size-1 caveat">{{ Cart::total() }}лв.</span> <br />
      <span class="is-size-7">(<i>плащане при доставка, куриерската такса не е включена</i>)</span>
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