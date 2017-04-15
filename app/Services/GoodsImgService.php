<?php
/**
 * Created by dmy
 */
namespace App\Services;

use App\Models\GoodsImgModel;
use App\Tools\Common;

class GoodsImgService
{
    protected $GoodsImgModel;
    public function __construct(GoodsImgModel $goodsImgModel)
    {
        $this->goodsImgModel = $goodsImgModel;
    }

    // 给商品添加图片
    public function create($params){
    	$params['guid'] = Common::getUuid();
        $res = $this->goodsImgModel->create($params);
        return $res;
    }
   

   // 给商品删除图片
    public function delete($path){
        $res = $this->goodsImgModel->where(['path'=>$path])->delete();
        return $res;
    }
    

}