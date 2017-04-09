<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GoodsService;

class GoodsController extends Controller
{
    

    public function __construct(GoodsService $goodsService)
    {
        $this->goodsService = $goodsService;

    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $input = $request->all();
        if (empty($input['page']) || (int)$input['page'] < 1)
        {
            $page = 1;
        } else {
            $page = $input['page'];
        }

        $goods = $this->goodsService->getGoodsList();
       
        $pageHtml = \App\Tools\CustomPage::page($goods['total'], $goods['current_page'], $pnum = 10, $pagenum = 5, '/admin/goods?', $pagename = 'page',$anchor = '');


       
        return view('admin.goods.index', ['goods'=>$goods,
                                        'pageHtml'=>$pageHtml    
                                        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.goods.create');
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
        return view('admin.goods.show');
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
