<?php
/**
 * Author: root
 * Date  : 17-3-27
 * time  : 上午10:20
 */
namespace app\index\controller;

use think\Config;
use think\Controller;
use think\Request;
use think\Db;

class Rtmp extends Controller
{
    /**
     * 用户推流事件
     *   - 用户推流触发on_publish
     *   - 匹配数据库：房间名是否匹配/用户密码是否匹配/用户的推流密码是md5(房间号+登录密码)
     *   - 匹配成功修改房间status为1，标注正在直播，如果已经在推流，则不允许再次推流
     * @param Request $request
     */
    public function onPublish(Request $request)
    {
        // // 接受name和pass param可以自动选择get或者是post
        // // 推流格式10000?pass=d8db6bd3e8495edc7047dc15c148aa26 -  md5('10000'.md5('123456'));
        // $name = trim($request->param('name'));
        // $pass = trim($request->param('pass'));
        // if (empty($name) || empty($pass)) {
        //     echo "串码流不正确1";
        //     // thinkphp5返回头信息的函数
        //     return json('')->code(404)->header(['Not Found']);
        // }
        // $roomInfo = Db::name('room')->where(['guid' => $name])->find();
        // //　如果房间不存在或者房间被封禁，则无法推流
        // if (count($roomInfo) <= 0 || $roomInfo['disable'] == 1) {
        //     echo "串码流不正确2";
        //     return json('')->code(404)->header(['Not Found']);
        // }
        // $userRoomInfo = Db::name('userzhubo')->where(['room' => $name])->find();
        // $userGuid = $userRoomInfo['user'];
        // $userInfo = Db::name('user')->where(['guid' => $userGuid])->find();
        // if (count($userInfo) <= 0 || $pass != md5($name.$userInfo['password'])) {
        //     echo "串码流不正确3";
        //     return json('')->code(404)->header(['Not Found']);
        // }
        // // 如果用户验证成功，则开始推流，将房间设置成直播模式 status = 1 更新updatetime
        // $arr=[
        //     'status'=>1,
        //     'update_time'=>time(),
        // ];
        // $res = Db::name('room')->where(['guid' => $name])->update($arr);
        // if ($res) {
        //     return json('')->code(200)->header(['OK']);
        // } else {
        //     return json('')->code(404)->header(['数据库更新错误']);
        // }


        $name=$request->param('name');
        $pass=$request->param('pass');
        // 设置用户名和密码
        $savename= "test";
        $savepass = "123456";
        if(empty($name) || empty($pass)){
            echo "串码流不正确";
            // 这个是thinkphp5的返回头信息的函数
            return json('')->code(404)->header(['Not Found']);
        }else{
            if(strcmp($name,$savename)==0 && strcmp($pass,$savepass)==0){
                // 默认是返回2xx的头，因此不需要进行控制
                echo "串码流正确";
                // 我在这里添加了另一个test2 和 123456的用户
            }else if(strcmp($name,'test2')==0 && strcmp($pass,'123456')==0){
                echo "串码流正确";
            }else{
                echo "串码流不正确";
                return json('')->code(404)->header(['Not Found']);
            }
        }
    }

    /**
     * 用户直播结束的回调事件
     *   - 用户直播结束后，将status设置成0，标注该房间未在推流
     * @param Request $request
     */
    function onPublishDone(Request $request)
    {
        // 获得stream name
        $name = trim($request->param('name'));
        // 关闭直播 设置status 为 0
        Db::name('room')->where(['guid' => $name])->setField('status', 0);
        return json('')->code(200)->header(['关闭直播']);
    }

    /**
     * 用户观看直播的回调事件
     */
    function onPlay(Request $request)
    {
        // 获得视频流地址
        $name = trim($request->param('name'));
        // 有人加入观看，设置people +1
        Db::name('room')->where(['guid' => $name])->setInc('people');
    }

    /**
     * 用户结束观看直播的回调事件
     * @param Request $request
     */
    function onPlayDone(Request $request)
    {
        // 获得视频流地址
        $name = trim($request->param('name'));
        // 有人加入观看，设置people -1
        Db::name('room')->where(['guid' => $name])->setDec('people');
    }

    /**
     * 对正在直播的直播间进行视频流截图
     * - 运行system linux命令
     * - 保存的名称就是直播间的guid的名称
     * - 覆盖掉之前的文件
     */
    function ffmpegPhoto()
    {
        // 查找所有正在直播的房间的guid
        $allRoomIGuid = Db::name('room')->where(['status' => 1])->select();
        // 循环执行ffmpeg 截图功能
        $countAllRoom = count($allRoomIGuid);
        for ($i = 0; $i < $countAllRoom; $i++) {
            // 从配置中获得ffmpeg截图存放位置
            $photoPos = Config::get('ffmpeg.photoPos');
            // 获得时间戳文件名
            $fileStamp = $allRoomIGuid[$i]['guid'] . "_" . time();
            // 重命名原来的文件 结合timestamp
            $cmd = " mv " . $photoPos . "/" . $allRoomIGuid[$i]['guid'] . ".png " . $photoPos . "/" . $fileStamp . ".png";
            // echo($cmd);
            $result = system($cmd, $res);
            echo $res . "-";
            // 从配置中获取视频流
            $rtmpUrl = Config::get('view_replace_str.__RTMP_URL__');
            /**
             *  拼接ffmpeg命令行
             *  - 下面命令表示从 rtmp://192.168.124.129/myapp/10000 视频流的2秒后切一个图
             *  - 存放名称路径是下面的代码
             */
            $cmd = "ffmpeg -i " . $rtmpUrl . "/" . $allRoomIGuid[$i]['guid'] . " -f image2 -ss 1 -vframes 1 -s 400*300 " . $photoPos . "/" . $allRoomIGuid[$i]['guid'] . ".png ";
            // 使用system函数执行系统命令
            // echo $cmd;
            $result = system($cmd, $res);
            // 执行ffmpeg命令会访问视频流，因此
            echo $res . "-";
            if ($res == 1) {
                // 如果执行失败 则说明没有生成新的文件，讲原来的mv操作撤销
                $cmd = " mv " . $photoPos . "/" . $fileStamp . ".png " . $photoPos . "/" . $allRoomIGuid[$i]['guid'] . ".png";
                system($cmd, $res);
                echo $res . "-";
            }
        }
        return "done";
    }
}
