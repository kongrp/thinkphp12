<?php
namespace app\index\controller;
use app\model\Course;
use app\model\Klass;
use app\model\KlassCourse;

class CourseController extends IndexController
{
	public function index()
	{
		//获取查询信息
		$name = input('get.name');

		$Course = new Course;
		$courses = $Course->where('name', 'like', '%' . $name . '%')->paginate(2);
		$this->assign('courses', $courses);
		$this->assign('Course', $Course);

		return $this->fetch();
	}

	public function add()
	{
        $Course = new Course;
        $this->assign('Course', $Course);
        return $this->fetch('edit');
	}

    public function edit()
    {
    	$id = input('get.id/d');
    	if(false === $Course = Course::get($id))
    	{
    		return $this->error('不存在id为：' . '的记录');
    	}	

    	$this->assign('Course', $Course);
    	return $this->fetch();
    }

    public function save()
    {
        // 更新当前课程基本信息
        $id = input('post.id/d');
        $Course = Course::get($id);
        $Course = $Course ? $Course : new Course;

        $Course->name = input('post.name');
        if (false === $Course->save())
        {
            return $this->error('课程信息更新发生错误：' . $Course->getError());
        }

        // 增加新增数据，执行添加操作。
        if (false === $Course->Klasses()->updateAll(input('post.klass_id/a')))
        {
            return $this->error('添加关联数据发生错误' . $Course->KlassCourse->getError());
        }
        return $this->success('更新成功', url('index'));
    }

    public function delete()
    {
        $id = input('get.id/d');
        if(false === $Course = Course::get($id))
        {
            return $this->error('不存在id为：' . '的记录');
        }
        if(false === $Course->delete)
        {
            return $this->error('删除失败' . $Course->getError());
        }
        return $this->success('删除成功', url('index'));
    }
}	