<?php
/**
 * Created by JINX.
 * User: Xxh
 * Date: 2016/12/8
 * Time: 14:49
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PipelineModel extends Model
{
    protected $table = 'data_fund_pipeline';
    protected $dateFormat = 'U';
    protected $guarded = ['id'];
    public $timestamps = false;  //自动维护时间戳
    protected $casts = [       //指定类型
        'time' =>'integer',
        "total_fund" => 'integer',
        'money' => 'integer',
        'status' => 'integer',
        'details' => 'varchar',

    ];
}
