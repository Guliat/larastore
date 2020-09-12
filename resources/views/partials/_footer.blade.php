<div class="column is-12 notification is-dark is-radiusless py-5">
  <div class="columns is-multiline">
    <div class="column is-2 has-text-centered">
      <p class="subtitle">ПРОИЗВЕДЕНО В БЪЛГАРИЯ</p>
      <p class="heading">БЕЗПЛАТНА ДОСТАВКА - за поръчки над 99лв.</p>
      <p class="heading">опция преглед - виж преди да платиш</p>
      <p class="heading">ВРЪЩАНЕ И ЗАМЯНА - до 14 дни</p>
    </div>
    <div class="column is-2 has-text-centered">
      <p class="is-size-6">БЪРЗИ ВРЪЗКИ</p>
      <a href="{{ route('products.promo') }}"><p class="is-size-7">ПРОМОЦИИ</p></a>
      <a href="{{ route('products.new') }}"><p class="is-size-7">НОВИ ПРОДУКТИ</p></a>
    </div>
    <div class="column is-2 has-text-centered">
      <p class="is-size-6">ИНФОРМАЦИЯ</p>
      <a href="{{ route('info.terms') }}"><p class="is-size-7">ОБЩИ УСЛОВИЯ</p></a>
      <a href="{{ route('info.cookies') }}"><p class="is-size-7">БИСКВИТКИ</p></a>
      <a href="{{ route('info.info') }}"><p class="is-size-7">ПОЛЕЗНА ИНФОРМАЦИЯ</p></a>
    </div>
    <div class="column is-3 has-text-centered">
      <p class="is-size-6">ЗА ВРЪЗКА С НАС</p>
      <p class="is-size-7">{{ config('app.phone') }}</p>
      <p class="is-size-7">{{ config('app.mail') }}</p>
    </div>
    <!-- <div class="column is-3 has-text-centered">
      <p class="is-size-6">ПОСЛЕДВАЙТЕ НИ</p>
      <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0&appId=312970125760719&autoLogAppEvents=1"></script>
      <div class="fb-page" data-href="https://www.facebook.com/poluchime/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/poluchime/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/poluchime/">ПолучиМЕ</a></blockquote></div>
    </div> -->
  </div>
  <div style="height: 1px; background: #fff;" ></div>
  <div class="has-text-centered p-t-20">{{ config('app.name') }} @ {{date('Y')}}</div>
</div>
