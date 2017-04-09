<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class JiaQunController extends Controller
{
	private $loginUid;


    public function doJia(Request $request){
    	//$insertData = $request->except('_token');
    	$tmp = session()->get('user');
    	$this->loginUid = $tmp->id;
    	$qid = $request->input('qid');
    	$varr =  $request->input('shenqingvalue');
    	$karr =  $request->input('shenqingkey');
    	foreach ($varr as $key => $value) {
    		$tmparr[$karr[$key]] = $value;
    	}
    	
    	$jsonFormData = json_encode($tmparr);
    	$insertData['joinFormJson'] = $jsonFormData;
    	$insertData['qid'] = $qid;
    	$insertData['uid'] = $this->loginUid;

    	$res = DB::table('weixin_jiaqun')->insertGetId($insertData);


    	if($res){
    		return response(json_encode(['status'=>true,'msg'=>'add success']));	
    	}else{
    		return response(json_encode(['status'=>false,'msg'=>'add failure']));
    	}
    }


}
