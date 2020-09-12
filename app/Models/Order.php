<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  public function products()
	{
		return $this->belongsToMany('App\Product')->withPivot('options', 'quantity', 'sold_price', 'created_at');
	}

  public function statuses()
	{
		return $this->belongsToMany('App\Status')->withPivot('comment')->withTimestamps();
	}

	public function zone()
	{
		return $this->belongsTo('App\Zone');
	}

	public function shipping()
	{
		return $this->belongsTo('App\Shipping');
	}

  public function payment()
  {
      return $this->belongsTo('App\Payment');
  }

  public function user() {
      return $this->belongsTo('App\User');
  }

}
