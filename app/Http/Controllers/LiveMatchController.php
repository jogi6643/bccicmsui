<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiveMatchController extends Controller{
    //

    public function create(Request $request){
        return view('admin.livematch-create');
    }
}
