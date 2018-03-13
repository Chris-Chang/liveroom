<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Config;
use think\facade\Env;
use app\index\model\User;
use think\Request;
use app\index\validate\Login;

/**
* index类
*/
class Index extends Controller
{
    
    public function index()
    {
       return $this->fetch('index');
    }

    //登陆
    public function login()
    {
        // dump($_SERVER);
       return $this->fetch('login');
    }

    public function loginDo(Request $request)
    {
        $param = $request->param();

        //1. 使用validate类进行数据验证,返回值$result为boolean
        // $validate = new Login();
        // $result = $validate->check($param);
        // if($result === false){
        //     $this->error($validate->getError());
        // }

        //2. 使用控制器的validate方法进行验证,返回值为错误信息
        $rule = [
        'email' => ['require', 'email','token'],
        'password' => 'length:4,20'
        ];

        $message = [
        'email.require' => '邮箱必须填写',
        'email.email'=> '邮箱格式不正确',
        'email.token'=> 'token错误',
        'password.length'   => '密码长度必须为4--20位'
        ];
        
        $result = $this->validate($param, $rule, $message);
        if($result !==true) $this->error($result);

        $userModel = new User;
        if($userModel->loginModel($param))
            return $this->redirect('/index/manage/home');
        else
            return $this->error('账号不存在或密码错误');
       // dump($request->param());
    }

    //空方法
    public function _empty()
    {
        return "<h1>404 Not Found</h1>";
    }
}