<?php
namespace app\index\controller;
use app\model\Student;
use app\model\Klass;

class StudentController extends IndexController
{
	public function index()
	{
		//获取查询信息
		$name = input('get.name');
		echo $name;

		$pageSize = 1; // 定义每页显示5条记录
		
		$Student = new Student;

		$students = $Student->where('name', 'like', '%' . $name . '%')->paginate($pageSize);

		// 向V层传数据
		$this->assign('students', $students);
		 // 从V层取回打包后的数据
		$htmls = $this->fetch();

		// 将取回的数据返回给用户
		return $htmls;
	}

	public function add()
	{
		$klasses = Klass::all();
		$this->assign('klasses', $klasses);
		return $this->fetch();
	}

	public function save()
	{
		$Student = new Student;
		$Student->name = input('post.name');
		$Student->num = input('post.num');
		$Student->sex = input('post.sex');
		$Student->klass_id = input('post.klass_id/d');
		$Student->email = input('post.email');
		if(false === $Student->validate()->save())
		{
			return $this->error('添加数据错误：' . $Student->getError());
		} else{
			return $this->success('操作成功', url('index'));
		}
	}

	public function edit()
	{
		$id = input('get.id/d');

		if(false === $Student = Student::get($id))
		{
			return $this->error('不存在id为：' . $id . '的记录');
		}

		$klasses = Klass::all();
		$this->assign('klasses', $klasses);

		$this->assign('Student', $Student);
		return $this->fetch();
	}
	
	public function update()
	{
		$id = input('post.id/d');

		//获取传入的对象信息
		$Student = Student::get($id);

		if(false === $Student)
		{
			return $this->error('系统未找到ID为' . $id . '的记录');
		}

		//数据更新
		$Student->name = input('post.name');
		$Student->num = input('post.num');
		$Student->sex = input('post.sex');
		$Student->klass_id = input('post.klass_id');
		$Student->email = input('post.email');

		if(false === $Student->validate(true)->save())
        {
            return $this->error('更新错误：' . $Student->getError());
        } else {
            return $this->success('操作成功', url('index'));
        }
	}

	public function delete()
	{	
		// 接收ID，并转换为int类型
		$id = input('get.id/d');
		// 获取要删除的对象
		$Student = Student::get($id);

		if(false === $Student)
		{
			 return $this->error('不存在id为' . $id . '的学生，删除失败');
		}
		// 删除获取到的对象
        if (false === $Student->delete())
        {
            return $this->error('删除失败:' . $Student->getError());
        }

        // 进行跳转
        return $this->success('删除成功', url('index'));
	}
}