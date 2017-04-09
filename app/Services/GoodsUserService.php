<?php
/**
 * Created by dmy
 */
namespace App\Services;

use App\Models\GoodsUserModel;

class GoodsUserService
{

    protected $goodsUserModel;

    
    public function __construct(GoodsUserModel $goodsUserModel)
    {
        $this->goodsUserModel = $goodsUserModel;
    }

    // 给商品添加参数和user
    public function addUser($userid, $params){
        $res = $this->goodsUserModel->create($params);
    }
   
    // 给商品删除参数和user
    public function delUser(){



    }



}