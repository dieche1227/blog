<?php

namespace App\Http\Controllers\Home;

use App\Services\AddressService;
use App\Services\GoodsService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    protected static $addressServer = null;
    protected static $orderServer = null;
    protected static $goodsServer = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(AddressService $addressService,OrderService $orderService,GoodsService $goodsService)
    {
        self::$addressServer = $addressService;
        self::$orderServer = $orderService;
        self::$goodsServer = $goodsService;
    }

    public function index()
    {
        //

        return view("home.order.account");
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
        $data = $request->all();
        $value = $request->session()->all();
        $data['uid'] = $value['guid'];
        $value = $request->session()->all();
        $u = $value['guid'];
        self::$orderServer->createOrder($data);
        return redirect("home/order/$u");


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //获取商品和用户地址信息
//        dd($id);
        $goodData = self::$goodsServer->getGoodsInfo($id);
        $value = $request->session()->all();
        $guid = $value['guid'];

        //$goodImg = self::$goodsServer->getGoodsImg($id);
        $addressInfo = self::$addressServer->getAddressList($guid);

        return view('home.order.account',['addressInfo'=>$addressInfo,'goodData'=>$goodData]);
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
