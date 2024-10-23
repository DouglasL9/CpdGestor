<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManuaisController extends Controller
{
    public function index(){
        return view('manuais.index');
    }
}
