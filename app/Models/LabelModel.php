<?php
/**
 * Created by WangKai
 * User: WangKai
 * Date: 16/12/08
 * Time: 14:10
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class LabelModel extends Model
{
    public $timestamps = false;

    protected $table = 'data_label';
    protected $dateFormat = 'U';
    protected $guarded = ['id'];
}