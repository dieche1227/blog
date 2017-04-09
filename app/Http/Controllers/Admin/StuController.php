<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class StuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $db = \DB::table("stu");
       
       //判断并封装搜索条件
       $params = array();
       if(!empty($_GET['name'])){
           $db->where("name","like","%{$_GET['name']}%");
           $params['name'] = $_GET['name']; //维持搜索条件
       }
       
       // $list = $db->get(); //获取全部
       $list = $db->orderBy("id",'desc')->paginate(5); //5条每页浏览
        
       return view("admin.stu.index",['list'=>$list,'params'=>$params]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.stu.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //获取要添加的数据
        $data = $request->only("name",'sex','age','classid');
        //执行添加
        $id = \DB::table("stu")->insertGetId($data);
        //判断
        if($id>0){
            $info = "学生信息添加成功！";
        }else{
            $info = "学生信息添加失败！";
        }
        
        //return view("admin.stu.info",['info'=>$info]);
        return redirect("admin/stu")->with("err",$info);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table('stu')->delete($id);
        return redirect("admin/stu");
    }
    
    //测试自定义的Model类
    public function demo()
    {
       $list = \App\Models\Stu::all();
        
       dd($list);
    }
}
