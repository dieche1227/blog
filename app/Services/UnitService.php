<?php
/**
 * Created by dmy
 */
namespace App\Services;

use App\Models\UnitModel;

class UnitService
{

	protected $unitModel;

    public function __construct(UnitModel $unitModel)
    {
        $this->unitModel = $unitModel;
    }


    //返回所有的单位unit
    public  function getUnits()
    {                                       
        $tmp = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N',
                'O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        foreach ($tmp as $key => $value) 
        {
            $res = $this->unitModel->where(['index'=>$value])->get()->toArray();
           
            if ($res) 
            {
              $jiliangs[$value]=$res;
            }
        } 
       return $jiliangs;
    }

}