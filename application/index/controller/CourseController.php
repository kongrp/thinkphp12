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
		return $this->fetch();
	}

	public function add()
	{
		//获取班级列表
		$klasses = Klass::all();
        $this->assign('klasses', $klasses);

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

        // 新增班级课程信息
        // 接收class_id这个数组
       $klassIds = input('post.klass_id/a') ? input('post.klass_id/a') : array();       // /a表示获取的类型为数组

        // 利用class_id这个数组，拼接为包括klass_id和course_id的二维数组。
        $datas = array();
        foreach ($klassIds as $klassId)
        {
            $data = array();
            $data['klass_id'] = $klassId;
            $data['course_id'] = $Course->id;     // 此时，由于前面已经执行过数据插入操作，所以可以直接获取到Course对象中的ID值。
            array_push($datas, $data);
        }

        // 利用saveAll()方法，来将二维数据存入数据库。
        if (count($datas))
        {
            $KlassCourse = new KlassCourse;
            if (false === $KlassCourse->validate(true)->saveAll($datas))
            {
                return $this->error('保存错误：' . $KlassCourse->getError());
            }
        }
        return $this->success('操作成功', url('index'));
    }
}