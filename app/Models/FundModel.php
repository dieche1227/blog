<?php
/**
 * Created by JINX.
 * User: Xxh
 * Date: 2016/12/5
 * Time: 14:49
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class FundModel extends Model
{
    protected $table = 'data_fund';
    protected $dateFormat = 'U';
    protected $guarded = ['id'];
   // public $timestamps = false;  //自动维护时间戳
    protected $casts = [       //指定类型
        "create_at" => 'integer',
        "updated_at"=>'integer',
        "is_in" => 'integer',
        'fund_in' => 'float',
        'fund_out' => 'float',
        'total_fund' => 'float',

    ];
}