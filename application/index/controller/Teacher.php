<?php
namespace app\index\controller;//命名空间，也说明了文件所在的文件夹
use think\Db;  //引用数据库操作类

// Index既是类名，也是文件名，说明这个文件的名字为Index.php。
class Teacher
{
	public function index()
	{	
		//“获取教师表中所有数据”
		$teachers = Db::name('teacher')->select();

		//查看获取到的第0号数据的name值
		var_dump($teachers[0]['name']);
	}
}
