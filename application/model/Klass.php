<?php
namespace app\model;
use think\Model;
/**
 * 班级表对应的模型类
 */
class Klass extends Model
{
	public function getTeacher()
	{
		$teacherId = $this->getData('teacher_id');
		$Teacher = Teacher::get($teacherId);
		return $Teacher;
	}
}