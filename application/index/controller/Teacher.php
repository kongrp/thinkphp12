<?php
namespace app\index\controller;  //命名空间，也说明了文件所在的文件夹
use app\model\Teacher as SmallTeacher;  //引用数据库操作类-教师模型
/**
 * 教师管理
 */

class Teacher
{
	public function index()
	{	
		$SmallTeacher = new SmallTeacher;
		var_dump($SmallTeacher);
	}
}
