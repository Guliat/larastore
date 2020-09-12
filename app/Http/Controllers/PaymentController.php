<?php

namespace App\Http\Controllers;

use Session;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $payment = Payment::paginate(10);
        return view('manage.payments.index')->withPayments($payment);
    }

    public function store(Request $request) {

        $this->validate($request, array(
            'name' => 'required|max:255|unique:payments,name'
            ));

        $payment = new Payment;
        $payment->name = $request->name;
        $payment->save();

        Session::flash('success', 'ДОБАВЕНО !');
        return redirect()->route('manage.payments.index');
    }
}
