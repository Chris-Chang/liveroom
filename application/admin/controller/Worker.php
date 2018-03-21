<?php
namespace app\admin\controller;

use think\worker\Server;

class Worker extends Server
{
    protected $socket = 'text://0.0.0.0:2347';
    protected $processes = 1;
    public $global_uid = 0;
    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {
        foreach($this->worker->connections as $conn)
        {

            $conn->send("user[{$connection->uid}] said: $data");
        }
    }

    /**
     * 当客户端连接上来时分配uid, 并保存连接，并通知所有客户端
     * @param $connection
     */
    public function onConnect($connection)
    {
        global $global_uid;
        //为这个链接分配一个uid
         $connection->uid = ++$global_uid;
    }

    /**
     * 当连接断开时,广播给所有客户端
     * @param $connection
     */
    public function onClose($connection)
    {

        foreach ($this->worker->connections as $conn) {
            $conn->send("user[{$connection->uid}] logout");
        }
    }

    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }

    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker)
    {

    }
}