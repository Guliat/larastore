<?php

namespace App\Http\Controllers;

use App\Vaucher;
use Illuminate\Http\Request;

class VaucherController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vaucher  $vaucher
     * @return \Illuminate\Http\Response
     */
    public function show(Vaucher $vaucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vaucher  $vaucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Vaucher $vaucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vaucher  $vaucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vaucher $vaucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vaucher  $vaucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vaucher $vaucher)
    {
        //
    }
}
