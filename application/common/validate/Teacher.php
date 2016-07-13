<?php
namespace app\common\validate;
use think\Validate;

class Teacher extends Validate
{
	protected $rule = [
		'email' => 'email',
	];
	protected $message = [
		'email' => '邮箱格式有误',
	];
}