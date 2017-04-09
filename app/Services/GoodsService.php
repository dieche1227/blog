<?php
/**
 * Created by cyx
 */
namespace App\Services;

use App\Tools\Image;
use App\Tools\Common;
use App\Models\GoodsModel;

class GoodsService
{

    protected $goodsModel;

    
    public function __construct(GoodsModel $GoodsModel)
    {
        $this->goodsModel = $GoodsModel;

    }

    /**
     *获取商品基本参数详情(针对商品表里面没有的参数信息的补充)
     *
     * @param $id
     * @return bool
     */
    public function getInfo($param)
    {
        if (empty($param)) return false;
        $goodsInfo = $this->goodsModel->where($param)->first();
        return $goodsInfo;
    }



     /**
     *获取商品列表
     *
     */
    public function getGoodsList($param=[])
    {
       $goodsList = $this->goodsModel->getGoodsList($param)->toArray();
       return $goodsList;
    }


   /**
     * 创建商品信息
     *
     */
    public function create($param)
    {
        $result = $this->goodsModel->create($param);
        return $result;
    }



}