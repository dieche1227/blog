<?php
/**
 * Created by WangKai
 * User: WangKai
 * Date: 16/12/06
 * Time: 10:40
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    protected $table = 'data_admin';
    protected $dateFormat = 'U';
    protected $guarded = ['id'];
}