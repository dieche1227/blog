<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressPost;
use App\Services\AddressService;

class AddressController extends Controller
{
    protected static $addressServer = null;


    public function __construct(AddressService $addressService)
    {
        self::$addressServer = $addressService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $data = \App\Models\AddressModel::all();

        // dd($data);

//        return view("home.address");
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
    public function store(StoreAddressPost $request)
    {
        //获取提交数据

         $data = $request->all();

         $data['region'] = $data['region'][0]."/".$data['region'][1]."/".$data['region'][2];

         if($data['phone']){
            $data['phone'] = $data['phone'][0].$data['phone'][1].$data['phone'][2];
         }
         if(!in_array("status", $data)){
            $data['status'] = 0;
         }
         $value = $request->session()->all();
         $data['uid'] = $value['guid'];
//        dd($data['uid']);

         self::$addressServer->createAddress($data);
        return back();
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
        $addressInfo = self::$addressServer->getAddressList($id);
        return view("home.address",['addressInfo'=>$addressInfo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //
        $value = $request->session()->all();
        $uid = $value['guid'];
        $addressInfo = self::$addressServer->getAddressList($uid);
        $aInfo=self::$addressServer->getAddressInfo($id);

        $region = explode("/",$aInfo['region']);
        return view("home.addrEdit",['aInfo'=>$aInfo,'addressInfo'=>$addressInfo]);

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
        $value = $request->session()->all();
        $uid = $value['guid'];
        $data = $request->all();
//        dd($data);
        $addressInfo = self::$addressServer->getAddressList($uid);
        self::$addressServer->updateAddress($id,$data);
        return view("home.address",['addressInfo'=>$addressInfo]);

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
        self::$addressServer->unlinkAddress($id);
        return back();

    }
}
