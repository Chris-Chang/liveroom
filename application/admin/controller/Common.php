<?php
namespace app\admin\controller;

use app\common\controller\BaseController;
use Gregwar\Captcha\CaptchaBuilder;
use Session;
use app\admin\validate\Login;
use think\Request;
use think\Exception;
use app\admin\model\Admin;
/**
* 公共类库
*/
class Common extends BaseController 
{
	
	//输出验证码
	public function imgCode()
	{
		$builder = new CaptchaBuilder();
		$builder->build($width = 180, $height = 60, $font = null);
		//输出图形验证码
		$phrase = $builder->getPhrase();
		Session::set('loginVerify', md5($phrase));
		$builder->output();

		$header = [
			'Content-type' => 'image/jpeg'
		];

		return response('', 200, $header);
	}

	//后台登陆方法
	public function login()
	{
		return $this->fetch();
	}

	//后台登陆执行
	public function loginDo(Request $request)
	{
		$param = $request->param();
		$validate = new Login();
		try {
			$result = $validate->checkDo($param);
		} catch (Exception $e) {
			$this->error($e->getMessage());
		}
        if($result === false){
            $this->error($validate->getError());
     	}

     	$adminModel = new Admin();
     	if($adminModel->loginModel($param)){
     		$this->redirect('/admin/manage/home');
     	}else{
     		$this->error('账号不存在或密码错误');
     	}
     	
	}
}
