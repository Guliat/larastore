@extends('manage.dashboard')
@section('title', '| ДОБАВЯНЕ НА ОПЦИЯ')
@section('header', 'ДОБАВЯНЕ НА ОПЦИЯ')
@section('manage.content')
<div class="columns is-centered">
	<div class="column is-half">
		<div class="box">
            <form method="POST" action="{{route('manage.options.store.option')}}">
                {{ csrf_field() }}
                <input type="hidden" name="option_group_id" value="{{$optiongroup}}" />
                <input type="text" name="name" autocomplete="off" placeholder="опция" class="input has-text-centered" />
                <input type="submit" value="ДОБАВИ" class="button is-success is-fullwidth m-t-5" />
            </form>
		</div>
	</div>
</div>
@endsection
