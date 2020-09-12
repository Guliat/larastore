<?php

namespace App\Http\Controllers;

use Session;
use App\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $zones = Zone::paginate(10);
        return view('manage.zones.index')->withZones($zones);
    }

    public function store(Request $request) {

        $this->validate($request, array(
            'name' => 'required|max:255|unique:zones,name'
            ));

        $zone = new Zone;
        $zone->name = $request->name;
        $zone->save();

        Session::flash('success', 'ДОБАВЕНО !');
        return redirect()->route('manage.zones.index');
    }
}
