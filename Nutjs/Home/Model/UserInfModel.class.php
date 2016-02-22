<?php
namespace Home\Model;
use Think\Model\RelationModel;
/**
 * 用户扩展信息表
 *
 * <dt>uid</dt>
 * <dd>主键 char(5) 用户的协会编号</dd>
 *
 * <dt>name</dt>
 * <dd>varchar(20) 用户的真实姓名</dd>
 *
 * <dt>gender</dt>
 * <dd>int(1) 默认为0。用户的性别，1表示男，2表示女</dd>
 *
 * <dt>age</dt>
 * <dd>int(1) 用户的年龄</dd>
 *
 * <dt>phone</dt>
 * <dd>varchar(16) 用户的手机号</dd>
 *
 * <dt>school</dt>
 * <dd>char(2) 用户所在的学校，默认为ql。ql青理 sk山科 sy石油</dd>
 *
 * <dt>wechat</dt>
 * <dd>varchar(16) 用户微信号，可以留空</dd>
 *
 * <dt>nickname</dt>
 * <dd>varchar(20) 用户的昵称</dd>
 * */
class UserInfModel extends RelationModel{
    /**
     * 数据表中所有字段
     * 实际使用是应手动的调用filed()方法来指定要操作的字段
      * @var Array
     * @access protected
     * */
    protected $fields=array('uid','name','nickname','gender','age','phone','school','wechat');
    /**
     * 只读字段，一旦写入就不允许再修改了
     * @var Array
     * @access protected
     * */
    protected $readonlyField=array('uid');
    /**
     * 数据表的主键
     * @var String
     * @access protected
     * */
    protected $pk='uid';
    /**
     * 关联信息
     * ThinkPHP的系统变量，名称不可变更
     * @var Array
     * @access protected
     */
    protected $_link = array(
        'user'  =>array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'Users',
            'foreign_key'   => 'uid',
        ),
        'clock' =>array(
            'mapping_type'  => self::HAS_MANY,
            'class_name'    => 'Clock',
            'foreign_key'   => 'uid',
        ),
        'token' =>array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'Token',
            'foreign_key'   => 'uid',
        ),
        'nut' =>array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'Nuts',
            'foreign_key'   => 'uid',
        ),
        'code' =>array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'InviteCode',
            'foreign_key'   => 'uid',
        ),
        'buy' =>array(
            'mapping_type'  => self::HAS_MANY,
            'class_name'    => 'NsBug',
            'foreign_key'   => 'uid',
        ),
        'works' =>array(
            'mapping_type'  => self::HAS_MANY,
            'class_name'    => 'NsWorksList',
            'foreign_key'   => 'author_uid',
        ),
    );
    /**
     * 校验字段的规则
     * ThinkPHP的系统变量，名称不可变更
     * @var Array
     * @access protected
     * */
    protected $_validate=array(
        array('uid'        ,RegExp_uid        ,EC_5531    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('name'    ,RegExp_name    ,EC_5532    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('gender'    ,RegExp_gender    ,EC_5533    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('age'        ,RegExp_age        ,EC_5534    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('phone'    ,RegExp_phone    ,EC_5535    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('school'    ,RegExp_school    ,EC_5536    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('wechat'    ,RegExp_wechat    ,EC_5537    ,self::VALUE_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('nickname',RegExp_nickname,EC_5538    ,self::VALUE_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
    );
}