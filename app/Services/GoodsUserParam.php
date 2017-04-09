<?php
/**
 * Created by dmy
 */
namespace App\Services;

use App\Models\GoodsParamModel;
use App\Tools\Common;

class GoodsUserParamService
{

    protected $goodsUserParamModel;

    
    public function __construct(GoodsUserParamModel $goodsUserParamModel)
    {
        $this->goodsUserParamModel = $goodsUserParamModel;
    }

    // 给商品添加参数
    public function create($params){
    	//$params['guid'] = Common::getUuid();
    	//dd($params);
        $res = $this->goodsUserParamModel->create($params);
        return $res;
    }
}