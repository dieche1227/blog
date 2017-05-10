<?php
/**
 * Created by dmy
 */
namespace App\Services;

use App\Models\GoodsImgModel;
use App\Tools\Common;
use DB;

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

    // 给商品图片排寻
    public function sortImg($str){
        $arr = explode(',', $str);
        DB::beginTransaction();
        try {
           foreach ($arr as $key => $value) {
             $this->goodsImgModel->where(['path'=>$value])->update(['order_by'=>$key]);
            }
            DB::commit();
             //插入成功 redis缓存用户数据
            //缓存hash
            return ['status'=>true,
                    'msg' => '操作成功',
                    ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                    'status'=>false,
                    'msg'=>'操作失败',
                    'ResultData'=>['error' => $e->getMessage()]
                    ];
        }
    }
    
    // 给商品图片排寻
    public function getGoodsImgs($guid){
       //根据gui获取商品图片
        $res =  $this->goodsImgModel->where(['goods_guid'=>$guid])->get();
        return $res;
    }

     //  取出商品的封面图（第一张图）
    public function getGoodsFace($guid){
       //根据gui获取商品图片
        $res =  $this->goodsImgModel->where(['goods_guid'=>$guid])->orderBy('order_by','desc')->first(['path']);
     
        if ($res)
        {
            $data = 'http://img.maixiangtong.com/'.$res->path;
        } else {
            $data ='http://img.maixiangtong.com/o_1be73dgvf17nj1c3q1j2h124318h5a.jpg';
        }
        return $data;
    }

}