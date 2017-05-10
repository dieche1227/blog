<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GoodsService;
use App\Services\AreaService;
use App\Services\UnitService;
use App\Services\GoodsUserService;
use App\Services\GoodsImgService;
use App\Redis\RedisCommon;
use App\Tools\Common;

class GoodsController extends InitController
{
    
    protected $goodsService;
    protected $areaService;
    protected $unitService;
    protected $goodsUserService;
    protected $goodsImgService;

    public function __construct(GoodsService $goodsService, AreaService $areaService, UnitService $unitService, goodsUserService $goodsUserService, GoodsImgService $goodsImgService)
    {

        $this->goodsService = $goodsService;
        $this->areaService = $areaService;
        $this->unitService = $unitService;
        $this->goodsUserService = $goodsUserService;
        $this->goodsImgService = $goodsImgService;
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

        $page=2;

        $redisCommon = new RedisCommon('LIST:GOODS:LIST','HASH:GOODS:INFO',$this->goodsService);
        $data = $redisCommon->getAllRedis('getGoodsList',[]);

        dd($data);

        $goods = $this->goodsService->getGoodsList();

     
        foreach ($goods['data'] as $key => $value) {
            $goods['data'][$key]['faceImg'] =  $this->goodsImgService->getGoodsFace($value['guid']);   
        }
     

        // $pageHtml = \App\Tools\CustomPage::page($goods['total'], $goods['current_page'], $pnum = 1, $pagenum = 5, '/goods?', $pagename = 'page',$anchor = '');

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
        //var_dump($request->input());
        $param = $request->input();
        $param['is_published'] = 1;
        $guid = $request->input('goods_guid');
        $res1 = $this->goodsService->update($param, $guid);
        //$res2 = $this->goodsUserService->create($param);
        if ($res1) {
            return ['status'=>true,
                    'msg'=>'商品添加成功'];
        } else {
            return ['status'=>false,
                    'msg'=>'商品添加失败'];
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
        $goodsInfo = $this->goodsService->getInfo(['guid'=>$id])->toArray();
        $goodsImgs = $this->goodsImgService->getGoodsImgs($id);
        return view('home.goods.show', compact('goodsInfo', 'goodsImgs'));
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
        $file_path = "1.txt";
        if (file_exists($file_path)) 
        {
            $str = file_get_contents($file_path);//将整个文件内容读入到一个字符串中
            $str = str_replace("\r\n","<br />",$str);
            //echo $str;
        }
        $tmpArray = explode('----------------',$str);
        foreach ($tmpArray as $key => $value) {
            preg_match_all("|[\x{4e00}-\x{9fa5}]+[0-9]{4}|u",
            $value,
            $out, PREG_PATTERN_ORDER);
           $res[] = $out;
        }
        //dd($res);

        foreach ($res as $key => $value) {
            foreach ($value as $k => $v) {
                foreach ($v as $k1 => $v1) {
                    \DB::table('data_category')->insert(array('name' => $v1));
                }
                
                   
               
            }
        }
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
