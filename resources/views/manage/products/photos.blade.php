@extends('manage.dashboard')
@section('title', '| СНИМКИ')
@section('manage.content')
<!-- PRODUCT PHOTOS -->
<div class="columns is-centered is-multiline" id="photos">
    <!-- UPLOAD BUTTON -->
    <div class="column is-6">
        @if($count >= 5)
        @else
            <form method="POST" action="{{ route('manage.photos.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="product_id" value="{{ $productId }}">
                <input type="hidden" name="product_model" value="{{ $productModel->model }}">
                <div class="file is-boxed is-success has-name column is-12 has-text-centered">
                    <label class="file-label">
                        <input class="file-input" type="file" name="photo" onchange="this.form.submit();">
                        <span class="file-cta">
                            <i class="fa fa-plus fa-2x"></i>
                            <span class="is-size-6">
                                НОВА СНИМКА
                                <br />
                                модел {{ $productModel->model }}
                            </span>
                        </span>
                    </label>
                </div>
            </form>
        @endif
    </div>
    <!-- END UPLOAD BUTTON -->
    <!-- UPLOADED PHOTOS -->
    <div class="column is-12">
        <div class="columns is-centered is-multiline">
            @foreach($photos as $photo)
            <div class="column is-one-fifth has-text-centered">
                <span class="is-size-5"># {{ $photo->order }}</span>
                <div class="box">
                    @if($photo->order == 1)
                    @else
                        <b-tooltip label="премести" type="is-dark">
                            <form method="post" action="{{ route('manage.photos.move.left') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="photo_id" value="{{ $photo->id }}" />
                                <input type="hidden" name="product_id" value="{{ $productId }}" />
                                <button type='submit' class="button is-dark is-outlined" @click="openLoading">
                                    <i class="fa fa-arrow-left"></i>
                                </button>
                            </form>
                        </b-tooltip>
                    @endif
                    @if($photo->order == $count)
                    @else
                        <b-tooltip label="премести" type="is-dark">
                            <form method="post" action="{{ route('manage.photos.move.right') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="photo_id" value="{{ $photo->id }}" />
                                <input type="hidden" name="product_id" value="{{ $productId }}" />
                                <button type='submit' class="button is-dark is-outlined" @click="openLoading">
                                    <i class="fa fa-arrow-right"></i>
                                </button>
                            </form>
                        </b-tooltip>
                    @endif
                    <br />
                        <img src="{{ asset('/images/half') }}/{{ $photo->photo }}" width="" height="" style="box-shadow: 0px 0px 5px 2px #ccc;" class="m-t-10 m-b-10"/>
                    <br />
                    <b-tooltip label="завърти" type="is-dark">
                        <form method="post" action="{{route('manage.photos.rotate.left')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="photo" value="{{$photo->photo}}" />
                            <input type="hidden" name="product_id" value="{{ $productId }}" />
                            <input type="hidden" name="order" value="{{ $photo->order }}" />
                            <input type="hidden" name="product_model" value="{{ $productModel->model }}">
                            <button type='submit' class="button is-dark is-outlined" @click="openLoading">
                                <i class="fa fa-undo"></i>
                            </button>
                        </form>
                    </b-tooltip>
                    <b-tooltip label="за споделяне" type="is-dark">
                        <form method="post" action="{{ route('manage.photos.meta') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="photo" value="{{ $photo->photo }}" />
                            <input type="hidden" name="photo_id" value="{{ $photo->id }}" />
                            <input type="hidden" name="product_id" value="{{ $productId }}" />
                            <button type='submit' class="button is-success is-outlined" @click="openLoading">
                                <i class="fa fa-users"></i>
                            </button>
                        </form>
                    </b-tooltip>
                    <b-tooltip label="!!! ИЗТРИВАНЕ !!!" type="is-dark">
                        <form method="post" action="{{route('manage.photos.delete')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="photo" value="{{$photo->photo}}" />
                            <input type="hidden" name="product_id" value="{{ $productId }}" />
                            <button type='submit' class="button is-danger is-outlined" @click="openLoading">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </b-tooltip>
                    <b-tooltip label="завърти" type="is-dark">
                        <form method="post" action="{{route('manage.photos.rotate.right')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="photo" value="{{$photo->photo}}" />
                            <input type="hidden" name="product_id" value="{{ $productId }}" />
                            <input type="hidden" name="order" value="{{ $photo->order }}" />
                            <input type="hidden" name="product_model" value="{{ $productModel->model }}">
                            <button type='submit' class="button is-dark is-outlined" @click="openLoading">
                                <i class="fa fa-repeat"></i>
                            </button>
                        </form>
                    </b-tooltip>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- END UPLOADED PHOTOS -->
    <!-- PROGRESS BAR -->
    <div class="column is-12">
      @if($count === 0)
        <div class="has-text-centered"><span class="tag is-dark is-medium">0/5</span></div>
        <progress class="progress is-danger m-t-10" value="5" max="100"></progress>
      @elseif($count === 1)
        <div class="has-text-centered"><span class="tag is-dark is-medium">1/5</span></div>
        <progress class="progress is-danger m-t-10" value="20" max="100"></progress>
      @elseif($count === 2)
        <div class="has-text-centered"><span class="tag is-dark is-medium">2/5</span></div>
        <progress class="progress is-warning m-t-10" value="40" max="100"></progress>
      @elseif($count === 3)
        <div class="has-text-centered"><span class="tag is-dark is-medium">3/5</span></div>
        <progress class="progress is-warning m-t-10" value="60" max="100"><progress>
        @elseif($count === 4)
          <div class="has-text-centered"><span class="tag is-dark is-medium">4/5</span></div>
          <progress class="progress is-success m-t-10" value="80" max="100"></progress>
        @endif
      </div>
      <!-- END PROGRESS BAR -->
      <div class="column is-12 has-text-centered">
        <a class="button is-dark" href='{{route('manage.products.show', $productId)}}'> ПРЕГЛЕД НА ПРОДУКТА</a>
      </div>
    <!-- META IMAGE -->
    <div class="column is-8 has-text-centered">
        <span class="is-size-6">ТАЗИ СНИМКА СЕ ПОКАЗВА ПРИ СПОДЕЛЯНЕ В СОЦИАЛНИТЕ МРЕЖИ И ПРИЛОЖЕНИЯТА</span>
        <div class="box">
            @if(isset($metaImage->photo))
                <img src="{{ asset('/images/meta') }}/{{ $metaImage->photo }}" style="box-shadow: 0px 0px 5px 2px #ccc;" />
            @else
                НЯМА ИЗБРАНА СНИМКА ЗА СПОДЕЛЯНЕ
            @endif
        </div>
    </div>
    <!-- END META IMAGE -->
</div>
<!-- END PRODUCT PHOTOS -->
@endsection
@section('scripts')
<script>
new Vue({
  el: '#photos',
});
</script>
@endsection
