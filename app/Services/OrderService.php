<?php
/*
 * By ZhangXue
 */
namespace App\Services;

use App\Tools\Common;
use Illuminate\Support\Facades\Session;
use App\Repositories\OrderRepository as Order;

class OrderService
{
	private static $order= null;
	public function __construct(Order $order)
	{
		self::$order = $order;
	}

	/**
     *  添加一个订单
     *
     *
     */
	public function createOrder($data)
	{
        //生成唯一订单号
        $code = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $order_code = $code[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
        $data['guid'] = Common::getUuid();

        $param = [
            'guid' => $data['guid'],
            'uid' => $data['uid'],
            'user_addr_id' => $data['user_addr_id'],
            'number' => $order_code,
            'good_id' => $data['good_id'],
            'num' => $data['num'],
            'single_price' => $data['single_price'],
            'total_price' => $data['total_price'],
            'status' => 1, //下单未支付
            'is_deleted' => 1,
        ];
        $res = self::$order->createOrder($param);
        return $res;
	}
    /**
     *前台获取单个用户订单列表
     *
     *
     */
    public function getUserOrder($id)
    {
        if(empty($id)){
            return false;
        }
        $param = [
            'is_deleted' => 1
        ];
        $userOrder = self::$order->getUserOrder($id,$param);
//        dd($userOrder);
        return $userOrder;
    }

	/**
	 *后台获取订单列表
	 *
	 *
	 */
	public function getOrderList()
	{

		$orderList = self::$order->getOrderList();
        return $orderList;
	}

//	查询已删除的订单
    public function getDeletedOrder($id)
    {
        $param = [ "is_deleted" =>0 ];
        $recoveryOrder = self::$order->getDeletedOrder($id,$param);
        return $recoveryOrder;
    }
    //查询订单详情
    public function orderDetail($id)
    {
        $orderDetail = self::$order->orderDetail($id);
        return $orderDetail;
    }
    //恢复订单
    public function getRecoveryOrder($id)
    {
        $param = [
            'is_deleted' => 1,
        ];
        $res = self::$order->getRecoveryOrder($id,$param);
        return $res;
    }

    //确认收货
    public function upStatus($guid)
    {
        $param = ['status'=>3];
        $res = self::$order->upStatus($guid,$param);
        return $res;
    }

    //删除订单
	public function unlinkOrder($id)
	{
        if(empty($id)){
            return false;
        }
        $param = [
            'is_deleted' => 0,
        ];
        $res = self::$order->updateOrder($id,$param);
        return $res;
	}

	//发货
    public function updateStatus($id)
    {
        if(empty($id)){
            return false;
        }
        $param = [
            'status' => 2,
        ];
        $res = self::$order->updateOrder($id,$param);
        return $res;
    }
}