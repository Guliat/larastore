<div class="column is-half">
  <a href="{{ route('manage.products.deleted') }}" class="button is-danger">
    <span class="tag is-light m-r-5">{{ $count - $countactive }}</span>
    <span class="icon"><i class="fa fa-close"></i></span>
    <span>ИЗТРИТИ</span>
  </a>
  <a href="#" class="button is-warning">
    <span class="tag is-light m-r-5">{{ $countnotapproved }}</span>
    <span class="icon"><i class="fa fa-thumbs-down"></i></span>
    <span>НЕОДОБРЕНИ</span>
  </a>
  <a href="#" class="button is-success">
    <span class="tag is-light m-r-5">{{ $countfeatured }}</span>
    <span class="icon"><i class="fa fa-thumbs-up"></i></span>
    <span>ИЗБРАНИ</span>
  </a>
</div>
<div class="column is-half has-text-right">
<form method="post" action="{{ route('manage.products.filtered') }}">
  {{ csrf_field() }}
  <div class="select">
    <select name="category_id">
      <option value='all'>ВСИЧКИ ПРОДУКТИ</option>
      @foreach($categories as $category)
        <option value='{{ $category->id }}' @if(!empty($selected)) @if($category->id == $selected) selected @endif @endif>{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="button is-success">ФИЛТРИРАЙ</button>
  </form>
</div>
<div class="column is-12">
  <div class="tag is-dark">
    ОБЩО: {{ $count }}
  </div>
  <div class="tag is-dark">
    АКТИВНИ: {{ $countactive }}
  </div>
</div>
