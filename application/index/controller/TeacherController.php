<?php
namespace app\index\controller;//命名空间，也说明了文件所在的文件夹
use app\model\Teacher;  //引用数据库操作类-教师模型
/**
 * 教师管理
 */
class TeacherController
{
	public function index()
	{	
		// $Teacher 首写字大写，说明它是一个对象, 更确切一些说明这是基于Teacher这个模型被我们手工实例化得到的，如果存在teacher数据表，它将对应teacher数据表。
		$Teacher = new Teacher;
		// $teachers 以s结尾，表示它是一个数组，数据中的每一项都是一个对象，这个对象基于Teahcer这个模型。
		$teachers = $Teacher->select();

		//获取第0个数据
		$teacher = $teachers[0];

		//调用上述对象的getData()方法
		var_dump($teacher->getData('name'));

		//另外两个直接显示数据的方式	
		echo $teacher->getData('name');
		return $teacher->getData('name');
	}
}
