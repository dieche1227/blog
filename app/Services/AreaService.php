<?php
/**
 * Created by dmy
 */
namespace App\Services;

use App\Models\AreaModel;

class AreaService
{

    protected $areaModel;

    
    public function __construct(AreaModel $areaModel)
    {
        $this->areaModel = $areaModel;
    }

    //获取所有省份
    public function getProvinces()
    {     
        $city = $this->areaModel->where(['upid'=>0])->get();
        $html = '';
        foreach ($city as $k => $v) {
            $html .='<li><a href="javascript:;" rel="'.$v['id'].'" class="procit">'.$v['name'].'</a></li>';
        }
        return $html;
    }

     //获取某省份的所有城市
    public function getCities($id)
    {
        $city = $this->areaModel->where(array('upid'=>$id))->get();
        $html = '';
        foreach ($city as $k => $v) {
            $html .='<li><a href="javascript:;">'.$v['name'].'</a></li>';
        }
        return $html;
    }
   



}