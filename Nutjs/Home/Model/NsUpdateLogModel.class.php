<?php
namespace Home\Model;
use Think\Model\RelationModel;
/**
 * 果仁商店作品更新日志记录表
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
     * log的默认值
     * @var String
     * @access protected
     * */
    protected $defaultLog='Fix bug.';
    /**
     * 数据表中所有字段
     * 实际使用是应手动的调用filed()方法来指定要操作的字段
     * @var Array
     * @access protected
     * */
    protected $fields=array('id','works_id','log','date');
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
        //新增时，works_id必填
        array('works_id' ,'number'       ,EC_5C31    ,self::MUST_VALIDATE      ,'regex'    ,self::MODEL_INSERT),//works_id 12
        //若字段存在则验证格式
        array('works_id' ,'number'       ,EC_5C31    ,self::EXISTS_VALIDATE    ,'regex'    ,self::MODEL_UPDATE),//works_id 4
    );
    /**
     * 自动完成字段
     * @var Array
     * @access protected
     * */
    protected $_auto=array(
        //清除所有对于ID的操作
        array('id'    ,''                     ,self::MODEL_BOTH    ,'string'),  //id 1234
        array('id'    ,''                     ,self::MODEL_BOTH    ,'ignore'),  //id 1234
        //更新和新增时若date为空则记录当前时间
        array('date'  ,'get_sql_short_date'   ,self::MODEL_BOTH    ,'function'),//date 1234
        //若log为空则填充默认值
        array('log'   ,'getLog'               ,self::MODEL_BOTH    ,'callback'),//log 13
        //使用htmlspecialchars过滤输入字段
        array('log'   ,'htmlspecialchars'     ,self::MODEL_BOTH    ,'function'),//log 24
    );
    protected function getLog($log){
        if (empty($log)){
            return $this->defaultLog;
        }else {
            return $log;
        }
    }
}