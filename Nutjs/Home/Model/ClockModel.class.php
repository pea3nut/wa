<?php
namespace Home\Model;
use Think\Model;
/**
 * 签到表
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
class ClockModel extends Model{
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
	 * 自动完成字段
	 * @var Array
	 * @access protected
	 * */
	protected $_auto=array(
		array('date'	,'get_sql_short_date'		,self::MODEL_BOTH	,'function'),//获取当前时间
	);
	/**
	 * 校验字段的规则
	 * ThinkPHP的系统变量，名称不可变更
	 * @var Array
	 * @access protected
	 * */
	protected $_validate=array(
		array('uid'	,RegExp_uid		,EC_5731	,self::MUST_VALIDATE	,'regex'	,self::MODEL_BOTH),
	);
}