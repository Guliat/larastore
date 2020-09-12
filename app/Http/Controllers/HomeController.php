<?php

namespace App\Http\Controllers;

use DB;
use Cart;
use Session;
use Validator;
use App\User;
use App\Zone;
use App\Order;
use App\Photo;
use App\Option;
use App\Payment;
use App\Product;
use App\Setting;
use App\Shipping;
use App\Category;
use App\Promotion;
use Illuminate\Http\Request;
use App\Notifications\newOrder;

class HomeController extends Controller {


  public function reviewOrder() {

    $shippings = Shipping::all();
    $defaultShipping = Shipping::first()->name;
    $zones = Zone::orderBy('name')->get();
    $payments = Payment::all();
    $defaultPayment = Payment::first()->name;
    $terms = Setting::select('terms')->first();

    return view('home.orders.review')
        ->withShippings($shippings)
        ->withDefaultShipping($defaultShipping)
        ->withZones($zones)
        ->withPayments($payments)
        ->withDefaultPayment($defaultPayment);
  }

  public function storeOrderToSession(Request $request) {
    // VALIDATE DATA
    $validator = Validator::make($request->all(), [
      'names'    => 'required|min:3|max:255',
      'phone'    => 'required|numeric',
      'address'  => 'required|min:5|max:255',
      'zone'     => 'required',
    ]);
    // CHECK VALIDATOR
    if($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    // CUSTOMER NAMES
    Session::put('customer_names', $request->names);
    // CUSTOMER PHONE NUMBER
    Session::put('customer_phone', $request->phone);
    // SHIPPING ZONE
    Session::put('shipping_zone', $request->zone);
    // SHIPPING COMPANY
    Session::put('shipping_company', $request->company);
    // SHIPPING TYPE
    Session::put('shipping_type', $request->type);
    // SHIPPING ADDRESS
    Session::put('address', $request->address);
    // ORDER COMMENT
    Session::put('comment', $request->comment);
    // GO TO REVIEW PAGE
    return redirect()->route('order.review');
  }

  public function storeOrder(Request $request) {
    if(Cart::content()->isEmpty()) {
        return redirect()->route('order.create');
    }
    // VALIDATE DATA
    $validator = Validator::make($request->all(), [
                'names'    => 'required|min:3|max:255',
                'phone'    => 'required|numeric',
                'address'  => 'required|min:5|max:255',
                'zone'     => 'required',
                'shipping' => 'required',
                // 'terms'    => 'accepted',
            ]);

    if($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $order = new Order;

    // CUSTOMER NAMES
    $order->names = $request->names;

    // CUSTOMER PHONE NUMBER
    $order->phone = $request->phone;

    // SHIPPING METHOD
    $shipping = Shipping::where('name', '=', $request->shipping)->first();
    $order->shipping_id = $shipping->id;
    $order->shipping_price = $shipping->price;

    // SHIPPING ZONE
    $order->zone_id = $request->zone;

    // SHIPPING ADDRESS
    $order->address = $request->address;

    // PAYMENT METHOD
    $payment = Payment::where('name', '=', $request->payment)->first();
    $order->payment_id = $payment->id;

    // ORDER COMMENT
    $order->comment = $request->comment;

    // USER AGENT
    $order->user_agent = $_SERVER['HTTP_USER_AGENT'];

    // TOTAL CART PRICE
    $cart_total = null;
    foreach(Cart::content() as $ctRow) {
        $cart_total += $ctRow->total;
    }

    if($cart_total > 100.00) {
        $order->total_price = $cart_total;
    } else {
        $order->total_price = $cart_total + $shipping->price;
    }


    // STORE DATA TO DATABASE
    $order->save();

    $order->statuses()->sync('1', false);

    // STORE ADDITIONAL DATA TO INTERMEDIATE TABLE

    foreach(Cart::content() as $row) {
        $options = null;
        foreach($row->options as $opt) {
            $options .= $opt.' , ';
        }
        $order->products()->attach($row->id, ['options' => $options, 'quantity' => $row->qty, 'sold_price' => $row->price]);
    }

    // EMPTYING CART
    Cart::destroy();

    // $getSumTotal = Order::where('id', $order->id)->select('order_total')->first();
    $sumTotal = $order->total_price;

    // SEND SUCCESS MESSAGE
    // Session::flash('success', 'БЛАГОДАРИМ ВИ ! <br />ПОРЪЧКАТА ВИ Е РЕГИСТРИРАНА. <br />СУМАТА ЗА ПЛАЩАНЕ Е '. $sumTotal .'лв.');

    // RETURN TO HOME
    return view('home.orders.success')->withOrder($order);
  }

  public function successOrder($id) {
    $order = Order::where('id', $id)->first();
    return view('home.orders.success')->withOrder($order);
  }
 
  // ----------------------

  public function showCart() {
    return view('home.orders.create');
  }

  public function storeCart(Request $request) {
    Session::put('previous2', $request->previous_page);
    $product_id = $request->product_id;
    $name = $request->name;
    $price = $request->price;
    if(!empty($request->quantity)) {
        $qty = $request->quantity;
    } else {
        $qty = 1;
    }

    if($request->option) {
        foreach($request->option as $row) {
            $options[] = $row[0];
        }
        Cart::add(['id' => $product_id, 'name' => $name, 'qty' => $qty, 'price' => $price, 'weight' => 0, 'options' => $options]);
    } else {
        Cart::add(['id' => $product_id, 'name' => $name, 'qty' => $qty, 'price' => $price, 'weight' => 0]);
    }
    return redirect()->route('order.create');
  }

  public function createOrder() {

    $shippings = Shipping::all();
    $defaultShipping = Shipping::first()->name;
    $zones = Zone::orderBy('name')->get();
    $payments = Payment::all();
    $defaultPayment = Payment::first()->name;
    $terms = Setting::select('terms')->first();

    return view('home.orders.create')
        ->withShippings($shippings)
        ->withDefaultShipping($defaultShipping)
        ->withZones($zones)
        ->withPayments($payments)
        ->withDefaultPayment($defaultPayment);
  }

  public function updateCart(Request $request) {
    // Cart::update($request->rowId, ['options' => $request->option]);
    Cart::update($request->rowId, ['options' => $request->option, 'qty' => $request->quantity]);

    // Session::flash('success', 'ОБНОВЕНО !');
    return redirect()->route('order.create');
  }

  public function deleteCart(Request $request) {
    Cart::remove($request->rowId);
    // Session::flash('success', 'Успешно премахнахте продукта от покупките си.');
    return redirect()->route('order.create');
  }

  public function storeFastOrder(Request $request) {
    // VALIDATE DATA
    $validator = Validator::make($request->all(), [
                'phone'    => 'digits:10',
            ]);
    if($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    // STORE ORDER
    $order = new Order;
    $order->phone = $request->phone;
    $order->viber = $request->viber;
    $order->save();
    $order->statuses()->sync('1', false);
    foreach(Cart::content() as $row) {
      $options = null;
      foreach($row->options as $opt) {
          $options .= $opt.' , ';
      }
      $order->products()->attach($row->id, ['options' => $options, 'quantity' => $row->qty, 'sold_price' => $row->price]);
    }
    // EMPTYING CART
    Cart::destroy();
    // SEND SUCCESS MESSAGE
    Session::flash('success', 'БЛАГОДАРИМ ВИ! <br />ПОРЪЧКАТА ВИ Е РЕГИСТРИРАНА.');
    // RETURN TO HOME
    return redirect('home');
  }

 // -----------------------

  // public function index() {
  //     return view('home.home');
  // }

  public function check_expired_promo() {

      $today = date('Y-m-d');
      $promotions = Promotion::where('end', '<', $today)->get();

      foreach($promotions as $promo) {
          $update = Promotion::find($promo->id);
          $update->is_active = 0;
          $update->save();
      }
  }

  public function boutiqueHome() {
    return view('boutique.home');
  }

  public function allProducts() {
    // SET DEFAULT VIEW and SORT SETTINGS
    if(empty(Session::get('category_sort'))) {
      Session::put('category_sort', 'newest');
    }
    if(empty(Session::get('category_view'))) {
      Session::put('category_view', 'block');
    }
    $category_sort = Session::get('category_sort');
    if($category_sort == 'newest') {
      $sort = 'created_at';
      $direction = 'desc';
    } elseif($category_sort == 'lowtohigh') {
      $sort = 'sell_price';
      $direction = 'asc';
    } elseif($category_sort == 'hightolow') {
      $sort = 'sell_price';
      $direction = 'desc';
    } elseif($category_sort == 'oldest') {
      $sort = 'created_at';
      $direction = 'asc';
    }
    $date = date("Y-m-d H:m:i", (strtotime("-3 months")));
    $products = Product::where('is_active', 1)->where('is_approved', 1)->where('created_at', '<=', $date)->orderBy($sort, $direction)->paginate(10);
    return view('home.products.all')->withProducts($products);
  }

  public function newProducts() {
      $date = date("Y-m-d H:m:i", (strtotime("-3 months")));
      $products = Product::where('is_active', 1)->where('is_approved', 1)->where('created_at', '>=', $date)->orderBy('created_at', 'desc')->paginate(10);
      return view('home.products.new')->withProducts($products);
  }

  public function promoProducts() {
    // SET DEFAULT VIEW and SORT SETTINGS
    if(empty(Session::get('category_sort'))) {
      Session::put('category_sort', 'lowtohigh');
    }
    if(empty(Session::get('category_view'))) {
      Session::put('category_view', 'grid');
    }
    $category_sort = Session::get('category_sort');
    if($category_sort == 'newest') {
      $sort = 'created_at';
      $direction = 'desc';
    } elseif($category_sort == 'lowtohigh') {
      $sort = 'price';
      $direction = 'asc';
    } elseif($category_sort == 'hightolow') {
      $sort = 'price';
      $direction = 'desc';
    } elseif($category_sort == 'oldest') {
      $sort = 'created_at';
      $direction = 'asc';
    }
    $promotions = Promotion::where('is_active', '=', 1)->orderBy($sort, $direction)->paginate(10);
    return view('home.products.promo')->withPromotions($promotions);
  }

  public function getSingle($slug) {
    $product = Product::where('slug', '=', $slug)->first();
    if(!$product) {
        return abort(404);
    } elseif($product->is_active == 0) {
        Session::flash('notsuccess', 'ТОЗИ ПРОДУКТ НЕ Е НАЛИЧЕН В МОМЕНТА');
        return redirect()->route('home');
    } else {
        $photos = Photo::where('product_id', '=', $product->id)->orderBy('order', 'asc')->get();
        $count = Photo::where('product_id', '=', $product->id)->count();
        $promo_price = Promotion::where('product_id', '=', $product->id)->where('is_active', '=', 1)->first();
        $firstPhoto = Photo::where('product_id', '=', $product->id)->where('order', 1)->first();
        $metaPhoto = Photo::where('product_id', $product->id)->where('is_meta', 1)->first();

        $related_products_category = Product::where('is_active', 1)->where('is_approved', 1)->where('category_id', '=', $product->category_id)->where('id', '!=', $product->id)->orderBy(DB::raw( 'RAND()' ))->take(5)->get();
        $min_price = $product->sell_price - 5;
        $max_price = $product->sell_price + 5;
        $related_products_price = Product::where('is_active', 1)->where('is_approved', 1)->whereBetween('sell_price', [$min_price, $max_price])->where('id', '!=', $product->id)->orderBy(DB::raw( 'RAND()' ))->take(5)->get();
    }
    return view('home.products.show')
        ->withProduct($product)
        ->withPhotos($photos)
        ->withCount($count)
        ->withPromoprice($promo_price)
        ->withFirstPhoto($firstPhoto)
        ->withmetaPhoto($metaPhoto)
        ->withRpc($related_products_category)
        ->withRpp($related_products_price);
  
  }

  public function getCategoryProducts($slug) {
      // SET DEFAULT VIEW and SORT SETTINGS
      if(empty(Session::get('category_sort'))) {
        Session::put('category_sort', 'newest');
      }
      if(empty(Session::get('category_view'))) {
        Session::put('category_view', 'block');
      }

        $category = Category::where('slug', $slug)->first();
        if(!$category) {
            return abort(404);
        } else {
          $category_sort = Session::get('category_sort');
          if($category_sort == 'newest') {
            $sort = 'created_at';
            $direction = 'desc';
          } elseif($category_sort == 'lowtohigh') {
            $sort = 'sell_price';
            $direction = 'asc';
          } elseif($category_sort == 'hightolow') {
            $sort = 'sell_price';
            $direction = 'desc';
          } elseif($category_sort == 'oldest') {
            $sort = 'created_at';
            $direction = 'asc';
          }
          $category_id = $category->id;
          $categoryProducts = Product::where('category_id', '=', $category_id)
            ->where('is_active', 1)
            ->where('is_approved', 1)
            ->orderBy($sort, $direction)
            ->paginate(10);
          return view('home.products.category')
            ->withProducts($categoryProducts)
            ->withCategory($category->name)
            ->withCategoryid($category->id);
        }
  }

  public function search(Request $request) {
        $this->validate($request, array(
                'search'          => 'required',
            ));
        $q = $request->search;
        $results = Product::where('is_active', 1)
                            ->where('is_approved', 1)
                            ->where('name', 'like', "%" . $q . "%")
                            ->orWhere('model', 'like', "%" . $q . "%")
                            ->orWhere('tags', 'like', "%" . $q . "%")
                            ->get();
        return view('home.indexSearch')->withResults($results)->withQuery($q);
  }

  public function randomProduct() {

        $productsIds = Product::where('is_active', 1)->where('is_approved', 1)->select('id')->get();
        foreach($productsIds as $prd) {
            $randomId[] = $prd->id;
        }
        $randomIdd = array_rand($randomId);
        if($randomIdd == 0) {
            return redirect()->back();
        }
        $product = Product::where('id', '=', $randomIdd)->first();

            $photos = Photo::where('product_id', '=', $product->id)->orderBy('order', 'asc')->get();
            $count = Photo::where('product_id', '=', $product->id)->count();
            $promo_price = Promotion::where('product_id', '=', $product->id)->where('is_active', '=', 1)->first();
            $firstPhoto = Photo::where('product_id', '=', $product->id)->where('order', 1)->first();
            $metaPhoto = Photo::where('product_id', $product->id)->where('is_meta', 1)->first();
        return view('home.random')
        ->withProduct($product)
        ->withPhotos($photos)
        ->withCount($count)
        ->withPromoprice($promo_price)
        ->withFirstPhoto($firstPhoto)
        ->withRandom($randomIdd)
        ->withmetaPhoto($metaPhoto);

  }

  public function nightLight() {
      Session::put('nightLight', 'confirmed');
      return redirect()->back();
  }

  public function cookies() {
      return view('home.info.cookies');
  }

  public function cookiesAccepted() {
      Session::put('cookies', 'accepted');
      return redirect()->back();
  }

  static public function getProductImage($id) {
      $photo = Photo::where('product_id', $id)->where('order', 1)->first();
      return $photo;
  }

  static public function getProductSlug($id) {
      $slug = Product::where('id', $id)->select('slug')->first();
      return $slug;
  }

  static public function getProductOptions($id) {
      $model = new Product;
      $options = $model->product_options($id, 1);

      // $result = Option::where('id', $options->option_id)->get();

      foreach($options as $option) {
        // echo $option->option_id;
        $name = Option::where('id', $option->option_id)->first();
        $ar[] = ["id" => $option->option_id, "name"=>$name->name];
      }

      // var_dump($ar);

      return $ar;
  }
  
  public function terms() {
    $terms = Setting::select('terms')->first();
    return view('home.info.terms')->withTerms($terms);
  }

  public function info() {
    $info = Setting::select('information')->first();
    return view('home.info.info')->withInfo($info);
  }
  
  public function vaucher() {
      return view('home.vaucher');
  }

  // FILTER PRODUCTS IN CATEGORY VIEW - PRICE AND DATE SORT
  public function filterCategoryToLow() {
    Session::put('category_sort', 'hightolow');
    return redirect()->back();
  }
  public function filterCategoryToHigh() {
    Session::put('category_sort', 'lowtohigh');
    return redirect()->back();
  }
  public function filterCategoryNewest() {
    Session::put('category_sort', 'newest');
    return redirect()->back();
  }
  public function filterCategoryOldest() {
    Session::put('category_sort', 'oldest');
    return redirect()->back();
  }
  // CHANGE PRODUCTS VIEW IN CATEGORY
  // TO GRID
  public function CategoryViewGrid() {
    Session::put('category_view', 'grid');
    return redirect()->back();
  }
  // TO BLOCK
  public function CategoryViewBlock() {
    Session::put('category_view', 'block');
    return redirect()->back();
  }
  
  // UNUSED FUNCITONS AFTER CHANGE IN CART PAGE
  // public function updateCartUp(Request $request) {
  //     $qty = $request->quantity + 1;
  //     Cart::update($request->rowId, $qty);
  //     Session::flash('success', 'ОБНОВЕНО !');
  //     return redirect()->route('cart.show');
  // }
  // public function updateCartDown(Request $request) {
  //     $qty = $request->quantity - 1;
  //     Cart::update($request->rowId, $qty);
  //     Session::flash('success', 'ОБНОВЕНО !');
  //     return redirect()->route('cart.show');
  // }
}
