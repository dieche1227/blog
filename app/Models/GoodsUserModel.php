<?php
/**
 * Created by cyx
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * 返回商品参数信息
 *
 */
class GoodsUserModel extends Model
{
    protected $table = 'rel_goods_user';
    protected $dateFormat = 'U';
    protected $guarded = ['id'];
}
