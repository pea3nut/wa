<?php
namespace Home\Model;
use Think\Model\RelationModel;
/**
 * 作品更新记录
 *
 * <dt>id</dt>
 * <dd>主键 UNSIGNED int 记录ID</dd>
 *
 * <dt>works_id</dt>
 * <dd>UNSIGNED int 作品的ID</dd>
 *
 * <dt>log</dt>
 * <dd>varchar 本次更新的说明</dd>
 *
 * <dt>date</dt>
 * <dd>date 创建的时间</dd>
 * */
class NsUpdateLogModel extends RelationModel{
    /**
     * 数据表中所有字段
     * 实际使用是应手动的调用filed()方法来指定要操作的字段
      * @var Array
     * @access protected
     * */
    protected $fields=array('id','works_id','log','date');
    /**
     * 只读字段，一旦写入就不允许再修改了
     * @var Array
     * @access protected
     * */
    protected $readonlyField=array('id');
    /**
     * 数据表的主键
     * @var String
     * @access protected
     * */
    protected $pk='id';
    /**
     * 关联信息
     * ThinkPHP的系统变量，名称不可变更
     * @var Array
     * @access protected
     */
    protected $_link = array(
        'works'  =>array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'NsWorksList',
            //对方的键
            'foreign_key'   => 'id',
            //自己的键，默认为自己的主键
            'mapping_key'   => 'works_id',
        ),
    );
    /**
     * 校验字段的规则
     * ThinkPHP的系统变量，名称不可变更
     * @var Array
     * @access protected
     * */
    protected $_validate=array(
        array('works_id' ,'number'       ,EC_5C31    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
    );
    /**
     * 自动完成字段
     * @var Array
     * @access protected
     * */
    protected $_auto=array(
        //填充当前时间
        array('date'  ,'get_sql_short_date'   ,self::MODEL_BOTH    ,'function'),
        //使用htmlspecialchars过滤输入字段
        array('log'   ,'htmlspecialchars'     ,self::MODEL_BOTH    ,'function'),
        //清楚所有对于ID的操作
        array('id'    ,''                     ,self::MODEL_INSERT    ,'function'),
    );
}