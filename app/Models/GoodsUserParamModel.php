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
class GoodsUserParamModel extends Model
{
    protected $table = 'rel_goods_user_joinparam';
    protected $dateFormat = 'U';//处理时间戳
    protected $guarded = [];//黑名单
   // protected $fillable = ['key', 'value'];//白名单
     protected $primaryKey="guid";
    public $incrementing=false;//设置非递增或者非数字的主键，需要加

}
