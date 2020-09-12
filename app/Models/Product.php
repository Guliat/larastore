<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	public function subcategory()
	{
		return $this->belongsTo('App\SubCategory');
	}

	public function orders()
	{
		return $this->belongsToMany('App\Order');
	}

	public function photos()
	{
		return $this->hasMany('App\Photo');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'uploader_id');
	}


	static public function metaImage($product_id) {
		return DB::table('photos')->where('product_id', '=', $product_id)->where('is_meta', 1)->first();
	}

	static public function firstPhoto($product_id) {
		return DB::table('photos')->where('product_id', '=', $product_id)->where('order', 1)->first();
	}

	public function options_groups() {

		return $this->belongsToMany('App\OptionGroup', 'product_options_groups');

	}

	public function options($option_id) {

		return DB::table('options')->where('id', '=', $option_id)->get();

	}



	public function product_options($product_id, $option_group_id) {

		return DB::table('product_options')->where('product_id', '=', $product_id)->where('option_group_id', '=', $option_group_id)->get();

	}
	public function selected_options($product_id) {

		return DB::table('product_options')->where('product_id', '=', $product_id)->get();

	}
	public function selected_options_groups($product_id) {

		return DB::table('product_options_groups')->where('product_id', '=', $product_id)->select('option_group_id')->get();

	}




}
