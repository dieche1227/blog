<?php
/**
 * Created by cyx
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * 返回商品相关联的照片的信息
 *
 */
class GoodsImgModel extends Model
{
	 use SoftDeletes;

    /**
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    protected $table = 'data_goods_img';
    protected $dateFormat = 'U';//处理时间戳
    protected $guarded = [];//黑名单
   // protected $fillable = ['key', 'value'];//白名单
    public $incrementing = false;
    protected $primaryKey="guid";
}
