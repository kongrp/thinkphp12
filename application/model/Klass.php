<?php
namespace app\model;
use think\Model;
/**
 * 班级表对应的模型类
 */
class Klass extends Model
{	
	//Klass表与Teacher表关联
	public function Teacher()
	{
		return $this->belongsTo('teacher');
	}
}