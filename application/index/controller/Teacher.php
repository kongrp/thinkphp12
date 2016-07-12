<?php
namespace app\index\controller;//命名空间，也说明了文件所在的文件夹
use app\model\Teacher;  //引用数据库操作类-教师模型
/**
 * 教师管理
 */

// Index既是类名，也是文件名，说明这个文件的名字为Index.php。
class Teacher
{
	public function index()
	{	
		$Teacher = new Teacher;
		var_dump($Teacher);
	}
}
