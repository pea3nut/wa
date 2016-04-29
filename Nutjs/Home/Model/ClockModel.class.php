<?php
namespace Home\Model;
use Think\Model\RelationModel;
/**
 * 用户签到记录表
 *
 * <dt>id</dt>
 * <dd>主键 init(5) 签到记录ID，自动增长</dd>
 *
 * <dt>uid</dt>
 * <dd>char(5) 用户的协会编号</dd>
 *
 * <dt>date</dt>
 * <dd>date 签到时间</dd>
 * */
class ClockModel extends RelationModel{
    /**
     * 数据表中所有字段
     * 实际使用是应手动的调用filed()方法来指定要操作的字段
     * @var Array
     * @access protected
     * */
    protected $fields=array('id','uid','date');
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
        'user'  =>array(
            'mapping_type'  => self::BELONGS_TO,
            'class_name'    => 'Users',
            'foreign_key'   => 'uid',
        ),
        'inf'  =>array(
            'mapping_type'  => self::BELONGS_TO,
            'class_name'    => 'UserInf',
            'foreign_key'   => 'uid',
        )
    );
    /**
     * 自动完成字段
     * @var Array
     * @access protected
     * */
    protected $_auto=array(
        //清除所有对于ID的操作
        array('id'     ,''                     ,self::MODEL_BOTH  ,'string'),  //id 1234
        array('id'     ,''                     ,self::MODEL_BOTH  ,'ignore'),  //id 1234
        //插入时，自动获取当前时间
        array('date'   ,Short_Date             ,self::MODEL_BOTH  ,'string'),//date 1234
    );
    /**
     * 校验字段的规则
     * ThinkPHP的系统变量，名称不可变更
     * @var Array
     * @access protected
     * */
    protected $_validate=array(
        //插入时，uid必填
        array('uid'    ,RegExp_uid        ,EC_5731    ,self::MUST_VALIDATE     ,'regex'    ,self::MODEL_INSERT),//uid 12
        //若字段存在，则验证
        array('uid'    ,RegExp_uid        ,EC_5731    ,self::EXISTS_VALIDATE    ,'regex'    ,self::MODEL_UPDATE),//uid 4
    );
}