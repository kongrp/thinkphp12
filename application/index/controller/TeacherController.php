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
		$Teacher = new Teacher;
		$teachers = $Teacher->select();

		var_dump($teachers);
	}
}
