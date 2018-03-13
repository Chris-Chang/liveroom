<?php
namespace app\admin\controller;

use app\common\controller\BaseController;
use Session;
use View;
/**
* Manage
*/
class Manage extends BaseController
{
	
	function __construct()
	{
		parent::__construct();

		$loginInfo = Session::get('loginInfo');
		if(empty($loginInfo)){
			return $this->redirect('/admin/common/login');
		}
		$viewData = [
			'loginInfo' => $loginInfo
		];
		
		View::share($viewData);
	}

	public function home()
	{
		return $this->fetch();
	}
}