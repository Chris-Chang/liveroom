<?php
namespace app\admin\controller;

use app\common\controller\BaseController;
use app\common\model\User as UserModel;
use think\Request;
use app\admin\validate\User as UserValidate;
use app\common\model\Menu as MenuModel;
/**
* 用户管理
*/
class User extends BaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function userList(UserModel $userModel)
	{
		$datas = $userModel -> getPageList(5);
		$count = $datas->total();
		$this->assign('count', $count);
		$this->assign('datas', $datas);
		return $this->fetch();
	}

	//添加用户界面
	public function addUser()
	{
		return $this->fetch();
	}

	//添加用户执行
	public function addUserDo(Request $request)
	{
		$data = $request->post();
		$validate = new UserValidate;
		if(!$validate->check($data)){
			$this->error($validate->getError());
		}

		$userModel = new UserModel;
		if($userModel->addUser($data, true)){
			$this->success('添加成功','/admin/user/userlist');
		}else{
			$this->error('添加失败');
		}
	}

	//删除用户
	public function deleteUserDo(Request $request)
	{
		$id = $request->only('id');
		$userModel = new UserModel;
		if($userModel->deleteUser($id)){
			$this->success('删除成功','/admin/user/userlist');
		}else{
			$this->error('删除失败');
		}
	}
}