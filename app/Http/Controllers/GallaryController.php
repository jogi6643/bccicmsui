<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GallaryController extends Controller{
    //

    public function index(Request $request){
        return view('admin.gallary');
    }
}
