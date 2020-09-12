<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- HEAD -->
<head>
@include('partials._googleAnalytics')

@include('partials._head')
</head>
<!-- END HEAD -->
<!-- BODY -->
<body>
    @if(Session::get('cookies') != 'accepted')
        @include('partials.buttons._cookies')
    @endif
    {{-- @if(Auth::check())
        <a class="button is-danger" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ИЗХОД</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }} </form>
    @else
        <a class="button is-danger" href="{{route('login')}}" >ВХОД</a>
    @endif

    <div class="is-hidden-desktop p-t-40"></div>
    <!-- ADMIN NAV -->
    @if(Auth::id() == 1 OR Auth::id() == 2)
        @include('partials._nav')
    @endif
    <!-- END ADMIN NAV --> --}}

    <!-- BOTTOM BAR -->
    <!-- <nav class="navbar is-fixed-bottom is-hidden-desktop">
        <table class="table is-narrow is-fullwidth">
            <tr>
                <td class="has-text-centered">
                    <b-dropdown id="categoryDropDown" v-cloak>
                    	<a href="#" class="button is-white is-medium" slot="trigger"><i class="fa fa-bars has-text-dark"></i></a>
                    	<?php $data = new App\Category; $categories = $data->orderBy('name', 'asc')->get();?>
                            <br />
                            <hr class="dropdown-divider">
                            <b-dropdown-item has-link><a href="#" class="has-text-dark has-text-centered is-size-7"><i class="fa fa-times-circle fa-lg"></i> ЗАТВОРИ</a></b-dropdown-item>
                            <hr class="dropdown-divider">
                    		<b-dropdown-item has-link><a href="{{route('products.all')}}" class="has-text-dark is-size-5">ВСИЧКИ</a></b-dropdown-item>
                    		<hr class="dropdown-divider">
                    	@foreach($categories as $category)
                    		<b-dropdown-item has-link><a href="{{$category->slug}}" class="has-text-dark is-size-5">{{$category->name}}</a></b-dropdown-item>
                    		<hr class="dropdown-divider">
                    	@endforeach
                            <b-dropdown-item has-link><a href="#" class="has-text-dark has-text-centered is-size-7"><i class="fa fa-times-circle fa-lg"></i> ЗАТВОРИ</a></b-dropdown-item>
                    </b-dropdown>
                </td>
                <td class="has-text-centered">
                    <a href="{{route('products.new')}}" class="button is-medium is-white">
                        <i class="fa fa-tags has-text-dark"></i>
                    </a>
                </td>
                <td class="has-text-centered">
                    <a href="{{route('products.promo')}}" class="button is-medium is-white">
                        <i class="fa fa-percent has-text-dark"></i>
                    </a>
                </td>
                <td class="has-text-centered">
                    <a href="{{ route('cart.show') }}" class="button is-medium is-white">
                        <i class="fa fa-shopping-bag has-text-dark"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td class="has-text-centered">
                    <span class="is-size-6 has-text-dark">
                        КАТЕГОРИИ
                    </span>
                </td>
                <td class="has-text-centered">
                    <span class="is-size-6 has-text-dark">
                        НОВИ
                    </span>
                </td>
                <td class="has-text-centered">
                    <span class="is-size-6 has-text-dark">
                        ПРОМОЦИИ
                    </span>
                </td>
                <td class="has-text-centered">
                    <span class="is-size-7 has-text-dark">
                        {{ Cart::total() }}лв.
                    </span>
                </td>
            </tr>
        </table>
    </nav> -->
    <!-- END BOTTOM BAR -->

    <!-- TOP SEARCH BAR -->
    {{-- <nav class="navbar is-danger is-fixed-top p-t-10 p-b-10 p-r-15 p-l-15 is-hidden-desktop">
        <form action="{{route('search.post')}}" method="post">
            <div class="field has-addons">
                <div class="control">
                    <a href="{{ route('home') }}" class="button is-medium is-white has-text-danger">
                        <i class="fa fa-home"></i>
                    </a>
                </div>
                <div class="control has-icons-left">
                    {{csrf_field()}}
                    <input class="input is-medium is-rounded is-white has-text-dark" type="text" name="search" placeholder="бързо търсене" value="@if(!empty($query)){{$query}}@endif">
                    <span class="icon is-left">
                        <i class="fa fa-hashtag"></i>
                    </span>
                </div>
                <div class="control">
                    <button type="submit" class="button is-white has-text-danger is-rounded is-medium" @click="openLoading">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </nav> --}}
    <!-- END TOP SEARCH BAR -->
        {{-- @include('partials._ads-text-slider') --}}
    <!-- LOGO -->
    {{-- <div class="has-text-centered">
        <a href="{{ route('home') }}"> --}}
            {{-- <img src="{{ asset('/') }}{{ config('app.logo') }}" alt="{{config('app.name')}}" title="{{config('app.name')}}" width="300px" /> --}}
            {{-- <span class="engagement is-size-9 has-text-dark">
                Poluchi.Me
            </span>
        </a>
    </div> --}}
    <!-- END LOGO -->
    <!-- HEADER -->
    {{-- <div class="has-text-centered is-size-5 notification is-dark">
        @yield('header')
    </div> --}}

    @include('partials._navbar')


    <!-- END HEADER -->
    <!-- CONTENT -->
    <section class="section">
        <div class="container p-t-100" id="app">
            <div class="has-text-left m-l-20 m-b-20">
                <!--
                @if(date('H:m:i') > '18:00')
                    @if(Session::get('nightLight') != 'confirmed')
                        @include('partials.buttons._nightLight')
                    @endif
                @endif
                -->
                @yield('quickMenu')
            </div>
            @include('partials._messages')
            @yield('content')
            <hr />
            <div class="is-hidden-desktop p-b-75"></div>
        </div>
            @include('partials._javascript')
            @yield('scripts')
    </section>
    <!-- END CONTENT -->
    @include('partials._footer')
</body>
<!-- END BODY -->
</html>
