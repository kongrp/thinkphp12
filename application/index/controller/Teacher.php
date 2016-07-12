<?php
namespace app\index\controller;
use think\Db;  //引用数据库操作类

class Teacher
{
	public function index()
	{	
		//获取数据表中第一条数据
		var_dump(Db::name('teacher')->find());
	}
}
