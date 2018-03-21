<?php
namespace app\index\controller;
use think\Controller;
use think\facade\Request;
/**
* 直播间
*/
class Room extends Controller
{
        /**
     * 进入某个直播房间
     * @param $id
     */
    public function index()
    {

        $id = Request::get();

        $roomInfo = [

             'disable'=>'0',
             'name'=>'测试直播间',
             'nickname'=>'小智的直播间',
             'guid'=>'234',
             'type'=>'测试直播间',
             'people'=>'1000',
             'description'=>'这是小智的测试直播间',
             'notice' => '注意注意，小心小心',
             'uid'=>'def',
             'status'=>'1',
             'headimgurl'=>'headimgurl.jpg',
             'typeid'=>'2'
        ];
        $roomCollection=100;
        $roomCollectionFlag =1;
        $userLoginFlag = 1;
        $roomTypeInfo =[
            'type'=>[
                'id'=>2,
                'name'=>'测试'
            ]
        ];
        $userLoginInfo=[
            'headimgurl'=>'a',
            'nickname'=>'小智',
            'guid'=>'22'
        ];
        $this->assign('roomCollecitonFlag',$roomCollectionFlag);
        // 输出房间信息
        $this->assign('roomCollection',count($roomCollection));
        $this->assign('roomInfo', $roomInfo);
        $this->assign('roomTypeInfo',$roomTypeInfo);
        $this->assign('userLoginInfo',$userLoginInfo);
        $this->assign('userLoginFlag',$userLoginFlag);
        return $this->fetch();
    }

    public function room1()
    {
        return $this->fetch();
    }
}