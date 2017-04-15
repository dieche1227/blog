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
   

   // 给商品删除参数
    public function delete($guid){
        //$params['guid'] = Common::getUuid();
        //dd($params);
        $res = $this->goodsParamModel->where(['guid'=>$guid])->update(['is_deleted'=>1]);
        return $res;
    }
    

}