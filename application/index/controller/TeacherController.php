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
		//查看数据是否以正确的方式传入,且insert是否已经正确接收了。
		var_dump($_POST);

		//使用input()助手函数并正确设置config.php后，与直接输出的区别。
		$postData = input('post.');
		var_dump($postData);
	}

	public function add()
	{
		$htmls = $this->fetch();
		return $htmls;
	}
}
