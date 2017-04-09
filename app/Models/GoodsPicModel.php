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
class GoodsPicModel extends Model
{
    protected $table = 'rel_good_pic';
    protected $dateFormat = 'U';
    protected $guarded = ['guid'];
}
