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
 * <dd>int(1) 作品状态 1-更新中，2-已完结</dd>
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
    protected $fields=array('id','author_uid','works_name','works_intro','works_state','price','update_number','update_date','create_date');
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
        'inf'   =>array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'UserInf',
            //对方的键
            'foreign_key'   => 'uid',
            //自己的键，默认为自己的主键
            'mapping_key'   => 'author_uid',
        ),
        'buy'   =>array(
            'mapping_type'  => self::HAS_MANY,
            'class_name'    => 'NsBuy',
            'foreign_key'   => 'works_id',
        ),
        'section'  =>array(
            'mapping_type'  => self::HAS_MANY,
            'class_name'    => 'NsSection',
            'foreign_key'   => 'works_id',
        ),
        'log'   =>array(
            'mapping_type'  => self::HAS_MANY,
            'class_name'    => 'NsUpdateLog',
            'foreign_key'   => 'works_id',
        ),
    );
    /**
     * 自动完成字段
     * @var Array
     * @access protected
     * */
    protected $_auto=array(
        //新增数据时，id字段不允许有值
        array('id'              ,''                                 ,self::MODEL_INSERT ,'string'),  //id 12
        array('id'              ,''                                 ,self::MODEL_INSERT ,'ignore'),  //id 12
        //使用htmlspecialchars过滤文本字段
        array('works_name'      ,'htmlspecialchars'                 ,self::MODEL_BOTH   ,'function'),//works_name 24
        array('works_intro'     ,'htmlspecialchars'                 ,self::MODEL_BOTH   ,'function'),//works_intro 24
        //新增数据时，works_state默认为1
        array('works_state'     ,'1'                                ,self::MODEL_INSERT ,'function'),//works_state 12
        //新增数据时，update_number默认为0
        array('update_number'   ,0                                  ,self::MODEL_INSERT ,'string'),  //update_number 12
        //任何更新操作都将update_number++
        array('update_number'   ,array('exp','`update_number` +1')  ,self::MODEL_UPDATE ,'string'),  //update_number 34
        //新增数据时，自动获取当前时间作为create_date字段
        array('create_date'     ,'get_sql_short_date'               ,self::MODEL_INSERT ,'function'),//create_date 12
        //更新数据时，不允许操作create_date字段
        array('create_date'     ,''                                 ,self::MODEL_UPDATE ,'string'),  //create_date 4
        array('create_date'     ,''                                 ,self::MODEL_UPDATE ,'ignore'),  //create_date 3
        //update_date字段永远自动获取当前时间
        array('update_date'     ,'get_sql_short_date'               ,self::MODEL_BOTH   ,'function'),//update_date 1234
    );
    /**
     * 校验字段的规则
     * ThinkPHP的系统变量，名称不可变更
     * @var Array
     * @access protected
     * */
    protected $_validate=array(
        //新增时的必填字段
        array('author_uid'      ,RegExp_uid        ,EC_5931    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_INSERT),//author_uid 12
        array('works_name'      ,'require'         ,EC_5933    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_INSERT),//works_name 1
        array('price'           ,RegExp_price      ,EC_5934    ,self::MUST_VALIDATE    ,'regex'    ,self::MODEL_INSERT),//price 12
        //更新时，如果存在就验证的字段
        array('author_uid'      ,RegExp_uid        ,EC_5931    ,self::EXISTS_VALIDATE  ,'regex'    ,self::MODEL_UPDATE),//author_uid 4
        array('id'              ,RegExp_Number     ,EC_5935    ,self::EXISTS_VALIDATE  ,'regex'    ,self::MODEL_UPDATE),//id 4
        array('works_state'     ,RegExp_works_state,EC_5932    ,self::EXISTS_VALIDATE  ,'regex'    ,self::MODEL_UPDATE),//works_state 4
        array('price'           ,RegExp_price      ,EC_5934    ,self::EXISTS_VALIDATE  ,'regex'    ,self::MODEL_UPDATE),//price 4
    );
};