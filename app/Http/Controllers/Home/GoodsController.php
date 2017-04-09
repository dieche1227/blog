<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GoodsService;
use App\Services\AreaService;
use App\Services\UnitService;
use App\RedisStore\RedisCommon;
use App\Tools\Common;

class GoodsController extends InitController
{
    
    protected $goodsService;
    protected $areaService;
    protected $unitService;

    public function __construct(GoodsService $goodsService, AreaService $areaService, UnitService $unitService)
    {

        $this->goodsService = $goodsService;
        $this->areaService = $areaService;
        $this->unitService = $unitService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd(111);
        //1. 分页页数
        $input = $request->all();
        if (empty($input['page']) || (int)$input['page'] < 1)
        {
            $page = 1;
        } else {
            $page = $input['page'];
        }
        // $redisCommon = new RedisCommon('LIST:GOODS:LIST','HASH:GOODS:INFO',$this->goodsService);

        // $data = $redisCommon->getAllRedis('getGoodsList',['page'=> ]);

       $goods = $this->goodsService->getGoodsList();
         //dd($data);
       
        $pageHtml = \App\Tools\CustomPage::page($goods['total'], $goods['current_page'], $pnum = 1, $pagenum = 5, '/goods?', $pagename = 'page',$anchor = '');


        
         return view('home.goods.index', compact('goods', 'pageHtml'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //查询当前用户是否有未发布的商品
        $loginUid = $this->loginUid; 
        $goodsInfo = $this->goodsService->getInfo(['publish_uid' => $loginUid,
                                        'is_published' => 0,
                                    ]);
        if( !$goodsInfo )
        {
           $guid = Common::getUuid(); 
           $param = ['guid' => $guid,
                    'publish_uid' => $loginUid,
                    ];
            $res = $this->goodsService->create($param);
            $goodsInfo['guid'] = $res->guid;
        } else {
          
        }
       
        $provinces = $this->areaService->getProvinces();

        $units = $this->unitService->getUnits();
        
        // return view('home.goods.create',['provinces'=>$provinces,
        //                                  'units'=>$units,
        //                                  'goodsuid'=>$goodsuid,
        //                                 ]);
        return view('home.goods.create', compact('provinces', 'units', 'goodsInfo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        


       // $res = $this->goodsService->createGood($param);
       // if ($res) {

       // }
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
