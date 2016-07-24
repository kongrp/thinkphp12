<?php
namespace app\index\controller;
use app\model\Course;

class CourseController extends IndexController
{
	public function index()
	{
		//获取查询信息
		$name = input('get.name');

		$Course = new Course;
		$courses = $Course->where('name', 'like', '%' . $name . '%')->paginate(2);
		$this->assign('courses', $courses);
		return $this->fetch();
	}

	public function add()
	{
		return $this->fetch();
	}

	public function save()
	{
		$Course = new Course;
		$Course->name = input('post.name');
		if(false === $Course->save())
		{
			return $this->error('保存错误' . $Course->getError());
		} else{
			return $this->success('保存成功', url('index'));
		}
	}
}