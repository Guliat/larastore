<?php

namespace App\Http\Controllers;

use App\Setting;
use Session;
use Illuminate\Http\Request;

class SettingController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }


    // GOOGLE ANALYTICS CODE
    public function googleAnalytics() {
        $code = Setting::select('id', 'google_analytics_code')->first();
        // IF NO GOOGLE ANALYTICS CODE
        if($code == null) {
            return view('manage.settings.create_google_analytics');
        // ELSE EDIT GOOGLE ANALYTICS CODE
        } else {
            return view('manage.settings.edit_google_analytics')->withCode($code);
        }
    }
    // STORE GOOGLE ANALYTICS CODE
    public function storeGoogleAnalytics(Request $request) {
        $store = new Setting;
        $store->google_analytics_code = $request->code;
        $store->save();
        Session::flash('success', 'Добавено!');
        return redirect()->back();
    }
    // UPDATE GOOGLE ANALYTICS CODE
    public function updateGoogleAnalytics(Request $request) {
        $update = Setting::find($request->id);
        $update->google_analytics_code = $request->code;
        $update->save();
        Session::flash('success', 'Обновено!');
        return redirect()->back();
    }

    // GET TERMS
    public function terms() {
        $terms = Setting::select('id', 'terms')->first();
        // IF NO TERMS
        if($terms == null) {
            return view('manage.settings.create_terms');
        // ELSE EDIT TERMS
        } else {
            return view('manage.settings.edit_terms')->withTerms($terms);
        }
    }
    // STORE TERMS
    public function storeTerms(Request $request) {
        $store = new Setting;
        $store->terms = $request->terms;
        $store->save();
        Session::flash('success', 'Добавено!');
        return redirect()->back();
    }
    // UPDATE TERMS
    public function updateTerms(Request $request) {
        $update = Setting::find($request->id);
        $update->terms = $request->terms;
        $update->save();
        Session::flash('success', 'Обновено!');
        return redirect()->back();
    }

    // GET INFO
    public function info() {
        $info = Setting::select('id', 'information')->first();
        // IF NO INFO
        if($info == null) {
            return view('manage.settings.create_info');
        // ELSE EDIT INFO
        } else {
            return view('manage.settings.edit_info')->withInfo($info);
        }
    }
    // STORE INFO
    public function storeInfo(Request $request) {
        $store = new Setting;
        $store->information = $request->information;
        $store->save();
        Session::flash('success', 'Добавено!');
        return redirect()->back();
    }
    // UPDATE TERMS
    public function updateInfo(Request $request) {
        $update = Setting::find($request->id);
        $update->information = $request->information;
        $update->save();
        Session::flash('success', 'Обновено!');
        return redirect()->back();
    }

}
