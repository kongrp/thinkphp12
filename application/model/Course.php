<?php
namespace app\model;
use think\Model;

class Course extends Model
{
	public function Klasses()
    {
        return $this->belongsToMany('Klass',  config('database.prefix') . 'klass_course');
    }


    //点编辑时，进行判断哪个班级是否选中
    public function getIsChecked(&$Klass)
    {
        // 对传入变量进行判断
        if (!is_object($Klass) || get_class($Klass) !== 'app\model\Klass' )
        {
            throw new \Exception("param must be app\index\model\Klass", 1);
        }

        // 取课程ID
        $courseId = (int)$this->id;
        $klassId = $Klass->id;

        // 定制查询条件
        $map = array();
        $map['klass_id'] = $klassId;
        $map['course_id'] = $courseId;

        // 从关联表中取信息
        $KlassCourse = KlassCourse::get($map);
        if (false === $KlassCourse)
        {
            return false;
        } else {
            return true;
        }
    }

    //在列表显示页，直接显示该课程对应的班级名称
    public function getChecked(&$Klass)
    {
        // 对传入变量进行判断
        if (!is_object($Klass) || get_class($Klass) !== 'app\model\Klass' )
        {
            throw new \Exception("param must be app\index\model\Klass", 1);
        }

        // 取课程ID
        $courseId = (int)$this->id;
        $klassId = $Klass->id;

        // 定制查询条件
        $map = array();
        $map['klass_id'] = $klassId;
        $map['course_id'] = $courseId;

        // 从关联表中取信息
        $KlassCourse = KlassCourse::get($map);
        if ($KlassCourse)
        {	
            $klass = Klass::get($KlassCourse->klass_id);
            return $klass->getData('name');
        }
    }

    //相当于增加了一个KlassCourse属性
    public function klassCourse(){
        $KlassCourse = new KlassCourse;
        $this->data['KlassCourse'] = $KlassCourse;
        return $KlassCourse;
    }
}