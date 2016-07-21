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
		if(Teacher::login(input('post.username'), input('post.password')))
		{
			return $this->success('登录成功', url('Teacher/index'));
		} else{
			return $this->success('用户名或密码错误', url('index'));
		}
	}
}