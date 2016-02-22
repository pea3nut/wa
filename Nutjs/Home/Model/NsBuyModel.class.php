<?php
namespace Home\Model;
use Think\Model\RelationModel;
/**
 * 购买记录&评分表
 *
 * <dt>id</dt>
 * <dd>主键 UNSIGNED int 购买记录ID</dd>
 *
 * <dt>works_id</dt>
 * <dd>UNSIGNED int 作品的ID</dd>
 *
 * <dt>uid</dt>
 * <dd>char(5) 购买者的协会编号</dd>
 *
 * <dt>score</dt>
 * <dd>int 购买者的评分，未评分则显示-1，评分范围为0-10</dd>
 * */
class NsBuyModel extends RelationModel{
    /**
     * 数据表中所有字段
     * 实际使用是应手动的调用filed()方法来指定要操作的字段
      * @var Array
     * @access protected
     * */
    protected $fields=array('id','works_id','uid','score');
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
    protected $pk='works_id';
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
        ),
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
        array('uid'      ,RegExp_uid     ,EC_5A31    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('works_id' ,'number'       ,EC_5A32    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('score'    ,'number'       ,EC_5A33    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('score'    ,'checkScore'   ,EC_5A34    ,self::MUST_VALIDATE    ,'callback' ,self::MODEL_BOTH),
    );
    /**
     * 校验score字段
	 * @param string score 用户提交的score字段
	 * @access protected
	 * @return bool
     * */
    protected function checkScore ($score){
        $num= (int)$score;
        if($num >=0 && $num <=10){
            return true;
        }else {
            return false;
        }
    }
}