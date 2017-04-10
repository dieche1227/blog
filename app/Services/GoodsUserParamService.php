<?php
/**
 * Created by dmy
 */
namespace App\Services;

use App\Models\GoodsUserParamModel;
use App\Tools\Common;

class GoodsUserParamService
{
    protected $goodsUserParamModel;
    
    public function __construct(GoodsUserParamModel $goodsUserParamModel)
    {
        $this->goodsUserParamModel = $goodsUserParamModel;
    }

    //  其他用户有需求时需要给商品添加参数
    public function create($params){
    	$params['guid'] = Common::getUuid();
        $res = $this->goodsUserParamModel->create($params);
        return $res;
    }
}