<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UcenterController extends Controller
{
	#主页
    public function index()
    {
    	return view('ucenter.frame');
    }
    #主页的 主iframe
    public function ucenterIndex()
    {
    	return view('ucenter.index');
    }
}
