@extends('manage.dashboard')
@section('title', '| ОПЦИИ КЪМ ПРОДУКТА')
@section('header', 'ОПЦИИ КЪМ ПРОДУКТА')
@section('manage.content')
<div class="columns">
	<!-- NEW OPTION BOX -->
	<div class="column is-one-third">
		<span class="subtitle is-4">НОВА ОПЦИЯ</span>
		<div class="box">
			<form method="POST" action="{{route('manage.options.storeoptionsgroup')}}">
				{{ csrf_field() }}
				<input type="text" name="name" autocomplete="off" placeholder="опция" class="input has-text-centered" />
				<input type="submit" value="ДОБАВИ" class="button is-success is-fullwidth m-t-5"/>
			</form>
		</div>
	</div>
	<!-- LIST ALL OPTIONS BOX -->
	<div class="column">
		<span class="subtitle is-4">ВСИЧКИ ОПЦИИ</span>
		<div class="box">
			<table class="table is-fullwidth">
				<thead>
					<tr>
						<th>#</th>
						<th>ОПЦИЯ</th>
						<th>*</th>
					</tr>
				</thead>
				<tbody>
					@foreach($optionsgroups as $option_group)
					<tr>
						<td>{{ $option_group->id }}</td>
						<td>
                            <div class="columns">
                                <div class="column is-one-third">
                                    <a href="{{route('manage.options.editoptionsgroup', $option_group->id)}}" class="button is-success is-outlined">
                                    	<i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                                <div class="column">
                                    <span class="is-size-5">{{ $option_group->name }}</span>
                                </div>
                            </div>
                        </td>
						<td>
                            <form action="{{route('manage.options.create.option')}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$option_group->id}}" name="option_group_id" />
                                @foreach($option_group->options as $options)
                                <span class="tag is-dark is-medium m-b-5">{{$options->name}}</span>
                                @endforeach
                                <button type="submit" class="button is-success"><i class="fa fa-plus"></i></button>
                            </form>
                        </td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
