<?php
namespace app\model;
use think\Model;

class Student extends Model
{
	 /**
     * 输出性别的属性
     * @return string 0男，1女
     * @author kongrp <kongrp@yunzhiclub.com>
     */
	public function getSexAttr($value)
	{
		$status = array('0' => '男', '1' => '女');
		$sex = $status[$value];
		if(isset($sex))
		{
			return $sex;
		} else{
			return $status[0];
		}
	}

	protected $dateFormat = 'Y年m月d日';

	protected $type = [
		'create_time' => 'datetime',
	];

	/**
	 *获取要显示的创建时间
     * @param  int $value 时间戳
     * @return string  转换后的字符串
	 */
	// public function getCreateTimeAttr($value)
	// {
	// 	return date('Y-m-d', $value);
	// }
}