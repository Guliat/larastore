<?php

namespace App\Http\Controllers;

use Session;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $statuses = Status::paginate(10);
        return view('manage.statuses.index')->withStatuses($statuses);
    }

    public function store(Request $request) {

        $this->validate($request, array(
            'name' => 'required|max:255|unique:statuses,name'
        ));

        $status = new Status;
        $status->name = $request->name;
        $status->save();

        Session::flash('success', 'ДОБАВЕНО !');
        return redirect()->route('manage.statuses.index');
    }

}
