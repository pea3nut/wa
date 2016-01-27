<?php
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://nutjs.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 花生PeA <626954412@qq.com>
// +----------------------------------------------------------------------

namespace Home\Model;
use Think\Model;
/**
 * 用户登陆令牌
 *
 * <dt>uid</dt>
 * <dd>主键 char(5) 用户的协会编号</dd>
 *
 * <dt>token</dt>
 * <dd>char(20) 用户的登陆令牌，此字段应在用户每次登陆后动态变化</dd>
 *
 * <dt>date</dt>
 * <dd>datetime 用户最后登陆时间，系统自动生成，不允许操作。</dd>
 * */
class TokenModel extends Model{
	/**
	 * 生成的令牌，可以通过getToken方法获取字段值
 	 * @var String(20)
	 * @access protected
	 * */
	protected $token=null;
	/**
	 * 数据表中所有字段
	 * 实际使用是应手动的调用filed()方法来指定要操作的字段
 	 * @var Array
	 * @access protected
	 * */
	protected $fields=array('uid','token','date');
	/**
	 * 数据表的主键
	 * @var String
	 * @access protected
	 * */
	protected $pk='uid';
	/**
	 * 自动完成字段
	 * @var Array
	 * @access protected
	 * */
	protected $_auto=array(
		array('token'	,'createToken'		,self::MODEL_BOTH	,'callback'),//生成令牌
		array('date'	,'get_sql_date'		,self::MODEL_BOTH	,'function'),//获取当前时间
	);
	/**
	 * 校验字段的规则
	 * ThinkPHP的系统变量，名称不可变更
	 * @var Array
	 * @access protected
	 * */
	protected $_validate=array(
		array('uid'	,RegExp_uid		,EC_5431	,self::MUST_VALIDATE	,'regex'	,self::MODEL_BOTH),
	);
	/**
	 * 生成令牌
	 * @param $token String 并没有什么卵用的参数
	 * @access protected
	 * @return String(20) 生成的令牌
	 * */
	protected function createToken ($token){
		$this->token=get_rand_char(20);
		return $this->token;
	}
	/**
	 * 获取生成的令牌
	 * @return String(20) 系统生成的令牌
	 * @access public
	 * */
	public function getToken() {
		return $this->token;
	}
}