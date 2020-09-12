<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


# ----------------- CLIENTS ---------------
# -------------------------------------------
	Route::get('manage', function() { return view('manage.main'); });
	Route::get('/boutique', 'HomeController@boutiqueHome')->name('boutique.home');
	Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/info', 'HomeController@info')->name('info.info');
	Route::get('/info/terms', 'HomeController@terms')->name('info.terms');
	Route::get('/info/cookies', 'HomeController@cookies')->name('info.cookies');
	Route::get('/check_expired_promo', 'HomeController@check_expired_promo')->name('check.expired.promo');

# ----------- SEARCH -----------
	Route::get('/search', 'HomeController@indexSearch')->name('search.index');
	Route::post('/search', 'HomeController@search')->name('search.post');

# ----------- FILTER / SORT -----------
	Route::put('filter/category/low', 'HomeController@filterCategoryToLow')->name('filter.category.low');
	Route::put('filter/category/high', 'HomeController@filterCategoryToHigh')->name('filter.category.high');
	Route::put('filter/category/newest', 'HomeController@filterCategoryNewest')->name('filter.category.newest');
	Route::put('filter/category/oldest', 'HomeController@filterCategoryOldest')->name('filter.category.oldest');
	Route::put('category/view/block', 'HomeController@CategoryViewBlock')->name('category.view.block');
	Route::put('category/view/grid', 'HomeController@CategoryViewGrid')->name('category.view.grid');

# ----------- CART -----------
	Route::get('/cart', 'HomeController@showCart')->name('cart.show');
	Route::post('/storecart', 'HomeController@storeCart')->name('cart.store');
	Route::post('/cart/delete', 'HomeController@deleteCart')->name('cart.delete');
	Route::put('/cart/update', 'HomeController@updateCart')->name('cart.update');
	//Route::put('/cart/update/up', 'HomeController@updateCartUp')->name('cart.update.up');
	//Route::put('/cart/update/down', 'HomeController@updateCartDown')->name('cart.update.down');

# ---------- ORDERS -----------
	Route::get('/order_review', 'HomeController@reviewOrder')->name('order.review');
	Route::get('/order_create', 'HomeController@createOrder')->name('order.create');
	Route::get('/order/success/{order}', 'HomeController@successOrder')->name('order.success');
	Route::post('/order', 'HomeController@storeOrder')->name('order.store');
	Route::post('/order/fast', 'HomeController@storeFastOrder')->name('order.fast.store');
	Route::post('/order/session', 'HomeController@storeOrderToSession')->name('order.store.session');

# ----------- PRODUCTS -----------
	Route::get('промоции', 'HomeController@promoProducts')->name('products.promo');
	Route::get('нови', 'HomeController@newProducts')->name('products.new');
	Route::get('продукти', 'HomeController@allProducts')->name('products.all');

# ----------- RANDOM PRODUCT -----------
	Route::get('random', 'HomeController@randomProduct')->name('random.product');

# ----------- NIGHT LIGHT -----------
	Route::post('nightlight', 'HomeController@nightLight')->name('nightlight');

# ----------- COOKIES -----------
	Route::post('cookies', 'HomeController@cookiesAccepted')->name('cookies.accepted');

# ----------- VAUCHERS -----------
	Route::get('vaucher', 'HomeController@vaucher')->name('vaucher.index');
	Route::post('vaucher', 'HomeController@vaucherCheck')->name('vaucher.check');
	Route::get('vaucher/gift', 'HomeController@vaucherGift')->name('vaucher.gift.index');
	Route::post('vaucher/gift', 'HomeController@vaucherGiftStore')->name('vaucher.gift.store');

# ----------- SLUG -----------
	Route::pattern('slug', '[a-zA-Z0-9-\_\p{Cyrillic}]+');
	#Route::get('/{slug}', 'ProductController@getSingle')->name('slug');
	Route::get('{slug}', function ($slug) {
		if(strpos($slug, '-') !== false) {
			// GO TO PRODUCT
			$getSingle = new App\Http\Controllers\HomeController;
			return $getSingle->getSingle($slug);
		} else {
			// SHOW ALL CATEGORY PRODUCTS
			$categoryShow = new App\Http\Controllers\HomeController;
			return $categoryShow->getCategoryProducts($slug);
		}
	})->name('slug');
# -------------------------------------------
# ----------------- END CLIENTS ------------


