@extends('manage.dashboard')
@section('title', '| РЕДАКТИРАНЕ НА ГРУПА ЗА ОПЦИИ')
@section('header', 'РЕДАКТИРАНЕ НА ГРУПА ЗА ОПЦИИ')
@section('manage.content')
<div class="columns is-centered">
	<div class="column is-half">
		<div class="box">
            <form method="POST" action="{{route('manage.options.updateoptionsgroup', $optiongroup->id)}}">
                {{ csrf_field() }}
                {{ method_field('put') }}
                <input type="text" name="name" autocomplete="off" placeholder="опция" value="{{$optiongroup->name}}" class="input has-text-centered" />
                <input type="submit" value="ОБНОВИ" class="button is-success is-fullwidth m-t-5" />
            </form>
		</div>
	</div>
</div>
@endsection
