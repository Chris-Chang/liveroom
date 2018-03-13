<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Session;
use think\facade\View;
/**
* 后台管理员页面
*/
class Manage extends Controller
{
	protected $beforeActionList = [
		'first'
	];

	//判断是否已经登录
	public function first()
	{
		$loginInfo = Session::get('loginInfo');
		if (empty($loginInfo)) {
			return $this->redirect('/index/index/login');
		}
		$viewData = [
			'loginInfo'	=> $loginInfo
		];

		View::share($viewData);
	}

	public function home()
	{
		return $this->fetch(); 
	}
}