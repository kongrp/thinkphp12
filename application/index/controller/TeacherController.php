<?php
namespace app\index\controller;   // 命名空间，也说明了文件所在的文件夹
use app\model\Teacher;  // 引用数据库操作类-教师模型
/**
 * 教师管理，继承think\Controller后，就可以利用V层对数据进行打包了。
 */
class TeacherController extends IndexController
{
	public function index()
	{
		//获取查询信息
		$name = input('get.name');
		echo $name;

		$pageSize = 5; // 定义每页显示5条记录

		// $Teacher 首写字大写，说明它是一个对象, 更确切一些说明这是基于Teacher这个模型被我们手工实例化得到的，如果存在teacher数据表，它将对应teacher数据表。
		$Teacher = new Teacher;

		// $teachers 以s结尾，表示它是一个数组，数据中的每一项都是一个对象，这个对象基于Teahcer这个模型。
		// 将select()方法换成paginate()方法，并将每页显示记录的条数做为参数进行传入。
		$teachers = $Teacher->where('name', 'like', '%' . $name . '%')->paginate($pageSize);

		// 向V层传数据
		$this->assign('teachers', $teachers);
		 // 从V层取回打包后的数据
		$htmls = $this->fetch();

		// 将取回的数据返回给用户
		return $htmls;
	}

	public function add()
	{
		$teacher = new Teacher;
		$this->assign('teacher', $teacher);
		return $this->fetch('edit');
	}

	public function delete()
	{
		$message = '删除成功'; // 反馈消息
		$error = ''; // 反馈错误信息

		try{
			// 接收id，并转换为int类型
			$id = input('get.id/d');

			// 获取要删除的对象
			$Teacher = Teacher::get($id);

			if(false === $Teacher)
			{	
				throw new \Exception('不存在id为' . $id . '的教师，删除失败');
			}

			// 删除获取到的对象
			if(false === $Teacher->delete())
			{
				throw new \Exception('删除失败' . $Teacher->getError());
			}

			// 程序正确执行，进行跳转
			return $this->success($message, url('index'));
		} catch(\Exception $e){
			// 程序异常执行，接收异常并报错。
			return $this->error('系统错误' . $e->getMessage());	
		}
	}

	public function edit()
	{
		try{
			// 获取传入ID
			$id = input('get.id/d');

	        // 在Teacher表模型中获取当前记录
	        if(false === $teacher = Teacher::get($id))
	        {
	        	return '系统中未找到id为：' . $id . '的记录';
	        }

	        // 将数据传给V层
	        $this->assign('teacher', $teacher);

	        // 获取封装好的V层内容
	        $htmls = $this->fetch();

	        // 将封装好的V层内容返回给用户
	        return $htmls;
	    } catch (\Exception $e)
        {
            return '系统错误:' . $e->getMessage();
        }
	}

	public function save()
    {
        $id = input('post.id/d');

       // 初始化一个Teacher对象
        if (false === $Teacher = Teacher::get($id))
        {
            $Teacher = new Teacher;
            $Teacher->username  = input('post.username');
        }

        // 赋值
        $Teacher->name      = input('post.name');
        $Teacher->sex       = input('post.sex');
        $Teacher->email     = input('post.email');

        // 保存数据
        if (false === $Teacher->validate()->save())
        {
            return $this->error('操作失败' . $Teacher->getError());
        } 
        return $this->success('操作成功', url('index'));
    }
}
