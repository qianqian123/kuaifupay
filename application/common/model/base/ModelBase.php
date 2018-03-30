<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 11:40
 */
namespace app\common\model\base;
use think\Model;
class ModelBase extends Model
{
    //账户表
    protected $tableName = '';

    /**
     * 获取单条数据基本信息
     * @param string $field 获取信息字段
     * @param array $where 获取信息条件
     * @return mixed 基本信息
     */
    public  function findBaseInfo($field = "*", $where = array(), $order = '')
    {
        if ($order != '') {
            return $this->field($field)->where($where)->order($order)->find();
        }
        return $this->field($field)->where($where)->find();
    }

    /**
     * 获取多条数据的基本信息
     * @param array $where 获取信息条件
     * @return mixed 基本信息
     */
    public function selectBaseInfo($field = "*", $where = array(),$order = '')
    {
        if ($order != '') {
            return $this->field($field)->where($where)->order($order)->select();
        }
        return $this->field($field)->where($where)->select();
    }

    /**
     * 按照条件获取多条数据
     * @param string $field
     * @param array $where
     * @param string $order
     * @param string $limit
     * @return mixed
     */
    public function getBaseInfoList($field = "*", $where = array(), $order = '', $limit = '')
    {
        return $this->field($field)->where($where)->order($order)->limit($limit)->select();
    }

    /**
     * 数据库万能操作
     */
    public function handleSql($data,$model = 'select',$val = array())
    {
        // 统计查询的实现 如果是统计的话 参数默认为 null
        if(in_array(strtolower($model),array('count','sum','min','max','avg'),true) && empty($val)){
            $val = null;
        }

        //如果尚未有修改内容默认空字符串
        if(!isset($data['data'])){
            return $this->field($data['field'])->join($data['join'])
                ->where($data['where'])->order($data['order'])
                ->limit($data['limit'])->group($data['group'])
                ->$model($val);
        }else{
            return $this->field($data['field'])->join($data['join'])
                ->data($data['data'])->where($data['where'])
                ->order($data['order'])->limit($data['limit'])
                ->$model($val);
        }
    }
}