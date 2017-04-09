<?php
/**
 * Created by dmy
 */
namespace App\Services;

use App\Models\GoodsParamModel;
use App\Tools\Common;

class GoodsParamService
{

    protected $goodsParamModel;

    
    public function __construct(GoodsParamModel $goodsParamModel)
    {
        $this->goodsParamModel = $goodsParamModel;
    }

    // 给商品添加参数
    public function create($params){
    	$params['guid'] = Common::getUuid();
    	//dd($params);
        $res = $this->goodsParamModel->create($params);
        return $res;
    }
   
    

}