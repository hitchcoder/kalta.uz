<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BioController extends Controller
{
    public function create(Request $request){
        return view("bio.create");
    }
}