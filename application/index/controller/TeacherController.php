<?php
namespace app\index\controller;   //命名空间，也说明了文件所在的文件夹
use think\Controller;   //用于与V层进行数据传递
use app\model\Teacher;  //引用数据库操作类-教师模型
/**
 * 教师管理，继承think\Controller后，就可以利用V层对数据进行打包了。
 */
class TeacherController extends Controller
{
	public function index()
	{	
		// $Teacher 首写字大写，说明它是一个对象, 更确切一些说明这是基于Teacher这个模型被我们手工实例化得到的，如果存在teacher数据表，它将对应teacher数据表。
		$Teacher = new Teacher;
		// $teachers 以s结尾，表示它是一个数组，数据中的每一项都是一个对象，这个对象基于Teahcer这个模型。
		$teachers = $Teacher->select();

		// 向V层传数据
		$this->assign('teachers', $teachers);
		 // 从V层取回打包后的数据
		$htmls = $this->fetch();

		// 将取回的数据返回给用户
		return $htmls;
	}

	//新建insert触发器，用来实现数据添加的功能
	public function insert()
	{
		//接收用户输入的数据
		$teacher = input('post.');

		//引用Teacher模型
		$Teacher = new Teacher;

		//插入数据
		$result = $Teacher->validate(true)->data($teacher)->save();

		//反馈结果
		if(false === $result)
		{
			return '新增失败' . $Teacher->getError();
		}
		//
		//
		return $teacher['name'] . '新增成功';	
	}

	public function add()
	{
		$htmls = $this->fetch();
		return $htmls;
	}

	public function test()
	{
		$data = array();
        $data['username'] = 'ce';
        $data['name'] = '1';
        $data['sex'] = '1';
        $data['email'] = 'hello@hello.com';
        var_dump($this->validate($data, 'Teacher'));
	}

	public function delete()
	{
		//接收id，并转换为int类型
		$id = input('get.id/d');

		//获取要删除的对象
		$Teacher = Teacher::get($id);

		if(false === $Teacher)
		{	
			return $this->error('不存在id为' . $id . '的教师，删除失败');
		}

		//删除获取到的对象
		if(false === $Teacher->delete())
		{
			return $this->error('删除失败' . $Teacher->getError());
		}

		//进行跳转
		return $this->success('删除成功', url('index'));
	}

	public function edit()
	{
		// 获取传入ID
		$id = input('get.id/d');

        // 在Teacher表模型中获取当前记录
        if(false === $teacher = Teacher::get($id))
        {
        	return '系统中未找到id为：' . $id . '的记录';
        }

        // 将数据传给V层
        $this->assign('teacher', $teacher);

        // 获取封装好的V层内容
        $htmls = $this->fetch();

        // 将封装好的V层内容返回给用户
        return $htmls;
	}

	public function update()
	{
		//接收数据
		$teacher = input('post.');
		
		//将数据存入教师数据表
		$Teacher = new Teacher;

		//根据状态定制提示信息
		if($Teacher->validate()->isUpdate()->save($teacehr))
		{
			$message = '更新成功';
		} else {
			$message = '更新失败';
		}

		return $message;
	}
}
