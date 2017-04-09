<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsUserParamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        dd($request->input());

        [
          "goodsuid" => "15b9843a154c11e7898129aef2eb8e4b"
          "ismust-0" => "1"
          "param-name-0" => "称呼"
          "tip-0" => "如：张先生,李小姐"
          "ismust-1" => "1"
          "param-name-1" => ""
          "tip-1" => ""
          "ismust-2" => ""
          "param-name-2" => ""
          "input-type" => "single-line"
          "tip-2" => ""
          "ismust-3" => ""
          "param-name-3" => ""
          "input-type-3" => "multiple-line"
          "tip-3" => ""
          "ismust-4" => ""
          "param-name-4" => ""
          "input-type-4" => "checkbox"
          "tip-4" => ""
          "param-name-4-param" => array:2 [
            0 => ""
            1 => ""
          ]
          "ismust-5" => ""
          "param-name-5" => ""
          "input-type-5" => "radio"
          "tip-5" => ""
          "param-name-5-param" => array:2 [
            0 => ""
            1 => ""
          ]

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
