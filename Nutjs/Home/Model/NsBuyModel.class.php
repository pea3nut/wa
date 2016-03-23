<?php
namespace Home\Model;
use Think\Model\RelationModel;
/**
 * 果仁商店用户购买记录&评分表
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
        //新增时，必须校验的字段
        array('uid'      ,RegExp_uid     ,EC_5A31    ,self::MUST_VALIDATE      ,'regex'    ,self::MODEL_INSERT),//uid 12
        array('works_id' ,'number'       ,EC_5A32    ,self::MUST_VALIDATE      ,'regex'    ,self::MODEL_INSERT),//works_id 12
        //若score有值则需要校验，并需在-1~10以内
        array('score'    ,RegExp_Integer ,EC_5A33    ,self::EXISTS_VALIDATE    ,'regex'    ,self::MODEL_BOTH),//score 24
        array('score'    ,'checkScore'   ,EC_5A34    ,self::EXISTS_VALIDATE    ,'callback' ,self::MODEL_BOTH),//score 24
        //更新时，若存在则校验字段
        array('uid'      ,RegExp_uid     ,EC_5A31    ,self::EXISTS_VALIDATE    ,'regex'    ,self::MODEL_UPDATE),//uid 4
        array('works_id' ,'number'       ,EC_5A32    ,self::EXISTS_VALIDATE    ,'regex'    ,self::MODEL_UPDATE),//works_id 4
        array('id'       ,'number'       ,EC_5A35    ,self::EXISTS_VALIDATE    ,'regex'    ,self::MODEL_UPDATE),//id 4
    );
    /**
     * 自动完成字段
     * @var Array
     * @access protected
     * */
    protected $_auto=array(
        //新增数据时，清楚所有对于ID的操作
        array('id'       ,''                         ,self::MODEL_INSERT       ,'string'),  //id 12
        array('id'       ,''                         ,self::MODEL_INSERT       ,'ignore'),  //id 12
        //插入时，若score字段为空或不存在，则赋值为-1
        array('score'    ,'setScore'                 ,self::MODEL_INSERT       ,'callback'),//score 1
    );
    /**
     * 若score字段为空或不存在，则返回为-1
	 * @param string score 用户提交的score字段
	 * @access protected
	 * @return bool
     * */
    protected function setScore ($score){
        return empty($score) ? -1 : $score;
    }
    /**
     * 校验score字段
	 * @param string score 用户提交的score字段
	 * @access protected
	 * @return bool
     * */
    protected function checkScore ($score){
        $num= (int)$score;
        if($num >=-1 && $num <=10){
            return true;
        }else {
            return false;
        }
    }
}