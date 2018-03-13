<?php

namespace app\admin\model;

use think\Model;
use Session;
class Admin extends Model
{
	
	//自动写入时间戳开启
	protected $autoWriteTimestamp = true;
	protected $createTime = 'create_time';
	protected $updateTime = 'update_time';

	//登录模型
	public function loginModel($info)
	{
		$res = Admin::where('email',$info['email'])->find();
		if(empty($res) || $res['password'] != md5($info['password'])){ 

			return false;
		}
		else{
			$loginInfo = [
				'username' 	=> $res['username'],
				'email'		=> $res['email'],
				'sex'		=> $res['sex']
			];
			Session::set('loginInfo', $loginInfo);
			return true;
		}
	}

	//性别获取器
	public function getSexAttr($value)
	{
		$sex = [0=>'保密', 1=>'男', 2=>'女'];
		return $sex[$value];
	}

	//密码修改器
	public function setPasswordAttr($value)
	{
		return md5($value);
	}
}