<?php 

namespace app\common\controller;

use think\Controller;
use app\common\model\Menu;
use View;
/**
* 控制器基类
*/
class BaseController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$menu = new Menu();
		$menuData = $menu->getMenuRecursion();
		View::share('menuData', $menuData);
	}
}