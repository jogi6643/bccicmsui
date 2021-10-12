<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VenueController extends Controller{
    //

    public function index(Request $request){
        return view('admin.venue');
    }
}
