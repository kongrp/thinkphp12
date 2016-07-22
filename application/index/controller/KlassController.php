<?php
namespace app\index\controller;
use app\model\Klass;
use app\model\Teacher;

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

	public function add()
	{
		//获取所有的教师信息
		$teachers = Teacher::all();
		$this->assign('teachers', $teachers);
		return $this->fetch();
	}

	public function save()
	{
		$Klass = new Klass;
		$Klass->name = input('post.name');
		$Klass->teacher_id = input('post.teacher_id/d');
		if(false === $Klass->validate()->save())
		{
			return $this->error('添加数据错误：' . $Klass->getError());
		} else{
			return $this->success('操作成功', url('index'));
		}



		//var_dump(input('post.'));
	}
	
}