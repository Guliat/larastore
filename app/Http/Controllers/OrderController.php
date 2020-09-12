<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Order;
use App\Status;
use App\Shipping;
use Illuminate\Http\Request;

class OrderController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $orders = Order::orderBy('created_at', 'desc')->paginate('10');
        return view('manage.orders.index')->withOrders($orders);
    }

    public function show(Order $order) {

        $total = null;
        foreach($order->products as $product) {
            $total += $product->pivot->quantity * $product->sell_price;
        }
        $statuses = Status::all();
        $used_statuses = $order->statuses()->orderBy('order_status.created_at', 'asc')->get();
        return view('manage.orders.show')->withOrder($order)->withTotal($total)->withStatuses($statuses)->withUsedstatuses($used_statuses);
    }

    public function storeStatus(Request $request) {

        $order = Order::find($request->order_id);
        $order->statuses()->sync($request->status_id, false);

        $order->statuses()->updateExistingPivot($request->status_id, ['comment' => $request->comment]);

        Session::flash('success', 'ОБНОВЕНО !');
        return redirect()->back();
    }

    public function stats() {
        return view('manage.orders.stats');
    }

}
