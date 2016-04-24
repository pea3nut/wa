<?php
namespace Home\Model;
use Think\Model\RelationModel;
/**
 * 激活码使用记录表
 *
 * <dt>invite_code</dt>
 * <dd>主键 char(5) 存放激活码字段</dd>
 *
 * <dt>uid</dt>
 * <dd>char(5) 使用激活码注册的协会编号，若为空则激活码未被使用</dd>
 *
 * <dt>date</dt>
 * <dd>datetime 使用该激活码的时间(用户注册时间)</dd>
 * */
class InviteCodeModel extends RelationModel{
    /**
     * 数据表中所有字段
     * 实际使用是应手动的调用filed()方法来指定要操作的字段
      * @var Array
     * @access protected
     * */
    protected $fields=array('invite_code','uid','date');
    /**
     * 数据表的主键
     * @var String
     * @access protected
     * */
    protected $pk='invite_code';
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
        //date字段永远自动获取当前时间
        array('date'         ,Long_Date                 ,self::MODEL_BOTH   ,'string'),//date 1234
    );
    /**
     * 校验字段的规则
     * ThinkPHP的系统变量，名称不可变更
     * @var Array
     * @access protected
     * */
    protected $_validate=array(
        //插入时，invite_code必填
        array('invite_code'  ,RegExp_Letter  ,EC_5332   ,self::EXISTS_VALIDATE    ,'regex'    ,self::MODEL_INSERT),//invite_code 12
        //若存在则验证的字段
        array('uid'          ,RegExp_uid     ,EC_5331   ,self::EXISTS_VALIDATE    ,'regex'    ,self::MODEL_BOTH),  //uid 24
        array('invite_code'  ,RegExp_Letter  ,EC_5332   ,self::EXISTS_VALIDATE    ,'regex'    ,self::MODEL_BOTH),  //invite_code 24
    );
}