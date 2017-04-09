<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function picUpload(Request $request)
    {
    	//判断是否有上传
        if($request->hasFile("file")){
            //获取上传信息
            $file = $request->file("file");
            //确认上传的文件是否成功
            if($file->isValid()){
                //$picname = $file->getClientOriginalName(); //获取上传原文件名
                $ext = $file->getClientOriginalExtension(); //获取上传文件名的后缀名
                //执行移动上传文件
                $filename = time().rand(1000,9999).".".$ext;
                $file->move("./uploads/",$filename);   
                $res['src'] =asset('uploads/'.$filename);
                return response(json_encode($res)); //输出
            }
   		}
    }
    public function fengmiansave(Request $request)
    {
        //判断是否有上传
        if($request->hasFile("file")){
            //获取上传信息
            $file = $request->file("file");
            //确认上传的文件是否成功
            if($file->isValid()){
                //$picname = $file->getClientOriginalName(); //获取上传原文件名
                $ext = $file->getClientOriginalExtension(); //获取上传文件名的后缀名
                //执行移动上传文件
                $filename = time().rand(1000,9999).".".$ext;
                $file->move("./uploads/",$filename);   
                $res['src'] =asset('uploads/'.$filename);
                $res['status'] = true;
                return response(json_encode($res)); //输出
            }
        }

    }

}
