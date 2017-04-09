<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ArticleController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $db = \DB::table("weixin_article")->orderby('id','desc');  
       $list = $db->paginate(2); //5条每页浏览
       //遍历当前数据并添加商品类别名称
        //判断并封装搜索条件
       $params = array();
       if(!empty($_GET['title'])){
           $db->where("title","like","%{$_GET['title']}%");
           $params['title'] = $_GET['title']; //维持搜索条件
       }
       foreach($list as $k => $v){
            $name = \DB::table("weixin_type")->where("id",$v->typeid)->value("name");
            $v->typename = $name; //放置进去
            $list[$k]->content = htmlspecialchars_decode($v->content); //放置进去
       } 
       return view("admin.article.index",['list'=>$list,'params'=>$params]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res = \DB::table("weixin_type")->get();

        return view('admin.article.add',['cats'=>$res]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->input('title');
        $content = trim($request->input('content'));
        $typeid = $request->input('typeid');
        $fengmian = $request->input('fengmian');
        
        $content = htmlspecialchars($content);


       
            //insert
            $res = DB::table('weixin_article')->insertGetId(['content'=>$content,
                         'title'=>$title,
                         'typeid'=>$typeid,
                         'fengmian'=>$fengmian,
                         'createtime'=>time()
                         ]);
       
        

        if($res){
            return response(json_encode(['status'=>true]));
        }else{
            return response(json_encode(['status'=>false]));
        }
        
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
        $cats = \DB::table("weixin_type")->get();

        $info = DB::table('weixin_article')
                ->where(['id'=>$id])->first();
        return view('admin.article.edit',['info'=>$info,'cats'=>$cats]);
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
        //update
        $title = $request->input('title');
        $content = trim($request->input('content'));
        $typeid = $request->input('typeid');
        $fengmian = $request->input('fengmian');
        $content = htmlspecialchars($content);

        $res = DB::table('weixin_article')
                ->where(['id'=>$id])
                ->update(['content'=>$content,
                     'title'=>$title,
                     'typeid'=>$typeid,
                     'fengmian'=>$fengmian,
                     'createtime'=>time()
                     ]);
        
        if($res){
            return response(json_encode(['status'=>true]));
        }else{
            return response(json_encode(['status'=>false]));
        }        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         \DB::table('weixin_article')->delete($id);
        return redirect("admin/article");
    }
}
