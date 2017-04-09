<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class IndexController extends Controller
{
    public function index(){
        $db = \DB::table("weixin_article");
       //判断并封装搜索条件
       $params = array();
       if(!empty($_GET['title'])){
           $db->where("title","like","%{$_GET['title']}%");
           $params['title'] = $_GET['title']; //维持搜索条件
       }

       if(!empty($_GET['catid'])){
           $db->where(['typeid'=>$_GET['catid']]);
           $params['catid'] = $_GET['catid']; //维持搜索条件
       }
    	$res = $db->orderby('id','desc')->paginate(2);
    	
        foreach ($res as $key => $value) {
    		$res[$key]->content=htmlspecialchars_decode($value->content);
    	}
    	//dd($res);
    	return view('index.index',['articles'=>$res,'params'=>$params]);
    }

    public function about(){
    	return view('index.about');
    }

    public function mobanzhuti(){
    	return view('index.mobanzhuti');
    }
}
