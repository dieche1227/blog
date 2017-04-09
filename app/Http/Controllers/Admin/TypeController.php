<?php
//信息分类控制器
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$db = \DB::table("type");
        //$list = $db->get(); //获取全

        $list = \DB::select("select * from weixin_type order by concat(path,id) asc");
        
        //处理信息
        foreach($list as &$v){
            $m = substr_count($v->path,","); //获取path中的逗号
            //生成缩进
            $v->name = str_repeat("&nbsp;",($m-1)*8)."|--".$v->name;
        }
        
        return view("admin.type.index",['list'=>$list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = \DB::select("select * from weixin_type order by concat(path,id) asc");
        
        //处理信息
        foreach($list as &$v){
            $m = substr_count($v->path,","); //获取path中的逗号
            //生成缩进
            $v->name = str_repeat("&nbsp;",($m-1)*8)."|--".$v->name;
        }
        return view("admin.type.create",['list'=>$list]);
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
        $data = $request->only("name",'pid');
        $pid = $data['pid'];
        if($pid==0){
            $data['path']="0,";
        }else{
            $type = \DB::table("weixin_type")->where("id",$pid)->first();
            $data['path'] = $type->path.$pid.",";
        }
        
        //执行添加
        $id = \DB::table("weixin_type")->insertGetId($data);
        //判断
        if($id>0){
            $info = "类别信息添加成功！";
        }else{
            $info = "类别信息添加失败！";
        }
        
        return redirect("admin/type")->with("err",$info);
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
        $info = \DB::table("weixin_type")->where(['id'=>$id])->first();

        $list = \DB::select("select * from weixin_type order by concat(path,id) asc");
        //处理信息
        foreach($list as &$v){
            $m = substr_count($v->path,","); //获取path中的逗号
            //生成缩进
            $v->name = str_repeat("&nbsp;",($m-1)*8)."|--".$v->name;
        }
        return view("admin.type.edit",['list'=>$list,'info'=>$info]);
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
        $name = $request->input('name');

        $res = \DB::table('weixin_type')
                ->where(['id'=>$id])
                ->update(['name'=>$name,
                     ]);
        
        //判断
        if($res>0){
            $info = "类别信息edit成功！";
        }else{
            $info = "类别信息edit失败！";
        }
        
        return redirect("admin/type")->with("err",$info); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //先判断当前类别下是否存在子类别
        $m = \DB::table('weixin_type')->where('pid',$id)->count();
        if($m>0){
            return back()->with("err","禁止删除");
        }  
      
        \DB::table('weixin_type')->delete($id);
        return redirect("admin/type")->with("err","删除成功！");
    }
}
