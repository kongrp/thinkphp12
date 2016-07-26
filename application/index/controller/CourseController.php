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
        return $this->fetch();
	}

	public function save()
	{
		 // 存课程信息
        $Course = new Course();
        $Course->name = input('post.name');

        if (false === $Course->validate(true)->save())
        {
            return $this->error('保存错误：' . $Course->getError());
        }

        // 接收class_id这个数组
        $klassIds = input('post.klass_id/a') ? input('post.klass_id/a') : array();       // /a表示获取的类型为数组
        if($klassIds)
        {
	        if ($Course->Klasses()->saveAll($klassIds) === false)
	        {
	            return $this->error('保存错误：' . $Course->Klasses()->getError());
	        }
	    }

        return $this->success('操作成功', url('index'));
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
}	