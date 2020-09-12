<b-dropdown id="categoryDropDown" v-cloak>
	<a href="#" class="button is-primary is-medium m-b-5" slot="trigger">КАТЕГОРИИ &nbsp;&nbsp;<i class="fa fa-caret-down"></i></a>
	<?php $data = new App\Category; $categories = $data->orderBy('name', 'asc')->get();?>
		<b-dropdown-item has-link class="has-text-centered"><a href="{{route('products.all')}}" class="has-text-dark is-size-5">ВСИЧКИ</a></b-dropdown-item>
		<hr class="dropdown-divider">
		<b-dropdown-item has-link class="has-text-centered"><a href="{{route('products.new')}}" class="has-text-dark is-size-5">НОВИ</a></b-dropdown-item>
		<hr class="dropdown-divider">
		<b-dropdown-item has-link class="has-text-centered"><a href="{{route('products.promo')}}" class="has-text-dark is-size-5">ПРОМОЦИИ</a></b-dropdown-item>
		<hr class="dropdown-divider">
	@foreach($categories as $category)
		<b-dropdown-item has-link class="has-text-centered"><a href="{{$category->slug}}" class="has-text-dark is-size-5">{{$category->name}}</a></b-dropdown-item>
		<hr class="dropdown-divider">
	@endforeach
</b-dropdown>
