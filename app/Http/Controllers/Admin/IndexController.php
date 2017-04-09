<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index()
    {	
    	var_dump(session("adminuser"));
		return view("admin.index.index");    
    }
}
