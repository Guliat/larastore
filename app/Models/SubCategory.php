<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model {

	protected $table = 'subcategories';

	public function products()
	{
		return $this->hasMany('App\Product');
	}
}
