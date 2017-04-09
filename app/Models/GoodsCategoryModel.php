<?php
/**
 * Created by cyx
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * 返回商品类别信息
 *
 */
class GoodsCategoryModel extends Model
{
    protected $table = 'data_goods_category';
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

    public function goods()
    {
        //一对多
        return $this->hasmany('App\Models\GoodsModel',"class_id","id");
    }
}
