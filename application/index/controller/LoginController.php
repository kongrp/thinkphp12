<?php
namespace app\index\controller;
use think\Controller;
use app\model\Teacher;
/**
 * 登录与注销模块
 * kongrp
 */

class LoginController extends Controller
{
	//显示登录表单
	public function index()
	{
		//显示登录表单
		return $this->fetch();
	}

	//处理用户提交的登录数据
	public function login()
	{	
		//先测试是否传入正确的信息
		var_dump(input('post.'));

 		// 验证用户名是否存在
 		$map = array('username'=>input('post.username'));
 		//var_dump($map);  --输出一个数组，输足内有两项内容，用户名和密码信息。
 		$Teacher = Teacher::get($map);
 		//var_dump($Teacher);  --输出例如张三这个对象的基本信息
  
        //就像我以前说过的，我们每调用一个方法，都要非常清晰的知道它返回值类型是什么
        // $Teacher要么是一个对象，要么是false。
        if(false !== $Teacher)
        {	
        	// 验证密码是否正确
        	if($Teacher->getData('password') !== input('post.password'))
        	{
        		// 用户名密码错误，跳转到登录界面。
        		return $this->error('密码错误', url('index'));
        	} else{
        		// 用户名密码正确，将teacherId存session。
        		session = ('teacherId', $Teacher->getData('id'));
        		return $this->success('登录成功', url('Teacher/index'));
        	}
        } else{
        	// 用户名密码错误，跳转到登录界面。
        	return $this->error('用户名不存在', url('index'));
        }
	}
}