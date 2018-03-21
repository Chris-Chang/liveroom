<?php

namespace app\index\controller;

use GatewayClient\Gateway;
use think\facade\Cache;
use think\Controller;
use think\Request;
use think\facade\Session;

class GatewayServer extends Controller
{
    public function _initialize(){

    }
    //绑定客户端和房间，客户端和用户或接受客户端心跳
    public function bind(Request $request)
    {
        // 用户连接websocket之后,绑定uid和clientid,同时进行分组,根据接收到的roomid进行分组操作
        $userGuid='chang';
        $type=trim($request->post('type'));
        switch ($type) {
            case 'pong':
                break;
            
            default:
                $roomId=intval(trim($request->post('room')));
                $clientId=trim($request->post('client_id'));

                // 接受到上面的三个参数,进行分组操作
                Gateway::$registerAddress = '127.0.0.1:1236';
                // client_id与uid绑定
                Gateway::bindUid($clientId, $userGuid);
                // 加入某个群组（可调用多次加入多个群组） 将clientid加入roomid分组中
                Gateway::joinGroup($clientId, $roomId);
                // 返回ajax json信息
                $dataArr=[
                    'code'=>$userGuid,
                    'status'=>true,
                    'roomId'=>$roomId,
                    'message'=>'Group Success'
                ];
                return json()->data($dataArr);
        }

        
    }

    // 接受用户的信息 并且发送
    public function send(Request $request){
        Gateway::$registerAddress = '127.0.0.1:1236';
        // 获得数据
        $userGuid='chang';
        $roomId=intval(trim($request->post('room')));
        $message=trim($request->post('message'));
        // 获得用户的称呼
        $userInfo=Cache::get($userGuid);
        // 将用户的昵称以及用户的message进行拼接
        $nickname=$userInfo['nickname'];
        $message=$nickname." : ".$message;
        // 发送信息应当发送json数据,同时应该返回发送的用户的guid,用于客户端进行判断使用
        $dataArr=json_encode(array(
            'message' => $message,
            'user'=>$userGuid
        ));
        // 向roomId的分组发送数据
        Gateway::sendToGroup($roomId,$dataArr);
    }
}
