<?php
namespace app\common\validate;
use think\Validate;  // 引用内置验证类

class Teacher extends Validate
{
	protected $rule = [
		'username' => 'require|length:4,25|unique:teacher',
		'email' => 'email',
		'name'  => 'require|length:2,25',
	];
	protected $message = [
		'email' => '邮箱格式有误',
	];
}