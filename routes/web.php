<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ZoneController;

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

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


# ----------------- CLIENTS ---------------
	# -------------------------------------------
	#Route::get('/boutique', '[HomeController@boutiqueHome]')->name('boutique.home');
		Route::view('/', 'home.home');
		Route::view('/home', 'home.home')->name('home');
		Route::view('/manage', 'manage.dashboard');
		Route::get('/info', [HomeController::class, 'info'])->name('info.info');
		Route::get('/info/terms', [HomeController::class, 'terms'])->name('info.terms');
		Route::get('/info/cookies', [HomeController::class, 'cookies'])->name('info.cookies');
		Route::get('/check_expired_promo', [HomeController::class, 'check_expired_promo'])->name('check.expired.promo');
	# ----------- SEARCH -----------
		Route::view('/search', 'home.indexSearch')->name('search.index');
		Route::post('/search', [HomeController::class, 'search'])->name('search.post');
	# ----------- FILTER / SORT -----------
		Route::put('filter/category/low', [HomeController::class, 'filterCategoryToLow'])->name('filter.category.low');
		Route::put('filter/category/high', [HomeController::class, 'filterCategoryToHigh'])->name('filter.category.high');
		Route::put('filter/category/newest', [HomeController::class, 'filterCategoryNewest'])->name('filter.category.newest');
		Route::put('filter/category/oldest', [HomeController::class, 'filterCategoryOldest'])->name('filter.category.oldest');
		Route::put('category/view/block', [HomeController::class, 'CategoryViewBlock'])->name('category.view.block');
		Route::put('category/view/grid', [HomeController::class, 'CategoryViewGrid'])->name('category.view.grid');
	# ----------- CART -----------
		Route::get('/cart', [HomeController::class, 'showCart'])->name('cart.show');
		Route::post('/storecart', [HomeController::class, 'storeCart'])->name('cart.store');
	 	Route::post('/cart/delete', [HomeController::class, 'deleteCart'])->name('cart.delete');
	 	Route::put('/cart/update', [HomeController::class, 'updateCart'])->name('cart.update');
	 	#Route::put('/cart/update/up', 'HomeController@updateCartUp')->name('cart.update.up');
	 	#Route::put('/cart/update/down', 'HomeController@updateCartDown')->name('cart.update.down');

	# ---------- ORDERS -----------
		Route::get('/order_review', [HomeController::class, 'reviewOrder'])->name('order.review');
		Route::get('/order_create', [HomeController::class, 'createOrder'])->name('order.create');
	 	Route::get('/order/success/{order}', [HomeController::class, 'successOrder'])->name('order.success');
	 	Route::post('/order', [HomeController::class, 'storeOrder'])->name('order.store');
		Route::post('/order/fast', [HomeController::class, 'storeFastOrder'])->name('order.fast.store');
	 	Route::post('/order/session', [HomeController::class, 'storeOrderToSession'])->name('order.store.session');

	# ----------- PRODUCTS -----------
		Route::get('промоции', [HomeController::class, 'promoProducts'])->name('products.promo');
		Route::get('нови', [HomeController::class, 'newProducts'])->name('products.new');
		Route::get('продукти', [HomeController::class, 'allProducts'])->name('products.all');

	// # ----------- RANDOM PRODUCT -----------
	// 	Route::get('random', 'HomeController@randomProduct')->name('random.product');

	// # ----------- NIGHT LIGHT -----------
	// 	Route::post('nightlight', 'HomeController@nightLight')->name('nightlight');

	# ----------- COOKIES -----------
		Route::post('cookies', [HomeController::class, 'cookiesAccepted'])->name('cookies.accepted');

	// # ----------- VAUCHERS -----------
	// 	Route::get('vaucher', 'HomeController@vaucher')->name('vaucher.index');
	// 	Route::post('vaucher', 'HomeController@vaucherCheck')->name('vaucher.check');
	// 	Route::get('vaucher/gift', 'HomeController@vaucherGift')->name('vaucher.gift.index');
	// 	Route::post('vaucher/gift', 'HomeController@vaucherGiftStore')->name('vaucher.gift.store');

	# ----------- SLUG -----------
		Route::pattern('slug', '[a-zA-Z0-9-\_\p{Cyrillic}]+');
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
# ------------------- END CLIENTS -------------

