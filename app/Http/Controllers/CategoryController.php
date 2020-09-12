<?php

namespace App\Http\Controllers;

use Session;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function showCategories() {
        $categories = Category::where('is_active', 1)->paginate(10);
        $deleted_categories = Category::where('is_active', 0)->get();
        return view('manage.categories.index')->withDeletedcategories($deleted_categories)->withCategories($categories);
    }

    public function storeCategories(Request $request) {
        $this->validate($request, array(
            'name' => 'required|min:3|max:255|unique:categories,name'
            ));
        $category = new Category;
        // CHECK IF MORE THAN ONE WORD
        if(strpos(trim($request->name), ' ') !== false) {
            $slug = preg_replace('~[^\pL\d]+~u', '_', $request->name);
            #$slug = preg_replace('~[^-\w]+~', '', $slug);
            $slug = trim($slug, '_');
            $slug = preg_replace('~-+~', '_', $slug);
            $slug = mb_strtolower($slug);
        //     // REPLACE SPACES WITH DASHES AND MAKE STRING LOWERCASE
        //     $slug = mb_strtolower(str_replace(' ', '-', $request->name));
        //     // if (Product::where('slug', '=', $slug)->exists()) {
        //     //     $slug = $slug.'-' .time();
        //     $slug = $slug.'-'.$product->id;
        } else {
            $slug = mb_strtolower($request->name);
        }
        $category->slug = $slug;
        $category->name = $request->name;
        $category->save();
        Session::flash('success', 'ДОБАВЕНО !');
        return redirect()->route('manage.categories.show');
    }

    public function deleteCategories(Category $category) {
      $category->is_active = 0;
      $category->save();
      return redirect()->back();
    }

    public function showSubCategories() {
        $subcategories = SubCategory::where('is_active', 1)->paginate(10);
        $deleted_subcategories = SubCategory::where('is_active', 0)->get();
        return view('manage.subcategories.index')->withDeletedsubcategories($deleted_subcategories)->withSubcategories($subcategories);
    }

    public function storeSubCategories(Request $request) {
        $this->validate($request, array(
            'name' => 'required|min:3|max:255|unique:subcategories,name'
            ));
        $subcategory = new SubCategory;
        // CHECK IF MORE THAN ONE WORD
        if(strpos(trim($request->name), ' ') !== false) {
            $slug = preg_replace('~[^\pL\d]+~u', '_', $request->name);
            #$slug = preg_replace('~[^-\w]+~', '', $slug);
            $slug = trim($slug, '_');
            $slug = preg_replace('~-+~', '_', $slug);
            $slug = mb_strtolower($slug);
        //     // REPLACE SPACES WITH DASHES AND MAKE STRING LOWERCASE
        //     $slug = mb_strtolower(str_replace(' ', '-', $request->name));
        //     // if (Product::where('slug', '=', $slug)->exists()) {
        //     //     $slug = $slug.'-' .time();
        //     $slug = $slug.'-'.$product->id;
        } else {
            $slug = mb_strtolower($request->name);
        }
        $subcategory->slug = $slug;
        $subcategory->name = $request->name;
        $subcategory->save();
        Session::flash('success', 'ДОБАВЕНО !');
        return redirect()->route('manage.subcategories.show');
    }

    public function deleteSubCategories(SubCategory $subcategory) {
      $subcategory->is_active = 0;
      $subcategory->save();
      return redirect()->back();
    }
}
