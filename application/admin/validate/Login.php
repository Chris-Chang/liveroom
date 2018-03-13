<?php

namespace app\admin\validate;

use think\Validate;
use Session;

/**
*登陆数据验证
*/
class Login extends Validate
{
	protected $rule = [
		'email' => ['require', 'email'],
		'password' => 'length:4,20'
	];

	protected $message = [
		'email.require'	=> '邮箱必须填写',
		'email.email'=> '邮箱格式不正确',
		'password.length'	=> '密码长度必须为4--20位'

	];


	//由于如果check()失败，也是返回false
	//因此验证码验证失败时最好不使用返回值，而使用异常
	public function checkDo($param)
	{
		$sessionVerify = Session::pull('loginVerify');
		if(md5($param['verify']) != $sessionVerify){
			exception('验证码错误');
		}

		return $this->check($param);
	}
}