# ----------- ADMINS -----------
# --------------------------------------
Route::prefix('manage')->group(function() {

	# ----------- DASHBOARD -----------
		Route::get('/', function() { return view('manage.dashboard'); })->name('manage.dashboard');
		Route::get('dashboard', function() { return view('manage.dashboard'); })->name('manage.dashboard');

	# ----------- PHOTOS -----------

		Route::get('photos/{productid}', 'PhotoController@show')->name('manage.photos.show');

		Route::post('photos', 'PhotoController@store')->name('manage.photos.store');

		Route::post('photos/meta', 'PhotoController@meta')->name('manage.photos.meta');
		Route::post('photos/moveRight', 'PhotoController@moveRight')->name('manage.photos.move.right');
		Route::post('photos/moveLeft', 'PhotoController@moveLeft')->name('manage.photos.move.left');
		Route::post('photos/delete', 'PhotoController@delete')->name('manage.photos.delete');
		Route::post('photos/rotateLeft', 'PhotoController@rotateLeft')->name('manage.photos.rotate.left');
		Route::post('photos/rotateRight', 'PhotoController@rotateRight')->name('manage.photos.rotate.right');

	# ----------- ORDERS -----------
		Route::get('/orders', 'OrderController@index')->name('manage.orders.index');
		Route::get('/orders/stats', 'OrderController@stats')->name('manage.orders.stats');
		Route::get('/orders/{order}', 'OrderController@show')->name('manage.orders.show');
		Route::post('/orders/status', 'OrderController@storeStatus')->name('manage.order.store.status');

	# ----------- PRODUCTS -----------
		Route::get('/products', 'ProductController@index')->name('manage.products.index');
		Route::get('/products/deleted', 'ProductController@showDeleted')->name('manage.products.deleted');
		Route::get('/products/create', 'ProductController@create')->name('manage.products.create');
		Route::get('/products/{product}/edit', 'ProductController@edit')->name('manage.products.edit');
		Route::get('/products/{product}', 'ProductController@show')->name('manage.products.show');
		Route::put('/products/{product}', 'ProductController@update')->name('manage.products.update');
		Route::put('/products/delete/{product}', 'ProductController@destroy')->name('manage.products.destroy');
		Route::put('/products/approve/{product}', 'ProductController@approve')->name('manage.products.approve.update');
		Route::put('/products/is_featued/{product}', 'ProductController@Isfeatured')->name('manage.products.is.featured');
		Route::put('/products/not_featued/{product}', 'ProductController@Notfeatured')->name('manage.products.not.featured');
		Route::post('/products', 'ProductController@store')->name('manage.products.store');
		Route::post('/products/filtered', 'ProductController@filtered')->name('manage.products.filtered');

	# ----------- PROMOTIONS -----------
		Route::get('/promotions', 'PromotionController@index')->name('manage.promotions.index');
		Route::get('/promotions/{promotion}', 'PromotionController@show')->name('manage.promotions.show');
		Route::get('/promotions/create/{productid}', 'PromotionController@create');
		Route::get('/promotions/create/to/category', 'PromotionController@createToCategory')->name('manage.promotions.create.to.category');
		Route::get('/promotions/create/with/percent', 'PromotionController@createWithPercentAll')->name('manage.promotions.create.with.percent.all');
		Route::post('/promotions', 'PromotionController@store')->name('manage.promotions.store');
		Route::post('/promotions/to/category', 'PromotionController@storeToCategory')->name('manage.promotions.store.to.category');
		Route::post('/promotions/with/percent', 'PromotionController@storeWithPercentAll')->name('manage.promotions.store.with.percent.all');

	# ----------- CATEGORIES -----------
		Route::get('/categories', 'CategoryController@showCategories')->name('manage.categories.show');
		Route::get('/subcategories', 'CategoryController@showSubCategories')->name('manage.subcategories.show');
		Route::post('/categories', 'CategoryController@storeCategories')->name('manage.categories.store');
		Route::put('/categories/delete/{category}', 'CategoryController@deleteCategories')->name('manage.categories.delete');
		Route::post('/subcategories', 'CategoryController@storeSubCategories')->name('manage.subcategories.store');
		Route::put('/subcategories/delete/{subcategory}', 'CategoryController@deleteSubCategories')->name('manage.subcategories.delete');

	# ----------- ZONES -----------
		Route::get('/zones', 'ZoneController@index')->name('manage.zones.index');
		Route::post('/zones', 'ZoneController@store')->name('manage.zones.store');

	# ----------- SHIPPINGS -----------
		Route::get('/shippings', 'ShippingController@index')->name('manage.shippings.index');
		Route::post('/shippings', 'ShippingController@store')->name('manage.shippings.store');

	# ----------- PAYMENTS -----------
		Route::get('/payments', 'PaymentController@index')->name('manage.payments.index');
		Route::post('/payments', 'PaymentController@store')->name('manage.payments.store');

	# ----------- STATUSES -----------
		Route::get('/statuses', 'StatusController@index')->name('manage.statuses.index');
		Route::post('/statuses', 'StatusController@store')->name('manage.statuses.store');

	# ----------- OPTIONS GROUPS AND OPTIONS -----------

		// OPTIONS GROUPS
		Route::get('/options_groups', 'OptionController@index')->name('manage.options.index');
		Route::get('/options_groups/{option}/edit', 'OptionController@editOptionsGroup')->name('manage.options.editoptionsgroup');
		Route::post('/options_group', 'OptionController@storeOptionsGroup')->name('manage.options.storeoptionsgroup');
		Route::put('/options_group/{option}', 'OptionController@updateOptionsGroup')->name('manage.options.updateoptionsgroup');

		// OPTIONS
		Route::post('/options', 'OptionController@storeOption')->name('manage.options.store.option');
		Route::post('/options/create', 'OptionController@createOption')->name('manage.options.create.option');

	# ----------- SETTINGS -----------

		// GOOGLE ANALYTICS CODE
			Route::get('/settings/googleanalytics', 'SettingController@googleAnalytics')->name('google_analytics');
			Route::post('/settings/googleanalytics', 'SettingController@storeGoogleAnalytics')->name('store.google_analytics');
			Route::put('/settings/googleanalytics', 'SettingController@updateGoogleAnalytics')->name('update.google_analytics');

		// TERMS
			Route::get('/settings/terms', 'SettingController@terms')->name('terms');
			Route::post('/settings/terms', 'SettingController@storeTerms')->name('store.terms');
			Route::put('/settings/terms', 'SettingController@updateTerms')->name('update.terms');

		// INFORMATION
			Route::get('/settings/info', 'SettingController@info')->name('info');
			Route::post('/settings/info', 'SettingController@storeInfo')->name('store.info');
			Route::put('/settings/info', 'SettingController@updateInfo')->name('update.info');
});
# ------------------------------------------
# ----------- END ADMINS -----------
