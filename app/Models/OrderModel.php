<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    //
    protected $table = 'data_order';
    protected $dataFormat = 'U';
    protected $guarded = ['id'];
     public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey="guid";
}
