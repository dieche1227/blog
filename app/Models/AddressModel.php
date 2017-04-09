<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
    protected $table = 'rel_user_addr';
    protected $dataFormat = 'U';
    protected $guarded = ['id'];
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey="guid";
}
