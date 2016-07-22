<?php
namespace app\index\controller;
use app\model\Klass;

class KlassController extends IndexController
{
	public function index()
	{
		 // 获取查询信息
		 $name = input('get.name');

		//调用分页，获取班级表信息
        $Klass = new Klass; 
        $klasses = $Klass->where('name', 'like', '%' . $name . '%')->paginate(2);
		//向V层传数据
		$this->assign('klasses', $klasses);

		//取回V层打包的数据，并返回给用户
		return $this->fetch();
	}
	
}