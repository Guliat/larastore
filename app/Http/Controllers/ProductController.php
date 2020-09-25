<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Image;
use Session;
use App\Photo;
use App\Option;
use App\Product;
use App\Category;
use App\SubCategory;
use App\Promotion;
use App\OptionGroup;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    // SHOW PRODUCT
    public function show(Product $product) {
        $photos = Photo::where('product_id', $product->id)->orderBy('order', 'asc')->get();
        $category = Category::where('id', $product->category_id)->first();
        return view('manage.products.show')
            ->withProduct($product)
            ->withCategory($category)
            ->withPhotos($photos);
    }
    // SHOW PRODUCTS
    public function index() {
        $products = Product::orderBy('created_at', 'DESC')
        // ->where('is_active', 1)
        #->where('uploader_id', '=', Auth::id())
        ->paginate(20);
        $categories = Category::orderBy('name', 'asc')->get();
        // count all products
        $count = Product::count();
        $count_active = Product::where('is_active', 1)->count();
        $countnotapproved = Product::where('is_approved', 0)->count();
        $countfeatured = Product::where('is_featured', 1)->count();
        return view('manage.products.table')->withProducts($products)->withCategories($categories)->withCount($count)->withCountactive($count_active)->withCountnotapproved($countnotapproved)->withCountfeatured($countfeatured);
    }

    public function showDeleted() {
        $products = Product::orderBy('created_at', 'DESC')->where('is_active', 0)->paginate(20);
        return view('manage.products.deleted')->withProducts($products);
    }
    // SHOW FILTERED PRODUCTS BY CATEGORY
    public function filtered(Request $request) {
        if($request->category_id == 'all') {
            return redirect('manage/products');
        }
        $products = Product::where('category_id', $request->category_id)->paginate(100);
        $categories = Category::all();
        $selected = $request->category_id;
        $count = $products->count();
        $count_active = Product::where('category_id', $request->category_id)->where('is_active', 1)->count();
        $countnotapproved = Product::where('category_id', $request->category_id)->where('is_approved', 0)->count();
        return view('manage.products.index')->withProducts($products)->withCategories($categories)->withSelected($selected)->withCount($count)->withCountactive($count_active)->withCountnotapproved($countnotapproved);
    }
    // SHOW CREATE PAGE
    public function create() {
        $categories = Category::all();
        $options_groups = OptionGroup::all();
        return view('manage.products.create')->withCategories($categories)->withOptionsgroups($options_groups);
    }
    // STORE NEW PRODUCT
    public function store(Request $request) {

        $this->validate($request, array(
                'name'          => 'required|min:3|max:255',
                'category_id'   => 'required|integer',
                'sell_price'    => 'numeric|min:0',
                #'buy_price'     => 'integer|min:0',
                'model'         => 'required',
            ));

        $uploader_id = Auth::id();
        $product = new Product;
        $product->name = $request->name;
        $product->tags = $request->tags;
        $product->model = $request->model;
        $product->slug = 'temp'.time();
        $product->description = $request->description;
        $product->fabric = $request->fabric;
        $product->category_id = $request->category_id;
        $product->sell_price = $request->sell_price;
        #$product->buy_price = $request->buy_price;
        $product->uploader_id = $uploader_id;
        $product->save();

        // STORE IF OPTIONS GROUP
        DB::table('product_options_groups')
                ->insert([
                        'product_id' => $product->id,
                        'option_group_id' => 1
                ]);
        // if($request->option_group) {
        //
        //     foreach($request->option_group as $option_group_id) {
        //
        //         DB::table('product_options_groups')
        //         ->insert([
        //                 'product_id' => $product->id,
        //                 'option_group_id' => $option_group_id
        //         ]);
        //
        //     }
        // }

        if($request->options) {
            foreach($request->options as $option_id) {

                $option_group = Option::where('id', $option_id)->first();

                DB::table('product_options')
                ->insert([
                    'product_id' => $product->id,
                    'option_group_id' => $option_group->option_group_id,
                    'option_id' => $option_id
                ]);
            }
        }

        // CHECK IF MORE THAN ONE WORD
        if(strpos(trim($request->name), ' ') !== false) {
            $slug = preg_replace('~[^\pL\d]+~u', '-', $request->name);
            #$slug = preg_replace('~[^-\w]+~', '', $slug);
            $slug = trim($slug, '-');
            $slug = preg_replace('~-+~', '-', $slug);
            $slug = mb_strtolower($slug);
            $slug = $slug.'-'.$product->id;


        //     // REPLACE SPACES WITH DASHES AND MAKE STRING LOWERCASE
        //     $slug = mb_strtolower(str_replace(' ', '-', $request->name));
        //     // if (Product::where('slug', '=', $slug)->exists()) {
        //     //     $slug = $slug.'-' .time();
        //     $slug = $slug.'-'.$product->id;

        } else {
            $slug = $request->name.'-'.$product->id;
        }

        $product->slug = $slug;
        $product->save();


        Session::flash('success', 'ЗАПИСАНО !');
        return redirect()->route('manage.photos.show', $product->id);
    }
    // EDIT PRODUCT
    public function edit(Product $product) {
        $categories = Category::where('is_active', 1)->orderBy('name', 'asc')->get();
        $subcategories = SubCategory::where('is_active', 1)->orderBy('name', 'asc')->get();
        $selectedOptions = $product->selected_options($product->id);
        $options_groups = OptionGroup::all();
        $photos = Photo::where('product_id', $product->id)->orderBy('order', 'asc')->get();
        // $selected_options_groups =  $product->selected_options_groups($product->id);
        // $non_selected_options_groups = OptionGroup::where('id', '!=', $selected_options_groups)->get();
        return view('manage.products.edit')
            ->withPhotos($photos)
            ->withProduct($product)
            ->withCategories($categories)
            ->withSubcategories($subcategories)
            ->withSelectedoptions($selectedOptions)
            ->withOptionsgroups($options_groups);
    }
    // APPROVE PRODUCT
    public function approve(Product $product) {
        $product->is_approved = 1;
        $product->save();

        return redirect()->route('manage.products.index');
    }
    // ADD FEATURED PRODUCT
    public function IsFeatured(Product $product) {
        $product->is_featured = 1;
        $product->save();
        return redirect()->back();
    }
    // REMOVE FEATURED PRODUCT
    public function NotFeatured(Product $product) {
        $product->is_featured = 0;
        $product->save();
        return redirect()->back();
    }

    // UPDATE PRODUCT
    public function update(Request $request, Product $product) {
        $this->validate($request, array(
                'name'          => 'required|min:3|max:255',
                #'slug'          => 'alpha_dash|min:5|max:255|unique:products,slug',
                'category_id'   => 'required|integer',
                'subcategory_id'   => 'required|integer',
                'sell_price'    => 'numeric|min:0',
                #'buy_price'     => 'integer|min:0',
                'model'         => 'required',
            ));

        $product->name = $request->name;
        $product->tags = $request->tags;
        $product->model = $request->model;
        $product->description = $request->description;
        $product->fabric = $request->fabric;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        #$product->buy_price = $request->buy_price;
        $product->sell_price = $request->sell_price;


        // DELETE ALL OPTIONS (CHECKBOXES)
        DB::table('product_options_groups')->where('product_id', $product->id)->delete();
        DB::table('product_options')->where('product_id', $product->id)->delete();

        // STORE IF OPTIONS GROUP
        if($request->option_group) {

            foreach($request->option_group as $option_group_id) {

                DB::table('product_options_groups')
                ->insert([
                        'product_id' => $product->id,
                        'option_group_id' => $option_group_id
                ]);

            }
        }

        if($request->options) {

            foreach($request->options as $option_id) {

                $option_group = Option::where('id', $option_id)->first();

                DB::table('product_options')
                ->insert([
                    'product_id' => $product->id,
                    'option_group_id' => $option_group->option_group_id,
                    'option_id' => $option_id
                ]);
            }
        }








        // // CHECKING SLUG
        // if(strpos(trim($request->name), ' ') !== false) {
        //     $slug = mb_strtolower(str_replace(' ', '-', $request->name));
        //     if (Product::where('slug', '=', $slug)->exists()) {
        //         $slug = $slug.'-' .time();
        //     }
        // } else {
        //     $slug = $request->name. '-' .time();
        // }
        //
        // $product->slug = $slug;

        $product->save();
        Session::flash('updated');
        // if($product->is_approved == 0) {
            // return redirect()->route('manage.products.approve.show', $product->id);
        // } else {
            return redirect()->back();
        // }

        #return redirect()->route('products.photos.upload', $product->id);
    }
    // DELETE PRODUCT
    public function destroy(Product $product, Request $request) {

        $promotion = Promotion::where('product_id', $product->id)->first();

        if(!empty($promotion)) {
            $promotion->end = '1000-01-01';
            $promotion->save();
        }

        $product->is_active = 0;
        $product->save();

        Session::flash('success', 'ПРОДУКТА Е ИЗТРИТ !');
        return redirect()->back();

    }
}
