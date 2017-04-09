<?php
/**
 * Created by cyx
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate;
/**
 * 返回所有商品
 *
 */
class GoodsModel extends Model
{
    protected $table = 'data_goods';
    protected $dateFormat = 'U';
    protected $guarded = [];
    protected $primaryKey="guid";
    public $incrementing=false;//设置非递增或者非数字的主键，需要加


    public function getGoodsList($param=[])
    {

       return  $this->where($param)->paginate(10);

    }
}
