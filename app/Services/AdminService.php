<?php
/**
 * Created by WangKai
 * User: WangKai
 * Date: 16/12/06
 * Time: 10:36
 */

namespace App\Services;

use App\Repositories\AdminRepository as Admin;

class AdminService
{
    private static $admin;
    public function __construct(Admin $admin)
    {
        self::$admin = $admin;
    }
    /**
     * 获取管理员信息
     *
     */
    public function getAdmin()
    {
        $adminInfo = self::$admin->getAdminInfo();
        return $adminInfo;
    }
    /**
     * 验证管理员登录
     *
     */
    public function doLogin($data)
    {
        //使用标识符
        $status = false;
        //获取管理员信息
        $adminInfo = self::$admin->getAdminInfo();
        //遍历数据库中的admin信息
        foreach($adminInfo as $adminlist)
        {
            //当输入的管理员信息与数据库中匹配时，标识符为true
            if($data['name'] == $adminlist->adminname && md5(md5($data['password'])) == $adminlist->password){
                $status = true ;
            }
        }
        //判断标识符，返回是否登录成功
        if($status){
            return true;
        }else{
            return false;
        }

    }
}