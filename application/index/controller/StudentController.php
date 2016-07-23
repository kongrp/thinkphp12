<?php
namespace app\index\controller;
use app\model\Student;

class StudentController extends IndexController
{
	public function index()
	{
		$students = Student::paginate(2);
		$this->assign('students', $students);
		return $this->fetch();
	}
}