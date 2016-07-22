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
	}

	public function edit()
		{
			$id = input('get.id/d');
			//获取所有的教师信息
			$teachers = Teacher::all();
			$this->assign('teachers', $teachers);

			if(false === $Klass = Klass::get($id))
			{
				return $this->error('不存在id为：' . $id . '的记录');
			}

			$this->assign('Klass', $Klass);
			return $this->fetch();
		}

		public function update()
		{
			$id = input('post.id/d');

			// 获取传入的班级信息
			$Klass = Klass::get($id);
			if(false === $Klass)
			{
				return $this->error('系统未找到ID为' . $id . '的记录');
			}

			$Klass->name = input('post.name');
			$Klass->teacher_id = input('post.teacher_id');
			if(false === $Klass->validate()->save())
			{
            	return $this->error('更新错误：' . $Klass->getError());
        	} else {
            	return $this->success('操作成功', url('index'));
        	}
		}

		public function delete()
		{
			$id = input('get.id/d');
			// 获取传入的班级信息
			$Klass = Klass::get($id);
			if(false === $Klass)
			{
				return $this->error('系统未找到ID为' . $id . '的记录，删除失败');
			}

			if(false === $Klass->delete())
			{
				return $this->error('删除失败' . $Klass->getError());
			}
			return $this->success('删除成功', url('index'));
		}	
}