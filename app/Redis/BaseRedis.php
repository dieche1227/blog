<?php
/**
 * Created by PhpStorm.
 * User: wangt
 * Date: 2016/12/13
 * Time: 20:40
 */
namespace App\Redis;

use Illuminate\Support\Facades\Redis;

class BaseRedis
{
    /**
     * 设置单字符redis
     * @param $key
     * @param $val
     * @param int $time
     * $author 王通
     */
    public static function setRedis ($key, $val)
    {
        if (!empty($key) && !empty($val)) {
            return  Redis::set($key, $val);
        } else {
            return false;
        }

    }
    /**
     * 设置单字符redis 有超时时间
     * @param $key
     * @param $val
     * @param int $time
     * $author 王通
     */
    public static function setexRedis ($key, $val, $time)
    {
        if (!empty($key) && !empty($val)) {
            return Redis::setex($key, $time, $val);
        } else {
            return false;
        }

    }

    /**
     * 得到单字符redis
     * @param $key
     * @param $val
     * @param int $time
     * $author 王通
     */
    public static function getRedis ($key)
    {
        if (!empty($key)) {
            return Redis::get($key);
        } else {
            return false;
        }

    }

    /**
     * 得到列表的长度
     * @param $key
     * @return bool|int
     * @author 王通
     */
    public static function getLLen($key)
    {
        if (!empty($key)) {
            return Redis::lLen($key);
        } else {
            return false;
        }
    }

    /**
     * 通过索引获取指定列表键值
     * @param $key
     * @param $index
     * @return bool|String
     * @author 王通
     */
    public static function getListInIndex($key, $index)
    {
        //if (empty($key) || empty($index)) return false;
        return Redis::lIndex($key, $index);
    }

    public static function getHMGet($key, $val)
    {
        //if (empty($key) || empty($val)) return false;
        return Redis::hMGet($key, $val);
    }

    /**
     * 制定键累加，并且返回当前累加的值
     * @param $key
     * @return int
     * @author 王通
     */
    public static function incrRedis ($key)
    {
        return Redis::incr($key);
    }

    /**
     * 验证指定KEY是否存在
     * @param $key
     * @return bool
     * @author 王通
     */
    public static function existsRedis ($key)
    {
        return Redis::Exists($key);
    }

    /**
     * 设置超时时间
     * @param $key
     * @return bool
     * @author 王通
     */
    public static function expireRedis ($key, $time)
    {
        return Redis::Expire($key, $time);
    }

    /**
     * 添加集合
     * @param $key 集合的键值
     * @param $value  集合的值
     * @return mixed 返回0，表示失败，1表示成功
     * @author 王通
     */
    public static function addSet ($key, $value)
    {
        return Redis::Sadd($key, $value);
    }

    /**
     * // 检查指定IP今天有没有提意见
     * @param $key
     * @param $value
     * @return mixed
     * @author 王通
     */
    public static function checkSet ($key, $value)
    {
        return Redis::SISMEMBER($key, $value);
    }

    /**
     * 用哈希方式存储数据
     * @param $key
     * @param $hashKey
     * @param $value
     * @return mixed
     * @author 王通
     */
    public static function hSet($key, $hashKey, $value)
    {
        return Redis::hSet($key, $hashKey, $value);
    }

    /**
     * 删除哈希字段
     * @param $key
     * @param $hashKey1
     * @return mixed
     * @author 王通
     */
    public static function hDel($key, $hashKey1)
    {
        return Redis::hDel($key, $hashKey1);
    }

    /**
     * 得到指定redis集合的值
     * @param $key
     * @return mixed
     * @author 王通
     */
    public function selSet($key)
    {
        return Redis::SMEMBERS($key);
    }

    /**
     * 得到指定redis哈希的值
     * @param $key
     * @return mixed
     * @author 王通
     */
    public function selHGetAll($key)
    {
        return Redis::hGetAll($key);
    }

    /**
     * 删除指定的哈希字段
     * @param $key
     * @return mixed
     * @author 王通
     */
    public function delHash($key, $hashkey)
    {
        return Redis::hDel($key, $hashkey);
    }

    /**
     * 向列表中插入数据
     * @return int
     * @author 王通
     */
    public function addRpush($key, $value)
    {
        return Redis::rPush($key, $value);
    }

    /**
     * 得到指定区间列表数据
     * @param $key
     * @param $start
     * @param $end
     * @return mixed
     * @author 王通
     */
    public function selRpush($key, $start, $end)
    {
        return Redis::lRange($key, $start, $end);
    }

    /**
     * 得到指定数组的哈希列表
     * @param $key
     * @param $hashKeys
     * @return array
     * @author 王通
     */
    public function selHMGet($key, $hashKeys)
    {
        return Redis::hMGet($key, $hashKeys);
    }

    /**
     * 获取列表的长度
     * @param $key
     * @return mixed
     * @author 王通
     */
    public function getHLenCount($key)
    {
        return Redis::lLen($key);
    }

    /**
     * 移除列表元素
     * @param $key
     * @return mixed
     * @author 王通
     */
    public function delLRem($key, $value, $count)
    {
        return Redis::lRem($key, $value, $count);
    }

    /**
     * 管道操作
     * @param $key
     * @return mixed
     * @author 王通
     */
    public function delPipeline($keyArr, $indexFeedback, $dataFeedback)
    {
        $result = Redis::pipeline(function ($pipe) use ($keyArr, $indexFeedback, $dataFeedback){
            foreach ($keyArr as $key) {
                $pipe->hDel($dataFeedback, $key);
                $pipe->lRem($indexFeedback, 0, $key);
                $pipe->set('aaa','aaa');
            }

        });
        return $result;
    }
}