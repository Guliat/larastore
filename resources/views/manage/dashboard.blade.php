@extends('manage.main')
@section('manage.content')
@section('title', '| Dashboard')
@section('header', 'Dashboard')

<div class="columns is-multiline">
  <div class="column is-3">
    <div class="card has-background-info p-t-20 has-text-centered has-text-light" style="box-shadow: 5px 5px 10px 0px #ccc;">
      <i class="fa fa-users fa-3x"></i>
      <div class="is-divider" data-content="КЛИЕНТИ"></div>
      <span class="heading is-size-4 p-b-20">3783</span>
    </div>
  </div>
  <div class="column is-3">
    <div class="card has-background-danger p-t-20 has-text-centered has-text-light" style="box-shadow: 5px 5px 10px 0px #ccc;">
      <i class="fa fa-circle fa-3x"></i>
      <div class="is-divider" data-content="ПРОДУКТИ"></div>
      <span class="heading is-size-4 p-b-20">3783</span>
    </div>
  </div>
  <div class="column is-3">
    <div class="card has-background-success p-t-20 has-text-centered has-text-light" style="box-shadow: 5px 5px 10px 0px #ccc;">
      <i class="fa fa-shopping-cart fa-3x"></i>
      <div class="is-divider" data-content="ПОРЪЧКИ"></div>
      <span class="heading is-size-4 p-b-20">3783</span>
    </div>
  </div>
  <div class="column is-3">
    <div class="card has-background-primary p-t-20 has-text-centered has-text-light" style="box-shadow: 5px 5px 10px 0px #ccc;">
      <i class="fa fa-dollar fa-3x"></i>
      <div class="is-divider" data-content="ПЕЧАЛБИ"></div>
      <span class="heading is-size-4 p-b-20">3 783 331</span>
    </div>
  </div>
</div>

@endsection
