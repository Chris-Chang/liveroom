<?php
namespace app\common\model;

use think\Model;

/**
* Menu
*/
class Menu extends Model
{
	protected $autoWriteTimestamp = true;
	protected $createTime = 'create_time';
	protected $updateTime = 'update_time';

	public function getMenuRecursion($pid = 0)
	{
		$data = $this->where('pid', $pid)->select()->toArray();
		$menuDatas = [];
		foreach ($data as $item) {
			$children['children'] = $this->getMenuRecursion($item['id']);
			$menuDatas[] = array_merge($item,$children);
		}
		return $menuDatas;
	}
}