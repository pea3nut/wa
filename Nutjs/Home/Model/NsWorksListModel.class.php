<?php
namespace Home\Model;
use Think\Model\RelationModel;
/**
 * 果仁商店商品(作品)信息表
 *
 * <dt>id</dt>
 * <dd>主键 UNSIGNED int 商品ID</dd>
 *
 * <dt>author_uid</dt>
 * <dd>char(5) 作品的UP主（投稿者）的协会编号</dd>
 *
 * <dt>works_name</dt>
 * <dd>varchar(64) 作品的名称</dd>
 *
 * <dt>works_intro</dt>
 * <dd>varchar(250) 作品简介</dd>
 *
 * <dt>works_state</dt>
 * <dd>varchar(64) 作品状态 1-更新中，2-已完结</dd>
 *
 * <dt>section_number</dt>
 * <dd>UNSIGNED int 课程章节数</dd>
 *
 * <dt>price</dt>
 * <dd>UNSIGNED int 作品售价</dd>
 *
 * <dt>update_number</dt>
 * <dd>UNSIGNED int 更新次数</dd>
 *
 * <dt>update_date</dt>
 * <dd>date 最后更新时间</dd>
 *
 * <dt>create_date</dt>
 * <dd>date 创建时间</dd>
 * */
class NsWorksListModel extends RelationModel{
    /**
     * 数据表中所有字段
     * 实际使用是应手动的调用filed()方法来指定要操作的字段
      * @var Array
     * @access protected
     * */
    protected $fields=array('id','author_uid','works_name','works_intro','works_state','section_number','price','update_number','update_date','create_date');
    /**
     * 只读字段，一旦写入就不允许再修改了
     * @var Array
     * @access protected
     * */
    protected $readonlyField=array('id','author_uid' ,'create_date');
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
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'Users',
            //对方的键
            'foreign_key'   => 'uid',
            //自己的键，默认为自己的主键
            'mapping_key'   => 'author_uid',
        ),
        'inf'  =>array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'UserInf',
            //对方的键
            'foreign_key'   => 'uid',
            //自己的键，默认为自己的主键
            'mapping_key'   => 'author_uid',
        ),
        'buy'  =>array(
            'mapping_type'  => self::HAS_MANY,
            'class_name'    => 'NsBuy',
            'foreign_key'   => 'works_id',
        ),
        'section'  =>array(
            'mapping_type'  => self::HAS_MANY,
            'class_name'    => 'NsSection',
            'foreign_key'   => 'works_id',
        ),
    );
    /**
     * 自动完成字段
     * @var Array
     * @access protected
     * */
    protected $_auto=array(
        //任何操作都获取当前时间
        array('update_number' ,'get_sql_short_date'  ,self::MODEL_BOTH    ,'function'),
        //在插入字段是自动获取当前时间
        array('create_date'   ,'get_sql_short_date'  ,self::MODEL_INSERT  ,'function'),
        //使用htmlspecialchars过滤输入字段
        array('works_name'   ,'htmlspecialchars'     ,self::MODEL_BOTH    ,'function'),
        array('works_intro'  ,'htmlspecialchars'     ,self::MODEL_BOTH    ,'function'),
    );
    /**
     * 校验字段的规则
     * ThinkPHP的系统变量，名称不可变更
     * @var Array
     * @access protected
     * */
    protected $_validate=array(
        array('author_uid'      ,RegExp_uid        ,EC_5931    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('works_state'     ,RegExp_works_state,EC_5932    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('section_number'  ,'number'          ,EC_5933    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('price'           ,'number'          ,EC_5934    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
        array('update_number'   ,'number'          ,EC_5935    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_BOTH),
    );
}