<?php
namespace Home\Model;
use Think\Model;
/**
 * 注册码/激活码 对应表
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
class InviteCodeModel extends Model{
	/**
	 * 自动完成字段
	 * @var Array
	 * @access protected
	 * */
	protected $_auto=array(
		array('date'	,'get_sql_date'		,self::MODEL_BOTH	,'function'),//获取当前时间
	);
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
	 * 校验字段的规则
	 * ThinkPHP的系统变量，名称不可变更
	 * @var Array
	 * @access protected
	 * */
	protected $_validate=array(
		array('uid'			,RegExp_uid		,EC_5331	,self::MUST_VALIDATE	,'regex'	,self::MODEL_BOTH),
		array('invite_code'	,'/^\w+$/'		,EC_5332	,self::MUST_VALIDATE	,'regex'	,self::MODEL_BOTH),
	);
}