<?php
namespace app\index\controller;
use think\Controller;   // 用于与V层进行数据传递
use app\model\Teacher;  //引入教师

class IndexController extends Controller
{
    public function __construct()
	{
		//调用父类构造函数(必须)
		parent::__construct();

		//验证用户登录
		if(!Teacher::isLogin())
		{
			return $this->error('请先登录', url('Login/index'));
		}
	}

    public function index()
    {

    }
}
