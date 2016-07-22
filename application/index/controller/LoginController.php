<?php
namespace app\index\controller;
use app\model\Teacher;
use think\Controller;
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
		if(Teacher::login(input('post.username'), input('post.password')))
		{
			return $this->success('登录成功', url('Teacher/index'));
		} else{
			return $this->success('用户名或密码错误', url('index'));
		}
	}

	//用户注销退出系统
	public function logOut()
	{
		if(Teacher::logOut())
		{
			return $this->success('注销成功', url('index'));
		} else{
			return $this->error('注销失败', url('index'));
		}
	}
}