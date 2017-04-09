<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UzoneController extends Controller
{
    
    public function index(){
    	return view('uzone.index');
    }
}
