<?php
namespace app\admin\validate;

use think\Validate;
use Session;

/**
* User表数据验证
*/
class User extends Validate
{
	
	protected $rule = [
		'username' 	=> 'max:25',
		'email'		=> 'require|email',
		'sex'		=> 'require|in:0,1,2',
		'password'	=> 'require|length:6,20|confirm',//password和password_confirm自动相互验证
		'remark'	=> 'length:0,100'
	];

	protected $message = [
		'username.max'	=> '用户名长度不能超过25',
		'email.require'	=> '邮箱必须填写',
		'email.email'	=> '邮箱格式错误',
		'sex.require'	=> '性别必须选择',
		'sex.in'		=> '性别必须选择',
		'password.require'=>'密码必须填写',
		'password.length'=>'密码长度需在6~20之间',
		'password.confirm'=>'密码不一致',
		'remark'		=> '备注长度不能大于100'
	];
}