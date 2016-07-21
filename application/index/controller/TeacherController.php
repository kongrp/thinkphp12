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

	// 新建insert触发器，用来实现数据添加的功能
	public function insert()
	{
		$message = ''; // 反馈消息
		$error = ''; // 反馈错误信息

		try{
			// 接收用户输入的数据
			$teacher = input('post.');

			// 引用Teacher模型
			$Teacher = new Teacher;

			// 插入数据
			$result = $Teacher->validate(true)->data($teacher)->save();

			// 反馈结果
			if(false === $result)
			{
				$error = '新增失败' . $Teacher->getError();
			} else{
				$message = $teacher['name'] . '新增成功';
			}
		} catch(\Exception $e){
			$error = '系统错误:' . $e->getMessage();
		}

		// 判断是否发生错误
		if($error === '')
		{
			return $this->success($message, url('index'));
		} else{
			return $this->error($error);
		}	
	}

	public function add()
	{
		try{
			$htmls = $this->fetch();
			return $htmls;
		} catch(\Exception $e){
			return '系统错误' . getMessage();
		}
	}

	public function test()
	{
		$data = array();
        $data['username'] = 'ce';
        $data['name'] = '1';
        $data['sex'] = '1';
        $data['email'] = 'hello@hello.com';
        var_dump($this->validate($data, 'Teacher'));
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

	public function update()
	{
		$message = ''; // 反馈消息
		$error = ''; // 反馈错误信息

		try{
			// 接收数据，取要更新的关键字信息
			$id = input('post.id');	
	        
	        // 获取当前对象
	        $teacher = Teacher::get($id);

	        // 写入要更新的数据
	        $teacher->name = input('post.name');
			$teacher->username = input('post.username');
			$teacher->sex = input('post.sex');
			$teacher->email = input('post.email');

			$message = '更新成功';
	        // 更新
	        if(false === $teacher->validate()->save())
	        {
	        	$error = '更新失败' . $teacher->getError();
	        }
	    } catch(\Exception $e){
	    	$error = '系统错误:' . $e->getMessage();
	    }

       	// 进行跳转
       	if($error === '')
       	{
       		return $this->success($message, url('index'));
       	} else{
       		return $this->error($error);
       	}
	}
}
