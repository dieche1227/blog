<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class InitController extends Controller
{
    
	public $loginUid = 123232322232;


    public function __construct()
    {
    	// $navcats = \DB::table('weixin_type')->get();
    	// View::share('navcats',$navcats);
    	parent::__construct();
    	
    	$CurrentControllerName = $this->getCurrentControllerName();
    	View::share('CurrentControllerName',$CurrentControllerName);
    	$CurrentMethodName = $this->getCurrentMethodName();
    	View::share('CurrentMethodName',$CurrentMethodName);
    	//判断用户是否登录

    }

    public function getCurrentAction()
    {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);
        $class = substr(strrchr($class,'\\'),1);

        return ['controller' => $class, 'method' => $method];
    }

    public function getCurrentControllerName()
    {
        return $this->getCurrentAction()['controller'];
    }
    
    public function getCurrentMethodName()
    {
        return $this->getCurrentAction()['method'];
    }
   
}
