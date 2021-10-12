<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VodMatchController extends Controller{


    public function create(Request $request){
        return view('admin.livematch-create');
    }
}
