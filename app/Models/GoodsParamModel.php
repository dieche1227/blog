<?php
/**
 * Created by cyx
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * 返回商品相关联的照片的信息
 *
 */
class GoodsParamModel extends Model
{
    protected $table = 'rel_goods_param';
    protected $dateFormat = 'U';//处理时间戳
    protected $guarded = [];//黑名单
   // protected $fillable = ['key', 'value'];//白名单
}