# ------------------- ADMINS -------------------
	# --------------------------------------------
	Route::prefix('manage')->group(function() {

	# ----------- DASHBOARD -----------
		Route::view('/', 'manage.dashboard');
		Route::view('dashboard', 'manage.dashboard')->name('manage.dashboard');
	# ----------- PHOTOS -----------
		Route::get('photos/{productid}', [PhotoController::class, 'show'])->name('manage.photos.show');
		Route::post('photos', [PhotoController::class, 'store'])->name('manage.photos.store');
		Route::post('photos/meta', [PhotoController::class, 'meta'])->name('manage.photos.meta');
		Route::post('photos/moveRight', [PhotoController::class, 'moveRight'])->name('manage.photos.move.right');
		Route::post('photos/moveLeft', [PhotoController::class, 'moveLeft'])->name('manage.photos.move.left');
		Route::post('photos/delete', [PhotoController::class, 'delete'])->name('manage.photos.delete');
		Route::post('photos/rotateLeft', [PhotoController::class, 'rotateLeft'])->name('manage.photos.rotate.left');
		Route::post('photos/rotateRight', [PhotoController::class, 'rotateRight'])->name('manage.photos.rotate.right');
 	# ----------- ORDERS -----------
		Route::get('/orders', [OrderController::class, 'index'])->name('manage.orders.index');
		Route::get('/orders/stats', [OrderController::class, 'stats'])->name('manage.orders.stats');
		Route::get('/orders/{order}', [OrderController::class, 'show'])->name('manage.orders.show');
		Route::post('/orders/status', [OrderController::class, 'storeStatus'])->name('manage.order.store.status');
	# ----------- PRODUCTS -----------
		Route::get('/products', [ProductController::class, 'index'])->name('manage.products.index');
		Route::get('/products/deleted', [ProductController::class, 'showDeleted'])->name('manage.products.deleted');
		Route::get('/products/create', [ProductController::class, 'create'])->name('manage.products.create');
		Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('manage.products.edit');
		Route::get('/products/{product}', [ProductController::class, 'show'])->name('manage.products.show');
		Route::put('/products/{product}', [ProductController::class, 'update'])->name('manage.products.update');
		Route::put('/products/delete/{product}', [ProductController::class, 'destroy'])->name('manage.products.destroy');
		Route::put('/products/approve/{product}', [ProductController::class, 'approve'])->name('manage.products.approve.update');
		Route::put('/products/is_featued/{product}', [ProductController::class, 'Isfeatured'])->name('manage.products.is.featured');
		Route::put('/products/not_featued/{product}', [ProductController::class, 'Notfeatured'])->name('manage.products.not.featured');
		Route::post('/products', [ProductController::class, 'store'])->name('manage.products.store');
		Route::post('/products/filtered', [ProductController::class, 'filtered'])->name('manage.products.filtered');
	# ----------- PROMOTIONS -----------
		Route::get('/promotions', [PromotionController::class, 'index'])->name('manage.promotions.index');
		Route::get('/promotions/{promotion}', [PromotionController::class, 'show'])->name('manage.promotions.show');
		Route::get('/promotions/create/{productid}', [PromotionController::class, 'create']);
		Route::get('/promotions/create/to/category', [PromotionController::class, 'createToCategory'])->name('manage.promotions.create.to.category');
		Route::get('/promotions/create/with/percent', [PromotionController::class, 'createWithPercentAll'])->name('manage.promotions.create.with.percent.all');
		Route::post('/promotions', [PromotionController::class, 'store'])->name('manage.promotions.store');
		Route::post('/promotions/to/category', [PromotionController::class, 'storeToCategory'])->name('manage.promotions.store.to.category');
		Route::post('/promotions/with/percent', [PromotionController::class, 'storeWithPercentAll'])->name('manage.promotions.store.with.percent.all');
	# ----------- CATEGORIES -----------
		Route::get('/categories', [CategoryController::class, 'showCategories'])->name('manage.categories.show');
		Route::get('/subcategories', [CategoryController::class, 'showSubCategories'])->name('manage.subcategories.show');
		Route::post('/subcategories', [CategoryController::class, 'storeSubCategories'])->name('manage.subcategories.store');
		Route::post('/categories', [CategoryController::class, 'storeCategories'])->name('manage.categories.store');
		Route::put('/categories/delete/{category}', [CategoryController::class, 'deleteCategories'])->name('manage.categories.delete');
		Route::put('/subcategories/delete/{subcategory}', [CategoryController::class, 'deleteSubCategories'])->name('manage.subcategories.delete');
	# ----------- ZONES -----------
		Route::get('/zones', [ZoneController::class, 'index'])->name('manage.zones.index');
		Route::post('/zones', [ZoneController::class, 'store'])->name('manage.zones.store');
	# ----------- SHIPPINGS -----------
		Route::get('/shippings', [ShippingController::class, 'index'])->name('manage.shippings.index');
		Route::post('/shippings', [ShippingController::class, 'store'])->name('manage.shippings.store');
	# ----------- PAYMENTS -----------
		Route::get('/payments', [PaymentController::class, 'index'])->name('manage.payments.index');
		Route::post('/payments', [PaymentController::class, 'store'])->name('manage.payments.store');
	# ----------- STATUSES -----------
		Route::get('/statuses', [StatusController::class, 'index'])->name('manage.statuses.index');
		Route::post('/statuses', [StatusController::class, 'store'])->name('manage.statuses.store');
	# ----------- OPTIONS GROUPS AND OPTIONS -----------

		# OPTIONS GROUPS
		Route::get('/options_groups', [OptionController::class, 'index'])->name('manage.options.index');
		Route::get('/options_groups/{option}/edit', [OptionController::class, 'editOptionsGroup'])->name('manage.options.editoptionsgroup');
		Route::post('/options_group', [OptionController::class, 'storeOptionsGroup'])->name('manage.options.storeoptionsgroup');
		Route::put('/options_group/{option}', [OptionController::class, 'updateOptionsGroup'])->name('manage.options.updateoptionsgroup');

		# OPTIONS
		Route::post('/options', [OptionController::class, 'storeOption'])->name('manage.options.store.option');
		Route::post('/options/create', [OptionController::class, 'createOption'])->name('manage.options.create.option');

	# ----------- SETTINGS -----------

		// 		// GOOGLE ANALYTICS CODE
		// 			Route::get('/settings/googleanalytics', 'SettingController@googleAnalytics')->name('google_analytics');
		// 			Route::post('/settings/googleanalytics', 'SettingController@storeGoogleAnalytics')->name('store.google_analytics');
		// 			Route::put('/settings/googleanalytics', 'SettingController@updateGoogleAnalytics')->name('update.google_analytics');

		// 		// TERMS
		// 			Route::get('/settings/terms', 'SettingController@terms')->name('terms');
		// 			Route::post('/settings/terms', 'SettingController@storeTerms')->name('store.terms');
		// 			Route::put('/settings/terms', 'SettingController@updateTerms')->name('update.terms');

		// 		// INFORMATION
		// 			Route::get('/settings/info', 'SettingController@info')->name('info');
		// 			Route::post('/settings/info', 'SettingController@storeInfo')->name('store.info');
		// 			Route::put('/settings/info', 'SettingController@updateInfo')->name('update.info');
	
	});
	# ------------------------------------------
# --------------- END ADMINS -----------------
