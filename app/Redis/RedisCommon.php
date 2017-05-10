<?php

namespace App\Redis;

class RedisCommon
{
    protected $list_key;
    protected $hash_key;
    protected $server;

    public function __construct($list, $hash, $server)
    {
        $this->list_key = $list;
        $this->hash_key = $hash;
        $this->server = $server;
    }

    /**
     * @param $data
     * @param $index
     */
    public function insert($data, $index)
    {
        \Redis::rPush($this->list_key, $index);
        \Redis::hmset($this->hash_key, $data);
    }

    public function getSingleData($index, $function, $param = [])
    {
        $list = \Redis::lrange($this->list_key, 0, -1);
        if (!empty($list)) {
            if (in_array($index, $list)) {
                $data = \Redis::hGetAll($this->hash_key);
                return $data;
            } else {
                $data = $this->server->$function($param);
                if (empty($data)) {
                    return false;
                }
                $this->insert($data,$index);
                return $data;
            }
        }
        $data = $this->server->$function($param);
        if (empty($data)) {
            return false;
        }
        $this->insert($data,$index);
        return $data;
    }

    public function getAllRedis($function, $param = [])
    {


        $list = \Redis::lrange($this->list_key, 0, -1);
        //dd(!empty($list));
        if (!empty($list)) {
            $data = collect($list)->reduce(function($data,$list){
                $data[] = \Redis::hGetAll($this->hash_key . $list);

                return $data;
            }, []);
             //dd($data);
            return $data;
        }
        $data = $this->server->$function($param);
        //dd($data);
        if (empty($data)) {
            return false;
        }
        $hash_key = $this->hash_key;
       // dd($data);
        foreach ($data as $key => $value) {
            $this->hash_key = $this->hash_key . $key;
            $this->insert($value, $key);
            $this->hash_key = $hash_key;
        }
        return $data;
    }

    //获取商品分页数据

    public function getPageRedis($function, $param = [])
    {
        $perPage = isset($param['perPage'])?:$param['perPage']:16; 
        
        $currentPage = $param['currentPage'];

        $list = \Redis::lrange($this->list_key, 0, -1);
        //dd(!empty($list));
        if (!empty($list)) {
            $data = collect($list)->reduce(function($data,$list){
                $data[] = \Redis::hGetAll($this->hash_key . $list);

                return $data;
            }, []);
             //dd($data);
            return $data;
        }
        $data = $this->server->$function($param);
        //dd($data);
        if (empty($data)) {
            return false;
        }
        $hash_key = $this->hash_key;
       // dd($data);
        foreach ($data as $key => $value) {
            $this->hash_key = $this->hash_key . $key;
            $this->insert($value, $key);
            $this->hash_key = $hash_key;
        }
        return $data;
    }


    public function updateRedis($data)
    {
        return \Redis::hMset($this->hash_key, $data);
    }

    public function deleteRedis($index)
    {
        \Redis::lRem($this->list_key,$index);
        \Redis::hDel($this->hash_key);
    }

    public function getHashData($redis_key, $function, $key, $val ,$param = [])
    {
        $data = \Redis::hGetall($redis_key);
        if (empty($data)) {
            $res = $this->server->$function($param);
            $hash_data = collect($res)->reduce(function($hash_data, $value) use ($key, $val) {
                $hash_data[$value[$key]] = $value[$val];
                return $hash_data;
            }, []);
            \Redis::hmset($redis_key, $hash_data);
            return $hash_data;
        }
        return $data;
    }

}