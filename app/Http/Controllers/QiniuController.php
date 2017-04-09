<?php
namespace App\Http\Controllers;

use App\Services\QiniuService;


class QiniuController extends Controller
{
        //获token
    public function index()
    {
        $token = QiniuService::returnToken();

        return response()->json(['uptoken'=>$token]);
    }
   

}
