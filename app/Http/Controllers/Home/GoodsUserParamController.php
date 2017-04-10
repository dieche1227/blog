<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GoodsUserParamService;

class GoodsUserParamController extends Controller
{
   
    protected $goodsUserParamService;
    public function __construct(GoodsUserParamService $goodsUserParamService)
    {
        $this->goodsUserParamService = $goodsUserParamService;
    }
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
        //dd($request->input());

        $requestData = $request->input();
        $data['goods_guid'] = $requestData['goodsuid'];
        unset($requestData['goodsuid']);

        $i = 0 ;
        foreach ($requestData as $key => $value) 
        {
            switch ($i%5) {
                case 0:
                    $data['is_must'] = $value;
                    $i++;
                    break;
                case 1:
                    $data['input_param_name'] = $value;
                    $i++;
                    break;
                case 2:
                    $data['input_type'] = $value;
                    $i++;
                    break;
                case 3:
                    $data['tip'] = $value;
                    $i++;
                    break;
                case 4:
                    if ($value !== null)
                    {
                        $data['input_param_param'] = json_encode($value);
                    } else {
                        $data['input_param_param'] = '';
                    }
                    $i++;
                    $res = $this->goodsUserParamService->create($data);
                    //dd($res);
                    break;
                default:
                    # code...
                    break;
            }
        }
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
