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
    public function create($param){
        $data['user_id'] = '123131231';
        $data['goods_guid'] = $param['goods_guid'];
        $data['city'] = $param['city'];
        $data['procurement_cycle'] = $param['shuliang'].$param['danwei'].$param['zhouqi'];
        $data['province'] = $param['province'];
        $res = $this->goodsUserModel->create($data);
        return $res;
    }
   
    // 给商品删除参数和user
    public function delUser(){



    }



}