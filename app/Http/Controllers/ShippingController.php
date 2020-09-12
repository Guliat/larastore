<?php

namespace App\Http\Controllers;

use Session;
use App\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $shipping = Shipping::paginate(10);
        return view('manage.shippings.index')->withShippings($shipping);
    }

    public function store(Request $request) {

        $this->validate($request, array(
            'name' => 'required|max:255|unique:shippings,name',
            'price' => 'required|numeric'
            ));

        $shipping = new Shipping;
        $shipping->name = $request->name;
        $shipping->price = $request->price;
        $shipping->save();

        Session::flash('success', 'ДОБАВЕНО !');
        return redirect()->route('manage.shippings.index');
    }
}
