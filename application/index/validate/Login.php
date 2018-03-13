<?php

namespace app\index\validate;

use think\Validate;

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
}