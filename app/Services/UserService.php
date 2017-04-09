<?php
namespace App\Services;

use App\Tools\Common;
use Illuminate\Support\Facades\Session;
use App\Models\UserModel;

class UserService
{
    private static $userModel;
   
    public function __construct(UserModel $userModel)
    {
        self::$userModel = $userModel;
    }

    /**
     * 获取用户信息
     *
     * @param $data
     * @return mixed
     */
    public function getUserInfo($param)
    {
       $userInfo =  self::$userModel->where($param)->first();
       return $userInfo;
    }

    /**
     * 创建用户
     * @param $data
     * @return Session|mixed
     */
    public function createUser($param)
    {   unset($param['path']);
        unset($param['_token']);
        unset($param['verify']);
        unset($param['msgcode']);
        // var_dump($param);die;
        $param['guid'] = Common::getUuid(); 
        $param['salt'] = $salt = Common::random(6);#生成随机串
        $param['password'] = md5(md5($param['password']).$salt);#

        $res = self::$userModel->create($param);
        if($res) {
            return $param['guid'];
        }else{
            return false;
        }
    }

    /**
     * 获取所有未删除状态用户信息
     *
     */
    public function getAllUserInfo()
    {
        $userdata=self::$user->findAllBy('is_deleted',2);
        return $userdata;
    }
    /**
     * 根据guid获取用户信息
     * @param  $guid
     * @return object
     */
    public function getSingleUserInfo($guid)
    {
        $singleUserInfo = self::$user->findBy('guid',$guid);
        return $singleUserInfo;
    }

    /**
     * 更改用户的状态
     * @param $guid $state
     *
     */
    public function changeUserState($guid,$request)
    {
        $userstate = $request->input('state');
        $userdata = array("state"=>$userstate);
        return self::$user->update($userdata,$guid,'guid');
    }

    /**
     * 标记用户为删除状态
     * @param $guid $userdata
     */
    public function doUserDel($guid)
    {
        $userdata = array("is_deleted" => 1);
        return self::$user->update($userdata,$guid,'guid');
    }

    /**
     * 用户登录验证
     * @param $userdata
     * @return bool
     */
    public function doLogin($userdata)
    {
        $status = false;
        $userlist = self::getAllUserInfo();
        foreach ($userlist as $user) {
            if($user->cellphone == $userdata['phone'] && $user->password == md5(md5($userdata['password']))){
                $status = true;
                $guid = $user->guid;
            }
        }
        if($status == true){
            return $guid;
        }else{
            return false;
        }
    }

    /**
     * 更新用户信息
     * @param $userdata
     * @param $guid
     * @return mixed
     */
    public function updateUserInfo($userdata,$guid)
    {
        $data=array('name'=>$userdata['name'],
                    'email'=>$userdata['email'],
                    'cellphone'=>$userdata['cellphone'],
                    'gender'=>$userdata['sex'],
                    'birthday'=>$userdata['birthday']);
        return self::$user->update($data,$guid,'guid');
    }

    /**
     * 获取一页显示的用户数据
     * @param $page
     * @return mixed
     *
     */
    public function getUsersOfOnePage($page){
        //统计所有用户数量
        $max = self::$user->getUserCount();
        $pageNum = 5;
        $response['max'] = $max;
        $response['pageMax'] = (int)ceil($max / $pageNum);
        //获取分页数据
        if ($page * $pageNum > $max) {
            $response['page'] = (int)ceil($max / $pageNum);
        } else {
            $response['page'] = (int)$page;
        }
        $offset = ($page -1) * $pageNum;
        $data = self::$user->getUserList($offset, $pageNum);
        $response['data'] = $data;
        return $response;
    }


     /**
     * 检测用户是否存在
     * @param $cellphone
     * @return bool
     *
     */
    public function checkIfExist($param){
        $res =  self::$userModel->where($param)->first();
        if($res){
            return true;
        }else{
            return false;
            
        }
    }


     /**
     * 修改用户密码
     * @param $cellphone
     * @return bool
     *
     */
    public function changePassword($cellphone,$newpassword){
        $res =  self::$user->changePassword($cellphone,$newpassword);
        if($res){
            return true;
        }else{
            return false;
            
        }
    }




    
}