<?php

namespace App\Http\Controllers;

use Session;
use App\Option;
use App\OptionGroup;
use Illuminate\Http\Request;

class OptionController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $options_groups = OptionGroup::all();
        return view('manage.options.index')->withOptionsgroups($options_groups);
    }

    public function editOptionsGroup(OptionGroup $option) {
        return view('manage.options.editOptionsGroup')->withOptiongroup($option);
    }

    public function createOption(Request $request) {
        $option_group_id = $request->option_group_id;
        return view('manage.options.create')->withOptiongroup($option_group_id);
    }

    public function storeOptionsGroup(Request $request) {
        $option = new OptionGroup;
        $option->name = $request->name;
        $option->save();
        Session::flash('success', 'ДОБАВЕНО !');
        return redirect()->route('manage.options.index');
    }

    public function updateOptionsGroup(Request $request, OptionGroup $option) {
        $option->name = $request->name;
        $option->save();
        Session::flash('success', 'ОБНОВЕНО !');
        return redirect()->route('manage.options.index');
    }



    public function storeOption(Request $request) {

        $option = new Option;
        $option->option_group_id = $request->option_group_id;
        $option->name = $request->name;
        $option->save();

        Session::flash('success', 'ДОБАВЕНО !');
        return redirect()->route('manage.options.index');

    }













}
