<?php

namespace app\common\model;

use think\Model;
use	think\model\concern\SoftDelete;

/**
* 用户公共类
*/
class User extends Model
{
	//设置软删除
	use	SoftDelete;
	protected	$deleteTime	=	'delete_time';

	//自动写入时间戳开启
	protected $autoWriteTimestamp = true;
	protected $createTime = 'create_time';
	protected $updateTime = 'update_time';

	//分页
	public function getPageList($pagesize = 5)
	{
		$list = $this->order('id','desc')->paginate($pagesize);
		return $list;
	}

	//添加用户
	public function addUser($info, $allow=true)
	{
		return $this->allowField($allow)->save($info);
	}

	//删除单个用户
	public function deleteUser($id,$force=false)
	{
		if(!empty($id))
			return User::destroy($id,$force);
		else
			return false;
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