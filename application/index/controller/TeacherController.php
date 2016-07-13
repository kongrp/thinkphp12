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
		//新建测试数据
		$teacher = array();   // 这种写法也可以 $teacher = [];
		$teacher['name'] = '王五';
		$teacher['username'] = 'wangwu';
		$teacher['sex'] = '1';
		$teacher['email'] = 'wangwu@yunzhi.com';
		var_dump($teacher);

		//引用teacher数据表对应的模型
		$Teacher = new Teacher;
		var_dump($Teacher);

		//向teacher表中插入数据并判断是否插入成功
		//data方法是模型类的连贯操作方法之一，用于设置当前要操作的数据对象的值,是直接生成要操作的数据对象
		$state = $Teacher->data($teacher)->save();
		//返回的是一个数字，如果插入成功，则会返回数字。在开发模式下，我们认为，只要未抛出异常，那么就是插入成功。
		var_dump($state);
		
	}
}
