<?php
namespace Home\Model;
use Think\Model\RelationModel;
/**
 * 作品章节表
 *
 * <dt>id</dt>
 * <dd>主键 UNSIGNED int 章节记录ID</dd>
 *
 * <dt>works_id</dt>
 * <dd>UNSIGNED int 章节所属的作品的ID</dd>
 *
 * <dt>section_id</dt>
 * <dd>UNSIGNED int 章节在作品中的排序ID，第x涨</dd>
 *
 * <dt>section_name</dt>
 * <dd>varchar 章节名称</dd>
 *
 * <dt>update_date</dt>
 * <dd>date 本章最后更新时间</dd>
 * */
class NsSectionModel extends RelationModel{
    /**
     * 数据表中所有字段
     * 实际使用是应手动的调用filed()方法来指定要操作的字段
      * @var Array
     * @access protected
     * */
    protected $fields=array('id','works_id','section_id','section_name','update_date');
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
        //新增时，必须校验的字段
        array('works_id'    ,'number'       ,EC_5B31    ,self::MUST_VALIDATE    ,'regex'      ,self::MODEL_INSERT),//works_id 12
        array('section_id'  ,'number'       ,EC_5B32    ,self::MUST_VALIDATE    ,'regex'      ,self::MODEL_INSERT),//section_id 12
        //更新时，若存在则校验
        array('works_id'    ,'number'       ,EC_5B31    ,self::EXISTS_VALIDATE    ,'regex'    ,self::MODEL_UPDATE),//works_id 4
        array('section_id'  ,'number'       ,EC_5B32    ,self::EXISTS_VALIDATE    ,'regex'    ,self::MODEL_UPDATE),//section_id 4
        array('id'          ,'number'       ,EC_5B33    ,self::EXISTS_VALIDATE    ,'regex'    ,self::MODEL_UPDATE),//id 4
    );
    /**
     * 自动完成字段
     * @var Array
     * @access protected
     * */
    protected $_auto=array(
        //update_date字段总是填充当前时间
        array('update_date'  ,'get_sql_short_date'   ,self::MODEL_BOTH    ,'function'),//update_date 1234
        //使用htmlspecialchars过滤输入字段
        array('works_name'   ,'htmlspecialchars'     ,self::MODEL_BOTH    ,'function'),//works_name 24
        //新增数据时，清楚所有对于ID的操作
        array('id'           ,''                     ,self::MODEL_INSERT  ,'string'),  //id 12
        array('id'           ,''                     ,self::MODEL_INSERT  ,'ignore'),  //id 12
    );
}