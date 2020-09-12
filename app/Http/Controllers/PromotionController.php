<?php

namespace App\Http\Controllers;

use Validator;
use App\Product;
use App\Promotion;
use App\Category;
use Illuminate\Http\Request;

class PromotionController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $promotions = Promotion::where('is_active', '=', 1)->paginate(15);
        $total = $promotions->total();
        return view('manage.promotions.index')->withTotal($total)->withPromotions($promotions);
    }

    public function create($id) {
        $product = Product::where('id', '=', $id)->first();
        return view('manage.promotions.create')->withProduct($product);
    }

    public function createToCategory() {
        $categories = Category::all();
        return view('manage.promotions.create_to_category')->withCategories($categories);
    }

    public function createWithPercentAll() {
        $categories = Category::all();
        return view('manage.promotions.create_with_percent_all');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
                    'price'    => 'required|numeric',
                    'promo_days'    => 'required',
                ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $promo = new Promotion;
        $promo->product_id = $request->product_id;
        $promo->price = $request->price;

        $start = date("Y-m-d");
        if($request->promo_days == 7) {
            $end = date("Y-m-d", (strtotime("+1 week")));
        }
        if($request->promo_days == 14) {
            $end = date("Y-m-d", (strtotime("+2 week")));
        }
        if($request->promo_days == 30) {
            $end = date("Y-m-d", (strtotime("+1 month")));
        }
        if($request->promo_days == 60) {
            $end = date("Y-m-d", (strtotime("+2 months")));
        }
        $promo->start = $start;
        $promo->end = $end;
        $promo->save();

        return redirect()->route('manage.promotions.show', $promo->id);
    }

    public function storeToCategory(Request $request) {

        $validator = Validator::make($request->all(), [
                    'price'    => 'required|numeric',
                    'promo_days'    => 'required',
                    'category_id'    => 'required',
                ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $products = Product::where('category_id', '=', $request->category_id)->get();

        foreach($products as $product) {

            $promo = new Promotion;
            $promo->product_id = $product->id;
            $promo->price = $request->price;

            $start = date("Y-m-d");
            if($request->promo_days == 7) {
                $end = date("Y-m-d", (strtotime("+1 week")));
            }
            if($request->promo_days == 14) {
                $end = date("Y-m-d", (strtotime("+2 week")));
            }
            if($request->promo_days == 30) {
                $end = date("Y-m-d", (strtotime("+1 month")));
            }
            if($request->promo_days == 60) {
                $end = date("Y-m-d", (strtotime("+2 months")));
            }
            $promo->start = $start;
            $promo->end = $end;
            $promo->save();

        }

        return redirect()->route('manage.promotions.index');
    }

    // store promotion with percent to all products
    public function storeWithPercentAll(Request $request) {
        $validator = Validator::make($request->all(), [
                    'percent'    => 'required|numeric|min:1',
                    'promo_days'    => 'required',
                ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $products = Product::all();

        foreach($products as $product) {

            $percent = 100 - $request->percent;
            $result = $product->sell_price * $percent;
            $price = $result / 100;
            $price = round($price);

            $promo = new Promotion;
            $promo->product_id = $product->id;
            $promo->price = $price;

            $start = date("Y-m-d");
            if($request->promo_days == 7) {
                $end = date("Y-m-d", (strtotime("+1 week")));
            }
            if($request->promo_days == 14) {
                $end = date("Y-m-d", (strtotime("+2 week")));
            }
            if($request->promo_days == 30) {
                $end = date("Y-m-d", (strtotime("+1 month")));
            }
            if($request->promo_days == 60) {
                $end = date("Y-m-d", (strtotime("+2 months")));
            }
            $promo->start = $start;
            $promo->end = $end;
            $promo->save();

        }

        return redirect()->route('manage.promotions.index');
    }

    public function show(Promotion $promotion) {
        $product = Product::where('id', '=', $promotion->product_id)->first();
        return view('manage.promotions.show')->withProduct($product)->withPromotion($promotion);
    }
}
