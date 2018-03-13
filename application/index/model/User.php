<?php

namespace app\index\model;

use think\Model;
use think\facade\Session;
/**
* 用户模型
*/
class User extends Model
{
	protected $autoWriteTimestamp = false;
	public function getDataById($id)
	{
		return User::get($id);
	}

	//登录邮箱密码验证
	public function loginModel($info)
	{
		$userInfo = User::where('email', $info['email'])->find();
		if(empty($userInfo)||$userInfo['password']!=$info['password'])
			return false;
		else {
			$info =[
				'username'	=> $userInfo['username'],
				'email'		=> $userInfo['email']
			];
			Session::set('loginInfo',$info);
			return true;
		}
	}
}